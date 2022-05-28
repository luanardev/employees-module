<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_staff_progress', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned();
            $table->bigInteger('position_id')->unsigned();
            $table->bigInteger('grade_id')->unsigned();
            $table->bigInteger('progress_type')->unsigned();
            $table->char('scale',1);
            $table->integer('notch');
            $table->enum('status', array('Active', 'Inactive'))->default('Active');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
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
        Schema::dropIfExists('hrm_staff_progress');
    }
}
