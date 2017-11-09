<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendarios extends Model
{
    protected $fillable = ['titulo','fecha_inicio','hora_inicio','fecha_final','hora_final','lugar','descripcion','color','notificacion','valor','periodicidad'];    
}
