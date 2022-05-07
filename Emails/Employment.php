<?php

namespace Luanardev\Modules\Employees\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Luanardev\Modules\Employees\Entities\Employee;

class Employment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *
     * @var Employee
     */
    public Employee $employee;

    /**
     * Create a new message instance.
     * @param Employee $employee
     * @return void
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('employees::emails.employment');
    }
}
