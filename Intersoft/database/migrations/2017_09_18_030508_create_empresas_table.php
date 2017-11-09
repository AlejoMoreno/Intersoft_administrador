<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('actividad');
            $table->string('dian_nit');
            $table->string('nit_empresa');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('telefono1');
            $table->string('telefono2');
            $table->integer('ciudad');
            $table->integer('id_regimen');
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
        Schema::dropIfExists('empresas');
    }
}
