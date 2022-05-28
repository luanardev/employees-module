<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSupervisorFacultyView extends Migration
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
                CREATE VIEW hrm_supervisor_faculty_view AS
                SELECT 
                hrm_staff_members.id AS id,
                hrm_staff_members.title AS title,
                CONCAT(hrm_staff_members.firstname,' ',hrm_staff_members.lastname) AS name,
                org_campuses.name AS campus,
                org_faculties.name AS faculty,
                hrm_supervisor_faculty.position,
                hrm_supervisor_faculty.faculty_id,
                hrm_supervisor_faculty.campus_id 
                FROM hrm_supervisor_faculty
                JOIN hrm_staff_members ON hrm_staff_members.id = hrm_supervisor_faculty.staff_id 
                JOIN org_faculties ON org_faculties.id = hrm_supervisor_faculty.faculty_id 
                JOIN org_campuses ON org_campuses.id = hrm_supervisor_faculty.campus_id
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
            DROP VIEW IF EXISTS `hrm_supervisor_faculty_view`;
            SQL;
    }
}
