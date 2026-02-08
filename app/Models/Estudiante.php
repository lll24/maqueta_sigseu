<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'cedula'; //
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cedula', 
        'nombre', 
        'apellido', 
        'fecha_nacimiento', 
        'edad'
    ];

    /**
     * RELACIÓN: Un estudiante puede tener muchos reportes de beca.
     * Esto permite hacer: $estudiante->reportes
     */
    public function reportes()
    {
        return $this->hasMany(BecaReporte::class, 'estudiante_cedula', 'cedula');
    }
}