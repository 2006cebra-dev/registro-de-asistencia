<section>
    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        </div>
        <div>
            <h3 class="text-white font-semibold">Actualizar Contraseña</h3>
            <p class="text-gray-400 text-xs">Usa una contraseña larga y segura</p>
        </div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-300 mb-1.5">Contraseña actual</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" placeholder="••••••••"
                    class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 pl-10 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition @error('current_password', 'updatePassword') border-red-500 @enderror">
            </div>
            @error('current_password', 'updatePassword') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-300 mb-1.5">Nueva contraseña</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input id="update_password_password" name="password" type="password" autocomplete="new-password" placeholder="••••••••"
                    class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 pl-10 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition @error('password', 'updatePassword') border-red-500 @enderror">
            </div>
            @error('password', 'updatePassword') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-300 mb-1.5">Confirmar nueva contraseña</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="••••••••"
                    class="w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-500 px-4 py-2.5 pl-10 focus:border-[#d4a843] focus:ring-1 focus:ring-[#d4a843]/50 outline-none transition">
            </div>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Guardar
            </button>
            @if (session('status') === 'password-updated')
                <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-400 font-medium">¡Contraseña actualizada!</span>
            @endif
        </div>
    </form>
</section>