<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadInvoiceFileResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_invoice_file_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('success');
            $table->string('transaccionID');
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
        Schema::dropIfExists('upload_invoice_file_responses');
    }
}
