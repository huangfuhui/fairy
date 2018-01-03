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

        // 默认降序获取书籍章节
        if (!empty($sort) && $sort == 1) {
            $order = 'asc';
        } else {
            $order = 'desc';
        }

        $chapterList = ChapterModel::getChapterList($bookId, $order)->toArray();
        empty($sort) ? null : $chapterList['sort'] = $sort;

        return $chapterList;
    }

    /**
     * 获取章节信息
     *
     * @return array
     */
    public function chapterInfo()
    {
        $bookId    = $this->book_id;
        $chapterId = $this->chapter_id;

        $lastChapter    = ChapterModel::getLastById($bookId, $chapterId);
        $currentChapter = ChapterModel::getById($chapterId);
        $nextChapter    = ChapterModel::getNextById($bookId, $chapterId);

        empty($lastChapter) ? null : $lastChapter = $lastChapter->toArray();
        if (empty($currentChapter)) {
            $this->error('道友，当前章节已遗失多年.');
        } else {
            $currentChapter = $currentChapter->toArray();
        }
        empty($nextChapter) ? null : $nextChapter = $nextChapter->toArray();

        return [
            'last_chapter'    => $lastChapter,
            'current_chapter' => $currentChapter,
            'next_chapter'    => $nextChapter,
        ];
    }
}