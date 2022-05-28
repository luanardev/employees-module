<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffEmploymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_staff_employment', function (Blueprint $table) {
            $table->bigInteger('staff_id')->unsigned();            
            $table->bigInteger('branch_id')->unsigned();
            $table->bigInteger('campus_id')->unsigned();
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('position_id')->unsigned();
            $table->bigInteger('grade_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();  
            $table->char('scale',1);
            $table->integer('notch');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('appointed', array('Yes', 'No'))->default('No');
            $table->enum('confirmed', array('Yes', 'No'))->default('No');
            $table->date('confirm_date')->nullable();
            $table->timestamps();

            $table->primary('staff_id');

            $table->foreign('staff_id')->references('id')->on('hrm_staff_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_staff_employment');
    }
}
