<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('slug');
            $table->string('type')->nullable()->comment('[ media ]');
            $table->string('creator_name')->nullable()->default('admin');
            $table->string('creator_title')->nullable()->default('Administrator');
            $table->string('creator_image')->nullable();
            $table->unsignedInteger('content_category_id');
            $table->boolean('is_delete')->default(true);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->foreign('content_category_id')->references('id')->on('content_categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
