<?php

namespace Luanardev\Modules\Employees\Events;
use Luanardev\Modules\Employees\Entities\Staff;
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
     * @var Staff
     */
    public Staff $staff;

    /**
     * Create a new event instance.
     * @param Employment $employment
     * @return void
     */
    public function __construct(Employment $employment)
    {
        $this->employment = $employment;
        $this->staff = $employment->staff;
    }

}
