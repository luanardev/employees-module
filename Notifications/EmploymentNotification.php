<?php

namespace Luanardev\Modules\Employees\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Luanardev\Modules\Employees\Entities\Employment;

class EmploymentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *
     * @var Employment
     */
    public Employment $employment;

    /**
     * Create a new notification instance.
     * @param Employment $employment
     * @return void
     */
    public function __construct(Employment $employment)
    {
        $this->employment = $employment;
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
                ->markdown('employees::emails.employment', [
                    'employment' => $this->employment
                ]);
    }


}
