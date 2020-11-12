<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cierrecarterasaldos extends Model
{
    protected $fillable = ['id_tercero','fecha','saldo','estado','id_empresa'];
}
