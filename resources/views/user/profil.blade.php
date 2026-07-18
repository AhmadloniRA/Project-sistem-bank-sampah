@extends('layouts.nasabah')
@section('title', 'Profil Saya')
@section('meta-description', 'Profil dan informasi akun nasabah ARUNA.')
@section('page-title', 'Profil Saya')

@section('content')
{{-- Hero Banner --}}
<div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-600 rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden shadow-sm mb-6">
    <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
    <div class="relative z-10 flex flex-col sm:flex-row sm:items-center gap-5">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-extrabold text-white shadow-xl" style="background: rgba(255,255,255,0.15);">
            {{ strtoupper(substr(\->name, 0, 1)) }}
        </div>
        <div>
            <span class="text-emerald-200 text-xs font-semibold uppercase tracking-wider block mb-1">Nasabah ARUNA</span>
            <h2 class="text-2xl font-black">{{ \->name }}</h2>
            <span class="text-emerald-200 text-xs font-mono font-bold">{{ \->no_id }}</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Info Utama --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-neutral-100 shadow-xs overflow-hidden">
        <div class="px-6 py-4 border-b border-neutral-100">
            <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-wider">Informasi Akun</h3>
        </div>
        <div class="divide-y divide-neutral-50">
            <div class="px-6 py-4 flex items-start gap-4">
                <span class="w-28 text-[11px] font-bold text-neutral-400 uppercase tracking-wider shrink-0 pt-0.5">Nama Lengkap</span>
                <span class="text-sm font-semibold text-neutral-800">{{ \->name }}</span>
            </div>
            <div class="px-6 py-4 flex items-start gap-4">
                <span class="w-28 text-[11px] font-bold text-neutral-400 uppercase tracking-wider shrink-0 pt-0.5">ID Nasabah</span>
                <span class="text-sm font-bold font-mono text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-lg">{{ \->no_id }}</span>
            </div>
            <div class="px-6 py-4 flex items-start gap-4">
                <span class="w-28 text-[11px] font-bold text-neutral-400 uppercase tracking-wider shrink-0 pt-0.5">No. KK</span>
                <span class="text-sm font-mono text-neutral-600">{{ \->kk_number ?? '-' }}</span>
            </div>
            <div class="px-6 py-4 flex items-start gap-4">
                <span class="w-28 text-[11px] font-bold text-neutral-400 uppercase tracking-wider shrink-0 pt-0.5">No. Telepon</span>
                <span class="text-sm text-neutral-600">{{ \->phone_number ?? '-' }}</span>
            </div>
            <div class="px-6 py-4 flex items-start gap-4">
                <span class="w-28 text-[11px] font-bold text-neutral-400 uppercase tracking-wider shrink-0 pt-0.5">Status</span>
                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200/60">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                    Aktif Terdaftar
                </span>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="space-y-4">
        <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-xs">
            <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Saldo Tabungan</div>
            <div class="text-xl font-black text-emerald-700 font-mono">Rp {{ number_format(\->total_tabungan, 0, ',', '.') }}</div>
        </div>
        <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-xs">
            <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Total Sampah Disetor</div>
            <div class="text-xl font-black text-emerald-700 font-mono">{{ number_format(\, 1, ',', '.') }} <span class="text-xs font-bold text-gray-400">kg</span></div>
        </div>
        <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-xs">
            <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Total Transaksi</div>
            <div class="text-xl font-black text-emerald-700 font-mono">{{ \ }} <span class="text-xs font-bold text-gray-400">transaksi</span></div>
        </div>
        <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-xs">
            <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Bergabung Sejak</div>
            <div class="text-sm font-bold text-neutral-700 font-mono">{{ \->created_at->translatedFormat('d M Y') }}</div>
        </div>
    </div>
</div>
@endsection
