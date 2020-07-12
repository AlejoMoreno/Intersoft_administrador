<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumoXMLsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumo_x_m_ls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_factura');
            $table->integer('id_sucursal');
            $table->integer('id_empresa');
            $table->integer('id_cliente');
            $table->integer('enviado');//si 1 no 0
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
        Schema::dropIfExists('insumo_x_m_ls');
    }
}
