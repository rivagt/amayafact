<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrementsid('id');
            $table->string('code')->unique(); //AB001
            $table->string('category'); //ABRASIVOS
            $table->string('brand'); //PRETUL
            $table->string('description'); //DISCO CORTE 4 1/2
            $table->string('measure'); //UNIDAD
            $table->double('weight',8,2); //peso
            $table->double('stock',8,2); //63.00
            $table->double('stockmin',8,2); //25.00
            $table->double('saleprice',8,2); //3.50
            $table->double('costprice',8,2); //2.00
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
        Schema::dropIfExists('items');
    }
}
