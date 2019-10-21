<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('ncedula');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cargo');
            $table->string('telefono');
            $table->string('password');
            $table->string('correo');
            $table->string('estado'); //activo - inactivo - suspendido
            $table->string('token');
            $table->string('arl');
            $table->string('eps');
            $table->string('cesantias');
            $table->string('pension');
            $table->string('caja_compensacion');
            $table->integer('id_contrato');
            $table->string('referencia_personal');
            $table->string('telefono_referencia');
            $table->integer('id_empresa');
            $table->timestamps();
        });


        // Insert some stuff
        DB::table('usuarios')->insert(
            array(
                'id'            => NULL,
                'ncedula'       => '1030570356',
                'nombre'        => 'FREDY ALEJANDRO',
                'apellido'      => 'MORENO CASTRO',
                'cargo'         => 'ADMINISTRADOR',
                'telefono'      => '3219045297',
                'password'      => '1234',
                'correo'        => 'FREDYMORENO@UAN.EDU.CO',
                'estado'        => 'ACTIVO',
                'token'         => '64836274832',
                'arl'           => 'POSITIVA',
                'eps'           => 'SANITAS',
                'cesantias'     => 'PORVENIR',
                'pension'       => 'PROVENIR',
                'caja_compensacion' => 'COLSUBSIDIO',
                'id_contrato'   => 1,
                'referencia_personal' => 'SOLEDAD CASTRO',
                'telefono_referencia' => '2644163',
                'id_empresa'    => 1
            )
        );
        DB::table('usuarios')->insert(
            array(
                'id'            => NULL,
                'ncedula'       => '123',
                'nombre'        => 'FREDY1 ALEJANDRO1',
                'apellido'      => 'MORENO1 CASTRO1',
                'cargo'         => 'INVENTARIO', //ADMINISTRADOR INVENTARIO CARTERA CONTABILIDAD
                'telefono'      => '3219045297',
                'password'      => '1234',
                'correo'        => '123@123.com',
                'estado'        => 'ACTIVO',
                'token'         => '64836274832',
                'arl'           => 'POSITIVA',
                'eps'           => 'SANITAS',
                'cesantias'     => 'PORVENIR',
                'pension'       => 'PROVENIR',
                'caja_compensacion' => 'COLSUBSIDIO',
                'id_contrato'   => 1,
                'referencia_personal' => 'SOLEDAD CASTRO',
                'telefono_referencia' => '2644163',
                'id_empresa'    => 1
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
        Schema::dropIfExists('usuarios');
    }
}
