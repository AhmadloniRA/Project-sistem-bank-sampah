@extends('layouts.admin')

@section('title', 'Stok & Gudang')
@section('page-title', 'Stok & Gudang')

@section('content')
<div class="space-y-6" x-data="{ confirmJualOpen: false }">
    
    {{-- Stats Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Berat --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="p-2 bg-secondary-container text-on-secondary-container rounded-xl">
                    <span class="material-symbols-outlined text-[20px]">inventory</span>
                </div>
                <span class="text-[9px] font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full">Timbangan</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-on-surface font-mono">{{ number_format($totalBerat, 2, ',', '.') }} <span class="text-xs font-bold text-on-surface-variant/60">kg</span></div>
            <div class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider mt-1">Total Muatan Gudang</div>
        </div>

        {{-- Investasi Pembelian --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="p-2 bg-error-container/40 text-error rounded-xl">
                    <span class="material-symbols-outlined text-[20px]">money_off</span>
                </div>
                <span class="text-[9px] font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full">Modal Beli</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-on-surface font-mono">Rp {{ number_format($totalBeliNasabah, 0, ',', '.') }}</div>
            <div class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider mt-1">Total Dibayar ke Warga</div>
        </div>

        {{-- Nilai Penjualan --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="p-2 bg-primary/10 text-primary rounded-xl">
                    <span class="material-symbols-outlined text-[20px]">trending_up</span>
                </div>
                <span class="text-[9px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-full">Harga Pengepul</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-on-surface font-mono">Rp {{ number_format($totalEstimasiJual, 0, ',', '.') }}</div>
            <div class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider mt-1">Estimasi Harga Jual</div>
        </div>

        {{-- Margin Keuntungan --}}
        <div class="bg-primary/5 border border-primary/20 p-5 rounded-2xl shadow-xs hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="p-2 bg-primary/10 text-primary rounded-xl">
                    <span class="material-symbols-outlined text-[20px]">savings</span>
                </div>
                <span class="text-[9px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded-full border border-primary/20">Margin Bersih</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-primary font-mono">Rp {{ number_format($estimasiKeuntungan, 0, ',', '.') }}</div>
            <div class="text-[10px] font-bold text-primary/80 uppercase tracking-wider mt-1">Estimasi Profit Kas</div>
        </div>
    </div>

    {{-- Stock detail by Category --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Botol Plastik --}}
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs flex flex-col justify-between h-52">
            <div class="flex items-center justify-between pb-3 border-b border-outline-variant/20">
                <h4 class="text-xs font-bold text-on-surface">Botol Plastik</h4>
                <span class="w-2.5 h-2.5 rounded-full bg-teal-500"></span>
            </div>
            <div class="py-4">
                <div class="text-3xl font-black text-on-surface font-mono">
                    {{ number_format($stokGudang['botol plastik']->total_berat ?? 0, 1, ',', '.') }} <span class="text-xs font-bold text-on-surface-variant/70">kg</span>
                </div>
                <p class="text-[10px] text-on-surface-variant/60 mt-1">Timbangan mengendap saat ini</p>
            </div>
            <div class="flex justify-between text-[10px] font-bold text-on-surface-variant/60 pt-3 border-t border-outline-variant/20">
                <span>Nilai Beli: Rp {{ number_format($stokGudang['botol plastik']->total_beli ?? 0, 0, ',', '.') }}</span>
                <span class="text-primary font-extrabold">Nilai Jual: Rp {{ number_format($stokGudang['botol plastik']->total_jual ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Kardus --}}
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs flex flex-col justify-between h-52">
            <div class="flex items-center justify-between pb-3 border-b border-outline-variant/20">
                <h4 class="text-xs font-bold text-on-surface">Kardus / Karton</h4>
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
            </div>
            <div class="py-4">
                <div class="text-3xl font-black text-on-surface font-mono">
                    {{ number_format($stokGudang['kardus']->total_berat ?? 0, 1, ',', '.') }} <span class="text-xs font-bold text-on-surface-variant/70">kg</span>
                </div>
                <p class="text-[10px] text-on-surface-variant/60 mt-1">Timbangan mengendap saat ini</p>
            </div>
            <div class="flex justify-between text-[10px] font-bold text-on-surface-variant/60 pt-3 border-t border-outline-variant/20">
                <span>Nilai Beli: Rp {{ number_format($stokGudang['kardus']->total_beli ?? 0, 0, ',', '.') }}</span>
                <span class="text-primary font-extrabold">Nilai Jual: Rp {{ number_format($stokGudang['kardus']->total_jual ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Kaleng --}}
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs flex flex-col justify-between h-52">
            <div class="flex items-center justify-between pb-3 border-b border-outline-variant/20">
                <h4 class="text-xs font-bold text-on-surface">Kaleng Logam</h4>
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
            </div>
            <div class="py-4">
                <div class="text-3xl font-black text-on-surface font-mono">
                    {{ number_format($stokGudang['kaleng']->total_berat ?? 0, 1, ',', '.') }} <span class="text-xs font-bold text-on-surface-variant/70">kg</span>
                </div>
                <p class="text-[10px] text-on-surface-variant/60 mt-1">Timbangan mengendap saat ini</p>
            </div>
            <div class="flex justify-between text-[10px] font-bold text-on-surface-variant/60 pt-3 border-t border-outline-variant/20">
                <span>Nilai Beli: Rp {{ number_format($stokGudang['kaleng']->total_beli ?? 0, 0, ',', '.') }}</span>
                <span class="text-primary font-extrabold">Nilai Jual: Rp {{ number_format($stokGudang['kaleng']->total_jual ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Confirmation Panel --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-xs font-bold text-on-surface-variant/80 uppercase tracking-wider">Likuidasi &amp; Kosongkan Gudang</h3>
            <p class="text-xs text-on-surface-variant/70 mt-1">Lakukan proses penjualan sampah yang terkumpul di gudang ke Pengepul pabrik untuk mencairkan margin keuntungan.</p>
        </div>

        @if($totalBerat > 0)
            <button @click="confirmJualOpen = true" class="h-11 px-6 bg-[#065f46] hover:bg-[#065f46]/90 text-[#FFFFFF] rounded-xl text-xs font-bold transition-all shadow-xs flex items-center gap-1.5 cursor-pointer border border-transparent">
                <span class="material-symbols-outlined text-[18px]">verified</span>
                Konfirmasi Penjualan Sampah
            </button>
        @else
            <button disabled class="h-11 px-6 bg-surface-container text-on-surface-variant/40 rounded-xl text-xs font-bold cursor-not-allowed shrink-0 border border-transparent flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">remove_shopping_cart</span>
                Gudang Masih Kosong
            </button>
        @endif
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL CONFIRM JUAL --}}
    {{-- ============================================================ --}}
    <div x-show="confirmJualOpen" 
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
                 @click.away="confirmJualOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <form action="{{ route('admin.gudang.jual') }}" method="POST" class="p-6 text-center">
                    @csrf

                    <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-4 border border-primary/20 shadow-xs">
                        <span class="material-symbols-outlined text-[24px]">verified</span>
                    </div>

                    <h3 class="text-sm font-extrabold text-on-surface mb-2">Konfirmasi Jual Sampah?</h3>
                    <p class="text-xs text-on-surface-variant/80 leading-relaxed px-2 mb-6">
                        Menyetujui penjualan seluruh timbangan sampah di gudang seberat <strong class="text-on-surface font-mono font-extrabold">{{ number_format($totalBerat, 2, ',', '.') }} kg</strong> ke pengepul pabrik. Keuntungan bersih sebesar <strong class="text-primary font-mono font-extrabold">Rp {{ number_format($estimasiKeuntungan, 0, ',', '.') }}</strong> akan otomatis ditambahkan ke Kas Kantor.
                    </p>

                    <div class="flex items-center justify-center gap-3">
                        <button type="button" @click="confirmJualOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-outline-variant/45 hover:bg-surface-container text-xs font-bold text-on-surface-variant transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 text-[#FFFFFF] rounded-xl bg-primary text-on-primary hover:bg-primary/95 text-xs font-bold transition-all shadow-xs cursor-pointer">
                            Ya, Jual Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
