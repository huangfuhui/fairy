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
 */
class Book extends Model
{
    use SoftDeletes;

    protected $table = 'book';
}