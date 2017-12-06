<?php

namespace App\Listeners;

use App\Events\Ant\Chapter;
use App\Events\Ant\Content;
use App\Events\AntEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Ant;

class BookInitLister implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'book-init-event';

    /**
     * 最大重试次数
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  AntEvent $event
     * @return mixed
     */
    public function handle(AntEvent $event)
    {
        $ant        = $event->getAnt();
        $bookId     = $ant->getBookId();
        $requestUrl = $ant->getRequestUrl();
        $attempts   = $this->attempts();

        if ($ant instanceof Content) {
            $chapterName = $ant->getChapterName();
            echo "开始初始化书籍章节内容.   book_id: $bookId, chapter_name: $chapterName" . PHP_EOL;
            $res = Ant::initContent($bookId, $chapterName, $requestUrl);
            $res ? $msg = "第 $attempts 次初始化成功." : $msg = "第 $attempts 次初始化失败";
            echo $msg . PHP_EOL;

            return false;
        } elseif ($ant instanceof Chapter) {
            echo "开始初始化书籍章节信息.   book_id: $bookId" . PHP_EOL;
            $res = Ant::initChapter($bookId, $requestUrl);
            $res ? $msg = "第 $attempts 次初始化成功." : $msg = "第 $attempts 次初始化失败";
            echo $msg . PHP_EOL;

            return false;
        }
    }
}