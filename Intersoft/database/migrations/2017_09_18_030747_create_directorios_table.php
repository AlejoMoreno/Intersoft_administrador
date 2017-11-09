<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directorios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nit');
            $table->string('digito');
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('correo');
            $table->string('telefono');
            $table->string('telefono1');
            $table->string('telefono2');
            $table->float('financiacion');
            $table->float('descuento');
            $table->float('cupo_financiero');
            $table->float('rete_ica');
            $table->float('porcentaje_rete_iva');
            $table->string('actividad_economica');
            $table->integer('calificacion');
            $table->string('nivel');
            $table->string('zona_venta');
            $table->string('transporte');
            $table->string('estado'); //activo inactivo suspendido
            $table->integer('id_retefuente');
            $table->integer('id_ciudad');
            $table->integer('id_regimen');
            $table->integer('id_usuario');
            $table->integer('id_directorio_tipo');
            $table->integer('id_directorio_clase');
            $table->integer('id_directorio_tipo_tercero');
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
        Schema::dropIfExists('directorios');
    }
}
