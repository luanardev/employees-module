<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\AccountCreated;
use Luanardev\Modules\Employees\Notifications\UserAccountNotification;
use StaffConfig;

class SendUserAccountNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param AccountCreated $event
     * @return void
     */
    public function handle(AccountCreated $event)
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');
        
        if($shouldNotify){
            Notification::route('mail',$event->staff->personal_email)->notify(
                new UserAccountNotification($event->staff, $event->password)
            );
        }
    }
}
