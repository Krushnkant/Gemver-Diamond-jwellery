<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiamondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diamonds', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('Company_id');
            $table->string('Stone_No',255)->nullable()->index();
            $table->string('StockStatus',255)->nullable()->index();
            $table->string('Shape',255)->nullable()->index();
            $table->string('Weight',255)->nullable()->index();
            $table->string('Color',255)->nullable()->index();
            $table->string('Clarity',255)->nullable()->index();
            $table->string('Cut',255)->nullable()->index();
            $table->string('Polish',255)->nullable()->index();
            $table->string('Symm',255)->nullable()->index();
            $table->string('FlrIntens',255)->nullable();
            $table->string('FlrColor',255)->nullable();
            $table->string('FancyColor',255)->nullable()->index();
            $table->string('FancyColorIntens',255)->nullable();
            $table->string('FancyColorOvertone',255)->nullable();
            $table->string('Lab',255)->nullable();
            $table->string('Lab_Report_No',255)->nullable();
            $table->text('Lab_Report_Comment',255)->nullable();
            $table->string('Laser_Inscription',255)->nullable();
            $table->string('Location',255)->nullable();
            $table->string('Live_Rap_Rate',255)->nullable();
            $table->string('Discount',255)->nullable();
            $table->float('Rate')->nullable();
            //$table->float('Amt')->nullable();
            $table->float('Amt', 10, 2);
            //$table->float('Sale_Amt')->nullable();
            $table->float('Sale_Amt', 10, 2)->index();
            $table->string('Measurement',255)->nullable();
            $table->float('Total_Depth_Per')->nullable()->index();
            $table->float('Table_Diameter_Per')->nullable();
            $table->string('GirdleThin_ID',255)->nullable();
            $table->string('GirdleThick_ID',255)->nullable();
            $table->float('Girdle_Per')->nullable();
            $table->string('Culet_Size_ID',255)->nullable();
            $table->string('Culet_Condition_ID',255)->nullable();
            $table->float('CrownAngle')->nullable();
            $table->float('CrownHeight')->nullable();
            $table->float('PavillionAngle')->nullable();
            $table->float('PavillionHeight')->nullable();
            $table->string('KeyToSymbols',255)->nullable();
            $table->string('Shade',255)->nullable();
            $table->float('StarLength')->nullable();
            $table->float('LowerHalve')->nullable();
            $table->string('Table_Inclusion',255)->nullable();
            $table->string('Black_Inclusion',255)->nullable();
            $table->string('Side_Inclusion',255)->nullable();
            $table->string('Open_Inclusion',255)->nullable();
            $table->string('Center_Inclusion',255)->nullable();
            $table->string('Feather_Inclusion',255)->nullable();
            $table->string('HnA_ID',255)->nullable();
            $table->float('Ratio')->nullable();
            $table->string('Luster_ID',255)->nullable();
            $table->string('BIS',255)->nullable();
            $table->string('BIC',255)->nullable();
            $table->string('WIS',255)->nullable();
            $table->string('WIC',255)->nullable();
            $table->string('Source',255)->nullable();
            $table->string('Eyeclean',255)->nullable();
            $table->string('Milkey',255)->nullable();
            $table->string('Tinge',255)->nullable();
            $table->string('Certificate_url',255)->nullable();
            $table->string('Stone_Img_url',255)->nullable();
            $table->string('Video_url',255)->nullable();
            $table->text('Stone_Comment',255)->nullable();
            $table->text('Comment',255)->nullable();
            $table->text('CompanyComment',255)->nullable();
            $table->integer('estatus')->default(1)->comment('1->Active,2->Deactive,3->Deleted,4->Pending')->index();
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
        Schema::dropIfExists('diamonds');
    }
}
