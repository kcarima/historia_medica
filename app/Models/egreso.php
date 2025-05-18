<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;

    protected $table = 'diagnosticos_egreso';

    protected $fillable = [
        'paciente_id',
        'diagnostico_egreso',
        'recomendaciones_seguimiento',
    ];

    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
