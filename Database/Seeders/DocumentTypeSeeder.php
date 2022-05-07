<?php

namespace Luanardev\Modules\Employees\Database\Seeders;

use Illuminate\Database\Seeder;
use Luanardev\Modules\Employees\Entities\DocumentType;

class DocumentTypeSeeder extends Seeder
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
            REPLACE INTO `hrm_document_type` (`id`, `name`) VALUES
            (1, 'National ID'),
            (2, 'Driving Licence'),
            (3, 'Passport'),
            (4, 'Birth Certificate'),
            (5, 'Death Certificate'),
            (6, 'Medical Certificate'),
            (7, 'Curriculum Vitae'),
            (8, 'Academic Certificate'),
            (9, 'Professional Certificate'),
            (10, 'Training Certificate'),
            (11, 'Industrial Certificate'),
            (12, 'Appointment Letter'),
            (13, 'Confirmation Letter'),
            (14, 'Promotion Letter'),
            (15, 'Resignation Letter'),
            (16, 'Dismissal Letter'),
            (17, 'Contract Letter'),
            (18, 'Termination Letter'),
            (19, 'Disciplinary Letter'),
            (20, 'Achievement Award');
        SQL;
    }
}
