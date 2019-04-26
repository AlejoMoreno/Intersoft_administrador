<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clase');
            $table->string('nombreClase');
            $table->integer('grupo');
            $table->string('nombreGrupo');
            $table->integer('cuenta');
            $table->string('nombreCuenta');
            $table->integer('subcuenta');
            $table->string('nombreSubcuenta');
            $table->integer('auxiliar');
            $table->string('nombreAuxiliar');
            $table->string('homologo');
            $table->string('homologo_1');
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
        Schema::dropIfExists('Cuentas');
    }
}
