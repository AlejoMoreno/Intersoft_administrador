<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContabilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Contabilidades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipo_documento'); //si es cartera, factura, etc
            $table->integer('id_sucursal');
            $table->integer('id_documento');
            $table->integer('numero_documento');
            $table->string('prefijo'); //nevo
            $table->string('fecha_documento'); //nevo
            $table->string('valor_transaccion'); //nevo
            $table->string('tipo_transaccion'); //nevo credito / debito
            $table->integer('tercero'); //nevo 
            $table->integer('id_auxiliar');
            //$table->double('debito');
            //$table->double('credito');
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
        Schema::dropIfExists('Contabilidades');
    }
}
