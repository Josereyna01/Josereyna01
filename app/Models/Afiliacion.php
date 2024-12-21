<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Afiliacion extends Model
{
    use HasFactory;
    protected $table ='afiliaciones';

    protected $fillable = [
    'nombre_uno',
    'ap_paterno_uno',
    'ap_materno_uno',
    'tel_uno',
    'nombre_dos',
    'ap_paterno_dos',
    'ap_materno_dos',
    'tel_dos',
    'nombre_tres',
    'ap_paterno_tres',
    'ap_materno_tres',
    'tel_tres',
    'seccion',
    'municipio',
    'colonia',
    'calle',
    'no_casa',
    'placa',
    'modelo',
    'marca',
    'tipo',
    'color',
    'serie',   
    'tramito_seguro',
    'tipo_seguro',
    'descripcion_seguro',  
    'no_poliza', 
    'metodo_pago',  
    'comprobante',            
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seguros()
    {
        return $this->hasMany(Seguro::class, 'id_afiliacion');
    }
}
