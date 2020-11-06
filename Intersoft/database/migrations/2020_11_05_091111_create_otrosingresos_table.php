<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtrosingresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otrosingresos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sucursal');
            $table->string('prefijo');
            $table->integer('numero');
            $table->string('fecha');
            $table->integer('id_tercero');
            $table->string('concepto');
            $table->integer('valor');
            $table->integer('id_auxiliar');
            $table->integer('id_tercero_cuenta');
            $table->integer('valor_auxiliar');
            $table->string('naturaleza');
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
        Schema::dropIfExists('otrosingresos');
    }
}
