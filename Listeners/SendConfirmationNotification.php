<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\Confirmation;
use Luanardev\Modules\Employees\Notifications\ConfirmationNotification;
use EmployeeSettings;

class SendConfirmationNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Confirmation $event
     * @return void
     */
    public function handle(Confirmation $event)
    {
        $shouldNotify = (bool)EmployeeSettings::get('send_notification');

        if($shouldNotify){

            Notification::send(
                $event->employee,
                new ConfirmationNotification($event->employee)
            );
        }
    }
}
