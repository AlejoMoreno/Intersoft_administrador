<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFEmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_emis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('EMI_1');
            $table->string('EMI_2');
            $table->string('EMI_3');
            $table->string('EMI_4');
            $table->string('EMI_5');
            $table->string('EMI_6');
            $table->string('EMI_7');
            $table->string('EMI_8');
            $table->string('EMI_9');
            $table->string('EMI_10');
            $table->string('EMI_11');
            $table->string('EMI_12');
            $table->string('EMI_13');
            $table->string('EMI_14');
            $table->string('EMI_15');
            $table->string('EMI_16');
            $table->string('EMI_17');
            $table->string('EMI_18');
            $table->string('EMI_19');
            $table->string('EMI_20');
            $table->string('EMI_21');
            $table->string('EMI_22');
            $table->string('EMI_23');
            $table->string('EMI_24');
            $table->string('EMI_25');
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
        Schema::dropIfExists('f_emis');
    }
}
