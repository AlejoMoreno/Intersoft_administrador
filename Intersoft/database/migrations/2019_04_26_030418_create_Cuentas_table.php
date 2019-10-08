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
            $table->string('clase');
            $table->string('nombreClase');
            $table->string('grupo');
            $table->string('nombreGrupo');
            $table->string('cuenta');
            $table->string('nombreCuenta');
            $table->string('subcuenta');
            $table->string('nombreSubcuenta');
            $table->string('auxiliar');
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
