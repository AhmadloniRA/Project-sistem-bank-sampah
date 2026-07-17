<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Nasabah — ARUNA</title>
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
    <header class="bg-white border-b border-neutral-100 py-4 px-6 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <img src="https://img.icons8.com/?size=100&id=ngxhKjJtc4LX&format=png&color=ffffff" alt="Recycle Logo" class="w-6 h-6">
                </div>
                <span class="font-extrabold text-lg text-neutral-800 tracking-tight">ARUNA</span>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <div class="font-bold text-sm text-neutral-900">{{ $user->name }}</div>
                    <div class="text-xs text-emerald-600 font-bold font-mono">{{ $user->no_id }}</div>
                </div>

                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="py-2 px-4 bg-red-50 hover:bg-red-100 text-red-650 font-bold text-xs rounded-lg transition-all duration-300 flex items-center gap-1.5 border border-red-200 cursor-pointer">
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
    <main class="max-w-4xl w-full mx-auto px-6 py-10 flex-1 space-y-8">
        
        {{-- Profile Banner --}}
        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-600 rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden shadow-sm">
            <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                <div>
                    <span class="text-emerald-200 text-xs font-semibold uppercase tracking-wider block mb-1">Buku Tabungan Digital</span>
                    <h1 class="text-2xl font-black">{{ $user->name }}</h1>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-emerald-100/80 mt-2">
                        <span class="font-bold text-white font-mono">{{ $user->no_id }}</span>
                        <span class="w-1 h-1 bg-white/30 rounded-full"></span>
                        <span class="font-mono">KK: {{ $user->kk_number }}</span>
                        @if($user->phone_number)
                            <span class="w-1 h-1 bg-white/30 rounded-full"></span>
                            <span>HP: {{ $user->phone_number }}</span>
                        @endif
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-xs rounded-xl px-5 py-3 text-right">
                    <span class="text-[9px] font-bold text-emerald-200 uppercase tracking-wider block">Saldo Berjalan</span>
                    <span class="text-xl font-black font-mono block mt-0.5">Rp {{ number_format($user->total_tabungan, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-xs">
                <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Total Sampah Disetor</div>
                <div class="text-xl font-black text-emerald-700 font-mono">{{ number_format($totalTimbangan, 1, ',', '.') }} <span class="text-xs font-bold text-gray-400">kg</span></div>
            </div>
            <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-xs">
                <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Saldo Tabungan</div>
                <div class="text-xl font-black text-emerald-700 font-mono">Rp {{ number_format($user->total_tabungan, 0, ',', '.') }}</div>
            </div>
            <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-xs">
                <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Status Anggota</div>
                <div class="text-xl font-black text-emerald-700 text-[14px] flex items-center gap-1.5 mt-1 font-semibold">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full inline-block animate-pulse"></span>
                    Aktif Terdaftar
                </div>
            </div>
        </div>

        {{-- Saving book list --}}
        <div class="bg-white rounded-2xl border border-neutral-100 shadow-xs overflow-hidden">
            <div class="px-6 py-4 border-b border-neutral-100">
                <h3 class="text-xs font-bold text-neutral-450 uppercase tracking-wider">Histori Mutasi Uang Masuk & Keluar</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-neutral-50 text-[10px] text-neutral-400 uppercase tracking-wider">
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Jenis Aliran</th>
                            <th class="px-6 py-3">Nominal</th>
                            <th class="px-6 py-3">Saldo Buku</th>
                            <th class="px-6 py-3">Keterangan Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-50 text-xs">
                        @forelse($transactions as $tx)
                            <tr class="hover:bg-neutral-55/30 transition-colors">
                                <td class="px-6 py-3.5 text-neutral-500 font-mono">{{ $tx->created_at->translatedFormat('d M Y - H:i') }} WIB</td>
                                <td class="px-6 py-3.5">
                                    @if($tx->jenis_transaksi === 'masuk')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[9px] font-bold bg-emerald-50 text-emerald-700">
                                            Masuk
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[9px] font-bold bg-rose-50 text-rose-700">
                                            Keluar
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-3.5 font-bold font-mono {{ $tx->jenis_transaksi === 'masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $tx->jenis_transaksi === 'masuk' ? '+' : '-' }} Rp {{ number_format($tx->nominal, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-3.5 font-bold text-neutral-800 font-mono">Rp {{ number_format($tx->saldo_terakhir, 0, ',', '.') }}</td>
                                <td class="px-6 py-3.5 text-neutral-500 max-w-[200px] truncate" title="{{ $tx->keterangan }}">{{ $tx->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-neutral-400">
                                    Belum ada transaksi terekam pada rekening Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center pt-4">
            <a href="/" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors inline-flex items-center gap-1.5">
                ← Kembali ke Beranda Utama
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-5 border-t border-neutral-100 bg-white text-center text-xs text-neutral-400 shadow-xs">
        &copy; {{ date('Y') }} ARUNA. Seluruh hak cipta dilindungi.
    </footer>

</body>
</html>
