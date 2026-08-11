@extends('layouts.nasabah')
@section('title', 'Riwayat Transaksi')
@section('meta-description', 'Riwayat lengkap transaksi tabungan sampah Anda di ARUNA.')
@section('page-title', 'Riwayat Transaksi')

@section('content')

{{-- Header Hero --}}
<div data-reveal="flip" data-reveal-delay="50" class="bg-gradient-to-r from-primary via-[#14422e] to-primary p-6 text-on-primary rounded-3xl relative overflow-hidden card-shadow mb-6 tilt-card">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 float-bubble" data-parallax="0.2"></div>
    <div class="relative z-10">
        <span class="text-white/70 text-xs font-semibold uppercase tracking-wider block mb-1">Rekam Jejak Keuangan</span>
        <h2 class="text-2xl font-black" data-typewriter="Riwayat Transaksi" data-typewriter-speed="55">Riwayat Transaksi</h2>
        <p class="text-white/60 text-xs mt-1">Semua mutasi masuk (setoran) dan keluar (penarikan) pada rekening tabungan Anda.</p>
    </div>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6" data-stagger="120">
    {{-- Saldo Berjalan --}}
    <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300 ripple-container tilt-card" data-glow>
        <div class="relative z-10 flex flex-col h-full">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center magnetic-hover">
                    <span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>
                </div>
            </div>
            <p class="text-[10px] text-on-surface-variant/50 font-bold uppercase tracking-wider">Saldo Berjalan</p>
            <h3 class="text-lg font-black text-on-surface mt-1 font-mono data-glow">Rp <span data-count="{{ $user->total_tabungan }}" data-count-duration="1800">{{ number_format($user->total_tabungan, 0, ',', '.') }}</span></h3>
        </div>
    </div>

    {{-- Total Uang Masuk --}}
    <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300 ripple-container tilt-card" data-glow>
        <div class="relative z-10 flex flex-col h-full">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center border border-emerald-100 magnetic-hover">
                    <span class="material-symbols-outlined text-[20px]">trending_up</span>
                </div>
                <span class="text-[9px] font-bold text-emerald-700 bg-emerald-100/50 px-2 py-0.5 rounded-md">Total Masuk</span>
            </div>
            <p class="text-[10px] text-on-surface-variant/50 font-bold uppercase tracking-wider">Total Hasil Setoran</p>
            <h3 class="text-lg font-black text-emerald-700 mt-1 font-mono">+ Rp <span data-count="{{ $totalMasuk }}" data-count-duration="2000">{{ number_format($totalMasuk, 0, ',', '.') }}</span></h3>
        </div>
    </div>

    {{-- Total Uang Keluar --}}
    <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300 ripple-container tilt-card" data-glow>
        <div class="relative z-10 flex flex-col h-full">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center border border-rose-100 magnetic-hover">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                </div>
                <span class="text-[9px] font-bold text-rose-700 bg-rose-100/50 px-2 py-0.5 rounded-md">Total Keluar</span>
            </div>
            <p class="text-[10px] text-on-surface-variant/50 font-bold uppercase tracking-wider">Total Penarikan</p>
            <h3 class="text-lg font-black text-rose-700 mt-1 font-mono">- Rp <span data-count="{{ $totalKeluar }}" data-count-duration="2000">{{ number_format($totalKeluar, 0, ',', '.') }}</span></h3>
        </div>
    </div>
</div>

