<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetefuentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retefuentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->float('valor');
            $table->string('descripcion');
            $table->timestamps();
        });

        DB::table('retefuentes')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'SOBRE TODO',
                'valor'     => 0,
                'descripcion' => 'Se realiza la retención sobre todo'
            )
        );
        DB::table('retefuentes')->insert(
            array(
                'id'        => NULL,
                'nombre'    => 'SOBRE LA BASE MENSUAL',
                'valor'     => 0,
                'descripcion' => 'Se realiza la base del mes en la venta'
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
        Schema::dropIfExists('retefuentes');
    }
}
