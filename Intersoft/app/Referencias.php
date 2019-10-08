<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencias extends Model
{
    /*
codigo_linea
codigo_letras
codigo_consecutivo
descripcion
codigo_barras
codigo_interno
codigo_alterno
id_presentacion
id_marca
factor_rendimiento
stok_minimo
stok_maximo
iva
impo_consumo
sobre_tasa
serie
descuento
id_clasificacion
peso
precio1
precio2
precio3
precio4
estado
hommologo
costo
costo_promedio
saldo
usuario_creador

    */
    protected $fillable = ['codigo_linea',
'codigo_letras',
'codigo_consecutivo',
'descripcion',
'codigo_barras',
'codigo_interno',
'codigo_alterno',
'id_presentacion',
'id_marca',
'factor_rendimiento',
'stok_minimo',
'stok_maximo',
'iva',
'impo_consumo',
'sobre_tasa',
'serie',
'descuento',
'id_clasificacion',
'peso',
'precio1',
'precio2',
'precio3',
'precio4',
'estado',
'hommologo',
'costo',
'costo_promedio',
'saldo',
'usuario_creador',
'cuentaDB',
'cuentaCR'];
}
