<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resoluciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->integer('numero');
            $table->string('rango');
            $table->integer('id_empresa');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('resoluciones')->insert(
            array(
                'id'        => NULL,
                'fecha' => '2018-01-02',
                'numero' => '12321',
                'rango' => '900-930',
                'id_empresa' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resoluciones');
    }
}
