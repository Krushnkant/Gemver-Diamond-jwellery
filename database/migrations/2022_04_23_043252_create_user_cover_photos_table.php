<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCoverPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cover_photos', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->integer('user_id')->index();
            $table->integer('estatus')->default(1)->comment('1->Active,2->Deactive,3->Deleted,4->Pending')->index();
            $table->dateTime('created_at')->default(\Carbon\Carbon::now());
            $table->dateTime('updated_at')->default(null)->onUpdate(\Carbon\Carbon::now());
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
        Schema::dropIfExists('user_cover_photos');
    }
}
