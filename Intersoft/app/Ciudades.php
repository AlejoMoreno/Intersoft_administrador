<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    protected $fillable = ['codigo','nombre','id_departamento'];

    public function directorios(){
        return $this->belongsTo('App\Directorios');
    }
}
