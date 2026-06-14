<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Support\Facades\Cache;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index()
    {
        $cursos = Curso::withCount('estudiantes')->where('activo', true)->get();
        return view('qr.index', compact('cursos'));
    }

    public function generar(Curso $curso)
    {
        $cacheKey = 'qr_curso_' . $curso->id;

        $qr = Cache::remember($cacheKey, now()->addDay(), function () use ($curso) {
            return QrCode::format('svg')
                ->size(400)
                ->margin(1)
                ->color(212, 168, 67)
                ->backgroundColor(10, 22, 40)
                ->generate($curso->codigo_registro);
        });

        return response($qr, 200)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'public, max-age=86400');
    }

    public function vista()
    {
        return view('qr.escanner');
    }
}
