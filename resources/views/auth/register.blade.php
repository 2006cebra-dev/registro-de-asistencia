<x-guest-layout>
    <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/10">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Crear Cuenta</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Nombre completo</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mt-4">
                <label for="codigo_registro" class="block text-sm font-medium text-gray-300">Código de registro</label>
                <input id="codigo_registro" type="text" name="codigo_registro" value="{{ old('codigo_registro') }}" required placeholder="Ej: SIS101" class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5 uppercase">
                @error('codigo_registro') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                <p class="text-gray-500 text-xs mt-1">Solicita este código a tu docente</p>
            </div>
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-300">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full py-3 gold-bg text-white font-bold rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-transparent transition-all shadow-lg">
                    Crear Cuenta
                </button>
            </div>
            <p class="mt-4 text-center text-sm text-gray-400">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-300 font-medium">Inicia sesión</a>
            </p>
        </form>
    </div>
</x-guest-layout>
