<?php

namespace Luanardev\Modules\Employees\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Luanardev\Modules\Employees\Entities\Employee;

class UserAccount extends Mailable
{
    use Queueable, SerializesModels;

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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('employees::emails.useraccount');
    }
}
