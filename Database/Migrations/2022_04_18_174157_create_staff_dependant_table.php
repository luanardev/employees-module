<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffDependantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_staff_dependants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned();
            $table->string('title',20);
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->date('date_of_birth');
            $table->enum('gender', array('Male', 'Female'));
            $table->string('relation',50);
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
        Schema::dropIfExists('hrm_staff_dependants');
    }
}
