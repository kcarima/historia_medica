<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    use HasFactory;

    protected $table = 'anamnesis';

    protected $fillable = [
        'historia',
        'enfermedad_actual',
        'desarrollo_psicomotor',
        'alimentacion',
        'sueno',
        'eliminacion',
        'vacunacion',
        'alergias',
        'habitos',
        'enfermedades_previas',
        'cirugias',
        'hospitalizaciones',
        'traumatismos',
        'congénitas_perinatales',
        'enfermedades_padres',
        'otra_enfermedad_padres',
        'hermanos',
        'detalle_hermanos',
        'observaciones',
        'menarquia',
        'ciclo_menstrual',
        'duracion_menstrual',
        'dolor_menstrual',
        'embarazos',
        'partos',
        'abortos',
        'cesareas',
        'metodo_anticonceptivo',
        'fecha_ultima_menstruacion',
        'fecha_ultimo_parto',
        'complicaciones_embarazo',
    ];

    protected $casts = [
        'enfermedades_padres' => 'array',
        'fecha_ultima_menstruacion' => 'date',
        'fecha_ultimo_parto' => 'date',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'historia', 'historia');
    }
}
