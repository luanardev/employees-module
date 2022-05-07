<?php

namespace Luanardev\Modules\Employees\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Luanardev\Modules\Employees\Entities\Employment;

class AppointmentDismissal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $appointments = Employment::getDismissingToday();

        foreach($appointments as $appointment){
            $appointment->dismiss();
        }
    }

}
