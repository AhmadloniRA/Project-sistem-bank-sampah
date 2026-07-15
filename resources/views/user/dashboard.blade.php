<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Nasabah — Bank Sampah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-jakarta: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="font-jakarta text-neutral-800 bg-neutral-50 min-h-screen flex flex-col justify-between selection:bg-emerald-500/20">

    <!-- Header / Navbar -->
    <header class="bg-white border-b border-neutral-100 py-4 px-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <img src="https://img.icons8.com/?size=100&id=ngxhKjJtc4LX&format=png&color=ffffff" alt="Recycle Logo" class="w-6 h-6">
                </div>
                <span class="font-extrabold text-lg text-neutral-800">Bank Sampah</span>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <div class="font-bold text-sm text-neutral-900">{{ Auth::user()->name ?? 'Nasabah' }}</div>
                    <div class="text-xs text-emerald-600 font-semibold font-mono">{{ Auth::user()->no_id ?? '' }}</div>
                    <div class="text-[11px] text-neutral-400">{{ Auth::user()->email ?? '' }}</div>
                </div>

                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="py-2 px-4 bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs rounded-lg transition-all duration-300 flex items-center gap-1.5 border border-red-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-6 py-12 flex-1 flex flex-col items-center justify-center text-center">
        <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-4xl mb-6 shadow-sm border border-emerald-100">
            📊
        </div>
        <h1 class="text-3xl font-extrabold text-neutral-900 mb-3 tracking-tight">Dashboard Nasabah</h1>
        <p class="text-neutral-500 max-w-md mx-auto text-base mb-8">
            Selamat datang, <strong class="text-neutral-800">{{ Auth::user()->name }}</strong>! Akun Anda telah berhasil dibuat/masuk. Halaman dashboard ini sedang dalam pengembangan.
        </p>

        <!-- Stats Mockup -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full max-w-2xl mb-8">
            <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-sm">
                <div class="text-xs text-neutral-400 font-semibold mb-1 uppercase tracking-wider">Total Sampah</div>
                <div class="text-2xl font-extrabold text-emerald-600">0 kg</div>
            </div>
            <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-sm">
                <div class="text-xs text-neutral-400 font-semibold mb-1 uppercase tracking-wider">Saldo Tabungan</div>
                <div class="text-2xl font-extrabold text-emerald-600">Rp 0</div>
            </div>
            <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-sm">
                <div class="text-xs text-neutral-400 font-semibold mb-1 uppercase tracking-wider">Status Akun</div>
                <div class="text-2xl font-extrabold text-emerald-600 text-[16px] flex items-center justify-center gap-1.5 mt-1">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full inline-block animate-pulse"></span>
                    Aktif
                </div>
            </div>
        </div>

        <a href="/" class="text-sm font-bold text-emerald-600 hover:text-emerald-700 transition-colors flex items-center gap-1.5">
            ← Kembali ke Beranda
        </a>
    </main>

    <!-- Footer -->
    <footer class="py-6 border-t border-neutral-100 bg-white text-center text-xs text-neutral-400">
        &copy; {{ date('Y') }} Bank Sampah. Seluruh hak cipta dilindungi.
    </footer>

</body>
</html>
