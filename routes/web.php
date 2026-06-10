<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\QRController;
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

    Route::middleware('role:docente')->group(function () {
        Route::resource('cursos', CursoController::class);
        Route::resource('estudiantes', EstudianteController::class);
        Route::get('/qr', [QRController::class, 'index'])->name('qr.index');
    });

    Route::resource('asistencias', AsistenciaController::class);

    Route::post('/asistencias/marcar', [AsistenciaController::class, 'marcarEntrada'])->name('asistencias.marcar');

    Route::get('/qr/escanner', [QRController::class, 'vista'])->name('qr.escanner');
    Route::get('/qr/generar/{estudiante}', [QRController::class, 'generar'])->name('qr.generar');
});

require __DIR__.'/auth.php';
