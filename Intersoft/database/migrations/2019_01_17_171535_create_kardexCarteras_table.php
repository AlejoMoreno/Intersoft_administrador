<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKardexCarterasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex_Carteras', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_empresa');
            $table->integer('id_cartera');
            $table->integer('id_factura');
            $table->string('fechaFactura');
            $table->string('numeroFactura');
            $table->double('descuentos');
            $table->double('sobrecostos');
            $table->double('fletes');
            $table->double('retefuente');
            $table->double('efectivo');
            $table->double('reteiva');
            $table->double('reteica');
            $table->double('total');
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
        Schema::dropIfExists('kardex_Carteras');
    }
}
