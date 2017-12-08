<?php
/**
 * @FileName UpdateInfoModel.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/8 上午11:25
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Models;

use App\Entities\UpdateInfo;

class UpdateInfoModel
{
    /**
     * 添加一条更新记录
     *
     * @param int    $bookId
     * @param string $updateTag
     * @param string $address
     *
     * @return bool
     */
    public static function add($bookId, $updateTag, $address)
    {
        $updateInfo             = new UpdateInfo();
        $updateInfo->book_id    = $bookId;
        $updateInfo->update_tag = $updateTag;
        $updateInfo->address    = $address;
        $res                    = $updateInfo->save();

        return $res;
    }

    /**
     * 根据书籍ID获取书籍的更新信息
     *
     * @param int $bookId
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getByBookId($bookId)
    {
        return UpdateInfo::where('book_id', $bookId)->get();
    }
}