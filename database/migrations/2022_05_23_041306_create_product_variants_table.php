<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('product_id')->index();
            $table->string('SKU')->index();
            $table->text('images');
            $table->integer('regular_price')->nullable();
            $table->integer('sale_price')->index();
            $table->integer('stock')->index();
            $table->integer('auto_discount_rs')->default(0)->comment('RegularPrice - SalePrice');
            $table->integer('auto_discount_percent')->default(0);
            $table->integer('term_item_id')->index();
            $table->integer('estatus')->default(1)->comment('1->Active,2->Deactive,3->Deleted,4->Pending')->index();
            $table->dateTime('created_at')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'))->index();
            $table->dateTime('updated_at')->default(null)->onUpdate(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('product_variants');
    }
}
