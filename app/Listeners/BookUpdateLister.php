<?php

namespace App\Listeners;

use App\Events\Ant\Book;
use App\Events\AntEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Ant;
use Illuminate\Support\Facades\Log;

class BookUpdateLister implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'book-update-event';

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
     * @return bool
     */
    public function handle(AntEvent $event)
    {
        $ant        = $event->getAnt();
        $bookId     = $ant->getBookId();
        $requestUrl = $ant->getRequestUrl();
        $attempts   = $this->attempts();

        if ($ant instanceof Book) {
            echo "[第 $attempts 次]开始初始化书籍信息.   book_url: $requestUrl" . PHP_EOL;
            $res = Ant::initBook($requestUrl);
            $res ? $msg = "[第 $attempts 次]初始化成功." : $msg = "[第 $attempts 次]初始化失败. http_err：" . Ant::getErrMsg();
            echo $msg . PHP_EOL;

            if (!$res) {
                $wait = $attempts * random_int(1, 10);
                $wait < 300 ? null : $wait = 300;
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
