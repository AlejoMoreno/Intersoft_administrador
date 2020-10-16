<?php

namespace App\Facturatech;

use Illuminate\Database\Eloquent\Model;

class UploadInvoiceFileResponse extends Model
{
    protected $fillable = ['code',
    'success',
    'transaccionID',
    'error',
    'respuestaok'];
}
