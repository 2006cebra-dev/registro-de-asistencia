<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Curso;
use App\Models\Estudiante;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Asistencia::with('estudiante.curso');

        if ($user->rol === 'estudiante') {
            $estudiante = $user->estudiante;
            if ($estudiante) {
                $query->where('estudiante_id', $estudiante->id);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }
        if ($request->filled('curso_id')) {
            $query->whereHas('estudiante', fn($q) => $q->where('curso_id', $request->curso_id));
        }

        $asistencias = $query->orderBy('fecha', 'desc')
            ->orderBy('hora_entrada', 'desc')
            ->paginate(20)
            ->withQueryString();

        $cursos = Curso::where('activo', true)->get();

        return view('asistencias.index', compact('asistencias', 'cursos', 'user'));
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
        $asistencia->load('estudiante.curso', 'estudiante.user');
        return view('asistencias.show', compact('asistencia'));
    }

    public function export(Request $request)
    {
        $query = Asistencia::with('estudiante.curso', 'estudiante.user');

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }
        if ($request->filled('curso_id')) {
            $query->whereHas('estudiante', fn($q) => $q->where('curso_id', $request->curso_id));
        }

        $asistencias = $query->orderBy('fecha', 'desc')->orderBy('hora_entrada', 'desc')->get();
        $cursos = Curso::where('activo', true)->get();
        $cursoFiltro = $request->filled('curso_id') ? Curso::find($request->curso_id) : null;

        return view('asistencias.export', compact('asistencias', 'cursos', 'cursoFiltro'));
    }

    public function marcarEntrada(Request $request)
    {
        $codigo = $request->input('codigo');
        $user = $request->user();

        if ($user->rol !== 'estudiante' || !$user->estudiante) {
            return redirect()->back()
                ->with('error', 'Solo los estudiantes pueden marcar asistencia.');
        }

        $curso = Curso::where('codigo_registro', $codigo)->where('activo', true)->first();

        if (!$curso) {
            return redirect()->back()
                ->with('error', 'Código de curso inválido o curso inactivo.');
        }

        $estudiante = $user->estudiante;

        if ($estudiante->curso_id !== $curso->id) {
            return redirect()->back()
                ->with('error', 'No estás inscrito en este curso.');
        }

        $now = Carbon::now();

        Asistencia::create([
            'estudiante_id' => $estudiante->id,
            'fecha'         => $now->toDateString(),
            'hora_entrada'  => $now->toTimeString(),
        ]);

        return redirect()->back()
            ->with('success', 'Entrada registrada correctamente.');
    }
}
