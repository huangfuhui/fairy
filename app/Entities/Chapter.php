<?php
/**
 * File: Chapter.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 17:20
 * Email: huangfuhui@outlook.com
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Chapter
 *
 * @property int $id
 * @property int $book_id 书籍ID
 * @property string $name 章节名
 * @property string|null $content_id 内容ID
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Chapter whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Chapter whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Chapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Chapter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Chapter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Chapter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Chapter extends Model
{
    protected $table = 'chapter';
}