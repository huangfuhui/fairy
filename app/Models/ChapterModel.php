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
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getByName($bookId, $name)
    {
        return Chapter::where('book_id', $bookId)->where('name', $name)->first();
    }
}