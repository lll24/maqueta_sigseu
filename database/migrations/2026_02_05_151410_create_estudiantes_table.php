<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Aquí es donde creamos la tabla Estudiantes.
     */
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->string('cedula')->primary(); // Llave primaria (no se repite)
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Esto borra la tabla si algo sale mal (el "deshacer").
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};