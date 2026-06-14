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
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = [
            'nombre' => $request->nombre,
            'codigo_registro' => strtoupper($request->codigo_registro),
            'descripcion' => $request->descripcion,
            'activo' => true,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('cursos', 'public');
        }

        Curso::create($data);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso creado exitosamente.');
    }

    public function show(Curso $curso)
    {
        $estudiantes = $curso->estudiantes()->with(['user', 'asistencias' => function ($q) {
            $q->orderBy('fecha', 'desc')->orderBy('hora_entrada', 'desc');
        }])->get();

        return view('cursos.show', [
            'curso' => $curso,
            'estudiantes' => $estudiantes,
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
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = [
            'nombre' => $request->nombre,
            'codigo_registro' => strtoupper($request->codigo_registro),
            'descripcion' => $request->descripcion,
        ];

        if ($request->hasFile('foto')) {
            if ($curso->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($curso->foto);
            }
            $data['foto'] = $request->file('foto')->store('cursos', 'public');
        }

        $curso->update($data);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado exitosamente.');
    }

    public function attendancePdf(Curso $curso)
    {
        $estudiantes = $curso->estudiantes()
            ->with(['asistencias' => fn($q) => $q->orderBy('fecha', 'desc')->orderBy('hora_entrada', 'desc'), 'user'])
            ->where('activo', true)
            ->get();

        return view('cursos.attendance-pdf', compact('curso', 'estudiantes'));
    }

    public function destroy(Curso $curso)
    {
        $curso->update(['activo' => false]);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso desactivado exitosamente.');
    }
}
