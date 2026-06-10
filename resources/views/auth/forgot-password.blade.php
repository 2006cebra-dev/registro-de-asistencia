<x-guest-layout>
    <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/10">
        <h2 class="text-2xl font-bold text-white mb-2 text-center">¿Olvidaste tu contraseña?</h2>
        <p class="text-gray-400 text-sm mb-6 text-center">Ingresa tu email y te enviaremos un enlace para restablecerla</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            @if (session('status'))
                <p class="text-green-400 text-sm mt-2">{{ session('status') }}</p>
            @endif
            <div class="mt-6">
                <button type="submit" class="w-full py-3 gold-bg text-white font-bold rounded-lg hover:bg-yellow-500 transition-all shadow-lg">Enviar enlace</button>
            </div>
            <p class="mt-4 text-center text-sm text-gray-400">
                <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-300">Volver al inicio de sesión</a>
            </p>
        </form>
    </div>
</x-guest-layout>
