<?php
/**
 * File: IndexController.php
 *
 * User: huangfuhui
 * Date: 2017/12/2 0:50
 * Email: huangfuhui@outlook.com
 */

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Logics\BookLogic;
use App\Logics\IndexLogic;

class IndexController extends Controller
{
    /**
     * 首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $indexLogic = new IndexLogic();
        $bookTypes  = $indexLogic->bookTypes();
        $this->addData('book_types', $bookTypes);

        return view('mobile.index', $this->viewData());
    }

    /**
     * 书籍类型
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function type()
    {
        $indexLogic = new IndexLogic();
        $bookTypes  = $indexLogic->bookTypes();
        $this->addData('book_types', $bookTypes);

        $bookLogic = new BookLogic();
        $bookList  = $bookLogic->getBookListByType();
        $this->setPage($bookList);

        return view('mobile.type', $this->viewData());
    }
}