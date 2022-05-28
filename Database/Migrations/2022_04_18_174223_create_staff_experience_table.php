<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_staff_experience', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned();
            $table->string('job_position',100);
            $table->string('employer_name',100);
            $table->string('employer_address',100)->nullable();
            $table->string('employer_phone',20)->nullable();
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
        Schema::dropIfExists('hrm_staff_experience');
    }
}
