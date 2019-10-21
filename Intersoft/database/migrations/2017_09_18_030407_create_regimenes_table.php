<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegimenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regimenes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('regimenes')->insert(
            array(
                'id'        => NULL,
                'nombre' => 'Régimen Único Simplificado',
                'descripcion' => 'Régimen Único Simplificado'
            ),
            array(
                'id'        => NULL,
                'nombre' => 'Régimen Especial de Impuesto a la Renta',
                'descripcion' => 'Régimen Especial de Impuesto a la Renta'
            ),
            array(
                'id'        => NULL,
                'nombre' => 'Régimen MYPE Tributario',
                'descripcion' => 'Régimen MYPE Tributario'
            ),
            array(
                'id'        => NULL,
                'nombre' => 'Régimen General ',
                'descripcion' => 'Régimen General '
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
        Schema::dropIfExists('regimenes');
    }
}
