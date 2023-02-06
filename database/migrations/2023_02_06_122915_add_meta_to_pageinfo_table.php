<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaToPageinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pageinfo', function (Blueprint $table) {
            $table->text('about_meta_title')->nullable()->after('value4');
            $table->text('about_meta_description')->nullable()->after('about_meta_title');
            $table->text('privacy_policy_meta_title')->nullable()->after('privacy_policy');
            $table->text('privacy_policy_meta_description')->nullable()->after('privacy_policy_meta_title');
            $table->text('terms_condition_meta_title')->nullable()->after('terms_condition');
            $table->text('terms_condition_meta_description')->nullable()->after('terms_condition_meta_title');

            $table->text('free_engraving_meta_title')->nullable()->after('free_engraving');
            $table->text('free_engraving_meta_description')->nullable()->after('free_engraving_meta_title');

            $table->text('free_resizing_meta_title')->nullable()->after('free_resizing');
            $table->text('free_resizing_meta_description')->nullable()->after('free_resizing_meta_title');

            $table->text('free_shipping_meta_title')->nullable()->after('free_shipping');
            $table->text('free_shipping_meta_description')->nullable()->after('free_shipping_meta_title');

            $table->text('lifetime_upgrade_meta_title')->nullable()->after('lifetime_upgrade');
            $table->text('lifetime_upgrade_meta_description')->nullable()->after('lifetime_upgrade_meta_title');

            $table->text('lifetime_warranty_meta_title')->nullable()->after('lifetime_warranty');
            $table->text('lifetime_warranty_meta_description')->nullable()->after('lifetime_warranty_meta_title');

            $table->text('payment_options_meta_title')->nullable()->after('payment_options');
            $table->text('payment_options_meta_description')->nullable()->after('payment_options_meta_title');

            $table->text('customer_value_meta_title')->nullable()->after('customer_value');
            $table->text('customer_value_meta_description')->nullable()->after('customer_value_meta_title');

            $table->text('market_need_meta_title')->nullable()->after('market_need');
            $table->text('market_need_meta_description')->nullable()->after('market_need_meta_title');

            $table->text('why_friendly_meta_title')->nullable()->after('why_friendly');
            $table->text('why_friendly_meta_description')->nullable()->after('why_friendly_meta_title');

            $table->text('learn_about_lab_made_diamonds_meta_title')->nullable()->after('learn_about_lab_made_diamonds');
            $table->text('learn_about_lab_made_diamonds_meta_description')->nullable()->after('learn_about_lab_made_diamonds_meta_title');

            $table->text('conflict_free_diamonds_meta_title')->nullable()->after('conflict_free_diamonds');
            $table->text('conflict_free_diamonds_meta_description')->nullable()->after('conflict_free_diamonds_meta_title');
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
