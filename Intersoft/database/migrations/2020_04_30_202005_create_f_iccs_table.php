<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFIccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_iccs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ICC_1');
            $table->string('ICC_2');
            $table->string('ICC_3');
            $table->string('ICC_4');
            $table->string('ICC_5');
            $table->string('ICC_6');
            $table->string('ICC_7');
            $table->string('ICC_8');
            $table->string('ICC_9');
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
        Schema::dropIfExists('f_iccs');
    }
}
