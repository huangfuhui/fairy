<?php
/**
 * @FileName AntConstant.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/7 上午9:48
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Constants;

class AntConstant
{
    const U_SLEEP          = 50000;                 // 睡眠等待时间，单位微妙
    const WAIT_LOWER_LIMIT = 0;                     // 任务重试等待时间下限，单位秒
    const WAIT_UPPER_LIMIT = 500;                   // 任务重试等待时间上限，单位秒
}