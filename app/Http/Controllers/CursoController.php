<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::where('activo', true)->get();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'codigo_registro' => 'required|string|unique:cursos,codigo_registro',
            'descripcion' => 'nullable',
        ]);

        Curso::create([
            'nombre' => $request->nombre,
            'codigo_registro' => strtoupper($request->codigo_registro),
            'descripcion' => $request->descripcion,
            'activo' => true,
        ]);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso creado exitosamente.');
    }

    public function show(Curso $curso)
    {
        return view('cursos.show', [
            'curso' => $curso,
            'estudiantes' => $curso->estudiantes,
        ]);
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required',
            'codigo_registro' => 'required|string|unique:cursos,codigo_registro,' . $curso->id,
            'descripcion' => 'nullable',
        ]);

        $curso->update([
            'nombre' => $request->nombre,
            'codigo_registro' => strtoupper($request->codigo_registro),
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado exitosamente.');
    }

    public function destroy(Curso $curso)
    {
        $curso->update(['activo' => false]);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso desactivado exitosamente.');
    }
}
