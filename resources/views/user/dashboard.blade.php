@extends('layouts.nasabah')
@section('title', 'Dashboard')
@section('meta-description', 'Dashboard pribadi nasabah ARUNA — pantau saldo dan transaksi tabungan sampah Anda.')
@section('page-title', 'Dashboard Overview')

@section('content')

{{-- Bento Layout Grid --}}
<div class="grid grid-cols-12 gap-6">

    {{-- 1. Balance Card (col-span-12 lg:col-span-8) --}}
    <div style="animation-delay: 0.05s; animation-fill-mode: forwards;"
         class="col-span-12 lg:col-span-8 bg-gradient-to-br from-primary to-[#14422e] p-8 rounded-[2rem] text-on-primary flex flex-col justify-between relative overflow-hidden card-shadow min-h-[300px] hover-elevate animate-fade-in-up opacity-0">
        <div class="absolute -top-12 -right-12 w-48 h-48 bg-white/5 rounded-full blur-2xl float-bubble pointer-events-none"></div>
        <div class="absolute bottom-4 left-1/3 w-32 h-32 bg-white/5 rounded-full blur-xl float-bubble-delay pointer-events-none"></div>
        <div class="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
            <span class="material-symbols-outlined text-[160px]">account_balance_wallet</span>
        </div>
        
        <div class="z-10 relative flex-1 flex flex-col justify-between">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <p class="text-white/70 text-xs font-semibold uppercase tracking-wider mb-1">Total Saldo Tabungan Anda</p>
                    <h3 class="text-4xl sm:text-5xl font-extrabold tracking-tight font-mono">
                        Rp {{ number_format($user->total_tabungan, 0, ',', '.') }}
                    </h3>
                    <p class="text-[11px] text-white/50 font-semibold font-mono tracking-wider mt-1">{{ $user->no_id }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-xl px-4 py-2 text-right border border-white/10 hidden sm:block">
                    <span class="text-[9px] font-bold text-white/70 uppercase tracking-wider block">No. KK Anggota</span>
                    <span class="text-xs font-mono font-bold block mt-0.5">{{ $user->kk_number ?? '-' }}</span>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-6 border-t border-white/10 pt-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm shadow-xs border border-white/5">
                        <span class="material-symbols-outlined text-on-primary">recycling</span>
                    </div>
                    <div>
                        <p class="text-white/60 text-[9px] uppercase font-bold tracking-widest">Sampah Disetor</p>
                        <p class="text-lg font-bold font-mono">{{ number_format($totalTimbangan, 1, ',', '.') }} <span class="text-xs font-normal opacity-85">kg</span></p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm shadow-xs border border-white/5">
                        <span class="material-symbols-outlined text-on-primary">stars</span>
                    </div>
                    <div>
                        <p class="text-white/60 text-[9px] uppercase font-bold tracking-widest">Eco Points</p>
                        <p class="text-lg font-bold font-mono">{{ number_format($totalTimbangan * 100, 0, ',', '.') }} <span class="text-xs font-normal opacity-85">pts</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 z-10 mt-8">
            <button onclick="Swal.fire({
                title: 'Tarik Saldo',
                text: 'Penarikan dana tabungan sampah dapat dilakukan dengan mengunjungi loket Bank Sampah ARUNA terdekat dengan membawa kartu anggota Anda.',
                icon: 'info',
                confirmButtonColor: '#0f5238'
            })" class="bg-surface-container-lowest text-primary hover:bg-surface transition-all px-6 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 cursor-pointer card-shadow">
                <span class="material-symbols-outlined text-[18px]">payments</span>
                Tarik Saldo
            </button>
            <a href="{{ route('user.profil') }}" class="bg-white/10 hover:bg-white/20 text-on-primary border border-white/20 px-6 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">person</span>
                Info Akun
            </a>
        </div>
    </div>

    {{-- 2. Eco Impact Card (col-span-12 lg:col-span-4) --}}
    <div style="animation-delay: 0.15s; animation-fill-mode: forwards;"
         class="col-span-12 lg:col-span-4 bg-surface-container-lowest p-8 rounded-[2rem] border border-outline-variant/30 flex flex-col justify-between card-shadow hover-elevate animate-fade-in-up opacity-0">
        <div>
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-md font-bold text-on-surface">Dampak Lingkungan</h4>
                <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-xl text-[20px]">compost</span>
            </div>
            
            <div class="space-y-4">
                {{-- Carbon Saved --}}
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/10 group hover:border-primary/30 transition-colors duration-300">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-primary/10 text-primary rounded-xl">
                            <span class="material-symbols-outlined text-[18px]">cloud</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Karbon Dihemat</p>
                            <p class="text-lg font-bold text-on-surface font-mono">
                                {{ number_format($totalTimbangan * 3.0, 1, ',', '.') }} <span class="text-xs font-medium opacity-60">kg CO2e</span>
                            </p>
                        </div>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full" style="width: {{ min(($totalTimbangan * 3.0 / 150) * 100, 100) }}%"></div>
                    </div>
                </div>

                {{-- Trees Equivalent --}}
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/10 group hover:border-secondary/30 transition-colors duration-300">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-secondary/10 text-secondary rounded-xl">
                            <span class="material-symbols-outlined text-[18px]">forest</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Setara Penyerapan</p>
                            <p class="text-lg font-bold text-on-surface font-mono">
                                {{ number_format(($totalTimbangan * 3.0) / 22.0, 1, ',', '.') }} <span class="text-xs font-medium opacity-60">Pohon / Thn</span>
                            </p>
                        </div>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-secondary rounded-full" style="width: {{ min((($totalTimbangan * 3.0 / 22) / 10) * 100, 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 pt-5 border-t border-outline-variant/20">
            <div class="flex justify-between items-end mb-2">
                <p class="text-xs font-bold text-on-surface">Target Penyetoran Anggota</p>
                <p class="text-xs font-bold text-primary">{{ min(round(($totalTimbangan / 50) * 100), 100) }}%</p>
            </div>
            <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-primary to-[#2a7a58] rounded-full shadow-xs" style="width: {{ min(($totalTimbangan / 50) * 100, 100) }}%"></div>
            </div>
            <p class="text-[10px] text-on-surface-variant/60 mt-2 font-medium">Target berikutnya: Capai setoran 50 kg sampah</p>
        </div>
    </div>

    {{-- 3. Mock Activity Chart (col-span-12 lg:col-span-7) --}}
    <div style="animation-delay: 0.25s; animation-fill-mode: forwards;"
         class="col-span-12 lg:col-span-7 bg-surface-container-lowest p-8 rounded-[2rem] border border-outline-variant/30 card-shadow h-[400px] flex flex-col hover-elevate animate-fade-in-up opacity-0">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h4 class="text-md font-bold text-on-surface">Grafik Aktivitas Setoran</h4>
                <p class="text-xs text-on-surface-variant/60">Statistik kebiasaan hijau Anda setiap minggu</p>
            </div>
            <div class="flex gap-2">
                <span class="bg-primary/10 text-primary px-3 py-1.5 rounded-lg text-[10px] font-bold">5 Minggu Terakhir</span>
            </div>
        </div>
        
        {{-- Refined Bar Chart --}}
        <div class="flex-1 flex items-end justify-between gap-4 px-4 pb-4">
            <div class="flex-1 flex flex-col items-center gap-3">
                <div style="animation-delay: 0.35s; animation-fill-mode: forwards;"
                     class="w-full bg-primary/10 rounded-xl hover:bg-primary/20 transition-all cursor-pointer relative group h-[30%] animate-scale-y">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">2.4kg</div>
                </div>
                <span class="text-[10px] font-bold text-on-surface-variant/60">Minggu 1</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-3">
                <div style="animation-delay: 0.4s; animation-fill-mode: forwards;"
                     class="w-full bg-primary/10 rounded-xl hover:bg-primary/20 transition-all cursor-pointer relative group h-[45%] animate-scale-y">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">3.8kg</div>
                </div>
                <span class="text-[10px] font-bold text-on-surface-variant/60">Minggu 2</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-3">
                <div style="animation-delay: 0.45s; animation-fill-mode: forwards;"
                     class="w-full bg-primary/10 rounded-xl hover:bg-primary/20 transition-all cursor-pointer relative group h-[15%] animate-scale-y">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">1.0kg</div>
                </div>
                <span class="text-[10px] font-bold text-on-surface-variant/60">Minggu 3</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-3">
                <div style="animation-delay: 0.5s; animation-fill-mode: forwards;"
                     class="w-full bg-primary/10 rounded-xl hover:bg-primary/20 transition-all cursor-pointer relative group h-[60%] animate-scale-y">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">5.2kg</div>
                </div>
                <span class="text-[10px] font-bold text-on-surface-variant/60">Minggu 4</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-3">
                <div style="animation-delay: 0.55s; animation-fill-mode: forwards;"
                     class="w-full bg-primary rounded-xl shadow-lg shadow-primary/20 relative group h-[80%] animate-scale-y">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-on-surface text-surface text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-all pointer-events-none">6.8kg</div>
                </div>
                <span class="text-[10px] font-bold text-primary">Sekarang</span>
            </div>
        </div>
    </div>

    {{-- 4. Recent Transactions Live Feed (col-span-12 lg:col-span-5) --}}
    <div style="animation-delay: 0.3s; animation-fill-mode: forwards;"
         class="col-span-12 lg:col-span-5 bg-surface-container-lowest p-8 rounded-[2rem] border border-outline-variant/30 card-shadow flex flex-col h-[400px] hover-elevate animate-fade-in-up opacity-0">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-md font-bold text-on-surface">Aktivitas Terakhir</h4>
            <a class="text-primary text-xs font-bold hover:underline underline-offset-4" href="{{ route('user.riwayat') }}">Riwayat</a>
        </div>
        
        <div class="flex-1 overflow-y-auto custom-scrollbar pr-1 space-y-3">
            @forelse($transactions->take(5) as $tx)
                <div class="flex items-center justify-between p-3.5 bg-surface-container-low/40 border border-outline-variant/5 rounded-2xl hover:bg-surface-container-low/85 transition-colors cursor-pointer group">
                    <div class="flex items-center gap-3 min-w-0 flex-1">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-transform group-hover:scale-105 duration-200
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
    </div>

    {{-- 5. Quick Actions Grid --}}
    <div class="col-span-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-2">
        
        <div style="animation-delay: 0.4s; animation-fill-mode: forwards;"
             onclick="Swal.fire({
            title: 'Scan QR Anggota',
            text: 'Tunjukkan kode ID nasabah Anda pada aplikasi saat menyetorkan sampah di loket ARUNA.',
            html: `<div class='flex flex-col items-center p-4 bg-white rounded-xl border border-gray-100 mt-2 shadow-xs'><span class='font-mono font-bold text-lg text-primary'>{{ $user->no_id }}</span></div>`,
            icon: 'info',
            confirmButtonColor: '#0f5238'
        })" class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 hover:border-primary/40 hover:-translate-y-1 transition-all cursor-pointer card-shadow group animate-fade-in-up opacity-0">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors duration-300">
                <span class="material-symbols-outlined text-[24px]">qr_code_2</span>
            </div>
            <h5 class="text-xs font-bold text-on-surface mb-1">Scan ID Nasabah</h5>
            <p class="text-[11px] text-on-surface-variant/60">Tunjukkan QR code ke petugas loket</p>
        </div>

        <div style="animation-delay: 0.45s; animation-fill-mode: forwards;"
             onclick="Swal.fire({
            title: 'Layanan Jemput Sampah',
            text: 'Fitur jemput sampah oleh kurir ARUNA akan segera tersedia! Anda dapat mengajukan pengambilan sampah dari rumah Anda.',
            icon: 'info',
            confirmButtonColor: '#0f5238'
        })" class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 hover:border-secondary/40 hover:-translate-y-1 transition-all cursor-pointer card-shadow group animate-fade-in-up opacity-0">
            <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-4 group-hover:bg-secondary group-hover:text-on-secondary transition-colors duration-300">
                <span class="material-symbols-outlined text-[24px]">local_shipping</span>
            </div>
            <h5 class="text-xs font-bold text-on-surface mb-1">Jemput Sampah</h5>
            <p class="text-[11px] text-on-surface-variant/60">Ajukan penjemputan sampah ke rumah</p>
        </div>

        <div style="animation-delay: 0.5s; animation-fill-mode: forwards;"
             onclick="Swal.fire({
            title: 'Lokasi Bank Sampah',
            text: 'ARUNA saat ini berpusat di Desa Sukaluyu, Telukjambe Timur, Karawang. Anda dapat menyetorkan sampah langsung di kantor pusat kami.',
            icon: 'info',
            confirmButtonColor: '#0f5238'
        })" class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 hover:border-primary/40 hover:-translate-y-1 transition-all cursor-pointer card-shadow group animate-fade-in-up opacity-0">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors duration-300">
                <span class="material-symbols-outlined text-[24px]">location_on</span>
            </div>
            <h5 class="text-xs font-bold text-on-surface mb-1">Lokasi Setoran</h5>
            <p class="text-[11px] text-on-surface-variant/60">Lihat lokasi loket terdekat</p>
        </div>

        <div style="animation-delay: 0.55s; animation-fill-mode: forwards;"
             onclick="Swal.fire({
            title: 'Eco Rewards',
            text: 'Eco Points Anda dapat ditukarkan dengan berbagai merchandise menarik, produk daur ulang, atau pulsa belanja setelah terkumpul minimal 5.000 pts.',
            icon: 'info',
            confirmButtonColor: '#0f5238'
        })" class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 hover:border-secondary/40 hover:-translate-y-1 transition-all cursor-pointer card-shadow group animate-fade-in-up opacity-0">
            <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-4 group-hover:bg-secondary group-hover:text-on-secondary transition-colors duration-300">
                <span class="material-symbols-outlined text-[24px]">redeem</span>
            </div>
            <h5 class="text-xs font-bold text-on-surface mb-1">Penukaran Hadiah</h5>
            <p class="text-[11px] text-on-surface-variant/60">Tukarkan points dengan souvenir eco</p>
        </div>

    </div>

    {{-- 6. Educational Banner --}}
    <div style="animation-delay: 0.6s; animation-fill-mode: forwards;"
         class="col-span-12 mt-6 p-8 bg-gradient-to-r from-primary/10 to-[#14422e]/5 border border-primary/10 rounded-[2.5rem] flex flex-col md:flex-row items-center gap-8 card-shadow hover-elevate animate-fade-in-up opacity-0">
        <div class="w-full md:w-1/3 shrink-0">
            <div class="relative overflow-hidden rounded-3xl shadow-md group">
                <img alt="Recycling bins in nature" class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500" 
                     src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&q=80&w=600"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
            </div>
        </div>
        <div class="flex-1">
            <div class="inline-flex items-center gap-1.5 bg-primary/15 text-primary px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider mb-3">
                <span class="material-symbols-outlined text-[13px] font-bold">lightbulb</span>
                Tahukah Anda?
            </div>
            <h5 class="text-lg sm:text-xl font-bold text-on-surface mb-2 tracking-tight">Satu Kaleng, Energi 3 Jam TV!</h5>
            <p class="text-xs sm:text-sm text-on-surface-variant/80 leading-relaxed mb-4">
                Mendaur ulang hanya satu kaleng aluminium dapat menghemat energi yang cukup untuk menyalakan televisi selama tiga jam. Setiap gram sampah daur ulang yang Anda setorkan di ARUNA hari ini sangat berkontribusi bagi kebersihan lingkungan masa depan kita.
            </p>
            <button onclick="Swal.fire({
                title: 'Tips Memilah Sampah',
                text: 'Pisahkan sampah plastik, kertas, logam, dan botol kaca sebelum disetorkan ke ARUNA. Membersihkan atau membilas plastik bekas kemasan akan mempermudah verifikasi dan meningkatkan nilai grading setoran Anda!',
                icon: 'success',
                confirmButtonColor: '#0f5238'
            })" class="bg-primary text-on-primary px-6 py-3 rounded-2xl text-xs font-bold hover:shadow-lg hover:shadow-primary/20 hover:scale-[1.01] transition-all flex items-center gap-2 cursor-pointer">
                Pelajari Tips Pemilahan
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </button>
        </div>
    </div>

</div>

@endsection
