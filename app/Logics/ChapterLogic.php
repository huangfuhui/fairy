<?php
/**
 * File: ChapterLogic.php
 *
 * User: huangfuhui
 * Date: 2018/1/1 23:47
 * Email: huangfuhui@outlook.com
 */

namespace App\Logics;

use App\Models\ChapterModel;

class ChapterLogic extends AbstractLogic
{
    /**
     * 获取书籍章节信息
     *
     * @return mixed
     */
    public function chapterList()
    {
        $bookId = $this->book_id;
        $sort   = $this->sort;
        empty($sort) ? $sort = 'desc' : null;

        $chapterList = ChapterModel::getChapterList($bookId, $sort)->toArray();

        return $chapterList;
    }
}