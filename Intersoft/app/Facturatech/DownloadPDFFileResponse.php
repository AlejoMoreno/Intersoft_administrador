<?php

namespace App\Facturatech;

use Illuminate\Database\Eloquent\Model;

class DownloadPDFFileResponse extends Model
{
    protected $fillable = ['code',
    'success',
    'resourceData',
    'error',
    'respuestaok'];
}
