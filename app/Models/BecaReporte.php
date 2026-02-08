<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BecaReporte extends Model
{
    use HasFactory;

    protected $table = 'beca_reportes';

    // 1. CORRECCIÓN CLAVE: Solo dejamos lo que se guarda en la tabla de reportes
    // Debes incluir 'estudiante_cedula' para que Laravel no la ignore al guardar
    protected $fillable = [
        'estudiante_cedula', 
        'solicitud',
    ];

    /**
     * RELACIÓN: Ahora está en el lugar correcto.
     * Al estar en el MODELO y no en el controlador, Laravel ya no dará el error de la imagen 8fb402.
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_cedula', 'cedula');
    }
}