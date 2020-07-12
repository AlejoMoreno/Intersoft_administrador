<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFEncsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_encs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ENC_1');
            $table->string('ENC_2');
            $table->string('ENC_3');
            $table->string('ENC_4');
            $table->string('ENC_5');
            $table->string('ENC_6');
            $table->string('ENC_7');
            $table->string('ENC_8');
            $table->string('ENC_9');
            $table->string('ENC_10');
            $table->string('ENC_15');
            $table->string('ENC_16');
            $table->string('ENC_20');
            $table->string('ENC_21');
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
        Schema::dropIfExists('f_encs');
    }
}
