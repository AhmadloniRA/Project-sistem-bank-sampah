@extends('layouts.admin')

@section('title', 'Stok & Gudang')
@section('page-title', 'Stok & Penjualan Gudang')
@section('page-subtitle', 'Manajemen volume muatan sampah dan penjualan ke pengepul')

@section('content')
<div class="space-y-6" x-data="{ confirmJualOpen: false }">

    {{-- Stats Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        {{-- Total Berat --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm group hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5" />
                    </svg>
                </div>
                <span class="text-[9px] font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full">Timbangan</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-gray-900 font-mono">{{ number_format($totalBerat, 2, ',', '.') }} <span class="text-xs font-bold text-gray-400">kg</span></div>
            <div class="text-[11px] text-gray-400 font-bold uppercase tracking-wider mt-1">Total Muatan Gudang</div>
        </div>

        {{-- Investasi Pembelian --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm group hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center border border-rose-100/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0" />
                    </svg>
                </div>
                <span class="text-[9px] font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full">Modal Beli</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-gray-900 font-mono">Rp {{ number_format($totalBeliNasabah, 0, ',', '.') }}</div>
            <div class="text-[11px] text-gray-400 font-bold uppercase tracking-wider mt-1">Total Dibayar ke Warga</div>
        </div>

        {{-- Nilai Penjualan --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm group hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-650 flex items-center justify-center border border-teal-100/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518" />
                    </svg>
                </div>
                <span class="text-[9px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-full">Harga Pengepul</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-gray-900 font-mono">Rp {{ number_format($totalEstimasiJual, 0, ',', '.') }}</div>
            <div class="text-[11px] text-gray-400 font-bold uppercase tracking-wider mt-1">Estimasi Harga Jual</div>
        </div>

        {{-- Margin Keuntungan --}}
        <div class="bg-white rounded-2xl border border-emerald-100/80 p-5 shadow-sm group hover:shadow-md transition-all duration-300 bg-emerald-50/10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75" />
                    </svg>
                </div>
                <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">Margin Bersih</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-emerald-700 font-mono">Rp {{ number_format($estimasiKeuntungan, 0, ',', '.') }}</div>
            <div class="text-[11px] text-emerald-600 font-bold uppercase tracking-wider mt-1">Estimasi Profit Kas</div>
        </div>

    </div>

    {{-- Stock detail by Category --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Botol Plastik --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between h-52">
            <div class="flex items-center justify-between pb-3 border-b border-gray-50">
                <h4 class="text-sm font-extrabold text-gray-800">Botol Plastik</h4>
                <span class="w-3 h-3 rounded-full bg-teal-400"></span>
            </div>
            <div class="py-4">
                <div class="text-3xl font-black text-gray-900 font-mono">
                    {{ number_format($stokGudang['botol plastik']->total_berat ?? 0, 1, ',', '.') }} <span class="text-xs font-bold text-gray-405">kg</span>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">Timbangan mengendap saat ini</p>
            </div>
            <div class="flex justify-between text-[11px] text-gray-400 pt-3 border-t border-gray-50">
                <span>Nilai Beli: Rp {{ number_format($stokGudang['botol plastik']->total_beli ?? 0, 0, ',', '.') }}</span>
                <span class="font-bold text-emerald-600">Nilai Jual: Rp {{ number_format($stokGudang['botol plastik']->total_jual ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Kardus --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between h-52">
            <div class="flex items-center justify-between pb-3 border-b border-gray-50">
                <h4 class="text-sm font-extrabold text-gray-800">Kardus Bekas</h4>
                <span class="w-3 h-3 rounded-full bg-amber-400"></span>
            </div>
            <div class="py-4">
                <div class="text-3xl font-black text-gray-900 font-mono">
                    {{ number_format($stokGudang['kardus']->total_berat ?? 0, 1, ',', '.') }} <span class="text-xs font-bold text-gray-405">kg</span>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">Timbangan mengendap saat ini</p>
            </div>
            <div class="flex justify-between text-[11px] text-gray-400 pt-3 border-t border-gray-50">
                <span>Nilai Beli: Rp {{ number_format($stokGudang['kardus']->total_beli ?? 0, 0, ',', '.') }}</span>
                <span class="font-bold text-emerald-600">Nilai Jual: Rp {{ number_format($stokGudang['kardus']->total_jual ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Kaleng --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between h-52">
            <div class="flex items-center justify-between pb-3 border-b border-gray-50">
                <h4 class="text-sm font-extrabold text-gray-800">Kaleng Logam</h4>
                <span class="w-3 h-3 rounded-full bg-rose-400"></span>
            </div>
            <div class="py-4">
                <div class="text-3xl font-black text-gray-900 font-mono">
                    {{ number_format($stokGudang['kaleng']->total_berat ?? 0, 1, ',', '.') }} <span class="text-xs font-bold text-gray-405">kg</span>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">Timbangan mengendap saat ini</p>
            </div>
            <div class="flex justify-between text-[11px] text-gray-400 pt-3 border-t border-gray-50">
                <span>Nilai Beli: Rp {{ number_format($stokGudang['kaleng']->total_beli ?? 0, 0, ',', '.') }}</span>
                <span class="font-bold text-emerald-600">Nilai Jual: Rp {{ number_format($stokGudang['kaleng']->total_jual ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

    </div>

    {{-- Confirmation Panel --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-sm font-bold text-gray-900">Likuidasi & Kosongkan Gudang</h3>
            <p class="text-[12px] text-gray-400 mt-1">Lakukan proses penjualan sampah yang terkumpul di gudang ke Pengepul pabrik untuk mencairkan margin keuntungan.</p>
        </div>

        @if($totalBerat > 0)
            <button @click="confirmJualOpen = true" class="h-11 px-6 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-emerald-600/15 cursor-pointer shrink-0 border border-transparent">
                Konfirmasi Penjualan Sampah
            </button>
        @else
            <button disabled class="h-11 px-6 bg-gray-100 text-gray-400 rounded-xl text-xs font-bold cursor-not-allowed shrink-0 border border-transparent">
                Gudang Masih Kosong
            </button>
        @endif
    </div>



    {{-- ============================================================ --}}
    {{-- MODAL CONFIRM JUAL --}}
    {{-- ============================================================ --}}
    <div 
        x-show="confirmJualOpen" 
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
                @click.away="confirmJualOpen = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <form action="{{ route('admin.gudang.jual') }}" method="POST" class="p-6 text-center">
                    @csrf

                    <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-4 border border-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>

                    <h3 class="text-sm font-bold text-gray-900 mb-2">Konfirmasi Jual Sampah?</h3>
                    <p class="text-xs text-gray-500 leading-relaxed px-2 mb-6">
                        Menyetujui penjualan seluruh timbangan sampah di gudang seberat <strong class="text-gray-800 font-mono">{{ number_format($totalBerat, 2, ',', '.') }} kg</strong> ke pengepul pabrik. Keuntungan bersih sebesar <strong class="text-emerald-700 font-mono">Rp {{ number_format($estimasiKeuntungan, 0, ',', '.') }}</strong> akan otomatis ditambahkan ke Kas Kantor.
                    </p>

                    <div class="flex items-center justify-center gap-3">
                        <button type="button" @click="confirmJualOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-gray-200 hover:bg-gray-50 text-xs font-semibold text-gray-600 transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-md shadow-emerald-600/15 cursor-pointer">
                            Ya, Jual Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
