<?php
/**
 * File: ant.php
 *
 * User: huangfuhui
 * Date: 2017/12/3 11:01
 * Email: huangfuhui@outlook.com
 */

return [
    'base_uri'     => 'http://www.biquge5200.com',
    'search_uri'   => 'http://www.biquge5200.com/modules/article/search.php?searchkey=',
    'cover_dir'    => 'covers/',
    'cover_suffix' => 'jpg',

    'pattern' => [
        'book'   => [
            'name'             => '[<meta property="og:title" content="(.*)"/>]',
            'author'           => '[<meta property="og:novel:author" content="(.*)"/>]',
            'profile'          => '[<meta property="og:description" content="(.*)"/>]',
            'type'             => '[<meta property="og:novel:category" content="(.*)"/>]',
            'cover'            => '[<meta property="og:image" content="(.*)"/>]',
            'status'           => '[<meta property="og:novel:status" content="(.*)"/>]',
            'chapter_contents' => '[<dt>.*正文</dt>(.*)</dl>]s',
            'chapter_list'     => '[<dd><a href="(.*)">(.*)</a></dd>]',
            'content'          => '[<div id="content">(.*?)</div>]s',
        ],
        'search' => [
            'result' => '[<tr>.*?<td class="odd"><a href="(.*?)">(.*?)</a></td>.*?<td class="odd">(.*?)</td>.*?</tr>]s',
        ],
    ],
];