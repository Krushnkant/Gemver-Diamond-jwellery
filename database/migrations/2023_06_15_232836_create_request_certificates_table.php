<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('item_id',20)->nullable();
            $table->string('name',100)->nullable();
            $table->string('phone_number',100)->nullable();
            $table->string('email',50)->nullable();
            $table->text('message')->nullable();
            $table->integer('type')->default(1)->comment('1->Product,2->Diamond'); 
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
        Schema::dropIfExists('request_certificates');
    }
}
