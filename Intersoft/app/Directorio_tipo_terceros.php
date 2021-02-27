<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directorio_tipo_terceros extends Model
{
    protected $fillable = ['nombre','descripcion'];

    public function directorios(){
        return $this->belongsTo('App\Directorios');
    }
}
