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
use Luanardev\Modules\Employees\Notifications\Admin\ProbationNotification;
use EmployeeSettings;

class ProbationReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $probation = Employment::getProbation();

        if($probation->count() > 0){
            $adminEmail = EmployeeSettings::get('admin_email');
            Notification::route('mail',$adminEmail)->notify(
                new ProbationNotification()
            );
        }

        
    }


}
