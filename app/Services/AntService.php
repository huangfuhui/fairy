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
use App\Models\AuthorModel;
use App\Models\BookModel;
use App\Models\ChapterModel;
use App\Models\ContentModel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class AntService
{
    private $client = null;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 初始化书籍
     *
     * @param string $bookUrl
     * @return Book|null
     */
    public function initBook($bookUrl = '')
    {
        if (empty($bookUrl)) {
            return null;
        }

        // 发起请求
        $response = $this->client->request('GET', $bookUrl);
        if ($response->getStatusCode() != 200) {
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

        // 保存封面
        $cover     = file_get_contents($book->cover);
        $coverName = md5(config('app.name') . $book->name . $book->author) . '.' . config('ant.cover_suffix');
        if (Storage::exists(config('ant.cover_dir') . $coverName) || Storage::put(config('ant.cover_dir') . $coverName, $cover)) {
            $book->cover = $coverName;
        } else {
            $book->cover = '';
        }

        // 解析书籍类型
        $book->type_id = $this->parseType($book->type);

        // 解析书籍状态
        $book->status = $this->parseStatus($book->status);

        // 初始化书籍信息
        if (!BookModel::existBook($book->name, $book->author_id)) {
            $book->id = BookModel::initBook($book->name, $book->author_id, $book->type_id, $book->profile, $book->cover, $book->status);
        }

        // TODO:异步初始化书籍章节信息
        if ($book->id) {
            $this->initChapter($book->id, $bookUrl);
        }

        return $book;
    }

    /**
     * 初始化章节信息
     *
     * @param int    $bookId
     * @param string $bookUrl
     * @return bool
     */
    public function initChapter($bookId, $bookUrl)
    {
        $book = BookModel::getBook($bookId)->toArray();
        if (empty($book) || empty($bookUrl)) {
            return false;
        }

        // 发起请求
        $response = $this->client->request('GET', $bookUrl);
        if ($response->getStatusCode() != 200) {
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
        foreach ($chapters[2] as $key => $value) {
            array_push($chapterList, ['book_id' => $bookId, 'name' => $value, 'created_at' => $createTime, 'updated_at' => $createTime]);

            // TODO:异步拉取章节内容
            $this->initContent($bookId, $value, $chapters[1][$key]);
        }

        return Chapter::insert($chapterList);
    }

    /**
     * 初始化章节内容
     *
     * @param int    $bookId
     * @param string $chapterName
     * @param string $chapterUrl
     * @return bool
     */
    public function initContent($bookId, $chapterName, $chapterUrl)
    {
        $book        = BookModel::getBook($bookId)->toArray();
        $chapterName = ChapterModel::getByName($bookId, $chapterName);
        if (empty($book) || empty($chapterName) || empty($chapterUrl)) {
            return false;
        }

        // 发起请求
        $response = $this->client->request('GET', $chapterUrl);
        if ($response->getStatusCode() != 200) {
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
            $res = ContentModel::add($this->generateContentId($bookId, $chapterName), $content);
        }

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 解析文本内容
     *
     * @param string $content
     * @param string $pattern
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
     * @return string
     */
    private function generateContentId($bookId, $chapterName)
    {
        return md5($bookId . '-' . $chapterName);
    }
}