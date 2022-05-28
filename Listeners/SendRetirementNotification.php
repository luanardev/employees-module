<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Luanardev\Modules\Employees\Events\Retirement;
use Luanardev\Modules\Employees\Notifications\RetirementNotification;
use Luanardev\Modules\Employees\Notifications\Admin\RetirementNotification as AdminNotification;
use StaffConfig;

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
        $shouldNotify = (bool)StaffConfig::get('send_notification');
        $adminEmail = StaffConfig::get('admin_email');

        if($shouldNotify){
            Notification::send(
                $event->staff,
                new RetirementNotification($event->staff)
            );

            Notification::route('mail',$adminEmail)->notify(
                new AdminNotification($event->staff)
            );
        }
    }
}
