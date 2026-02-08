<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\BecaReporte;

class UserController extends Controller
{
    public function index()
{
    // 1. Buscamos a los administradores por sede (lo que ya tenías)
    $sedesConAdmin = User::where('role', '!=', 'admin_global')
        ->get()
        ->groupBy('sede');

    // 2. Buscamos los reportes de becas para la planilla
    $reportes = BecaReporte::with('estudiante')->latest()->get();

    // 3. Pasamos AMBAS cosas a la vista
    return view('dashboard', compact('sedesConAdmin', 'reportes'));
}

public function store(Request $request)
{
    // 1. Validación estricta
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|min:8',
        'sede' => 'required',
        'modulo' => 'required',
    ]);

    // 2. Creación con hashing de contraseña
    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'admin_modulo', // Rol automático para nuevos admins
        'sede' => $validated['sede'],
        'modulo' => $validated['modulo'],
    ]);

    return back()->with('status', 'Nuevo administrador registrado en la base de datos.');
}

    // ACTIVA LA EDICIÓN REAL
    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sede' => 'required',
            'modulo' => 'required',
        ]);

        $user->update($validated);

        return redirect()->route('dashboard')->with('status', 'Administrador actualizado.');
    }

    public function destroy(User $user) {
        if (Auth::id() === $user->id) {
            return back()->with('error', 'No puedes eliminarte a ti mismo.');
        }
        $user->delete();
        return back()->with('status', 'Administrador eliminado.');
    }
}