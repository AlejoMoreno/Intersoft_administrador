<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopagos extends Model
{
    protected $fillable = ['nombre','puc_cuenta','tercero','id_empresa'];
}
