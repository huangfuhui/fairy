<?php
/**
 * @FileName AntService.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/2 下午2:28
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Services;

use App\Constants\BookConstant;
use App\Constants\BookTypeConstant;
use App\Entities\Book;
use App\Entities\Chapter;
use App\Events\Ant\Content;
use App\Events\Ant\Chapter as ChapterObj;
use App\Events\AntEvent;
use App\Models\AuthorModel;
use App\Models\BookModel;
use App\Models\ChapterModel;
use App\Models\ContentModel;
use App\Models\UpdateInfoModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Support\Facades\Storage;
use Exception;

class AntService
{
    private static $httpCode = 0;

    private static $errMsg = '';

    private $client = null;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 初始化书籍
     *
     * @param string $bookUrl
     *
     * @return Book|null
     */
    public function initBook($bookUrl = '')
    {
        if (empty($bookUrl)) {
            return null;
        }

        // 发起请求
        try {
            $response = $this->client->request('GET', $bookUrl);
            if ($response->getStatusCode() != 200) {
                $this->setHttpCode($response->getStatusCode());

                return null;
            }
        } catch (TransferException $exception) {
            empty($response) || $this->setHttpCode($response->getStatusCode());
            $this->setErrMsg($exception->getMessage());

            return null;
        }

        // 获取返回的内容
        $body = $response->getBody();
        // 进行UTF-8转码
        $content = mb_convert_encoding($body->getContents(), 'UTF-8', 'GBK');

        // 解析文本
        $book          = new Book();
        $book->name    = $this->paresContent($content, config('ant.pattern.book.name'));
        $book->author  = $this->paresContent($content, config('ant.pattern.book.author'));
        $book->profile = $this->paresContent($content, config('ant.pattern.book.profile'));
        $book->type    = $this->paresContent($content, config('ant.pattern.book.type'));
        $book->cover   = $this->paresContent($content, config('ant.pattern.book.cover'));
        $book->status  = $this->paresContent($content, config('ant.pattern.book.status'));

        // 初始化作者信息
        if (AuthorModel::existAuthor($book->author)) {
            $book->author_id = AuthorModel::getAuthorId($book->author);
        } else {
            $book->author_id = AuthorModel::initAuthor($book->author);
        }

        // 初始化书籍信息
        if (!BookModel::existBook($book->name, $book->author_id)) {

            // 保存封面
            try {
                $cover     = file_get_contents($book->cover);
                $coverName = md5(config('app.name') . $book->name . $book->author) . '.' . config('ant.cover_suffix');
                if (Storage::exists(config('ant.cover_dir') . $coverName) || Storage::put(config('ant.cover_dir') . $coverName, $cover)) {
                    $book->cover = $coverName;
                } else {
                    $book->cover = '';
                }
            } catch (Exception $exception) {
                $book->cover = '';
            }

            // 解析书籍类型
            $book->type_id = $this->parseType($book->type);

            // 解析书籍状态
            $book->status = $this->parseStatus($book->status);

            $book->id = BookModel::initBook($book->name, $book->author_id, $book->type_id, $book->profile, $book->cover, $book->status);
        }

        // 异步初始化书籍章节信息
        if ($book->id) {
            $chapterObj = new ChapterObj();
            $chapterObj->setBookId($book->id);
            $chapterObj->setRequestUrl($bookUrl);
            event(new AntEvent($chapterObj));
        }

        return $book;
    }

    /**
     * 初始化章节信息
     *
     * @param int    $bookId
     * @param string $bookUrl
     *
     * @return bool
     */
    public function initChapter($bookId, $bookUrl)
    {
        $book = BookModel::getBook($bookId);
        if (empty($book) || empty($bookUrl)) {
            return false;
        }

        // 发起请求
        try {
            $response = $this->client->request('GET', $bookUrl);
            if ($response->getStatusCode() != 200) {
                $this->setHttpCode($response->getStatusCode());

                return false;
            }
        } catch (TransferException $exception) {
            empty($response) || $this->setHttpCode($response->getStatusCode());
            $this->setErrMsg($exception->getMessage());

            return false;
        }

        // 获取返回的内容
        $body = $response->getBody();
        // 进行UTF-8转码
        $content = mb_convert_encoding($body->getContents(), 'UTF-8', 'GBK');

        // 解析文本内容
        $content  = trim($this->paresContent($content, config('ant.pattern.book.chapter_contents')));
        $chapters = [];
        preg_match_all(config('ant.pattern.book.chapter_list'), $content, $chapters);

        // 初始化章节信息
        $chapterList = [];
        $createTime  = date('Y-m-d H:i:s', time());
        $contentObj  = new Content();
        $contentObj->setBookId($bookId);
        foreach ($chapters[2] as $key => $value) {
            $temp = ['book_id' => $bookId, 'name' => $value, 'created_at' => $createTime, 'updated_at' => $createTime];
            if (!in_array($temp, $chapterList)) {
                array_push($chapterList, $temp);
            }
        }

        ChapterModel::deleteAll($bookId);
        $res = Chapter::insert($chapterList);

        if ($res) {
            // 记录更新标志
            $chapterCount = count($chapterList);
            UpdateInfoModel::add($bookId, $chapterCount, $bookUrl);

            foreach ($chapters[2] as $key => $value) {
                // 异步拉取章节内容
                $contentObj->setChapterName($value);
                $contentObj->setRequestUrl($chapters[1][$key]);
                event(new AntEvent($contentObj));
            }
        }

        return $res;
    }

    /**
     * 初始化章节内容
     *
     * @param int    $bookId
     * @param string $chapterName
     * @param string $chapterUrl
     *
     * @return bool
     */
    public function initContent($bookId, $chapterName, $chapterUrl)
    {
        $book    = BookModel::getBook($bookId)->toArray();
        $chapter = ChapterModel::getByName($bookId, $chapterName)->toArray();
        if (empty($book) || empty($chapter) || empty($chapterUrl)) {
            return false;
        }

        // 发起请求
        try {
            $response = $this->client->request('GET', $chapterUrl);
            if ($response->getStatusCode() != 200) {
                $this->setHttpCode($response->getStatusCode());

                return false;
            }
        } catch (TransferException $exception) {
            empty($response) || $this->setHttpCode($response->getStatusCode());
            $this->setErrMsg($exception->getMessage());

            return false;
        }

        // 获取返回的内容
        $body = $response->getBody();
        // 进行UTF-8转码
        $content = mb_convert_encoding($body->getContents(), 'UTF-8', 'GBK');

        // 解析文本
        $content = $this->paresContent($content, config('ant.pattern.book.content'));

        // 新增或更新章节内容
        $contentId = $this->generateContentId($bookId, $chapterName);
        if (ContentModel::existContent($contentId)) {
            $res = ContentModel::update($contentId, $content);
        } else {
            $res = ContentModel::add($contentId, $content) && ChapterModel::updateContentId($chapter['id'], $contentId);
        }

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新书籍章节
     *
     * @param int $bookId
     *
     * @return bool
     */
    public function updateChapter($bookId)
    {
        $book       = BookModel::getBook($bookId);
        $updateInfo = UpdateInfoModel::getByBookId($bookId);

        if (empty($book) || BookConstant::END == $book->status || empty($updateInfo)) {
            return false;
        }

        // 发起请求
        try {
            $response = $this->client->request('GET', $updateInfo->address);
            if ($response->getStatusCode() != 200) {
                $this->setHttpCode($response->getStatusCode());

                return false;
            }
        } catch (TransferException $exception) {
            empty($response) || $this->setHttpCode($response->getStatusCode());
            $this->setErrMsg($exception->getMessage());

            return false;
        }

        // 获取返回的内容
        $body = $response->getBody();
        // 进行UTF-8转码
        $content = mb_convert_encoding($body->getContents(), 'UTF-8', 'GBK');

        // 解析文本内容
        $content  = trim($this->paresContent($content, config('ant.pattern.book.chapter_contents')));
        $chapters = [];
        preg_match_all(config('ant.pattern.book.chapter_list'), $content, $chapters);
        $newChapterCount = count($chapters[1]);
        $newAddChapters  = $newChapterCount - $updateInfo->update_tag;

        if ($newAddChapters > 0) {
            // 初始化章节信息，异步更新章节内容
            $contentObj = new Content();
            $contentObj->setBookId($bookId);
            for ($i = $newAddChapters; $i > 0; $i--) {
                $newChapter    = array_pop($chapters[2]);
                $newChapterUrl = array_pop($chapters[1]);

                ChapterModel::addChapter($bookId, $newChapter);

                $contentObj->setChapterName($newChapter);
                $contentObj->setRequestUrl($newChapterUrl);
                event(new AntEvent($contentObj));
            }

            // 更新标志
            UpdateInfoModel::updateTag($bookId, $newChapterCount);
        }

        return true;
    }

    public function search($key)
    {

    }

    /**
     * 解析文本内容
     *
     * @param string $content
     * @param string $pattern
     *
     * @return string
     */
    private function paresContent($content, $pattern)
    {
        $match = [];
        $res   = preg_match($pattern, $content, $match);
        if ($res) {
            return $match[1];
        } else {
            return '';
        }
    }

    /**
     * 解析书籍类型
     *
     * @param string $typeString
     *
     * @return int
     */
    private function parseType($typeString)
    {
        $res = BookTypeConstant::OTHER;
        foreach (BookTypeConstant::BOOK_TYPE as $key => $value) {
            if (substr_count($typeString, $value)) {
                $res = $key;
                break;
            }
        }

        return $res;
    }

    /**
     * 解析书籍状态
     *
     * @param string $statusString
     *
     * @return int
     */
    private function parseStatus($statusString)
    {
        substr_count($statusString, BookConstant::END) ? $res = BookConstant::SERIAL : $res = BookConstant::SERIAL;

        return $res;
    }

    /**
     * 生成文章内容ID
     *
     * @param int    $bookId
     * @param string $chapterName
     *
     * @return string
     */
    private function generateContentId($bookId, $chapterName)
    {
        return md5($bookId . '-' . $chapterName);
    }

    /**
     * @return int
     */
    public static function getHttpCode(): int
    {
        return self::$httpCode;
    }

    /**
     * @param int $httpCode
     */
    public static function setHttpCode(int $httpCode)
    {
        self::$httpCode = $httpCode;
    }

    /**
     * @return string
     */
    public static function getErrMsg(): string
    {
        return self::$errMsg;
    }

    /**
     * @param string $errMsg
     */
    public static function setErrMsg(string $errMsg)
    {
        self::$errMsg = $errMsg;
    }
}