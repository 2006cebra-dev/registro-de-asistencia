<x-app-layout>
    <x-slot name="header">{{ $estudiante->nombre }}</x-slot>
    <div class="flex justify-end space-x-3 mb-6">
        <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn-warning">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Editar
        </a>
        <a href="{{ route('estudiantes.index') }}" class="btn-outline">Volver</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="card p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Email</p>
                    <p class="font-medium text-gray-800">{{ $estudiante->email }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Curso</p>
                    <p class="font-medium text-gray-800">{{ $estudiante->curso->nombre ?? 'Sin curso' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Código QR</p>
                    <p class="font-mono text-xs text-gray-600 break-all">{{ $estudiante->codigo }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Estado</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $estudiante->activo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $estudiante->activo ? 'Activo' : 'Inactivo' }}</span>
                </div>
            </div>
        </div>
        <div class="card p-6 text-center">
            <p class="text-sm text-gray-500 mb-3 font-medium">Código QR del estudiante</p>
            <div class="inline-block p-3 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                <img src="{{ route('qr.generar', $estudiante) }}" alt="QR {{ $estudiante->nombre }}" class="w-40 h-40 mx-auto">
            </div>
            <div class="mt-4">
                <a href="{{ route('qr.generar', $estudiante) }}" target="_blank" class="btn-primary text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
                    Ver QR
                </a>
            </div>
        </div>
    </div>
    <h2 class="text-lg font-bold text-gray-800 mb-4">Historial de Asistencias</h2>
    <div class="card">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="table-header">Fecha</th>
                    <th class="table-header">Hora Entrada</th>
                    <th class="table-header">Hora Salida</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($estudiante->asistencias->sortByDesc('fecha') as $asistencia)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="table-cell font-medium">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                    <td class="table-cell">{{ $asistencia->hora_entrada }}</td>
                    <td class="table-cell">{{ $asistencia->hora_salida ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-4 py-8 text-center text-gray-500">Sin asistencias registradas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
