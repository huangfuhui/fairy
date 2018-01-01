<?php
/**
 * File: mobile.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 10:40
 * Email: huangfuhui@outlook.com
 */

Route::get('/mobile/error', 'ErrorController@error')->name('mobile_error');


Route::get('/mobile/index', 'IndexController@index')->name('mobile_index');
Route::get('/mobile/type', 'IndexController@type')->name('mobile_type');
