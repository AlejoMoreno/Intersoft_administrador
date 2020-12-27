<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
	protected $fillable = [
	'numero',
	'prefijo',
	'id_cliente',
	'id_factura',
	'id_vendedor',
	'fecha',
	'id_referencia',
	'lote',
	'serial',
	'fecha_vencimiento',
	'cantidad',
	'precio',
	'costo',
	'id_documento',
	'signo',
	'subtotal',
	'iva',
	'impoconsumo',
	'cree',
	'reteica',
	'descuento',
	'fletes',
	'retefuente',
	'total',
	'observaciones',
	'id_modificado',
	'kardex_anterior',
	'estado',
	'reteiva'
	];
    
}
