<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectorioClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directorio_clases', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });

        DB::table('directorio_clases')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'TIPO (A)',
                'descripcion' => 'Este tiene el mejor rendimiento'
            )
        );
        DB::table('directorio_clases')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'TIPO (B)',
                'descripcion' => 'Este tiene mediano rendimiento'
            )
        );
        DB::table('directorio_clases')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'TIPO (C)',
                'descripcion' => 'Este tiene malo rendimiento'
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
        Schema::dropIfExists('directorio_clases');
    }
}
