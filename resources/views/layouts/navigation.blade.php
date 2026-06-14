<nav class="hidden md:block sticky top-0 z-50 bg-[#0a1628]/95 backdrop-blur-xl border-b border-white/10 shadow-lg shadow-yellow-500/5">
    @php $foto = Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : null; @endphp
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-2">
            <div class="flex items-center gap-1 min-w-0 overflow-x-auto scrollbar-none">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 shrink-0 mr-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center shadow-lg shadow-yellow-500/20 ring-2 ring-yellow-500/20">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="text-base font-bold text-white hidden sm:block">Asistencia <span class="text-yellow-400">QR</span></span>
                </a>
                <a href="{{ route('dashboard') }}" class="nav-pill {{ request()->routeIs('dashboard') ? 'nav-pill-active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></svg>
                    Inicio
                </a>
                @if (in_array(Auth::user()->rol, ['docente', 'supervisor']))
                <a href="{{ route('cursos.index') }}" class="nav-pill {{ request()->routeIs('cursos.*') ? 'nav-pill-active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></svg>
                    Cursos
                </a>
                @endif
                @if (in_array(Auth::user()->rol, ['docente', 'supervisor']))
                <a href="{{ route('estudiantes.index') }}" class="nav-pill {{ request()->routeIs('estudiantes.*') ? 'nav-pill-active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"></svg>
                    Estudiantes
                </a>
                @endif
                <a href="{{ route('asistencias.index') }}" class="nav-pill {{ request()->routeIs('asistencias.*') ? 'nav-pill-active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></svg>
                    Asistencias
                </a>
                @if (Auth::user()->rol === 'estudiante')
                <a href="{{ route('qr.escanner') }}" class="nav-pill {{ request()->routeIs('qr.escanner') ? 'nav-pill-active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01"></svg>
                    Escanear
                </a>
                @endif
                <a href="{{ route('qr.index') }}" class="nav-pill {{ request()->routeIs('qr.index') ? 'nav-pill-active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></svg>
                    QR
                </a>
                @if (Auth::user()->rol === 'supervisor')
                <a href="{{ route('usuarios.crear-docente') }}" class="nav-pill {{ request()->routeIs('usuarios.*') ? 'nav-pill-active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></svg>
                    Usuarios
                </a>
                @endif
            </div>
            <div class="relative shrink-0" id="user-menu">
                <button onclick="toggleUserMenu()" class="flex items-center gap-2 text-sm group cursor-pointer">
                    @if ($foto)
                        <img src="{{ $foto }}" alt="" class="w-8 h-8 rounded-lg object-cover border-2 border-white/20 group-hover:border-yellow-500/50 transition-all ring-2 ring-yellow-500/10">
                    @else
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center group-hover:ring-2 ring-yellow-500/50 transition-all shadow-lg">
                            <span class="text-white font-bold text-xs">{{ substr(Auth::user()->name, 0, 2) }}</span>
                        </div>
                    @endif
                    <span class="text-white font-medium leading-tight group-hover:text-yellow-400 transition-colors hidden lg:block">{{ Auth::user()->name }}</span>
                    <svg id="user-arrow" class="w-3.5 h-3.5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></svg>
                </button>
                <div id="user-dropdown" class="hidden absolute top-full right-0 mt-2 w-56">
                    <div class="bg-[#0a1628]/95 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl shadow-yellow-500/5 overflow-hidden">
                        <div class="p-4 border-b border-white/10">
                            <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-white/60 text-xs mt-0.5">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-300 hover:text-white hover:bg-white/10 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></svg>
                                Mi Perfil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></svg>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<nav id="bottom-nav" class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-[#0a1628]/95 border-t border-white/10 safe-bottom shadow-2xl shadow-yellow-500/5">
    <div class="flex items-center justify-around h-16 px-1">
        @php
            $navItems = [
                ['route' => 'dashboard', 'name' => 'Inicio', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ];
            if (in_array(Auth::user()->rol, ['docente', 'supervisor'])) {
                $navItems[] = ['route' => 'cursos.index', 'name' => 'Cursos', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'];
            }
            if (in_array(Auth::user()->rol, ['docente', 'supervisor'])) {
                $navItems[] = ['route' => 'estudiantes.index', 'name' => 'Estudiantes', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857'];
            }
            $navItems[] = ['route' => 'asistencias.index', 'name' => 'Asistencias', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'];
            $navItems[] = ['route' => 'qr.index', 'name' => 'QR', 'icon' => 'M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z'];
            if (Auth::user()->rol === 'supervisor') {
                $navItems[] = ['route' => 'usuarios.crear-docente', 'name' => 'Usuarios', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'];
            }
            $navItems[] = ['route' => 'profile.edit', 'name' => 'Perfil', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'];
        @endphp
        @foreach ($navItems as $item)
        @php $isActive = request()->routeIs($item['route'] . '*'); @endphp
        <a href="{{ route($item['route']) }}" class="relative flex flex-col items-center gap-0.5 py-1 px-3 rounded-xl transition-all duration-200 {{ $isActive ? 'text-yellow-400' : 'text-gray-500 hover:text-gray-300' }}">
            @if ($isActive)
            <div class="absolute inset-0 bg-gradient-to-b from-yellow-500/15 to-transparent rounded-xl border border-yellow-500/20"></div>
            @endif
            <div class="relative flex flex-col items-center gap-0.5">
                @if ($isActive)
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shadow-lg shadow-yellow-500/20 -mt-2 mb-0.5">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></svg>
                </div>
                @else
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></svg>
                @endif
                <span class="text-[10px] font-semibold {{ $isActive ? 'text-yellow-400' : 'text-gray-400' }}">{{ $item['name'] }}</span>
            </div>
        </a>
        @endforeach
    </div>
</nav>

<style>
    .nav-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.4rem 0.8rem;
        border-radius: 9999px;
        font-size: 0.8125rem;
        font-weight: 500;
        color: #9ca3af;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .nav-pill:hover {
        color: #fff;
        background: rgba(255,255,255,0.08);
    }
    .nav-pill-active {
        color: #fff !important;
        background: linear-gradient(135deg, #d4a843, #a16207);
        box-shadow: 0 4px 12px rgba(212,168,67,0.3);
    }
    .nav-pill-active:hover {
        background: linear-gradient(135deg, #eab308, #ca8a04);
    }
    .scrollbar-none::-webkit-scrollbar { display: none; }
    .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }
    .safe-bottom { padding-bottom: env(safe-area-inset-bottom, 0px); }
    #user-dropdown.show { display: block; }
</style>
<script data-cfasync="false">
    let userMenuOpen = false;
    function toggleUserMenu() {
        userMenuOpen = !userMenuOpen;
        const dd = document.getElementById('user-dropdown');
        const arrow = document.getElementById('user-arrow');
        if (userMenuOpen) { dd.classList.add('show'); arrow.classList.add('rotate-180'); }
        else { dd.classList.remove('show'); arrow.classList.remove('rotate-180'); }
    }
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('user-menu');
        const dd = document.getElementById('user-dropdown');
        if (userMenuOpen && menu && !menu.contains(e.target)) {
            userMenuOpen = false;
            dd.classList.remove('show');
            document.getElementById('user-arrow')?.classList.remove('rotate-180');
        }
    });
</script>
