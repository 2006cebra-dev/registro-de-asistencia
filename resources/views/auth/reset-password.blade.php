<x-guest-layout>
    <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/10">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Restablecer contraseña</h2>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-300">Nueva contraseña</label>
                <input id="password" type="password" name="password" required class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
                @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="mt-1 w-full rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 transition-all px-4 py-2.5">
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full py-3 gold-bg text-white font-bold rounded-lg hover:bg-yellow-500 transition-all shadow-lg">Restablecer</button>
            </div>
        </form>
    </div>
</x-guest-layout>
