<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="text-white text-lg font-bold tracking-tight">Editar Estudiante</span>
            <p class="text-sm text-gray-400">Modifica los datos del estudiante</p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl border border-white/10 p-6 text-center">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center mx-auto shadow-lg mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-lg">{{ $estudiante->nombre }}</h3>
                    <p class="text-gray-400 text-sm">{{ $estudiante->email }}</p>
                    <div class="mt-4 pt-4 border-t border-white/10">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-500">Curso</span>
                            <span class="text-gray-200 font-medium">{{ $estudiante->curso?->nombre ?? 'Sin curso' }}</span>
                        </div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-500">Estado</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $estudiante->activo ? 'bg-green-500/20 text-green-300' : 'bg-red-500/20 text-red-300' }}">{{ $estudiante->activo ? 'Activo' : 'Inactivo' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Código</span>
                            <span class="text-yellow-400 font-mono text-xs">{{ $estudiante->codigo ?? '---' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('estudiantes.show', $estudiante) }}" class="mt-4 inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Ver perfil completo
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl border border-white/10 p-8">
                    <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Información del estudiante
                    </h3>

                    <form action="{{ route('estudiantes.update', $estudiante) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-5">
                            <label class="input-label">
                                <svg class="w-3.5 h-3.5 inline-block mr-1 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Nombre completo
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <input type="text" name="nombre" value="{{ old('nombre', $estudiante->nombre) }}" class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 pl-10 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all @error('nombre') border-red-500 @enderror" required placeholder="Nombre completo del estudiante">
                            </div>
                            @error('nombre') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="input-label">
                                <svg class="w-3.5 h-3.5 inline-block mr-1 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Correo electrónico
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <input type="email" name="email" value="{{ old('email', $estudiante->email) }}" class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 pl-10 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all @error('email') border-red-500 @enderror" required placeholder="correo@ejemplo.com">
                            </div>
                            @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="input-label">
                                <svg class="w-3.5 h-3.5 inline-block mr-1 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                Curso asignado
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                </div>
                                <select name="curso_id" class="w-full rounded-lg bg-white/10 border border-white/20 text-white px-4 py-2.5 pl-10 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all appearance-none @error('curso_id') border-red-500 @enderror" required>
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}" {{ old('curso_id', $estudiante->curso_id) == $curso->id ? 'selected' : '' }}>{{ $curso->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('curso_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <a href="{{ route('estudiantes.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 border border-white/20 text-gray-300 rounded-lg text-sm font-medium hover:bg-white/10 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>