<x-app-layout>
    <x-slot name="header">Cursos</x-slot>
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-400">Gestiona los cursos disponibles</p>
        <a href="{{ route('cursos.create') }}" class="btn-gold">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nuevo Curso
        </a>
    </div>
    <div class="card-dark overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="table-header text-gray-400">Nombre</th>
                        <th class="table-header text-gray-400">Código</th>
                        <th class="table-header text-gray-400">Descripción</th>
                        <th class="table-header text-gray-400 text-center">Estudiantes</th>
                        <th class="table-header text-gray-400 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse ($cursos as $curso)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="table-cell text-white font-medium">{{ $curso->nombre }}</td>
                        <td class="table-cell">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-mono font-bold gold-bg text-dark-bg">{{ $curso->codigo_registro }}</span>
                        </td>
                        <td class="table-cell text-gray-400">{{ $curso->descripcion ?? 'Sin descripción' }}</td>
                        <td class="table-cell text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/20 text-blue-400">{{ $curso->estudiantes->count() }}</span>
                        </td>
                        <td class="table-cell text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('cursos.show', $curso) }}" class="text-blue-400 hover:text-blue-300 p-1.5 rounded-lg hover:bg-white/10 transition-colors" title="Ver">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('cursos.edit', $curso) }}" class="text-yellow-400 hover:text-yellow-300 p-1.5 rounded-lg hover:bg-white/10 transition-colors" title="Editar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="inline" onsubmit="return confirm('¿Desactivar este curso?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 p-1.5 rounded-lg hover:bg-white/10 transition-colors" title="Desactivar">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No hay cursos registrados</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>