<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pageinfo', function (Blueprint $table) {
            $table->id();
            $table->text('first_section_image')->nullable();
            $table->text('first_section_contant')->nullable();
            $table->text('first_section_title')->nullable();
            $table->text('second_section_image')->nullable();
            $table->text('second_section_contant')->nullable();
            $table->text('second_section_title')->nullable();
            $table->text('title1')->nullable();
            $table->text('value1')->nullable();
            $table->text('title2')->nullable();
            $table->text('value2')->nullable();
            $table->text('title3')->nullable();
            $table->text('value3')->nullable();
            $table->text('title4')->nullable();
            $table->text('value4')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->text('terms_condition')->nullable();
            $table->text('free_engraving')->nullable();
            $table->text('free_resizing')->nullable();
            $table->text('free_shipping')->nullable();
            $table->text('lifetime_upgrade')->nullable();
            $table->text('lifetime_warranty')->nullable();
            $table->text('payment_options')->nullable();
            $table->text('return_days')->nullable();
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
        Schema::dropIfExists('pageinfo');
    }
}
