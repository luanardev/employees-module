<?php

namespace Luanardev\Modules\Employees\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Luanardev\Modules\Employees\Entities\Progress;

class PromotionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *
     * @var Progress
     */
    public Progress $progress;

    /**
     * Create a new event instance.
     * @param Progress $progress
     * @return void
     */
    public function __construct(Progress $progress)
    {
        $this->progress= $progress;
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
                ->markdown('employees::emails.promotion', [
                    'progress' => $this->progress
                ]);
    }


}
