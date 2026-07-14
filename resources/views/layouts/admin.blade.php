<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — Bank Sampah</title>
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

        /* Nav link hover effect */
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
<body class="font-jakarta bg-[#f0f4f3] text-gray-800 antialiased">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false, now: new Date() }" x-init="setInterval(() => now = new Date(), 60000)">

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
            class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm lg:hidden"
            @click="sidebarOpen = false"
            style="display:none;"
        ></div>

        {{-- ============================================================ --}}
        {{-- SIDEBAR --}}
        {{-- ============================================================ --}}
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-[272px] flex flex-col transition-transform duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] lg:translate-x-0 lg:static lg:z-auto overflow-hidden"
            style="background: linear-gradient(175deg, #0c1f17 0%, #0a1a12 35%, #071510 65%, #0d1f18 100%);"
        >
            {{-- Decorative floating orbs --}}
            <div class="absolute -top-12 -right-12 w-40 h-40 rounded-full bg-emerald-500/[0.07] blur-2xl float-bubble pointer-events-none"></div>
            <div class="absolute top-1/3 -left-8 w-28 h-28 rounded-full bg-teal-400/[0.05] blur-2xl float-bubble-delay pointer-events-none"></div>
            <div class="absolute bottom-20 right-0 w-24 h-24 rounded-full bg-cyan-400/[0.04] blur-2xl float-bubble-delay2 pointer-events-none"></div>

            {{-- Shimmer overlay --}}
            <div class="absolute inset-0 shimmer-bg pointer-events-none"></div>

            {{-- Brand Header --}}
            <div class="relative px-6 pt-7 pb-6">
                <div class="flex items-center gap-3.5">
                    <div class="relative">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-400 via-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5.5 h-5.5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                        {{-- Glow ring --}}
                        <div class="absolute -inset-1 rounded-2xl bg-emerald-400/20 blur-sm sidebar-glow -z-10"></div>
                    </div>
                    <div>
                        <div class="text-white font-extrabold text-[16px] leading-tight tracking-tight">Bank Sampah</div>
                        <div class="text-emerald-400/60 text-[10.5px] font-semibold tracking-[0.2em] uppercase mt-0.5">Admin Panel</div>
                    </div>
                    {{-- Mobile close --}}
                    <button @click="sidebarOpen = false" class="ml-auto lg:hidden w-8 h-8 rounded-lg flex items-center justify-center text-white/30 hover:text-white hover:bg-white/5 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Divider --}}
            <div class="mx-5 h-px bg-gradient-to-r from-transparent via-white/[0.07] to-transparent"></div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto sidebar-scroll px-4 py-5 space-y-1 relative">
                <div class="text-[9.5px] font-bold text-white/20 uppercase tracking-[0.2em] px-3 mb-3">Navigasi</div>

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link group flex items-center gap-3 px-3 py-3 rounded-xl text-[13px] font-semibold transition-all duration-300
                          {{ request()->routeIs('admin.dashboard') ? 'active bg-gradient-to-r from-emerald-500/[0.15] to-teal-500/[0.08] text-emerald-300 shadow-lg shadow-emerald-900/20' : 'text-white/45 hover:bg-white/[0.04] hover:text-white/80' }}">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300
                                {{ request()->routeIs('admin.dashboard')
                                    ? 'bg-gradient-to-br from-emerald-500/25 to-teal-500/20 text-emerald-300 shadow-inner shadow-emerald-500/10'
                                    : 'bg-white/[0.04] text-white/30 group-hover:bg-white/[0.07] group-hover:text-white/60 group-hover:scale-105' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[19px] h-[19px]" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </span>
                    <span>Dashboard</span>
                    @if(request()->routeIs('admin.dashboard'))
                        <span class="ml-auto w-2 h-2 rounded-full bg-emerald-400 breathe"></span>
                    @endif
                </a>

                {{-- Data Nasabah --}}
                <a href="{{ route('admin.nasabah') }}"
                   class="nav-link group flex items-center gap-3 px-3 py-3 rounded-xl text-[13px] font-semibold transition-all duration-300
                          {{ request()->routeIs('admin.nasabah') ? 'active bg-gradient-to-r from-emerald-500/[0.15] to-teal-500/[0.08] text-emerald-300 shadow-lg shadow-emerald-900/20' : 'text-white/45 hover:bg-white/[0.04] hover:text-white/80' }}">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300
                                {{ request()->routeIs('admin.nasabah')
                                    ? 'bg-gradient-to-br from-emerald-500/25 to-teal-500/20 text-emerald-300 shadow-inner shadow-emerald-500/10'
                                    : 'bg-white/[0.04] text-white/30 group-hover:bg-white/[0.07] group-hover:text-white/60 group-hover:scale-105' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[19px] h-[19px]" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </span>
                    <span>Data Nasabah</span>
                    @if(request()->routeIs('admin.nasabah'))
                        <span class="ml-auto w-2 h-2 rounded-full bg-emerald-400 breathe"></span>
                    @endif
                </a>

                {{-- Data Keuangan --}}
                <a href="{{ route('admin.keuangan') }}"
                   class="nav-link group flex items-center gap-3 px-3 py-3 rounded-xl text-[13px] font-semibold transition-all duration-300
                          {{ request()->routeIs('admin.keuangan') ? 'active bg-gradient-to-r from-emerald-500/[0.15] to-teal-500/[0.08] text-emerald-300 shadow-lg shadow-emerald-900/20' : 'text-white/45 hover:bg-white/[0.04] hover:text-white/80' }}">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300
                                {{ request()->routeIs('admin.keuangan')
                                    ? 'bg-gradient-to-br from-emerald-500/25 to-teal-500/20 text-emerald-300 shadow-inner shadow-emerald-500/10'
                                    : 'bg-white/[0.04] text-white/30 group-hover:bg-white/[0.07] group-hover:text-white/60 group-hover:scale-105' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[19px] h-[19px]" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </span>
                    <span>Data Keuangan</span>
                    @if(request()->routeIs('admin.keuangan'))
                        <span class="ml-auto w-2 h-2 rounded-full bg-emerald-400 breathe"></span>
                    @endif
                </a>
            </nav>

            {{-- Divider --}}
            <div class="mx-5 h-px bg-gradient-to-r from-transparent via-white/[0.07] to-transparent"></div>

            {{-- Sidebar Footer — Admin info & logout --}}
            <div class="relative px-4 py-5">
                <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-3.5">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 via-emerald-500 to-teal-600 flex items-center justify-center text-white text-[13px] font-bold shadow-lg shadow-emerald-500/20 shrink-0">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->email ?? 'A', 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-white text-[13px] font-semibold truncate">Administrator</div>
                            <div class="text-white/25 text-[11px] truncate">{{ Auth::guard('admin')->user()->email ?? '' }}</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-[12px] font-semibold text-red-300/70 bg-red-500/[0.08] border border-red-500/[0.1] hover:bg-red-500/[0.15] hover:text-red-300 hover:border-red-500/20 transition-all duration-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Keluar dari Sistem
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- ============================================================ --}}
        {{-- MAIN CONTENT AREA --}}
        {{-- ============================================================ --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Top Header --}}
            <header class="sticky top-0 z-30 border-b border-gray-200/60"
                    style="background: rgba(240, 244, 243, 0.75); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);">
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
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-emerald-600 transition-colors">
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
                        {{-- Date/time pill --}}
                        <div class="hidden md:flex items-center gap-2 text-[11.5px] text-gray-500 font-medium bg-white px-3.5 py-2 rounded-xl border border-gray-200/80 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            {{ now()->translatedFormat('l, d M Y') }}
                        </div>

                        {{-- Live status --}}
                        <div class="flex items-center gap-1.5 text-[11.5px] font-semibold bg-emerald-50 text-emerald-700 px-3.5 py-2 rounded-xl border border-emerald-200/60 shadow-sm">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            Aktif
                        </div>

                        {{-- Admin avatar --}}
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white text-[13px] font-bold shadow-md shadow-emerald-500/20 cursor-default" title="{{ Auth::guard('admin')->user()->email ?? 'Admin' }}">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->email ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8 page-slide-in">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="border-t border-gray-200/60 bg-white/50 px-6 py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-gray-400">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.403 12.652a3 3 0 0 0 0-5.304 3 3 0 0 0-3.75-3.751 3 3 0 0 0-5.305 0 3 3 0 0 0-3.751 3.75 3 3 0 0 0 0 5.305 3 3 0 0 0 3.75 3.751 3 3 0 0 0 5.305 0 3 3 0 0 0 3.751-3.75Zm-2.546-4.46a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>
                        &copy; {{ date('Y') }} Bank Sampah. Seluruh hak cipta dilindungi.
                    </span>
                    <span class="text-gray-300">v1.0.0</span>
                </div>
            </footer>
        </div>
    </div>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
