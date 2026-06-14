<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Asistencias - {{ $curso->nombre }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Figtree', sans-serif; background: #fff; color: #111; padding: 2rem; }
        @media print { body { padding: 0.5in; } @page { margin: 0; } }
        table { width: 100%; border-collapse: collapse; margin-top: 0.75rem; }
        th { text-align: left; padding: 0.5rem 0.75rem; font-size: 0.65rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e5e7eb; background: #f9fafb; }
        td { padding: 0.55rem 0.75rem; font-size: 0.75rem; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: top; }
        tr:last-child td { border-bottom: none; }
        .avatar { width: 1.5rem; height: 1.5rem; border-radius: 0.375rem; object-fit: cover; display: inline-block; vertical-align: middle; margin-right: 0.4rem; }
        .avatar-placeholder { width: 1.5rem; height: 1.5rem; border-radius: 0.375rem; display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #d4a843, #a16207); color: #fff; font-weight: 700; font-size: 0.6rem; vertical-align: middle; margin-right: 0.4rem; }
        .badge { display: inline-block; padding: 0.1rem 0.5rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 600; background: #fef3c7; color: #92400e; }
        .time-badge { display: inline-block; padding: 0.1rem 0.4rem; border-radius: 0.25rem; font-size: 0.65rem; font-weight: 600; font-family: monospace; background: #eff6ff; color: #1e40af; }
        .student-section { margin-bottom: 1.5rem; break-inside: avoid; }
        .student-header { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; background: #f9fafb; border-radius: 0.5rem; border: 1px solid #e5e7eb; }
        .count-total { font-weight: 700; color: #d4a843; }
    </style>
</head>
<body>
    <div class="max-w-6xl mx-auto">
        <div class="border-b-2 border-yellow-500 pb-5 mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $curso->nombre }}</h1>
                <p class="text-gray-500 text-sm mt-1">Reporte de Asistencias por Estudiante</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold text-yellow-600">{{ $estudiantes->count() }}</p>
                <p class="text-xs text-gray-500">estudiantes</p>
            </div>
        </div>

        @forelse ($estudiantes as $estudiante)
        @php $asistencias = $estudiante->asistencias; @endphp
        <div class="student-section">
            <div class="student-header">
                @php $fotoEst = $estudiante->user?->foto ? asset('storage/' . $estudiante->user->foto) : null; @endphp
                @if ($fotoEst)
                    <img src="{{ $fotoEst }}" alt="" class="avatar">
                @else
                    <span class="avatar-placeholder">{{ substr($estudiante->nombre, 0, 2) }}</span>
                @endif
                <div class="flex-1">
                    <span class="font-semibold text-gray-900">{{ $estudiante->nombre }}</span>
                    <span class="text-gray-400 text-xs ml-2">{{ $estudiante->email }}</span>
                </div>
                <span class="count-total text-sm">{{ $asistencias->count() }} asistencias</span>
            </div>
            @if ($asistencias->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asistencias as $asistencia)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->locale('es')->isoFormat('ddd D [de] MMM YYYY') }}</td>
                        <td><span class="time-badge">{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-gray-400 text-xs italic mt-2 pl-2">Sin asistencias registradas</p>
            @endif
        </div>
        @empty
        <div class="text-center py-16 text-gray-400">
            <p>No hay estudiantes activos en este curso</p>
        </div>
        @endforelse

        <p class="text-center text-gray-400 text-xs mt-8">Generado el {{ now()->format('d/m/Y h:i A') }} • Sistema de Asistencia QR</p>
    </div>

    <script>window.print();</script>
</body>
</html>
