<?php
/**
 * File: BookConstant.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 15:45
 * Email: huangfuhui@outlook.com
 */

namespace App\Constants;

final class BookConstant
{
    const PAGINATE = 20;                        // 书籍列表分页，每页显示条数

    const SERIAL = 0;
    const END    = 1;

    const BOOK_STATUS = [
        self::SERIAL => '连载',
        self::END    => '完本',
    ];
}