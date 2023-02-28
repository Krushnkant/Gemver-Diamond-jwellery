<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShapestyleToMenuPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_pages', function (Blueprint $table) {
            $table->text('shapestyle_title')->nullable()->after('banner_mobile_image');
            $table->text('shapestyle_description')->nullable()->after('shapestyle_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_pages', function (Blueprint $table) {
            //
        });
    }
}
