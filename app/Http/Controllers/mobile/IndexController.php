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
use App\Logics\IndexLogic;

class IndexController extends Controller
{
    public function index()
    {
        $logic = new IndexLogic();

        $bookTypes = $logic->bookTypes();

        $this->addData('book_types', $bookTypes);

        return view('mobile.index', $this->viewData());
    }
}