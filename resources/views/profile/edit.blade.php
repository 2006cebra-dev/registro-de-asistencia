<x-app-layout>
    @php $foto = Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : null; @endphp
    <x-slot name="header">
        <div class="flex items-center gap-3">
            @if ($foto)
                <img src="{{ $foto }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-xl object-cover border-2 border-yellow-500/30 shadow-lg">
            @else
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
            @endif
            <div>
                <span class="text-white">Mi Perfil</span>
                <p class="text-sm font-normal text-gray-300">Gestiona tu información personal</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-5">
        <div class="rounded-xl bg-[#132347] border border-white/10 p-6 sm:p-8">
            <div class="flex flex-col items-center mb-6 pb-6 border-b border-white/10">
                <div class="relative">
                    @if ($foto)
                        <img id="preview-foto" src="{{ $foto }}" alt="{{ Auth::user()->name }}" class="w-24 h-24 rounded-2xl object-cover border-2 border-yellow-500/30 shadow-xl">
                    @else
                        <div id="preview-foto" class="w-24 h-24 rounded-2xl bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center shadow-xl border-2 border-yellow-500/30">
                            <span class="text-white font-bold text-3xl">{{ substr(Auth::user()->name, 0, 2) }}</span>
                        </div>
                    @endif
                </div>
                <h3 class="mt-3 text-xl font-bold text-white">{{ Auth::user()->name }}</h3>
                <span class="text-sm px-3 py-0.5 rounded-full mt-1
                    {{ Auth::user()->rol === 'docente' ? 'bg-yellow-500/20 text-yellow-400' : (Auth::user()->rol === 'supervisor' ? 'bg-purple-500/20 text-purple-400' : 'bg-blue-500/20 text-blue-400') }}">
                    {{ Auth::user()->rol === 'docente' ? 'Docente' : (Auth::user()->rol === 'supervisor' ? 'Supervisor' : 'Estudiante') }}</span>
            </div>

            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf @method('patch')

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Nombre completo</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                                class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 pl-10 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all @error('name') border-red-500 @enderror">
                        </div>
                        @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Correo electrónico</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                                class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 pl-10 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition-all @error('email') border-red-500 @enderror">
                        </div>
                        @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Foto de perfil</label>
                        <div class="flex items-center gap-4">
                            <label for="foto" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 bg-white/10 text-gray-300 rounded-lg text-sm font-medium hover:bg-white/20 hover:text-white transition-all border border-white/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Elegir foto
                            </label>
                            <span id="foto-name" class="text-sm text-gray-400">Ningún archivo seleccionado</span>
                        </div>
                        <input id="foto" name="foto" type="file" accept="image/*" class="hidden" onchange="document.getElementById('foto-name').textContent = this.files[0]?.name || 'Ningún archivo seleccionado'; previewFile(this);">
                        @error('foto') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG, WebP. Máximo 2MB.</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-6 mt-6 border-t border-white/10">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar cambios
                    </button>
                    @if (session('status') === 'profile-updated')
                        <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                            class="text-sm text-green-400 font-medium">¡Perfil actualizado!</span>
                    @endif
                </div>
            </form>
        </div>

        <div class="rounded-xl bg-[#132347] border border-white/10 p-6 sm:p-8">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <script>
        function previewFile(input) {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview-foto');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    const img = document.createElement('img');
                    img.id = 'preview-foto';
                    img.className = 'w-24 h-24 rounded-2xl object-cover border-2 border-yellow-500/30 shadow-xl';
                    img.src = e.target.result;
                    img.alt = '{{ Auth::user()->name }}';
                    preview.parentNode.replaceChild(img, preview);
                }
            };
            reader.readAsDataURL(file);
        }
    </script>
</x-app-layout>