<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">Eliminar Cuenta</h2>
        <p class="mt-1 text-sm text-gray-400">Una vez eliminada tu cuenta, todos sus datos serán borrados permanentemente.</p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">
        Eliminar Cuenta
    </button>

    <div x-data="{ show: false }" x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') show = true" x-show="show" style="display: none"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div @click.away="show = false" class="bg-dark-card rounded-2xl shadow-2xl border border-white/10 w-full max-w-md mx-4 overflow-hidden">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-white">¿Estás seguro de eliminar tu cuenta?</h2>
                <p class="mt-2 text-sm text-gray-400">Una vez eliminada, todos sus recursos y datos se perderán permanentemente. Ingresa tu contraseña para confirmar.</p>

                <div class="mt-6">
                    <label for="password" class="sr-only">Contraseña</label>
                    <input id="password" name="password" type="password" placeholder="Contraseña"
                        class="mt-1 block w-full rounded-lg bg-dark-bg border border-white/10 text-white px-4 py-2.5 focus:border-gold focus:ring-1 focus:ring-gold outline-none transition">
                    @error('password', 'userDeletion') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" @click="show = false"
                        class="px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-lg text-sm font-medium transition">Cancelar</button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">Eliminar Cuenta</button>
                </div>
            </form>
        </div>
    </div>
</section>