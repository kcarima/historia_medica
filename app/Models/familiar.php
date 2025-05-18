<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_familiares';

    protected $fillable = [
        'paciente_id',
        'enfermedades_padres',
        'otra_enfermedad_padres',
        'hermanos',
        'detalle_hermanos',
        'observaciones',
    ];

    protected $casts = [
        'enfermedades_padres' => 'array', // Para manejar JSON automáticamente
    ];

    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
