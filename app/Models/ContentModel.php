<?php
/**
 * File: ContentModel.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 17:22
 * Email: huangfuhui@outlook.com
 */

namespace App\Models;

use App\Entities\Content;

class ContentModel
{
    /**
     * 新增书籍章节内容
     *
     * @param string $contentId
     * @param string $contents
     * @return int
     */
    public static function add($contentId, $contents)
    {
        $content             = new Content();
        $content->content_id = $contentId;
        $content->content    = $contents;
        $res                 = $content->save();

        if ($res) {
            return $content->id;
        } else {
            return 0;
        }
    }

    /**
     * 获取书籍章节内容
     *
     * @param string $contentId
     * @return mixed
     */
    public static function get($contentId)
    {
        return Content::where('content_id', $contentId)->value('content');
    }

    /**
     * 判断章节内容是否存在
     *
     * @param string $contentId
     * @return bool
     */
    public static function existContent($contentId)
    {
        return Content::where('content_id', $contentId)->exists();
    }

    /**
     * 更新书籍章节内容
     *
     * @param string $contentId
     * @param string $contents
     * @return bool
     */
    public static function update($contentId, $contents)
    {
        return Content::where('content_id', $contentId)->update(['content' => $contents]);
    }
}