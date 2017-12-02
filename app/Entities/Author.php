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
 */
class Author extends Model
{
    use SoftDeletes;

    protected $table = 'author';
}