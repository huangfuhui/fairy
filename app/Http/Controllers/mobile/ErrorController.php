<?php
/**
 * File: ErrorController.php
 *
 * User: huangfuhui
 * Date: 2018/1/1 11:30
 * Email: huangfuhui@outlook.com
 */

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    /**
     * 错误页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function error(Request $request)
    {
        $errorMsg = $request->input('err_msg');

        return view('mobile.error', ['err_msg' => $errorMsg]);
    }
}