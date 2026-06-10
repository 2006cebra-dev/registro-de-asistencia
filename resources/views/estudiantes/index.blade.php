<x-app-layout>
    <x-slot name="header">Estudiantes</x-slot>
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600">Gestiona los estudiantes del sistema</p>
        <a href="{{ route('estudiantes.create') }}" class="btn-primary">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Nuevo Estudiante
        </a>
    </div>
    <div class="card">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="table-header">Nombre</th>
                    <th class="table-header">Email</th>
                    <th class="table-header">Curso</th>
                    <th class="table-header text-center">Estado</th>
                    <th class="table-header text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($estudiantes as $estudiante)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="table-cell font-medium">{{ $estudiante->nombre }}</td>
                    <td class="table-cell text-gray-500">{{ $estudiante->email }}</td>
                    <td class="table-cell">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $estudiante->curso->nombre ?? 'Sin curso' }}</span>
                    </td>
                    <td class="table-cell text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $estudiante->activo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $estudiante->activo ? 'Activo' : 'Inactivo' }}</span>
                    </td>
                    <td class="table-cell text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('estudiantes.show', $estudiante) }}" class="text-blue-600 hover:text-blue-800 p-1.5 rounded-lg hover:bg-blue-50 transition-colors" title="Ver">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="{{ route('estudiantes.edit', $estudiante) }}" class="text-yellow-600 hover:text-yellow-800 p-1.5 rounded-lg hover:bg-yellow-50 transition-colors" title="Editar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <a href="{{ route('qr.generar', $estudiante) }}" target="_blank" class="text-green-600 hover:text-green-800 p-1.5 rounded-lg hover:bg-green-50 transition-colors" title="QR">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                            </a>
                            <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST" class="inline" onsubmit="return confirm('¿Desactivar este estudiante?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 p-1.5 rounded-lg hover:bg-red-50 transition-colors" title="Desactivar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No hay estudiantes registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
