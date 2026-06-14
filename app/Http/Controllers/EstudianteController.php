<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EstudianteController extends Controller
{
    public function index(Request $request)
    {
        $query = Estudiante::with(['curso', 'user'])->orderBy('nombre');

        if ($request->filled('estado')) {
            if ($request->estado === 'activos') {
                $query->where('activo', true);
            } elseif ($request->estado === 'inactivos') {
                $query->where('activo', false);
            }
        }

        $estudiantes = $query->get();
        $total = Estudiante::count();
        $activos = Estudiante::where('activo', true)->count();
        $inactivos = $total - $activos;
        $cursosCount = Curso::where('activo', true)->count();
        return view('estudiantes.index', compact('estudiantes', 'total', 'activos', 'inactivos', 'cursosCount'));
    }

    public function create()
    {
        $cursos = Curso::where('activo', true)->get();
        return view('estudiantes.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required',
            'email'    => 'required|unique:estudiantes,email',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $estudiante = Estudiante::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'curso_id' => $request->curso_id,
            'codigo'   => Str::random(20),
            'activo'   => true,
        ]);

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante registrado correctamente.');
    }

    public function show(Estudiante $estudiante)
    {
        $estudiante->load('curso', 'asistencias');
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit(Estudiante $estudiante)
    {
        $cursos = Curso::where('activo', true)->get();
        return view('estudiantes.edit', compact('estudiante', 'cursos'));
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'nombre'   => 'required',
            'email'    => 'required|unique:estudiantes,email,' . $estudiante->id,
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $estudiante->update($request->only('nombre', 'email', 'curso_id'));

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy(Estudiante $estudiante)
    {
        $estudiante->update(['activo' => false]);

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante desactivado correctamente.');
    }

    public function toggleActivo(Estudiante $estudiante)
    {
        $estudiante->update(['activo' => !$estudiante->activo]);

        $msg = $estudiante->activo ? 'activado' : 'desactivado';
        return redirect()->route('estudiantes.index')
            ->with('success', "Estudiante {$msg} correctamente.");
    }
}
