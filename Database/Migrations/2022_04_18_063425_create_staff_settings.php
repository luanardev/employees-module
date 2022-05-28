<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;
use Spatie\LaravelSettings\Migrations\SettingsBlueprint;

class CreateStaffSettings extends SettingsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->migrator->inGroup('staff', function (SettingsBlueprint $blueprint): void {
            $blueprint->add('probation_period', 1);
            $blueprint->add('contract_period', 5);
            $blueprint->add('service_period', 20);
            $blueprint->add('retirement_age', 60);
            $blueprint->add('appointment_term', 2);
            $blueprint->add('email_domain', 'example.com');
            $blueprint->add('admin_email', 'admin@example.com');
            $blueprint->add('create_staff_email', true);
            $blueprint->add('create_staff_account', true);
            $blueprint->add('send_notification', true);
            $blueprint->add('send_reminder', true);
        });
    }

     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->migrator->inGroup('staff', function (SettingsBlueprint $blueprint): void {
            $blueprint->delete('probation_period');
            $blueprint->delete('contract_period');
            $blueprint->delete('service_period');
            $blueprint->delete('retirement_age');
            $blueprint->delete('appointment_term');
            $blueprint->delete('email_domain');
            $blueprint->delete('admin_email');
            $blueprint->delete('create_staff_email');
            $blueprint->delete('create_staff_account');
            $blueprint->delete('send_notification');
            $blueprint->delete('send_reminder');
        });
    }

}
