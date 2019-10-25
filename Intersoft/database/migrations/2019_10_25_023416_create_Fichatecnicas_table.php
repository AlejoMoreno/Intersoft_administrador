<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichatecnicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichatecnicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_referencia');
            $table->integer('id_sucursal');
            $table->integer('id_empresa');
            $table->string('nombre');
            $table->integer('orden');
            $table->integer('cantidad');
            $table->string('estado');
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
        Schema::dropIfExists('Fichatecnicas');
    }
}
