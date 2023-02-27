<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOurMissionToPageinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pageinfo', function (Blueprint $table) {
            $table->text('about_our_mission_title')->nullable()->after('about_meta_description');
            $table->text('about_our_mission_contant')->nullable()->after('about_our_mission_title');
            $table->text('social_feed')->nullable()->after('about_our_mission_contant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pageinfo', function (Blueprint $table) {
            
        });
    }
}
