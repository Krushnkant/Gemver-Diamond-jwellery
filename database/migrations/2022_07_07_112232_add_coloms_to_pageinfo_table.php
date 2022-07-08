<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomsToPageinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pageinfo', function (Blueprint $table) {
            //
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
            $table->text('customer_value')->nullable()->after('return_days');
            $table->text('market_need')->nullable()->after('customer_value'); 
            $table->text('why_friendly')->nullable()->after('market_need'); 
            $table->text('learn_about_lab_made_diamonds')->nullable()->after('why_friendly'); 
            $table->text('conflict_free_diamonds')->nullable()->after('learn_about_lab_made_diamonds'); 
        });
    }
}
