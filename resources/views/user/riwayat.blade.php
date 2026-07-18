@extends('layouts.nasabah')
@section('title', 'Riwayat Transaksi')
@section('meta-description', 'Riwayat lengkap transaksi tabungan sampah Anda di ARUNA.')
@section('page-title', 'Riwayat Transaksi')

@section('content')
{{-- Header Hero --}}
<div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-600 rounded-2xl p-6 text-white relative overflow-hidden shadow-sm mb-6">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
    <div class="relative z-10">
        <span class="text-emerald-200 text-xs font-semibold uppercase tracking-wider block mb-1">Rekam Jejak Keuangan</span>
        <h2 class="text-2xl font-black">Riwayat Transaksi</h2>
        <p class="text-emerald-100/70 text-sm mt-1">Semua mutasi masuk dan keluar pada rekening tabungan Anda.</p>
    </div>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white border border-neutral-100 p-5 rounded-2xl shadow-xs">
        <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Saldo Berjalan</div>
        <div class="text-xl font-black text-emerald-700 font-mono">Rp {{ number_format(\->total_tabungan, 0, ',', '.') }}</div>
    </div>
    <div class="bg-white border border-emerald-100 p-5 rounded-2xl shadow-xs">
        <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Total Masuk</div>
        <div class="text-xl font-black text-emerald-600 font-mono">+ Rp {{ number_format(\, 0, ',', '.') }}</div>
    </div>
    <div class="bg-white border border-rose-100 p-5 rounded-2xl shadow-xs">
        <div class="text-[10px] text-neutral-400 font-bold mb-1 uppercase tracking-wider">Total Keluar</div>
        <div class="text-xl font-black text-rose-600 font-mono">- Rp {{ number_format(\, 0, ',', '.') }}</div>
    </div>
</div>

{{-- Transaction Table --}}
<div class="bg-white rounded-2xl border border-neutral-100 shadow-xs overflow-hidden">
    <div class="px-6 py-4 border-b border-neutral-100 flex items-center justify-between">
        <h3 class="text-xs font-bold text-neutral-450 uppercase tracking-wider">Daftar Mutasi Transaksi</h3>
        <span class="text-[10px] text-neutral-400 font-mono">{{ \->total() }} entri</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-neutral-50 text-[10px] text-neutral-400 uppercase tracking-wider bg-neutral-50/50">
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Jenis</th>
                    <th class="px-6 py-3">Nominal</th>
                    <th class="px-6 py-3">Saldo Akhir</th>
                    <th class="px-6 py-3">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-50 text-xs">
                @forelse(\ as \)
                    <tr class="hover:bg-neutral-50/60 transition-colors">
                        <td class="px-6 py-3.5 text-neutral-500 font-mono whitespace-nowrap">{{ \->created_at->translatedFormat('d M Y') }}<br><span class="text-[9px] text-neutral-300">{{ \->created_at->format('H:i') }} WIB</span></td>
                        <td class="px-6 py-3.5">
                            @if(\->jenis_transaksi === 'masuk')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>Masuk
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-bold bg-rose-50 text-rose-700 border border-rose-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 inline-block"></span>Keluar
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3.5 font-bold font-mono {{ \->jenis_transaksi === 'masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ \->jenis_transaksi === 'masuk' ? '+' : '-' }} Rp {{ number_format(\->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-3.5 font-bold text-neutral-700 font-mono">Rp {{ number_format(\->saldo_terakhir, 0, ',', '.') }}</td>
                        <td class="px-6 py-3.5 text-neutral-500 max-w-[200px] truncate" title="\{{ \->keterangan }}">{{ \->keterangan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-14 text-center">
                            <div class="flex flex-col items-center gap-2 text-neutral-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-neutral-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="text-sm font-semibold">Belum ada transaksi tercatat.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(\->hasPages())
        <div class="px-6 py-4 border-t border-neutral-100">
            {{ \->links() }}
        </div>
    @endif
</div>
@endsection
