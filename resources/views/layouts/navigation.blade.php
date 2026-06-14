<nav id="app-nav" class="hidden md:block relative sticky top-3 z-40 mx-auto max-w-6xl rounded-2xl bg-[#0a1628]/90 backdrop-blur-xl shadow-2xl shadow-yellow-500/5 border border-white/10 mt-3 transition-all duration-300">
    @php $foto = Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : null; @endphp
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 gold-bg rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="text-xl font-bold text-white">Asistencia <span class="gold-accent">QR</span></span>
                </a>
                <div class="hidden md:flex md:items-center md:ml-6 md:space-x-2">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Inicio
                    </a>
                    @if (in_array(Auth::user()->rol, ['docente', 'supervisor']))
                    <a href="{{ route('cursos.index') }}" class="nav-link {{ request()->routeIs('cursos.*') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Cursos
                    </a>
                    <a href="{{ route('estudiantes.index') }}" class="nav-link {{ request()->routeIs('estudiantes.*') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Estudiantes
                    </a>
                    @endif
                    <a href="{{ route('asistencias.index') }}" class="nav-link {{ request()->routeIs('asistencias.*') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Asistencias
                    </a>
                    @if (Auth::user()->rol === 'estudiante')
                    <a href="{{ route('qr.escanner') }}" class="nav-link {{ request()->routeIs('qr.escanner') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01"/></svg>
                        Escanear QR
                    </a>
                    @endif
                    @if (in_array(Auth::user()->rol, ['docente', 'supervisor']))
                    <a href="{{ route('qr.index') }}" class="nav-link {{ request()->routeIs('qr.index') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        Mis QR
                    </a>
                    @endif
                    @if (Auth::user()->rol === 'supervisor')
                    <a href="{{ route('usuarios.crear-docente') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Usuarios
                    </a>
                    @endif
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <button id="user-btn" onclick="toggleDropdown()" class="hidden md:flex items-center space-x-2 text-gray-300 text-sm group cursor-pointer">
                    @if ($foto)
                        <img src="{{ $foto }}" alt="{{ Auth::user()->name }}" class="w-9 h-9 rounded-full object-cover border-2 border-white/20 group-hover:border-yellow-500/50 transition-all">
                    @else
                        <div class="w-9 h-9 gold-bg rounded-full flex items-center justify-center text-white font-bold text-xs group-hover:ring-2 ring-yellow-500/50 transition-all shadow-lg">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                    @endif
                    <div class="flex items-center gap-1.5">
                        <span class="text-white font-medium leading-tight group-hover:text-yellow-400 transition-colors hidden lg:block">{{ Auth::user()->name }}</span>
                        <svg id="dropdown-arrow" class="w-3.5 h-3.5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <div id="user-dropdown" class="hidden md:block absolute top-full right-4 mt-2 w-56 opacity-0 -translate-y-2 pointer-events-none transition-all duration-200 ease-out">
        <div class="bg-[#0a1628]/95 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl shadow-yellow-500/5 overflow-hidden">
            <div class="p-4 border-b border-white/10">
                <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                <p class="text-white/60 text-xs mt-0.5">{{ Auth::user()->email }}</p>
            </div>
            <div class="p-2">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-300 hover:text-white hover:bg-white/10 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Mi Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div id="mobile-top" class="md:hidden fixed top-0 left-0 right-0 z-50 bg-[#0a1628] border-b border-white/10 px-4 h-14 flex items-center justify-between">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
        <div class="w-8 h-8 gold-bg rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <span class="text-base font-bold text-white">Asistencia <span class="gold-accent">QR</span></span>
    </a>
    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="p-2 text-gray-400 hover:text-red-400 transition-colors cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
        </button>
    </form>
</div>

<nav id="bottom-nav" class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-[#0a1628] border-t border-white/10 safe-bottom">
    <div class="flex items-center justify-around h-16 px-1">
        @php
            $navItems = [
                ['route' => 'dashboard', 'name' => 'Inicio', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ];
            if (in_array(Auth::user()->rol, ['docente', 'supervisor'])) {
                $navItems[] = ['route' => 'cursos.index', 'name' => 'Cursos', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'];
                $navItems[] = ['route' => 'estudiantes.index', 'name' => 'Estudiantes', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857'];
                $navItems[] = ['route' => 'asistencias.index', 'name' => 'Asistencias', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'];
                $navItems[] = ['route' => 'qr.index', 'name' => 'Mis QR', 'icon' => 'M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z'];
                if (Auth::user()->rol === 'supervisor') {
                    $navItems[] = ['route' => 'usuarios.crear-docente', 'name' => 'Usuarios', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'];
                }
                $navItems[] = ['route' => 'profile.edit', 'name' => 'Perfil', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'];
            } else {
                $navItems[] = ['route' => 'asistencias.index', 'name' => 'Asistencias', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'];
                $navItems[] = ['route' => 'qr.escanner', 'name' => 'Escanear', 'icon' => 'M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01'];
                $navItems[] = ['route' => 'profile.edit', 'name' => 'Perfil', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'];
            }
        @endphp
        @foreach ($navItems as $item)
        <a href="{{ route($item['route']) }}" class="flex flex-col items-center gap-0.5 py-1 px-2 rounded-lg transition-all duration-200 {{ request()->routeIs($item['route'] . '*') ? 'text-yellow-400' : 'text-gray-500 hover:text-gray-300' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
            <span class="text-[10px] font-medium">{{ $item['name'] }}</span>
        </a>
        @endforeach
    </div>
</nav>

<style>
    #app-nav { transition: all 0.3s ease; }
    #app-nav.scrolled { background: rgba(10, 22, 40, 0.6); border-color: rgba(212, 168, 67, 0.15); box-shadow: 0 8px 32px rgba(212, 168, 67, 0.05); backdrop-filter: blur(16px); }
    #app-nav:hover { border-color: rgba(212, 168, 67, 0.2); }
    #user-dropdown.show { opacity: 1; transform: translateY(0); pointer-events: auto; }
    .safe-bottom { padding-bottom: env(safe-area-inset-bottom, 0px); }
    #bottom-nav a.active { color: #d4a843; }
    #bottom-nav a.active svg { stroke: #d4a843; }
</style>

<script data-cfasync="false">
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('app-nav');
        if (nav && window.scrollY > 20) {
            nav.classList.add('scrolled');
        } else if (nav) {
            nav.classList.remove('scrolled');
        }
    });

    let dropdownOpen = false;
    function toggleDropdown() {
        dropdownOpen = !dropdownOpen;
        const dropdown = document.getElementById('user-dropdown');
        const arrow = document.getElementById('dropdown-arrow');
        if (dropdownOpen) {
            dropdown.classList.add('show');
            arrow.classList.add('rotate-180');
        } else {
            dropdown.classList.remove('show');
            arrow.classList.remove('rotate-180');
        }
    }
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('user-btn');
        const dropdown = document.getElementById('user-dropdown');
        if (dropdownOpen && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdownOpen = false;
            dropdown.classList.remove('show');
            document.getElementById('dropdown-arrow')?.classList.remove('rotate-180');
        }
    });
</script>