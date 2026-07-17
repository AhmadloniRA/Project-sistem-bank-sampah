@extends('layouts.admin')

@section('title', 'Buku Kas internal')
@section('page-title', 'Buku Kas Internal Pengelola')
@section('page-subtitle', 'Akuntansi finansial dana operasional dan keuntungan bersih ARUNA')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Form Input --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:col-span-2">
        <h3 class="text-sm font-bold text-gray-900 mb-5 flex items-center gap-2 pb-3 border-b border-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Catat Pengeluaran / Aliran Kas Manual
        </h3>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between" x-data="{ show: true }" x-show="show">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75 7.5 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75 7.5 0 10-1.06 1.061l2.5 2.5a.75 7.5 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center justify-between" x-data="{ show: true }" x-show="show">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-rose-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
                <button @click="show = false" class="text-rose-500 hover:text-rose-700 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        <form action="{{ route('admin.cashflow.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Jenis Aliran --}}
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Jenis Aliran Dana</label>
                    <select name="jenis_aliran" required
                            class="w-full h-11 px-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all bg-white cursor-pointer text-gray-700">
                        <option value="keluar" selected>Dana Keluar (Operasional/Beban)</option>
                        <option value="masuk">Dana Masuk (Penghasilan Custom/Lainnya)</option>
                    </select>
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Kategori Kas</label>
                    <select name="kategori" required
                            class="w-full h-11 px-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all bg-white cursor-pointer text-gray-700">
                        <option value="operasional_bensin" selected>Operasional Bensin</option>
                        <option value="atk">ATK / Nota Penjualan</option>
                        <option value="perawatan_alat">Perawatan Alat / Timbangan</option>
                        <option value="keuntungan_bersih">Hasil Margin Sampah</option>
                        <option value="lain_lain">Lain-lain / Pengeluaran Tak Terduga</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                {{-- Nominal --}}
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nominal Uang (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400 select-none">Rp</span>
                        <input type="number" name="nominal" required placeholder="Contoh: 15000" min="100"
                               class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all font-mono font-bold text-gray-800 placeholder-gray-400">
                    </div>
                </div>
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Catatan Detail (Keterangan)</label>
                <textarea name="keterangan" rows="3" required placeholder="Masukkan detail peruntukan dana, contoh: 'Beli bensin armada motor roda tiga untuk penjemputan RW 02'..."
                          class="w-full p-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all resize-none placeholder-gray-400"></textarea>
            </div>

            <div class="pt-3 border-t border-gray-50 flex items-center justify-end">
                <button type="submit" class="h-11 px-6 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-emerald-600/15 cursor-pointer border border-transparent">
                    Simpan Riwayat Kas
                </button>
            </div>
        </form>
    </div>

    {{-- Balance Widget --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between h-72 lg:h-auto">
        <div>
            <h3 class="text-sm font-bold text-gray-900 mb-5 flex items-center gap-2 pb-3 border-b border-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15" />
                </svg>
                Saldo Kas internal
            </h3>

            <div class="bg-emerald-50/50 border border-emerald-100/50 p-6 rounded-2xl text-right">
                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block">Sisa Anggaran Operasional</span>
                <span class="text-2xl font-black text-emerald-700 font-mono mt-1 block">Rp {{ number_format($sisaSaldo, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="mt-6 text-[10.5px] leading-relaxed text-gray-400 bg-gray-50 p-4 rounded-xl border border-gray-150">
            * Kas Internal Pengelola terisi <strong>secara otomatis</strong> ketika admin melakukan "Konfirmasi Penjualan" di Page Gudang (berupa keuntungan margin penjualan). Pengeluaran dicatat secara manual di form kiri.
        </div>
    </div>

</div>

{{-- Cashflow Log table --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mt-6">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-[14px] font-bold text-gray-900">Jurnal Arus Kas Internal Pengelola</h3>
        <span class="text-[11px] text-gray-400 font-medium bg-gray-50 px-2.5 py-1 rounded-lg">{{ $cashflows->count() }} transaksi</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-gray-50">
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tanggal Input</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Arah Aliran</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nominal</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kas Berjalan</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Keterangan Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($cashflows as $cf)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-xs font-semibold text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-xs text-gray-500 font-mono">{{ $cf->created_at->translatedFormat('d M Y - H:i') }} WIB</td>
                        <td class="px-6 py-4 text-xs">
                            @if($cf->jenis_aliran === 'masuk')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 border border-emerald-100 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Masuk (Keuntungan)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 border border-amber-100 text-amber-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Keluar (Operasional)
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-700 font-semibold">
                            @if($cf->kategori === 'operasional_bensin')
                                Bensin Armada
                            @elseif($cf->kategori === 'atk')
                                ATK Kantor
                            @elseif($cf->kategori === 'perawatan_alat')
                                Servis Alat
                            @elseif($cf->kategori === 'keuntungan_bersih')
                                Profit Bersih Sampah
                            @else
                                Lain-lain
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs font-bold font-mono {{ $cf->jenis_aliran === 'masuk' ? 'text-emerald-600' : 'text-amber-600' }}">
                            {{ $cf->jenis_aliran === 'masuk' ? '+' : '-' }} Rp {{ number_format($cf->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-gray-900 font-mono">Rp {{ number_format($cf->sisa_saldo_kas, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-xs text-gray-600 leading-relaxed max-w-[250px] truncate" title="{{ $cf->keterangan }}">{{ $cf->keterangan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3" />
                                    </svg>
                                </div>
                                <p class="text-[13px] font-semibold text-gray-500 mb-1">Belum ada riwayat transaksi kas internal</p>
                                <p class="text-[12px] text-gray-400">Arus kas masuk atau pengeluaran operasional akan tercatat di sini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
