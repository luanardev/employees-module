<?php

namespace Luanardev\Modules\Employees\Database\Seeders;

use Illuminate\Database\Seeder;

class EmploymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement($this->query());
    }

    private function query()
    {
        return <<<SQL
            REPLACE INTO `hrm_employment_status` (`id`, `name`) VALUES
            (1, 'Serving'),
            (2, 'Probation'),
            (3, 'Retired'),
            (4, 'Resigned'),
            (5, 'Deceased'),
            (6, 'Dismissed'),
            (7, 'Terminated'),
            (8, 'Onleave');
        SQL;
    }
}
