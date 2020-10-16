<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadPDFFileResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_p_d_f_file_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('success');
            $table->string('resourceData');
            $table->string('error');
            $table->string('respuestaok');
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
        Schema::dropIfExists('download_p_d_f_file_responses');
    }
}
