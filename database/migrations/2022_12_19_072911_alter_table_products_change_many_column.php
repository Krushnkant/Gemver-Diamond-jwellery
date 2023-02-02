<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProductsChangeManyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
           // $table->id()->index()->change();
           // $table->text('product_u_id')->nullable()->index()->change();
            // $table->text('attr_ids')->nullable()->index()->change();
            // $table->integer('user_id')->index()->change();
            // $table->integer('primary_category_id')->index()->change();
            // $table->text('attr_term_ids')->nullable()->index()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
