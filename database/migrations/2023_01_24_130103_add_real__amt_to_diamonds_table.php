<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRealAmtToDiamondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diamonds', function (Blueprint $table) {
            $table->float('real_Amt')->nullable()->after('sale_amt');
            $table->float('amt_discount')->nullable()->after('real_Amt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diamonds', function (Blueprint $table) {
            //
        });
    }
}
