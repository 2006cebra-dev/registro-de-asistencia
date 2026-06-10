<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::with('curso')->where('activo', true)->get();
        return view('qr.index', compact('estudiantes'));
    }

    public function generar(Estudiante $estudiante)
    {

        $qr = QrCode::format('svg')->size(300)->generate($estudiante->codigo);

        return response($qr, 200)->header('Content-Type', 'image/svg+xml');
    }

    public function vista()
    {
        return view('qr.escanner');
    }
}
