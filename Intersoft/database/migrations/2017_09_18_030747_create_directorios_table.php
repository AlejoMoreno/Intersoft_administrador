<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directorios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nit');
            $table->string('digito');
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('correo');
            $table->string('telefono');
            $table->string('telefono1');
            $table->string('telefono2');
            $table->float('financiacion');
            $table->float('descuento');
            $table->float('cupo_financiero');
            $table->float('rete_ica');
            $table->float('porcentaje_rete_iva');
            $table->string('actividad_economica');
            $table->integer('calificacion');
            $table->string('nivel');
            $table->string('zona_venta');
            $table->string('transporte');
            $table->string('estado'); //activo inactivo suspendido
            $table->integer('id_retefuente');
            $table->integer('id_ciudad');
            $table->integer('id_regimen');
            $table->integer('id_usuario');
            $table->integer('id_directorio_tipo');
            $table->integer('id_directorio_clase');
            $table->integer('id_directorio_tipo_tercero');
            $table->integer('id_empresa');
            $table->timestamps();
        });

        DB::table('directorios')->insert(
            array(
                'id'        => NULL,
                'nit'       => '222222222',
                'digito'    => '0',
                'razon_social'=> 'MENORES CUANTIAS',
                'direccion' => 'XXX XXXX XXXX',
                'correo'    => 'XXXX@XXX.COM',
                'telefono'  => 'XXX XXXX XX',
                'telefono1' => 'XXX XXXX XX',
                'telefono2' => 'XXX XXXX XX',
                'financiacion'=> 0,
                'descuento' => 0,
                'cupo_financiero'=> 0,
                'rete_ica'  => 0,
                'porcentaje_rete_iva'=> 0,
                'actividad_economica'=> '0000',
                'calificacion'=> 3,
                'nivel'     => 'NACIONAL',
                'zona_venta'=> 'XXX XXX XXX',
                'transporte'=> 'NO',
                'estado'    => 'ACTIVO',
                'id_retefuente'=> 1,
                'id_ciudad' => 1,
                'id_regimen'=> 1,
                'id_usuario'=> 1,
                'id_directorio_tipo'=> 1,
                'id_directorio_clase'=> 3,
                'id_directorio_tipo_tercero'=> 1,
                'id_empresa'=> 1
            )
        );
        DB::table('directorios')->insert(
            array(
                'id'        => NULL,
                'nit'       => '222222222',
                'digito'    => '0',
                'razon_social'=> 'MENORES CUANTIAS',
                'direccion' => 'XXX XXXX XXXX',
                'correo'    => 'XXXX@XXX.COM',
                'telefono'  => 'XXX XXXX XX',
                'telefono1' => 'XXX XXXX XX',
                'telefono2' => 'XXX XXXX XX',
                'financiacion'=> 0,
                'descuento' => 0,
                'cupo_financiero'=> 0,
                'rete_ica'  => 0,
                'porcentaje_rete_iva'=> 0,
                'actividad_economica'=> '0000',
                'calificacion'=> 3,
                'nivel'     => 'NACIONAL',
                'zona_venta'=> 'XXX XXX XXX',
                'transporte'=> 'NO',
                'estado'    => 'ACTIVO',
                'id_retefuente'=> 1,
                'id_ciudad' => 1,
                'id_regimen'=> 1,
                'id_usuario'=> 1,
                'id_directorio_tipo'=> 2,
                'id_directorio_clase'=> 3,
                'id_directorio_tipo_tercero'=> 1,
                'id_empresa'=> 1
            )
        );
        DB::table('directorios')->insert(
            array(
                'id'        => NULL,
                'nit'       => '222222222',
                'digito'    => '0',
                'razon_social'=> 'MENORES CUANTIAS',
                'direccion' => 'XXX XXXX XXXX',
                'correo'    => 'XXXX@XXX.COM',
                'telefono'  => 'XXX XXXX XX',
                'telefono1' => 'XXX XXXX XX',
                'telefono2' => 'XXX XXXX XX',
                'financiacion'=> 0,
                'descuento' => 0,
                'cupo_financiero'=> 0,
                'rete_ica'  => 0,
                'porcentaje_rete_iva'=> 0,
                'actividad_economica'=> '0000',
                'calificacion'=> 3,
                'nivel'     => 'NACIONAL',
                'zona_venta'=> 'XXX XXX XXX',
                'transporte'=> 'NO',
                'estado'    => 'ACTIVO',
                'id_retefuente'=> 1,
                'id_ciudad' => 1,
                'id_regimen'=> 1,
                'id_usuario'=> 1,
                'id_directorio_tipo'=> 3,
                'id_directorio_clase'=> 3,
                'id_directorio_tipo_tercero'=> 1,
                'id_empresa'=> 1
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
        Schema::dropIfExists('directorios');
    }
}
