<?php

namespace Luanardev\Modules\Employees\Database\Seeders;

use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
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
            REPLACE INTO `hrm_grades` (`id`, `grade`, `gross_salary`, `leave_days`) VALUES
            (1, 'A', NULL, 21),
            (2, 'B', NULL, 21),
            (3, 'C', NULL, 21),
            (4, 'D', NULL, 24),
            (5, 'E', NULL, 24),
            (6, 'F', NULL, 24),
            (7, 'G', NULL, 24),
            (8, 'H', NULL, 30),
            (9, 'I', NULL, 30),
            (10, 'J', NULL, 30),
            (11, 'K', NULL, 30),
            (12, 'L', NULL, 30),
            (13, 'M', NULL, 30),
            (14, 'N', NULL, 30),
            (15, 'O', NULL, 30),
            (16, 'P', NULL, 30),
            (17, 'Q', NULL, 30),
            (18, 'R', NULL, 30);
        SQL;
    }
}
