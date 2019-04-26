<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $fillable = ['ncedula','nombre','apellido','cargo','telefono','password','correo','estado'
        ,'token','arl','eps','cesantias','pension','caja_compensacion','id_contrato','referencia_personal','telefono_referencia'];
}
