<x-app-layout>
    <x-slot name="header">Nuevo Estudiante</x-slot>
    <div class="max-w-2xl mx-auto">
        <div class="card p-8">
            <form action="{{ route('estudiantes.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="input-field @error('nombre') border-red-500 @enderror" required>
                    @error('nombre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input-field @error('email') border-red-500 @enderror" required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Curso</label>
                    <select name="curso_id" class="input-field @error('curso_id') border-red-500 @enderror" required>
                        <option value="">Seleccionar curso</option>
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->nombre }}</option>
                        @endforeach
                    </select>
                    @error('curso_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('estudiantes.index') }}" class="btn-outline">Cancelar</a>
                    <button type="submit" class="btn-primary">Guardar Estudiante</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
