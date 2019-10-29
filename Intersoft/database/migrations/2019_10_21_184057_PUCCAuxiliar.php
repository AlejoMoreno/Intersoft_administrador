<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PUCCAuxiliar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pucauxiliars', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipo');
            $table->string('naturaleza');
            $table->string('clase');
            $table->integer('id_pucsubcuentas');
            $table->string('codigo');
            $table->string('descripcion');
            $table->string('homologo');
            $table->integer('id_empresa');
            $table->string('exogena');
            $table->string('na');
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
        Schema::dropIfExists('pucauxiliar');
    }
}
