<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarterasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Carteras', function (Blueprint $table) {

            $table->increments('id');
            $table->double('reteiva');
            $table->double('reteica');
            $table->double('efectivo');
            $table->double('sobrecosto');
            $table->double('descuento');
            $table->double('retefuente');
            $table->double('otros');
            $table->integer('id_sucursal');
            $table->integer('numero');
            $table->string('prefijo');
            $table->integer('id_cliente');
            $table->integer('id_vendedor');
            $table->string('fecha');
            $table->string('tipoCartera');
            $table->double('subtotal');
            $table->double('total');
            $table->integer('id_modificado');
            $table->string('observaciones');
            $table->string('estado');
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
        Schema::dropIfExists('Carteras');
    }
}
