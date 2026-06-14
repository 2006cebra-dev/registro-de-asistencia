<x-app-layout>
    <x-slot name="header">
        <span class="text-white text-lg font-bold tracking-tight">{{ $estudiante->nombre }}</span>
    </x-slot>
    <div class="flex justify-end gap-3 mb-6">
        <a href="{{ route('estudiantes.edit', $estudiante) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg text-sm font-semibold hover:from-yellow-500 hover:to-yellow-700 transition-all shadow-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Editar
        </a>
        <a href="{{ route('estudiantes.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 text-gray-300 rounded-lg text-sm font-medium hover:bg-white/20 hover:text-white transition-all border border-white/10">Volver</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="group perspective-1000">
            <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl border border-white/10 p-6 card-3d h-full">
                <div style="transform: translateZ(15px);">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">Email</p>
                            <p class="font-medium text-gray-200 mt-1 break-all">{{ $estudiante->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">Curso</p>
                            <p class="font-medium text-gray-200 mt-1">{{ $estudiante->curso?->nombre ?? 'Sin curso' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">Código</p>
                            <p class="font-mono text-xs text-gray-400 break-all mt-1">{{ $estudiante->codigo }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">Estado</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1 {{ $estudiante->activo ? 'bg-green-500/20 text-green-300' : 'bg-red-500/20 text-red-300' }}">{{ $estudiante->activo ? 'Activo' : 'Inactivo' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="group perspective-1000">
            <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl border border-white/10 p-6 card-3d h-full flex flex-col items-center justify-center">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg" style="transform: translateZ(25px);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <p class="text-sm text-gray-400 mb-1 font-medium">Curso asignado</p>
                <p class="font-bold text-white text-lg" style="transform: translateZ(20px);">{{ $estudiante->curso?->nombre ?? 'Sin curso' }}</p>
                <p class="text-xs font-mono text-gray-500 mt-1" style="transform: translateZ(10px);">Código: <span class="text-yellow-400 font-bold">{{ $estudiante->curso->codigo_registro ?? '---' }}</span></p>
            </div>
        </div>
    </div>

    <h2 class="text-lg font-bold text-white mb-4">Historial de Asistencias</h2>
    <div class="group perspective-1000">
        <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl border border-white/10 overflow-hidden card-3d">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/5">
                            <th class="px-4 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Fecha</th>
                            <th class="px-4 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Hora</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse ($estudiante->asistencias->sortByDesc('fecha') as $asistencia)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-4 py-3.5 text-sm text-gray-200 font-medium">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3.5 text-sm text-gray-300 font-mono">{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="px-4 py-12 text-center text-gray-500">Sin asistencias registradas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>