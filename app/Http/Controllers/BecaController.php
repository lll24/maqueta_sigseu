<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\BecaReporte;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BecaController extends Controller
{
    /**
     * Muestra la lista de reportes con los datos del estudiante.
     */
    public function index()
{
    // Buscamos todos los reportes con sus dueños (estudiantes)
    $reportes = BecaReporte::with('estudiante')->latest()->get();
    return view('dashboard', compact('reportes')); // Si usas @include, se queda en dashboard
}

public function store(Request $request)
{
    $request->validate([
        'cedula' => 'required|string',
        'nombre' => 'required|string',
        'apellido' => 'required|string',
        'fecha_nacimiento' => 'required|date',
    ]);

    // Crear/Actualizar Estudiante
    $estudiante = \App\Models\Estudiante::updateOrCreate(
        ['cedula' => $request->cedula],
        [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'edad' => \Carbon\Carbon::parse($request->fecha_nacimiento)->age,
        ]
    );

    // Crear Reporte
    BecaReporte::create([
        'estudiante_cedula' => $estudiante->cedula,
        'solicitud' => $request->solicitud ?? 'Beca'
    ]);

    return back()->with('status', 'Reporte de ' . $estudiante->nombre . ' registrado con éxito.');
}

    /**
     * Exportar reporte individual (PDF).
     */
    public function exportarIndividual($id)
    {
        $reporte = BecaReporte::with('estudiante')->findOrFail($id);
        $pdf = Pdf::loadView('becas.pdf_individual', compact('reporte'));
        return $pdf->download("beca_{$reporte->estudiante_cedula}.pdf");
    }

    /**
     * Exportar todos los reportes de un "coñazo" (PDF Global).
     */
    public function exportarGlobal()
    {
        $reportes = BecaReporte::with('estudiante')->get();
        $pdf = Pdf::loadView('becas.pdf_global', compact('reportes'));
        return $pdf->download("reportes_globales_becas.pdf");
    }
    public function buscarEstudiante($cedula)
{
    // Buscamos al estudiante en la tabla estudiantes por su cédula
    $estudiante = \App\Models\Estudiante::where('cedula', $cedula)->first();

    if ($estudiante) {
        return response()->json([
            'existe' => true,
            'nombre' => $estudiante->nombre,
            'apellido' => $estudiante->apellido,
            'fecha_nacimiento' => $estudiante->fecha_nacimiento,
        ]);
    }

    return response()->json(['existe' => false]);
}
}