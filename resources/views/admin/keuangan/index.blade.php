@extends('layouts.admin')

@section('title', 'Data Keuangan')
@section('page-title', 'Data Keuangan')
@section('page-subtitle', 'Laporan keuangan dan transaksi ARUNA')

@section('content')

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Laporan Keuangan</h2>
            <p class="text-[13px] text-gray-400 mt-0.5">Data transaksi dan keuangan ARUNA</p>
        </div>

        {{-- Filter --}}
        <div class="flex items-center gap-3">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                <select class="h-10 w-full sm:w-48 pl-9 pr-4 rounded-xl border border-gray-200 text-[13px] text-gray-600 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all duration-200 bg-white appearance-none cursor-pointer">
                    <option>Semua Periode</option>
                    <option>Bulan Ini</option>
                    <option>Bulan Lalu</option>
                    <option>3 Bulan Terakhir</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Finance Overview Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        {{-- Total Pemasukan --}}
        <div class="bg-white rounded-xl border border-gray-100 px-5 py-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
                <div class="text-[11px] text-gray-400 font-semibold uppercase tracking-wider">Total Pemasukan</div>
            </div>
            <div class="text-xl font-extrabold text-gray-900">Rp 0</div>
        </div>

        {{-- Total Pengeluaran --}}
        <div class="bg-white rounded-xl border border-gray-100 px-5 py-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                    </svg>
                </div>
                <div class="text-[11px] text-gray-400 font-semibold uppercase tracking-wider">Total Pengeluaran</div>
            </div>
            <div class="text-xl font-extrabold text-gray-900">Rp 0</div>
        </div>

        {{-- Saldo ARUNA --}}
        <div class="bg-white rounded-xl border border-gray-100 px-5 py-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>
                </div>
                <div class="text-[11px] text-gray-400 font-semibold uppercase tracking-wider">Saldo Kas</div>
            </div>
            <div class="text-xl font-extrabold text-gray-900">Rp 0</div>
        </div>

        {{-- Total Transaksi --}}
        <div class="bg-white rounded-xl border border-gray-100 px-5 py-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>
                <div class="text-[11px] text-gray-400 font-semibold uppercase tracking-wider">Total Transaksi</div>
            </div>
            <div class="text-xl font-extrabold text-gray-900">0</div>
        </div>
    </div>

    {{-- Transaction Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        {{-- Table Header --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-[14px] font-bold text-gray-900">Riwayat Transaksi</h3>
            <span class="text-[11px] text-gray-400 font-medium bg-gray-50 px-2.5 py-1 rounded-lg">0 transaksi</span>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-50">
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nasabah</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    {{-- Empty state --}}
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                    </svg>
                                </div>
                                <p class="text-[13px] font-semibold text-gray-500 mb-1">Belum ada transaksi</p>
                                <p class="text-[12px] text-gray-400">Data transaksi keuangan akan tampil di sini.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
