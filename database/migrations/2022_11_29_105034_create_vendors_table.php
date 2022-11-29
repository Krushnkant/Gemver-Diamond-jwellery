<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('vendor_phone','255')->nullable();
            $table->string('vendor_mobile_phone','255')->nullable();
            $table->string('vendor_email','255')->nullable();
            $table->string('contact_person','255')->nullable();
            $table->string('vendor_street_address','255')->nullable();
            $table->string('vendor_city','255')->nullable();
            $table->string('vendor_state','255')->nullable();
            $table->string('vendor_country','255')->nullable();
            $table->string('vendor_zip_code','255')->nullable();
            $table->string('vendor_iphone','255')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
