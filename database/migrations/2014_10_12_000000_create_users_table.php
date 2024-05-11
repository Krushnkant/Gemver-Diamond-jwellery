<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('username')->nullable();
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->text('full_name')->nullable();
            $table->text('email')->nullable();
            $table->text('password')->nullable();
            $table->text('decrypted_password')->nullable();
            $table->enum('role', [1,2,3])->nullable()->comment('1->Admin,2->Sub Admin,3->End User');
            $table->text('mobile_no')->nullable();
            $table->text('gst_no')->nullable();
            $table->text('pickup_location')->nullable();
            $table->text('profile_pic')->nullable();
            $table->integer('gender')->default(1)->comment('1->Female,2->Male,3->Other');
            $table->date('dob')->nullable();
            $table->text('otp')->nullable();
            $table->dateTime('otp_created_at')->nullable();
            $table->text('referral_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}