{{-- Transaction Table Section --}}
<div data-reveal data-reveal-delay="200" class="bg-surface-container-lowest rounded-[2rem] border border-outline-variant/30 shadow-sm flex flex-col overflow-hidden">
    {{-- Table Controls --}}
    <div class="p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-surface-container-low/20 border-b border-outline-variant/30">
        <div class="relative w-full sm:w-80">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-[18px]">search</span>
            <input id="searchInput" class="w-full pl-10 pr-4 py-2.5 bg-surface-container-lowest rounded-xl border border-outline-variant/30 focus:ring-1 focus:ring-primary focus:border-primary transition-all text-xs placeholder:text-on-surface-variant/40 outline-none" placeholder="Cari keterangan transaksi..." type="text">
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <select id="typeFilter" class="flex-1 sm:flex-none bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-4 py-2.5 text-xs font-semibold focus:ring-1 focus:ring-primary cursor-pointer outline-none min-w-[130px]">
                <option value="">Semua Aliran</option>
                <option value="masuk">Uang Masuk</option>
                <option value="keluar">Uang Keluar</option>
            </select>
        </div>
    </div>

    {{-- MOBILE VIEW: Individual Distinct Cards (Per Kotak) --}}
    <div id="transactionMobileCards" class="block md:hidden space-y-3.5 p-3.5 sm:p-4 bg-surface-container-low/20">
        @forelse($transactions as $tx)
            <div class="p-4 space-y-3 bg-surface-container-lowest rounded-2xl border border-outline-variant/40 shadow-xs hover:shadow-md transition-all duration-200 tx-card" data-type="{{ $tx->jenis_transaksi }}">
                {{-- Header: Jenis Transaksi & Nominal --}}
                <div class="flex items-center justify-between gap-2 pb-2.5 border-b border-outline-variant/20">
                    <div>
                        @if($tx->jenis_transaksi === 'masuk')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-[10px] font-extrabold border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Setoran Masuk
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-rose-500/10 text-rose-700 dark:text-rose-400 text-[10px] font-extrabold border border-rose-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                Penarikan Keluar
                            </span>
                        @endif
                    </div>
                    <div class="font-extrabold font-mono text-sm {{ $tx->jenis_transaksi === 'masuk' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                        {{ $tx->jenis_transaksi === 'masuk' ? '+' : '-' }} Rp {{ number_format($tx->nominal, 0, ',', '.') }}
                    </div>
                </div>

                {{-- Waktu & Catatan --}}
                <div class="space-y-2 text-xs">
                    <div class="text-[11px] font-mono text-on-surface-variant/70 flex items-center gap-1.5 font-medium">
                        <span class="material-symbols-outlined text-[15px] text-primary/70">schedule</span>
                        <span>{{ $tx->created_at->translatedFormat('d M Y') }} • {{ $tx->created_at->format('H:i') }} WIB</span>
                    </div>
                    @if($tx->keterangan)
                        <div class="text-on-surface font-semibold text-xs leading-relaxed bg-surface-container-low/50 p-2.5 rounded-xl border border-outline-variant/15">
                            {{ $tx->keterangan }}
                        </div>
                    @endif
                </div>

                {{-- Footer: Saldo Buku --}}
                <div class="flex items-center justify-between pt-2.5 border-t border-outline-variant/20 text-[11px]">
                    <span class="text-on-surface-variant/60 font-medium">Saldo Rekening:</span>
                    <span class="font-bold text-primary font-mono bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/15 text-xs">
                        Rp {{ number_format($tx->saldo_terakhir, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-on-surface-variant/50">
                <span class="material-symbols-outlined text-4xl block mb-2">folder_open</span>
                <p class="text-xs font-bold">Belum ada transaksi terekam pada rekening Anda.</p>
            </div>
        @endforelse
    </div>

    {{-- DESKTOP VIEW: Full Table --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[10px] font-bold text-on-surface-variant/50 uppercase tracking-wider border-b border-outline-variant/20 bg-surface-container-low/10">
                    <th class="px-6 py-4">Tanggal &amp; Waktu</th>
                    <th class="px-6 py-4">Jenis Transaksi</th>
                    <th class="px-6 py-4">Nominal</th>
                    <th class="px-6 py-4">Saldo Buku</th>
                    <th class="px-6 py-4">Keterangan Catatan</th>
                </tr>
            </thead>
            <tbody id="transactionTable" class="divide-y divide-outline-variant/20 text-xs">
                @forelse($transactions as $tx)
                    <tr class="hover:bg-surface-container-low/30 transition-colors group ripple-container">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-bold text-on-surface">{{ $tx->created_at->translatedFormat('d M Y') }}</p>
                            <p class="text-[10px] text-on-surface-variant/50 mt-0.5">{{ $tx->created_at->format('H:i') }} WIB</p>
                        </td>
                        <td class="px-6 py-4" data-type="{{ $tx->jenis_transaksi }}">
                            @if($tx->jenis_transaksi === 'masuk')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-primary/10 text-primary text-[9px] font-bold border border-primary/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1 inline-block"></span>
                                    Masuk
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 text-[9px] font-bold border border-rose-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1 inline-block"></span>
                                    Keluar
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold font-mono whitespace-nowrap {{ $tx->jenis_transaksi === 'masuk' ? 'text-primary' : 'text-rose-600' }}">
                            {{ $tx->jenis_transaksi === 'masuk' ? '+' : '-' }} Rp {{ number_format($tx->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 font-bold font-mono text-on-surface whitespace-nowrap">
                            Rp {{ number_format($tx->saldo_terakhir, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant/80 max-w-[240px] truncate" title="{{ $tx->keterangan }}">
                            {{ $tx->keterangan }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center text-on-surface-variant/40 gap-2">
                                <span class="material-symbols-outlined text-4xl">folder_open</span>
                                <p class="text-xs font-bold">Belum ada transaksi terekam pada rekening Anda.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-outline-variant/20 bg-surface-container-low/15">
            {{ $transactions->links() }}
        </div>
    @endif
</div>

{{-- Tip Banner --}}
<div data-reveal="left" data-reveal-delay="300" class="mt-6 bg-primary/5 border border-primary/10 p-5 rounded-2xl flex gap-4 items-start shadow-xs">
    <div class="w-10 h-10 rounded-xl bg-primary text-on-primary flex items-center justify-center shrink-0 magnetic-hover">
        <span class="material-symbols-outlined text-[20px]">lightbulb</span>
    </div>
    <div>
        <h4 class="font-bold text-primary text-xs mb-0.5">Informasi Saldo & Penarikan</h4>
        <p class="text-[11px] text-on-surface-variant/80 leading-relaxed">
            Jumlah saldo tertera adalah dana ril yang aman disimpan. Untuk melakukan penarikan tabungan, Anda dapat langsung mengunjungi petugas admin Bank Sampah ARUNA di jam kerja operasional.
        </p>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('searchInput');
        const typeFilter = document.getElementById('typeFilter');
        const tableBody = document.getElementById('transactionTable');
        const mobileContainer = document.getElementById('transactionMobileCards');

        function filterTable() {
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const filterValue = typeFilter ? typeFilter.value : '';

            // Filter Desktop Table Rows
            if (tableBody) {
                const rows = tableBody.querySelectorAll('tr');
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    const typeCell = row.querySelector('[data-type]');
                    const type = typeCell ? typeCell.getAttribute('data-type') : '';

                    const matchesSearch = text.includes(query);
                    const matchesFilter = filterValue === '' || type === filterValue;

                    if (matchesSearch && matchesFilter) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Filter Mobile Cards
            if (mobileContainer) {
                const cards = mobileContainer.querySelectorAll('.tx-card');
                cards.forEach(card => {
                    const text = card.innerText.toLowerCase();
                    const type = card.getAttribute('data-type') || '';

                    const matchesSearch = text.includes(query);
                    const matchesFilter = filterValue === '' || type === filterValue;

                    if (matchesSearch && matchesFilter) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (typeFilter) typeFilter.addEventListener('change', filterTable);
    });
</script>
@endpush