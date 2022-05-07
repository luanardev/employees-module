<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class EmployeeView extends Migration
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
                CREATE VIEW hrm_employee_view AS
                SELECT
                hrm_employees.id,
                hrm_employees.title,
                hrm_employees.firstname,
                hrm_employees.lastname,
                CONCAT(hrm_employees.firstname,' ',hrm_employees.lastname) AS fullname,
                hrm_employees.gender,
                TIMESTAMPDIFF(YEAR, hrm_employees.date_of_birth, CURDATE()) AS age,
                hrm_employees.official_email,
                hrm_employees.avatar,
                hrm_designations.name AS designation,
                hrm_employment_type.name AS appointment,
                hrm_employee_category.name AS category,
                hrm_employment_status.name AS status,
                hrm_employment.grade,
                hrm_employment.notch,
                org_branches.name AS branch,
                org_campuses.name AS campus,
                org_departments.name AS department,
                org_sections.name AS section,
                hrm_employment.appointed,
                hrm_employment.confirmed,
                hrm_employment.confirm_date,
                hrm_employment.start_date,
                hrm_employment.end_date,
                TIMESTAMPDIFF(YEAR, hrm_employment.start_date, CURDATE()) AS years_after_appointment,
                TIMESTAMPDIFF(YEAR, hrm_employment.confirm_date, CURDATE()) AS years_after_confirmation,
                hrm_employment.designation_id,
                hrm_employment.employment_type,
                hrm_employment.employment_status,
                hrm_employment.employee_category,
                hrm_employment.branch_id,
                hrm_employment.department_id,
                hrm_employment.section_id
                FROM hrm_employees
                JOIN hrm_employment ON hrm_employees.id = hrm_employment.employee_id
                JOIN hrm_designations ON hrm_designations.id = hrm_employment.designation_id
                JOIN hrm_employment_type ON hrm_employment_type.id = hrm_employment.employment_type
                JOIN hrm_employment_status ON hrm_employment_status.id = hrm_employment.employment_status
                JOIN hrm_employee_category ON hrm_employee_category.id = hrm_employment.employee_category
                JOIN org_branches ON org_branches.id = hrm_employment.branch_id
                JOIN org_campuses ON org_campuses.id = hrm_employment.campus_id
                JOIN org_departments ON org_departments.id = hrm_employment.department_id
                JOIN org_sections ON org_sections.id = hrm_employment.section_id
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
            DROP VIEW IF EXISTS `hrm_employee_view`;
            SQL;
    }
}
