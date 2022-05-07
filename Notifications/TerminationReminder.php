<?php

namespace Luanardev\Modules\Employees\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Luanardev\Modules\Employees\Entities\Employee;

class TerminationReminder extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *
     * @var Employee
     */
    public Employee $employee;

    /**
     * Create a new notification instance.
     * @param Employee $employee
     * @return void
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Interrupt notification when the condition is true
     *
     * @param mixed $notifiable
     * @return bool
     */
    public function shouldInterrupt($notifiable)
    {
        return $this->employee->isNotActive();
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
        return (new MailMessage)
                ->markdown('employees::emails.termination-reminder', [
                    'employee' => $this->employee
                ]);
    }

}
