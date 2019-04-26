<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
	protected $fillable = [
	'id_sucursal',
	'numero',
	'prefijo',
	'id_cliente',
	'id_tercero',
	'id_vendedor',
	'fecha',
	'fecha_vencimiento',
	'id_documento',
	'signo',
	'subtotal',
	'iva',
	'impoconsumo',
	'otro_impuesto',
	'otro_impuesto1',
	'descuento',
	'fletes',
	'retefuente',
	'total',
	'id_modificado',
	'observaciones',
	'estado',
	'saldo'
	];
}
