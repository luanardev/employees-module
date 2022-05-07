<?php

namespace Luanardev\Modules\Employees\Settings;

use Luanardev\Settings\Settings;


class EmployeeSettings extends Settings
{
    public int $probation_period;
    public int $contract_period;
    public int $service_period;
    public int $retirement_age;
    public int $appointment_term;
    public string $email_domain;
    public string $admin_email;
    public bool $create_staff_email;
    public bool $create_staff_account;
    public bool $send_notification;
    public bool $send_reminder;

    public static function group(): string
    {
        return 'employee';
    }

}
