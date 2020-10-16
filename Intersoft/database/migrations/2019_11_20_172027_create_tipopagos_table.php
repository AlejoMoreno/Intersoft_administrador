<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipopagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipopagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('puc_cuenta'); //venta
            $table->integer('puc_compra');
            $table->string('tercero');
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
        //
    }
}
