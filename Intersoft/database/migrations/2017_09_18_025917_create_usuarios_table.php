<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->text('ncedula');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cargo');
            $table->string('telefono');
            $table->string('password');
            $table->string('correo');
            $table->string('estado'); //activo - inactivo - suspendido
            $table->string('token');
            $table->string('arl');
            $table->string('eps');
            $table->string('cesantias');
            $table->string('pension');
            $table->string('caja_compensacion');
            $table->integer('id_contrato');
            $table->string('referencia_personal');
            $table->string('telefono_referencia');
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
        Schema::dropIfExists('usuarios');
    }
}
