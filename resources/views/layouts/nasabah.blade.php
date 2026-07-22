<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta-description', 'Dashboard Nasabah ARUNA — Kelola tabungan sampah Anda dengan mudah.')">
    <title>@yield('title', 'Dashboard') — ARUNA Nasabah</title>
    
    {{-- Script Anti-Flicker untuk Dark Mode --}}
    <script>
        if (localStorage.getItem('nasabah_theme') === 'dark' || (!('nasabah_theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-jakarta: 'Plus Jakarta Sans', 'Inter', sans-serif;
            --font-inter: 'Inter', sans-serif;
            
            --color-primary: #0f5238;
            --color-on-primary: #ffffff;
            --color-surface: #f8f9fa;
            --color-surface-container-lowest: #ffffff;
            --color-surface-container-low: #f3f4f5;
            --color-surface-container: #edeeef;
            --color-surface-container-high: #e7e8e9;
            --color-surface-container-highest: #e1e3e4;
            --color-on-surface: #191c1d;
            --color-on-surface-variant: #404943;
            --color-outline: #707973;
            --color-outline-variant: #bfc9c1;
            --color-tertiary: #0d5237;
            --color-secondary: #854d0e;
            --color-on-secondary: #ffffff;
            --color-secondary-container: #fef3c7;
            --color-on-secondary-container: #78350f;
            --color-error: #ba1a1a;
            --color-error-container: #ffdad6;
            --color-on-error-container: #93000a;
        }

        /* ===== DARK MODE THEME ===== */
        html.dark {
            --color-primary: #34d399;
            --color-on-primary: #0b1f14;
            --color-surface: #0c1510;
            --color-surface-container-lowest: #111d16;
            --color-surface-container-low: #162318;
            --color-surface-container: #1b2b1e;
            --color-surface-container-high: #233524;
            --color-surface-container-highest: #2b3f2c;
            --color-on-surface: #e8f0ea;
            --color-on-surface-variant: #8fa898;
            --color-outline: #5a7362;
            --color-outline-variant: #263830;
            --color-tertiary: #2dd4bf;
            --color-secondary: #f59e0b;
            --color-on-secondary: #0b1f14;
            --color-secondary-container: #78350f;
            --color-on-secondary-container: #fde68a;
            --color-error: #f87171;
            --color-error-container: #450a0a;
            --color-on-error-container: #fecaca;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #707973; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: #0f5238; }
        html.dark ::-webkit-scrollbar-thumb { background: #34d399; }
        html.dark ::-webkit-scrollbar-thumb:hover { background: #6ee7b7; }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #707973; border-radius: 10px; }

        /* ===== BACKGROUND PATTERN ===== */
        .dashboard-bg {
            background-color: #f8f9fa;
            background-image: radial-gradient(#0f52380f 1px, transparent 1px);
            background-size: 32px 32px;
        }
        html.dark .dashboard-bg {
            background-color: #0c1510;
            background-image: radial-gradient(#34d39912 1px, transparent 1px);
        }

        /* ===== SHADOWS ===== */
        .card-shadow {
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes pageSlideIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .page-slide-in { 
            animation: pageSlideIn 0.45s cubic-bezier(0.22, 1, 0.36, 1) forwards; 
        }

        @keyframes floatBubble {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(1.5deg); }
        }
        .float-bubble { animation: floatBubble 6s ease-in-out infinite; }
        .float-bubble-delay { animation: floatBubble 7s ease-in-out infinite 1.5s; }

        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(15, 82, 56, 0.25); }
            50% { box-shadow: 0 0 0 8px rgba(15, 82, 56, 0); }
        }
        .pulse-glow { animation: pulseGlow 2.5s ease-in-out infinite; }

        /* Smooth Transitions */
        .hover-elevate {
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease, border-color 0.25s ease;
        }
        .hover-elevate:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.05);
        }

        /* Staggered load animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.45s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        /* Chart bar load animation */
        @keyframes scaleYUp {
            from { transform: scaleY(0); transform-origin: bottom; }
            to { transform: scaleY(1); transform-origin: bottom; }
        }
        .animate-scale-y {
            animation: scaleYUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        /* ===== JS-DRIVEN ANIMATION CLASSES ===== */

        /* Scroll Reveal — elements hidden until IntersectionObserver triggers */
        [data-reveal] {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1), transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
        }
        [data-reveal].revealed {
            opacity: 1;
            transform: translateY(0);
        }
        [data-reveal="left"] {
            opacity: 0;
            transform: translateX(-40px);
        }
        [data-reveal="left"].revealed {
            opacity: 1;
            transform: translateX(0);
        }
        [data-reveal="right"] {
            opacity: 0;
            transform: translateX(40px);
        }
        [data-reveal="right"].revealed {
            opacity: 1;
            transform: translateX(0);
        }
        [data-reveal="scale"] {
            opacity: 0;
            transform: scale(0.85);
        }
        [data-reveal="scale"].revealed {
            opacity: 1;
            transform: scale(1);
        }
        [data-reveal="flip"] {
            opacity: 0;
            transform: perspective(600px) rotateX(15deg);
        }
        [data-reveal="flip"].revealed {
            opacity: 1;
            transform: perspective(600px) rotateX(0);
        }

        /* Ripple click effect container */
        .ripple-container { position: relative; overflow: hidden; }
        .ripple-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(15, 82, 56, 0.15);
            transform: scale(0);
            animation: rippleExpand 0.6s ease-out forwards;
            pointer-events: none;
        }
        @keyframes rippleExpand {
            to { transform: scale(4); opacity: 0; }
        }

        /* Shimmer / skeleton loading effect */
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .shimmer-bg {
            background: linear-gradient(90deg, transparent 25%, rgba(15,82,56,0.06) 50%, transparent 75%);
            background-size: 200% 100%;
            animation: shimmer 2.5s infinite;
        }

        /* 3D Tilt card perspective */
        .tilt-card {
            transition: transform 0.15s ease-out;
            will-change: transform;
        }

        /* Floating particles canvas */
        #particles-canvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* Animated progress bar fill */
        .progress-animated .progress-fill {
            width: 0;
            transition: width 1.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .progress-animated.active .progress-fill {
            /* width set via JS */
        }

        /* Magnetic hover for icons */
        .magnetic-hover {
            transition: transform 0.2s ease-out;
        }

        /* Typewriter cursor blink */
        @keyframes cursorBlink {
            0%, 100% { border-color: rgba(15, 82, 56, 0.8); }
            50% { border-color: transparent; }
        }
        .typewriter-cursor {
            border-right: 2px solid rgba(15, 82, 56, 0.8);
            animation: cursorBlink 1s step-end infinite;
            padding-right: 2px;
        }

        /* Glow pulse on data values */
        @keyframes dataGlow {
            0%, 100% { text-shadow: 0 0 0 transparent; }
            50% { text-shadow: 0 0 12px rgba(15, 82, 56, 0.2); }
        }
        .data-glow {
            animation: dataGlow 3s ease-in-out infinite;
        }

        /* Rotating eco icon */
        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .spin-slow { animation: spinSlow 20s linear infinite; }

        /* Bounce in */
        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }
        .animate-bounce-in {
            animation: bounceIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
    </style>
    @stack('styles')
</head>
<body class="font-jakarta dashboard-bg text-on-surface min-h-screen flex flex-col md:flex-row transition-colors duration-300"
      x-data="{ 
          sidebarOpen: false,
          darkMode: localStorage.getItem('nasabah_theme') === 'dark' || (!('nasabah_theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
      }"
      x-init="$watch('darkMode', val => {
          if (val) {
              document.documentElement.classList.add('dark');
              localStorage.setItem('nasabah_theme', 'dark');
          } else {
              document.documentElement.classList.remove('dark');
              localStorage.setItem('nasabah_theme', 'light');
          }
      })">

    {{-- ============================================================ --}}
    {{-- MOBILE OVERLAY --}}
    {{-- ============================================================ --}}
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/40 backdrop-blur-[1px] z-40 md:hidden"
        style="display: none;"
    ></div>

    {{-- ============================================================ --}}
    {{-- SIDEBAR (DESKTOP & MOBILE DRAWER) --}}
    {{-- ============================================================ --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        class="fixed inset-y-0 left-0 h-screen flex flex-col p-6 z-50 border-r border-outline-variant/30 bg-surface-container-lowest w-72 transition-transform duration-300 ease-out shrink-0"
    >
        {{-- Brand Logo --}}
        <div class="mb-10 px-2 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-md shadow-primary/10">
                    <span class="material-symbols-outlined text-on-primary text-[22px]">eco</span>
                </div>
                <div>
                    <h1 class="font-inter text-[18px] font-extrabold text-primary leading-tight tracking-tight">ARUNA</h1>
                    <p class="text-on-surface-variant/60 text-[10px] uppercase font-bold tracking-widest">Portal Nasabah</p>
                </div>
            </div>
            <button @click="sidebarOpen = false" class="md:hidden w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant/40 hover:text-on-surface hover:bg-surface-container transition-all">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        {{-- Nav Menu --}}
        <nav class="flex flex-col gap-1 flex-1">
            <p class="text-[10px] font-bold text-on-surface-variant/40 uppercase tracking-widest mb-3 px-4">Menu Utama</p>
            
            {{-- Dashboard --}}
            <a href="{{ route('user.dashboard') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 font-semibold transition-all group duration-200
                      {{ request()->routeIs('user.dashboard') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('user.dashboard') ? 'text-primary' : 'text-on-surface-variant group-hover:text-primary' }}">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            {{-- Riwayat --}}
            <a href="{{ route('user.riwayat') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 font-semibold transition-all group duration-200
                      {{ request()->routeIs('user.riwayat') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('user.riwayat') ? 'text-primary' : 'text-on-surface-variant group-hover:text-primary' }}">receipt_long</span>
                <span class="text-sm font-medium">Riwayat Transaksi</span>
            </a>

            {{-- Profil --}}
            <a href="{{ route('user.profil') }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 font-semibold transition-all group duration-200
                      {{ request()->routeIs('user.profil') ? 'bg-primary/5 text-primary' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('user.profil') ? 'text-primary' : 'text-on-surface-variant group-hover:text-primary' }}">person</span>
                <span class="text-sm font-medium">Profil Saya</span>
            </a>


        </nav>

        {{-- Footer Area (User Card & Logout) --}}
        <div class="mt-auto pt-6 border-t border-outline-variant/30">
            <div class="bg-surface-container/50 rounded-2xl p-4 mb-4 border border-outline-variant/10">
                <div class="flex items-center gap-3 mb-3">
                    @if(Auth::user()->profile_photo)
                        <div class="w-9 h-9 rounded-xl overflow-hidden border border-primary/20 shadow-xs shrink-0">
                            <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold text-sm border border-primary/20 shadow-xs shrink-0">
                            {{ strtoupper(substr(Auth::user()->name ?? 'N', 0, 1)) }}
                        </div>
                    @endif
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-on-surface truncate">{{ Auth::user()->name ?? 'Nasabah' }}</p>
                        <p class="text-[10px] text-primary/80 font-semibold font-mono tracking-wider truncate">{{ Auth::user()->no_id ?? '-' }}</p>
                    </div>
                </div>
                <div class="border-t border-outline-variant/20 pt-2 flex justify-between items-center text-[11px]">
                    <span class="text-on-surface-variant/60 font-semibold">Tabungan</span>
                    <span class="font-bold text-primary font-mono">Rp {{ number_format(Auth::user()->total_tabungan ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <form method="POST" action="{{ route('user.logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 text-error/80 px-4 py-2.5 rounded-xl hover:bg-error-container/10 hover:text-error transition-all group duration-200 cursor-pointer">
                        <span class="material-symbols-outlined text-[20px] group-hover:translate-x-0.5 transition-transform">logout</span>
                        <span class="text-xs font-bold font-inter">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ============================================================ --}}
    {{-- MAIN CANVAS CONTENT --}}
    {{-- ============================================================ --}}
    <div class="flex-1 flex flex-col min-w-0 md:pl-72">
        
        {{-- Top App Header --}}
        <header class="flex justify-between items-center w-full px-6 py-4 sticky top-0 z-30 bg-surface/85 backdrop-blur-md border-b border-outline-variant/30 card-shadow">
            {{-- Breadcrumbs / Page Title --}}
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="md:hidden w-9 h-9 rounded-xl flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors border border-outline-variant/30">
                    <span class="material-symbols-outlined text-[22px]">menu</span>
                </button>
                
                <div class="hidden sm:flex items-center gap-2 text-xs font-semibold text-on-surface-variant/60">
                    <a href="{{ route('user.dashboard') }}" class="hover:text-primary transition-colors flex items-center">
                        <span class="material-symbols-outlined text-sm">home</span>
                    </a>
                    <span class="material-symbols-outlined text-xs text-outline-variant">chevron_right</span>
                    <span class="text-on-surface font-bold">@yield('page-title', 'Dashboard')</span>
                </div>
                <h1 class="sm:hidden text-sm font-bold text-on-surface">@yield('page-title', 'Dashboard')</h1>
            </div>

            {{-- Top Toolbar Actions --}}
            <div class="flex items-center gap-2 sm:gap-3">
                {{-- Date pill --}}
                <div class="hidden md:flex items-center gap-2 text-[11px] text-on-surface-variant/75 font-semibold bg-surface-container-low px-3 py-1.5 rounded-lg border border-outline-variant/20">
                    <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
                    {{ now()->translatedFormat('l, d M Y') }}
                </div>

                {{-- Status Anggota --}}
                <div class="flex items-center gap-1.5 text-[11px] font-bold bg-primary/5 text-primary px-3 py-1.5 rounded-lg border border-primary/10">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                    </span>
                    Aktif
                </div>

                {{-- Dark Mode Toggle --}}
                <button @click="darkMode = !darkMode"
                        class="w-9 h-9 rounded-xl flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-all active:scale-90 duration-200 cursor-pointer border border-outline-variant/20"
                        :title="darkMode ? 'Mode Terang' : 'Mode Gelap'">
                    <span class="material-symbols-outlined text-[20px]" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
                </button>

                {{-- User profile avatar tooltip --}}
                @if(Auth::user()->profile_photo)
                    <div class="w-9 h-9 rounded-xl overflow-hidden border border-outline-variant/20 shadow-xs shrink-0" title="{{ Auth::user()->name ?? 'Nasabah' }}">
                        <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-9 h-9 rounded-xl bg-primary text-on-primary flex items-center justify-center text-xs font-bold shadow-sm shadow-primary/20"
                         title="{{ Auth::user()->name ?? 'Nasabah' }}">
                        {{ strtoupper(substr(Auth::user()->name ?? 'N', 0, 1)) }}
                    </div>
                @endif
            </div>
        </header>

        {{-- Page Main Container --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-[1400px] w-full page-slide-in pb-24 md:pb-8">
            @yield('content')
        </main>
        
        {{-- Desktop Footer --}}
        <footer class="hidden md:block border-t border-outline-variant/30 bg-surface-container-lowest/50 px-8 py-4">
            <div class="flex items-center justify-between text-[11px] text-on-surface-variant/50 font-medium">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs text-primary">eco</span>
                    &copy; {{ date('Y') }} ARUNA. Seluruh hak cipta dilindungi.
                </span>
                <span>Portal Nasabah v1.1.0</span>
            </div>
        </footer>
    </div>

    {{-- ============================================================ --}}
    {{-- MOBILE BOTTOM NAVIGATION BAR --}}
    {{-- ============================================================ --}}
    <nav class="md:hidden fixed bottom-0 left-0 w-full bg-surface-container-lowest border-t border-outline-variant/30 px-3 py-2 flex justify-around items-center z-40 shadow-[0_-4px_20px_rgba(0,0,0,0.05)]">
        <a href="{{ route('user.dashboard') }}"
           class="flex flex-col items-center gap-1 flex-1 py-1.5 rounded-xl transition-all duration-200
                  {{ request()->routeIs('user.dashboard') ? 'text-primary bg-primary/5 font-bold' : 'text-on-surface-variant/60' }}">
            <span class="material-symbols-outlined text-[22px]">dashboard</span>
            <span class="text-[9px] font-bold">Dashboard</span>
        </a>
        <a href="{{ route('user.riwayat') }}"
           class="flex flex-col items-center gap-1 flex-1 py-1.5 rounded-xl transition-all duration-200
                  {{ request()->routeIs('user.riwayat') ? 'text-primary bg-primary/5 font-bold' : 'text-on-surface-variant/60' }}">
            <span class="material-symbols-outlined text-[22px]">receipt_long</span>
            <span class="text-[9px] font-bold">Riwayat</span>
        </a>
        <a href="{{ route('user.profil') }}"
           class="flex flex-col items-center gap-1 flex-1 py-1.5 rounded-xl transition-all duration-200
                  {{ request()->routeIs('user.profil') ? 'text-primary bg-primary/5 font-bold' : 'text-on-surface-variant/60' }}">
            <span class="material-symbols-outlined text-[22px]">person</span>
            <span class="text-[9px] font-bold">Profil</span>
        </a>
        <a href="{{ route('homepage') }}"
           class="flex flex-col items-center gap-1 flex-1 py-1.5 text-on-surface-variant/60">
            <span class="material-symbols-outlined text-[22px]">home</span>
            <span class="text-[9px] font-bold">Beranda</span>
        </a>
    </nav>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: {!! json_encode(session('success')) !!},
                    confirmButtonColor: '#0f5238',
                    timer: 3500,
                    timerProgressBar: true
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: {!! json_encode(session('error')) !!},
                    confirmButtonColor: '#dc2626',
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    html: `
                        <div class="text-left font-sans">
                            <ul class="list-disc pl-5 space-y-1 text-sm text-red-600">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    `,
                    confirmButtonColor: '#dc2626',
                });
            @endif

            // Button active state handler
            const buttons = document.querySelectorAll('button, [role="button"]');
            buttons.forEach(btn => {
                btn.addEventListener('mousedown', () => btn.classList.add('scale-[0.98]'));
                btn.addEventListener('mouseup', () => btn.classList.remove('scale-[0.98]'));
                btn.addEventListener('mouseleave', () => btn.classList.remove('scale-[0.98]'));
            });

            // ============================================================
            //  1. SCROLL REVEAL — IntersectionObserver
            // ============================================================
            const revealElements = document.querySelectorAll('[data-reveal]');
            if (revealElements.length > 0) {
                const revealObserver = new IntersectionObserver((entries) => {
                    entries.forEach((entry, i) => {
                        if (entry.isIntersecting) {
                            const delay = entry.target.dataset.revealDelay || 0;
                            setTimeout(() => {
                                entry.target.classList.add('revealed');
                            }, parseInt(delay));
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
                revealElements.forEach(el => revealObserver.observe(el));
            }

            // ============================================================
            //  2. ANIMATED NUMBER COUNTER
            // ============================================================
            const counters = document.querySelectorAll('[data-count]');
            if (counters.length > 0) {
                const counterObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            counterObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });
                counters.forEach(el => counterObserver.observe(el));
            }

            function animateCounter(el) {
                const target = parseFloat(el.dataset.count);
                const duration = parseInt(el.dataset.countDuration || 1500);
                const suffix = el.dataset.countSuffix || '';
                const prefix = el.dataset.countPrefix || '';
                const decimals = parseInt(el.dataset.countDecimals || 0);
                const useThousandSep = el.dataset.countSep !== 'false';
                const startTime = performance.now();

                function easeOutExpo(t) {
                    return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
                }

                function formatNumber(num) {
                    const fixed = num.toFixed(decimals);
                    if (!useThousandSep) return fixed;
                    const parts = fixed.split('.');
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    return parts.join(',');
                }

                function tick(now) {
                    const elapsed = now - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const current = target * easeOutExpo(progress);
                    el.textContent = prefix + formatNumber(current) + suffix;
                    if (progress < 1) requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            }

            // ============================================================
            //  3. 3D TILT CARD EFFECT
            // ============================================================
            const tiltCards = document.querySelectorAll('.tilt-card');
            tiltCards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = ((y - centerY) / centerY) * -6;
                    const rotateY = ((x - centerX) / centerX) * 6;
                    card.style.transform = `perspective(600px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'perspective(600px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
                });
            });

            // ============================================================
            //  4. RIPPLE CLICK EFFECT
            // ============================================================
            const rippleElements = document.querySelectorAll('.ripple-container');
            rippleElements.forEach(el => {
                el.addEventListener('click', function(e) {
                    const rect = el.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const circle = document.createElement('span');
                    circle.classList.add('ripple-circle');
                    circle.style.width = circle.style.height = size + 'px';
                    circle.style.left = (e.clientX - rect.left - size / 2) + 'px';
                    circle.style.top = (e.clientY - rect.top - size / 2) + 'px';
                    el.appendChild(circle);
                    setTimeout(() => circle.remove(), 600);
                });
            });

            // ============================================================
            //  5. MAGNETIC HOVER FOR ICONS
            // ============================================================
            const magneticElements = document.querySelectorAll('.magnetic-hover');
            magneticElements.forEach(el => {
                el.addEventListener('mousemove', (e) => {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    el.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
                });
                el.addEventListener('mouseleave', () => {
                    el.style.transform = 'translate(0, 0)';
                });
            });

            // ============================================================
            //  6. ANIMATED PROGRESS BARS
            // ============================================================
            const progressBars = document.querySelectorAll('.progress-animated');
            if (progressBars.length > 0) {
                const progressObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const bar = entry.target;
                            bar.classList.add('active');
                            const fill = bar.querySelector('.progress-fill');
                            const targetWidth = fill.dataset.width || '0%';
                            setTimeout(() => {
                                fill.style.width = targetWidth;
                            }, 200);
                            progressObserver.unobserve(bar);
                        }
                    });
                }, { threshold: 0.3 });
                progressBars.forEach(bar => progressObserver.observe(bar));
            }

            // ============================================================
            //  7. FLOATING PARTICLE SYSTEM (Canvas)
            // ============================================================
            const canvas = document.getElementById('particles-canvas');
            if (canvas) {
                const ctx = canvas.getContext('2d');
                let particles = [];
                const particleCount = 25;
                
                function resizeCanvas() {
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                }
                resizeCanvas();
                window.addEventListener('resize', resizeCanvas);

                class Particle {
                    constructor() { this.reset(); }
                    reset() {
                        this.x = Math.random() * canvas.width;
                        this.y = Math.random() * canvas.height;
                        this.size = Math.random() * 3 + 1;
                        this.speedX = (Math.random() - 0.5) * 0.4;
                        this.speedY = -Math.random() * 0.3 - 0.1;
                        this.opacity = Math.random() * 0.5 + 0.1;
                        this.life = Math.random() * 200 + 100;
                        this.maxLife = this.life;
                    }
                    update() {
                        this.x += this.speedX;
                        this.y += this.speedY;
                        this.life--;
                        this.opacity = (this.life / this.maxLife) * 0.4;
                        if (this.life <= 0 || this.y < -10) this.reset();
                        if (this.x < 0) this.x = canvas.width;
                        if (this.x > canvas.width) this.x = 0;
                    }
                    draw() {
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                        ctx.fillStyle = `rgba(15, 82, 56, ${this.opacity})`;
                        ctx.fill();
                    }
                }

                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }

                function animateParticles() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    particles.forEach(p => { p.update(); p.draw(); });

                    // Draw connecting lines between nearby particles
                    for (let i = 0; i < particles.length; i++) {
                        for (let j = i + 1; j < particles.length; j++) {
                            const dx = particles[i].x - particles[j].x;
                            const dy = particles[i].y - particles[j].y;
                            const dist = Math.sqrt(dx * dx + dy * dy);
                            if (dist < 120) {
                                ctx.beginPath();
                                ctx.moveTo(particles[i].x, particles[i].y);
                                ctx.lineTo(particles[j].x, particles[j].y);
                                ctx.strokeStyle = `rgba(15, 82, 56, ${0.06 * (1 - dist / 120)})`;
                                ctx.lineWidth = 0.5;
                                ctx.stroke();
                            }
                        }
                    }
                    requestAnimationFrame(animateParticles);
                }
                animateParticles();
            }

            // ============================================================
            //  8. PARALLAX SCROLL EFFECT
            // ============================================================
            const parallaxElements = document.querySelectorAll('[data-parallax]');
            if (parallaxElements.length > 0) {
                const mainContent = document.querySelector('main');
                const scrollTarget = mainContent ? mainContent.closest('.flex-1.flex.flex-col') : window;
                
                function handleParallax() {
                    const scrollY = (scrollTarget === window) ? window.scrollY : scrollTarget.scrollTop;
                    parallaxElements.forEach(el => {
                        const speed = parseFloat(el.dataset.parallax || 0.3);
                        const rect = el.getBoundingClientRect();
                        if (rect.top < window.innerHeight && rect.bottom > 0) {
                            const yOffset = (scrollY * speed) % 50;
                            el.style.transform = `translateY(${yOffset}px)`;
                        }
                    });
                }
                
                if (scrollTarget === window) {
                    window.addEventListener('scroll', handleParallax, { passive: true });
                } else {
                    scrollTarget.addEventListener('scroll', handleParallax, { passive: true });
                }
            }

            // ============================================================
            //  9. TYPEWRITER GREETING EFFECT
            // ============================================================
            const typewriterElements = document.querySelectorAll('[data-typewriter]');
            typewriterElements.forEach(el => {
                const text = el.dataset.typewriter;
                const speed = parseInt(el.dataset.typewriterSpeed || 60);
                el.textContent = '';
                el.classList.add('typewriter-cursor');
                let i = 0;

                function typeChar() {
                    if (i < text.length) {
                        el.textContent += text.charAt(i);
                        i++;
                        setTimeout(typeChar, speed);
                    } else {
                        setTimeout(() => {
                            el.classList.remove('typewriter-cursor');
                        }, 1500);
                    }
                }
                
                const twObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            setTimeout(typeChar, 300);
                            twObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });
                twObserver.observe(el);
            });

            // ============================================================
            // 10. STAGGERED REVEAL FOR GRID CHILDREN
            // ============================================================
            const staggerContainers = document.querySelectorAll('[data-stagger]');
            staggerContainers.forEach(container => {
                const children = container.children;
                const baseDelay = parseInt(container.dataset.stagger || 100);
                const staggerObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            Array.from(children).forEach((child, i) => {
                                child.style.opacity = '0';
                                child.style.transform = 'translateY(20px)';
                                child.style.transition = `opacity 0.5s ease ${i * baseDelay}ms, transform 0.5s cubic-bezier(0.22, 1, 0.36, 1) ${i * baseDelay}ms`;
                                setTimeout(() => {
                                    child.style.opacity = '1';
                                    child.style.transform = 'translateY(0)';
                                }, 50);
                            });
                            staggerObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });
                staggerObserver.observe(container);
            });

            // ============================================================
            // 11. HOVER GLOW CURSOR TRACKER
            // ============================================================
            const glowCards = document.querySelectorAll('[data-glow]');
            glowCards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    card.style.setProperty('--glow-x', `${x}px`);
                    card.style.setProperty('--glow-y', `${y}px`);
                    card.style.background = `radial-gradient(250px circle at var(--glow-x) var(--glow-y), rgba(15,82,56,0.06), transparent 80%)`;
                });
                card.addEventListener('mouseleave', () => {
                    card.style.background = '';
                });
            });

        });
    </script>
    @stack('scripts')
</body>
</html>