<?php
/**
 * File: BookTypeConstant.php
 *
 * User: huangfuhui
 * Date: 2017/12/2 23:14
 * Email: huangfuhui@outlook.com
 */

namespace App\Constants;


final class BookTypeConstant
{
    const OTHER     = 0;
    const FANTASY   = 1;
    const GOD       = 2;
    const SWORDSMAN = 3;
    const SCIENCE   = 4;
    const CITY      = 5;
    const HISTORY   = 6;
    const SPORTS    = 7;
    const GAME      = 8;

    const BOOK_TYPE = [
        self::OTHER     => '其它',
        self::FANTASY   => '玄幻',
        self::GOD       => '修真',
        self::SWORDSMAN => '武侠',
        self::SCIENCE   => '科幻',
        self::CITY      => '都市',
        self::HISTORY   => '历史',
        self::SPORTS    => '体育',
        self::GAME      => '游戏',
    ];
}