@extends('layouts.admin')

@section('title', 'Buku Tabungan Nasabah')
@section('page-title', 'Buku Tabungan')
@section('page-subtitle', 'Histori mutasi keuangan tabungan nasabah ARUNA')

@section('content')
<div class="space-y-6">
    {{-- Header Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-6 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-emerald-500/20">
                {{ strtoupper(substr($nasabah->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-base font-extrabold text-gray-900">{{ $nasabah->name }}</h2>
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-400 mt-1">
                    <span class="font-bold text-emerald-600 font-mono">{{ $nasabah->no_id }}</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-250"></span>
                    <span class="font-mono">KK: {{ $nasabah->kk_number }}</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-250"></span>
                    <span>HP: {{ $nasabah->phone_number ?? '-' }}</span>
                </div>
            </div>
        </div>
        
        <div class="bg-emerald-50/50 border border-emerald-100/80 rounded-2xl px-6 py-4 flex flex-col justify-center min-w-[200px] shrink-0 text-right md:text-right">
            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Saldo Tabungan Saat Ini</span>
            <span class="text-2xl font-black text-emerald-700 font-mono mt-1">Rp {{ number_format($nasabah->total_tabungan, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Main transaction table --}}
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-[14px] font-bold text-gray-900">Catatan Mutasi Tabungan</h3>
            <a href="{{ route('admin.nasabah') }}" class="text-[12px] font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-50">
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tanggal Transaksi</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Jenis Aliran</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nominal</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Saldo Berjalan</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transactions as $tx)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-xs font-semibold text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-xs text-gray-500 font-mono">{{ $tx->created_at->translatedFormat('d M Y - H:i') }} WIB</td>
                            <td class="px-6 py-4 text-xs">
                                @if($tx->jenis_transaksi === 'masuk')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 border border-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Masuk / Setoran
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 border border-red-100 text-red-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Keluar / Penarikan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-bold font-mono {{ $tx->jenis_transaksi === 'masuk' ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $tx->jenis_transaksi === 'masuk' ? '+' : '-' }} Rp {{ number_format($tx->nominal, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-gray-900 font-mono">Rp {{ number_format($tx->saldo_terakhir, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-xs text-gray-600 leading-relaxed max-w-[300px] truncate" title="{{ $tx->keterangan }}">{{ $tx->keterangan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                    <p class="text-[13px] font-semibold text-gray-500 mb-1">Belum ada mutasi transaksi</p>
                                    <p class="text-[12px] text-gray-400">Transaksi setoran sampah atau tarik tunai akan tercatat di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
