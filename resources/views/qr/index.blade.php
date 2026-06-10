<x-app-layout>
    <x-slot name="header">Códigos QR</x-slot>
    <p class="text-gray-600 mb-6">Visualiza y descarga los códigos QR de los estudiantes</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($estudiantes as $estudiante)
        <div class="card p-6 text-center hover:shadow-xl transition-shadow">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="text-white font-bold text-lg">{{ substr($estudiante->nombre, 0, 2) }}</span>
            </div>
            <p class="font-bold text-gray-800">{{ $estudiante->nombre }}</p>
            <p class="text-xs text-gray-500 mb-3">{{ $estudiante->curso->nombre ?? '' }}</p>
            <div class="bg-gray-50 p-3 rounded-xl inline-block">
                <img src="{{ route('qr.generar', $estudiante) }}" alt="QR {{ $estudiante->nombre }}" class="w-32 h-32 mx-auto">
            </div>
            <p class="text-xs font-mono text-gray-400 mt-2 truncate">{{ $estudiante->codigo }}</p>
            <a href="{{ route('qr.generar', $estudiante) }}" target="_blank" class="btn-primary w-full mt-3 justify-center text-xs">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
                Descargar QR
            </a>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-500">No hay estudiantes activos</div>
        @endforelse
    </div>
</x-app-layout>
