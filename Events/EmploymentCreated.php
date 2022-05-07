<?php

namespace Luanardev\Modules\Employees\Events;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\Employment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmploymentCreated
{
    use Dispatchable, SerializesModels;

    /**
     *
     * @var Employment
     */
    public Employment $employment;

    /**
     *
     * @var Employee
     */
    public Employee $employee;

    /**
     * Create a new event instance.
     * @param Employment $employment
     * @return void
     */
    public function __construct(Employment $employment)
    {
        $this->employment = $employment;
        $this->employee = $employment->employee;
    }

}
