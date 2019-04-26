<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carteras extends Model
{
    protected $fillable = ['reteiva',
		'reteica',
		'efectivo',
		'sobrecosto',
		'descuento',
		'retefuente',
		'otros',
		'id_sucursal',
		'numero',
		'prefijo',
		'id_cliente',
		'id_vendedor',
		'fecha',
		'tipoCartera',
		'subtotal',
		'total',
		'id_modificado',
		'observaciones',
		'estado'];
}
