<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $table = 'diagnosticos';

    protected $fillable = [
        'paciente_id',
        'diagnostico',
        'fecha_diagnostico',
        'plan_tratamiento',
        'tratamiento_farmacologico',
        'ordenes_examenes',
        'evolucion',
        'interconsultas',
        'observaciones',
    ];

    protected $dates = [
        'fecha_diagnostico',
    ];

    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
