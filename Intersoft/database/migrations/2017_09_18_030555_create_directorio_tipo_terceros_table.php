<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectorioTipoTercerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directorio_tipo_terceros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });

        DB::table('directorio_tipo_terceros')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'PROVEEDOR',
                'descripcion' => 'TIPO PROVEEDOR'
            )
        );
        DB::table('directorio_tipo_terceros')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'CLIENTE',
                'descripcion' => 'TIPO CLIENTE'
            )
        );
        DB::table('directorio_tipo_terceros')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'TERCEROS',
                'descripcion' => 'TIPO TERCEROS'
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
        Schema::dropIfExists('directorio_tipo_terceros');
    }
}
