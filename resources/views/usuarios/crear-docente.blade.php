<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="text-white text-lg font-bold tracking-tight">Usuarios del Sistema</span>
            <p class="text-sm text-gray-400">Gestiona todos los usuarios de la plataforma</p>
        </div>
    </x-slot>

    @php
        $total = $docentes->count() + $estudiantes->count() + $supervisores->count();
    @endphp

    <div class="grid grid-cols-3 gap-3 lg:gap-4 mb-6">
        <div class="rounded-xl bg-[#132347] border border-white/10 p-4 text-center">
            <p class="text-2xl font-bold text-purple-400">{{ $supervisores->count() }}</p>
            <p class="text-xs text-white/50 mt-1">Supervisores</p>
        </div>
        <div class="rounded-xl bg-[#132347] border border-white/10 p-4 text-center">
            <p class="text-2xl font-bold text-yellow-400">{{ $docentes->count() }}</p>
            <p class="text-xs text-white/50 mt-1">Docentes</p>
        </div>
        <div class="rounded-xl bg-[#132347] border border-white/10 p-4 text-center">
            <p class="text-2xl font-bold text-blue-400">{{ $estudiantes->count() }}</p>
            <p class="text-xs text-white/50 mt-1">Estudiantes</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="rounded-xl bg-[#132347] border border-white/10 p-5 lg:p-6">
            <h3 class="text-white font-bold text-sm mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Nuevo Docente
            </h3>
            <form method="POST" action="{{ route('usuarios.store-docente') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Nombre completo</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                    @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                    @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Contraseña</label>
                    <input id="password" type="password" name="password" required class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                    @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                </div>
                <button type="submit" class="w-full py-2.5 gold-bg text-white font-bold rounded-lg hover:bg-yellow-500 transition-all shadow-lg text-sm">
                    Crear Docente
                </button>
            </form>
        </div>

        <div class="rounded-xl bg-[#132347] border border-white/10 p-5 lg:p-6">
            <h3 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
                Docentes ({{ $docentes->count() }})
            </h3>
            <div class="space-y-1.5 max-h-64 overflow-y-auto">
                @forelse ($docentes as $u)
                <div class="flex items-center gap-3 p-2.5 rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center text-white font-bold text-xs shrink-0">
                        {{ substr($u->name, 0, 2) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-white truncate">{{ $u->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $u->email }}</p>
                    </div>
                    <span class="text-[10px] text-yellow-400 font-medium bg-yellow-500/10 px-2 py-0.5 rounded-full shrink-0">docente</span>
                </div>
                @empty
                <p class="text-white/50 text-sm text-center py-6">No hay docentes</p>
                @endforelse
            </div>

            <hr class="border-white/10 my-4">

            <h3 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Supervisores ({{ $supervisores->count() }})
            </h3>
            <div class="space-y-1.5 max-h-48 overflow-y-auto">
                @forelse ($supervisores as $u)
                <div class="flex items-center gap-3 p-2.5 rounded-lg bg-white/5 hover:bg-white/10 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center text-white font-bold text-xs shrink-0">
                        {{ substr($u->name, 0, 2) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-white truncate">{{ $u->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $u->email }}</p>
                    </div>
                    <span class="text-[10px] text-purple-400 font-medium bg-purple-500/10 px-2 py-0.5 rounded-full shrink-0">supervisor</span>
                </div>
                @empty
                <p class="text-white/50 text-sm text-center py-6">No hay supervisores</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="rounded-xl bg-[#132347] border border-white/10 p-5 lg:p-6">
        <h3 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
            Estudiantes ({{ $estudiantes->count() }})
        </h3>
        @if ($estudiantes->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/10 bg-white/5">
                        <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre</th>
                        <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Curso</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($estudiantes as $u)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-4 py-2.5 text-sm text-white flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-[10px] shrink-0">
                                {{ substr($u->name, 0, 2) }}
                            </div>
                            <span class="truncate">{{ $u->name }}</span>
                        </td>
                        <td class="px-4 py-2.5 text-sm text-gray-400 truncate max-w-0">{{ $u->email }}</td>
                        <td class="px-4 py-2.5 text-sm text-gray-400">{{ $u->estudiante?->curso?->nombre ?? '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-white/50 text-sm text-center py-8">No hay estudiantes registrados</p>
        @endif
    </div>
</x-app-layout>
