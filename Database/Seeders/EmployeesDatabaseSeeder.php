<?php

namespace Luanardev\Modules\Employees\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Database\Seeders\DocumentTypeSeeder;
use Luanardev\Modules\Employees\Database\Seeders\EmployeeCategorySeeder;
use Luanardev\Modules\Employees\Database\Seeders\EmploymentStatusSeeder;
use Luanardev\Modules\Employees\Database\Seeders\EmploymentTypeSeeder;
use Luanardev\Modules\Employees\Database\Seeders\GradeSeeder;
use Luanardev\Modules\Employees\Database\Seeders\GradeNotchSeeder;
use Luanardev\Modules\Employees\Database\Seeders\ProgressTypeSeeder;
use Luanardev\Modules\Employees\Database\Seeders\QualificationLevelSeeder;

class EmployeesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call([
            DocumentTypeSeeder::class,
            EmployeeCategorySeeder::class,
            EmploymentStatusSeeder::class,
            EmploymentTypeSeeder::class,
            GradeSeeder::class,
            GradeNotchSeeder::class,
            ProgressTypeSeeder::class,
            QualificationLevelSeeder::class
        ]);
    }
}
