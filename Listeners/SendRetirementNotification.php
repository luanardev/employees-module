<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\Retirement;
use Luanardev\Modules\Employees\Notifications\RetirementNotification;
use Luanardev\Modules\Employees\Notifications\Admin\RetirementNotification as AdminNotification;
use EmployeeSettings;

class SendRetirementNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Retirement $event
     * @return void
     */
    public function handle(Retirement $event)
    {
        $shouldNotify = (bool)EmployeeSettings::get('send_notification');
        $adminEmail = EmployeeSettings::get('admin_email');

        if($shouldNotify){
            Notification::send(
                $event->employee,
                new RetirementNotification($event->employee)
            );

            Notification::route('mail',$adminEmail)->notify(
                new AdminNotification($event->employee)
            );
        }
    }
}
