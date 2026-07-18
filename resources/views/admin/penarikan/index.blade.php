@extends('layouts.admin')

@section('title', 'Tarik Tunai')
@section('page-title', 'Pencairan Tabungan Nasabah')
@section('page-subtitle', 'Kasir loket penarikan uang tunai nasabah ARUNA')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{ confirmPenarikanOpen: false }">

    {{-- Search Card & Input Form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:col-span-2 space-y-6">
        
        {{-- Header --}}
        <div>
            <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2 pb-3 border-b border-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                </svg>
                Pencarian Rekening & Input Penarikan
            </h3>
        </div>

        {{-- Search Form --}}
        <form action="{{ route('admin.penarikan') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <input type="text" name="no_id" value="{{ request('no_id') }}" placeholder="Cari Rekening Nasabah (Format: BS-2026-xxx)..." required
                       class="w-full h-11 pl-4 pr-12 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all font-mono placeholder-gray-400">
            </div>
            <button type="submit" class="h-11 px-6 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-emerald-600/15 cursor-pointer shrink-0 border border-transparent">
                Cari Akun Warga
            </button>
        </form>

        @if($nasabah)
            {{-- Withdrawal Form --}}
            <form id="penarikan-form" action="{{ route('admin.penarikan.store') }}" method="POST" class="pt-6 border-t border-gray-50 space-y-4">
                @csrf
                <input type="hidden" name="nasabah_id" value="{{ $nasabah->id }}">

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nominal Penarikan Tunai (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400 select-none">Rp</span>
                        <input type="number" name="nominal" required placeholder="Masukkan nominal penarikan, cth: 50000" min="100" max="{{ $nasabah->total_tabungan }}" value="{{ old('nominal') }}"
                               class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all font-mono font-bold text-gray-800 placeholder-gray-400">
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1">Maksimal penarikan tunai yang diperbolehkan: Rp {{ number_format($nasabah->total_tabungan, 0, ',', '.') }}</p>
                </div>

                <div class="pt-3 flex items-center justify-end">
                    <button type="button" @click="confirmPenarikanOpen = true" class="h-11 px-6 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-rose-600/15 cursor-pointer border border-transparent">
                        Proses Pencairan Tunai
                    </button>
                </div>
            </form>
        @endif

    </div>

    {{-- Nasabah Profile Card Widget --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
        @if($nasabah)
            <div>
                <h3 class="text-sm font-bold text-gray-900 mb-5 flex items-center gap-2 pb-3 border-b border-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Informasi Buku Tabungan
                </h3>

                <div class="space-y-4">
                    {{-- Avatar & Name --}}
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center text-lg font-bold">
                            {{ strtoupper(substr($nasabah->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-[13px] font-extrabold text-gray-800">{{ $nasabah->name }}</div>
                            <div class="text-[10px] text-emerald-650 font-bold font-mono mt-0.5">{{ $nasabah->no_id }}</div>
                        </div>
                    </div>

                    {{-- Fields --}}
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between text-[11px] py-1 border-b border-gray-50">
                            <span class="text-gray-400 font-medium">Nomor KK</span>
                            <span class="font-bold text-gray-700 font-mono">{{ $nasabah->kk_number }}</span>
                        </div>
                        <div class="flex items-center justify-between text-[11px] py-1 border-b border-gray-50">
                            <span class="text-gray-400 font-medium">Nomor HP</span>
                            <span class="font-bold text-gray-700 font-mono">{{ $nasabah->phone_number ?? '-' }}</span>
                        </div>
                        <div class="text-[11px] py-1">
                            <span class="text-gray-400 font-medium block mb-1">Alamat Nasabah</span>
                            <span class="font-semibold text-gray-600 leading-relaxed block">{{ $nasabah->address ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-4 rounded-xl bg-emerald-50/50 border border-emerald-100/50 text-right">
                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block">Saldo Tabungan Saat Ini</span>
                <span class="text-xl font-black text-emerald-700 font-mono mt-1 block">Rp {{ number_format($nasabah->total_tabungan, 0, ',', '.') }}</span>
            </div>
        @else
            <div class="h-full flex flex-col items-center justify-center text-center py-12">
                <div class="w-14 h-14 rounded-full bg-gray-50 flex items-center justify-center mb-4 border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118" />
                    </svg>
                </div>
                <h4 class="text-xs font-bold text-gray-400">Belum Ada Rekening Dipilih</h4>
                <p class="text-[10.5px] text-gray-400 px-4 mt-1.5 leading-relaxed">Cari nomor rekening nasabah di form pencarian untuk memulai proses penarikan saldo warga.</p>
            </div>
        @endif
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL CONFIRM PENARIKAN --}}
    {{-- ============================================================ --}}
    @if($nasabah)
        <div 
            x-show="confirmPenarikanOpen" 
            class="fixed inset-0 z-50 overflow-y-auto" 
            style="display: none;"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div class="fixed inset-0 bg-neutral-900/60 backdrop-blur-xs transition-opacity"></div>
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div 
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100"
                    @click.away="confirmPenarikanOpen = false"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div class="p-6 text-center">
                        <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-4 border border-rose-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>

                        <h3 class="text-sm font-bold text-gray-900 mb-2">Konfirmasi Pencairan Tunai?</h3>
                        <p class="text-xs text-gray-500 leading-relaxed px-2 mb-6">
                            Apakah Anda yakin ingin memproses pencairan uang tunai dari tabungan warga atas nama <strong class="text-gray-800">{{ $nasabah->name }}</strong>? Nominal saldo nasabah akan dipotong secara permanen.
                        </p>

                        <div class="flex items-center justify-center gap-3">
                            <button type="button" @click="confirmPenarikanOpen = false"
                                    class="px-5 py-2.5 rounded-xl border border-gray-200 hover:bg-gray-50 text-xs font-semibold text-gray-600 transition-colors cursor-pointer">
                                Batal
                            </button>
                            <button type="button" @click="document.getElementById('penarikan-form').submit()"
                                    class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-all shadow-md shadow-rose-600/15 cursor-pointer">
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
