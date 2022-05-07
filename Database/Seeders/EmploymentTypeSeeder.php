<?php

namespace Luanardev\Modules\Employees\Database\Seeders;

use Illuminate\Database\Seeder;

class EmploymentTypeSeeder extends Seeder
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
            REPLACE INTO `hrm_employment_type` (`id`, `name`) VALUES
            (1, 'Permanent'),
            (2, 'Contract'),
            (3, 'Part time'),
            (4, 'Secondment'),
            (5, 'Adjunct'),
            (6, 'Temporary'),
            (7, 'Internship');
        SQL;
    }
}
