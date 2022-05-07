<?php

namespace Luanardev\Modules\Employees\Observers;

use Luanardev\Modules\Employees\Entities\Spouse;

class SpouseObserver
{
    /**
     * Handle the Spouse "created" event.
     *
     * @param  Spouse  $spouse
     * @return void
     */
    public function created(Spouse $spouse)
    {
        $spouse->employee->update(['marital_status' => 'Married']);
    }

    /**
     * Handle the Spouse "deleted" event.
     *
     * @param  Spouse  $spouse
     * @return void
     */
    public function deleted(Spouse $spouse)
    {
        $spouse->employee->update(['marital_status' => 'Single']);
    }

}
