<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastocontadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastocontados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sucursal');
            $table->string('prefijo');
            $table->integer('numero');
            $table->integer('consecutivo');
            $table->string('fecha_egreso');
            $table->string('centro_costo'); //planta o costo
            $table->integer('id_tercero');
            $table->integer('id_auxiliar');
            $table->integer('valor');
            $table->string('naturaleza');
            $table->string('detalle');
            $table->integer('id_empresa');
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
        Schema::dropIfExists('gastocontados');
    }
}
