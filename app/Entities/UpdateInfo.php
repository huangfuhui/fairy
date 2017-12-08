<?php
/**
 * @FileName UpdateInfo.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/8 上午11:24
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\updateInfo
 *
 * @property int $id
 * @property int $book_id 书籍ID
 * @property string $update_tag 更新标志
 * @property string $address 更新地址
 * @property string|null $backup_address_a 备用地址A
 * @property string|null $backup_address_b 备用地址B
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\updateInfo whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\updateInfo whereBackupAddressA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\updateInfo whereBackupAddressB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\updateInfo whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\updateInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\updateInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\updateInfo whereUpdateTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\updateInfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class updateInfo extends Model
{
    protected $table = 'update_info';
}