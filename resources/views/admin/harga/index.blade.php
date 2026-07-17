@extends('layouts.admin')

@section('title', 'Master Harga')
@section('page-title', 'Konfigurasi Kebijakan Pasar')
@section('page-subtitle', 'Manajemen acuan harga beli nasabah dan harga jual pengepul')

@section('content')
<div x-data="{
    editModalOpen: false,
    currentHarga: { id: '', jenis_sampah: '', harga_beli_nasabah: '', harga_jual_pengepul: '' }
}">

    {{-- Info Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm mb-6 flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-650 flex items-center justify-center shrink-0 border border-teal-100/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-9-4.5h16.5" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-bold text-gray-900">Peraturan Kebijakan Harga Pasar</h3>
            <p class="text-[12px] text-gray-400 mt-1 leading-relaxed">
                Perubahan angka harga beli nasabah atau harga jual pengepul pada halaman ini akan langsung mengubah acuan harga pada formulir setoran timbangan secara real-time. Perubahan ini murni berlaku untuk transaksi di masa depan dan <strong>tidak akan merusak histori transaksi</strong> finansial masa lalu demi menjaga akuntabilitas keuangan.
            </p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between" x-data="{ show: true }" x-show="show">
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
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center justify-between" x-data="{ show: true }" x-show="show">
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

    {{-- Data Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-[14px] font-bold text-gray-900">Kebijakan Nominal Konversi Sampah</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-50">
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Jenis Sampah</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Harga Beli Nasabah (per kg)</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Harga Jual Pengepul (per kg)</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Margin Keuntungan Pengelola</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($hargaList as $harga)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-xs font-semibold text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-xs font-bold text-gray-900 capitalize">{{ $harga->jenis_sampah }}</td>
                            <td class="px-6 py-4 text-xs font-bold text-emerald-600 font-mono">Rp {{ number_format($harga->harga_beli_nasabah, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-xs font-bold text-indigo-650 font-mono">Rp {{ number_format($harga->harga_jual_pengepul, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-xs font-bold text-gray-700 font-mono">
                                Rp {{ number_format($harga->harga_jual_pengepul - $harga->harga_beli_nasabah, 0, ',', '.') }}
                                <span class="text-[10px] text-gray-400 font-medium ml-1">({{ number_format((($harga->harga_jual_pengepul - $harga->harga_beli_nasabah) / $harga->harga_jual_pengepul) * 100, 1) }}%)</span>
                            </td>
                            <td class="px-6 py-4 text-xs text-center flex items-center justify-center">
                                <button 
                                    @click="
                                        currentHarga = { 
                                            id: '{{ $harga->id }}', 
                                            jenis_sampah: '{{ addslashes($harga->jenis_sampah) }}', 
                                            harga_beli_nasabah: '{{ $harga->harga_beli_nasabah }}', 
                                            harga_jual_pengepul: '{{ $harga->harga_jual_pengepul }}' 
                                        };
                                        editModalOpen = true;
                                    "
                                    class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-600 flex items-center justify-center transition-colors border border-emerald-100 cursor-pointer"
                                    title="Edit Kebijakan Harga">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-xs text-gray-400">
                                Tidak ada data harga.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL EDIT HARGA --}}
    {{-- ============================================================ --}}
    <div 
        x-show="editModalOpen" 
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
                @click.away="editModalOpen = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <form :action="'{{ url('admin/harga') }}/' + currentHarga.id" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-5">
                        <h3 class="text-sm font-bold text-gray-900">Ubah Harga: <span class="capitalize text-emerald-650" x-text="currentHarga.jenis_sampah"></span></h3>
                        <button type="button" @click="editModalOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        {{-- Harga Beli Nasabah --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Harga Beli Nasabah (per kg)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400 select-none">Rp</span>
                                <input type="number" name="harga_beli_nasabah" required x-model="currentHarga.harga_beli_nasabah" min="0"
                                       class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all font-mono font-bold text-gray-800">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1">Uang yang diberikan ke nasabah saat menyetor.</p>
                        </div>

                        {{-- Harga Jual Pengepul --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Harga Jual Pengepul (per kg)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400 select-none">Rp</span>
                                <input type="number" name="harga_jual_pengepul" required x-model="currentHarga.harga_jual_pengepul" min="0"
                                       class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all font-mono font-bold text-gray-800">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1">Uang hasil penjualan yang dibayarkan oleh pabrik/pengepul.</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                        <button type="button" @click="editModalOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-gray-200 hover:bg-gray-50 text-xs font-semibold text-gray-600 transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-md shadow-emerald-600/15 cursor-pointer">
                            Simpan Kebijakan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
