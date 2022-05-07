<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeSpouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_employee_spouse', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned();
            $table->string('title',20);
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('middlename',100)->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', array('Male', 'Female'));
            $table->string('contact_address',100)->nullable();
            $table->string('phone1',20)->nullable();
            $table->string('phone2',20)->nullable();
            $table->string('residence_country',100)->nullable();
            $table->string('nationality',100)->nullable();
            $table->string('home_country',100)->nullable();
            $table->string('home_village',100)->nullable();
            $table->string('home_authority',100)->nullable();
            $table->string('home_district',100)->nullable();
            $table->foreign('employee_id')->references('id')->on('hrm_employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_employee_spouse');
    }
}
