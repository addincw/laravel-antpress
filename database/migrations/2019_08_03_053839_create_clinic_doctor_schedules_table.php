<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicDoctorSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_doctor_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('clinic_doctor_id');
            $table->unsignedInteger('day_id');
            $table->string('start_time')->nullable()->comment('HH:II');
            $table->string('end_time')->nullable()->comment('HH:II');
            $table->integer('quota')->nullable();
            $table->boolean('is_active')->default(true)->comment('true/false');
            $table->timestamps();

            $table->foreign('clinic_doctor_id')->references('id')->on('clinic_doctors')->onDelete('restrict');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_doctor_schedules');
    }
}
