<?php
/**
 * @FileName IndexLogic.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/12 下午5:55
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Logics;

use App\Constants\BookTypeConstant;
use App\Logics\AbstractLogic;

class IndexLogic extends AbstractLogic
{
    /**
     * 获取书籍所有类型
     *
     * @return array
     */
    public function bookTypes()
    {
        $bookType = BookTypeConstant::BOOK_TYPE;
        array_shift($bookType);

        return $bookType;
    }
}