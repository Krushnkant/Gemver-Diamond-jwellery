<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('order_return_imgs')->nullable()->after('delivery_date');
            $table->text('order_return_video')->nullable()->after('order_return_imgs');
            $table->text('order_return_video_thumb')->nullable()->after('order_return_video');
            $table->text('order_action_reason')->nullable()->after('order_return_video_thumb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
