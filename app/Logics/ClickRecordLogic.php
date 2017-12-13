<?php
/**
 * @FileName ClickRecordLogic.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/13 下午5:41
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Logics;

use App\Entities\ClickRecord;

class ClickRecordLogic extends AbstractLogic
{
    public function getTopClick()
    {
        $clickRecords = ClickRecord::orderBy('click')->limit(20)->get();
    }
}