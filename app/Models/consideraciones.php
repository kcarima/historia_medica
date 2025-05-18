<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consideraciones extends Model
{
    use HasFactory;

    protected $table = 'consideraciones_ninos';

    protected $fillable = [
        'paciente_id',
        'nombre_representante',
        'identificacion_representante',
        'relacion_representante',
        'desarrollo_psicomotor_nino',
        'esquema_vacunacion',
    ];

    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
