<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPageToBlogBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_banners', function (Blueprint $table) {
            $table->integer('page')->default(0)->comment('0->Blog Banner Page,1->Home Banner Page')->after('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_banners', function (Blueprint $table) {
            //
        });
    }
}
