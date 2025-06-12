<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'genero',
        'primer_apellido',
        'segundo_apellido',
        'nombre',
        'cedula',
        'grupo_sanguineo',
        'estado_civil',
        'fecha_nacimiento',
        'correo_electronico',
        'telefono_local',
        'celular',
        'direccion',
        'municipio',
        'parroquia',
        'historia',
        'de_alta', // nuevo campo para saber si el paciente está de alta
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'de_alta' => 'boolean',
    ];

    /**
     * Relación con las historias clínicas del paciente.
     */
    public function historias()
    {
        return $this->hasMany(Historia::class);
    }


    /**
     * Accesor para el nombre completo.
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->primer_apellido} {$this->segundo_apellido} {$this->nombre}";
    }

    /**
     * Accesor para la fecha de nacimiento formateada.
     */
    public function getFechaNacimientoFormateadaAttribute()
    {
        return $this->fecha_nacimiento->format('d/m/Y');
    }

    /**
     * Mutador para asegurar mayúsculas en nombres y apellidos.
     */
    public function setPrimerApellidoAttribute($value)
    {
        $this->attributes['primer_apellido'] = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }

    public function setSegundoApellidoAttribute($value)
    {
        $this->attributes['segundo_apellido'] = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }

    /**
     * Mutador para limpiar formato de teléfonos.
     */
    public function setTelefonoLocalAttribute($value)
    {
        $this->attributes['telefono_local'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setCelularAttribute($value)
    {
        $this->attributes['celular'] = preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * Scope para búsqueda por cédula.
     */
    public function scopePorCedula($query, $cedula)
    {
        return $query->where('cedula', $cedula);
    }

    /**
     * Scope para búsqueda por historia clínica.
     */
    public function scopePorHistoria($query, $historia)
    {
        return $query->where('historia', $historia);
    }

    /**
     * Scope para búsqueda por nombre o apellido.
     */
    public function scopePorNombre($query, $nombre)
    {
        return $query->where('nombre', 'like', "%$nombre%")
                    ->orWhere('primer_apellido', 'like', "%$nombre%")
                    ->orWhere('segundo_apellido', 'like', "%$nombre%");
    }
public function reportes()
{
    return $this->hasMany(ReporteEnfermeria::class);
}
}
