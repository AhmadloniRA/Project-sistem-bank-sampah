<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta-description', 'Dashboard Nasabah ARUNA — Kelola tabungan sampah Anda dengan mudah.')">
    <title>@yield('title', 'Dashboard') — ARUNA Nasabah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-jakarta: 'Plus Jakarta Sans', sans-serif;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.18); }

        /* ===== ANIMATIONS ===== */
        @keyframes pageSlideIn {
            from { opacity: 0; transform: translateY(16px) scale(0.99); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes floatBubble {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-8px) rotate(1deg); }
            66% { transform: translateY(4px) rotate(-1deg); }
        }
        @keyframes sidebarGlow {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.7; }
        }
        @keyframes breathe {
            0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.3); }
            50% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        }
        @keyframes pulse-soft {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }
        .page-slide-in { animation: pageSlideIn 0.5s cubic-bezier(0.22, 1, 0.36, 1); }
        .shimmer-bg {
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.03) 50%, transparent 100%);
            background-size: 200% 100%;
            animation: shimmer 8s ease-in-out infinite;
        }
        .float-bubble { animation: floatBubble 6s ease-in-out infinite; }
        .float-bubble-delay { animation: floatBubble 7s ease-in-out infinite 1s; }
        .float-bubble-delay2 { animation: floatBubble 8s ease-in-out infinite 2s; }
        .sidebar-glow { animation: sidebarGlow 4s ease-in-out infinite; }
        .breathe { animation: breathe 2.5s ease-in-out infinite; }
        .pulse-soft { animation: pulse-soft 2.5s ease-in-out infinite; }

        /* Nav link active indicator */
        .nav-link {
            position: relative;
            overflow: hidden;
        }
        .nav-link::before {
            content: '';
            position: absolute;
            left: 0; top: 0;
            width: 3px; height: 100%;
            background: linear-gradient(180deg, #34d399, #06b6d4);
            border-radius: 0 4px 4px 0;
            transform: scaleY(0);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .nav-link.active::before,
        .nav-link:hover::before {
            transform: scaleY(1);
        }

        /* Glass card effect */
        .glass-card {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
    @stack('styles')
</head>
<body class="font-jakarta bg-[#f0faf4] text-gray-800 antialiased">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }" >

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
            class="fixed inset-0 bg-black/50 backdrop-blur-[2px] z-40 lg:hidden"
            style="display: none;"
        ></div>

        {{-- ============================================================ --}}
        {{-- SIDEBAR --}}
        {{-- ============================================================ --}}
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed lg:static inset-y-0 left-0 z-50 w-[260px] flex flex-col transition-transform duration-300 ease-out lg:translate-x-0"
            style="background: linear-gradient(160deg, #0a2e22 0%, #0d3b2b 50%, #0a3826 100%);"
        >
            {{-- Decorative floating bubbles --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="float-bubble absolute -top-8 -right-8 w-32 h-32 rounded-full opacity-10" style="background: radial-gradient(circle, #34d399, transparent);"></div>
                <div class="float-bubble-delay absolute top-1/3 -left-6 w-20 h-20 rounded-full opacity-5" style="background: radial-gradient(circle, #06b6d4, transparent);"></div>
                <div class="float-bubble-delay2 absolute bottom-1/4 -right-4 w-16 h-16 rounded-full opacity-5" style="background: radial-gradient(circle, #34d399, transparent);"></div>
                <div class="shimmer-bg absolute inset-0"></div>
            </div>

            {{-- Logo Area --}}
            <div class="relative z-10 px-5 py-5 border-b border-white/[0.06]">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20 breathe"
                         style="background: linear-gradient(135deg, #34d399, #059669);">
                        <img src="https://img.icons8.com/?size=100&id=ngxhKjJtc4LX&format=png&color=ffffff" alt="ARUNA Logo" class="w-5 h-5">
                    </div>
                    <div>
                        <div class="text-white font-extrabold text-[15px] tracking-tight">ARUNA</div>
                        <div class="text-emerald-400/60 text-[9.5px] font-semibold uppercase tracking-[0.08em]">Portal Nasabah</div>
                    </div>
                </div>
            </div>

            {{-- User Profile Card --}}
            <div class="relative z-10 mx-3 mt-4 px-4 py-3.5 rounded-2xl" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.07);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center text-sm font-extrabold text-white shadow-md"
                         style="background: linear-gradient(135deg, #059669, #0d9488);">
                        {{ strtoupper(substr(Auth::user()->name ?? 'N', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="text-white font-bold text-[12px] truncate">{{ Auth::user()->name ?? 'Nasabah' }}</div>
                        <div class="text-emerald-400 text-[10px] font-mono font-bold tracking-wide">{{ Auth::user()->no_id ?? '-' }}</div>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-white/[0.07] flex items-center justify-between">
                    <span class="text-[9px] text-white/50 font-semibold uppercase tracking-wider">Saldo Tabungan</span>
                    <span class="text-emerald-300 font-extrabold text-[11px] font-mono">
                        Rp {{ number_format(Auth::user()->total_tabungan ?? 0, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="relative z-10 flex-1 px-3 py-4 space-y-0.5 overflow-y-auto sidebar-scroll">

                <div class="px-3 pb-2 pt-1">
                    <span class="text-[9px] font-bold text-white/25 uppercase tracking-[0.12em]">Menu Utama</span>
                </div>

                {{-- Dashboard --}}
                <a href="{{ route('user.dashboard') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-[12.5px] font-semibold transition-all duration-200 group
                          {{ request()->routeIs('user.dashboard') ? 'active bg-white/[0.1] text-white' : 'text-white/55 hover:text-white hover:bg-white/[0.06]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-200
                                {{ request()->routeIs('user.dashboard') ? 'bg-emerald-500/25 text-emerald-300' : 'bg-white/[0.05] text-white/40 group-hover:bg-emerald-500/15 group-hover:text-emerald-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                    <span>Dashboard</span>
                    @if(request()->routeIs('user.dashboard'))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-400 pulse-soft"></div>
                    @endif
                </a>

                {{-- Riwayat Transaksi --}}
                <a href="{{ route('user.riwayat') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-[12.5px] font-semibold transition-all duration-200 group
                          {{ request()->routeIs('user.riwayat') ? 'active bg-white/[0.1] text-white' : 'text-white/55 hover:text-white hover:bg-white/[0.06]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-200
                                {{ request()->routeIs('user.riwayat') ? 'bg-emerald-500/25 text-emerald-300' : 'bg-white/[0.05] text-white/40 group-hover:bg-emerald-500/15 group-hover:text-emerald-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <span>Riwayat Transaksi</span>
                    @if(request()->routeIs('user.riwayat'))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-400 pulse-soft"></div>
                    @endif
                </a>

                {{-- Divider --}}
                <div class="px-3 pt-4 pb-2">
                    <div class="h-px bg-white/[0.06]"></div>
                </div>
                <div class="px-3 pb-2 pt-1">
                    <span class="text-[9px] font-bold text-white/25 uppercase tracking-[0.12em]">Informasi</span>
                </div>

                {{-- Profil Saya --}}
                <a href="{{ route('user.profil') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-[12.5px] font-semibold transition-all duration-200 group
                          {{ request()->routeIs('user.profil') ? 'active bg-white/[0.1] text-white' : 'text-white/55 hover:text-white hover:bg-white/[0.06]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-200
                                {{ request()->routeIs('user.profil') ? 'bg-emerald-500/25 text-emerald-300' : 'bg-white/[0.05] text-white/40 group-hover:bg-emerald-500/15 group-hover:text-emerald-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <span>Profil Saya</span>
                </a>

                {{-- Beranda Publik --}}
                <a href="{{ route('homepage') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-[12.5px] font-semibold text-white/55 hover:text-white hover:bg-white/[0.06] transition-all duration-200 group">
                    <div class="w-8 h-8 rounded-lg bg-white/[0.05] text-white/40 group-hover:bg-emerald-500/15 group-hover:text-emerald-400 flex items-center justify-center transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <span>Beranda ARUNA</span>
                </a>
            </nav>

            {{-- Logout Button --}}
            <div class="relative z-10 p-3 border-t border-white/[0.06]">
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-[12px] font-semibold text-red-300/70 bg-red-500/[0.08] border border-red-500/[0.1] hover:bg-red-500/[0.15] hover:text-red-300 hover:border-red-500/20 transition-all duration-300 group cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        Keluar dari Sistem
                    </button>
                </form>
            </div>
        </aside>

        {{-- ============================================================ --}}
        {{-- MAIN CONTENT AREA --}}
        {{-- ============================================================ --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Top Header --}}
            <header class="sticky top-0 z-30 border-b border-emerald-100/60"
                    style="background: rgba(240, 250, 244, 0.80); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);">
                <div class="flex items-center justify-between h-[68px] px-4 sm:px-6 lg:px-8">
                    {{-- Left side --}}
                    <div class="flex items-center gap-3">
                        {{-- Mobile hamburger --}}
                        <button @click="sidebarOpen = true" class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center text-gray-500 hover:bg-white hover:shadow-sm hover:text-gray-700 transition-all duration-200 border border-transparent hover:border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>

                        {{-- Breadcrumb --}}
                        <div class="hidden sm:flex items-center gap-2 text-[13px]">
                            <a href="{{ route('user.dashboard') }}" class="text-gray-400 hover:text-emerald-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                            <span class="font-semibold text-gray-700">@yield('page-title', 'Dashboard')</span>
                        </div>
                        {{-- Mobile title --}}
                        <h1 class="sm:hidden text-[15px] font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                    </div>

                    {{-- Right side --}}
                    <div class="flex items-center gap-2.5">
                        {{-- Date pill --}}
                        <div class="hidden md:flex items-center gap-2 text-[11.5px] text-gray-500 font-medium bg-white px-3.5 py-2 rounded-xl border border-gray-200/80 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            {{ now()->translatedFormat('l, d M Y') }}
                        </div>

                        {{-- Saldo pill --}}
                        <div class="hidden sm:flex items-center gap-1.5 text-[11.5px] font-bold bg-emerald-50 text-emerald-700 px-3.5 py-2 rounded-xl border border-emerald-200/60 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                            Rp {{ number_format(Auth::user()->total_tabungan ?? 0, 0, ',', '.') }}
                        </div>

                        {{-- Live status --}}
                        <div class="flex items-center gap-1.5 text-[11.5px] font-semibold bg-emerald-50 text-emerald-700 px-3.5 py-2 rounded-xl border border-emerald-200/60 shadow-sm">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            Aktif
                        </div>

                        {{-- Nasabah avatar --}}
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-[13px] font-bold shadow-md shadow-emerald-500/20 cursor-default"
                             style="background: linear-gradient(135deg, #059669, #0d9488);"
                             title="{{ Auth::user()->name ?? 'Nasabah' }}">
                            {{ strtoupper(substr(Auth::user()->name ?? 'N', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8 page-slide-in pb-24 lg:pb-8">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="hidden lg:block border-t border-emerald-100/60 bg-white/50 px-6 py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-gray-400">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.403 12.652a3 3 0 0 0 0-5.304 3 3 0 0 0-3.75-3.751 3 3 0 0 0-5.305 0 3 3 0 0 0-3.751 3.75 3 3 0 0 0 0 5.305 3 3 0 0 0 3.75 3.751 3 3 0 0 0 5.305 0 3 3 0 0 0 3.751-3.75Zm-2.546-4.46a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>
                        &copy; {{ date('Y') }} ARUNA. Seluruh hak cipta dilindungi.
                    </span>
                    <span class="text-gray-300">Portal Nasabah v1.0.0</span>
                </div>
            </footer>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MOBILE BOTTOM NAVIGATION --}}
    {{-- ============================================================ --}}
    <nav class="lg:hidden fixed bottom-0 inset-x-0 z-30 bg-white border-t border-gray-100 shadow-[0_-4px_24px_rgba(0,0,0,0.06)] px-2 py-2 flex items-center justify-around">
        <a href="{{ route('user.dashboard') }}"
           class="flex flex-col items-center gap-0.5 flex-1 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('user.dashboard') ? 'bg-emerald-50' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ request()->routeIs('user.dashboard') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-[10px] font-semibold {{ request()->routeIs('user.dashboard') ? 'text-emerald-600' : 'text-gray-400' }}">Dashboard</span>
        </a>
        <a href="{{ route('user.riwayat') }}"
           class="flex flex-col items-center gap-0.5 flex-1 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('user.riwayat') ? 'bg-emerald-50' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ request()->routeIs('user.riwayat') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span class="text-[10px] font-semibold {{ request()->routeIs('user.riwayat') ? 'text-emerald-600' : 'text-gray-400' }}">Riwayat</span>
        </a>
        <a href="{{ route('user.profil') }}"
           class="flex flex-col items-center gap-0.5 flex-1 py-1 rounded-xl transition-all duration-200 {{ request()->routeIs('user.profil') ? 'bg-emerald-50' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ request()->routeIs('user.profil') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span class="text-[10px] font-semibold {{ request()->routeIs('user.profil') ? 'text-emerald-600' : 'text-gray-400' }}">Profil</span>
        </a>
        <a href="{{ route('homepage') }}" class="flex flex-col items-center gap-0.5 flex-1 py-1 rounded-xl transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span class="text-[10px] font-semibold text-gray-400">Beranda</span>
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
                    confirmButtonColor: '#059669',
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
        });
    </script>
    @stack('scripts')
</body>
</html>
