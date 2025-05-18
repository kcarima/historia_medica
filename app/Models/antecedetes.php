<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class antecedetes extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_personales';

    protected $fillable = [
        'paciente_id',
        // Fisiológicos
        'desarrollo_psicomotor',
        'alimentacion',
        'sueno',
        'eliminacion',
        'vacunacion',
        'alergias',
        'habitos',
        // Patológicos
        'enfermedades_previas',
        'cirugias',
        'hospitalizaciones',
        'traumatismos',
        'congenitas_perinatales'
    ];

    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
