<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduccioningresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produccioningresos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ficha_tecnica');
            $table->integer('id_sucursal');
            $table->integer('id_empresa');
            $table->integer('id_turno');
            $table->integer('orden_produccion');
            $table->string('fecha');
            $table->integer('operario');
            $table->integer('id_referencia');
            $table->string('lote');
            $table->string('etapa');
            $table->integer('unidades');
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
        Schema::dropIfExists('Produccioningresos');
    }
}
