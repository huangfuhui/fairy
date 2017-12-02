<?php
/**
 * File: BookModel.php
 *
 * User: huangfuhui
 * Date: 2017/12/2 23:54
 * Email: huangfuhui@outlook.com
 */

namespace App\Models;

use App\Entities\Book;

class BookModel
{
    /**
     * 初始化书籍信息
     * @param string $name
     * @param int $authorId
     * @param int $typeId
     * @param string $profile
     * @param string $coverId
     * @param int $status
     * @return bool
     */
    public static function initBook($name, $authorId, $typeId, $profile = '', $coverId = '', $status = 0)
    {
        $book            = new Book();
        $book->name      = $name;
        $book->author_id = $authorId;
        $book->type_id   = $typeId;
        $book->profile   = $profile;
        $book->cover_id  = $coverId;
        $book->status    = $status;

        return $book->save();
    }

    /**
     * 查询书籍信息
     * @param $id
     * @return mixed
     */
    public static function getBook($id)
    {
        return Book::find($id);
    }
}