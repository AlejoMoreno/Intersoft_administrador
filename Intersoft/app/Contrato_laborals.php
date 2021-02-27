<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato_laborals extends Model
{
    protected $fillable = ['tipo_contrato','descripcion','consecutivo','fecha_inicial','fecha_final'];

    public function usuarios(){
        return $this->belongsTo('App\Usuarios');
    }
}
