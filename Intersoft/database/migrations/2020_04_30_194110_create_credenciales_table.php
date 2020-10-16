<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCredencialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credenciales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario');
            $table->string('passwordWsIntegrador');
            $table->string('numeroResolucion');
            $table->string('fechaInicio');
            $table->string('fechaFinal');
            $table->string('prefijo');
            $table->string('numeroDesde');
            $table->string('numeroHasta');
            $table->string('tipoCredencial');
            $table->integer('estado');
            $table->string('referenciaPago');
            $table->integer('idEmpresa');
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
        Schema::dropIfExists('credenciales');
    }
}
