<?php
/**
 * File: Author.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 0:13
 * Email: huangfuhui@outlook.com
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Entities\Author
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Author onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Author withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Author withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name 笔名
 * @property string|null $real_name 真实姓名
 * @property string $profile 简介
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Author whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Author whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Author whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Author whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Author whereUpdatedAt($value)
 */
class Author extends Model
{
    use SoftDeletes;

    protected $table = 'author';
}