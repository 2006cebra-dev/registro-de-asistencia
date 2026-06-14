<x-app-layout>
    <x-slot name="header">Detalle de Asistencia</x-slot>
    <div class="flex justify-end mb-6">
        <a href="{{ route('asistencias.index') }}" class="btn-outline">Volver</a>
    </div>
    <div class="max-w-2xl mx-auto">
        <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl border border-white/10 p-8">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Estudiante</p>
                    <p class="font-medium text-gray-200">{{ $asistencia->estudiante->nombre }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Curso</p>
                    <p class="font-medium text-gray-200">{{ $asistencia->estudiante->curso?->nombre ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Fecha</p>
                    <p class="font-medium text-gray-200">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Hora</p>
                    <p class="font-medium text-gray-200 font-mono">{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>