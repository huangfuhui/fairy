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
use App\Logics\mobile\IndexLogic;

class IndexController extends Controller
{
    public function index()
    {
        $logic = new IndexLogic();

        return view('mobile.index');
    }
}