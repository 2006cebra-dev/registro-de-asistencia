<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <span class="text-white">Estudiantes</span>
                <p class="text-sm font-normal text-gray-300">Gestiona los estudiantes del sistema</p>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-5">
        <div class="rounded-xl bg-[#132347] border border-white/10 p-4 text-center">
            <p class="text-2xl font-bold text-white">{{ $total }}</p>
            <p class="text-xs text-white/50 font-medium mt-1">Total</p>
        </div>
        <div class="rounded-xl bg-[#132347] border border-green-500/20 p-4 text-center">
            <p class="text-2xl font-bold text-green-400">{{ $activos }}</p>
            <p class="text-xs text-white/50 font-medium mt-1">Activos</p>
        </div>
        <div class="rounded-xl bg-[#132347] border border-red-500/20 p-4 text-center">
            <p class="text-2xl font-bold text-red-400">{{ $inactivos }}</p>
            <p class="text-xs text-white/50 font-medium mt-1">Inactivos</p>
        </div>
        <div class="rounded-xl bg-[#132347] border border-white/10 p-4 text-center">
            <p class="text-2xl font-bold text-yellow-400">{{ $cursosCount }}</p>
            <p class="text-xs text-white/50 font-medium mt-1">Cursos</p>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div class="flex flex-wrap items-center gap-2">
            <div class="flex gap-1 bg-white/5 rounded-lg p-0.5">
                <a href="{{ route('estudiantes.index') }}"
                    class="px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ !request('estado') ? 'bg-yellow-600 text-white' : 'text-gray-400 hover:text-white' }}">Todos</a>
                <a href="{{ route('estudiantes.index', ['estado' => 'activos']) }}"
                    class="px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request('estado') === 'activos' ? 'bg-green-600 text-white' : 'text-gray-400 hover:text-white' }}">Activos</a>
                <a href="{{ route('estudiantes.index', ['estado' => 'inactivos']) }}"
                    class="px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request('estado') === 'inactivos' ? 'bg-red-600 text-white' : 'text-gray-400 hover:text-white' }}">Inactivos</a>
            </div>
        </div>
        <a href="{{ route('estudiantes.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-yellow-600 hover:bg-yellow-500 text-white rounded-lg font-semibold text-sm shadow-lg transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Nuevo Estudiante
        </a>
    </div>

    <div class="rounded-xl bg-[#132347] border border-white/10 overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/10 bg-white/5">
                        <th class="px-4 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre</th>
                        <th class="px-4 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Curso</th>
                        <th class="px-4 py-3.5 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</th>
                        <th class="px-4 py-3.5 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse ($estudiantes as $estudiante)
                    <tr class="hover:bg-white/5 transition-all duration-200">
                        <td class="px-4 py-3.5 text-sm text-white font-medium">
                            <div class="flex items-center gap-2">
                                @php $fotoEst = $estudiante->user?->foto ? asset('storage/' . $estudiante->user->foto) : null; @endphp
                                @if ($fotoEst)
                                    <img src="{{ $fotoEst }}" alt="" class="w-8 h-8 rounded-lg object-cover border border-yellow-500/20 shrink-0">
                                @else
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                @endif
                                {{ $estudiante->nombre }}
                            </div>
                        </td>
                        <td class="px-4 py-3.5 text-sm text-gray-400">{{ $estudiante->email }}</td>
                        <td class="px-4 py-3.5">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-300">{{ $estudiante->curso?->nombre ?? 'Sin curso' }}</span>
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $estudiante->activo ? 'bg-green-500/20 text-green-300' : 'bg-red-500/20 text-red-300' }}">{{ $estudiante->activo ? 'Activo' : 'Inactivo' }}</span>
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            <div class="flex justify-center gap-1 opacity-70 hover:opacity-100 transition-opacity">
                                <a href="{{ route('estudiantes.show', $estudiante) }}"
                                    class="p-2 rounded-lg text-blue-400 hover:text-blue-300 hover:bg-blue-500/10 transition-all duration-200"
                                    title="Ver">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('estudiantes.edit', $estudiante) }}"
                                    class="p-2 rounded-lg text-yellow-400 hover:text-yellow-300 hover:bg-yellow-500/10 transition-all duration-200"
                                    title="Editar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('estudiantes.toggle', $estudiante) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                        class="p-2 rounded-lg transition-all duration-200 cursor-pointer {{ $estudiante->activo ? 'text-red-400 hover:text-red-300 hover:bg-red-500/10' : 'text-green-400 hover:text-green-300 hover:bg-green-500/10' }}"
                                        title="{{ $estudiante->activo ? 'Desactivar' : 'Activar' }}">
                                        @if ($estudiante->activo)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <p class="text-white/40 text-sm">No hay estudiantes registrados</p>
                                <a href="{{ route('estudiantes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-600 text-white rounded-lg text-sm font-semibold hover:bg-yellow-500 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                    Crear primer estudiante
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>