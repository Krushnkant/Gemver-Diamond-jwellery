<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();
            $table->string('section_category_title',255)->nullable();
            $table->string('section_diamond_title',255)->nullable();
            $table->string('section_stories_title',255)->nullable();
            $table->string('section_stories_description',255)->nullable();
            $table->string('section_customise_title',255)->nullable();
            $table->string('section_customise_description',255)->nullable();
            $table->string('section_customise_link',255)->nullable();
            $table->text('section_customise_image')->nullable();
            $table->string('section_why_gemver_title',255)->nullable();
            $table->string('section_why_gemver_description',255)->nullable();
            $table->string('section_why_gemver_title1',255)->nullable();
            $table->string('section_why_gemver_description1',255)->nullable();
            $table->text('section_why_gemver_image1')->nullable();
            $table->string('section_why_gemver_title2',255)->nullable();
            $table->string('section_why_gemver_description2',255)->nullable();
            $table->text('section_why_gemver_image2')->nullable();

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
        Schema::dropIfExists('home_settings');
    }
}
