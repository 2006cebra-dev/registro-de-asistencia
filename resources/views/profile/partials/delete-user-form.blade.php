<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">Eliminar Cuenta</h2>
        <p class="mt-1 text-sm text-white/70">Una vez eliminada tu cuenta, todos tus datos se borrarán permanentemente.</p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">
        Eliminar Cuenta
    </button>

    <div x-data="{ show: false, step: 'reason' }" x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') { show = true; step = 'reason' }" x-show="show" style="display: none"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm px-4">
        <div @click.away="show = false" class="bg-[#132347] rounded-2xl shadow-2xl border border-white/10 w-full max-w-md overflow-hidden">
            <div class="p-6">
                <template x-if="step === 'reason'">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-white">¿Eliminar tu cuenta?</h2>
                                <p class="text-sm text-white/70">Selecciona un motivo</p>
                            </div>
                        </div>

                        <div class="space-y-2 mt-4">
                            <label class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/10 cursor-pointer hover:bg-white/10 transition-all">
                                <input type="radio" name="delete_reason" value="ya_no_uso" class="accent-red-500" checked>
                                <span class="text-sm text-white">Ya no uso el sistema</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/10 cursor-pointer hover:bg-white/10 transition-all">
                                <input type="radio" name="delete_reason" value="problemas_tecnicos" class="accent-red-500">
                                <span class="text-sm text-white">Problemas técnicos</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/10 cursor-pointer hover:bg-white/10 transition-all">
                                <input type="radio" name="delete_reason" value="cuenta_duplicada" class="accent-red-500">
                                <span class="text-sm text-white">Cuenta duplicada</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/10 cursor-pointer hover:bg-white/10 transition-all">
                                <input type="radio" name="delete_reason" value="otro" class="accent-red-500">
                                <span class="text-sm text-white">Otro motivo</span>
                            </label>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <button type="button" @click="show = false"
                                class="px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-lg text-sm font-medium transition">Cancelar</button>
                            <button type="button" @click="step = 'confirm'"
                                class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">Continuar</button>
                        </div>
                    </div>
                </template>

                <template x-if="step === 'confirm'">
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-white">Confirmar eliminación</h2>
                                <p class="text-sm text-white/70">Ingresa tu contraseña para continuar</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <input id="password" name="password" type="password" placeholder="Contraseña"
                                class="mt-1 block w-full rounded-lg bg-[#0a1628] border border-white/10 text-white px-4 py-2.5 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 outline-none transition" autofocus>
                            @error('password', 'userDeletion') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <button type="button" @click="step = 'reason'"
                                class="px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-lg text-sm font-medium transition">Atrás</button>
                            <button type="submit"
                                class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">Eliminar definitivamente</button>
                        </div>
                    </form>
                </template>
            </div>
        </div>
    </div>
</section>