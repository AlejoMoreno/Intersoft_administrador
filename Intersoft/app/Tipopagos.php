<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopagos extends Model
{
    protected $fillable = ['nombre','puc_cuenta','puc_compra','tercero','id_empresa'];
}
