<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function createDocente(): View
    {
        $docentes = User::where('rol', 'docente')->orderBy('name')->get();
        $estudiantes = User::where('rol', 'estudiante')->with('estudiante.curso')->orderBy('name')->get();
        $supervisores = User::where('rol', 'supervisor')->orderBy('name')->get();
        return view('usuarios.crear-docente', compact('docentes', 'estudiantes', 'supervisores'));
    }

    public function storeDocente(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'docente',
        ]);

        return redirect()->route('usuarios.crear-docente')
            ->with('success', 'Docente creado correctamente.');
    }
}
