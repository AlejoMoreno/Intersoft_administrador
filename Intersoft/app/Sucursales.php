<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    protected $fillable = ['nombre','codigo','direccion','encargado','telefono','correo','ciudad','id_empresa'];
}
