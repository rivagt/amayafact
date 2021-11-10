<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_client'); //74326379||111111||20644665567||2222222
            $table->string('fullname_client'); //Rivaldo Garcia Taipe||Venta al detalle||J&L||R.C,pampa michi
            $table->string('sale_type'); //Boleta||Factura
            $table->string('sale_code')->unique(); //F001-001||B001-001
            $table->double('total_mount',8,2); //900.00
            $table->double('subtotal_mount',8,2); //900.00
            $table->double('impost_mount',8,2); //0.00
            $table->string('emited_time'); //2018-11-09
            $table->string('user_code',8,2); //RG0719
            //$table->string('state');//Emitido(1)//Registrado(0)
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
        Schema::dropIfExists('sales');
    }
}
