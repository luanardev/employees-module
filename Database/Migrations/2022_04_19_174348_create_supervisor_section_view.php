<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSupervisorSectionView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }

    /**
     * Create table view
     *
     * @return string
     */
    private function createView()
    {
        return <<<SQL
                CREATE VIEW hrm_supervisor_section_view AS
                SELECT 
                hrm_staff_members.id AS id,
                hrm_staff_members.title AS title,
                concat(hrm_staff_members.firstname,' ',hrm_staff_members.lastname) AS name,
                org_campuses.name AS campus,
                org_sections.name AS section,
                hrm_supervisor_section.position,
                hrm_supervisor_section.section_id,
                hrm_supervisor_section.campus_id 
                FROM hrm_supervisor_section 
                JOIN hrm_staff_members ON hrm_staff_members.id = hrm_supervisor_section.staff_id
                JOIN org_sections ON org_sections.id = hrm_supervisor_section.section_id 
                JOIN org_campuses ON org_campuses.id = hrm_supervisor_section.campus_id
            SQL;
    }

    /**
     * Drop table view
     *
     * @return strinf
     */
    private function dropView()
    {
        return <<<SQL
            DROP VIEW IF EXISTS `hrm_supervisor_section_view`;
            SQL;
    }
}
