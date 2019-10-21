<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre');
            $table->string('signo');
            $table->string('ubicacion');
            $table->string('prefijo');
            $table->string('num_max');
            $table->string('num_min');
            $table->string('num_presente');
            $table->string('cuenta_contable_partida');
            $table->string('cuenta_contable_contrapartida');
            $table->integer('id_empresa');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('documentos')->insert(
            array(
                'id'        => NULL,
                'nombre' => 'FACTURA',
                'signo' => '-',
                'ubicacion' => 'SALIDA',
                'prefijo' => '',
                'num_max' => '100',
                'num_min' => '0',
                'num_presente' => '0',
                'cuenta_contable_partida' => '897867879',
                'cuenta_contable_contrapartida' => '789472843',
                'id_empresa' => 1
            ),
            array(
                'id'        => NULL,
                'nombre' => 'FACTURA VENTA',
                'signo' => '-',
                'ubicacion' => 'SALIDA',
                'prefijo' => '',
                'num_max' => '100',
                'num_min' => '0',
                'num_presente' => '0',
                'cuenta_contable_partida' => '897867879',
                'cuenta_contable_contrapartida' => '789472843',
                'id_empresa' => 1
            ),
            array(
                'id'        => NULL,
                'nombre' => 'FACTURA COMPRA',
                'signo' => '+',
                'ubicacion' => 'ENTRADA',
                'prefijo' => '',
                'num_max' => '100',
                'num_min' => '0',
                'num_presente' => '0',
                'cuenta_contable_partida' => '897867879',
                'cuenta_contable_contrapartida' => '789472843',
                'id_empresa' => 1
            ),
            array(
                'id'        => NULL,
                'nombre' => 'ORDEN DE PEDIDO',
                'signo' => '=',
                'ubicacion' => 'ENTRADA',
                'prefijo' => '',
                'num_max' => '100',
                'num_min' => '0',
                'num_presente' => '0',
                'cuenta_contable_partida' => '897867879',
                'cuenta_contable_contrapartida' => '789472843',
                'id_empresa' => 1
            ),
            array(
                'id'        => NULL,
                'nombre' => 'COTIZACION',
                'signo' => '=',
                'ubicacion' => 'SALIDA',
                'prefijo' => '',
                'num_max' => '100',
                'num_min' => '0',
                'num_presente' => '0',
                'cuenta_contable_partida' => '897867879',
                'cuenta_contable_contrapartida' => '789472843',
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
        Schema::dropIfExists('documentos');
    }
}
