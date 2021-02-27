<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retefuentes extends Model
{
    protected $fillable = ['nombre','valor','descripcion'];

    public function directorios(){
        return $this->belongsTo('App\Directorios');
    }
}
