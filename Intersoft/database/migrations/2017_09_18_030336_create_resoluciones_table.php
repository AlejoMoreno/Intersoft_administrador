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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('prefijo');
            $table->string('fecha');
            $table->integer('numero_presente');
            $table->string('rango_inicio');
            $table->string('rango_final');
            $table->string('usuario_dian');
            $table->string('password_dian');
            $table->integer('id_documento');
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
