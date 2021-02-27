<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regimenes extends Model
{
    protected $fillable = ['nombre','descripcion'];

    public function directorios(){
        return $this->belongsTo('App\Directorios');
    }
}
