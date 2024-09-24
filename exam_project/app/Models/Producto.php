<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku', 'nombre', 'descripcionCorta', 'descripcionLarga', 'imagen',
        'precioNeto', 'precioVenta', 'stockActual', 'stockMinimo',
        'stockBajo', 'stockAlto'
    ];
}
