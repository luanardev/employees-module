<?php

namespace Luanardev\Modules\Employees\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Luanardev\Modules\Employees\Entities\Employee;

class UserAccountNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *
     * @var Employee
     */
    public Employee $employee;

    /**
     * @var string
     */
    public string $password;

    /**
     * Create a new event instance.
     * @param Employee $employee
     * @param string $password
     * @return void
     */
    public function __construct(Employee $employee, string $password)
    {
        $this->employee = $employee;
        $this->password = $password;
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
                ->markdown('employees::emails.useraccount', [
                    'employee' => $this->employee,
                    'password' => $this->password
                ]);
    }


}
