<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="text-white text-lg font-bold tracking-tight">Registro de Asistencia</span>
            <p class="text-sm text-gray-400">{{ $user->rol === 'estudiante' ? 'Tu historial personal' : 'Historial completo de asistencias' }}</p>
        </div>
    </x-slot>

    @if ($user->rol === 'estudiante')
    @php
        $est = $user->estudiante;
        $totalAsist = $est ? $est->asistencias()->count() : 0;
        $semanaAsist = $est ? $est->asistencias()->whereBetween('fecha', [now()->subDays(7), now()])->count() : 0;
        $hoyAsist = $est ? $est->asistencias()->whereDate('fecha', now())->count() : 0;
    @endphp
    <div class="grid grid-cols-3 gap-3 mb-5">
        <div class="card-3d rounded-xl bg-[#132347] border border-green-500/20 p-4 text-center">
            <p class="text-2xl font-bold text-green-400">{{ $hoyAsist }}</p>
            <p class="text-xs text-white/50 font-medium mt-1">Hoy</p>
        </div>
        <div class="card-3d rounded-xl bg-[#132347] border border-blue-500/20 p-4 text-center">
            <p class="text-2xl font-bold text-blue-400">{{ $semanaAsist }}</p>
            <p class="text-xs text-white/50 font-medium mt-1">7 días</p>
        </div>
        <div class="card-3d rounded-xl bg-[#132347] border border-yellow-500/20 p-4 text-center">
            <p class="text-2xl font-bold text-yellow-400">{{ $totalAsist }}</p>
            <p class="text-xs text-white/50 font-medium mt-1">Total</p>
        </div>
    </div>
    <div class="flex justify-end mb-4">
        <a href="{{ route('qr.escanner') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-700 text-white rounded-xl font-bold text-sm shadow-lg hover:from-yellow-500 hover:to-yellow-600 hover:shadow-xl transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01"/></svg>
            Escanear QR
        </a>
    </div>
    @else
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('asistencias.export') }}?{{ http_build_query(request()->only(['fecha_desde', 'fecha_hasta', 'curso_id'])) }}" target="_blank"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/10 text-gray-300 rounded-xl text-xs font-medium hover:bg-white/20 hover:text-white transition-all border border-white/10">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
                Exportar
            </a>
            <a href="{{ route('asistencias.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl text-xs font-bold shadow-lg hover:from-green-500 hover:to-green-600 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Registrar
            </a>
        </div>
    </div>

    <form method="GET" action="{{ route('asistencias.index') }}" class="mb-6">
        <div class="rounded-xl bg-[#132347] border border-white/10 p-4 sm:p-5">
            <div class="flex flex-wrap items-end gap-3">
                <div>
                    <label class="block text-xs text-gray-400 font-medium mb-1">Desde</label>
                    <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}"
                        class="bg-white/10 border border-white/20 text-white rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 font-medium mb-1">Hasta</label>
                    <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}"
                        class="bg-white/10 border border-white/20 text-white rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 font-medium mb-1">Curso</label>
                    <select name="curso_id"
                        class="bg-white/10 border border-white/20 text-white rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 outline-none transition-all">
                        <option value="">Todos los cursos</option>
                        @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-yellow-600 hover:bg-yellow-500 text-white rounded-lg text-xs font-semibold transition-all shadow-lg">
                    Filtrar
                </button>
                @if (request()->anyFilled(['fecha_desde', 'fecha_hasta', 'curso_id']))
                <a href="{{ route('asistencias.index') }}"
                    class="px-4 py-2 bg-white/10 text-gray-300 rounded-lg text-xs font-medium hover:bg-white/20 hover:text-white transition-all border border-white/10">
                    Limpiar
                </a>
                @endif
            </div>
        </div>
    </form>
    @endif

    @if ($asistencias->isEmpty())
    <div class="rounded-xl bg-[#132347] border border-white/10 p-12 text-center">
        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-3">
            <svg class="w-7 h-7 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <p class="text-white/50 text-sm">No hay asistencias registradas</p>
        @if ($user->rol === 'estudiante' && !$hoyAsist)
        <a href="{{ route('qr.escanner') }}" class="inline-flex items-center gap-1.5 text-yellow-400 text-sm font-medium hover:text-yellow-300 mt-3 bg-yellow-500/10 px-4 py-2 rounded-lg hover:bg-yellow-500/20 transition-colors">Escanear QR →</a>
        @endif
    </div>
    @else
    <div class="space-y-3">
        @foreach ($asistencias as $asistencia)
        @php
            $est = $asistencia->estudiante;
            $foto = $est->user?->foto ? asset('storage/' . $est->user->foto) : null;
        @endphp
        <div class="card-3d group rounded-xl bg-[#132347] border border-white/10 p-4 flex items-center gap-4 transition-all hover:bg-white/5 hover:border-yellow-500/30 hover:shadow-lg hover:shadow-yellow-500/5">
            @if ($user->rol !== 'estudiante')
            <div class="shrink-0">
                @if ($foto)
                    <img src="{{ $foto }}" alt="{{ $est->nombre }}" class="w-11 h-11 rounded-xl object-cover border-2 border-yellow-500/20 shadow-lg">
                @else
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shadow-lg border-2 border-yellow-500/20">
                        <span class="text-white font-bold text-sm">{{ substr($est->nombre, 0, 2) }}</span>
                    </div>
                @endif
            </div>
            @else
            <div class="shrink-0">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center shadow-lg border-2 border-blue-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            @endif
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate group-hover:text-yellow-400 transition-colors">{{ $est->nombre }}</p>
                @if ($user->rol !== 'estudiante')
                <div class="flex items-center gap-2 mt-1">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-yellow-500/20 text-yellow-300">{{ $est->curso?->nombre ?? '-' }}</span>
                </div>
                @endif
            </div>
            <div class="shrink-0 text-right">
                <p class="text-xs text-gray-400 font-medium">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</p>
                <p class="text-sm text-white font-mono font-semibold mt-0.5">{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $asistencias->links() }}
    </div>
    @endif
</x-app-layout>
