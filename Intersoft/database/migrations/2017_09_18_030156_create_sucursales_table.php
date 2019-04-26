<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('codigo');
            $table->string('direccion');
            $table->string('encargado'); //id_usuario
            $table->string('telefono');
            $table->string('correo');
            $table->integer('ciudad');
            $table->integer('id_empresa');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('sucursales')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'FAMC CENTRAL',
                'codigo'    => 1,
                'direccion' => 'CL 38 A 50 A 71 SUR',
                'encargado' => 'ALEJANDRO MORENO',
                'telefono'  => '3219045297',
                'correo'    => 'fredymoreno@uan.edu.co',
                'ciudad'    => 1,
                'id_empresa' => 1,
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
        Schema::dropIfExists('sucursales');
    }
}
