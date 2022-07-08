<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondAnatomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diamond_anatomies', function (Blueprint $table) {
            $table->id();
            $table->string('header_title',255)->nullable();
            $table->string('header_shotline',255)->nullable();
            $table->string('header_image',255)->nullable();

            $table->string('section1_title',255)->nullable();
            $table->string('section1_description',255)->nullable();


            $table->string('section2_title',255)->nullable();
            $table->string('section2_description',255)->nullable();
            $table->string('section2_image',255)->nullable();

            $table->string('section3_title',255)->nullable();
            $table->string('section3_description',255)->nullable();
            $table->string('section3_image',255)->nullable();

            $table->string('section4_title',255)->nullable();
            $table->string('section4_description',255)->nullable();
            $table->string('section4_image',255)->nullable();

            $table->string('section5_image',255)->nullable();

            $table->string('section6_title',255)->nullable();
            $table->string('section6_description',255)->nullable();
            $table->string('section6_image',255)->nullable();

            $table->string('section7_title',255)->nullable();
            $table->string('section7_description',255)->nullable();
            $table->string('section7_image',255)->nullable();
            $table->string('section7_image2',255)->nullable();

            $table->string('section8_title',255)->nullable();
            $table->string('section8_description',255)->nullable();
            $table->string('section8_image',255)->nullable();

            $table->string('section9_title',255)->nullable();
            $table->string('section9_description',255)->nullable();

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
        Schema::dropIfExists('diamond_anatomies');
    }
}
