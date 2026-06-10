<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema de Asistencia') - Asistencia QR</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Figtree', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #0a1628 0%, #132347 50%, #1a3a6b 100%); }
        .gradient-card { background: linear-gradient(135deg, #1a3a6b 0%, #0a1628 100%); }
        .gold-accent { color: #d4a843; }
        .gold-border { border-color: #d4a843; }
        .gold-bg { background-color: #d4a843; }
        .hover-gold:hover { color: #d4a843; }
        .nav-link { @apply px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200; }
        .nav-link:hover { @apply bg-white/10; }
        .nav-link-active { @apply bg-white/15 text-white; }
        .stat-card { @apply bg-white rounded-xl shadow-lg p-6 border-l-4 transition-transform duration-200 hover:-translate-y-1 hover:shadow-xl; }
        .btn-primary { @apply inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-700 to-blue-900 text-white rounded-lg font-semibold text-sm shadow-md hover:shadow-lg hover:from-blue-800 hover:to-blue-950 transition-all duration-200; }
        .btn-success { @apply inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-green-600 to-green-800 text-white rounded-lg font-semibold text-sm shadow-md hover:shadow-lg transition-all duration-200; }
        .btn-warning { @apply inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-yellow-500 to-yellow-700 text-white rounded-lg font-semibold text-sm shadow-md hover:shadow-lg transition-all duration-200; }
        .btn-danger { @apply inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-red-600 to-red-800 text-white rounded-lg font-semibold text-sm shadow-md hover:shadow-lg transition-all duration-200; }
        .btn-outline { @apply inline-flex items-center px-4 py-2.5 border-2 border-white/20 text-gray-300 rounded-lg font-semibold text-sm hover:bg-white/10 hover:text-white transition-all duration-200; }
        .table-header { @apply px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider; }
        .table-cell { @apply px-4 py-3 text-sm text-gray-700; }
        .card { @apply bg-white rounded-xl shadow-lg overflow-hidden; }
        .card-dark { @apply rounded-xl shadow-lg overflow-hidden; background: linear-gradient(135deg, #1a3a6b 0%, #0a1628 100%); border: 1px solid rgba(255,255,255,0.1); }
        .input-field { @apply w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all; }
        .btn-gold { @apply inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm shadow-md hover:shadow-lg hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200 cursor-pointer; }
        .bg-dark-card { background: #132347; }
        .bg-dark-bg { background: #0a1628; }
        .border-gold { border-color: #d4a843; }
        .text-gold { color: #d4a843; }

        .toast-enter { animation: toastIn 0.4s ease-out forwards; }
        .toast-leave { animation: toastOut 0.3s ease-in forwards; }
        @keyframes toastIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes toastOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div id="toast-container" class="fixed top-4 right-4 z-[100] flex flex-col gap-3 pointer-events-none">
    </div>

    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        @isset($header)
            <header class="gradient-bg shadow-lg">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-2xl font-bold text-white">{{ $header }}</h1>
                </div>
            </header>
        @endisset

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                {{ $slot }}
            </div>
        </main>

        <footer class="gradient-bg">
            <div class="max-w-7xl mx-auto px-4 py-6 text-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Sistema de Asistencia QR. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <script>
        function showToast(type, message) {
            const container = document.getElementById('toast-container');
            const icons = {
                success: '<svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                error: '<svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                warning: '<svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>',
                info: '<svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            };
            const borders = {
                success: 'border-green-500',
                error: 'border-red-500',
                warning: 'border-yellow-500',
                info: 'border-blue-500'
            };

            const toast = document.createElement('div');
            toast.className = 'pointer-events-auto flex items-start gap-3 max-w-sm backdrop-blur-xl bg-white/95 rounded-xl shadow-2xl border-l-4 ' + (borders[type] || borders.info) + ' p-4 toast-enter';
            toast.innerHTML = '<div class="flex-shrink-0 mt-0.5">' + (icons[type] || icons.info) + '</div>' +
                '<p class="text-sm text-gray-800 flex-1">' + message + '</p>' +
                '<button onclick="this.closest(\'.pointer-events-auto\').remove()" class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>';

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('toast-enter');
                toast.classList.add('toast-leave');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        const flashSuccess = {!! json_encode(session('success')) !!};
        const flashError = {!! json_encode(session('error')) !!};
        if (flashSuccess) showToast('success', flashSuccess);
        if (flashError) showToast('error', flashError);
    </script>
</body>
</html>
