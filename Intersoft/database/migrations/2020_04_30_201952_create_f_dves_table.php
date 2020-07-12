<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFDvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_dfes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DFE_1');
            $table->string('DFE_2');
            $table->string('DFE_3');
            $table->string('DFE_4');
            $table->string('DFE_5');
            $table->string('DFE_6');
            $table->string('DFE_7');
            $table->string('DFE_8');
            $table->integer('id_empresa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('f_dves');
    }
}
