<x-app-layout>
    <x-slot name="header">{{ $curso->nombre }}</x-slot>
    <div class="flex justify-end space-x-3 mb-6">
        <a href="{{ route('cursos.edit', $curso) }}" class="btn-gold">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Editar
        </a>
        <a href="{{ route('cursos.index') }}" class="btn-outline">Volver</a>
    </div>

    <div class="card-dark p-6 mb-6">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-gray-400">{{ $curso->descripcion ?? 'Sin descripción' }}</p>
                <div class="mt-3 flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Estado:</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $curso->activo ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">{{ $curso->activo ? 'Activo' : 'Inactivo' }}</span>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500 mb-1">Código de registro</p>
                <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-mono font-bold gold-bg text-dark-bg">{{ $curso->codigo_registro }}</span>
            </div>
        </div>
    </div>

    <h2 class="text-lg font-bold text-white mb-4">Estudiantes ({{ $curso->estudiantes->count() }})</h2>
    <div class="card-dark overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="table-header text-gray-400">Nombre</th>
                        <th class="table-header text-gray-400">Email</th>
                        <th class="table-header text-gray-400 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse ($curso->estudiantes as $estudiante)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="table-cell text-white font-medium">{{ $estudiante->nombre }}</td>
                        <td class="table-cell text-gray-400">{{ $estudiante->email }}</td>
                        <td class="table-cell text-center">
                            <a href="{{ route('estudiantes.show', $estudiante) }}" class="text-blue-400 hover:text-blue-300 p-1.5 rounded-lg hover:bg-white/10 transition-colors" title="Ver">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-4 py-8 text-center text-gray-500">No hay estudiantes en este curso</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>