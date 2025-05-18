<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $table = 'pacientes';
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
        'direccion',
        'municipio',
        'parroquia',
    ];

    /**
     * Los atributos que deben ser ocultados para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // Puedes añadir aquí atributos que no quieras que se muestren al convertir el modelo a JSON o array.
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_nacimiento' => 'date', // Esto asegura que la fecha de nacimiento se maneje como un objeto Carbon.
    ];
}
