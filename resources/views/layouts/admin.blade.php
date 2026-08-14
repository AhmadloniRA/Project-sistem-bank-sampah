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
            --color-error-container: #ffdad6;
            --color-on-error-container: #93000a;
        }

        html.dark {
            --color-background: #0b1320;
            --color-surface: #0b1320;
            --color-surface-container-lowest: #131e30;
            --color-surface-container-low: #18263c;
            --color-surface-container: #1e2f4a;
            --color-surface-container-high: #273b5c;
            --color-surface-container-highest: #30476e;
            --color-on-surface: #f1f5f9;
            --color-on-surface-variant: #94a3b8;
            --color-outline: #64748b;
            --color-outline-variant: #1e293b;
            --color-primary: #10b981;
            --color-primary-container: #065f46;
            --color-on-primary-container: #a7f3d0;
            --color-secondary: #38bdf8;
            --color-secondary-container: #0369a1;
            --color-on-secondary-container: #bae6fd;
            --color-tertiary: #a3e635;
            --color-tertiary-container: #3f6212;
            --color-on-tertiary-container: #d9f99d;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #004532; border-radius: 999px; }
        html.dark ::-webkit-scrollbar-thumb { background: #059669; }
        ::-webkit-scrollbar-thumb:hover { background: #065f46; }

        /* ===== ANIMATIONS ===== */
        @keyframes pageSlideIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .page-slide-in { animation: pageSlideIn 0.35s cubic-bezier(0.22, 1, 0.36, 1); }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 500, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    @stack('styles')
</head>
<body class="font-jakarta bg-surface text-on-surface antialiased overflow-x-hidden transition-colors duration-300">

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
            <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-[1440px] w-full page-slide-in">
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
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
