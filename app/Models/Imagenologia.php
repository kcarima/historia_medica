<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagenologia extends Model
{
    protected $fillable = ['tipo', 'ruta', 'es_documento'];
    public $timestamps = false;

    /**
     * Devuelve la URL pública del archivo almacenado.
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->ruta);
    }

    /**
     * Devuelve la carpeta de almacenamiento según el tipo seleccionado.
     */
    public static function carpetaPorTipo($tipo, $esDocumento = false)
    {
        if ($esDocumento) {
            return 'documentos/' . $tipo;
        }
        return 'imagenologia/' . $tipo;
    }

    // Permite subir imágenes o documentos usando el disco 'public'
    public static function guardarArchivo($file, $tipo, $esDocumento = false)
    {
        $directorio = self::carpetaPorTipo($tipo, $esDocumento);
        $path = $file->store($directorio, 'public');
        return self::create([
            'tipo' => $tipo,
            'ruta' => $path,
            'es_documento' => $esDocumento,
        ]);
    }
}
