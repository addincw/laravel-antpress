<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_doctors', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('job');
          $table->text('description')->nullable();
          $table->string('thumbnail')->nullable();
          $table->unsignedInteger('clinic_id');
          $table->timestamps();

          $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_doctors');
    }
}
