<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmploymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_employment', function (Blueprint $table) {
            $table->bigInteger('employee_id')->unsigned();
            $table->bigInteger('designation_id')->unsigned();
            $table->bigInteger('branch_id')->unsigned();
            $table->bigInteger('campus_id')->unsigned();
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('employee_category')->unsigned();
            $table->bigInteger('employment_type')->unsigned();
            $table->bigInteger('employment_status')->unsigned();  
            $table->char('grade',1);
            $table->integer('notch');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('appointed', array('Yes', 'No'))->default('No');
            $table->enum('confirmed', array('Yes', 'No'))->default('No');
            $table->date('confirm_date')->nullable();
            $table->timestamps();
            $table->primary('employee_id');
            $table->foreign('employee_id')->references('id')->on('hrm_employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_employment');
    }
}
