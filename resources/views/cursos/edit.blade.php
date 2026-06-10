<x-app-layout>
    <x-slot name="header">Editar Curso</x-slot>
    <div class="max-w-2xl mx-auto">
        <div class="card-dark p-8">
            <form action="{{ route('cursos.update', $curso) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nombre del curso</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $curso->nombre) }}" required
                        class="mt-1 w-full rounded-lg bg-dark-card border border-white/10 text-white px-4 py-2.5 focus:border-gold focus:ring-1 focus:ring-gold outline-none transition @error('nombre') border-red-500 @enderror">
                    @error('nombre') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Código de registro</label>
                    <input type="text" name="codigo_registro" value="{{ old('codigo_registro', $curso->codigo_registro) }}" required placeholder="Ej: SIS101"
                        class="mt-1 w-full rounded-lg bg-dark-card border border-white/10 text-white px-4 py-2.5 uppercase focus:border-gold focus:ring-1 focus:ring-gold outline-none transition @error('codigo_registro') border-red-500 @enderror">
                    @error('codigo_registro') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Descripción</label>
                    <textarea name="descripcion" rows="4"
                        class="mt-1 w-full rounded-lg bg-dark-card border border-white/10 text-white px-4 py-2.5 focus:border-gold focus:ring-1 focus:ring-gold outline-none transition">{{ old('descripcion', $curso->descripcion) }}</textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('cursos.index') }}" class="btn-outline">Cancelar</a>
                    <button type="submit" class="btn-gold">Actualizar Curso</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>