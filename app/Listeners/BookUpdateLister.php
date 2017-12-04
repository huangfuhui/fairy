<?php

namespace App\Listeners;

use App\Events\AntEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookUpdateLister
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AntEvent  $event
     * @return void
     */
    public function handle(AntEvent $event)
    {
        //
    }
}
