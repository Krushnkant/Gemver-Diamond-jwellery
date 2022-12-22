<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryCodeToInquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inquiry', function (Blueprint $table) {
            $table->string('country_code_mobile',255)->nullable()->after('name');
            $table->string('country_code_whatsapp',255)->nullable()->after('mobile_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquiry', function (Blueprint $table) {
            //
        });
    }
}
