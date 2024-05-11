<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->index();
            $table->string('custom_orderid',150)->nullable()->comment('YYMMDD0001');
            $table->float('sub_totalcost')->nullable();
            $table->float('shipping_charge')->nullable();
            $table->float('discount_amount')->nullable();
            $table->integer('coupan_code_id')->nullable();
            $table->float('total_ordercost')->nullable();
            $table->integer('payment_type')->nullable()->comment('1->Prepaid, 2->COD');
            $table->longText('payment_transaction_id')->nullable();
            $table->longText('payment_currency')->nullable();
            $table->longText('gateway_name')->nullable();
            $table->longText('payment_mode')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->integer('payment_status')->nullable()->comment('1->Pending, 2->Success, 3->Refunded, 4->Cancelled, 5->Refund Request, 6->Pay Refund(for Admin)/Refund Processing(for User), 7->Failed');
            $table->json('delivery_address')->nullable();
            $table->float('order_rating')->nullable();
            $table->text('order_note')->nullable();
            $table->integer('order_status')->nullable()->comment('1->New Order, 2->Out for Delivery, 3->Delivered, 4->Return Request, 5->Return In Transit, 6->Returned, 7->Cancelled(By Customer), 8->Cancelled(By Admin)')->index();
            $table->dateTime('delivery_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
