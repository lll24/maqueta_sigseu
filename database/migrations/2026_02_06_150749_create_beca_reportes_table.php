<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beca_reportes', function (Blueprint $table) {
            $table->id();
            
            // 1. Relación con la tabla estudiantes
            // Usamos 'estudiante_cedula' para conectar con la primaria de la otra tabla
            $table->string('estudiante_cedula');
            
            // 2. Definimos la clave foránea (la conexión oficial)
            $table->foreign('estudiante_cedula')
                  ->references('cedula')
                  ->on('estudiantes')
                  ->onDelete('cascade'); // Si se borra el alumno, se borra el reporte

            // 3. Datos específicos del reporte
            $table->string('solicitud')->default('Beca');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beca_reportes');
    }
};