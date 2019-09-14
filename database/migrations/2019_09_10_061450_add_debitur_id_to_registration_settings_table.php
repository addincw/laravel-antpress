<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDebiturIdToRegistrationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration_settings', function (Blueprint $table) {
            $table->unsignedInteger('debitur_id');

            $table->foreign('debitur_id')->references('id')->on('debiturs')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration_settings', function (Blueprint $table) {
            $table->dropColumn(['debitur_id']);
        });
    }
}
