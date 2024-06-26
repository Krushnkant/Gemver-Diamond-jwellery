<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry', function (Blueprint $table) {
            $table->id()->index();
            $table->string('sku',20)->nullable()->index();
            $table->string('stone_no',50)->nullable();
            $table->integer('qty')->nullable();
            $table->string('specification_term_id',255)->nullable()->index();
            $table->string('name',100)->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email',50)->nullable();
            $table->text('inquiry')->nullable();
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
        Schema::dropIfExists('inquiry');
    }
}
