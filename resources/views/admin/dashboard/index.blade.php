@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data dan aktivitas ARUNA')

@section('content')

    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-600 rounded-2xl p-6 sm:p-8 mb-8 relative overflow-hidden shadow-md">
        {{-- Decorative elements --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-1/2 w-48 h-48 bg-white/5 rounded-full translate-y-1/2"></div>
        <div class="absolute top-4 right-12 w-20 h-20 bg-white/5 rounded-full"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-2">
                <span class="text-emerald-200 text-[13px] font-medium font-sans">👋 Selamat datang kembali,</span>
            </div>
            <h2 class="text-white text-xl sm:text-2xl font-bold mb-1">Administrator ARUNA</h2>
            <p class="text-emerald-100/70 text-xs sm:text-sm max-w-lg leading-relaxed">
                Kelola data bank sampah Anda dari sini secara terintegrasi. Pantau data nasabah, keuangan, stok logistik, dan kas kantor.
            </p>
        </div>
    </div>

    {{-- Stats Cards (3 Financial Cards + 1 General/Stok Card) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">

        {{-- Omset Berjalan --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-lg hover:shadow-gray-100/50 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-650 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 border border-teal-100/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[22px] h-[22px]" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
                <span class="text-[9.5px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-full">Di Gudang</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-gray-900 mb-1 font-mono">Rp {{ number_format($totalOmsetBerjalan, 0, ',', '.') }}</div>
            <div class="text-[12px] text-gray-400 font-bold uppercase tracking-wider">Total Omset Berjalan</div>
        </div>

        {{-- Total Dana Titipan Warga --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-lg hover:shadow-gray-100/50 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-rose-50 text-rose-605 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 border border-rose-100/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[22px] h-[22px]" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <span class="text-[9.5px] font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full">Liabilitas</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-gray-900 mb-1 font-mono">Rp {{ number_format($totalDanaTitipanWarga, 0, ',', '.') }}</div>
            <div class="text-[12px] text-gray-400 font-bold uppercase tracking-wider">Dana Titipan Warga</div>
        </div>

        {{-- Sisa Kas Pengelola --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-lg hover:shadow-gray-100/50 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-605 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 border border-emerald-100/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[22px] h-[22px]" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                    </svg>
                </div>
                <span class="text-[9.5px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">Kas Bersih</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-gray-900 mb-1 font-mono">Rp {{ number_format($sisaKasPengelola, 0, ',', '.') }}</div>
            <div class="text-[12px] text-gray-400 font-bold uppercase tracking-wider">Sisa Kas Pengelola</div>
        </div>

        {{-- Stok Timbangan Gudang --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-lg hover:shadow-gray-100/50 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-605 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 border border-blue-100/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[22px] h-[22px]" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                </div>
                <span class="text-[9.5px] font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full">Stok Logistik</span>
            </div>
            <div class="text-xl sm:text-2xl font-black text-gray-900 mb-1 font-mono">{{ number_format($totalSampahGudang, 1, ',', '.') }} <span class="text-xs font-bold text-gray-400">kg</span></div>
            <div class="text-[12px] text-gray-400 font-bold uppercase tracking-wider">Timbangan di Gudang</div>
        </div>

    </div>

    {{-- Quick Access & Stats --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Akses Cepat --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:col-span-2">
            <h3 class="text-[15px] font-bold text-gray-900 mb-5 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>
                Akses Cepat Loket ARUNA
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                
                {{-- Data Nasabah --}}
                <a href="{{ route('admin.nasabah') }}" class="flex flex-col gap-2 p-4 rounded-2xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[13px] font-extrabold text-gray-800">Nasabah</div>
                        <div class="text-[11px] text-gray-400 mt-0.5">Kelola data warga</div>
                    </div>
                </a>

                {{-- Input Setoran --}}
                <a href="{{ route('admin.setoran') }}" class="flex flex-col gap-2 p-4 rounded-2xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[13px] font-extrabold text-gray-800">Setor Sampah</div>
                        <div class="text-[11px] text-gray-400 mt-0.5">Input timbangan</div>
                    </div>
                </a>

                {{-- Gudang --}}
                <a href="{{ route('admin.gudang') }}" class="flex flex-col gap-2 p-4 rounded-2xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-650 flex items-center justify-center shrink-0 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[13px] font-extrabold text-gray-800">Stok & Gudang</div>
                        <div class="text-[11px] text-gray-400 mt-0.5">Jual ke pengepul</div>
                    </div>
                </a>

                {{-- Tarik Tunai --}}
                <a href="{{ route('admin.penarikan') }}" class="flex flex-col gap-2 p-4 rounded-2xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[13px] font-extrabold text-gray-800">Tarik Tunai</div>
                        <div class="text-[11px] text-gray-400 mt-0.5">Pencairan saldo</div>
                    </div>
                </a>

                {{-- Buku Kas internal --}}
                <a href="{{ route('admin.cashflow') }}" class="flex flex-col gap-2 p-4 rounded-2xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[13px] font-extrabold text-gray-800">Kas Kantor</div>
                        <div class="text-[11px] text-gray-400 mt-0.5">Buku kas internal</div>
                    </div>
                </a>

                {{-- Master Harga --}}
                <a href="{{ route('admin.harga') }}" class="flex flex-col gap-2 p-4 rounded-2xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-9 h-9 rounded-xl bg-violet-50 text-violet-650 flex items-center justify-center shrink-0 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.43l-1.003.828c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.43l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.645-.869L9.594 3.94ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[13px] font-extrabold text-gray-800">Master Harga</div>
                        <div class="text-[11px] text-gray-400 mt-0.5">Konfigurasi nilai rupiah</div>
                    </div>
                </a>

            </div>
        </div>

        {{-- Info Sistem --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="text-[15px] font-bold text-gray-900 mb-5 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                </svg>
                Informasi Sistem
            </h3>
            <div class="space-y-3.5">
                <div class="flex items-center justify-between py-2 border-b border-gray-50">
                    <span class="text-[13px] text-gray-500 font-medium">Total Nasabah Aktif</span>
                    <span class="text-[13px] font-bold text-gray-800 bg-gray-50 px-2.5 py-0.5 rounded-lg font-mono">{{ $totalNasabah ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-gray-50">
                    <span class="text-[13px] text-gray-500 font-medium">Nasabah Baru Bulan Ini</span>
                    <span class="text-[13px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-lg font-mono">{{ $nasabahBaruBulanIni ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-gray-50">
                    <span class="text-[13px] text-gray-500 font-medium">Framework Laravel</span>
                    <span class="text-[13px] font-bold text-gray-800 bg-gray-50 px-2.5 py-0.5 rounded-lg">v{{ app()->version() }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-[13px] text-gray-500 font-medium">Login Sebagai</span>
                    <span class="text-[13px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-lg select-all truncate max-w-[130px]" title="{{ Auth::guard('admin')->user()->email ?? '' }}">{{ Auth::guard('admin')->user()->email ?? '' }}</span>
                </div>
            </div>
        </div>

    </div>

@endsection
