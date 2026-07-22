@extends('layouts.admin')

@section('title', 'Tarik Tunai')
@section('page-title', 'Pencairan Tabungan Nasabah')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{ confirmPenarikanOpen: false }">

    {{-- Search Card & Input Form --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs lg:col-span-2 space-y-6">
        
        {{-- Header --}}
        <div>
            <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2 pb-3 border-b border-outline-variant/20 mb-2">
                <span class="material-symbols-outlined text-[18px] text-error">payments</span>
                Pencarian Rekening &amp; Input Penarikan
            </h3>
        </div>

        {{-- Search Form --}}
        <form action="{{ route('admin.penarikan') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <input type="text" name="no_id" value="{{ request('no_id') }}" placeholder="Cari Rekening Nasabah (Format: BS-2026-xxx)..." required
                       class="w-full h-11 pl-4 pr-12 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-mono bg-surface-container-lowest text-on-surface">
            </div>
            <button type="submit" class="h-10 px-4 bg-[#065f46] hover:bg-[#065f46]/90 text-[#FFFFFF] rounded-xl text-xs font-bold transition-all shadow-xs flex items-center gap-2 cursor-pointer border border-transparent">
                <span class="material-symbols-outlined text-[18px]">search</span>
                Cari Akun Warga
            </button>
        </form>

        @if($nasabah)
            {{-- Withdrawal Form --}}
            <form id="penarikan-form" action="{{ route('admin.penarikan.store') }}" method="POST" class="pt-6 border-t border-outline-variant/20 space-y-4">
                @csrf
                <input type="hidden" name="nasabah_id" value="{{ $nasabah->id }}">

                <div class="flex flex-col gap-1.5">
                    <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nominal Penarikan Tunai (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-on-surface-variant/50 select-none">Rp</span>
                        <input type="number" name="nominal" required placeholder="Masukkan nominal penarikan, cth: 50000" min="100" max="{{ $nasabah->total_tabungan }}" value="{{ old('nominal') }}"
                               class="w-full h-11 pl-10 pr-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-mono font-bold bg-surface-container-lowest text-on-surface placeholder-on-surface-variant/40">
                    </div>
                    <p class="text-[10px] text-on-surface-variant/60">Maksimal penarikan tunai yang diperbolehkan: <strong class="text-on-surface">Rp {{ number_format($nasabah->total_tabungan, 0, ',', '.') }}</strong></p>
                </div>

                <div class="pt-4 flex items-center justify-end">
                    <button type="button" @click="confirmPenarikanOpen = true" class="h-11 px-6 bg-error hover:bg-error/95 text-on-error rounded-xl text-xs font-bold transition-all shadow-xs cursor-pointer border border-transparent flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
                        Proses Pencairan Tunai
                    </button>
                </div>
            </form>
        @endif

    </div>

    {{-- Nasabah Profile Card Widget --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs flex flex-col justify-between">
        @if($nasabah)
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2 pb-3 border-b border-outline-variant/20">
                    <span class="material-symbols-outlined text-[18px] text-primary">menu_book</span>
                    Informasi Buku Tabungan
                </h3>

                <div class="space-y-4">
                    {{-- Avatar & Name --}}
                    <div class="flex items-center gap-3.5 mb-4">
                        @if($nasabah->profile_photo)
                            <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 border border-primary/25">
                                <img src="{{ asset($nasabah->profile_photo) }}" alt="Avatar" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-lg font-bold shrink-0 border border-primary/15">
                                {{ strtoupper(substr($nasabah->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <div class="text-xs font-extrabold text-on-surface truncate">{{ $nasabah->name }}</div>
                            <div class="text-[10px] text-primary font-bold font-mono mt-0.5 tracking-wide">{{ $nasabah->no_id }}</div>
                        </div>
                    </div>

                    {{-- Fields --}}
                    <div class="space-y-2.5 text-xs text-on-surface-variant/80 font-medium">
                        <div class="flex items-center justify-between py-1.5 border-b border-outline-variant/15">
                            <span>Nomor KK</span>
                            <span class="font-bold text-on-surface font-mono">{{ $nasabah->kk_number }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1.5 border-b border-outline-variant/15">
                            <span>Nomor HP</span>
                            <span class="font-bold text-on-surface font-mono">{{ $nasabah->phone_number ?? '-' }}</span>
                        </div>
                        <div class="py-1.5">
                            <span class="block mb-1">Alamat Nasabah</span>
                            <span class="font-semibold text-on-surface leading-relaxed block">{{ $nasabah->address ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-4 rounded-xl bg-primary/5 border border-primary/15 text-right shadow-inner">
                <span class="text-[9px] font-bold text-primary uppercase tracking-wider block">Saldo Tabungan Saat Ini</span>
                <span class="text-xl font-black text-primary font-mono mt-1 block">Rp {{ number_format($nasabah->total_tabungan, 0, ',', '.') }}</span>
            </div>
        @else
            <div class="h-full flex flex-col items-center justify-center text-center py-12 text-on-surface-variant/50">
                <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-3">account_balance_wallet</span>
                <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Belum Ada Akun Dipilih</h4>
                <p class="text-[11px] text-on-surface-variant/80 px-4 mt-2 leading-relaxed">Cari nomor rekening nasabah di form pencarian untuk memulai proses penarikan saldo warga.</p>
            </div>
        @endif
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL CONFIRM PENARIKAN --}}
    {{-- ============================================================ --}}
    @if($nasabah)
        <div x-show="confirmPenarikanOpen" 
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="fixed inset-0 bg-neutral-900/40 backdrop-blur-xs"></div>
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-surface-container-lowest text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-outline-variant/30 animate-pageSlideIn"
                     @click.away="confirmPenarikanOpen = false"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="p-6 text-center">
                        <div class="w-12 h-12 rounded-full bg-error-container/20 text-error flex items-center justify-center mx-auto mb-4 border border-error-container/30">
                            <span class="material-symbols-outlined text-[24px]">warning</span>
                        </div>

                        <h3 class="text-sm font-extrabold text-on-surface mb-2">Konfirmasi Pencairan Tunai?</h3>
                        <p class="text-xs text-on-surface-variant/80 leading-relaxed px-2 mb-6">
                            Apakah Anda yakin ingin memproses pencairan uang tunai dari tabungan warga atas nama <strong class="text-on-surface font-extrabold">{{ $nasabah->name }}</strong>? Nominal saldo nasabah akan dipotong secara langsung.
                        </p>

                        <div class="flex items-center justify-center gap-3">
                            <button type="button" @click="confirmPenarikanOpen = false"
                                    class="px-5 py-2.5 rounded-xl border border-outline-variant/45 hover:bg-surface-container text-xs font-bold text-on-surface-variant transition-colors cursor-pointer">
                                Batal
                            </button>
                            <button type="button" @click="document.getElementById('penarikan-form').submit()"
                                    class="px-5 py-2.5 rounded-xl bg-error text-on-error hover:bg-error/95 text-xs font-bold transition-all shadow-xs cursor-pointer">
                                Ya, Cairkan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
