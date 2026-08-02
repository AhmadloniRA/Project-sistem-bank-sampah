@extends('layouts.nasabah')
@section('title', 'Dashboard')
@section('meta-description', 'Dashboard pribadi nasabah ARUNA — pantau saldo dan transaksi tabungan sampah Anda.')
@section('page-title', 'Dashboard Overview')

@section('content')

{{-- Floating Particles Background --}}
<canvas id="particles-canvas"></canvas>

{{-- Bento Layout Grid --}}
<div class="grid grid-cols-12 gap-6 relative z-10">

    {{-- 1. Balance Card (col-span-12 lg:col-span-8) --}}
    <div data-reveal="flip" data-reveal-delay="50"
         class="col-span-12 lg:col-span-8 bg-gradient-to-br from-primary to-[#14422e] p-8 rounded-[2rem] text-on-primary flex flex-col justify-between relative overflow-hidden card-shadow min-h-[300px] tilt-card">
        <div class="absolute -top-12 -right-12 w-48 h-48 bg-white/5 rounded-full blur-2xl float-bubble pointer-events-none" data-parallax="0.15"></div>
        <div class="absolute bottom-4 left-1/3 w-32 h-32 bg-white/5 rounded-full blur-xl float-bubble-delay pointer-events-none" data-parallax="0.25"></div>
        <div class="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
            <span class="material-symbols-outlined text-[160px] spin-slow">account_balance_wallet</span>
        </div>
        
        <div class="z-10 relative flex-1 flex flex-col justify-between">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <p class="text-white/70 text-xs font-semibold uppercase tracking-wider mb-1">Total Saldo Tabungan Anda</p>
                    <h3 class="text-4xl sm:text-5xl font-extrabold tracking-tight font-mono data-glow">
                        Rp <span data-count="{{ $user->total_tabungan }}" data-count-prefix="" data-count-suffix="" data-count-duration="2000">{{ number_format($user->total_tabungan, 0, ',', '.') }}</span>
                    </h3>
                    <p class="text-[11px] text-white/50 font-semibold font-mono tracking-wider mt-1">{{ $user->no_id }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-xl px-4 py-2 text-right border border-white/10 hidden sm:block" data-reveal="scale" data-reveal-delay="400">
                    <span class="text-[9px] font-bold text-white/70 uppercase tracking-wider block">No. KK Anggota</span>
                    <span class="text-xs font-mono font-bold block mt-0.5">{{ $user->kk_number ?? '-' }}</span>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-6 border-t border-white/10 pt-6">
                <div class="flex items-center gap-4" data-reveal="left" data-reveal-delay="300">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm shadow-xs border border-white/5 magnetic-hover">
                        <span class="material-symbols-outlined text-on-primary">recycling</span>
                    </div>
                    <div>
                        <p class="text-white/60 text-[9px] uppercase font-bold tracking-widest">Sampah Disetor</p>
                        <p class="text-lg font-bold font-mono"><span data-count="{{ $totalTimbangan }}" data-count-decimals="1" data-count-duration="1800">{{ number_format($totalTimbangan, 1, ',', '.') }}</span> <span class="text-xs font-normal opacity-85">kg</span></p>
                    </div>
                </div>
                <div class="flex items-center gap-4" data-reveal="right" data-reveal-delay="400">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm shadow-xs border border-white/5 magnetic-hover">
                        <span class="material-symbols-outlined text-on-primary">stars</span>
                    </div>
                    <div>
                        <p class="text-white/60 text-[9px] uppercase font-bold tracking-widest">Eco Points</p>
                        <p class="text-lg font-bold font-mono"><span data-count="{{ $totalTimbangan * 100 }}" data-count-duration="2200">{{ number_format($totalTimbangan * 100, 0, ',', '.') }}</span> <span class="text-xs font-normal opacity-85">pts</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 z-10 mt-8" data-reveal data-reveal-delay="500">
            <button onclick="Swal.fire({
                title: 'Tarik Saldo',
                text: 'Penarikan dana tabungan sampah dapat dilakukan dengan mengunjungi loket Bank Sampah ARUNA terdekat dengan membawa kartu anggota Anda.',
                icon: 'info',
                confirmButtonColor: '#0f5238'
            })" class="bg-surface-container-lowest text-primary hover:bg-surface transition-all px-6 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 cursor-pointer card-shadow ripple-container">
                <span class="material-symbols-outlined text-[18px]">payments</span>
                Tarik Saldo
            </button>
            <a href="{{ route('user.profil') }}" class="bg-white/10 hover:bg-white/20 text-on-primary border border-white/20 px-6 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 ripple-container">
                <span class="material-symbols-outlined text-[18px]">person</span>
                Info Akun
            </a>
        </div>
    </div>

    {{-- 2. Eco Impact Card (col-span-12 lg:col-span-4) --}}
    <div data-reveal="scale" data-reveal-delay="200"
         class="col-span-12 lg:col-span-4 bg-surface-container-lowest p-8 rounded-[2rem] border border-outline-variant/30 flex flex-col justify-between card-shadow tilt-card" data-glow>
        <div>
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-md font-bold text-on-surface">Dampak Lingkungan</h4>
                <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-xl text-[20px] magnetic-hover">compost</span>
            </div>
            
            <div class="space-y-4">
                {{-- Carbon Saved --}}
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/10 group hover:border-primary/30 transition-colors duration-300 ripple-container" data-reveal data-reveal-delay="350">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-primary/10 text-primary rounded-xl magnetic-hover">
                            <span class="material-symbols-outlined text-[18px]">cloud</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Karbon Dihemat</p>
                            <p class="text-lg font-bold text-on-surface font-mono">
                                <span data-count="{{ $totalTimbangan * 3.0 }}" data-count-decimals="1" data-count-duration="1600" data-count-suffix=" ">{{ number_format($totalTimbangan * 3.0, 1, ',', '.') }}</span><span class="text-xs font-medium opacity-60">kg CO2e</span>
                            </p>
                        </div>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden progress-animated">
                        <div class="h-full bg-primary rounded-full progress-fill" data-width="{{ min(($totalTimbangan * 3.0 / 150) * 100, 100) }}%"></div>
                    </div>
                </div>

                {{-- Trees Equivalent --}}
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/10 group hover:border-secondary/30 transition-colors duration-300 ripple-container" data-reveal data-reveal-delay="450">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-secondary/10 text-secondary rounded-xl magnetic-hover">
                            <span class="material-symbols-outlined text-[18px]">forest</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Setara Penyerapan</p>
                            <p class="text-lg font-bold text-on-surface font-mono">
                                <span data-count="{{ ($totalTimbangan * 3.0) / 22.0 }}" data-count-decimals="1" data-count-duration="1800" data-count-suffix=" ">{{ number_format(($totalTimbangan * 3.0) / 22.0, 1, ',', '.') }}</span><span class="text-xs font-medium opacity-60">Pohon / Thn</span>
                            </p>
                        </div>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden progress-animated">
                        <div class="h-full bg-secondary rounded-full progress-fill" data-width="{{ min((($totalTimbangan * 3.0 / 22) / 10) * 100, 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 pt-5 border-t border-outline-variant/20" data-reveal data-reveal-delay="550">
            <div class="flex justify-between items-end mb-2">
                <p class="text-xs font-bold text-on-surface">Target Penyetoran Anggota</p>
                <p class="text-xs font-bold text-primary"><span data-count="{{ min(round(($totalTimbangan / 50) * 100), 100) }}" data-count-suffix="%" data-count-duration="1200">{{ min(round(($totalTimbangan / 50) * 100), 100) }}%</span></p>
            </div>
            <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden progress-animated">
                <div class="h-full bg-gradient-to-r from-primary to-[#2a7a58] rounded-full shadow-xs progress-fill" data-width="{{ min(($totalTimbangan / 50) * 100, 100) }}%"></div>
            </div>
            <p class="text-[10px] text-on-surface-variant/60 mt-2 font-medium">Target berikutnya: Capai setoran 50 kg sampah</p>
        </div>
    </div>

    {{-- 3. Mock Activity Chart (col-span-12 lg:col-span-7) --}}
    <div data-reveal data-reveal-delay="300"
         class="col-span-12 lg:col-span-7 bg-surface-container-lowest p-8 rounded-[2rem] border border-outline-variant/30 card-shadow h-[400px] flex flex-col" data-glow>
        <div class="flex justify-between items-center mb-6">
            <div>
                <h4 class="text-md font-bold text-on-surface" data-typewriter="Grafik Aktivitas Setoran" data-typewriter-speed="45">Grafik Aktivitas Setoran</h4>
                <p class="text-xs text-on-surface-variant/60">Statistik kebiasaan hijau Anda setiap minggu</p>
            </div>
            <div class="flex gap-2">
                <span class="bg-primary/10 text-primary px-3 py-1.5 rounded-lg text-[10px] font-bold animate-bounce-in" style="animation-delay: 0.5s;">5 Minggu Terakhir</span>
            </div>
        </div>
        
        {{-- Refined Bar Chart --}}
        <div class="flex-1 flex items-end justify-between gap-4 px-4 pb-4" data-stagger="100">
            <div class="flex-1 flex flex-col items-center gap-3">
                <div class="w-full bg-primary/10 rounded-xl hover:bg-primary/20 transition-all cursor-pointer relative group h-[30%] animate-scale-y ripple-container" style="animation-delay: 0.35s; animation-fill-mode: forwards;">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">2.4kg</div>
                </div>
                <span class="text-[10px] font-bold text-on-surface-variant/60">Minggu 1</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-3">
                <div class="w-full bg-primary/10 rounded-xl hover:bg-primary/20 transition-all cursor-pointer relative group h-[45%] animate-scale-y ripple-container" style="animation-delay: 0.4s; animation-fill-mode: forwards;">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">3.8kg</div>
                </div>
                <span class="text-[10px] font-bold text-on-surface-variant/60">Minggu 2</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-3">
                <div class="w-full bg-primary/10 rounded-xl hover:bg-primary/20 transition-all cursor-pointer relative group h-[15%] animate-scale-y ripple-container" style="animation-delay: 0.45s; animation-fill-mode: forwards;">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">1.0kg</div>
                </div>
                <span class="text-[10px] font-bold text-on-surface-variant/60">Minggu 3</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-3">
                <div class="w-full bg-primary/10 rounded-xl hover:bg-primary/20 transition-all cursor-pointer relative group h-[60%] animate-scale-y ripple-container" style="animation-delay: 0.5s; animation-fill-mode: forwards;">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">5.2kg</div>
                </div>
                <span class="text-[10px] font-bold text-on-surface-variant/60">Minggu 4</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-3">
                <div class="w-full bg-primary rounded-xl shadow-lg shadow-primary/20 relative group h-[80%] animate-scale-y pulse-glow ripple-container" style="animation-delay: 0.55s; animation-fill-mode: forwards;">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">6.8kg</div>
                </div>
                <span class="text-[10px] font-bold text-primary">Sekarang</span>
            </div>
        </div>
    </div>

    {{-- 4. Recent Transactions Live Feed (col-span-12 lg:col-span-5) --}}
    <div data-reveal="right" data-reveal-delay="350"
         class="col-span-12 lg:col-span-5 bg-surface-container-lowest p-8 rounded-[2rem] border border-outline-variant/30 card-shadow flex flex-col h-[400px]" data-glow>
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-md font-bold text-on-surface">Aktivitas Terakhir</h4>
            <a class="text-primary text-xs font-bold hover:underline underline-offset-4" href="{{ route('user.riwayat') }}">Riwayat</a>
        </div>
        
        <div class="flex-1 overflow-y-auto custom-scrollbar pr-1 space-y-3" data-stagger="80">
            @forelse($transactions->take(5) as $tx)
                <div class="flex items-center justify-between p-3.5 bg-surface-container-low/40 border border-outline-variant/5 rounded-2xl hover:bg-surface-container-low/85 transition-colors cursor-pointer group ripple-container">
                    <div class="flex items-center gap-3 min-w-0 flex-1">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-transform group-hover:scale-105 duration-200 magnetic-hover
                             {{ $tx->jenis_transaksi === 'masuk' ? 'bg-primary/10 text-primary' : 'bg-secondary/10 text-secondary' }}">
                            <span class="material-symbols-outlined text-[20px]">
                                {{ $tx->jenis_transaksi === 'masuk' ? 'eco' : 'payments' }}
                            </span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-on-surface truncate" title="{{ $tx->keterangan }}">{{ $tx->keterangan }}</p>
                            <p class="text-[10px] text-on-surface-variant/60 font-medium font-mono mt-0.5">
                                {{ $tx->created_at->translatedFormat('d M Y - H:i') }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right shrink-0 ml-3">
                        <p class="text-xs font-bold font-mono {{ $tx->jenis_transaksi === 'masuk' ? 'text-primary' : 'text-rose-600' }}">
                            {{ $tx->jenis_transaksi === 'masuk' ? '+' : '-' }}Rp {{ number_format($tx->nominal, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center h-full text-on-surface-variant/50 gap-2 py-8">
                    <span class="material-symbols-outlined text-4xl">folder_open</span>
                    <p class="text-xs font-bold">Belum ada transaksi</p>
                </div>
            @endforelse
        </div>
    </div>    {{-- 5. Quick Actions Grid --}}
    <div class="col-span-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-2" data-stagger="120">
        
        <div onclick="Swal.fire({
            title: 'Scan QR Anggota',
            text: 'Tunjukkan kode ID nasabah Anda pada aplikasi saat menyetorkan sampah di loket ARUNA.',
            html: `<div class='flex flex-col items-center p-4 bg-white rounded-xl border border-gray-100 mt-2 shadow-xs'><span class='font-mono font-bold text-lg text-primary'>{{ $user->no_id }}</span></div>`,
            icon: 'info',
            confirmButtonColor: '#0f5238'
        })" class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 hover:border-primary/40 hover:-translate-y-1 transition-all cursor-pointer card-shadow group ripple-container tilt-card" data-glow>
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors duration-300 magnetic-hover">
                <span class="material-symbols-outlined text-[24px]">qr_code_2</span>
            </div>
            <h5 class="text-xs font-bold text-on-surface mb-1">Scan ID Nasabah</h5>
            <p class="text-[11px] text-on-surface-variant/60">Tunjukkan QR code ke petugas loket</p>
        </div>

        <div onclick="Swal.fire({
            title: 'Layanan Jemput Sampah',
            text: 'Fitur jemput sampah oleh kurir ARUNA akan segera tersedia! Anda dapat mengajukan pengambilan sampah dari rumah Anda.',
            icon: 'info',
            confirmButtonColor: '#0f5238'
        })" class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 hover:border-teal-500/40 hover:-translate-y-1 transition-all cursor-pointer card-shadow group ripple-container tilt-card" data-glow>
            <div class="w-12 h-12 bg-teal-500/10 text-teal-700 dark:text-teal-400 rounded-xl flex items-center justify-center mb-4 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300 magnetic-hover">
                <span class="material-symbols-outlined text-[24px]">local_shipping</span>
            </div>
            <h5 class="text-xs font-bold text-on-surface mb-1">Jemput Sampah</h5>
            <p class="text-[11px] text-on-surface-variant/60">Ajukan penjemputan sampah ke rumah</p>
        </div>

        <div onclick="Swal.fire({
            title: 'Lokasi Bank Sampah',
            text: 'ARUNA saat ini berpusat di Desa Sukaluyu, Telukjambe Timur, Karawang. Anda dapat menyetorkan sampah langsung di kantor pusat kami.',
            icon: 'info',
            confirmButtonColor: '#0f5238'
        })" class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 hover:border-primary/40 hover:-translate-y-1 transition-all cursor-pointer card-shadow group ripple-container tilt-card" data-glow>
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors duration-300 magnetic-hover">
                <span class="material-symbols-outlined text-[24px]">location_on</span>
            </div>
            <h5 class="text-xs font-bold text-on-surface mb-1">Lokasi Setoran</h5>
            <p class="text-[11px] text-on-surface-variant/60">Lihat lokasi loket terdekat</p>
        </div>

        <div onclick="Swal.fire({
            title: 'Eco Rewards',
            text: 'Eco Points Anda dapat ditukarkan dengan berbagai merchandise menarik, produk daur ulang, atau pulsa belanja setelah terkumpul minimal 5.000 pts.',
            icon: 'info',
            confirmButtonColor: '#0f5238'
        })" class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 hover:border-orange-500/40 hover:-translate-y-1 transition-all cursor-pointer card-shadow group ripple-container tilt-card" data-glow>
            <div class="w-12 h-12 bg-orange-500/10 text-orange-700 dark:text-orange-400 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 magnetic-hover">
                <span class="material-symbols-outlined text-[24px]">redeem</span>
            </div>
            <h5 class="text-xs font-bold text-on-surface mb-1">Penukaran Hadiah</h5>
        </div>

    </div>

    {{-- 6. SOP & Alur Setor Sampah Banner & Modal Trigger --}}
    <div x-data="{ openSopModal: false }" class="col-span-12 mt-6">
        
        {{-- Ringkasan Banner SOP di Dashboard --}}
        <div data-reveal="scale" data-reveal-delay="200"
             class="p-6 sm:p-8 bg-gradient-to-r from-primary/10 via-surface-container-lowest to-surface-container-low border border-primary/20 rounded-[2.5rem] card-shadow flex flex-col md:flex-row items-center gap-6 justify-between relative overflow-hidden" data-glow>
            
            <div class="flex items-center gap-5 z-10 min-w-0">
                <div class="w-14 h-14 rounded-2xl bg-primary text-on-primary flex items-center justify-center shrink-0 shadow-lg shadow-primary/20 magnetic-hover">
                    <span class="material-symbols-outlined text-[30px]">assignment</span>
                </div>
                <div class="min-w-0">
                    <div class="inline-flex items-center gap-1.5 bg-primary/15 text-primary px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider mb-1">
                        <span class="material-symbols-outlined text-[13px] font-bold">menu_book</span>
                        Panduan Operasional Nasabah
                    </div>
                    <h4 class="text-lg sm:text-xl font-black text-on-surface tracking-tight truncate">
                        SOP & Alur Setor Sampah ARUNA
                    </h4>
                    <p class="text-xs text-on-surface-variant/80 mt-0.5 leading-relaxed">
                        Pelajari 6 langkah mudah menyetor sampah, jadwal operasional, serta tata tertib nasabah.
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 z-10 w-full md:w-auto shrink-0">
                <button @click="openSopModal = true"
                        class="w-full sm:w-auto bg-primary text-on-primary px-6 py-3 rounded-2xl text-xs font-bold hover:shadow-xl hover:shadow-primary/25 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 cursor-pointer ripple-container">
                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                    Lihat SOP &amp; Tata Tertib
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </button>
            </div>
        </div>

        {{-- FULLSCREEN RESPONSIVE MODAL SOP & ALUR SETOR SAMPAH (Alpine.js Teleport to Body) --}}
        <template x-teleport="body">
            <div x-show="openSopModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @keydown.escape.window="openSopModal = false"
                 class="fixed inset-0 z-[99999] overflow-hidden bg-black/85 backdrop-blur-md flex items-center justify-center p-0"
                 style="display: none;">
                
                {{-- Modal Box Container (BENAR-BENAR 100% FULLSCREEN MENUTUPI SELURUH LAYAR & SIDEBAR) --}}
                <div x-show="openSopModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95 translateY(20px)"
                     x-transition:enter-end="opacity-100 scale-100 translateY(0)"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100 translateY(0)"
                     x-transition:leave-end="opacity-0 scale-95 translateY(20px)"
                     class="bg-surface-container-lowest text-on-surface w-screen h-screen min-h-screen max-w-none rounded-none border-0 flex flex-col shadow-2xl overflow-hidden relative">
                    
                    {{-- Modal Header --}}
                    <div class="p-4 sm:p-6 md:px-10 border-b border-outline-variant/20 flex items-center justify-between gap-4 bg-surface-container-low/80 shrink-0 sticky top-0 z-20 shadow-xs">
                        <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-primary text-on-primary flex items-center justify-center shrink-0 shadow-md shadow-primary/20">
                                <span class="material-symbols-outlined text-[22px] sm:text-[26px]">assignment</span>
                            </div>
                            <div class="min-w-0">
                                <span class="text-[9px] sm:text-[10px] font-bold text-primary bg-primary/10 px-2.5 py-0.5 rounded-md uppercase tracking-wider">Panduan Resmi Nasabah</span>
                                <h3 class="text-base sm:text-xl md:text-2xl font-black tracking-tight text-on-surface truncate mt-0.5">SOP & Alur Setor Sampah ARUNA</h3>
                                <p class="text-[10px] sm:text-xs text-on-surface-variant/70 truncate hidden sm:block">Standar Operasional Prosedur & Tata Tertib Keanggotaan Bank Sampah</p>
                            </div>
                        </div>

                        <button @click="openSopModal = false" 
                                class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-surface-container hover:bg-rose-500 hover:text-white text-on-surface-variant transition-all flex items-center justify-center cursor-pointer shrink-0 active:scale-90 shadow-xs"
                                title="Tutup Modal (ESC)">
                            <span class="material-symbols-outlined text-[22px] sm:text-[24px]">close</span>
                        </button>
                    </div>

                {{-- Modal Body (Scrollable & Fully Responsive dengan Kontras Warna Tajam) --}}
                <div class="p-4 sm:p-6 md:p-10 overflow-y-auto space-y-8 custom-scrollbar flex-1 bg-surface">
                    
                    {{-- Quick Operational Schedule Banner --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-5 rounded-3xl bg-gradient-to-r from-emerald-800 to-emerald-950 text-white shadow-lg border border-emerald-500/30 relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-white/5 rounded-full blur-xl pointer-events-none"></div>
                        <div class="flex items-center gap-3.5 z-10">
                            <div class="w-11 h-11 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[24px]">schedule</span>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest block text-emerald-300">Jadwal &amp; Jam Operasional Setor</span>
                                <p class="text-sm sm:text-base font-extrabold font-mono text-white mt-0.5">Setiap Hari Sabtu | 08.00 – 11.00 WIB</p>
                            </div>
                        </div>
                        <span class="text-xs font-black bg-emerald-500 text-emerald-950 px-4 py-2 rounded-2xl uppercase tracking-wider self-end sm:self-center shrink-0 shadow-md">
                            1 Minggu Sekali
                        </span>
                    </div>

                    {{-- 9 Steps Section --}}
                    <div class="space-y-5">
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm sm:text-base font-black !text-slate-900 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-xl bg-primary text-on-primary text-xs font-black flex items-center justify-center shadow-xs">9</span>
                                📌 9 Tahapan SOP Bank Sampah
                            </h4>
                            <span class="text-[11px] font-bold !text-slate-600">SOP Bank Sampah ARUNA</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                            
                            {{-- Step 1 --}}
                            <div class="p-5 rounded-3xl bg-white border-2 border-emerald-500/40 hover:border-emerald-500 transition-all card-shadow flex flex-col justify-between group hover:-translate-y-1">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="w-9 h-9 rounded-2xl bg-emerald-600 text-white font-black text-sm flex items-center justify-center shadow-md">01</span>
                                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[24px]">person_add</span>
                                        </div>
                                    </div>
                                    <h5 class="text-base sm:text-lg font-black !text-slate-900 mb-2">Pendaftaran Nasabah</h5>
                                    <p class="text-xs sm:text-sm !text-slate-700 font-medium leading-relaxed mb-4">Masyarakat mengisi formulir pendaftaran, menyerahkan identitas, kemudian data diverifikasi dan dicatat. Pengurus memberikan nomor anggota dan buku tabungan.</p>
                                </div>
                                <div class="p-3.5 bg-slate-900 text-white rounded-2xl text-xs space-y-1.5 mt-auto">
                                    <div class="flex items-center justify-between font-bold">
                                        <span class="text-slate-300">Pelaksana:</span>
                                        <span class="bg-emerald-600 text-white px-2.5 py-0.5 rounded-md text-[10px] font-bold">Admin/Pengurus</span>
                                    </div>
                                    <p class="text-white font-semibold text-[11px] leading-snug">
                                        Output: Nasabah terdaftar &amp; memiliki buku tabungan.
                                    </p>
                                </div>
                            </div>

                            {{-- Step 2 --}}
                            <div class="p-5 rounded-3xl bg-white border-2 border-purple-500/40 hover:border-purple-500 transition-all card-shadow flex flex-col justify-between group hover:-translate-y-1">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="w-9 h-9 rounded-2xl bg-purple-600 text-white font-black text-sm flex items-center justify-center shadow-md">02</span>
                                        <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[24px]">recycling</span>
                                        </div>
                                    </div>
                                    <h5 class="text-base sm:text-lg font-black !text-slate-900 mb-2">Pemilahan Sampah</h5>
                                    <p class="text-xs sm:text-sm !text-slate-700 font-medium leading-relaxed mb-4">Nasabah memilah sampah berdasarkan jenis (plastik, kertas, logam, kaca, dll.) serta memastikan sampah dalam keadaan bersih dan kering.</p>
                                </div>
                                <div class="p-3.5 bg-slate-900 text-white rounded-2xl text-xs space-y-1.5 mt-auto">
                                    <div class="flex items-center justify-between font-bold">
                                        <span class="text-slate-300">Pelaksana:</span>
                                        <span class="bg-purple-600 text-white px-2.5 py-0.5 rounded-md text-[10px] font-bold">Nasabah</span>
                                    </div>
                                    <p class="text-white font-semibold text-[11px] leading-snug">
                                        Output: Sampah telah dipilah sesuai kategori.
                                    </p>
                                </div>
                            </div>

                            {{-- Step 3 --}}
                            <div class="p-5 rounded-3xl bg-white border-2 border-teal-500/40 hover:border-teal-500 transition-all card-shadow flex flex-col justify-between group hover:-translate-y-1">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="w-9 h-9 rounded-2xl bg-teal-600 text-white font-black text-sm flex items-center justify-center shadow-md">03</span>
                                        <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[24px]">storefront</span>
                                        </div>
                                    </div>
                                    <h5 class="text-base sm:text-lg font-black !text-slate-900 mb-2">Penyetoran Sampah</h5>
                                    <p class="text-xs sm:text-sm !text-slate-700 font-medium leading-relaxed mb-4">Nasabah membawa sampah sesuai jadwal operasional. Petugas memeriksa kebersihan dan kesesuaian jenis sampah sebelum diterima.</p>
                                </div>
                                <div class="p-3.5 bg-slate-900 text-white rounded-2xl text-xs space-y-1.5 mt-auto">
                                    <div class="flex items-center justify-between font-bold">
                                        <span class="text-slate-300">Pelaksana:</span>
                                        <span class="bg-teal-600 text-white px-2.5 py-0.5 rounded-md text-[10px] font-bold">Nasabah &amp; Petugas</span>
                                    </div>
                                    <p class="text-white font-semibold text-[11px] leading-snug">
                                        Output: Sampah diterima oleh Bank Sampah.
                                    </p>
                                </div>
                            </div>

                            {{-- Step 4 --}}
                            <div class="p-5 rounded-3xl bg-white border-2 border-blue-500/40 hover:border-blue-500 transition-all card-shadow flex flex-col justify-between group hover:-translate-y-1">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="w-9 h-9 rounded-2xl bg-blue-600 text-white font-black text-sm flex items-center justify-center shadow-md">04</span>
                                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[24px]">scale</span>
                                        </div>
                                    </div>
                                    <h5 class="text-base sm:text-lg font-black !text-slate-900 mb-2">Penimbangan Sampah</h5>
                                    <p class="text-xs sm:text-sm !text-slate-700 font-medium leading-relaxed mb-4">Sampah ditimbang berdasarkan masing-masing jenis menggunakan timbangan yang telah dikalibrasi, kemudian hasil berat dicatat.</p>
                                </div>
                                <div class="p-3.5 bg-slate-900 text-white rounded-2xl text-xs space-y-1.5 mt-auto">
                                    <div class="flex items-center justify-between font-bold">
                                        <span class="text-slate-300">Pelaksana:</span>
                                        <span class="bg-blue-600 text-white px-2.5 py-0.5 rounded-md text-[10px] font-bold">Petugas Timbang</span>
                                    </div>
                                    <p class="text-white font-semibold text-[11px] leading-snug">
                                        Output: Data berat sampah tercatat.
                                    </p>
                                </div>
                            </div>

                            {{-- Step 5 --}}
                            <div class="p-5 rounded-3xl bg-white border-2 border-amber-500/40 hover:border-amber-500 transition-all card-shadow flex flex-col justify-between group hover:-translate-y-1">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="w-9 h-9 rounded-2xl bg-amber-600 text-white font-black text-sm flex items-center justify-center shadow-md">05</span>
                                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[24px]">request_quote</span>
                                        </div>
                                    </div>
                                    <h5 class="text-base sm:text-lg font-black !text-slate-900 mb-2">Penentuan Nilai Ekonomi</h5>
                                    <p class="text-xs sm:text-sm !text-slate-700 font-medium leading-relaxed mb-4">Berat sampah dikalikan dengan harga beli per kilogram sesuai daftar harga yang berlaku untuk memperoleh nilai setoran.</p>
                                </div>
                                <div class="p-3.5 bg-slate-900 text-white rounded-2xl text-xs space-y-1.5 mt-auto">
                                    <div class="flex items-center justify-between font-bold">
                                        <span class="text-slate-300">Pelaksana:</span>
                                        <span class="bg-amber-600 text-white px-2.5 py-0.5 rounded-md text-[10px] font-bold">Admin</span>
                                    </div>
                                    <p class="text-white font-semibold text-[11px] leading-snug">
                                        Output: Nilai ekonomi sampah diketahui.
                                    </p>
                                </div>
                            </div>

                            {{-- Step 6 --}}
                            <div class="p-5 rounded-3xl bg-white border-2 border-indigo-500/40 hover:border-indigo-500 transition-all card-shadow flex flex-col justify-between group hover:-translate-y-1">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="w-9 h-9 rounded-2xl bg-indigo-600 text-white font-black text-sm flex items-center justify-center shadow-md">06</span>
                                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[24px]">menu_book</span>
                                        </div>
                                    </div>
                                    <h5 class="text-base sm:text-lg font-black !text-slate-900 mb-2">Pencatatan Tabungan</h5>
                                    <p class="text-xs sm:text-sm !text-slate-700 font-medium leading-relaxed mb-4">Nilai setoran dicatat ke dalam buku tabungan atau sistem administrasi Bank Sampah, kemudian saldo nasabah diperbarui.</p>
                                </div>
                                <div class="p-3.5 bg-slate-900 text-white rounded-2xl text-xs space-y-1.5 mt-auto">
                                    <div class="flex items-center justify-between font-bold">
                                        <span class="text-slate-300">Pelaksana:</span>
                                        <span class="bg-indigo-600 text-white px-2.5 py-0.5 rounded-md text-[10px] font-bold">Admin</span>
                                    </div>
                                    <p class="text-white font-semibold text-[11px] leading-snug">
                                        Output: Saldo tabungan nasabah bertambah.
                                    </p>
                                </div>
                            </div>

                            {{-- Step 7 --}}
                            <div class="p-5 rounded-3xl bg-white border-2 border-cyan-500/40 hover:border-cyan-500 transition-all card-shadow flex flex-col justify-between group hover:-translate-y-1">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="w-9 h-9 rounded-2xl bg-cyan-600 text-white font-black text-sm flex items-center justify-center shadow-md">07</span>
                                        <div class="w-9 h-9 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[24px]">inventory_2</span>
                                        </div>
                                    </div>
                                    <h5 class="text-base sm:text-lg font-black !text-slate-900 mb-2">Penyimpanan Sampah</h5>
                                    <p class="text-xs sm:text-sm !text-slate-700 font-medium leading-relaxed mb-4">Sampah dipisahkan kembali sesuai kategori dan disimpan di tempat penyimpanan sementara hingga jumlahnya mencukupi untuk dijual.</p>
                                </div>
                                <div class="p-3.5 bg-slate-900 text-white rounded-2xl text-xs space-y-1.5 mt-auto">
                                    <div class="flex items-center justify-between font-bold">
                                        <span class="text-slate-300">Pelaksana:</span>
                                        <span class="bg-cyan-600 text-white px-2.5 py-0.5 rounded-md text-[10px] font-bold">Petugas Gudang</span>
                                    </div>
                                    <p class="text-white font-semibold text-[11px] leading-snug">
                                        Output: Sampah tersimpan rapi dan aman.
                                    </p>
                                </div>
                            </div>

                            {{-- Step 8 --}}
                            <div class="p-5 rounded-3xl bg-white border-2 border-rose-500/40 hover:border-rose-500 transition-all card-shadow flex flex-col justify-between group hover:-translate-y-1">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="w-9 h-9 rounded-2xl bg-rose-600 text-white font-black text-sm flex items-center justify-center shadow-md">08</span>
                                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[24px]">handshake</span>
                                        </div>
                                    </div>
                                    <h5 class="text-base sm:text-lg font-black !text-slate-900 mb-2">Penjualan ke Pengepul</h5>
                                    <p class="text-xs sm:text-sm !text-slate-700 font-medium leading-relaxed mb-4">Sampah dijual kepada pengepul atau mitra daur ulang. Hasil penjualan dicatat sebagai pemasukan kas Bank Sampah.</p>
                                </div>
                                <div class="p-3.5 bg-slate-900 text-white rounded-2xl text-xs space-y-1.5 mt-auto">
                                    <div class="flex items-center justify-between font-bold">
                                        <span class="text-slate-300">Pelaksana:</span>
                                        <span class="bg-rose-600 text-white px-2.5 py-0.5 rounded-md text-[10px] font-bold">Ketua/Pengelola</span>
                                    </div>
                                    <p class="text-white font-semibold text-[11px] leading-snug">
                                        Output: Kas Bank Sampah bertambah.
                                    </p>
                                </div>
                            </div>

                            {{-- Step 9 --}}
                            <div class="p-5 rounded-3xl bg-white border-2 border-violet-500/40 hover:border-violet-500 transition-all card-shadow flex flex-col justify-between group hover:-translate-y-1">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="w-9 h-9 rounded-2xl bg-violet-600 text-white font-black text-sm flex items-center justify-center shadow-md">09</span>
                                        <div class="w-9 h-9 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[24px]">fact_check</span>
                                        </div>
                                    </div>
                                    <h5 class="text-base sm:text-lg font-black !text-slate-900 mb-2">Monitoring dan Evaluasi</h5>
                                    <p class="text-xs sm:text-sm !text-slate-700 font-medium leading-relaxed mb-4">Melakukan evaluasi terhadap pencatatan administrasi, jumlah sampah, saldo tabungan, kondisi keuangan, serta menyusun rencana perbaikan pelayanan.</p>
                                </div>
                                <div class="p-3.5 bg-slate-900 text-white rounded-2xl text-xs space-y-1.5 mt-auto">
                                    <div class="flex items-center justify-between font-bold">
                                        <span class="text-slate-300">Pelaksana:</span>
                                        <span class="bg-violet-600 text-white px-2.5 py-0.5 rounded-md text-[10px] font-bold">Ketua &amp; Pengurus</span>
                                    </div>
                                    <p class="text-white font-semibold text-[11px] leading-snug">
                                        Output: Laporan evaluasi &amp; rekomendasi perbaikan.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Hal-Hal yang Dilarang (Larangan - Merah Koral Kontras) --}}
                    <div class="p-6 rounded-3xl bg-rose-500/10 border-2 border-rose-500/40 text-on-surface space-y-4">
                        <div class="flex items-center gap-2.5 text-rose-700 dark:text-rose-400 font-extrabold text-sm sm:text-base uppercase tracking-wider">
                            <span class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center text-base shrink-0 shadow-xs">⚠️</span>
                            Hal-Hal yang Dilarang (Tata Tertib Wajib Nasabah)
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm">
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-surface-container-lowest border border-rose-500/20 shadow-xs">
                                <span class="text-rose-600 font-black text-xl leading-none shrink-0 mt-0.5">🚫</span>
                                <span class="text-on-surface-variant font-semibold leading-relaxed text-xs sm:text-sm">Dilarang mencampur jenis sampah (<strong class="text-rose-700 dark:text-rose-300 font-bold">Wajib dipilah dari rumah</strong> sebelum disetor).</span>
                            </div>
                            
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-surface-container-lowest border border-rose-500/20 shadow-xs">
                                <span class="text-rose-600 font-black text-xl leading-none shrink-0 mt-0.5">🚫</span>
                                <span class="text-on-surface-variant font-semibold leading-relaxed text-xs sm:text-sm">Dilarang menyetor sampah yang masih <strong class="text-rose-700 dark:text-rose-300 font-bold">basah atau kotor</strong>.</span>
                            </div>
                            
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-surface-container-lowest border border-rose-500/20 shadow-xs">
                                <span class="text-rose-600 font-black text-xl leading-none shrink-0 mt-0.5">🚫</span>
                                <span class="text-on-surface-variant font-semibold leading-relaxed text-xs sm:text-sm">Dilarang menyetor <strong class="text-rose-700 dark:text-rose-300 font-bold">di luar jadwal operasional</strong> (Sabtu, 08.00-11.00 WIB).</span>
                            </div>
                            
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-surface-container-lowest border border-rose-500/20 shadow-xs">
                                <span class="text-rose-600 font-black text-xl leading-none shrink-0 mt-0.5">🚫</span>
                                <span class="text-on-surface-variant font-semibold leading-relaxed text-xs sm:text-sm">Dilarang <strong class="text-rose-700 dark:text-rose-300 font-bold">membuang sampah sembarangan</strong> di area lokasi Bank Sampah.</span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Modal Footer --}}
                <div class="p-4 sm:p-6 border-t border-outline-variant/20 bg-surface-container-low/60 flex justify-end shrink-0">
                    <button @click="openSopModal = false"
                            class="w-full sm:w-auto bg-primary text-on-primary px-8 py-3 rounded-2xl text-xs font-bold hover:shadow-xl hover:shadow-primary/25 transition-all cursor-pointer active:scale-95 text-center">
                        Saya Mengerti &amp; Tutup
                    </button>
                </div>

            </div>
        </div>
        </template>

    </div>

</div>

@endsection