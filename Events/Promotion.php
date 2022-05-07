<?php

namespace Luanardev\Modules\Employees\Events;
use Luanardev\Modules\Employees\Entities\Progress;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Promotion
{
    use Dispatchable, SerializesModels;

    /**
     *
     * @var Progress
     */
    public Progress $progress;

    /**
     * Create a new event instance.
     * @param Progress $progress
     * @return void
     */
    public function __construct(Progress $progress)
    {
        $this->progress = $progress;
    }

}
