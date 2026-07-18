@extends('layouts.admin')

@section('title', 'Setor Sampah')
@section('page-title', 'Input Setoran Sampah')
@section('page-subtitle', 'Pencatatan timbangan sampah harian loket ARUNA')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Form Input --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:col-span-2">
        <h3 class="text-sm font-bold text-gray-900 mb-5 flex items-center gap-2 pb-3 border-b border-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Form Setoran Sampah Nasabah
        </h3>

        <form action="{{ route('admin.setoran.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Nomor Rekening --}}
            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">No. Rekening Nasabah (No. ID)</label>
                <div class="relative">
                    <input type="text" name="no_id" required value="{{ old('no_id') }}" placeholder="Format: BS-2026-xxx"
                           class="w-full h-11 pl-4 pr-12 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all font-mono placeholder-gray-400">
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">Cari atau masukkan nomor ID yang tercantum di kartu nasabah.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Jenis Sampah --}}
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Jenis Sampah</label>
                    <select name="jenis_sampah" required
                            class="w-full h-11 px-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all bg-white cursor-pointer text-gray-700">
                        <option value="" disabled selected>Pilih kategori...</option>
                        <option value="botol plastik" {{ old('jenis_sampah') === 'botol plastik' ? 'selected' : '' }}>Botol Plastik</option>
                        <option value="kardus" {{ old('jenis_sampah') === 'kardus' ? 'selected' : '' }}>Kardus</option>
                        <option value="kaleng" {{ old('jenis_sampah') === 'kaleng' ? 'selected' : '' }}>Kaleng</option>
                    </select>
                </div>

                {{-- Berat --}}
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Timbangan (Berat dalam kg)</label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0.01" name="berat_kg" required value="{{ old('berat_kg') }}" placeholder="Contoh: 4.5"
                               class="w-full h-11 pl-4 pr-12 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all font-mono placeholder-gray-400">
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400 select-none">
                            KG
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-3 border-t border-gray-50 flex items-center justify-end">
                <button type="submit" class="h-11 px-6 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-emerald-600/15 cursor-pointer">
                    Simpan Setoran & Tambah Saldo
                </button>
            </div>
        </form>
    </div>

    {{-- Price Master Widget --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
        <div>
            <h3 class="text-sm font-bold text-gray-900 mb-5 flex items-center gap-2 pb-3 border-b border-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.562 7.995C9.005 8.312 8.466 8.72 7.995 9.2a9.38 9.38 0 0 0-2.625.372 9.337 9.337 0 0 0-4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07" />
                </svg>
                Acuan Harga Beli ARUNA
            </h3>
            
            <div class="space-y-4">
                {{-- Botol Plastik --}}
                <div class="p-4 rounded-xl bg-teal-50/40 border border-teal-100/50 flex justify-between items-center">
                    <div>
                        <div class="text-[12px] font-extrabold text-gray-800">Botol Plastik</div>
                        <div class="text-[10px] text-gray-400 mt-0.5">Konversi per kilogram</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-emerald-600 font-mono">Rp {{ number_format($hargaMaster['botol plastik']->harga_beli_nasabah ?? 0, 0, ',', '.') }}/kg</div>
                        <div class="text-[9px] text-gray-400 font-bold mt-0.5">Pabrik: Rp {{ number_format($hargaMaster['botol plastik']->harga_jual_pengepul ?? 0, 0, ',', '.') }}</div>
                    </div>
                </div>

                {{-- Kardus --}}
                <div class="p-4 rounded-xl bg-teal-50/40 border border-teal-100/50 flex justify-between items-center">
                    <div>
                        <div class="text-[12px] font-extrabold text-gray-800">Kardus Bekas</div>
                        <div class="text-[10px] text-gray-400 mt-0.5">Konversi per kilogram</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-emerald-600 font-mono">Rp {{ number_format($hargaMaster['kardus']->harga_beli_nasabah ?? 0, 0, ',', '.') }}/kg</div>
                        <div class="text-[9px] text-gray-400 font-bold mt-0.5">Pabrik: Rp {{ number_format($hargaMaster['kardus']->harga_jual_pengepul ?? 0, 0, ',', '.') }}</div>
                    </div>
                </div>

                {{-- Kaleng --}}
                <div class="p-4 rounded-xl bg-teal-50/40 border border-teal-100/50 flex justify-between items-center">
                    <div>
                        <div class="text-[12px] font-extrabold text-gray-800">Kaleng Logam</div>
                        <div class="text-[10px] text-gray-400 mt-0.5">Konversi per kilogram</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-emerald-600 font-mono">Rp {{ number_format($hargaMaster['kaleng']->harga_beli_nasabah ?? 0, 0, ',', '.') }}/kg</div>
                        <div class="text-[9px] text-gray-400 font-bold mt-0.5">Pabrik: Rp {{ number_format($hargaMaster['kaleng']->harga_jual_pengepul ?? 0, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 text-[10px] leading-relaxed text-gray-400 bg-gray-50 p-3 rounded-xl border border-gray-150">
            * Perubahan nominal harga diatur oleh Manajer melalui halaman <strong>Master Harga</strong> dan akan langsung memperbarui acuan timbangan loket real-time.
        </div>
    </div>

</div>

{{-- Recent Setoran logs --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mt-6">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-[14px] font-bold text-gray-900">Histori Setoran Sampah Terkini</h3>
        <span class="text-[11px] text-gray-400 font-medium bg-gray-50 px-2.5 py-1 rounded-lg">Menampilkan 15 transaksi terakhir</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-gray-50">
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Waktu Setor</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No. Rek Nasabah</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nama Nasabah</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Jenis Sampah</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Berat (kg)</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Harga Beli Bunga</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Hasil</th>
                    <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($recentSetoran as $setoran)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-xs text-gray-550 font-mono">{{ $setoran->created_at->translatedFormat('d M Y - H:i') }} WIB</td>
                        <td class="px-6 py-4 text-xs font-bold text-emerald-600 font-mono">{{ $setoran->nasabah->no_id ?? '-' }}</td>
                        <td class="px-6 py-4 text-xs font-bold text-gray-900">{{ $setoran->nasabah->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-xs text-gray-700 capitalize">{{ $setoran->jenis_sampah }}</td>
                        <td class="px-6 py-4 text-xs font-bold text-gray-900 font-mono">{{ number_format($setoran->berat_kg, 2, ',', '.') }} kg</td>
                        <td class="px-6 py-4 text-xs text-gray-600 font-mono">Rp {{ number_format($setoran->harga_beli_nasabah, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-xs font-bold text-emerald-700 font-mono">Rp {{ number_format($setoran->total_harga_nasabah, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-xs text-center">
                            @if($setoran->status === 'gudang')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 border border-amber-100 text-amber-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Di Gudang
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 border border-emerald-100 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Terjual
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-9-4.5h16.5" />
                                    </svg>
                                </div>
                                <p class="text-[13px] font-semibold text-gray-500 mb-1">Belum ada timbangan masuk hari ini</p>
                                <p class="text-[12px] text-gray-400">Silakan input data setoran nasabah pada form di atas.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
