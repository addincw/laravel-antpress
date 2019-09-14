<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hour_start')->nullable();
            $table->string('minutes_start')->nullable();
            $table->string('hour_end')->nullable();
            $table->string('minutes_end')->nullable();
            $table->boolean('by_clinic')->nullable();
            $table->boolean('by_doctor')->nullable();
            $table->date('start_date')->nullable();
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
        Schema::dropIfExists('registration_settings');
    }
}
