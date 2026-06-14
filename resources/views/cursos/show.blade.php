<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="text-white text-lg font-bold tracking-tight">{{ $curso->nombre }}</span>
            <p class="text-sm text-gray-400">{{ $curso->descripcion ?? 'Sin descripción' }}</p>
        </div>
    </x-slot>

    <div class="flex flex-col sm:flex-row justify-end gap-3 mb-6">
        <a href="{{ route('cursos.attendance-pdf', $curso) }}" target="_blank"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-blue-500 hover:to-blue-700 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v6h6"/></svg>
            Exportar PDF
        </a>
        <a href="{{ route('cursos.edit', $curso) }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Editar Curso
        </a>
        <a href="{{ route('cursos.index') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 border border-white/20 text-gray-300 rounded-lg text-sm font-medium hover:bg-white/10 hover:text-white transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Volver
        </a>
    </div>

    <div class="card-3d rounded-xl bg-[#132347] border border-white/10 p-5 mb-6">
        <div class="flex flex-col sm:flex-row items-start justify-between gap-4">
            <div class="flex items-center gap-3">
                @php $fotoCurso = $curso->foto ? asset('storage/' . $curso->foto) : null; @endphp
                @if ($fotoCurso)
                    <img src="{{ $fotoCurso }}" alt="" class="w-12 h-12 rounded-xl object-cover border-2 border-yellow-500/20 shadow-lg">
                @else
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                @endif
                <div>
                    <h3 class="text-white font-semibold">{{ $curso->nombre }}</h3>
                    <span class="inline-flex items-center gap-1.5 text-xs mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full {{ $curso->activo ? 'bg-green-400' : 'bg-red-400' }}"></span>
                        <span class="{{ $curso->activo ? 'text-green-400' : 'text-red-400' }}">{{ $curso->activo ? 'Activo' : 'Inactivo' }}</span>
                    </span>
                </div>
            </div>
            <div class="text-center sm:text-right">
                <p class="text-xs text-gray-500 mb-1.5">Código de registro</p>
                <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-mono font-bold bg-[#d4a843] text-white">{{ $curso->codigo_registro }}</span>
            </div>
        </div>
    </div>

    <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        Estudiantes
        <span class="text-sm font-normal text-gray-400">({{ $estudiantes->count() }})</span>
    </h2>

    @forelse ($estudiantes as $estudiante)
    @php $fotoEst = $estudiante->user?->foto ? asset('storage/' . $estudiante->user->foto) : null; @endphp
    <div class="card-3d rounded-xl bg-[#132347] border border-white/10 mb-4 overflow-hidden transition-all hover:border-white/20">
        <div class="p-4 flex items-center gap-4">
            <div class="shrink-0">
                @if ($fotoEst)
                    <img src="{{ $fotoEst }}" alt="{{ $estudiante->nombre }}" class="w-12 h-12 rounded-xl object-cover border-2 border-yellow-500/20 shadow-lg">
                @else
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center shadow-lg border-2 border-yellow-500/20">
                        <span class="text-white font-bold text-sm">{{ substr($estudiante->nombre, 0, 2) }}</span>
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ $estudiante->nombre }}</p>
                <p class="text-xs text-white/50 truncate">{{ $estudiante->email }}</p>
            </div>
            <a href="{{ route('estudiantes.show', $estudiante) }}"
                class="shrink-0 inline-flex items-center p-2 rounded-lg text-blue-400 hover:text-blue-300 hover:bg-blue-500/10 transition-all duration-200"
                title="Ver estudiante">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </a>
        </div>
        @php $asistencias = $estudiante->asistencias->take(5); @endphp
        @if ($asistencias->isNotEmpty())
        <div class="border-t border-white/5 px-4 py-3 bg-white/[0.02]">
            <p class="text-xs text-white/40 font-medium mb-2 flex items-center gap-1.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Últimas asistencias
            </p>
            <div class="flex flex-wrap gap-2">
                @foreach ($asistencias as $a)
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-white/5 text-xs text-gray-300 font-mono">
                    <span>{{ \Carbon\Carbon::parse($a->fecha)->format('d/m') }}</span>
                    <span class="text-white/40">·</span>
                    <span>{{ \Carbon\Carbon::parse($a->hora_entrada)->format('h:i A') }}</span>
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    @empty
    <div class="rounded-xl bg-[#132347] border border-white/10 p-12 text-center">
        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-3">
            <svg class="w-7 h-7 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <p class="text-white/50 text-sm">No hay estudiantes en este curso</p>
    </div>
    @endforelse
</x-app-layout>