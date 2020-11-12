<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cierreinventarios extends Model
{
    protected $fillable = ['id_referencia','fecha','saldo','estado','id_empresa'];
}
