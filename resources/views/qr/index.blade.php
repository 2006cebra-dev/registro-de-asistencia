<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
            </div>
            <div>
                <span class="text-white">Códigos QR por Curso</span>
                <p class="text-sm font-normal text-gray-300">Genera y descarga códigos QR para cada curso</p>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($cursos as $curso)
        <div class="rounded-xl bg-[#132347] border border-white/10 p-6 text-center shadow-lg">
            <div class="w-14 h-14 bg-gradient-to-br from-yellow-600 to-yellow-800 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>

            <h3 class="text-white font-bold text-lg mb-1">{{ $curso->nombre }}</h3>
            <p class="text-white/50 text-xs mb-4">{{ $curso->estudiantes_count }} estudiantes</p>

            <div class="bg-white/5 rounded-xl p-3 inline-block border border-white/10">
                <img src="{{ route('qr.generar', $curso) }}" alt="QR {{ $curso->nombre }}"
                    class="w-36 h-36 mx-auto rounded-lg">
            </div>

            <p class="text-xs font-mono text-white/50 mt-3 mb-4">
                Código: <span class="text-yellow-400 font-bold">{{ $curso->codigo_registro }}</span>
            </p>

            <div class="flex gap-2">
                <a href="{{ route('qr.generar', $curso) }}" target="_blank"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2.5 bg-yellow-600 hover:bg-yellow-500 text-white rounded-xl text-xs font-semibold transition-all shadow-lg">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
                    Descargar
                </a>
                <a href="{{ route('qr.curso', $curso) }}" target="_blank"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2.5 bg-white/10 text-gray-300 rounded-xl text-xs font-medium hover:bg-white/20 hover:text-white transition-all border border-white/10">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Ver
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16">
            <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
            </div>
            <p class="text-white/40 text-sm">No hay cursos activos</p>
            <a href="{{ route('cursos.create') }}" class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-yellow-600 text-white rounded-lg text-sm font-semibold hover:bg-yellow-500 transition-all">
                Crear curso
            </a>
        </div>
        @endforelse
    </div>
</x-app-layout>