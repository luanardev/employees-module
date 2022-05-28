<?php

namespace Luanardev\Modules\Employees\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Notifications\TerminationReminder as Reminder;


class TerminationReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $employments = Employment::getTerminating();

        // send reminder to HRM department


        // send reminders to employees
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
        $reminderDate = Carbon::createFromDate($staff->end_date)->subMonth(); // month before termination
        $reminder = new Reminder($staff);
        $reminder->delay($reminderDate);
        $staff->notify($reminder);
    }
}
