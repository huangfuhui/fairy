<?php
/**
 * File: ChapterModel.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 17:22
 * Email: huangfuhui@outlook.com
 */

namespace App\Models;

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