<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\Dismissal;
use Luanardev\Modules\Employees\Notifications\DismissalNotification;
use StaffConfig;

class SendDismissalNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Dismissal $event
     * @return void
     */
    public function handle(Dismissal $event)
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');

        if($shouldNotify){
            Notification::send(
                $event->staff,
                new DismissalNotification($event->staff)
            );
        }
    }
}
