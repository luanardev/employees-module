<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSupervisorDepartmentView extends Migration
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
                CREATE VIEW hrm_supervisor_department_view AS
                SELECT 
                hrm_staff_members.id AS id,
                hrm_staff_members.title AS title,
                CONCAT(hrm_staff_members.firstname,' ',hrm_staff_members.lastname) AS name,
                org_campuses.name AS campus,
                org_departments.name AS department,
                hrm_supervisor_department.position,
                hrm_supervisor_department.department_id,
                hrm_supervisor_department.campus_id 
                FROM hrm_supervisor_department 
                JOIN hrm_staff_members ON hrm_staff_members.id = hrm_supervisor_department.staff_id 
                JOIN org_departments ON org_departments.id = hrm_supervisor_department.department_id 
                JOIN org_campuses ON org_campuses.id = hrm_supervisor_department.campus_id
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
            DROP VIEW IF EXISTS `hrm_supervisor_department_view`;
            SQL;
    }
}
