<x-app-layout>
    <x-slot name="header">Registrar Asistencia Manual</x-slot>
    <div class="max-w-2xl mx-auto">
        <div class="card p-8">
            <form action="{{ route('asistencias.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estudiante</label>
                    <select name="estudiante_id" class="input-field" required>
                        <option value="">Seleccionar estudiante</option>
                        @foreach ($estudiantes as $estudiante)
                            <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }} - {{ $estudiante->curso->nombre ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                    <input type="date" name="fecha" value="{{ date('Y-m-d') }}" class="input-field" required>
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hora de entrada</label>
                    <input type="time" name="hora_entrada" value="{{ date('H:i') }}" class="input-field" required>
                </div>
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('asistencias.index') }}" class="btn-outline">Cancelar</a>
                    <button type="submit" class="btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
