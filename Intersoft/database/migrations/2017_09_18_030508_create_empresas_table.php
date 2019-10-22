<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('actividad');
            $table->string('correo');
            $table->string('nit_empresa');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('telefono1');
            $table->string('telefono2');
            $table->integer('ciudad');
            $table->integer('id_regimen');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('empresas')->insert(
            array(
                'id'        => NULL,
                'razon_social' => 'WAKUSOFT',
                'direccion' => 'CL 38 A 50 A 71',
                'actividad' => '9002',
                'dian_nit' => '1030570356',
                'nit_empresa' => '1030570356',
                'nombre' => 'WAKUSOFT',
                'telefono' => '77777',
                'telefono1' => '777777',
                'telefono2' => '777777',
                'ciudad' => 1,
                'id_regimen' => 1,
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
        Schema::dropIfExists('empresas');
    }
}
