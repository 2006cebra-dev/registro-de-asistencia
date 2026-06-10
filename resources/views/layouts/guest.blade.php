<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Asistencia QR') - Sistema de Asistencia</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Figtree', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #0a1628 0%, #132347 50%, #1a3a6b 100%); }
        .gold-accent { color: #d4a843; }
        .gold-bg { background-color: #d4a843; }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen gradient-bg flex flex-col items-center justify-center px-4">
        <div class="mb-8 text-center">
            <div class="w-16 h-16 gold-bg rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h1 class="text-3xl font-bold text-white">Asistencia <span class="gold-accent">QR</span></h1>
            <p class="text-gray-400 mt-1">Sistema de registro de asistencia</p>
        </div>
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
