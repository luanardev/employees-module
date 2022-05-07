<?php

namespace Luanardev\Modules\Employees\Concerns;

trait WithEmailNotification
{
    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array|string
     */
    public function routeNotificationForMail($notification)
    {
        if($this->wasRecentlyCreated ===true){
            return $this->personal_email;
        }
        else{
            return $this->official_email;
        }
    }
}
