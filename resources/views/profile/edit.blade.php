<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Mi Perfil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto space-y-6">
            <div class="card-dark p-8">
                <div class="max-w-2xl mx-auto">
                    @php $foto = Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : null; @endphp
                    <div class="flex flex-col items-center mb-8">
                        @if ($foto)
                            <img src="{{ $foto }}" alt="{{ Auth::user()->name }}" class="w-28 h-28 rounded-full object-cover border-4 border-gold/30 shadow-xl">
                        @else
                            <div class="w-28 h-28 gold-bg rounded-full flex items-center justify-center text-white font-bold text-3xl shadow-xl border-4 border-gold/30">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        @endif
                        <h3 class="mt-4 text-xl font-bold text-white">{{ Auth::user()->name }}</h3>
                        <span class="text-sm px-3 py-0.5 rounded-full {{ Auth::user()->rol === 'docente' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-blue-500/20 text-blue-400' }} mt-1">{{ Auth::user()->rol === 'docente' ? 'Docente' : 'Estudiante' }}</span>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300">Nombre</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                                class="mt-1 block w-full rounded-lg bg-dark-card border border-white/10 text-white px-4 py-2.5 focus:border-gold focus:ring-1 focus:ring-gold outline-none transition">
                            @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300">Correo electrónico</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                                class="mt-1 block w-full rounded-lg bg-dark-card border border-white/10 text-white px-4 py-2.5 focus:border-gold focus:ring-1 focus:ring-gold outline-none transition">
                            @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-300">Foto de perfil</label>
                            <div class="mt-1 flex items-center gap-4">
                                <label for="foto" class="cursor-pointer inline-flex items-center px-4 py-2.5 bg-[#d4a843] text-[#0a1628] rounded-lg font-semibold text-sm hover:bg-[#c49a35] transition-all">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Elegir foto
                                </label>
                                <span id="foto-name" class="text-sm text-gray-400">Ningún archivo seleccionado</span>
                            </div>
                            <input id="foto" name="foto" type="file" accept="image/*" class="hidden" onchange="document.getElementById('foto-name').textContent = this.files[0]?.name || 'Ningún archivo seleccionado'">
                            @error('foto') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                            <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF o WebP. Máximo 2MB.</p>
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit" class="btn-gold">Guardar cambios</button>
                            @if (session('status') === 'profile-updated')
                                <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                                    class="text-sm text-green-400 font-medium">¡Perfil actualizado!</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-dark p-8">
                <div class="max-w-2xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card-dark p-8">
                <div class="max-w-2xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>