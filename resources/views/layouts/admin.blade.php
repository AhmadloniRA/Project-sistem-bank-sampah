<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — ARUNA</title>
    
    {{-- Script Anti-Flicker untuk Dark Mode --}}
    <script>
        if (localStorage.getItem('admin_theme') === 'dark' || (!('admin_theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    {{-- Tailwind CSS & AlpineJS --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style type="text/tailwindcss">
        @theme {
            --font-jakarta: 'Plus Jakarta Sans', sans-serif;
            --color-primary: #004532;
            --color-primary-container: #065f46;
            --color-on-primary-container: #8bd6b7;
            --color-secondary: #006591;
            --color-secondary-container: #39b8fd;
            --color-on-secondary-container: #004666;
            --color-tertiary: #284400;
            --color-tertiary-container: #395d00;
            --color-on-tertiary-container: #92dc2b;
            --color-background: #f8f9ff;
            --color-surface: #f8f9ff;
            --color-surface-container-lowest: #ffffff;
            --color-surface-container-low: #eff4ff;
            --color-surface-container: #e5eeff;
            --color-surface-container-high: #dce9ff;
            --color-surface-container-highest: #d3e4fe;
            --color-on-surface: #0b1c30;
            --color-on-surface-variant: #3f4944;
            --color-outline: #6f7973;
            --color-outline-variant: #bec9c2;
            --color-error: #ba1a1a;
            --color-on-error: #ffffff;
            --color-error-container: #ffdad6;
            --color-on-error-container: #93000a;
        }

        html.dark {
            --color-background: #121214;
            --color-surface: #121214;
            --color-surface-container-lowest: #18181b;
            --color-surface-container-low: #1f1f23;
            --color-surface-container: #27272a;
            --color-surface-container-high: #323238;
            --color-surface-container-highest: #3f3f46;
            --color-on-surface: #f4f4f5;
            --color-on-surface-variant: #a1a1aa;
            --color-outline: #71717a;
            --color-outline-variant: #27272a;
            --color-primary: #10b981;
            --color-primary-container: #065f46;
            --color-on-primary-container: #a7f3d0;
            --color-secondary: #38bdf8;
            --color-secondary-container: #0369a1;
            --color-on-secondary-container: #bae6fd;
            --color-tertiary: #a3e635;
            --color-tertiary-container: #3f6212;
            --color-on-tertiary-container: #d9f99d;
            --color-error: #f87171;
            --color-on-error: #ffffff;
            --color-error-container: #450a0a;
            --color-on-error-container: #fecaca;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #004532; border-radius: 999px; }
        html.dark ::-webkit-scrollbar-thumb { background: #3f3f46; }
        ::-webkit-scrollbar-thumb:hover { background: #065f46; }
        html.dark ::-webkit-scrollbar-thumb:hover { background: #52525b; }

        /* ===== BACKGROUND TEXTURE ===== */
        .admin-bg {
            background-color: #f8f9ff;
            background-image: radial-gradient(rgba(0, 69, 50, 0.04) 1px, transparent 1px);
            background-size: 32px 32px;
        }
        html.dark .admin-bg {
            background-color: #121214;
            background-image: radial-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px);
        }

        /* ===== SHADOWS ===== */
        .card-shadow {
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes pageSlideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: none; }
        }
        .page-slide-in { 
            animation: pageSlideIn 0.35s cubic-bezier(0.22, 1, 0.36, 1); 
        }

        @keyframes floatBubble {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(1.5deg); }
        }
        .float-bubble { animation: floatBubble 6s ease-in-out infinite; }
        .float-bubble-delay { animation: floatBubble 7s ease-in-out infinite 1.5s; }

        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.3); }
            50% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
        }
        .pulse-glow { animation: pulseGlow 2.5s ease-in-out infinite; }

        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .spin-slow { animation: spinSlow 20s linear infinite; }

        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }
        .animate-bounce-in {
            animation: bounceIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        /* Smooth Elevation */
        .hover-elevate {
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease, border-color 0.25s ease;
        }
        .hover-elevate:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.06);
        }

        /* Scroll Reveal */
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
            background: rgba(16, 185, 129, 0.2);
            transform: scale(0);
            animation: rippleExpand 0.6s ease-out forwards;
            pointer-events: none;
        }
        @keyframes rippleExpand {
            to { transform: scale(4); opacity: 0; }
        }

        /* 3D Tilt card perspective */
        .tilt-card {
            transition: transform 0.15s ease-out;
            will-change: transform;
        }

        /* Magnetic hover for icons */
        .magnetic-hover {
            transition: transform 0.2s ease-out;
        }

        /* Typewriter cursor blink */
        @keyframes cursorBlink {
            0%, 100% { border-color: rgba(16, 185, 129, 0.8); }
            50% { border-color: transparent; }
        }
        .typewriter-cursor {
            border-right: 2px solid rgba(16, 185, 129, 0.8);
            animation: cursorBlink 1s step-end infinite;
            padding-right: 2px;
        }

        /* Glow pulse on data values */
        @keyframes dataGlow {
            0%, 100% { text-shadow: 0 0 0 transparent; }
            50% { text-shadow: 0 0 12px rgba(16, 185, 129, 0.25); }
        }
        .data-glow {
            animation: dataGlow 3s ease-in-out infinite;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 500, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    @stack('styles')
</head>
<body class="font-jakarta admin-bg text-on-surface antialiased overflow-x-hidden transition-colors duration-300">

    <div class="flex min-h-screen" 
         x-data="{ 
             sidebarOpen: false,
             darkMode: localStorage.getItem('admin_theme') === 'dark' || (!('admin_theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
         }"
         x-init="$watch('darkMode', val => {
             if (val) {
                 document.documentElement.classList.add('dark');
                 localStorage.setItem('admin_theme', 'dark');
             } else {
                 document.documentElement.classList.remove('dark');
                 localStorage.setItem('admin_theme', 'light');
             }
         })">

        {{-- ============================================================ --}}
        {{-- MOBILE SIDEBAR DRAWER OVERLAY --}}
        {{-- ============================================================ --}}
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-black/40 backdrop-blur-xs lg:hidden"
             @click="sidebarOpen = false"
             style="display:none;">
        </div>

        {{-- ============================================================ --}}
        {{-- SIDEBAR NAVIGATION --}}
        {{-- ============================================================ --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 h-[100dvh] max-h-screen overflow-y-auto custom-scrollbar bg-surface-container-lowest border-r border-outline-variant/65 flex flex-col justify-between p-5 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:fixed lg:inset-y-0 lg:left-0">

            
            {{-- Brand Header --}}
            <div class="mb-8 px-2 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-extrabold text-primary tracking-tight">ARUNA</h1>
                    <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-widest mt-0.5">Bank Sampah Digital</p>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant/40 hover:text-on-surface hover:bg-surface-container transition-all">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            {{-- Nav Links --}}
            <nav class="flex-1 space-y-1 overflow-y-auto pr-1">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-xs font-semibold
                          {{ request()->routeIs('admin.dashboard') 
                              ? 'active bg-primary-container text-on-primary-container font-bold shadow-xs' 
                              : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                    <span>Dashboard</span>
                </a>

                {{-- Nasabah --}}
                <a href="{{ route('admin.nasabah') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-xs font-semibold
                          {{ request()->routeIs('admin.nasabah') || request()->routeIs('admin.nasabah.history')
                              ? 'active bg-primary-container text-on-primary-container font-bold shadow-xs' 
                              : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-[20px]">group</span>
                    <span>Nasabah</span>
                </a>

                {{-- Setor --}}
                <a href="{{ route('admin.setoran') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-xs font-semibold
                          {{ request()->routeIs('admin.setoran') 
                              ? 'active bg-primary-container text-on-primary-container font-bold shadow-xs' 
                              : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-[20px]">recycling</span>
                    <span>Setor Sampah</span>
                </a>

                {{-- Gudang --}}
                <a href="{{ route('admin.gudang') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-xs font-semibold
                          {{ request()->routeIs('admin.gudang') 
                              ? 'active bg-primary-container text-on-primary-container font-bold shadow-xs' 
                              : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                    <span>Stok &amp; Gudang</span>
                </a>

                {{-- Tarik Tunai --}}
                <a href="{{ route('admin.penarikan') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-xs font-semibold
                          {{ request()->routeIs('admin.penarikan') 
                              ? 'active bg-primary-container text-on-primary-container font-bold shadow-xs' 
                              : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                    <span>Tarik Tunai</span>
                </a>

                {{-- Kas Kantor --}}
                <a href="{{ route('admin.cashflow') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-xs font-semibold
                          {{ request()->routeIs('admin.cashflow') 
                              ? 'active bg-primary-container text-on-primary-container font-bold shadow-xs' 
                              : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>
                    <span>Buku Kas Kantor</span>
                </a>

                {{-- Master Harga --}}
                <a href="{{ route('admin.harga') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-xs font-semibold
                          {{ request()->routeIs('admin.harga') 
                              ? 'active bg-primary-container text-on-primary-container font-bold shadow-xs' 
                              : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-[20px]">sell</span>
                    <span>Master Harga</span>
                </a>
            </nav>

            {{-- Sidebar Footer --}}
            <div class="mt-auto border-t border-outline-variant/40 pt-4 space-y-3">
                <div class="flex items-center gap-3 px-2">
                    @if(Auth::guard('admin')->user() && Auth::guard('admin')->user()->profile_photo)
                        <img src="{{ asset(Auth::guard('admin')->user()->profile_photo) }}" alt="Avatar Admin" class="w-10 h-10 rounded-full object-cover shrink-0 border border-primary/20">
                    @else
                        <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs shrink-0 border border-primary/20">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? Auth::guard('admin')->user()->email ?? 'A', 0, 2)) }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-on-surface truncate">{{ Auth::guard('admin')->user()->name ?? 'Admin Utama' }}</p>
                        <p class="text-[10px] text-on-surface-variant/70 truncate">{{ Auth::guard('admin')->user()->email ?? 'admin@aruna.com' }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-error bg-error-container/40 hover:bg-error-container hover:text-on-error-container border border-error-container/20 rounded-xl transition-colors duration-200 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- ============================================================ --}}
        {{-- MAIN CONTENT WRAPPER --}}
        {{-- ============================================================ --}}
        <div class="flex-1 flex flex-col min-w-0 lg:pl-64">
            
            {{-- Top App Bar --}}
            <header class="w-full h-20 sticky top-0 z-40 bg-surface/80 backdrop-blur-md border-b border-outline-variant/40 flex justify-between items-center px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    {{-- Mobile menu button --}}
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-on-surface-variant hover:bg-surface-container active:scale-95 transition-all">
                        <span class="material-symbols-outlined text-[24px]">menu</span>
                    </button>
                    <h2 class="text-base font-extrabold text-primary tracking-tight">@yield('page-title', 'Admin Panel')</h2>
                </div>

                {{-- Header Actions --}}
                <div class="flex items-center gap-2">
                    {{-- Dark Mode Switcher --}}
                    <button @click="darkMode = !darkMode" 
                            class="p-2 rounded-xl text-on-surface-variant hover:bg-surface-container-high transition-colors active:scale-90 duration-200 flex items-center justify-center cursor-pointer" 
                            :title="darkMode ? 'Beralih ke Mode Terang' : 'Beralih ke Mode Gelap'">
                        <span class="material-symbols-outlined text-[22px]" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
                    </button>



                    <a href="{{ route('admin.settings') }}" class="p-2 rounded-xl text-on-surface-variant hover:bg-surface-container-high transition-colors active:scale-90 duration-200 flex items-center justify-center {{ request()->routeIs('admin.settings*') ? 'bg-primary-container/30 text-primary' : '' }}" title="Pengaturan">
                        <span class="material-symbols-outlined text-[22px]">settings</span>
                    </a>
                </div>
            </header>

            {{-- Main Canvas --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-[1440px] w-full">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="border-t border-outline-variant/30 bg-surface-container-lowest/50 px-6 sm:px-8 py-4 flex flex-col sm:flex-row justify-between items-center gap-2">
                <p class="text-[11px] text-on-surface-variant/60 font-semibold">&copy; {{ date('Y') }} ARUNA Bank Sampah. Hak cipta dilindungi.</p>
                <div class="flex items-center gap-4 text-[11px] text-on-surface-variant/60 font-semibold">
                    <span>Portal Admin v2.4.0</span>
                    <a href="#" class="hover:text-secondary">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-secondary">Ketentuan Layanan</a>
                </div>
            </footer>
        </div>

    </div>

    {{-- System Success/Error Notifications via SweetAlert2 --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#004532',
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#ba1a1a',
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    html: `
                        <div class="text-left font-sans">
                            <ul class="list-disc pl-5 space-y-1 text-xs text-red-650 font-medium">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    `,
                    confirmButtonColor: '#ba1a1a',
                });
            @endif

            // Micro-interactions for button presses
            const interactiveBtns = document.querySelectorAll('button, [role="button"]');
            interactiveBtns.forEach(btn => {
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
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const delay = entry.target.dataset.revealDelay || 0;
                            setTimeout(() => {
                                entry.target.classList.add('revealed');
                            }, parseInt(delay));
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
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
                }, { threshold: 0.3 });
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
                    const rotateX = ((y - centerY) / centerY) * -5;
                    const rotateY = ((x - centerX) / centerX) * 5;
                    card.style.transform = `perspective(600px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.015, 1.015, 1.015)`;
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
                    el.style.transform = `translate(${x * 0.25}px, ${y * 0.25}px)`;
                });
                el.addEventListener('mouseleave', () => {
                    el.style.transform = 'translate(0, 0)';
                });
            });

            // ============================================================
            //  6. TYPEWRITER GREETING EFFECT
            // ============================================================
            const typewriterElements = document.querySelectorAll('[data-typewriter]');
            typewriterElements.forEach(el => {
                const text = el.dataset.typewriter;
                const speed = parseInt(el.dataset.typewriterSpeed || 50);
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
                            setTimeout(typeChar, 250);
                            twObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.3 });
                twObserver.observe(el);
            });

            // ============================================================
            //  7. STAGGERED REVEAL FOR GRID CHILDREN
            // ============================================================
            const staggerContainers = document.querySelectorAll('[data-stagger]');
            staggerContainers.forEach(container => {
                const children = container.children;
                const baseDelay = parseInt(container.dataset.stagger || 80);
                const staggerObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            Array.from(children).forEach((child, i) => {
                                child.style.opacity = '0';
                                child.style.transform = 'translateY(16px)';
                                child.style.transition = `opacity 0.45s ease ${i * baseDelay}ms, transform 0.45s cubic-bezier(0.22, 1, 0.36, 1) ${i * baseDelay}ms`;
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
            //  8. HOVER GLOW CURSOR TRACKER
            // ============================================================
            const glowCards = document.querySelectorAll('[data-glow]');
            glowCards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const isDark = document.documentElement.classList.contains('dark');
                    card.style.setProperty('--glow-x', `${x}px`);
                    card.style.setProperty('--glow-y', `${y}px`);
                    card.style.background = isDark
                        ? `radial-gradient(250px circle at var(--glow-x) var(--glow-y), rgba(255,255,255,0.035), transparent 80%)`
                        : `radial-gradient(250px circle at var(--glow-x) var(--glow-y), rgba(0,69,50,0.05), transparent 80%)`;
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
