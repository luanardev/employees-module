<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_employees', function (Blueprint $table) {
            $table->id();
            $table->string('national_id',20)->nullable();
            $table->string('title',20);
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('middlename',100)->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', array('Male', 'Female'));
            $table->string('marital_status',100);
            $table->string('official_email',100)->nullable();
            $table->string('personal_email',100)->nullable();
            $table->string('contact_address',100)->nullable();
            $table->string('phone1',20)->nullable();
            $table->string('phone2',20)->nullable();
            $table->bigInteger('qualification')->nullable();
            $table->string('residence_country',100)->nullable();
            $table->string('nationality',100)->nullable();
            $table->string('home_country',100)->nullable();
            $table->string('home_village',100)->nullable();
            $table->string('home_authority',100)->nullable();
            $table->string('home_district',100)->nullable();
            $table->string('avatar')->nullable();
            $table->string('signature')->nullable();
            $table->enum('status', array('Active', 'Inactive'))->default('Active');
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
        Schema::dropIfExists('hrm_employees');
    }
}
