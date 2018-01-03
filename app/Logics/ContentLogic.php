<?php
/**
 * File: ContentLogic.php
 *
 * User: huangfuhui
 * Date: 2018/1/1 23:46
 * Email: huangfuhui@outlook.com
 */

namespace App\Logics;

use App\Models\BookModel;
use App\Models\ContentModel;

class ContentLogic extends AbstractLogic
{
    /**
     * 获取书籍章节内容
     *
     * @return string
     */
    public function getContent()
    {
        $contentId = $this->content_id;

        $content = ContentModel::get($contentId);

        if (empty($content)) {
            $this->error('道友，当前章节已遗失多年.');
        }

        return $content;
    }
}