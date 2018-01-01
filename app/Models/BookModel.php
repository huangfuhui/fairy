<?php
/**
 * File: BookModel.php
 *
 * User: huangfuhui
 * Date: 2017/12/2 23:54
 * Email: huangfuhui@outlook.com
 */

namespace App\Models;

use App\Constants\BookConstant;
use App\Entities\Book;

class BookModel
{
    /**
     * 初始化书籍信息
     *
     * @param string $name
     * @param int    $authorId
     * @param int    $typeId
     * @param string $profile
     * @param string $cover
     * @param int    $status
     * @return int
     */
    public static function initBook($name, $authorId, $typeId, $profile = '', $cover = '', $status = 0)
    {
        $book            = new Book();
        $book->name      = $name;
        $book->author_id = $authorId;
        $book->type_id   = $typeId;
        $book->profile   = $profile;
        $book->cover     = $cover;
        $book->status    = $status;
        $res             = $book->save();

        if ($res) {
            return $book->id;
        } else {
            return 0;
        }
    }

    /**
     * 查询书籍信息
     *
     * @param $id
     * @return mixed
     */
    public static function getBook($id)
    {
        return Book::find($id);
    }

    /**
     * 判断书籍是否存在
     *
     * @param string $name
     * @param int    $authorId
     * @return bool
     */
    public static function existBook($name, $authorId)
    {
        return Book::where('name', $name)->where('author_id', $authorId)->exists();
    }

    /**
     * 根据书籍类型查询书籍
     *
     * @param int $typeId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getBookListByType($typeId)
    {
        return Book::where('type_id', $typeId)->orderBy('updated_at', 'desc')->paginate(BookConstant::PAGINATE);
    }
}