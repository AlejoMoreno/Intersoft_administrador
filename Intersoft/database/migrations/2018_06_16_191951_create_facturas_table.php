<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Facturas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_sucursal');
            $table->integer('id_empresa');
            $table->integer('numero');
            $table->string('prefijo');
            $table->integer('id_cliente'); //directorios
            $table->integer('id_tercero'); //direcorios
            $table->integer('id_vendedor'); //directorios
            $table->string('fecha');
            $table->string('fecha_vencimiento');
            $table->integer('id_documento');
            $table->string('signo');
            $table->double('subtotal');
            $table->double('iva');
            $table->double('impoconsumo');
            $table->double('cree');
            $table->double('cree1');
            $table->double('descuento');
            $table->double('fletes');
            $table->double('retefuente');
            $table->double('total');
            $table->integer('id_modificado'); //directorios
            $table->string('observaciones'); 
            $table->string('estado'); //anulado, efectivo, credito, prestamo, comision,  
            $table->double('saldo');
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
        Schema::dropIfExists('Facturas');
    }
}
