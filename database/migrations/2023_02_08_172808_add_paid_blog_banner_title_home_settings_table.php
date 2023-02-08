<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidBlogBannerTitleHomeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_settings', function (Blueprint $table) {
            $table->text('section_blog_banner_title')->nullable()->after('section_smiling_difference_title');
            $table->text('section_why_gemver_button_title1')->nullable()->after('section_why_gemver_title1');
            $table->text('section_why_gemver_button_title2')->nullable()->after('section_why_gemver_title2');
            $table->text('section_why_gemver_button_url1')->nullable()->after('section_why_gemver_button_title1');
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
