<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('causaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sucursal');
            $table->string('prefijo');
            $table->integer('numero');
            $table->integer('consecutivo');
            $table->string('fecha');
            $table->integer('id_tercero');
            $table->string('factura'); //factura con prefijo y numero
            $table->integer('neto_pagar');
            $table->string('fecha_vencimiento');
            $table->string('centro_costo'); //planta o costo
            $table->string('detalle');
            $table->integer('id_auxiliar');
            $table->integer('id_tercero_auxiliar');
            $table->integer('valor_auxiliar');
            $table->string('naturaleza'); //D o C
            $table->integer('id_empresa');
            //preguntar si continua con este o una nueva nuemeracion
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
        Schema::dropIfExists('causaciones');
    }
}
