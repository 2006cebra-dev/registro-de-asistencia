<x-guest-layout>
    <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/10">
        <div class="mb-4 text-sm text-gray-300">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-400 bg-green-500/10 border border-green-500/20 rounded-lg px-4 py-3">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-400 hover:text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500/50 px-3 py-2 transition-all">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>