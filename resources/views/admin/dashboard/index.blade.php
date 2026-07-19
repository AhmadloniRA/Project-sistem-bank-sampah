@extends('layouts.admin')

@section('title', 'Dashboard Utama')
@section('page-title', 'Dashboard Utama')

@section('content')
<div class="space-y-6">
    {{-- Hero Welcome Banner --}}
    <section class="relative overflow-hidden rounded-2xl bg-primary-container p-6 sm:p-8 text-white shadow-sm">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="space-y-3 text-center md:text-left">
                <h1 class="text-xl sm:text-2xl font-extrabold text-on-primary-container">Selamat Pagi, Admin ARUNA! 👋</h1>
                <p class="text-xs sm:text-sm text-on-primary-container/90 max-w-xl leading-relaxed">
                    Operasional Bank Sampah berjalan optimal hari ini. Kelola data nasabah, rekam setoran baru, dan validasi kas operasional dengan mudah dari satu dashboard terintegrasi.
                </p>
                <div class="flex flex-wrap gap-2 pt-2 justify-center md:justify-start">
                    <a href="{{ route('admin.setoran') }}" class="px-4 py-2 bg-tertiary-container text-on-tertiary-container hover:bg-tertiary-container/85 rounded-xl text-xs font-bold transition-all shadow-xs inline-flex items-center gap-1.5 cursor-pointer">
                        <span class="material-symbols-outlined text-[16px]">add_shopping_cart</span>
                        Catat Setoran Baru
                    </a>
                    <a href="{{ route('admin.nasabah') }}" class="px-4 py-2 border border-primary-fixed/30 text-primary-fixed hover:bg-white/10 rounded-xl text-xs font-bold transition-colors inline-flex items-center gap-1.5 cursor-pointer">
                        <span class="material-symbols-outlined text-[16px]">group</span>
                        Kelola Nasabah
                    </a>
                </div>
            </div>
            <div class="hidden lg:block w-32 h-32 opacity-20 shrink-0 select-none">
                <span class="material-symbols-outlined text-[128px]" style="font-variation-settings: 'FILL' 1;">eco</span>
            </div>
        </div>
    </section>

    {{-- Key Metric Bento Grid --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Omset --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-secondary-container rounded-xl text-on-secondary-container shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">trending_up</span>
                </div>
                <span class="text-[9px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-full">Di Gudang</span>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Total Omset Berjalan</p>
            <h3 class="text-lg font-black text-on-surface mt-1 font-mono">Rp {{ number_format($totalOmsetBerjalan, 0, ',', '.') }}</h3>
            <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-secondary rounded-full" style="width: 75%"></div>
            </div>
        </div>

        {{-- Dana Titipan --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-primary/10 text-primary rounded-xl shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">savings</span>
                </div>
                <span class="text-[9px] font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full">Liabilitas</span>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Dana Titipan Nasabah</p>
            <h3 class="text-lg font-black text-on-surface mt-1 font-mono">Rp {{ number_format($totalDanaTitipanWarga, 0, ',', '.') }}</h3>
            <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-primary rounded-full" style="width: 80%"></div>
            </div>
        </div>

        {{-- Sisa Kas --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-tertiary-container/30 text-tertiary rounded-xl shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">account_balance</span>
                </div>
                <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">Kas Bersih</span>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Sisa Kas Operasional</p>
            <h3 class="text-lg font-black text-on-surface mt-1 font-mono">Rp {{ number_format($sisaKasPengelola, 0, ',', '.') }}</h3>
            <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-tertiary rounded-full" style="width: 40%"></div>
            </div>
        </div>

        {{-- Timbangan Gudang --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-surface-container-highest text-on-surface rounded-xl shrink-0 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">inventory</span>
                </div>
                <span class="text-[9px] font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full">Stok Logistik</span>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Stok Timbangan Gudang</p>
            <h3 class="text-lg font-black text-on-surface mt-1 font-mono">{{ number_format($totalSampahGudang, 1, ',', '.') }} <span class="text-xs font-bold text-on-surface-variant/60">kg</span></h3>
            <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-on-surface-variant rounded-full" style="width: 60%"></div>
            </div>
        </div>
    </section>

    {{-- Quick Access & Information Grid --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- Main Quick Access & Visual Composition (2 Columns Span) --}}
        <div class="xl:col-span-2 space-y-6">
            {{-- Quick Access buttons --}}
            <div class="space-y-4">
                <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Akses Cepat Loket</h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="{{ route('admin.nasabah') }}" class="flex flex-col items-center justify-center p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-2xl hover:border-primary hover:text-primary transition-all group active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-2xl text-on-surface-variant group-hover:text-primary group-hover:scale-110 transition-all mb-2">person_add</span>
                        <span class="text-xs font-bold text-on-surface">Data Nasabah</span>
                    </a>
                    <a href="{{ route('admin.setoran') }}" class="flex flex-col items-center justify-center p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-2xl hover:border-primary hover:text-primary transition-all group active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-2xl text-on-surface-variant group-hover:text-primary group-hover:scale-110 transition-all mb-2">add_shopping_cart</span>
                        <span class="text-xs font-bold text-on-surface">Catat Setoran</span>
                    </a>
                    <a href="{{ route('admin.cashflow') }}" class="flex flex-col items-center justify-center p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-2xl hover:border-primary hover:text-primary transition-all group active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-2xl text-on-surface-variant group-hover:text-primary group-hover:scale-110 transition-all mb-2">receipt_long</span>
                        <span class="text-xs font-bold text-on-surface">Buku Kas</span>
                    </a>
                    <a href="{{ route('admin.gudang') }}" class="flex flex-col items-center justify-center p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-2xl hover:border-primary hover:text-primary transition-all group active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-2xl text-on-surface-variant group-hover:text-primary group-hover:scale-110 transition-all mb-2">equalizer</span>
                        <span class="text-xs font-bold text-on-surface">Stok &amp; Gudang</span>
                    </a>
                </div>
            </div>

            {{-- Visual Data Presentation (Stock) --}}
            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/30 shadow-xs">
                <div class="flex justify-between items-center mb-5">
                    <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Komposisi Stok Gudang</h4>
                    <a class="text-xs font-bold text-primary hover:underline" href="{{ route('admin.gudang') }}">Detail Gudang</a>
                </div>
                <div class="space-y-4">
                    {{-- Plastik --}}
                    <div class="flex items-center gap-4 text-xs">
                        <span class="w-24 text-on-surface-variant font-medium shrink-0">Botol Plastik</span>
                        <div class="flex-1 h-8 bg-surface-container rounded-xl overflow-hidden relative">
                            <div class="h-full bg-primary" style="width: 50%;"></div>
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-on-surface-variant">Kapasitas Sedang</span>
                        </div>
                    </div>
                    {{-- Kardus --}}
                    <div class="flex items-center gap-4 text-xs">
                        <span class="w-24 text-on-surface-variant font-medium shrink-0">Kardus / Karton</span>
                        <div class="flex-1 h-8 bg-surface-container rounded-xl overflow-hidden relative">
                            <div class="h-full bg-secondary" style="width: 35%;"></div>
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-on-surface-variant">Muatan Ringan</span>
                        </div>
                    </div>
                    {{-- Kaleng --}}
                    <div class="flex items-center gap-4 text-xs">
                        <span class="w-24 text-on-surface-variant font-medium shrink-0">Kaleng Logam</span>
                        <div class="flex-1 h-8 bg-surface-container rounded-xl overflow-hidden relative">
                            <div class="h-full bg-tertiary" style="width: 15%;"></div>
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-on-surface-variant">Minim</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Info Panel (1 Column Span) --}}
        <div class="space-y-6">
            <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Informasi Sistem</h4>
            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/30 shadow-xs space-y-6">
                {{-- Server status widget --}}
                <div class="bg-surface-container/50 border border-outline-variant/20 p-4 rounded-2xl flex gap-3.5 items-start">
                    <span class="material-symbols-outlined text-primary mt-0.5">verified_user</span>
                    <div class="text-xs">
                        <p class="font-bold text-on-surface">Status Server</p>
                        <p class="text-on-surface-variant/80 font-medium mt-0.5">Operasional Normal (99.9%)</p>
                    </div>
                </div>

                {{-- Stats breakdown --}}
                <div class="space-y-3.5 text-xs pb-4 border-b border-outline-variant/30">
                    <div class="flex justify-between items-center py-1">
                        <span class="text-on-surface-variant/80 font-medium">Total Nasabah Aktif</span>
                        <span class="font-extrabold text-on-surface">{{ $totalNasabah }} Warga</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-on-surface-variant/80 font-medium">Nasabah Baru Bulan Ini</span>
                        <span class="font-extrabold text-on-surface">{{ $nasabahBaruBulanIni }} Orang</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-on-surface-variant/80 font-medium">Framework Laravel</span>
                        <span class="font-bold text-on-surface font-mono">v{{ app()->version() }}</span>
                    </div>
                </div>

                {{-- Help buttons --}}
                <div class="space-y-2 text-xs">
                    <p class="font-bold text-on-surface-variant/70 uppercase tracking-wider text-[10px]">Bantuan &amp; Dukungan</p>
                    <button class="w-full flex items-center justify-between p-3.5 border border-outline-variant/30 rounded-xl hover:bg-surface-container transition-colors text-left cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-[18px]">help_center</span>
                            <span class="font-bold text-on-surface">Pusat Panduan</span>
                        </div>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                    </button>
                    <button class="w-full flex items-center justify-between p-3.5 border border-outline-variant/30 rounded-xl hover:bg-surface-container transition-colors text-left cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary text-[18px]">support_agent</span>
                            <span class="font-bold text-on-surface">Hubungi Dev</span>
                        </div>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                    </button>
                </div>

                {{-- Sustainability Tip --}}
                <div class="p-4 bg-tertiary-container/10 border border-tertiary-container/20 rounded-2xl space-y-3">
                    <div class="w-full h-24 rounded-xl bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBfRdtfKsNRW-znUflnDLrVsVvVrJp02KtHaACkTW03Yf5wJ45ohD1lR_l2H_WDu-RzKJVxRSxV82_hJK7Vt1oZT2SRSDJbTLyZmcMfxmSHYgcVHwPDXF_JWej6Ba_3cYfIbwwVTx39lLkh3THSAIHCQr3yE-4FFpfJ60RRxQGRmLhno5YzyO7RxSjgpjO8nOXauWIjOaCawF48fPPNNtT-EkIIOGppRJd1S6mUh3riRO2MHipg-t3E-ajkC4-kPNbnGmFL-KskRfs')"></div>
                    <p class="text-[10px] font-bold text-tertiary uppercase tracking-wider">Tips Berkelanjutan</p>
                    <p class="text-[11px] text-on-surface-variant leading-relaxed">
                        Pastikan harga harian sudah disesuaikan dengan nilai tukar pengepul pusat pagi ini untuk menjaga selisih laba internal ARUNA.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
