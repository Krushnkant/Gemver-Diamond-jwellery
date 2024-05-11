<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('first_name',255)->nullable();
            $table->string('last_name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('mobile_no',255)->nullable();
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->string('country',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('pincode',255)->nullable();
            $table->integer('estatus')->default(1)->comment('1->Active,2->Deactive,3->Deleted,4->Pending')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
