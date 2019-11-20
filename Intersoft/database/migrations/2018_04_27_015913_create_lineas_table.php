<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('retefuente_porcentaje');
            $table->integer('v_puc_retefuente');
            $table->integer('c_puc_retefuente');
            $table->integer('reteiva_porcentaje');
            $table->integer('v_puc_reteiva');
            $table->integer('c_puc_reteiva');
            $table->integer('reteica_porcentaje');
            $table->integer('v_puc_reteica');
            $table->integer('c_puc_reteica');
            $table->integer('iva_porcentaje');
            $table->integer('v_puc_iva');
            $table->integer('c_puc_iva');
            $table->integer('puc_compra');
            $table->integer('puc_venta');
            $table->string('codigo_interno');
            $table->string('codigo_alterno');
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
        Schema::dropIfExists('lineas');
    }
}
