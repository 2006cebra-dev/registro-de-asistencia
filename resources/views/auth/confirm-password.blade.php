<x-guest-layout>
    <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/10">
        <h2 class="text-2xl font-bold text-white mb-2 text-center">Confirma tu contraseña</h2>
        <p class="text-gray-400 text-sm mb-6 text-center">Por seguridad, confirma tu contraseña para continuar</p>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Contraseña</label>
                <input id="password" type="password" name="password" required autofocus class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full py-3 gold-bg text-white font-bold rounded-lg hover:bg-yellow-500 transition-all shadow-lg">Confirmar</button>
            </div>
        </form>
    </div>
</x-guest-layout>
