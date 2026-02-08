<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        $integrantes = [
            ['cedula' => '31782782', 'nombre' => 'Diego', 'apellido' => 'Blanco', 'nacimiento' => '2002-11-30'],
            ['cedula' => '30810484', 'nombre' => 'Fernando', 'apellido' => 'Centeno', 'nacimiento' => '2004-05-15'],
            ['cedula' => '30857207', 'nombre' => 'Jesús', 'apellido' => 'Guzmán', 'nacimiento' => '2004-08-20'],
            ['cedula' => '31882343', 'nombre' => 'Juan David', 'apellido' => 'Longart', 'nacimiento' => '2005-02-10'],
            ['cedula' => '24482932', 'nombre' => 'Jose', 'apellido' => 'Miserol', 'nacimiento' => '2005-02-10'],
            ['cedula' => '31317970', 'nombre' => 'Adrián', 'apellido' => 'Reina', 'nacimiento' => '2003-01-25'],
            ['cedula' => '24482932', 'nombre' => 'Jose', 'apellido' => 'Miserol', 'nacimiento' => '2005-02-10'],
            ['cedula' => '31882367', 'nombre' => 'Rafael', 'apellido' => 'Rodriguez', 'nacimiento' => '2005-02-10'],
            // Agrega aquí los 2 restantes del anteproyecto
        ];

        foreach ($integrantes as $persona) {
            Estudiante::create([
                'cedula' => $persona['cedula'],
                'nombre' => $persona['nombre'],
                'apellido' => $persona['apellido'],
                'fecha_nacimiento' => $persona['nacimiento'],
                'edad' => Carbon::parse($persona['nacimiento'])->age,
            ]);
        }
    }
}