<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',150)->nullable();
            $table->text('order_return_imgs')->nullable();
            $table->text('order_return_video')->nullable();
            $table->text('order_return_video_thumb')->nullable();
            $table->text('order_action_reason')->nullable();
            $table->integer('is_return_requested')->nullable();
            $table->integer('payment_status')->nullable()->comment('1->Pending, 2->Success, 3->Refunded, 4->Cancelled, 5->Refund Request, 6->Pay Refund(for Admin)/Refund Processing(for User), 7->Failed');
            $table->integer('order_status')->nullable()->comment('1->New Order, 2->Out for Delivery, 3->Delivered, 4->Return Request, 5->Return In Transit, 6->Returned, 7->Cancelled(By Customer), 8->Cancelled(By Admin)');
            $table->integer('updated_by')->nullable();
            $table->text('order_note')->nullable();
            $table->json('item_details')->nullable();
            $table->dateTime('tillreturned_date')->nullable();
            $table->dateTime('payment_action_date')->nullable();
            $table->integer('estatus')->default(1)->comment('1->Active,2->Deactive,3->Deleted,4->Pending');
            $table->softDeletes();
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
        Schema::dropIfExists('order_items');
    }
}
