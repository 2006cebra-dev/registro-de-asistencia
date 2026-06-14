<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <div>
                <span class="text-white">Registro de Asistencia</span>
                <p class="text-sm font-normal text-gray-300">Historial completo de asistencias</p>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('asistencias.export') }}?{{ http_build_query(request()->only(['fecha_desde', 'fecha_hasta', 'curso_id'])) }}" target="_blank"
                class="inline-flex items-center gap-2 px-3 py-2 bg-white/10 text-gray-300 rounded-xl text-xs font-medium hover:bg-white/20 hover:text-white transition-all border border-white/10">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
                Exportar
            </a>
            @if ($user->rol === 'estudiante')
            <a href="{{ route('qr.escanner') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-gradient-to-r from-green-600 to-green-800 text-white rounded-xl text-xs font-semibold hover:from-green-500 hover:to-green-700 transition-all shadow-lg">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                Escanear QR
            </a>
            @endif
        </div>
    </div>

    <form method="GET" action="{{ route('asistencias.index') }}" class="mb-6">
        <div class="rounded-xl bg-[#132347] border border-white/10 p-5">
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
                @if ($user->rol !== 'estudiante')
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
                @endif
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

    <div class="space-y-3">
        @forelse ($asistencias as $asistencia)
        @php
            $est = $asistencia->estudiante;
            $foto = $est->user?->foto ? asset('storage/' . $est->user->foto) : null;
        @endphp
        <div class="rounded-xl bg-[#132347] border border-white/10 p-4 flex items-center gap-4 transition-all hover:bg-white/5 hover:border-white/20">
            <div class="shrink-0">
                @if ($foto)
                    <img src="{{ $foto }}" alt="{{ $est->nombre }}" class="w-12 h-12 rounded-xl object-cover border-2 border-yellow-500/20 shadow-lg">
                @else
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shadow-lg border-2 border-yellow-500/20">
                        <span class="text-white font-bold text-sm">{{ substr($est->nombre, 0, 2) }}</span>
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ $est->nombre }}</p>
                <div class="flex items-center gap-2 mt-1">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-yellow-500/20 text-yellow-300">{{ $est->curso->nombre ?? '-' }}</span>
                </div>
            </div>
            <div class="shrink-0 text-right">
                <p class="text-xs text-gray-400 font-medium">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</p>
                <p class="text-sm text-white font-mono font-semibold mt-0.5">{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}</p>
            </div>
        </div>
        @empty
        <div class="rounded-xl bg-[#132347] border border-white/10 p-12 text-center">
            <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-7 h-7 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <p class="text-white/50 text-sm">No hay asistencias registradas</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $asistencias->links() }}
    </div>
</x-app-layout>