<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    use HasFactory;
    protected $table ='seguros';

    protected $fillable = [
        'comprobante',
        'vencimiento',
        'tipo_seguro_seguro',
        'tramito_seguro_seguro',
        'descripcion_seguro_seguro',
        'no_poliza_seguro',
        'nombre_seguro',
        'ap_paterno_seguro',
        'ap_materno_seguro',
        'telefono_seguro',
        'placa_seguro',
        'modelo_seguro',
        'marca_seguro',
        'tipo_seguro',
        'serie_seguro',
    ];

    public function afiliacion()
    {
        return $this->belongsTo(Afiliacion::class, 'id_afiliacion');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
