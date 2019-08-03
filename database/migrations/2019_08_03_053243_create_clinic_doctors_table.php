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
          $table->unsignedInteger('clinic_id');
          $table->unsignedInteger('doctor_id');
          $table->boolean('is_active')->default(true);
          $table->timestamps();

          $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('restrict');
          $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('restrict');
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
