<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectorioTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directorio_tipos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });

        DB::table('directorio_tipos')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'NACIONAL',
                'descripcion' => 'ESTE ES NACIONAL'
            )
        );
        DB::table('directorio_tipos')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'INTERNACIONAL',
                'descripcion' => 'ESTE ES INTERNACIONAL'
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
        Schema::dropIfExists('directorio_tipos');
    }
}
