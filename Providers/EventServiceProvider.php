<?php

namespace Luanardev\Modules\Employees\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        \Luanardev\Modules\Employees\Events\ProfileCreated::class => [
            \Luanardev\Modules\Employees\Listeners\SendWelcomeNotification::class,
        ],

        \Luanardev\Modules\Employees\Events\ProfileUpdated::class => [
            \Luanardev\Modules\Employees\Listeners\SendProfileNotification::class,
        ],

        \Luanardev\Modules\Employees\Events\EmploymentCreated::class => [
            \Luanardev\Modules\Employees\Listeners\SendEmploymentNotification::class,
            \Luanardev\Modules\Employees\Listeners\CreateUserAccount::class,
        ],

        \Luanardev\Modules\Employees\Events\AccountCreated::class => [
            \Luanardev\Modules\Employees\Listeners\SendUserAccountNotification::class
        ],

        \Luanardev\Modules\Employees\Events\Promotion::class => [
            \Luanardev\Modules\Employees\Listeners\SendPromotionNotification::class
        ],

        \Luanardev\Modules\Employees\Events\Termination::class => [
            \Luanardev\Modules\Employees\Listeners\SendTerminationNotification::class
        ],

        \Luanardev\Modules\Employees\Events\Retirement::class => [
            \Luanardev\Modules\Employees\Listeners\SendRetirementNotification::class
        ],

        \Luanardev\Modules\Employees\Events\Dismissal::class => [
            \Luanardev\Modules\Employees\Listeners\SendDismissalNotification::class
        ],

        \Luanardev\Modules\Employees\Events\Confirmation::class => [
            \Luanardev\Modules\Employees\Listeners\SendConfirmationNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        \Luanardev\Modules\Employees\Entities\Employee::observe(
            \Luanardev\Modules\Employees\Observers\EmployeeObserver::class
        );

        \Luanardev\Modules\Employees\Entities\Employment::observe(
            \Luanardev\Modules\Employees\Observers\EmploymentObserver::class
        );

        \Luanardev\Modules\Employees\Entities\Spouse::observe(
            \Luanardev\Modules\Employees\Observers\SpouseObserver::class
        );

        \Luanardev\Modules\Employees\Entities\Progress::observe(
            \Luanardev\Modules\Employees\Observers\ProgressObserver::class
        );

        \Luanardev\Modules\Employees\Entities\Document::observe(
            \Luanardev\Modules\Employees\Observers\DocumentObserver::class
        );
    }


}
