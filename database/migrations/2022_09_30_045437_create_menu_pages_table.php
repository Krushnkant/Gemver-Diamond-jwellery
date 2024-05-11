<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_pages', function (Blueprint $table) {
            $table->id();

            $table->integer('category_id')->index();
            $table->string('main_title',255)->nullable();
            $table->string('main_shotline',255)->nullable();
            $table->string('main_first_button_name',255)->nullable();
            $table->string('main_second_button_name',255)->nullable();
            $table->text('banner_image')->nullable();

            $table->string('section1_title',255)->nullable();
            $table->text('section1_description')->nullable();
            $table->text('section1_image')->nullable();
            

            $table->string('section2_title',255)->nullable();
            $table->text('section2_description')->nullable();
            $table->text('section2_image')->nullable();

            $table->string('section3_title',255)->nullable();
            $table->string('section3_description',255)->nullable();

            $table->string('section31_title',255)->nullable();
            $table->text('section31_description')->nullable();
            $table->text('section31_image')->nullable();
            $table->text('section31_category_id')->nullable();
            

            $table->string('section32_title',255)->nullable();
            $table->text('section32_description')->nullable();
            $table->text('section32_image')->nullable();
            $table->text('section32_category_id')->nullable();

            $table->string('section33_title',255)->nullable();
            $table->text('section33_description')->nullable();
            $table->text('section33_image')->nullable();
            $table->text('section33_category_id')->nullable();

            $table->string('section4_title',255)->nullable();
            $table->text('section4_description')->nullable();
            $table->text('section4_image')->nullable();
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
        Schema::dropIfExists('menu_pages');
    }
}
