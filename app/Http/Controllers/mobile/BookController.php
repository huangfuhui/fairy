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

class BookController extends Controller
{
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

    public function content()
    {
        return view('mobile.content', $this->viewData());
    }
}