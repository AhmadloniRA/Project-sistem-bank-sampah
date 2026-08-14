@extends('layouts.admin')

@section('title', 'Buku Tabungan Nasabah')
@section('page-title', 'Buku Tabungan')

@section('content')
<div class="space-y-6">
    {{-- Header Card --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-5 sm:p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-5 shadow-xs">
        <div class="flex items-center gap-3.5 sm:gap-4">
            @if($nasabah->profile_photo)
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl overflow-hidden shrink-0 border border-primary/20 shadow-xs">
                    <img src="{{ asset($nasabah->profile_photo) }}" alt="Avatar" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-lg sm:text-xl font-bold border border-primary/20 shrink-0 shadow-xs">
                    {{ strtoupper(substr($nasabah->name, 0, 1)) }}
                </div>
            @endif
            <div class="min-w-0">
                <h2 class="text-base sm:text-lg font-extrabold text-on-surface truncate">{{ $nasabah->name }}</h2>
                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-on-surface-variant/70 mt-1">
                    <span class="font-bold text-primary font-mono tracking-wide bg-primary/5 px-2 py-0.5 rounded border border-primary/10 text-[11px]">{{ $nasabah->no_id }}</span>
                    <span class="w-1 h-1 rounded-full bg-outline-variant hidden sm:inline-block"></span>
                    <span class="font-mono text-[11px]">KK: {{ $nasabah->kk_number }}</span>
                    <span class="w-1 h-1 rounded-full bg-outline-variant hidden sm:inline-block"></span>
                    <span class="font-mono text-[11px]">HP: {{ $nasabah->phone_number ?? '-' }}</span>
                </div>
            </div>
        </div>
        
        <div class="bg-primary/5 border border-primary/15 rounded-2xl px-5 py-3.5 sm:px-6 sm:py-4 flex flex-col justify-center min-w-[180px] shrink-0 text-left md:text-right">
            <span class="text-[10px] font-bold text-primary uppercase tracking-wider">Saldo Tabungan Warga</span>
            <span class="text-xl sm:text-2xl font-black text-primary font-mono mt-0.5">Rp {{ number_format($nasabah->total_tabungan, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Main transaction table & mobile cards --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 overflow-hidden shadow-xs">
        <div class="px-5 py-4 border-b border-outline-variant/20 flex items-center justify-between">
            <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Jurnal Riwayat Mutasi</h3>
            <a href="{{ route('admin.nasabah') }}" class="text-xs font-bold text-primary hover:underline flex items-center gap-1.5 cursor-pointer">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali
            </a>
        </div>

        {{-- MOBILE VIEW: Individual Distinct Cards (Per Kotak) --}}
        <div class="block md:hidden space-y-3.5 p-3.5 sm:p-4 bg-surface-container-low/20">
            @forelse($transactions as $tx)
                <div class="p-4 space-y-3 bg-surface-container-lowest rounded-2xl border border-outline-variant/40 shadow-xs hover:shadow-md transition-all duration-200">
                    {{-- Header: Jenis Aliran & Nominal --}}
                    <div class="flex items-center justify-between gap-2 pb-2.5 border-b border-outline-variant/20">
                        <div>
                            @if($tx->jenis_transaksi === 'masuk')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-primary/10 border border-primary/15 text-primary">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Masuk / Setoran
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-error-container/40 border border-error-container/20 text-error">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Keluar / Penarikan
                                </span>
                            @endif
                        </div>
                        <div class="font-extrabold font-mono text-sm {{ $tx->jenis_transaksi === 'masuk' ? 'text-primary' : 'text-error' }}">
                            {{ $tx->jenis_transaksi === 'masuk' ? '+' : '-' }} Rp {{ number_format($tx->nominal, 0, ',', '.') }}
                        </div>
                    </div>

                    {{-- Tanggal & Keterangan --}}
                    <div class="space-y-2 text-xs">
                        <div class="text-[11px] font-mono text-on-surface-variant/70 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[15px] text-primary/70">schedule</span>
                            <span>{{ $tx->created_at->translatedFormat('d M Y') }} • {{ $tx->created_at->format('H:i') }} WIB</span>
                        </div>
                        @if($tx->keterangan)
                            <div class="text-on-surface font-semibold text-xs leading-relaxed bg-surface-container-low/50 p-2.5 rounded-xl border border-outline-variant/15">
                                {{ $tx->keterangan }}
                            </div>
                        @endif
                    </div>

                    {{-- Footer: Saldo Berjalan --}}
                    <div class="flex items-center justify-between pt-2.5 border-t border-outline-variant/20 text-[11px]">
                        <span class="text-on-surface-variant/60 font-medium">Saldo Berjalan:</span>
                        <span class="font-bold text-primary font-mono bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/15 text-xs">
                            Rp {{ number_format($tx->saldo_terakhir, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-on-surface-variant/50">
                    <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-2">history</span>
                    <p class="text-xs font-bold text-on-surface-variant/60">Belum ada mutasi transaksi</p>
                    <p class="text-[10px] mt-0.5">Transaksi setoran sampah atau tarik tunai akan tercatat di sini.</p>
                </div>
            @endforelse
        </div>

        {{-- DESKTOP VIEW: Full Table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-outline-variant/20 bg-surface-container-low/20">
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Tanggal Transaksi</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Jenis Aliran</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nominal</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Saldo Berjalan</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/15 text-xs">
                    @forelse($transactions as $tx)
                        <tr class="hover:bg-surface-container-low/20 transition-colors">
                            <td class="px-6 py-4 text-on-surface-variant/70 font-semibold">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-on-surface-variant/80 font-mono">{{ $tx->created_at->translatedFormat('d M Y - H:i') }} WIB</td>
                            <td class="px-6 py-4">
                                @if($tx->jenis_transaksi === 'masuk')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-primary/10 border border-primary/15 text-primary">
                                        <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                                        Masuk / Setoran
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-error-container/40 border border-error-container/20 text-error">
                                        <span class="w-1 h-1 rounded-full bg-red-500"></span>
                                        Keluar / Penarikan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold font-mono {{ $tx->jenis_transaksi === 'masuk' ? 'text-primary' : 'text-error' }}">
                                {{ $tx->jenis_transaksi === 'masuk' ? '+' : '-' }} Rp {{ number_format($tx->nominal, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-bold text-on-surface font-mono">Rp {{ number_format($tx->saldo_terakhir, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-on-surface-variant/80 max-w-[300px] truncate" title="{{ $tx->keterangan }}">{{ $tx->keterangan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant/50">
                                <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-2">history</span>
                                <p class="text-xs font-bold text-on-surface-variant/60">Belum ada mutasi transaksi</p>
                                <p class="text-[10px] mt-0.5">Transaksi setoran sampah atau tarik tunai akan tercatat di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection