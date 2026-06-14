<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:docente|supervisor')->group(function () {
        Route::resource('cursos', CursoController::class);
        Route::get('/cursos/{curso}/asistencias/pdf', [CursoController::class, 'attendancePdf'])->name('cursos.attendance-pdf');
        Route::resource('estudiantes', EstudianteController::class);
        Route::patch('/estudiantes/{estudiante}/toggle', [EstudianteController::class, 'toggleActivo'])->name('estudiantes.toggle');
        Route::get('/qr', [QRController::class, 'index'])->name('qr.index');
    });

    Route::middleware('role:supervisor')->group(function () {
        Route::get('/usuarios/crear-docente', [UserController::class, 'createDocente'])->name('usuarios.crear-docente');
        Route::post('/usuarios/crear-docente', [UserController::class, 'storeDocente'])->name('usuarios.store-docente');
    });

    Route::get('/asistencias/export', [AsistenciaController::class, 'export'])->name('asistencias.export');
    Route::resource('asistencias', AsistenciaController::class);

    Route::post('/asistencias/marcar', [AsistenciaController::class, 'marcarEntrada'])->name('asistencias.marcar');

    Route::get('/qr/escanner', [QRController::class, 'vista'])->name('qr.escanner');
    Route::get('/qr/generar/{curso}', [QRController::class, 'generar'])->name('qr.generar');
    Route::get('/qr/curso/{curso}', [QRController::class, 'generar'])->name('qr.curso');
});

require __DIR__.'/auth.php';
