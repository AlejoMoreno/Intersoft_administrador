<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $fillable = ['razon_social', 'direccion', 'actividad', 'correo', 'nit_empresa', 'nombre', 
    'telefono', 'telefono1', 'telefono2',  'ciudad', 'id_regimen'];
}
