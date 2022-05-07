<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\ProfileUpdated;
use Luanardev\Modules\Employees\Notifications\ProfileUpdateNotification;
use EmployeeSettings;

class SendProfileNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param ProfileUpdated $event
     * @return void
     */
    public function handle(ProfileUpdated $event)
    {
        $shouldNotify = (bool)EmployeeSettings::get('send_notification');

        if($shouldNotify){
            Notification::send(
                $event->employee,
                new ProfileUpdateNotification($event->employee)
            );
        }
    }
}
