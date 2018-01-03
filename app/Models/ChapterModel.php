<?php
/**
 * File: ChapterModel.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 17:22
 * Email: huangfuhui@outlook.com
 */

namespace App\Models;

use App\Constants\BookConstant;
use App\Entities\Chapter;

class ChapterModel
{
    /**
     * 初始化书籍章节内容
     *
     * @param array $chapters
     *
     * @return bool
     */
    public static function initChapter($chapters = [])
    {
        return Chapter::insert($chapters);
    }

    /**
     * 根据书籍ID获取章节列表
     *
     * @param int    $bookId
     * @param string $sort
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getChapterList($bookId, $sort = 'desc')
    {
        return Chapter::where('book_id', $bookId)->orderBy('id', $sort)->paginate(BookConstant::PAGINATE);
    }

    /**
     * 根据书籍ID和章节名字获取章节信息
     *
     * @param int    $bookId
     * @param string $name
     *
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getByName($bookId, $name)
    {
        return Chapter::where('book_id', $bookId)->where('name', $name)->first();
    }

    /**
     * 根据ID获取章节信息
     *
     * @param int $chapterId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function getById($chapterId)
    {
        return Chapter::find($chapterId);
    }

    /**
     * 获取上一章节信息
     *
     * @param int $bookId
     * @param int $chapterId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getLastById($bookId, $chapterId)
    {
        return Chapter::where('id', '<', $chapterId)->where('book_id', $bookId)->orderBy('id', 'desc')->limit(1)->first();
    }

    /**
     * 获取下一章节信息
     *
     * @param int $bookId
     * @param int $chapterId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getNextById($bookId, $chapterId)
    {
        return Chapter::where('id', '>', $chapterId)->where('book_id', $bookId)->orderBy('id', 'asc')->limit(1)->first();
    }

    /**
     * 删除书籍所有章节信息
     *
     * @param int $bookId
     *
     * @return bool|null
     */
    public static function deleteAll($bookId)
    {
        return Chapter::where('book_id', $bookId)->delete();
    }

    /**
     * 更新章节内容ID
     *
     * @param int    $chapterId
     * @param string $contentId
     *
     * @return bool
     */
    public static function updateContentId($chapterId, $contentId)
    {
        return Chapter::where('id', $chapterId)->update(['content_id' => $contentId]);
    }

    /**
     * 添加章节信息
     *
     * @param int    $bookId
     * @param string $name
     *
     * @return bool
     */
    public static function addChapter($bookId, $name)
    {
        $chapter          = new Chapter();
        $chapter->book_id = $bookId;
        $chapter->name    = $name;

        return $chapter->save();
    }
}