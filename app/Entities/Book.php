<?php
/**
 * File: Book.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 0:04
 * Email: huangfuhui@outlook.com
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Entities\Book
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Entities\Book withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name 书名
 * @property int $author_id 作者ID
 * @property string|null $profile 书籍简介
 * @property string|null $cover 封面URL
 * @property int $type_id 书籍类型ID
 * @property int $status 书籍状态，(0：连载，1：完结)
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Book whereUpdatedAt($value)
 */
class Book extends Model
{
    use SoftDeletes;

    protected $table = 'book';
}