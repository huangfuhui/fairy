<?php
/**
 * File: BookController.php
 *
 * User: huangfuhui
 * Date: 2018/1/1 11:00
 * Email: huangfuhui@outlook.com
 */

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Logics\BookLogic;
use App\Logics\ChapterLogic;
use App\Logics\ContentLogic;

class BookController extends Controller
{
    /**
     * 书籍信息
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bookInfo()
    {
        $bookLogic = new BookLogic();
        $bookInfo  = $bookLogic->bookInfo();
        $this->addData('book_info', $bookInfo);

        $chapterLogic = new ChapterLogic();
        $chapterList  = $chapterLogic->chapterList();
        $this->setPage($chapterList);

        return view('mobile.book', $this->viewData());
    }

    /**
     * 书籍章节内容
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function content()
    {
        $bookLogic = new BookLogic();
        $bookInfo  = $bookLogic->bookInfo();
        $this->addData('book_info', $bookInfo);

        $chapterLogic = new ChapterLogic();
        $chapter      = $chapterLogic->chapterInfo();
        $this->addData('chapter', $chapter);

        $contentLogic = new ContentLogic();
        $content      = $contentLogic->getContent();
        $this->addData('content', $content);

        return view('mobile.content', $this->viewData());
    }
}