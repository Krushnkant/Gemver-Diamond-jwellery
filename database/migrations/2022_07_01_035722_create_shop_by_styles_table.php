<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopByStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_by_styles', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->index();
            $table->string('title',255)->nullable();
            $table->string('setting',255)->nullable();
            $table->text('image')->nullable();
            $table->string('attributes',255)->nullable();
            $table->string('attribute_terms',255)->nullable();
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
        Schema::dropIfExists('shop_by_styles');
    }
}
