<?php

namespace Luanardev\Modules\Employees\Events;
use Luanardev\Modules\Employees\Entities\Employee;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountCreated
{
    use Dispatchable, SerializesModels;

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

}
