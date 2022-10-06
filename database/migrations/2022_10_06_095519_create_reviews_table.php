<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('item_id');
            $table->integer('order_item_id');
            $table->text('review_imgs')->nullable();
            $table->text('description')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('estatus')->default(1)->comment('1->Active,2->Deactive,3->Deleted,4->Pending');
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
        Schema::dropIfExists('reviews');
    }
}
