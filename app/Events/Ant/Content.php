<?php
/**
 * @FileName Content.php
 *
 * @Author: huangfuhui
 * @Date: 2017/12/4 下午7:07
 * @Email: huangfuhui@meimeifa.com
 */

namespace App\Events\Ant;


class Content extends Ant
{
    /**
     * 章节名
     * @var string
     */
    private $chapterName = '';

    /**
     * @return string
     */
    public function getChapterName(): string
    {
        return $this->chapterName;
    }

    /**
     * @param string $chapterName
     */
    public function setChapterName(string $chapterName)
    {
        $this->chapterName = $chapterName;
    }
}