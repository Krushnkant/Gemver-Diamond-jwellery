<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProductVariantVariantsChangeManyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variant_variants', function (Blueprint $table) {
            // $table->id()->index()->change();
            // $table->integer('product_variant_id')->index()->change();
            // $table->integer('product_id')->index()->change();
            // $table->integer('attribute_id')->index()->change();
            // $table->integer('attribute_term_id')->index()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variant_variants', function (Blueprint $table) {
            //
        });
    }
}
