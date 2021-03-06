<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\ProfileCreated;
use Luanardev\Modules\Employees\Notifications\WelcomeNotification;
use StaffConfig;

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
        $shouldNotify = (bool)StaffConfig::get('send_notification');
        
        if($shouldNotify){
            Notification::route('mail',$event->staff->personal_email)->notify(
                new WelcomeNotification($event->staff)
            );
        }
    }
}
