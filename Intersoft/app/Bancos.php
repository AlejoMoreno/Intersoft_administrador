<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bancos extends Model
{
    protected $fillable = ['nombre',
		'sucursal',
		'numero_de_cuenta',
		'cuenta_contable',
		'impuesto',
		'consecutivo_cheque',
		'id_empresa'];
}
