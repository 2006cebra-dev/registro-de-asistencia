<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="text-white text-lg font-bold tracking-tight">Nuevo Curso</span>
            <p class="text-sm text-gray-400">Completa los campos para crear un nuevo curso</p>
        </div>
    </x-slot>
    <div class="max-w-2xl mx-auto">
        <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-xl shadow-lg border border-white/10 p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold">Información del curso</h3>
                    <p class="text-gray-400 text-xs">Completa los campos para crear un nuevo curso</p>
                </div>
            </div>

            <form action="{{ route('cursos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Nombre del curso</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required placeholder="Ej: Programación Web I"
                        class="w-full rounded-lg bg-[#132347] border border-white/10 text-white placeholder-gray-500 px-4 py-2.5 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all duration-200 @error('nombre') border-red-500 @enderror">
                    @error('nombre') <p class="text-red-400 text-sm mt-1.5 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Código de registro</label>
                    <div class="relative">
                        <input type="text" name="codigo_registro" value="{{ old('codigo_registro') }}" required placeholder="Ej: SIS101"
                            class="w-full rounded-lg bg-[#132347] border border-white/10 text-white placeholder-gray-500 px-4 py-2.5 uppercase tracking-wider font-mono focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all duration-200 @error('codigo_registro') border-red-500 @enderror">
                    </div>
                    @error('codigo_registro') <p class="text-red-400 text-sm mt-1.5 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                    <p class="text-gray-500 text-xs mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Los estudiantes usarán este código para registrarse en el curso
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Descripción <span class="text-gray-500">(opcional)</span></label>
                    <textarea name="descripcion" rows="4" placeholder="Breve descripción del curso..."
                        class="w-full rounded-lg bg-[#132347] border border-white/10 text-white placeholder-gray-500 px-4 py-2.5 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all duration-200 resize-none">{{ old('descripcion') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Foto del curso <span class="text-gray-500">(opcional)</span></label>
                    <div class="flex items-center gap-4">
                        <div id="preview-curso" class="w-20 h-20 rounded-xl bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shadow-lg border-2 border-yellow-500/20">
                            <svg class="w-8 h-8 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <label for="foto" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm hover:from-yellow-500 hover:to-yellow-700 transition-all shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Elegir foto
                            </label>
                            <p class="text-xs text-gray-500 mt-1">JPG, PNG, WebP. Máx 2MB.</p>
                        </div>
                    </div>
                    <input id="foto" name="foto" type="file" accept="image/*" class="hidden" onchange="document.getElementById('preview-curso').src = window.URL.createObjectURL(this.files[0]);">
                    @error('foto') <p class="text-red-400 text-sm mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-2 border-t border-white/10">
                    <a href="{{ route('cursos.index') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 border border-white/20 text-gray-300 rounded-lg text-sm font-medium hover:bg-white/10 hover:text-white transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Cancelar
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar Curso
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>