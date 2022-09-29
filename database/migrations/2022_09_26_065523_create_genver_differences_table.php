<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenverDifferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genver_differences', function (Blueprint $table) {
            $table->id();
            $table->string('section1_title',255)->nullable();
            $table->text('section1_description')->nullable();
            $table->text('section1_image')->nullable();
            $table->string('section2_title',255)->nullable();
            $table->text('section2_description')->nullable();
            $table->text('section2_image')->nullable();
            $table->string('section3_title',255)->nullable();
            $table->text('section3_description')->nullable();
            $table->text('section3_image')->nullable();
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
        Schema::dropIfExists('genver_differences');
    }
}
