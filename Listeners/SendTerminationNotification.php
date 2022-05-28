<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\Termination;
use Luanardev\Modules\Employees\Notifications\TerminationNotification;
use Luanardev\Modules\Employees\Notifications\Admin\TerminationNotification as AdminNotification;
use StaffConfig;

class SendTerminationNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Termination $event
     * @return void
     */
    public function handle(Termination $event)
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');
        $adminEmail = StaffConfig::get('admin_email');

        if($shouldNotify){
            Notification::send(
                $event->staff,
                new TerminationNotification($event->staff)
            );

            Notification::route('mail',$adminEmail)->notify(
                new AdminNotification($event->staff)
            );
        }
    }
}
