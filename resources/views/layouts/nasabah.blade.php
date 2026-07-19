<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta-description', 'Dashboard Nasabah ARUNA — Kelola tabungan sampah Anda dengan mudah.')">
    <title>@yield('title', 'Dashboard') — ARUNA Nasabah</title>
    
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
            --color-secondary: #7a5649;
            --color-secondary-container: #fdcdbc;
            --color-on-secondary-container: #795548;
            --color-error: #ba1a1a;
            --color-error-container: #ffdad6;
            --color-on-error-container: #93000a;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #707973; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: #0f5238; }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #707973; border-radius: 10px; }

        /* ===== BACKGROUND PATTERN ===== */
        .dashboard-bg {
            background-color: #f8f9fa;
            background-image: radial-gradient(#0f52380f 1px, transparent 1px);
            background-size: 32px 32px;
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
    </style>
    @stack('styles')
</head>
<body class="font-jakarta dashboard-bg text-on-surface min-h-screen flex flex-col md:flex-row" x-data="{ sidebarOpen: false }">

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
            <div class="flex items-center gap-3">
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
        });
    </script>
    @stack('scripts')
</body>
</html>
