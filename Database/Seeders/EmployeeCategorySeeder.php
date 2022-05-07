<?php

namespace Luanardev\Modules\Employees\Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeCategorySeeder extends Seeder
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
            REPLACE INTO `hrm_employee_category` (`id`, `name`) VALUES
            (1, 'Administrative'),
            (2, 'Academic'),
            (3, 'Support');
        SQL;
    }
}
