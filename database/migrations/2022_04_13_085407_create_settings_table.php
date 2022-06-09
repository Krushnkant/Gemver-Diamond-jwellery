<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('company_name')->nullable();
            $table->text('company_logo')->nullable();
            $table->text('company_favicon')->nullable();
            $table->text('company_address')->nullable();
            $table->text('company_mobile_no')->nullable();
            $table->text('send_email')->nullable();
            $table->text('youtub_url')->nullable();
            $table->text('instagram_url')->nullable();
            $table->text('twiter_url')->nullable();
            $table->text('tiktok_url')->nullable();
            $table->text('facebook_url')->nullable();
            $table->text('company_address_map')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
