@extends('layouts.admin')

@section('title', 'Dashboard Utama')
@section('page-title', 'Dashboard Utama')

@section('content')
<div class="space-y-6">
    {{-- Hero Welcome Banner --}}
    <section data-reveal="flip" data-reveal-delay="50" class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-primary-container via-[#044e39] to-primary-container p-6 sm:p-8 text-white shadow-md tilt-card">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 float-bubble"></div>
        <div class="absolute bottom-0 left-1/3 w-40 h-40 bg-white/5 rounded-full translate-y-1/2 float-bubble-delay"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="space-y-3 text-center md:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-[11px] font-bold border border-white/15">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sistem ARUNA Online
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight" data-typewriter="Selamat Datang, Pengurus ARUNA! 👋" data-typewriter-speed="40">
                    Selamat Datang, Pengurus ARUNA! 👋
                </h1>
                <p class="text-xs sm:text-sm text-white/85 max-w-xl leading-relaxed">
                    Operasional Bank Sampah berjalan optimal hari ini. Kelola data nasabah, rekam setoran baru, dan validasi kas operasional dengan mudah dari satu dashboard terintegrasi.
                </p>
                <div class="flex flex-wrap gap-2.5 pt-2 justify-center md:justify-start">
                    <a href="{{ route('admin.setoran') }}" class="px-4 py-2.5 bg-emerald-400 hover:bg-emerald-300 text-emerald-950 rounded-xl text-xs font-extrabold transition-all shadow-md hover-elevate inline-flex items-center gap-1.5 cursor-pointer ripple-container">
                        <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                        Catat Setoran Baru
                    </a>
                    <a href="{{ route('admin.nasabah') }}" class="px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white border border-white/25 rounded-xl text-xs font-bold transition-all hover-elevate inline-flex items-center gap-1.5 cursor-pointer ripple-container">
                        <span class="material-symbols-outlined text-[18px]">group</span>
                        Kelola Nasabah
                    </a>
                </div>
            </div>
            <div class="hidden lg:block w-28 h-28 opacity-25 shrink-0 select-none spin-slow">
                <span class="material-symbols-outlined text-[112px]" style="font-variation-settings: 'FILL' 1;">eco</span>
            </div>
        </div>
    </section>

    {{-- Key Metric Bento Grid --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-stagger="100">
        {{-- Total Omset --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover-elevate transition-all tilt-card ripple-container" data-glow>
            <div class="flex justify-between items-start mb-4">
                <div class="p-2.5 bg-secondary-container rounded-xl text-on-secondary-container shrink-0 flex items-center justify-center magnetic-hover">
                    <span class="material-symbols-outlined text-[22px]">trending_up</span>
                </div>
                <span class="text-[9px] font-bold text-teal-700 bg-teal-500/10 border border-teal-500/20 px-2.5 py-0.5 rounded-full">Di Gudang</span>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Total Omset Berjalan</p>
            <h3 class="text-lg font-black text-on-surface mt-1 font-mono data-glow">
                Rp <span data-count="{{ $totalOmsetBerjalan }}" data-count-duration="1500">{{ number_format($totalOmsetBerjalan, 0, ',', '.') }}</span>
            </h3>
            <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-secondary rounded-full transition-all duration-1000" style="width: 75%"></div>
            </div>
        </div>

        {{-- Dana Titipan --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover-elevate transition-all tilt-card ripple-container" data-glow>
            <div class="flex justify-between items-start mb-4">
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl shrink-0 flex items-center justify-center magnetic-hover">
                    <span class="material-symbols-outlined text-[22px]">savings</span>
                </div>
                <span class="text-[9px] font-bold text-rose-600 bg-rose-500/10 border border-rose-500/20 px-2.5 py-0.5 rounded-full">Liabilitas</span>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Dana Titipan Nasabah</p>
            <h3 class="text-lg font-black text-on-surface mt-1 font-mono data-glow">
                Rp <span data-count="{{ $totalDanaTitipanWarga }}" data-count-duration="1700">{{ number_format($totalDanaTitipanWarga, 0, ',', '.') }}</span>
            </h3>
            <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-primary rounded-full transition-all duration-1000" style="width: 80%"></div>
            </div>
        </div>

        {{-- Sisa Kas --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover-elevate transition-all tilt-card ripple-container" data-glow>
            <div class="flex justify-between items-start mb-4">
                <div class="p-2.5 bg-tertiary-container/30 text-tertiary rounded-xl shrink-0 flex items-center justify-center magnetic-hover">
                    <span class="material-symbols-outlined text-[22px]">account_balance</span>
                </div>
                <span class="text-[9px] font-bold text-emerald-600 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-0.5 rounded-full">Kas Bersih</span>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Sisa Kas Operasional</p>
            <h3 class="text-lg font-black text-on-surface mt-1 font-mono data-glow">
                Rp <span data-count="{{ $sisaKasPengelola }}" data-count-duration="1900">{{ number_format($sisaKasPengelola, 0, ',', '.') }}</span>
            </h3>
            <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-tertiary rounded-full transition-all duration-1000" style="width: 40%"></div>
            </div>
        </div>

        {{-- Timbangan Gudang --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-xs hover-elevate transition-all tilt-card ripple-container" data-glow>
            <div class="flex justify-between items-start mb-4">
                <div class="p-2.5 bg-surface-container-highest text-on-surface rounded-xl shrink-0 flex items-center justify-center magnetic-hover">
                    <span class="material-symbols-outlined text-[22px]">inventory</span>
                </div>
                <span class="text-[9px] font-bold text-sky-600 bg-sky-500/10 border border-sky-500/20 px-2.5 py-0.5 rounded-full">Stok Logistik</span>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider">Stok Timbangan Gudang</p>
            <h3 class="text-lg font-black text-on-surface mt-1 font-mono data-glow">
                <span data-count="{{ $totalSampahGudang }}" data-count-decimals="1" data-count-duration="1600">{{ number_format($totalSampahGudang, 1, ',', '.') }}</span> <span class="text-xs font-bold text-on-surface-variant/60">kg</span>
            </h3>
            <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-on-surface-variant rounded-full transition-all duration-1000" style="width: 60%"></div>
            </div>
        </div>
    </section>

    {{-- Quick Access & Information Grid --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- Main Quick Access & Visual Composition (2 Columns Span) --}}
        <div class="xl:col-span-2 space-y-6" data-reveal data-reveal-delay="200">
            {{-- Quick Access buttons --}}
            <div class="space-y-4">
                <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Akses Cepat Loket</h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4" data-stagger="60">
                    <a href="{{ route('admin.nasabah') }}" class="flex flex-col items-center justify-center p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-2xl hover:border-primary hover:text-primary transition-all group hover-elevate ripple-container tilt-card" data-glow>
                        <div class="p-3 bg-primary/10 rounded-2xl mb-2.5 group-hover:bg-primary group-hover:text-on-primary transition-colors duration-300 magnetic-hover">
                            <span class="material-symbols-outlined text-2xl text-primary group-hover:text-white transition-all">person_add</span>
                        </div>
                        <span class="text-xs font-bold text-on-surface group-hover:text-primary transition-colors">Data Nasabah</span>
                    </a>
                    <a href="{{ route('admin.setoran') }}" class="flex flex-col items-center justify-center p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-2xl hover:border-primary hover:text-primary transition-all group hover-elevate ripple-container tilt-card" data-glow>
                        <div class="p-3 bg-emerald-500/10 rounded-2xl mb-2.5 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300 magnetic-hover">
                            <span class="material-symbols-outlined text-2xl text-emerald-600 group-hover:text-white transition-all">add_shopping_cart</span>
                        </div>
                        <span class="text-xs font-bold text-on-surface group-hover:text-primary transition-colors">Catat Setoran</span>
                    </a>
                    <a href="{{ route('admin.cashflow') }}" class="flex flex-col items-center justify-center p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-2xl hover:border-primary hover:text-primary transition-all group hover-elevate ripple-container tilt-card" data-glow>
                        <div class="p-3 bg-secondary-container/50 rounded-2xl mb-2.5 group-hover:bg-secondary group-hover:text-white transition-colors duration-300 magnetic-hover">
                            <span class="material-symbols-outlined text-2xl text-secondary group-hover:text-white transition-all">receipt_long</span>
                        </div>
                        <span class="text-xs font-bold text-on-surface group-hover:text-primary transition-colors">Buku Kas</span>
                    </a>
                    <a href="{{ route('admin.gudang') }}" class="flex flex-col items-center justify-center p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-2xl hover:border-primary hover:text-primary transition-all group hover-elevate ripple-container tilt-card" data-glow>
                        <div class="p-3 bg-tertiary-container/40 rounded-2xl mb-2.5 group-hover:bg-tertiary-container group-hover:text-white transition-colors duration-300 magnetic-hover">
                            <span class="material-symbols-outlined text-2xl text-tertiary group-hover:text-white transition-all">equalizer</span>
                        </div>
                        <span class="text-xs font-bold text-on-surface group-hover:text-primary transition-colors">Stok &amp; Gudang</span>
                    </a>
                </div>
            </div>

            {{-- Visual Data Presentation (Stock) --}}
            <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 shadow-xs hover-elevate transition-all tilt-card" data-glow>
                <div class="flex justify-between items-center mb-5">
                    <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Komposisi Stok Gudang</h4>
                    <a class="text-xs font-bold text-primary hover:underline flex items-center gap-1" href="{{ route('admin.gudang') }}">
                        Detail Gudang <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </a>
                </div>
                <div class="space-y-4">
                    {{-- Plastik --}}
                    <div class="flex items-center gap-4 text-xs">
                        <span class="w-24 text-on-surface-variant font-medium shrink-0">Botol Plastik</span>
                        <div class="flex-1 h-8 bg-surface-container rounded-xl overflow-hidden relative">
                            <div class="h-full bg-primary transition-all duration-1000" style="width: 50%;"></div>
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-on-surface-variant">Kapasitas Sedang</span>
                        </div>
                    </div>
                    {{-- Kardus --}}
                    <div class="flex items-center gap-4 text-xs">
                        <span class="w-24 text-on-surface-variant font-medium shrink-0">Kardus / Karton</span>
                        <div class="flex-1 h-8 bg-surface-container rounded-xl overflow-hidden relative">
                            <div class="h-full bg-secondary transition-all duration-1000" style="width: 35%;"></div>
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-on-surface-variant">Muatan Ringan</span>
                        </div>
                    </div>
                    {{-- Kaleng --}}
                    <div class="flex items-center gap-4 text-xs">
                        <span class="w-24 text-on-surface-variant font-medium shrink-0">Kaleng Logam</span>
                        <div class="flex-1 h-8 bg-surface-container rounded-xl overflow-hidden relative">
                            <div class="h-full bg-tertiary transition-all duration-1000" style="width: 15%;"></div>
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-on-surface-variant">Minim</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Info Panel (1 Column Span) --}}
        <div class="space-y-6" data-reveal="right" data-reveal-delay="300">
            <h4 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Informasi Sistem</h4>
            <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 shadow-xs space-y-6 hover-elevate transition-all tilt-card" data-glow>
                {{-- Server status widget --}}
                <div class="bg-surface-container/50 border border-outline-variant/20 p-4 rounded-2xl flex gap-3.5 items-start">
                    <span class="material-symbols-outlined text-primary mt-0.5 animate-pulse">verified_user</span>
                    <div class="text-xs">
                        <p class="font-bold text-on-surface">Status Server</p>
                        <p class="text-on-surface-variant/80 font-medium mt-0.5">Operasional Normal (99.9%)</p>
                    </div>
                </div>

                {{-- Stats breakdown --}}
                <div class="space-y-3.5 text-xs pb-4 border-b border-outline-variant/30">
                    <div class="flex justify-between items-center py-1">
                        <span class="text-on-surface-variant/80 font-medium">Total Nasabah Aktif</span>
                        <span class="font-extrabold text-on-surface font-mono"><span data-count="{{ $totalNasabah }}">{{ $totalNasabah }}</span> Warga</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-on-surface-variant/80 font-medium">Nasabah Baru Bulan Ini</span>
                        <span class="font-extrabold text-on-surface font-mono">+<span data-count="{{ $nasabahBaruBulanIni }}">{{ $nasabahBaruBulanIni }}</span> Orang</span>
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
