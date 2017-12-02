<?php
/**
 * File: AuthorModel.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 0:15
 * Email: huangfuhui@outlook.com
 */

namespace App\Models;

use App\Entities\Author;

class AuthorModel
{
    /**
     * 初始化作者信息
     * @param string $name
     * @param string $profile
     * @param string $realName
     * @return bool
     */
    public static function initAuthor($name, $profile = '', $realName = '')
    {
        $author            = new Author();
        $author->name      = $name;
        $author->real_name = $realName;
        $author->profile   = $profile;

        return $author->save();
    }

    /**
     * 根据ID查询作者笔名
     * @param int $id
     * @return mixed
     */
    public static function getAuthorName($id)
    {
        return Author::where('id', $id)->value('name');
    }
}