<?php

namespace App\Listeners;

use App\Constants\AntConstant;
use App\Events\Ant\Chapter;
use App\Events\Ant\Content;
use App\Events\AntEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Ant;
use Illuminate\Support\Facades\Log;

class BookInitLister implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'book-init-event';

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
     *
     * @return mixed
     */
    public function handle(AntEvent $event)
    {
        $ant        = $event->getAnt();
        $bookId     = $ant->getBookId();
        $requestUrl = $ant->getRequestUrl();
        $attempts   = $this->attempts();

        if ($ant instanceof Content) {
            // 任务重试预等待时间
            $uSleep = $attempts * AntConstant::U_SLEEP;
            $uSleep > AntConstant::U_SLEEP_UPPER_LIMIT ? $uSleep = AntConstant::U_SLEEP_UPPER_LIMIT : null;
            usleep($uSleep);

            $chapterName = $ant->getChapterName();
            echo "[第 $attempts 次]开始初始化书籍章节内容.   book_id: $bookId, chapter_name: $chapterName" . PHP_EOL;
            $res = Ant::initContent($bookId, $chapterName, $requestUrl);
            $res ? $msg = "[第 $attempts 次]初始化成功." : $msg = "[第 $attempts 次]初始化失败. http_err：" . Ant::getErrMsg();
            echo $msg . PHP_EOL;

            if (!$res) {
                $wait = $attempts * random_int(10, 50);
                $wait < AntConstant::WAIT_UPPER_LIMIT ? null : $wait = AntConstant::WAIT_UPPER_LIMIT;
                echo "等待 $wait 秒后重试" . PHP_EOL;

                $this->release($wait);
            }

            return false;
        } elseif ($ant instanceof Chapter) {
            echo "[第 $attempts 次]开始初始化书籍章节信息.   book_id: $bookId" . PHP_EOL;
            $res = Ant::initChapter($bookId, $requestUrl);
            $res ? $msg = "[第 $attempts 次]初始化成功." : $msg = "[第 $attempts 次]初始化失败. http_err：" . Ant::getErrMsg();
            echo $msg . PHP_EOL;

            if (!$res) {
                $wait = $attempts * random_int(1, 10);
                $wait < AntConstant::WAIT_UPPER_LIMIT ? null : $wait = AntConstant::WAIT_UPPER_LIMIT;
                echo "等待 $wait 秒后重试" . PHP_EOL;

                $this->release($wait);
            }

            return false;
        }
    }

    /**
     * @param AntEvent $event
     * @param          $exception
     */
    public function failed(AntEvent $event, $exception)
    {
        Log::info('任务异常：' . $exception->getMessage());
    }
}
