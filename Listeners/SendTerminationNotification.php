<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\Termination;
use Luanardev\Modules\Employees\Notifications\TerminationNotification;
use Luanardev\Modules\Employees\Notifications\Admin\TerminationNotification as AdminNotification;

use EmployeeSettings;

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
        $shouldNotify = (bool)EmployeeSettings::get('send_notification');
        $adminEmail = EmployeeSettings::get('admin_email');

        if($shouldNotify){
            Notification::send(
                $event->employee,
                new TerminationNotification($event->employee)
            );

            Notification::route('mail',$adminEmail)->notify(
                new AdminNotification($event->employee)
            );
        }
    }
}
