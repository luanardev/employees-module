<?php

namespace Luanardev\Modules\Employees\Providers;

use Illuminate\Support\ServiceProvider;
use Luanardev\Modules\Employees\Console\RemindTermination;
use Luanardev\Modules\Employees\Console\RemindRetirement;
use Luanardev\Modules\Employees\Console\RemindProbation;
use Luanardev\Modules\Employees\Console\ProcessRetirement;
use Luanardev\Modules\Employees\Console\TerminateContract;
use Luanardev\Modules\Employees\Console\DismissAppointment;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                RemindTermination::class,
                RemindRetirement::class,
                RemindProbation::class,
                ProcessRetirement::class,
                TerminateContract::class,
                DismissAppointment::class
            ]);
        }

    }
}
