<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_linea');
            $table->string('codigo_letras');
            $table->string('codigo_consecutivo');
            $table->string('descripcion');
            $table->string('codigo_barras');
            $table->string('codigo_interno');
            $table->string('codigo_alterno');
            $table->integer('id_presentacion');
            $table->integer('id_marca');
            $table->double('factor_rendimiento');
            $table->double('stok_minimo');
            $table->double('stok_maximo');
            $table->double('iva');
            $table->double('impo_consumo');
            $table->double('sobre_tasa');
            $table->string('serie');
            $table->double('descuento');
            $table->integer('id_clasificacion');
            $table->double('peso');
            $table->double('precio1');
            $table->double('precio2');
            $table->double('precio3');
            $table->double('precio4');
            $table->string('estado');
            $table->string('hommologo');
            $table->double('costo');
            $table->double('costo_promedio');
            $table->double('saldo');
            $table->integer('usuario_creador');
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
        Schema::dropIfExists('referencias');
    }
}
