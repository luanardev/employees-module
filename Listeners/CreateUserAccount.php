<?php

namespace Luanardev\Modules\Employees\Listeners;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use Luanardev\Modules\Employees\Events\EmploymentCreated;
use App\Models\User;
use StaffConfig;


class CreateUserAccount implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param EmploymentCreated $event
     * @return void
     */
    public function handle(EmploymentCreated $event)
    {
        $shouldCreate = (bool)StaffConfig::get('create_staff_account');

        if($shouldCreate){
            $event->staff->createAccount();
        }

    }


}
