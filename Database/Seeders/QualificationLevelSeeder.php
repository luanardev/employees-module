<?php

namespace Luanardev\Modules\Employees\Database\Seeders;

use Illuminate\Database\Seeder;

class QualificationLevelSeeder extends Seeder
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
            REPLACE INTO `hrm_qualification_level` (`id`, `name`) VALUES
            (1, 'PhD'),
            (2, 'Masters'),
            (3, 'Postgraduate Diploma'),
            (4, 'Honors Degree'),
            (5, 'Bachelors Degree'),
            (6, 'Advanced Diploma'),
            (7, 'Diploma'),
            (8, 'Professional Certificate'),
            (9, 'University Certificate'),
            (10, 'College Certificate'),
            (11, 'Secondary Education Certificate'),
            (12, 'Junior Education Certificate'),
            (13, 'Primary Education Certificate');
        SQL;
    }
}
