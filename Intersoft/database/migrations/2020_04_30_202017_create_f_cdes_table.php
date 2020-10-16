<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFCdesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_cdes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CDE_1');
            $table->string('CDE_2');
            $table->string('CDE_3');
            $table->string('CDE_4');
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
        Schema::dropIfExists('f_cdes');
    }
}
