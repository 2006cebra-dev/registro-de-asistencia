<x-app-layout>
    <x-slot name="header">Registrar Asistencia Manual</x-slot>
    <div class="max-w-2xl mx-auto">
        <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl border border-white/10 p-8">
            <form action="{{ route('asistencias.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="input-label">Estudiante</label>
                    <select name="estudiante_id" class="input-field" required>
                        <option value="" disabled selected>Seleccionar estudiante</option>
                        @foreach ($estudiantes as $estudiante)
                            <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }} - {{ $estudiante->curso?->nombre ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="input-label">Fecha</label>
                    <input type="date" name="fecha" value="{{ date('Y-m-d') }}" class="input-field" required>
                </div>
                <div class="mb-5">
                    <label class="input-label">Hora de entrada</label>
                    <input type="time" name="hora_entrada" value="{{ date('H:i') }}" class="input-field" required>
                </div>
                <div class="flex justify-end gap-3">
                    <a href="{{ route('asistencias.index') }}" class="btn-outline">Cancelar</a>
                    <button type="submit" class="btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>