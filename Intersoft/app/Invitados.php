<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitados extends Model
{
    protected $fillable = ['correo','nombre','id_calendario','id_directorio'];
}
