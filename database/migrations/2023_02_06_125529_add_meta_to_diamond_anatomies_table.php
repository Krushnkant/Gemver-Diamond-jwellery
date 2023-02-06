<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaToDiamondAnatomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diamond_anatomies', function (Blueprint $table) {
            $table->text('meta_title')->nullable()->after('section9_description');
            $table->text('meta_description')->nullable()->after('meta_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diamond_anatomies', function (Blueprint $table) {
            //
        });
    }
}
