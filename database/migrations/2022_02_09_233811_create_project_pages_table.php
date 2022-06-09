<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_menu')->default(0);
            $table->text('label')->nullable();
            $table->text('route_url')->nullable();
            $table->text('inner_routes')->nullable();
            $table->text('icon_class')->nullable();
            $table->text('badge_class')->nullable();
            $table->integer('sr_no')->nullable();
            $table->boolean('is_display_in_menu')->default(0)->comment('0->No,1->Yes');
            $table->boolean('estatus')->default(1)->comment('0->Deactive,1->Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_pages');
    }
}
