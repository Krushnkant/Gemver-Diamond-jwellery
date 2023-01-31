<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidSection5MenuPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_pages', function (Blueprint $table) {
            $table->text('section5_title')->nullable()->after('section4_image');
            $table->text('section51_title')->nullable()->after('section5_title');
            $table->text('section51_description')->nullable()->after('section51_title');
            $table->text('section51_image')->nullable()->after('section51_description');
            $table->text('section51_category')->nullable()->after('section51_description');
            $table->text('section52_title')->nullable()->after('section51_category');
            $table->text('section52_description')->nullable()->after('section52_title');
            $table->text('section52_image')->nullable()->after('section52_description');
            $table->text('section52_category')->nullable()->after('section52_image');
            $table->text('section53_title')->nullable()->after('section52_category');
            $table->text('section53_description')->nullable()->after('section53_title');
            $table->text('section53_image')->nullable()->after('section53_description');
            $table->text('section53_category')->nullable()->after('section53_description');
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
