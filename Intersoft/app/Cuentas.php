<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentas extends Model
{
    protected $fillable = ['clase',
		'nombreClase',
		'grupo',
		'nombreGrupo',
		'cuenta',
		'nombreCuenta',
		'subcuenta',
		'nombreSubcuenta',
		'auxiliar',
		'nombreAuxiliar',
		'homologo',
		'homologo_1'
	];
}
