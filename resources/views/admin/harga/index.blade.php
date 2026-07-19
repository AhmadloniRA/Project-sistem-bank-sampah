@extends('layouts.admin')

@section('title', 'Master Harga')
@section('page-title', 'Konfigurasi Kebijakan Pasar')

@section('content')
<div x-data="{
    editModalOpen: false,
    currentHarga: { id: '', jenis_sampah: '', harga_beli_nasabah: '', harga_jual_pengepul: '' }
}" class="space-y-6">

    {{-- Info Card --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0 border border-primary/20">
            <span class="material-symbols-outlined text-[20px]">info</span>
        </div>
        <div class="text-xs text-on-surface-variant/80">
            <h3 class="font-extrabold text-on-surface text-sm">Kebijakan Harga Konversi Sampah</h3>
            <p class="mt-1 leading-relaxed">
                Perubahan angka harga beli nasabah atau harga jual pengepul pada halaman ini akan langsung mengubah acuan harga pada formulir setoran timbangan secara real-time. Perubahan ini murni berlaku untuk transaksi di masa depan dan <strong>tidak akan merusak histori transaksi</strong> finansial masa lalu demi menjaga akuntabilitas keuangan.
            </p>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 overflow-hidden shadow-xs">
        <div class="px-6 py-4 border-b border-outline-variant/20">
            <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Kebijakan Nominal Konversi Sampah</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-outline-variant/20 bg-surface-container-low/20">
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Jenis Sampah</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Harga Beli Nasabah (per kg)</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Harga Jual Pengepul (per kg)</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Margin Keuntungan Pengelola</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/15 text-xs">
                    @forelse($hargaList as $harga)
                        <tr class="hover:bg-surface-container-low/20 transition-colors">
                            <td class="px-6 py-4 text-on-surface-variant/70 font-semibold">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-bold text-on-surface capitalize">{{ $harga->jenis_sampah }}</td>
                            <td class="px-6 py-4 font-bold text-primary font-mono">Rp {{ number_format($harga->harga_beli_nasabah, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 font-bold text-secondary font-mono">Rp {{ number_format($harga->harga_jual_pengepul, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 font-bold text-on-surface font-mono">
                                Rp {{ number_format($harga->harga_jual_pengepul - $harga->harga_beli_nasabah, 0, ',', '.') }}
                                <span class="text-[10px] text-on-surface-variant/60 font-medium ml-1">({{ number_format((($harga->harga_jual_pengepul - $harga->harga_beli_nasabah) / $harga->harga_jual_pengepul) * 100, 1) }}%)</span>
                            </td>
                            <td class="px-6 py-4 text-center">
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
                                    class="w-7 h-7 rounded-lg bg-primary/5 text-primary flex items-center justify-center border border-primary/10 transition-all hover:bg-primary/10 cursor-pointer mx-auto"
                                    title="Edit Kebijakan Harga">
                                    <span class="material-symbols-outlined text-[16px]">edit</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant/50">
                                <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-2">sell</span>
                                <p class="text-xs font-bold text-on-surface-variant/60">Tidak ada data harga</p>
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
    <div x-show="editModalOpen" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-neutral-900/40 backdrop-blur-xs"></div>
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-surface-container-lowest text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-outline-variant/30 animate-pageSlideIn"
                 @click.away="editModalOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <form :action="'{{ url('admin/harga') }}/' + currentHarga.id" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center justify-between pb-3.5 border-b border-outline-variant/20 mb-2">
                        <h3 class="text-sm font-extrabold text-primary">Edit Kebijakan Harga</h3>
                        <button type="button" @click="editModalOpen = false" class="text-on-surface-variant/40 hover:text-on-surface transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Kategori / Jenis Sampah</label>
                            <input type="text" x-model="currentHarga.jenis_sampah" readonly
                                   class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs bg-surface-container text-on-surface-variant/60 cursor-not-allowed outline-none select-none capitalize">
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Harga Beli Nasabah (per kg)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-on-surface-variant/50">Rp</span>
                                <input type="number" name="harga_beli_nasabah" x-model="currentHarga.harga_beli_nasabah" required
                                       class="w-full h-11 pl-10 pr-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-mono font-bold bg-surface-container-lowest text-on-surface">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Harga Jual Pengepul (per kg)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-on-surface-variant/50">Rp</span>
                                <input type="number" name="harga_jual_pengepul" x-model="currentHarga.harga_jual_pengepul" required
                                       class="w-full h-11 pl-10 pr-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-mono font-bold bg-surface-container-lowest text-on-surface">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/20">
                        <button type="button" @click="editModalOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-outline-variant/45 hover:bg-surface-container text-xs font-bold text-on-surface-variant transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="h-10 px-4 bg-[#065f46] hover:bg-[#065f46]/90 text-[#8bd6b7] rounded-xl text-xs font-bold transition-all shadow-xs flex items-center gap-2 cursor-pointer border border-transparent">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
