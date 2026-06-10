<x-app-layout>
    <x-slot name="header">
        Panel de Control
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
    @endphp

    @if ($estudiante)
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0a1628] via-[#132347] to-[#1a3a6b] p-8 mb-8 shadow-xl">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-yellow-400 text-sm font-medium tracking-wide uppercase">{{ $saludo }}</p>
                <h2 class="text-2xl md:text-3xl font-bold text-white mt-1">{{ $estudiante->nombre }}</h2>
                <p class="text-gray-300 text-sm mt-1">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        {{ $estudiante->curso->nombre ?? 'Sin curso' }}
                    </span>
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('qr.escanner') }}" class="inline-flex items-center px-5 py-2.5 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold rounded-xl text-sm transition-all shadow-lg hover:shadow-yellow-500/25">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    Registrar Asistencia
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all hover:-translate-y-0.5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Asistencias Hoy</span>
                <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $estudiante->asistencias()->whereDate('fecha', now())->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">De {{ $totalHoy }} registradas</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all hover:-translate-y-0.5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total Asistencias</span>
                <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $estudiante->asistencias()->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">De {{ $totalGeneral }} generales</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all hover:-translate-y-0.5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Código QR</span>
                <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                </div>
            </div>
            <p class="text-xs font-mono text-gray-500 truncate max-w-[160px]">{{ $estudiante->codigo }}</p>
            <a href="{{ route('qr.generar', $estudiante) }}" target="_blank" class="text-xs text-amber-600 hover:text-amber-500 font-medium mt-1 inline-block">Descargar QR →</a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all hover:-translate-y-0.5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Curso</span>
                <div class="w-9 h-9 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
            </div>
            <p class="text-sm font-semibold text-gray-900">{{ $estudiante->curso->nombre ?? 'Sin asignar' }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $estudiantesActivos }} estudiantes</p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all hover:-translate-y-0.5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Cursos Activos</span>
                <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $cursosActivos }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all hover:-translate-y-0.5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Estudiantes</span>
                <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $estudiantesActivos }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all hover:-translate-y-0.5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Hoy</span>
                <div class="w-9 h-9 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $totalHoy }}</p>
            <p class="text-xs text-gray-400 mt-1">asistencias hoy</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all hover:-translate-y-0.5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total General</span>
                <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $totalGeneral }}</p>
            <p class="text-xs text-gray-400 mt-1">asistencias registradas</p>
        </div>
    </div>

    @if ($estudiante)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-bold text-gray-900">Últimas Asistencias</h3>
                <a href="{{ route('asistencias.index') }}" class="text-xs text-blue-600 hover:text-blue-500 font-medium">Ver todas →</a>
            </div>
            <div class="space-y-3">
                @forelse ($estudiante->asistencias()->orderBy('fecha', 'desc')->take(5)->get() as $asistencia)
                <div class="flex items-center justify-between p-3.5 bg-gray-50 hover:bg-gray-100 rounded-xl transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $asistencia->hora_salida ? 'bg-green-100' : 'bg-blue-100' }}">
                            <svg class="w-5 h-5 {{ $asistencia->hora_salida ? 'text-green-600' : 'text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $asistencia->hora_salida ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' }}"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ \Carbon\Carbon::parse($asistencia->fecha)->locale('es')->isoFormat('dddd D [de] MMMM, YYYY') }}</p>
                            <p class="text-xs text-gray-400">{{ $asistencia->estudiante->curso->nombre ?? '' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold {{ $asistencia->hora_salida ? 'text-green-600' : 'text-blue-600' }}">
                            {{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}
                        </p>
                        <p class="text-xs text-gray-400">
                            Salida: {{ $asistencia->hora_salida ? \Carbon\Carbon::parse($asistencia->hora_salida)->format('h:i A') : '---' }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <p class="text-gray-400 text-sm">Aún no tienes asistencias registradas</p>
                    <a href="{{ route('qr.escanner') }}" class="text-blue-600 text-sm font-medium hover:text-blue-500 mt-2 inline-block">Escanear QR →</a>
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-base font-bold text-gray-900 mb-5">Tu Código QR</h3>
            <div class="flex flex-col items-center">
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <img src="{{ route('qr.generar', $estudiante) }}" alt="QR {{ $estudiante->nombre }}" class="w-36 h-36">
                </div>
                <p class="text-xs text-gray-400 mt-3 text-center">Escanea para marcar tu asistencia</p>
                <a href="{{ route('qr.generar', $estudiante) }}" target="_blank" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-xl text-sm font-medium hover:bg-blue-100 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
                    Descargar QR
                </a>
            </div>
            <hr class="my-5 border-gray-100">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Acceso Rápido</p>
                <div class="space-y-2">
                    <a href="{{ route('qr.escanner') }}" class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center group-hover:bg-amber-200 transition-colors">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01"/></svg>
                        </div>
                        <span class="text-sm text-gray-600 group-hover:text-gray-900">Escanear QR</span>
                    </a>
                    @if (Auth::user()->rol === 'docente')
                    <a href="{{ route('cursos.index') }}" class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <span class="text-sm text-gray-600 group-hover:text-gray-900">Ver Cursos</span>
                    </a>
                    <a href="{{ route('estudiantes.index') }}" class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
                        </div>
                        <span class="text-sm text-gray-600 group-hover:text-gray-900">Ver Estudiantes</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <div>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-gray-900">Módulos del Sistema</h3>
        </div>
        <div class="grid grid-cols-2 {{ Auth::user()->rol === 'docente' ? 'md:grid-cols-4' : 'md:grid-cols-3' }} gap-4">
            @if (Auth::user()->rol === 'docente')
            <a href="{{ route('cursos.index') }}" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-lg transition-all hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-blue-50 rounded-bl-2xl -mr-4 -mt-4"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-3 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm">Cursos</h4>
                    <p class="text-xs text-gray-400 mt-0.5">Gestionar cursos activos</p>
                </div>
            </a>
            <a href="{{ route('estudiantes.index') }}" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-lg transition-all hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-green-50 rounded-bl-2xl -mr-4 -mt-4"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-3 group-hover:bg-green-200 transition-colors">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm">Estudiantes</h4>
                    <p class="text-xs text-gray-400 mt-0.5">Gestionar estudiantes</p>
                </div>
            </a>
            @endif
            <a href="{{ route('asistencias.index') }}" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-lg transition-all hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-purple-50 rounded-bl-2xl -mr-4 -mt-4"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-3 group-hover:bg-purple-200 transition-colors">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm">Asistencias</h4>
                    <p class="text-xs text-gray-400 mt-0.5">Ver historial completo</p>
                </div>
            </a>
            <a href="{{ route('qr.escanner') }}" class="group relative bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-lg transition-all hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-amber-50 rounded-bl-2xl -mr-4 -mt-4"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mb-3 group-hover:bg-amber-200 transition-colors">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01"/></svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm">Escanear QR</h4>
                    <p class="text-xs text-gray-400 mt-0.5">Registrar asistencia</p>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
