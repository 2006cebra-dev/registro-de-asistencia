<x-app-layout>
    <x-slot name="header">Registro de Asistencia</x-slot>
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600">Historial completo de asistencias</p>
        <div class="flex space-x-3">
            <a href="{{ route('asistencias.create') }}" class="btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Registrar Manual
            </a>
            <a href="{{ route('qr.escanner') }}" class="btn-success">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                Escanear QR
            </a>
        </div>
    </div>
    <div class="card">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="table-header">Estudiante</th>
                    <th class="table-header">Curso</th>
                    <th class="table-header">Fecha</th>
                    <th class="table-header">Entrada</th>
                    <th class="table-header">Salida</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($asistencias as $asistencia)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="table-cell font-medium">{{ $asistencia->estudiante->nombre }}</td>
                    <td class="table-cell">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $asistencia->estudiante->curso->nombre ?? '-' }}</span>
                    </td>
                    <td class="table-cell">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                    <td class="table-cell">{{ $asistencia->hora_entrada }}</td>
                    <td class="table-cell">{{ $asistencia->hora_salida ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No hay asistencias registradas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $asistencias->links() }}
    </div>
</x-app-layout>
