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
    const U_SLEEP               = 300000;                   // 睡眠等待时间，单位微秒
    const U_SLEEP_SUGGEST_LIMIT = 500000;                   // 睡眠等待建议时间，单位微秒
    const U_SLEEP_UPPER_LIMIT   = 1000000;                  // 睡眠等待时间上限，单位微秒
    const WAIT_LOWER_LIMIT      = 0;                        // 任务重试等待时间下限，单位秒
    const WAIT_UPPER_LIMIT      = 500;                      // 任务重试等待时间上限，单位秒

    const RESPONSE_LEVEL_NORMAL = 0;                        // 正常
    const RESPONSE_LEVEL_BUSY   = 1;                        // 拥挤
    const RESPONSE_LEVEL_HEAVY  = 2;                        // 繁重
    const RESPONSE_LEVEL_DOWN   = 3;                        // 无响应

    const RESPONSE_LEVEL = [
        self::RESPONSE_LEVEL_NORMAL => '服务正常',
        self::RESPONSE_LEVEL_BUSY   => '服务拥挤',
        self::RESPONSE_LEVEL_HEAVY  => '服务繁重',
        self::RESPONSE_LEVEL_DOWN   => '服务无响应',
    ];
}