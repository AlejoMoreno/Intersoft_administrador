<?php

namespace App\Facturatech;

use Illuminate\Database\Eloquent\Model;

class DownloadPDFFileSend extends Model
{
    protected $fillable = ['username',
    'password',
    'prefijo',
    'folio',
    'id_empresa'];
}
