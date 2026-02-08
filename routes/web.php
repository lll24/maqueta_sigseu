<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BecaController; // 1. IMPORTANTE: Agregamos esto para que reconozca el controlador de becas
use Illuminate\Support\Facades\Route;

// Pantalla de inicio (Login)
Route::get('/', function () {
    return view('auth.login');
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    
    // El dashboard carga los datos de los admins a través del UserController
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    // Rutas para el Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- GESTIÓN DE PERSONAL (ADMIN GLOBAL) ---
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    Route::patch('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // --- MÓDULO DE BECAS (SIGSEU) ---
    
    // 2. Ruta para guardar la nueva beca desde el modal
    Route::post('/becas', [BecaController::class, 'store'])->name('becas.store');

    // 3. Ruta para exportar el PDF Global (La que te daba error 500)
    Route::get('/becas/exportar-global', [BecaController::class, 'exportarGlobal'])->name('becas.global');

    // 4. Ruta para imprimir un solo reporte (Botón de la tabla)
    Route::get('/becas/exportar-individual/{id}', [BecaController::class, 'exportarIndividual'])->name('becas.individual');
// routes/web.php

Route::get('/estudiantes/buscar/{cedula}', [BecaController::class, 'buscarEstudiante']);
});

require __DIR__.'/auth.php';