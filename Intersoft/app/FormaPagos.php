<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPagos extends Model
{
    protected $fillable = [
	    'formaPago',
		'id_cartera',
		'id_banco',
		'valor',
		'observacion'];
}
