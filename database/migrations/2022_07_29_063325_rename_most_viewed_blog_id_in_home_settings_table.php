<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMostViewedBlogIdInHomeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_settings', function (Blueprint $table) {
            $table->renameColumn('most_viewed_blog_id', 'most_viewed_product_id');
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
