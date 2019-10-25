<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduccionturnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produccionturnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empresa');
            $table->integer('id_sucursal');
            $table->string('nombre_etapa');
            $table->integer('duracion');
            $table->integer('precioobra');
            $table->integer('estado'); //I-inicio F-final N-no
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
        Schema::dropIfExists('Producciontuenos');
    }
}
