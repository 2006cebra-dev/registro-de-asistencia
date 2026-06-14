<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Curso;
use App\Models\Estudiante;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'codigo_registro' => ['required', 'string', 'exists:cursos,codigo_registro'],
            'codigo_docente' => ['nullable', 'string'],
        ]);

        $esDocente = $request->filled('codigo_docente') && $request->codigo_docente === env('DOCENTE_REGISTRATION_CODE', 'DOC2026');

        if ($esDocente) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'docente',
            ]);
        } else {
            $curso = Curso::where('codigo_registro', $request->codigo_registro)->first();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'estudiante',
            ]);

            Estudiante::create([
                'user_id' => $user->id,
                'nombre' => $request->name,
                'email' => $request->email,
                'curso_id' => $curso->id,
                'codigo' => Str::random(20),
                'activo' => true,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
