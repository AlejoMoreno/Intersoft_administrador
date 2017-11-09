<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('fecha_inicio');
            $table->string('hora_inicio');
            $table->string('fecha_final');
            $table->string('hora_final');
            $table->string('lugar');
            $table->string('descripcion');
            $table->string('color');
            $table->string('notificacion'); //si no
            $table->float('valor');
            $table->integer('periodicidad');
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
        Schema::dropIfExists('calendarios');
    }
}
