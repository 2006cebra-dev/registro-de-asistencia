<section>
    <header>
        <h2 class="text-lg font-medium text-white">Actualizar Contraseña</h2>
        <p class="mt-1 text-sm text-gray-400">Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-300">Contraseña actual</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="mt-1 block w-full rounded-lg bg-dark-card border border-white/10 text-white px-4 py-2.5 focus:border-gold focus:ring-1 focus:ring-gold outline-none transition">
            @error('current_password', 'updatePassword') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-300">Nueva contraseña</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="mt-1 block w-full rounded-lg bg-dark-card border border-white/10 text-white px-4 py-2.5 focus:border-gold focus:ring-1 focus:ring-gold outline-none transition">
            @error('password', 'updatePassword') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-300">Confirmar nueva contraseña</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="mt-1 block w-full rounded-lg bg-dark-card border border-white/10 text-white px-4 py-2.5 focus:border-gold focus:ring-1 focus:ring-gold outline-none transition">
            @error('password_confirmation', 'updatePassword') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-gold">Guardar</button>
            @if (session('status') === 'password-updated')
                <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-400 font-medium">¡Contraseña actualizada!</span>
            @endif
        </div>
    </form>
</section>