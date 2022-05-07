<?php

namespace Luanardev\Modules\Employees\Console;

use Illuminate\Console\Command;
use Luanardev\Modules\Employees\Jobs\ContractTermination;

class TerminateContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:terminate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Terminate contracts which are due.';

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
        ContractTermination::dispatch();
    }


}
