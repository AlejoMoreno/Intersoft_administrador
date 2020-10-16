<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoriomapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directoriomaps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente');
            $table->string('direccion');
            $table->string('longitud');
            $table->string('latitud');
            $table->string('accuracy');
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
        Schema::dropIfExists('directoriomaps');
    }
}
