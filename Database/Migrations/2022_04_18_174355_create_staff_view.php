<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateStaffView extends Migration
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
                CREATE VIEW hrm_staff_view AS
                SELECT
                hrm_staff_members.id,
                hrm_staff_members.title,
                hrm_staff_members.firstname,
                hrm_staff_members.lastname,
                CONCAT(hrm_staff_members.firstname,' ',hrm_staff_members.lastname) AS fullname,
                hrm_staff_members.gender,
                TIMESTAMPDIFF(YEAR, hrm_staff_members.date_of_birth, CURDATE()) AS age,
                hrm_staff_members.official_email as email,
                hrm_staff_members.avatar,
                hrm_config_positions.name AS position,
                hrm_config_job_grade.name AS grade,
                hrm_staff_employment.scale,
                hrm_staff_employment.notch,
                hrm_config_job_type.name AS type,
                hrm_config_job_category.name AS category,
                hrm_config_job_status.name AS status,
                org_branches.name AS branch,
                org_campuses.name AS campus,
                org_departments.name AS department,
                org_sections.name AS section,
                hrm_staff_employment.appointed,
                hrm_staff_employment.confirmed,
                hrm_staff_employment.confirm_date,
                hrm_staff_employment.start_date,
                hrm_staff_employment.end_date,
                TIMESTAMPDIFF(YEAR, hrm_staff_employment.start_date, CURDATE()) AS years_after_appointment,
                TIMESTAMPDIFF(YEAR, hrm_staff_employment.confirm_date, CURDATE()) AS years_after_confirmation,
                hrm_staff_employment.position_id,
                hrm_staff_employment.grade_id,
                hrm_staff_employment.type_id,
                hrm_staff_employment.status_id,
                hrm_staff_employment.category_id,
                hrm_staff_employment.branch_id,
                hrm_staff_employment.department_id,
                hrm_staff_employment.section_id
                FROM hrm_staff_members
                JOIN hrm_staff_employment ON hrm_staff_members.id = hrm_staff_employment.staff_id
                JOIN hrm_config_positions ON hrm_config_positions.id = hrm_staff_employment.position_id
                JOIN hrm_config_job_grade ON hrm_config_job_grade.id = hrm_staff_employment.grade_id
                JOIN hrm_config_job_type ON hrm_config_job_type.id = hrm_staff_employment.type_id
                JOIN hrm_config_job_status ON hrm_config_job_status.id = hrm_staff_employment.status_id
                JOIN hrm_config_job_category ON hrm_config_job_category.id = hrm_staff_employment.category_id
                JOIN org_branches ON org_branches.id = hrm_staff_employment.branch_id
                JOIN org_campuses ON org_campuses.id = hrm_staff_employment.campus_id
                JOIN org_departments ON org_departments.id = hrm_staff_employment.department_id
                JOIN org_sections ON org_sections.id = hrm_staff_employment.section_id
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
            DROP VIEW IF EXISTS `hrm_staff_view`;
            SQL;
    }
}
