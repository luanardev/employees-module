<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\EmploymentCreated;
use Luanardev\Modules\Employees\Notifications\EmploymentNotification;
use EmployeeSettings;

class SendEmploymentNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Employment $event
     * @return void
     */
    public function handle(EmploymentCreated $event)
    {
        $shouldNotify = (bool)EmployeeSettings::get('send_notification');

        if($shouldNotify){
            $employment = $event->employment;
            Notification::route('mail',$employment->employee->personal_email)->notify(
                new EmploymentNotification($employment)
            );
        }

    }
}
