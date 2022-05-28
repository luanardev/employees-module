<?php

namespace Luanardev\Modules\Employees\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Notifications\RetirementReminder as Reminder;

class RetirementReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $employments = Employment::getRetiring();

        foreach($employments as $employment){
            $this->notify($employment->staff);
        }
    }

    /**
     * Handle notification login
     *
     * @param Staff $staff
     * @return void
     */
    protected function notify(Staff $staff)
    {
        $reminderDate = Carbon::createFromDate($staff->end_date)->subMonth(); // month before retirement
        $reminder = new Reminder($staff);
        $reminder->delay($reminderDate);
        $staff->notify($reminder);
    }
}
