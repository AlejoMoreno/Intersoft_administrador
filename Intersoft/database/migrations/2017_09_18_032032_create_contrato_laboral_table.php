<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_laborals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipo_contrato');
            $table->text('descripcion');
            $table->integer('consecutivo');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->integer('id_empresa');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('contrato_laborals')->insert(
            array(
                'id'        => NULL,
                'tipo_contrato' => 'CONTRATO NUMERO 1',
                'descripcion' => 'CONTRATO NUMERO 1',
                'consecutivo' => 1,
                'fecha_inicial' => '2018-01-01',
                'fecha_final' => '2018-01-01',
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
        Schema::dropIfExists('contrato_laboral');
    }
}
