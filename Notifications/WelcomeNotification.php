<?php

namespace Luanardev\Modules\Employees\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Luanardev\Modules\Employees\Entities\Staff;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *
     * @var Staff
     */
    public Staff $staff;

    /**
     * Create a new notification instance.
     * @param Staff $staff
     * @return void
     */
    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
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
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->markdown('employees::emails.welcome', [
                    'staff' => $this->staff
                ]);
    }


}
