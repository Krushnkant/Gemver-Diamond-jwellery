<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaReturndaysToPageinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pageinfo', function (Blueprint $table) {
            $table->text('return_days_meta_title')->nullable()->after('return_days');
            $table->text('return_days_meta_description')->nullable()->after('return_days_meta_title');
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
            //
        });
    }
}
