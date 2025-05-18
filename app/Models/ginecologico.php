<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ginecologico extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_ginecologicos';

    protected $fillable = [
        'paciente_id',
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

    protected $dates = [
        'fecha_ultima_menstruacion',
        'fecha_ultimo_parto',
    ];

    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
