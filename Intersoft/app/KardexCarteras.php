<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KardexCarteras extends Model
{
    //
    protected $fillable = [
    	'id_cartera',
    	'id_factura',
		'fechaFactura',
		'numeroFactura',
		'descuentos',
		'sobrecostos',
		'fletes',
		'retefuente',
		'efectivo',
		'reteiva',
		'reteica',
		'total',
		'id_auxiliar'];
}
