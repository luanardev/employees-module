<?php

namespace Luanardev\Modules\Employees\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProbationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Interrupt notification when the condition is true
     *
     * @param mixed $notifiable
     * @return bool
     */
    public function shouldInterrupt($notifiable)
    {
        return $this->staff->isNotActive();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('employees::emails.admin.probation');
    }

}
