<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="text-white text-lg font-bold tracking-tight">Cursos</span>
            <p class="text-sm text-gray-400">Gestiona los cursos del sistema</p>
        </div>
    </x-slot>
    <div class="flex justify-end mb-6">
        <a href="{{ route('cursos.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nuevo Curso
        </a>
    </div>

    <div class="rounded-xl bg-[#132347] border border-white/10 overflow-hidden shadow-lg">
        <div class="overflow-x-auto hidden sm:block">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/10 bg-white/5">
                        <th class="px-4 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre</th>
                        <th class="px-4 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Código</th>
                        <th class="px-4 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Descripción</th>
                        <th class="px-4 py-3.5 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Estudiantes</th>
                        <th class="px-4 py-3.5 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse ($cursos as $curso)
                    <tr class="hover:bg-white/5 transition-all duration-200">
                        <td class="px-4 py-3.5 text-sm text-white font-medium">
                            <div class="flex items-center gap-3">
                                @php $fotoCurso = $curso->foto ? asset('storage/' . $curso->foto) : null; @endphp
                                @if ($fotoCurso)
                                    <img src="{{ $fotoCurso }}" alt="" class="w-9 h-9 rounded-lg object-cover border border-yellow-500/20 shrink-0">
                                @else
                                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    </div>
                                @endif
                                {{ $curso->nombre }}
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-mono font-bold bg-[#d4a843]/90 text-white">{{ $curso->codigo_registro }}</span>
                        </td>
                        <td class="px-4 py-3.5 text-sm text-gray-400 max-w-xs truncate">{{ $curso->descripcion ?? 'Sin descripción' }}</td>
                        <td class="px-4 py-3.5 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/20 text-blue-400">{{ $curso->estudiantes->count() }}</span>
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            <div class="flex justify-center gap-1 opacity-70 hover:opacity-100 transition-opacity">
                                <a href="{{ route('cursos.show', $curso) }}"
                                    class="p-2 rounded-lg text-blue-400 hover:text-blue-300 hover:bg-blue-500/10 transition-all duration-200"
                                    title="Ver curso">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('cursos.edit', $curso) }}"
                                    class="p-2 rounded-lg text-yellow-400 hover:text-yellow-300 hover:bg-yellow-500/10 transition-all duration-200"
                                    title="Editar curso">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="event.preventDefault(); showConfirm('¿Desactivar el curso {{ $curso->nombre }}? Los estudiantes no podrán registrar asistencia.').then(r => r && this.closest('form').submit());"
                                        class="p-2 rounded-lg text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all duration-200 cursor-pointer"
                                        title="Desactivar curso">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <p class="text-white/40 text-sm">No hay cursos registrados</p>
                                <a href="{{ route('cursos.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-600 text-white rounded-lg text-sm font-semibold hover:bg-yellow-500 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Crear primer curso
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="sm:hidden space-y-3 p-4">
            @forelse ($cursos as $curso)
            <div class="p-4 rounded-lg bg-white/[0.03] border border-white/[0.06] hover:border-yellow-500/20 transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-white truncate">{{ $curso->nombre }}</p>
                        <p class="text-xs text-gray-500 font-mono mt-0.5">{{ $curso->codigo_registro }}</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/20 text-blue-400 shrink-0 ml-2">{{ $curso->estudiantes->count() }} est.</span>
                </div>
                <p class="text-xs text-gray-400 truncate mb-3">{{ $curso->descripcion ?? 'Sin descripción' }}</p>
                <div class="flex items-center gap-2">
                    <a href="{{ route('cursos.show', $curso) }}" class="flex-1 text-center px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors">Ver</a>
                    <a href="{{ route('cursos.edit', $curso) }}" class="flex-1 text-center px-3 py-1.5 rounded-lg text-xs font-medium bg-yellow-500/10 text-yellow-400 hover:bg-yellow-500/20 transition-colors">Editar</a>
                    <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="event.preventDefault(); showConfirm('¿Desactivar {{ $curso->nombre }}?').then(r => r && this.closest('form').submit());" class="w-full px-3 py-1.5 rounded-lg text-xs font-medium bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors cursor-pointer">Desactivar</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-10">
                <svg class="w-12 h-12 text-white/20 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <p class="text-white/40 text-sm">No hay cursos registrados</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>