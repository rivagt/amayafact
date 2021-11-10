<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_sale', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sale_code'); //F001-001||B001-001
            $table->string('measure'); //UND||GLN
            $table->double('quantity',8,2); //3.00
            $table->string('description'); //ANGULO 1 1/2 X 1/8
            $table->double('unity_price',8,2); //29.00
            $table->double('total_mount'); //87.00
            $table->double('subtotal_mount',8,2); //87.00
            $table->double('impost_mount',8,2); //0.00
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details_sale');
    }
}
