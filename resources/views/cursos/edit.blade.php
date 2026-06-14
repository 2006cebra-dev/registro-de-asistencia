<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div>
                <span class="text-white">Editar Curso</span>
                <p class="text-sm font-normal text-gray-300">Modifica los datos del curso</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="rounded-xl bg-[#132347] border border-white/10 p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0">
                    @php $fotoCurso = $curso->foto ? asset('storage/' . $curso->foto) : null; @endphp
                    @if ($fotoCurso)
                        <img src="{{ $fotoCurso }}" alt="" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                    @endif
                </div>
                <div>
                    <h3 class="text-white font-semibold">{{ $curso->nombre }}</h3>
                    <p class="text-gray-400 text-xs">Código: <span class="text-yellow-400 font-mono">{{ $curso->codigo_registro }}</span></p>
                </div>
            </div>

            <form action="{{ route('cursos.update', $curso) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Nombre del curso</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            </div>
                            <input type="text" name="nombre" value="{{ old('nombre', $curso->nombre) }}" required
                                class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 pl-10 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all @error('nombre') border-red-500 @enderror">
                        </div>
                        @error('nombre') <p class="text-red-400 text-sm mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Código de registro</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01"/></svg>
                            </div>
                            <input type="text" name="codigo_registro" value="{{ old('codigo_registro', $curso->codigo_registro) }}" required
                                class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 pl-10 uppercase tracking-wider font-mono focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all @error('codigo_registro') border-red-500 @enderror">
                        </div>
                        @error('codigo_registro') <p class="text-red-400 text-sm mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Descripción <span class="text-gray-500">(opcional)</span></label>
                        <textarea name="descripcion" rows="4"
                            class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all resize-none">{{ old('descripcion', $curso->descripcion) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Foto del curso <span class="text-gray-500">(opcional)</span></label>
                        <div class="flex items-center gap-4">
                            <div class="shrink-0">
                                @if ($fotoCurso)
                                    <img id="preview-curso" src="{{ $fotoCurso }}" alt="" class="w-20 h-20 rounded-xl object-cover border-2 border-yellow-500/20 shadow-lg">
                                @else
                                    <div id="preview-curso" class="w-20 h-20 rounded-xl bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shadow-lg border-2 border-yellow-500/20">
                                        <svg class="w-8 h-8 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <label for="foto" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 bg-white/10 text-gray-300 rounded-lg text-sm font-medium hover:bg-white/20 hover:text-white transition-all border border-white/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Cambiar foto
                                </label>
                                <p class="text-xs text-gray-500 mt-1">JPG, PNG, WebP. Máx 2MB.</p>
                            </div>
                        </div>
                        <input id="foto" name="foto" type="file" accept="image/*" class="hidden" onchange="previewCursoFoto(this);">
                        @error('foto') <p class="text-red-400 text-sm mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 mt-6 border-t border-white/10">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Creado {{ $curso->created_at->format('d/m/Y') }}
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('cursos.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 border border-white/20 text-gray-300 rounded-lg text-sm font-medium hover:bg-white/10 hover:text-white transition-all">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                            Actualizar Curso
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewCursoFoto(input) {
            const file = input.files[0];
            if (!file) return;
            const preview = document.getElementById('preview-curso');
            const url = window.URL.createObjectURL(file);
            if (preview.tagName === 'IMG') {
                preview.src = url;
            } else {
                const img = document.createElement('img');
                img.id = 'preview-curso';
                img.className = 'w-20 h-20 rounded-xl object-cover border-2 border-yellow-500/20 shadow-lg';
                img.src = url;
                preview.parentNode.replaceChild(img, preview);
            }
        }
    </script>
</x-app-layout>