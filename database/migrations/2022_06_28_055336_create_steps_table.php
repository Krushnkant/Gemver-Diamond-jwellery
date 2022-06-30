<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->string('main_title',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->string('main_shotline',255)->nullable();
            $table->text('main_image')->nullable();
            $table->integer('category_id');
             
            //step 1
            $table->string('step1_title',255)->nullable();
            $table->string('step1_shotline',255)->nullable();
            $table->text('step1_icon')->nullable();
            $table->text('step1_header_image')->nullable();

            $table->string('step1_section1_title',255)->nullable();
            $table->text('step1_section1_description')->nullable();
            $table->text('step1_section1_image')->nullable();
            $table->string('step1_section2_title',255)->nullable();
            $table->text('step1_section2_image1')->nullable();
            $table->string('step1_section2_title1',255)->nullable();
            $table->text('step1_section2_image2')->nullable();
            $table->string('step1_section2_title2',255)->nullable();

            //step 2
            $table->string('step2_title',255)->nullable();
            $table->string('step2_shotline',255)->nullable();
            $table->text('step2_icon')->nullable();
            $table->text('step2_header_image')->nullable();

            $table->string('step2_section1_title',255)->nullable();
            $table->text('step2_section1_description')->nullable();
            $table->text('step2_section1_image')->nullable();

            $table->text('step2_section2_image',255)->nullable();
            $table->string('step2_section2_title1',255)->nullable();
            $table->text('step2_section2_description1')->nullable();
            $table->string('step2_section2_title2',255)->nullable();
            $table->text('step2_section2_description2')->nullable();
            $table->string('step2_section2_title3',255)->nullable();
            $table->text('step2_section2_description3')->nullable();
            

            $table->string('step2_section3_title',255)->nullable();
            $table->text('step2_section3_description')->nullable();
            $table->text('step2_section3_image')->nullable();

            $table->string('step2_section4_title',255)->nullable();
            $table->text('step2_section4_description')->nullable();
            $table->text('step2_section4_image')->nullable();

            $table->string('step2_section5_title',255)->nullable();
            $table->text('step2_section5_description')->nullable();
            $table->text('step2_section5_image')->nullable();



            //step 3
            $table->string('step3_title',255)->nullable();
            $table->string('step3_shotline',255)->nullable();
            $table->text('step3_icon',255)->nullable();
            $table->text('step3_header_image')->nullable();

            $table->string('step3_section1_title',255)->nullable();
            $table->text('step3_section1_description')->nullable();

            $table->string('step3_section2_title',255)->nullable();
            $table->text('step3_section2_description')->nullable();
            $table->text('step3_section2_image')->nullable();

            $table->string('step3_section3_title',255)->nullable();
            $table->text('step3_section3_description')->nullable();
            $table->text('step3_section3_image')->nullable();

            $table->string('step3_section4_title',255)->nullable();
            $table->text('step3_section4_description')->nullable();
            $table->text('step3_section4_image')->nullable();

            $table->string('step3_section5_title',255)->nullable();
            $table->text('step3_section5_description')->nullable();
            $table->text('step3_section5_image')->nullable();

            $table->string('step3_section6_title',255)->nullable();
            $table->text('step3_section6_description')->nullable();
            $table->text('step3_section6_image')->nullable();

            $table->string('step3_section7_title',255)->nullable();
            $table->text('step3_section7_description')->nullable();

            $table->string('step3_section8_title',255)->nullable();
            $table->text('step3_section8_description')->nullable();
            $table->text('step3_section8_image')->nullable();

            $table->string('step3_section9_title',255)->nullable();
            $table->text('step3_section9_description')->nullable();
            $table->text('step3_section9_image')->nullable();

            $table->string('step3_section10_title',255)->nullable();
            $table->text('step3_section10_description')->nullable();
            $table->text('step3_section10_image')->nullable();

            $table->string('step3_section11_title',255)->nullable();
            $table->text('step3_section11_description')->nullable();
            $table->text('step3_section11_image')->nullable();

            //step 4
            $table->string('step4_title',255)->nullable();
            $table->string('step4_shotline',255)->nullable();
            $table->text('step4_icon')->nullable();
            $table->text('step4_header_image')->nullable();

            $table->string('step4_section1_title',255)->nullable();
            $table->text('step4_section1_description')->nullable();

            $table->string('step4_section2_title',255)->nullable();
            $table->text('step4_section2_description')->nullable();
            $table->text('step4_section2_image')->nullable();

            $table->string('step4_section3_title',255)->nullable();
            $table->text('step4_section3_description')->nullable();
            $table->text('step4_section3_image')->nullable();

            $table->string('step4_section4_title',255)->nullable();
            $table->text('step4_section4_description')->nullable();

            $table->string('step4_section5_title',255)->nullable();
            $table->text('step4_section5_description')->nullable();
            $table->text('step4_section5_image')->nullable();

            $table->string('step4_section6_title',255)->nullable();
            $table->text('step4_section6_description')->nullable();

            $table->string('step4_section7_title',255)->nullable();
            $table->text('step4_section7_description')->nullable();

            $table->string('step4_section8_title',255)->nullable();
            $table->text('step4_section8_description')->nullable();

            $table->string('step4_section9_title',255)->nullable();
            $table->text('step4_section9_description')->nullable();
            $table->text('step4_section9_image')->nullable();

            $table->string('step4_section10_title',255)->nullable();
            $table->text('step4_section10_description')->nullable();

            $table->string('step4_section11_title',255)->nullable();
            $table->text('step4_section11_image1')->nullable();
            $table->string('step4_section11_title1',255)->nullable();
            $table->text('step4_section11_image2')->nullable();
            $table->string('step4_section11_title2',255)->nullable();

            $table->integer('estatus')->default(1)->comment('1->Active,2->Deactive,3->Deleted,4->Pending');
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
        Schema::dropIfExists('steps');
    }
}
