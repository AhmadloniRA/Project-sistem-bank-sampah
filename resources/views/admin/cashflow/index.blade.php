@extends('layouts.admin')

@section('title', 'Buku Kas Kantor')
@section('page-title', 'Buku Kas Internal')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Form Input --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs lg:col-span-2 space-y-4">
        <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2 pb-3 border-b border-outline-variant/20 mb-2">
            <span class="material-symbols-outlined text-[18px] text-primary">add</span>
            Catat Aliran Kas Manual
        </h3>

        <form action="{{ route('admin.cashflow.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Jenis Aliran --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Jenis Aliran Dana</label>
                    <select name="jenis_aliran" required
                            class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface cursor-pointer">
                        <option value="keluar" selected>Dana Keluar (Operasional / Beban)</option>
                        <option value="masuk">Dana Masuk (Custom / Penghasilan Lain)</option>
                    </select>
                </div>

                {{-- Kategori --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Kategori Kas</label>
                    <select name="kategori" required
                            class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface cursor-pointer">
                        <option value="operasional_bensin" selected>Operasional Bensin Armada</option>
                        <option value="atk">ATK / Logistik Nota</option>
                        <option value="perawatan_alat">Perawatan Alat / Timbangan</option>
                        <option value="keuntungan_bersih">Hasil Margin Penjualan Sampah</option>
                        <option value="lain_lain">Lain-lain / Pengeluaran Tak Terduga</option>
                    </select>
                </div>
            </div>

            {{-- Nominal --}}
            <div class="flex flex-col gap-1.5">
                <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nominal Uang (Rupiah)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-on-surface-variant/50 select-none">Rp</span>
                    <input type="number" name="nominal" required placeholder="Contoh: 15000" min="100"
                           class="w-full h-11 pl-10 pr-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-mono font-bold bg-surface-container-lowest text-on-surface placeholder-on-surface-variant/40">
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="flex flex-col gap-1.5">
                <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Catatan Detail (Keterangan)</label>
                <textarea name="keterangan" rows="3" required placeholder="Masukkan Detail Keterangannya!"
                          class="w-full p-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all resize-none bg-surface-container-lowest text-on-surface placeholder-on-surface-variant/40"></textarea>
            </div>

            <div class="pt-4 border-t border-outline-variant/20 flex justify-end">
                <button type="submit" class="h-10 px-4 bg-[#065f46] hover:bg-[#065f46]/90 text-[#FFFFFF] rounded-xl text-xs font-bold transition-all shadow-xs flex items-center gap-2 cursor-pointer border border-transparent">
                    <span class="material-symbols-outlined text-[16px]">save</span>
                    Simpan Riwayat Kas
                </button>
            </div>
        </form>
    </div>

    {{-- Balance Widget --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs flex flex-col justify-between h-72 lg:h-auto">
        <div class="space-y-4">
            <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2 pb-3 border-b border-outline-variant/20">
                <span class="material-symbols-outlined text-[18px] text-primary">account_balance_wallet</span>
                Saldo Kas internal
            </h3>

            <div class="bg-primary/5 border border-primary/15 p-6 rounded-2xl text-right shadow-inner">
                <span class="text-[9px] font-bold text-primary uppercase tracking-wider block">Sisa Anggaran Operasional</span>
                <span class="text-2xl font-black text-primary font-mono mt-1 block">Rp {{ number_format($sisaSaldo, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="mt-6 text-[10px] font-medium leading-relaxed text-on-surface-variant/70 bg-surface-container-low/40 p-4 rounded-2xl border border-outline-variant/15">
            * Kas Internal Pengelola terisi <strong>secara otomatis</strong> ketika admin melakukan "Konfirmasi Penjualan" di Page Gudang (berupa keuntungan margin penjualan). Pengeluaran dicatat secara manual di form kiri.
        </div>
    </div>

</div>

{{-- Cashflow Log table & Mobile Cards --}}
<div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 shadow-xs overflow-hidden mt-6">
    <div class="px-5 py-4 border-b border-outline-variant/20 flex items-center justify-between">
        <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Jurnal Arus Kas Internal</h3>
        <span class="text-[10px] font-bold text-primary bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/10">{{ $cashflows->count() }} Data</span>
    </div>

    {{-- MOBILE VIEW: Individual Distinct Cards (Per Kotak) --}}
    <div class="block md:hidden space-y-3.5 p-3.5 sm:p-4 bg-surface-container-low/20">
        @forelse($cashflows as $cf)
            <div class="p-4 space-y-3 bg-surface-container-lowest rounded-2xl border border-outline-variant/40 shadow-xs hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between gap-2 pb-2.5 border-b border-outline-variant/20">
                    <div>
                        @if($cf->jenis_aliran === 'masuk')
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-primary/10 border border-primary/15 text-primary">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Masuk (Keuntungan)
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-amber-500/10 border border-amber-500/15 text-amber-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                Keluar (Operasional)
                            </span>
                        @endif
                    </div>
                    <div class="font-bold font-mono text-xs {{ $cf->jenis_aliran === 'masuk' ? 'text-primary' : 'text-amber-600' }}">
                        {{ $cf->jenis_aliran === 'masuk' ? '+' : '-' }} Rp {{ number_format($cf->nominal, 0, ',', '.') }}
                    </div>
                </div>

                <div class="text-xs space-y-1.5">
                    <div class="font-bold text-on-surface">
                        @if($cf->kategori === 'operasional_bensin')
                            Bensin Armada
                        @elseif($cf->kategori === 'atk')
                            ATK Kantor
                        @elseif($cf->kategori === 'perawatan_alat')
                            Servis Alat
                        @elseif($cf->kategori === 'keuntungan_bersih')
                            Profit Bersih Sampah
                        @else
                            Lain-lain
                        @endif
                    </div>
                    @if($cf->keterangan)
                        <div class="text-on-surface font-semibold text-xs leading-relaxed bg-surface-container-low/50 p-2.5 rounded-xl border border-outline-variant/15">
                            {{ $cf->keterangan }}
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-between pt-2.5 border-t border-outline-variant/20 text-[11px]">
                    <div class="text-on-surface-variant/60 font-mono text-[10px]">
                        {{ $cf->created_at->translatedFormat('d M Y - H:i') }} WIB
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="text-on-surface-variant/60 font-medium">Kas Berjalan:</span>
                        <span class="font-bold text-primary font-mono bg-primary/5 px-2 py-0.5 rounded-md border border-primary/15">Rp {{ number_format($cf->sisa_saldo_kas, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-on-surface-variant/50">
                <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-2">account_balance_wallet</span>
                <p class="text-xs font-bold text-on-surface-variant/60">Belum ada riwayat transaksi kas internal</p>
            </div>
        @endforelse
    </div>

    {{-- DESKTOP VIEW: Full Table --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-outline-variant/20 bg-surface-container-low/20">
                    <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Tanggal Input</th>
                    <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Arah Aliran</th>
                    <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nominal</th>
                    <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Kas Berjalan</th>
                    <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Keterangan Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/15 text-xs">
                @forelse($cashflows as $cf)
                    <tr class="hover:bg-surface-container-low/20 transition-colors">
                        <td class="px-6 py-4 text-on-surface-variant/70 font-semibold">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-on-surface-variant/80 font-mono">{{ $cf->created_at->translatedFormat('d M Y - H:i') }} WIB</td>
                        <td class="px-6 py-4">
                            @if($cf->jenis_aliran === 'masuk')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-primary/10 border border-primary/15 text-primary">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Masuk (Keuntungan)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-amber-500/10 border border-amber-500/15 text-amber-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Keluar (Operasional)
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-on-surface font-bold">
                            @if($cf->kategori === 'operasional_bensin')
                                Bensin Armada
                            @elseif($cf->kategori === 'atk')
                                ATK Kantor
                            @elseif($cf->kategori === 'perawatan_alat')
                                Servis Alat
                            @elseif($cf->kategori === 'keuntungan_bersih')
                                Profit Bersih Sampah
                            @else
                                Lain-lain
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold font-mono {{ $cf->jenis_aliran === 'masuk' ? 'text-primary' : 'text-amber-600' }}">
                            {{ $cf->jenis_aliran === 'masuk' ? '+' : '-' }} Rp {{ number_format($cf->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 font-bold text-on-surface font-mono">Rp {{ number_format($cf->sisa_saldo_kas, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-on-surface-variant/80 max-w-[250px] truncate" title="{{ $cf->keterangan }}">{{ $cf->keterangan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-on-surface-variant/50">
                            <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-2">account_balance_wallet</span>
                            <p class="text-xs font-bold text-on-surface-variant/60">Belum ada riwayat transaksi kas internal</p>
                            <p class="text-[10px] mt-0.5">Arus kas masuk atau pengeluaran operasional akan tercatat di sini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection