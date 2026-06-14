<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Asistencias</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Figtree', sans-serif; background: #fff; color: #111; padding: 2rem; }
        @media print { body { padding: 0.5in; } @page { margin: 0; } }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 0.6rem 0.75rem; font-size: 0.7rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e5e7eb; background: #f9fafb; }
        td { padding: 0.65rem 0.75rem; font-size: 0.8rem; color: #374151; border-bottom: 1px solid #f3f4f6; }
        tr:last-child td { border-bottom: none; }
        .avatar { width: 2rem; height: 2rem; border-radius: 0.5rem; object-fit: cover; display: inline-block; vertical-align: middle; margin-right: 0.5rem; }
        .avatar-placeholder { width: 2rem; height: 2rem; border-radius: 0.5rem; display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #d4a843, #a16207); color: #fff; font-weight: 700; font-size: 0.75rem; vertical-align: middle; margin-right: 0.5rem; }
        .badge { display: inline-block; padding: 0.15rem 0.6rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #fef3c7; color: #92400e; }
    </style>
</head>
<body>
    <div class="max-w-5xl mx-auto">
        <div class="border-b-2 border-yellow-500 pb-5 mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Reporte de Asistencias</h1>
                <p class="text-gray-500 text-sm mt-1">
                    {{ $cursoFiltro ? 'Curso: ' . $cursoFiltro->nombre . ' | ' : '' }}
                    {{ request('fecha_desde') ? 'Desde: ' . \Carbon\Carbon::parse(request('fecha_desde'))->format('d/m/Y') : 'Todo el historial' }}
                    {{ request('fecha_hasta') ? ' | Hasta: ' . \Carbon\Carbon::parse(request('fecha_hasta'))->format('d/m/Y') : '' }}
                </p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold text-yellow-600">{{ $asistencias->count() }}</p>
                <p class="text-xs text-gray-500">registros</p>
            </div>
        </div>

        <div class="border border-gray-200 rounded-xl overflow-hidden">
            <table>
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        <th>Curso</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($asistencias as $asistencia)
                    @php
                        $est = $asistencia->estudiante;
                        $fotoUrl = $est->user?->foto ? asset('storage/' . $est->user->foto) : null;
                    @endphp
                    <tr>
                        <td>
                            @if ($fotoUrl)
                                <img src="{{ $fotoUrl }}" alt="" class="avatar">
                            @else
                                <span class="avatar-placeholder">{{ substr($est->nombre, 0, 2) }}</span>
                            @endif
                            <span class="font-semibold text-gray-900">{{ $est->nombre }}</span>
                        </td>
                        <td><span class="badge">{{ $est->curso->nombre ?? '-' }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                        <td class="font-mono font-medium">{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-12 text-gray-400">Sin registros</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="text-center text-gray-400 text-xs mt-6">Generado el {{ now()->format('d/m/Y h:i A') }} • Sistema de Asistencia QR</p>
    </div>

    <script>window.print();</script>
</body>
</html>