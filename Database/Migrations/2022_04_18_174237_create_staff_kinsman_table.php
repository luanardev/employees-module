<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffKinsmanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_staff_kinsman', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned();
            $table->string('title',20);
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('middlename',100)->nullable();
            $table->string('relation',20);
            $table->string('occupation',100)->nullable();
            $table->string('organisation',100)->nullable();
            $table->string('contact_address',100)->nullable();
            $table->string('phone1',20)->nullable();
            $table->string('phone2',20)->nullable();
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
        Schema::dropIfExists('hrm_staff_kinsman');
    }
}
