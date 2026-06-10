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
    <style>
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
        .btn-outline { @apply inline-flex items-center px-4 py-2.5 border-2 border-blue-700 text-blue-700 rounded-lg font-semibold text-sm hover:bg-blue-700 hover:text-white transition-all duration-200; }
        .table-header { @apply px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider; }
        .table-cell { @apply px-4 py-3 text-sm text-gray-700; }
        .card { @apply bg-white rounded-xl shadow-lg overflow-hidden; }
        .input-field { @apply w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="gradient-bg shadow-lg">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-2xl font-bold text-white">{{ $header }}</h1>
                </div>
            </header>
        @endisset

        <main>
            @if (session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-green-100 border-l-4 border-green-600 text-green-800 px-4 py-3 rounded-lg shadow flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-100 border-l-4 border-red-600 text-red-800 px-4 py-3 rounded-lg shadow flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                {{ $slot }}
            </div>
        </main>

        <footer class="gradient-bg mt-12">
            <div class="max-w-7xl mx-auto px-4 py-6 text-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Sistema de Asistencia QR. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>
</html>
