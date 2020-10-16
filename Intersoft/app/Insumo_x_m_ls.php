<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo_x_m_ls extends Model
{
    protected $fillable = [
	    'id_factura',
		'id_sucursal',
		'id_empresa',
        'id_cliente',
        'enviado'];
}
