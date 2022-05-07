<?php

namespace Luanardev\Modules\Employees\Console;

use Illuminate\Console\Command;
use Luanardev\Modules\Employees\Jobs\JobRetirement;

class ProcessRetirement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:retire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retire Employee whose retirement period is due.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        JobRetirement::dispatch();
    }


}
