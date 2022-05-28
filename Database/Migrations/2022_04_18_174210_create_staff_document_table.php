<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_staff_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned();
            $table->string('name',100);
            $table->integer('type');
            $table->string('size',20);
            $table->string('mime', 20);
            $table->string('path');
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
        Schema::dropIfExists('hrm_staff_documents');
    }
}
