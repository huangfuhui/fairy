<?php
/**
 * File: BookLogic.php
 *
 * User: huangfuhui
 * Date: 2018/1/1 11:21
 * Email: huangfuhui@outlook.com
 */

namespace App\Logics;

use App\Constants\BookConstant;
use App\Constants\BookTypeConstant;
use App\Models\AuthorModel;
use App\Models\BookModel;

class BookLogic extends AbstractLogic
{
    /**
     * 根据书籍类型获取书籍列表
     *
     * @return mixed
     */
    public function getBookListByType()
    {
        $type     = $this->type;
        $typeName = BookTypeConstant::BOOK_TYPE[$type];

        if (empty(BookTypeConstant::BOOK_TYPE[$type])) {
            $this->error('书籍类型不存在.');
        }

        $bookList = BookModel::getBookListByType($type)->toArray();

        $bookList['type_name'] = $typeName;

        foreach ($bookList['data'] as &$book) {
            $book['author'] = AuthorModel::getAuthorName($book['author_id']);
            $book['status'] = BookConstant::BOOK_STATUS[$book['status']];
        }

        return $bookList;
    }
}