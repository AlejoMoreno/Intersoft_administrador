<?php

namespace App\Facturatech;

use Illuminate\Database\Eloquent\Model;

class UploadInvoiceFileSend extends Model
{
    protected $fillable = ['username',
    'password',
    'xmlBase64',
    'estado',
    'id_insumo_xml',
    'id_empresa'];
}
