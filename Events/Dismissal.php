<?php

namespace Luanardev\Modules\Employees\Events;
use Luanardev\Modules\Employees\Entities\Staff;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Dismissal
{
    use Dispatchable, SerializesModels;

    /**
     *
     * @var Staff
     */
    public Staff $staff;

    /**
     * Create a new event instance.
     * @param Staff $staff
     * @return void
     */
    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

}
