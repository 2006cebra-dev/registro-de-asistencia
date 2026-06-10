<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Estudiante;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::with('estudiante.curso')
            ->orderBy('fecha', 'desc')
            ->paginate(15);

        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        $estudiantes = Estudiante::with('curso')->where('activo', true)->get();
        return view('asistencias.create', compact('estudiantes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'fecha'         => 'required|date',
            'hora_entrada'  => 'required',
        ]);

        Asistencia::create($validated);

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia registrada correctamente.');
    }

    public function show(Asistencia $asistencia)
    {
        $asistencia->load('estudiante.curso');

        return view('asistencias.show', compact('asistencia'));
    }

    public function marcarEntrada(Request $request)
    {
        $codigo = $request->input('codigo');

        $estudiante = Estudiante::where('codigo', $codigo)
            ->where('activo', true)
            ->first();

        if (!$estudiante) {
            return redirect()->back()
                ->with('error', 'Estudiante no encontrado o inactivo.');
        }

        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString();

        $asistenciaHoy = Asistencia::where('estudiante_id', $estudiante->id)
            ->where('fecha', $today)
            ->whereNull('hora_salida')
            ->first();

        if ($asistenciaHoy) {
            $asistenciaHoy->update(['hora_salida' => $now]);

            return redirect()->back()
                ->with('success', 'Salida registrada correctamente.');
        }

        Asistencia::create([
            'estudiante_id' => $estudiante->id,
            'fecha'         => $today,
            'hora_entrada'  => $now,
            'hora_salida'   => null,
        ]);

        return redirect()->back()
            ->with('success', 'Entrada registrada correctamente.');
    }
}
