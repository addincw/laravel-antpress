<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('device_id');
            $table->unsignedInteger('patient_id');
            $table->date('date')->nullable();
            $table->unsignedInteger('clinic_doctor_schedule_id');
            $table->string('code_registration')->nullable();
            $table->integer('queue')->nullable();
            $table->boolean('is_cancel')->nullable();
            $table->integer('print')->nullable();

            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict');
            $table->foreign('clinic_doctor_schedule_id')->references('id')->on('clinic_doctor_schedules')->onDelete('restrict');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
