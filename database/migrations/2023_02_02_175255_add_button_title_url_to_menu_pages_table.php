<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddButtonTitleUrlToMenuPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_pages', function (Blueprint $table) {
            $table->text('section1_button_title')->nullable()->after('section1_image');
            $table->text('section1_button_url')->nullable()->after('section1_button_title');
            $table->text('section4_button_title')->nullable()->after('section4_image');
            $table->text('section4_button_url')->nullable()->after('section4_button_title');
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
