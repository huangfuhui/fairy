<?php
/**
 * @FileName Ant.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/4 下午6:28
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Events\Ant;


abstract class Ant
{
    /**
     * 书籍ID
     * @var string
     */
    private $bookId = '';

    /**
     * 请求URL
     * @var string
     */
    private $requestUrl = '';

    /**
     * @return string
     */
    public function getBookId(): string
    {
        return $this->bookId;
    }

    /**
     * @param string $bookId
     */
    public function setBookId(string $bookId)
    {
        $this->bookId = $bookId;
    }

    /**
     * @return string
     */
    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    /**
     * @param string $requestUrl
     */
    public function setRequestUrl(string $requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }
}