<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </div>
            <div>
                <span class="text-white">Panel de Control</span>
                <p class="text-sm font-normal text-gray-300">Visión general del sistema</p>
            </div>
        </div>
    </x-slot>

    @php
        $user = Auth::user();
        $estudiante = $user->estudiante;
        $hora = now()->format('H');
        $saludo = $hora < 12 ? 'Buenos días' : ($hora < 18 ? 'Buenas tardes' : 'Buenas noches');

        $totalHoy = \App\Models\Asistencia::whereDate('fecha', now())->count();
        $totalGeneral = \App\Models\Asistencia::count();
        $cursosActivos = \App\Models\Curso::where('activo', true)->count();
        $estudiantesActivos = \App\Models\Estudiante::where('activo', true)->count();
        $totalUsuarios = \App\Models\User::count();
        $totalDocentes = \App\Models\User::where('rol', 'docente')->count();
        $totalEstudiantesUser = \App\Models\User::where('rol', 'estudiante')->count();

        $cursos = \App\Models\Curso::where('activo', true)->withCount('estudiantes')->get();
        $asistenciasPorCurso = [];
        foreach ($cursos as $c) {
            $asistenciasPorCurso[$c->nombre] = \App\Models\Asistencia::whereHas('estudiante', fn($q) => $q->where('curso_id', $c->id))->count();
        }

        $diasSemana = [];
        $asistenciasDia = [];
        $asistenciasEstudianteDia = [];
        for ($i = 6; $i >= 0; $i--) {
            $fecha = now()->subDays($i);
            $diasSemana[] = $fecha->locale('es')->isoFormat('ddd');
            $count = \App\Models\Asistencia::whereDate('fecha', $fecha->toDateString())->count();
            $asistenciasDia[] = $count;
            if ($estudiante) {
                $eCount = $estudiante->asistencias()->whereDate('fecha', $fecha->toDateString())->count();
                $asistenciasEstudianteDia[] = $eCount;
            }
        }

        $ayer = now()->subDay();
        $totalAyer = \App\Models\Asistencia::whereDate('fecha', $ayer)->count();
        $semana = $estudiante ? array_sum($asistenciasEstudianteDia) : array_sum($asistenciasDia);
        $promedio = $semana > 0 ? round($semana / 7, 1) : 0;
        $diferencia = $totalAyer > 0 ? round((($totalHoy - $totalAyer) / $totalAyer) * 100, 1) : 0;
        $estSemanaEst = $estudiante ? array_sum($asistenciasEstudianteDia) : 0;
        $estTotal = $estudiante ? $estudiante->asistencias()->count() : 0;
        $estHoy = $estudiante ? $estudiante->asistencias()->whereDate('fecha', now())->count() : 0;
        $estAyer = $estudiante ? $estudiante->asistencias()->whereDate('fecha', $ayer)->count() : 0;
        $estDiferencia = $estAyer > 0 ? round((($estHoy - $estAyer) / $estAyer) * 100, 1) : ($estHoy > 0 ? 100 : 0);
    @endphp

    @if (!$estudiante && $user->rol === 'estudiante')
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-900/30 to-[#0d1f3c] border border-yellow-500/20 mb-6">
        <div class="relative p-5 sm:p-7 text-center">
            <div class="w-16 h-16 rounded-2xl bg-yellow-500/20 flex items-center justify-center mx-auto mb-4 border border-yellow-500/30">
                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h2 class="text-xl font-bold text-white mb-2">{{ $saludo }}, {{ $user->name }}</h2>
            <p class="text-white/60 text-sm mb-4">Tu cuenta de estudiante no tiene un perfil vinculado.</p>
            <p class="text-white/40 text-xs">Contacta al administrador para que asocie tu cuenta con un registro de estudiante.</p>
        </div>
    </div>
    @elseif ($estudiante)
    @php $fotoEstudiante = $user->foto ? asset('storage/' . $user->foto) : null; @endphp
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#1a3a6b] to-[#0d1f3c] border border-white/10 mb-6">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="relative p-5 sm:p-7">
            <div class="flex items-center gap-4">
                @if ($fotoEstudiante)
                    <img src="{{ $fotoEstudiante }}" alt="" class="w-14 h-14 rounded-2xl object-cover border-2 border-yellow-500/30 shadow-xl">
                @else
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center shadow-xl border-2 border-yellow-500/30">
                        <span class="text-white font-bold text-xl">{{ substr($estudiante->nombre, 0, 1) }}</span>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-yellow-400 text-xs font-semibold uppercase tracking-widest">{{ $saludo }}</p>
                    <h2 class="text-xl sm:text-2xl font-bold text-white mt-0.5 truncate">{{ $estudiante->nombre }}</h2>
                    <p class="text-sm text-white/60 truncate">{{ $estudiante->curso?->nombre ?? 'Sin curso' }} · <span class="text-yellow-400 font-mono font-semibold">{{ $estudiante->curso?->codigo_registro ?? '---' }}</span></p>
                </div>
                <a href="{{ route('qr.escanner') }}" class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 bg-yellow-500 hover:bg-yellow-400 text-white font-bold rounded-xl text-sm transition-all shadow-lg shadow-yellow-500/20 hover:shadow-yellow-500/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01"/></svg>
                    Registrar
                </a>
            </div>
        </div>
    </div>
    @elseif ($user->rol === 'supervisor')
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-900/30 to-[#0d1f3c] border border-purple-500/20 mb-6">
        <div class="absolute top-0 right-0 w-64 h-64 bg-purple-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="relative p-5 sm:p-7">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center shadow-xl border-2 border-purple-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-purple-400 text-xs font-semibold uppercase tracking-widest">Supervisor · {{ $saludo }}</p>
                    <h2 class="text-xl sm:text-2xl font-bold text-white mt-0.5 truncate">{{ $user->name }}</h2>
                    <p class="text-sm text-white/60 truncate"><span class="text-purple-400 font-semibold">{{ $totalUsuarios }}</span> usuarios registrados · <span class="text-yellow-400 font-semibold">{{ $cursosActivos }}</span> cursos activos</p>
                </div>
                <a href="{{ route('usuarios.crear-docente') }}" class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 hover:bg-purple-400 text-white font-bold rounded-xl text-sm transition-all shadow-lg shadow-purple-500/20 hover:shadow-purple-500/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Gestionar
                </a>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4 mb-6">
        @php
        if ($user->rol === 'supervisor') {
            $stats = [
                ['label' => 'Usuarios', 'value' => $totalUsuarios, 'color' => 'from-purple-600 to-purple-800', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'sub' => $totalDocentes.' docentes · '.$totalEstudiantesUser.' estudiantes'],
                ['label' => 'Cursos', 'value' => $cursosActivos, 'color' => 'from-yellow-600 to-yellow-800', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'sub' => 'Cursos activos'],
                ['label' => 'Estudiantes', 'value' => $estudiantesActivos, 'color' => 'from-blue-600 to-blue-800', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857', 'sub' => 'Perfiles de estudiante activos'],
                ['label' => 'Asist. Hoy', 'value' => $totalHoy, 'color' => 'from-green-600 to-green-800', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'sub' => $totalAyer > 0 ? ($diferencia > 0 ? '+' : '').$diferencia.'% vs ayer' : 'Sin datos ayer'],
            ];
        } elseif ($user->rol === 'docente') {
            $stats = [
                ['label' => 'Cursos Activos', 'value' => $cursosActivos, 'color' => 'from-yellow-600 to-yellow-800', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'sub' => 'Total de cursos disponibles'],
                ['label' => 'Estudiantes', 'value' => $estudiantesActivos, 'color' => 'from-blue-600 to-blue-800', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857', 'sub' => 'Estudiantes activos'],
                ['label' => 'Asistencias Hoy', 'value' => $totalHoy, 'color' => 'from-green-600 to-green-800', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'sub' => $totalAyer > 0 ? ($diferencia > 0 ? '+' : '').$diferencia.'% vs ayer' : 'Sin datos ayer'],
                ['label' => 'Total Gral', 'value' => $totalGeneral, 'color' => 'from-purple-600 to-purple-800', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'sub' => 'Asistencias registradas'],
            ];
        } elseif ($estudiante) {
            $stats = [
                ['label' => 'Hoy', 'value' => $estudiante->asistencias()->whereDate('fecha', now())->count(), 'color' => 'from-green-600 to-green-800', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'sub' => $estAyer > 0 ? ($estDiferencia > 0 ? '+' : '').$estDiferencia.'% vs ayer' : 'Primer registro'],
                ['label' => 'Total', 'value' => $estudiante->asistencias()->count(), 'color' => 'from-blue-600 to-blue-800', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'sub' => 'Asistencias totales'],
                ['label' => 'Curso', 'value' => $estudiante->curso?->nombre ?? '---', 'color' => 'from-yellow-600 to-yellow-800', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'sub' => $estudiante->curso?->codigo_registro ?? '---'],
                ['label' => 'Semana', 'value' => $estSemanaEst, 'color' => 'from-purple-600 to-purple-800', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'sub' => 'Registros esta semana'],
            ];
        } else {
            $stats = [];
        }
        @endphp

        @foreach ($stats as $stat)
        <div class="group relative overflow-hidden rounded-xl bg-[#132347] border border-white/10 p-4 lg:p-5 hover:border-yellow-500/30 transition-all duration-300">
            <div class="absolute -top-3 -right-3 w-20 h-20 bg-gradient-to-br {{ $stat['color'] }} rounded-full blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-2 lg:mb-3">
                    <span class="text-white/50 text-xs font-semibold uppercase tracking-wider">{{ $stat['label'] }}</span>
                    <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-lg bg-gradient-to-br {{ $stat['color'] }} flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-4 h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/></svg>
                    </div>
                </div>
                <p class="text-2xl lg:text-3xl font-bold text-white tracking-tight">{{ $stat['value'] }}</p>
                @if (isset($stat['sub']))
                <p class="text-xs text-white/40 mt-1 lg:mt-1.5 lg:block">{{ $stat['sub'] }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    @if (in_array($user->rol, ['docente', 'supervisor']))
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-5 mb-6">
        <div class="lg:col-span-2 rounded-xl bg-[#132347] border border-white/10 p-5">
            <h3 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Asistencias últimos 7 días
            </h3>
            <div class="w-full" style="max-height:200px">
                <canvas id="chartSemanal" class="w-full" style="max-height:180px"></canvas>
            </div>
        </div>
        @if (count($asistenciasPorCurso) > 0)
        <div class="rounded-xl bg-[#132347] border border-white/10 p-5">
            <h3 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                Distribución por Curso
            </h3>
            <div class="w-full">
                <canvas id="chartCursos" class="w-full" style="max-height:300px"></canvas>
            </div>
        </div>
        @endif
    </div>

    @if ($cursos->count() > 0)
    <div class="rounded-xl bg-[#132347] border border-white/10 overflow-hidden mb-6">
        <div class="p-5 border-b border-white/10">
            <h3 class="text-white font-bold text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Resumen de Cursos
            </h3>
        </div>
        <div class="overflow-x-auto hidden lg:block">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/10 bg-white/5">
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Curso</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Código</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Estudiantes</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Asistencias</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Hoy</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($cursos as $curso)
                    @php
                        $hoyCurso = \App\Models\Asistencia::whereHas('estudiante', fn($q) => $q->where('curso_id', $curso->id))->whereDate('fecha', now())->count();
                    @endphp
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-5 py-3.5 text-sm text-white font-medium">{{ $curso->nombre }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-400 font-mono">{{ $curso->codigo_registro }}</td>
                        <td class="px-5 py-3.5 text-center text-sm text-white">{{ $curso->estudiantes_count }}</td>
                        <td class="px-5 py-3.5 text-center text-sm text-yellow-400 font-semibold">{{ $asistenciasPorCurso[$curso->nombre] ?? 0 }}</td>
                        <td class="px-5 py-3.5 text-center text-sm">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $hoyCurso > 0 ? 'bg-green-500/20 text-green-300' : 'bg-gray-500/20 text-gray-400' }}">{{ $hoyCurso }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('cursos.attendance-pdf', $curso) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                PDF
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="lg:hidden space-y-3 p-4">
            @foreach ($cursos as $curso)
            @php
                $hoyCurso = \App\Models\Asistencia::whereHas('estudiante', fn($q) => $q->where('curso_id', $curso->id))->whereDate('fecha', now())->count();
            @endphp
            <div class="p-3.5 rounded-lg bg-white/5 border border-white/5 hover:border-yellow-500/20 transition-colors">
                <div class="flex items-center justify-between mb-2">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-white truncate">{{ $curso->nombre }}</p>
                        <p class="text-xs text-gray-400 font-mono">{{ $curso->codigo_registro }}</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium shrink-0 ml-2 {{ $hoyCurso > 0 ? 'bg-green-500/20 text-green-300' : 'bg-gray-500/20 text-gray-400' }}">{{ $hoyCurso }} hoy</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
                            {{ $curso->estudiantes_count }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            {{ $asistenciasPorCurso[$curso->nombre] ?? 0 }} total
                        </span>
                    </div>
                    <a href="{{ route('cursos.attendance-pdf', $curso) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-medium bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        PDF
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if (in_array($user->rol, ['supervisor']))
    @php
        $ultimasAsistencias = \App\Models\Asistencia::with('estudiante.curso', 'estudiante.user')
            ->orderBy('fecha', 'desc')->orderBy('hora_entrada', 'desc')->take(10)->get();
    @endphp
    <div class="rounded-xl bg-[#132347] border border-white/10 mb-6">
        <div class="flex items-center justify-between p-5 border-b border-white/10">
            <h3 class="text-white font-bold text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Últimas Asistencias
            </h3>
            <a href="{{ route('asistencias.index') }}" class="text-xs text-purple-400 hover:text-purple-300 font-medium flex items-center gap-1">
                Ver todas <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="divide-y divide-white/5">
            @forelse ($ultimasAsistencias as $a)
            <div class="flex items-center justify-between py-3 px-5 hover:bg-white/5 transition-colors">
                <div class="flex items-center gap-3 min-w-0 flex-1">
                    @php $fotoA = $a->estudiante->user?->foto ? asset('storage/'.$a->estudiante->user->foto) : null; @endphp
                    @if ($fotoA)
                        <img src="{{ $fotoA }}" alt="" class="w-8 h-8 rounded-full object-cover border border-white/10 shrink-0">
                    @else
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center text-white font-bold text-xs shrink-0">
                            {{ substr($a->estudiante->nombre, 0, 2) }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ $a->estudiante->nombre }}</p>
                        <p class="text-xs text-white/50 truncate">{{ $a->estudiante->curso?->nombre ?? '' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 shrink-0 ml-2">
                    <span class="text-xs text-white/60 hidden sm:block">{{ \Carbon\Carbon::parse($a->fecha)->locale('es')->isoFormat('DD MMM') }}</span>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-purple-500/20 text-purple-300 text-xs font-mono font-semibold">{{ \Carbon\Carbon::parse($a->hora_entrada)->format('h:i A') }}</span>
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <p class="text-white/50 text-sm">No hay asistencias registradas</p>
            </div>
            @endforelse
        </div>
    </div>
    @endif

    @elseif ($estudiante)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-5 mb-6">
        <div class="rounded-xl bg-[#132347] border border-white/10 p-5">
            <h3 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Tus asistencias (7 días)
            </h3>
            <div class="w-full" style="max-height:200px">
                <canvas id="chartEstudiante" class="w-full" style="max-height:180px"></canvas>
            </div>
        </div>
        <div class="rounded-xl bg-[#132347] border border-white/10 p-5">
            <h3 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Resumen de Asistencia
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center py-2.5 border-b border-white/5">
                    <span class="text-sm text-white/70">Total asistencias</span>
                    <span class="text-sm text-white font-semibold">{{ $estudiante->asistencias()->count() }}</span>
                </div>
                <div class="flex justify-between items-center py-2.5 border-b border-white/5">
                    <span class="text-sm text-white/70">Esta semana</span>
                    <span class="text-sm text-yellow-400 font-semibold">{{ $estSemanaEst }}</span>
                </div>
                <div class="flex justify-between items-center py-2.5 border-b border-white/5">
                    <span class="text-sm text-white/70">Promedio diario</span>
                    <span class="text-sm text-blue-400 font-semibold">{{ $promedio }} /día</span>
                </div>
                <div class="flex justify-between items-center py-2.5 border-b border-white/5">
                    <span class="text-sm text-white/70">Curso</span>
                    <span class="text-sm text-yellow-400 font-semibold">{{ $estudiante->curso?->nombre ?? '---' }}</span>
                </div>
                <div class="flex justify-between items-center py-2.5">
                    <span class="text-sm text-white/70">Código de registro</span>
                    <span class="text-sm font-mono font-bold text-white bg-yellow-600/30 px-2.5 py-1 rounded-md">{{ $estudiante->curso?->codigo_registro ?? '---' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-xl bg-[#132347] border border-white/10 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-white font-bold text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Últimas Asistencias
            </h3>
            <a href="{{ route('asistencias.index') }}" class="text-xs text-yellow-400 hover:text-yellow-300 font-medium flex items-center gap-1">
                Ver todas
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        @forelse ($estudiante->asistencias()->orderBy('fecha', 'desc')->take(5)->get() as $asistencia)
        <div class="flex items-center justify-between py-3 border-b border-white/5 last:border-0 group hover:bg-white/5 px-2 -mx-2 rounded-lg transition-colors">
            <div class="flex items-center gap-3 min-w-0 flex-1">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-700 shrink-0 shadow-lg">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ \Carbon\Carbon::parse($asistencia->fecha)->locale('es')->isoFormat('ddd D [de] MMM') }}</p>
                    <p class="text-xs text-white/50 truncate">{{ $asistencia->estudiante->curso?->nombre ?? '' }}</p>
                </div>
            </div>
            <div class="shrink-0 ml-2">
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-500/20 text-blue-300 text-xs font-mono font-semibold">{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}</span>
            </div>
        </div>
        @empty
        <div class="text-center py-8">
            <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <p class="text-white/50 text-sm">Aún no tienes asistencias registradas</p>
            <a href="{{ route('qr.escanner') }}" class="text-yellow-400 text-sm font-medium hover:text-yellow-300 mt-2 inline-block">Escanear QR →</a>
        </div>
        @endforelse
    </div>
    @endif

    <script data-cfasync="false" src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    <script data-cfasync="false">
    document.addEventListener('DOMContentLoaded', function() {
        const chartSemanalEl = document.getElementById('chartSemanal');
        if (chartSemanalEl) {
            new Chart(chartSemanalEl, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($diasSemana) !!},
                    datasets: [{
                        label: 'Asistencias',
                        data: {!! json_encode($asistenciasDia) !!},
                        backgroundColor: 'rgba(212, 168, 67, 0.7)',
                        borderColor: '#d4a843',
                        borderWidth: 2,
                        borderRadius: 6,
                        barPercentage: 0.6,
                    }@if ($estudiante), {
                        label: 'Tus asistencias',
                        data: {!! json_encode($asistenciasEstudianteDia) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.6)',
                        borderColor: '#3b82f6',
                        borderWidth: 2,
                        borderRadius: 6,
                        barPercentage: 0.6,
                    }@endif]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { labels: { color: '#9ca3af', font: { size: 10 } } }
                    },
                    scales: {
                        x: { ticks: { color: '#6b7280', font: { size: 10 } }, grid: { color: 'rgba(255,255,255,0.05)' } },
                        y: { ticks: { color: '#6b7280', stepSize: 1, font: { size: 10 } }, grid: { color: 'rgba(255,255,255,0.05)' }, beginAtZero: true }
                    }
                }
            });
        }

        const chartCursosEl = document.getElementById('chartCursos');
        if (chartCursosEl) {
            new Chart(chartCursosEl, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_keys($asistenciasPorCurso)) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($asistenciasPorCurso)) !!},
                        backgroundColor: ['#d4a843', '#3b82f6', '#10b981', '#8b5cf6', '#ef4444', '#f97316', '#06b6d4', '#ec4899'],
                        borderColor: '#132347',
                        borderWidth: 3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { color: '#9ca3af', font: { size: 10 }, padding: 8 } }
                    },
                    cutout: '68%',
                }
            });
        }

        const chartEstudianteEl = document.getElementById('chartEstudiante');
        if (chartEstudianteEl) {
            new Chart(chartEstudianteEl, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($diasSemana) !!},
                    datasets: [{
                        label: 'Tus asistencias',
                        data: {!! json_encode($asistenciasEstudianteDia) !!},
                        backgroundColor: 'rgba(212, 168, 67, 0.7)',
                        borderColor: '#d4a843',
                        borderWidth: 2,
                        borderRadius: 6,
                        barPercentage: 0.6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: { ticks: { color: '#6b7280', font: { size: 10 } }, grid: { color: 'rgba(255,255,255,0.05)' } },
                        y: { ticks: { color: '#6b7280', stepSize: 1, font: { size: 10 } }, grid: { color: 'rgba(255,255,255,0.05)' }, beginAtZero: true }
                    }
                }
            });
        }
    });
    </script>
</x-app-layout>
