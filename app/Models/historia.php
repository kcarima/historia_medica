<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $fillable = [
        'historia',          // número de historia
        'fecha_atencion',
        'motivo_consulta',
        'paciente_id',       // si tienes relación con paciente
    ];

    // Relación con Paciente (opcional)
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}

