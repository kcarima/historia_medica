<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class historia extends Model
{
    protected $table = 'historias';

    protected $fillable = [
        'genero',
        'primer_apellido',
        'segundo_apellido',
        'nombre',
        'cedula',
        'telefono_local',
        'grupo_sanguineo',
        'estado_civil',
        'fecha_nacimiento',
        'correo_electronico',
        'celular',
        'edad',
        'direccion',
        'municipio',
        'parroquia',
    ];
}
