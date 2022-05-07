<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\ProfileCreated;
use Luanardev\Modules\Employees\Notifications\WelcomeNotification;
use EmployeeSettings;

class SendWelcomeNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param ProfileCreated $event
     * @return void
     */
    public function handle(ProfileCreated $event)
    {
        $shouldNotify = (bool)EmployeeSettings::get('send_notification');
        
        if($shouldNotify){
            Notification::route('mail',$event->employee->personal_email)->notify(
                new WelcomeNotification($event->employee)
            );
        }
    }
}
