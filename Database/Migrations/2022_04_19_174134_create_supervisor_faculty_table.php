<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_supervisor_faculty', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned();
            $table->bigInteger('faculty_id')->unsigned();
            $table->bigInteger('campus_id')->unsigned();
            $table->enum('position', ['Dean', 'Deputy'] )->default('Dean');
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
        Schema::dropIfExists('hrm_supervisor_faculty');
    }
}
