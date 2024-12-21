<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table ='sucursales';

    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'tipo_sucursal',
        'estatus',
        'comentarios',
        'celular',
    ];
}
