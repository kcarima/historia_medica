<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisico extends Model
{
    use HasFactory;

    protected $table = 'examenes_fisicos';

    protected $fillable = [
        'paciente_id',
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

    // Castings para los campos numéricos
    protected $casts = [
        'frecuencia_cardiaca' => 'integer',
        'frecuencia_respiratoria' => 'integer',
        'temperatura' => 'float',
        'saturacion_oxigeno' => 'integer',
        'peso' => 'float',
        'talla' => 'float',
    ];

    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
