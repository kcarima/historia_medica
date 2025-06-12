<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisico extends Model
{
    use HasFactory;

    protected $table = 'fisico';

    protected $fillable = [
        'historia',
        'presion_arterial',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'temperatura',
        'saturacion_oxigeno',
        'peso',
        'talla',
        'examen_general',
        'examen_por_sistemas',
    ];
}
