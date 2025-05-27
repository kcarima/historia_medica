<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'primer_apellido',
        'segundo_apellido',
        'nombre',
        'fecha_nacimiento',
        'historia',
        'telefono_local',
        'celular',
        'direccion',
    ];
}
