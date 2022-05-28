<?php

namespace Luanardev\Modules\Employees\Events;
use Luanardev\Modules\Employees\Entities\Staff;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountCreated
{
    use Dispatchable, SerializesModels;

    /**
     *
     * @var Staff
     */
    public Staff $staff;

    /**
     * @var string
     */
    public string $password;

    /**
     * Create a new event instance.
     * @param Staff $staff
     * @param string $password
     * @return void
     */
    public function __construct(Staff $staff, string $password)
    {
        $this->staff = $staff;
        $this->password = $password;
    }

}
