<?php

namespace Luanardev\Modules\Employees\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Luanardev\Modules\Employees\Jobs\ProbationReminder;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('contract:reminder')->monthly();
            $schedule->command('retirement:reminder')->monthly();
            $schedule->command('probation:reminder')->monthly();
            $schedule->command('employee:retire')->monthly();
            $schedule->command('contract:terminate')->monthly();
            $schedule->command('appointment:terminate')->monthly();
        });
    }

}
