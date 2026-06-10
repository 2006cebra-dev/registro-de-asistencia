<x-guest-layout>
    <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/10">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-gold-accent focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-300">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-gold-accent focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                @error('password')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-4 flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-300">
                    <input type="checkbox" name="remember" class="rounded bg-white/10 border-white/20 text-yellow-500 focus:ring-yellow-500/20">
                    <span class="ml-2">Recordarme</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-yellow-400 hover:text-yellow-300">¿Olvidaste tu contraseña?</a>
                @endif
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full py-3 gold-bg text-white font-bold rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-transparent transition-all shadow-lg">
                    Ingresar
                </button>
            </div>
            <p class="mt-4 text-center text-sm text-gray-400">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-yellow-400 hover:text-yellow-300 font-medium">Regístrate</a>
            </p>
        </form>
    </div>
</x-guest-layout>
