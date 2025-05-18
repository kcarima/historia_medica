<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $table = 'notas_operatorias';

    protected $fillable = [
        'paciente_id',
        'nota',
    ];

    // Relación con Paciente (opcional, si tienes pacientes)
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
