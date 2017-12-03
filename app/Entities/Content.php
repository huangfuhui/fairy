<?php
/**
 * File: Content.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 17:20
 * Email: huangfuhui@outlook.com
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Content
 *
 * @property int $id
 * @property string $content_id 内容ID
 * @property string $content 内容
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Content whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Content whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Content whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Content extends Model
{
    protected $table = 'content';
}