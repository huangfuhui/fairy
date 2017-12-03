<?php
/**
 * File: AntFacade.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 10:34
 * Email: huangfuhui@outlook.com
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AntFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ant';
    }
}