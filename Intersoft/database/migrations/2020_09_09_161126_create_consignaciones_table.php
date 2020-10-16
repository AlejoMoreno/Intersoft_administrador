<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consecutivo');
            $table->string('concepto');
            $table->string('valor');
            $table->integer('id_tipo_pago');
            $table->string('total');
            $table->string('fecha_consignacion');
            $table->integer('id_banco');
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
        Schema::dropIfExists('consignaciones');
    }
}
