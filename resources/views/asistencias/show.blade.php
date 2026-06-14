<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="text-white text-lg font-bold tracking-tight">Detalle de Asistencia</span>
            <p class="text-sm text-gray-400">Información del registro de asistencia</p>
        </div>
    </x-slot>
    <div class="max-w-2xl mx-auto">
        <div class="card-3d rounded-xl bg-[#132347] border border-white/10 p-6 sm:p-8 hover:border-yellow-500/30 hover:shadow-xl hover:shadow-yellow-500/5 transition-all duration-300">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Estudiante</p>
                    <p class="font-semibold text-white mt-1">{{ $asistencia->estudiante->nombre }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Curso</p>
                    <p class="font-semibold text-white mt-1">{{ $asistencia->estudiante->curso?->nombre ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Fecha</p>
                    <p class="font-semibold text-white mt-1 font-mono">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Hora</p>
                    <p class="font-semibold text-yellow-400 mt-1 font-mono">{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}</p>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('asistencias.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 border border-white/20 text-gray-300 rounded-lg text-sm font-medium hover:bg-white/10 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Volver
            </a>
        </div>
    </div>
</x-app-layout>
