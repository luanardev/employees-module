<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\Promotion;
use Luanardev\Modules\Employees\Notifications\PromotionNotification;
use StaffConfig;

class SendPromotionNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Promotion $event
     * @return void
     */
    public function handle(Promotion $event)
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');

        if($shouldNotify){
            Notification::send(
                $event->progress->staff,
                new PromotionNotification($event->progress)
            );
        }
    }
}
