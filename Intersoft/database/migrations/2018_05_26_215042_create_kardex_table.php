<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sucursal');
            $table->integer('numero');
            $table->string('prefijo');
            $table->integer('id_cliente'); //directorios
            $table->integer('id_factura'); //factura
            $table->integer('id_vendedor'); //directorios
            $table->string('fecha');
            $table->integer('id_referencia');
            $table->string('lote');
            $table->string('serial');
            $table->string('fecha_vencimiento');
            $table->double('cantidad');
            $table->double('precio');
            $table->double('costo');
            $table->integer('id_documento');
            $table->string('signo');
            $table->double('subtotal');
            $table->double('iva');
            $table->double('impoconsumo');
            $table->double('otro_impuesto');
            $table->double('otro_impuesto1');
            $table->double('descuento');
            $table->double('fletes');
            $table->double('retefuente');
            $table->double('total');
            $table->text('observaciones');
            $table->integer('id_modificado'); //directorios
            $table->integer('kardex_anterior'); //para realizar copia de documentos
            $table->string('estado'); //anulado, efectivo, credito, prestamo, comision,  
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
        Schema::dropIfExists('kardex');
    }
}
