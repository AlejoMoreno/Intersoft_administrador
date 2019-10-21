<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificaciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('codigo_interno');
            $table->integer('id_empresa');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('clasificaciones')->insert(
            array(
                'id'        => NULL,
                'nombre' => 'MATERIA PRIMA', 
                'descripcion' => 'MATERIA PRIMA',
                'codigo_interno' => '01',
                'id_empresa' => '1'
            ),
            array(
                'id'        => NULL,
                'nombre' => 'PRODUCTO TERMINADO', 
                'descripcion' => 'PRODUCTO TERMINADO',
                'codigo_interno' => '02',
                'id_empresa' => '1'
            ),
            array(
                'id'        => NULL,
                'nombre' => 'PRODUCTO NACIONAL', 
                'descripcion' => 'PRODUCTO NACIONAL',
                'codigo_interno' => '03',
                'id_empresa' => '1'
            ),
            array(
                'id'        => NULL,
                'nombre' => 'PRODUCTO INTERNACIONAL', 
                'descripcion' => 'PRODUCTO INTERNACIONAL',
                'codigo_interno' => '04',
                'id_empresa' => '1'
            )
            ,
            array(
                'id'        => NULL,
                'nombre' => 'SERVICIO', 
                'descripcion' => 'SERVICIO',
                'codigo_interno' => '05',
                'id_empresa' => '1'
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
        Schema::dropIfExists('clasificaciones');
    }
}
