<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShotlineToHomeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_settings', function (Blueprint $table) {
            $table->string('section_category_shotline',225)->nullable()->after('section_category_title');
            $table->string('section_product_title',225)->nullable()->after('section_category_shotline');
            $table->string('section_product_shotline',225)->nullable()->after('section_product_title');
            $table->string('section_diamond_shotline',225)->nullable()->after('section_diamond_title');
            $table->string('section_smiling_difference_title',225)->nullable()->after('section_diamond_shotline');
            $table->string('section_shop_by_style_title',225)->nullable()->after('section_customise_image');
            $table->string('section_shop_by_style_shotline',225)->nullable()->after('section_shop_by_style_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_settings', function (Blueprint $table) {
            //
        });
    }
}
