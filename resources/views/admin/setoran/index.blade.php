@extends('layouts.admin')

@section('title', 'Setor Sampah')
@section('page-title', 'Input Setoran Sampah')

@section('content')
<div x-data="{ 
    no_id: '{{ old('no_id') }}', 
    nasabahList: {{ $nasabahList->toJson() }},
    get selectedNasabah() {
        return this.nasabahList.find(n => n.no_id.toLowerCase().trim() === this.no_id.toLowerCase().trim());
    }
}" class="space-y-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Input --}}
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs lg:col-span-2 space-y-4">
            <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2 pb-3 border-b border-outline-variant/20 mb-2">
                <span class="material-symbols-outlined text-[18px] text-primary">add_shopping_cart</span>
                Form Setoran Sampah Nasabah
            </h3>

            <form id="setoranForm" action="{{ route('admin.setoran.store') }}" method="POST" class="space-y-4"
                  @submit.prevent="
                      const nasabah = selectedNasabah;
                      if (!nasabah) {
                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal',
                              text: 'Nomor rekening nasabah tidak valid atau belum terdaftar.',
                              confirmButtonColor: '#ba1a1a'
                          });
                          return;
                      }
                      const jenis = document.getElementsByName('jenis_sampah')[0].value;
                      const berat = document.getElementsByName('berat_kg')[0].value;
                      if (!jenis || !berat || berat <= 0) {
                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal',
                              text: 'Silakan isi jenis sampah dan timbangan berat dengan benar.',
                              confirmButtonColor: '#ba1a1a'
                          });
                          return;
                      }
                      Swal.fire({
                          title: 'Konfirmasi Setoran',
                          html: `Apakah Anda yakin ingin menyimpan setoran sampah <b>${jenis}</b> seberat <b>${berat} kg</b> untuk nasabah <b>${nasabah.name}</b>?`,
                          icon: 'question',
                          showCancelButton: true,
                          confirmButtonColor: '#004532',
                          cancelButtonColor: '#ba1a1a',
                          confirmButtonText: 'Ya, Simpan!',
                          cancelButtonText: 'Batal'
                      }).then((result) => {
                          if (result.isConfirmed) {
                              $el.submit();
                          }
                      });
                  ">
                @csrf

                {{-- Nomor Rekening --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No. Rekening Nasabah (No. ID)</label>
                    <div class="relative">
                        <input type="text" name="no_id" required x-model="no_id" placeholder="Format: BS-2026-xxx"
                               class="w-full h-11 pl-4 pr-12 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-mono bg-surface-container-lowest text-on-surface">
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50">
                            <span class="material-symbols-outlined text-[18px]">badge</span>
                        </div>
                    </div>
                    
                    {{-- Dynamic Nasabah Preview --}}
                    <div x-show="selectedNasabah" x-transition class="p-3 bg-primary/5 border border-primary/10 rounded-xl flex items-center gap-3.5 mt-2">
                        <template x-if="selectedNasabah && selectedNasabah.profile_photo">
                            <div class="w-9 h-9 rounded-lg overflow-hidden shrink-0 border border-primary/20">
                                <img :src="'/' + selectedNasabah.profile_photo" class="w-full h-full object-cover">
                            </div>
                        </template>
                        <template x-if="selectedNasabah && !selectedNasabah.profile_photo">
                            <div class="w-9 h-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-xs shrink-0 border border-primary/15" x-text="selectedNasabah.name.substring(0,1).toUpperCase()"></div>
                        </template>
                        <div class="text-xs min-w-0">
                            <p class="font-extrabold text-on-surface truncate" x-text="selectedNasabah.name"></p>
                            <p class="text-[10px] text-on-surface-variant/70 font-semibold truncate" x-text="'HP: ' + (selectedNasabah.phone_number || '-') + ' | Alamat: ' + (selectedNasabah.address || '-')"></p>
                        </div>
                    </div>

                    <div x-show="no_id.trim() !== '' && !selectedNasabah" x-transition class="p-3 bg-error-container/20 border border-error-container/30 rounded-xl flex items-center gap-2 mt-2 text-error text-[10px] font-bold">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        <span>Nomor Rekening tidak ditemukan di sistem.</span>
                    </div>

                    <p class="text-[10px] text-on-surface-variant/60" x-show="!selectedNasabah && no_id.trim() === ''">Masukkan nomor ID nasabah yang terdaftar.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Jenis Sampah --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Jenis Sampah</label>
                        <select name="jenis_sampah" required
                                class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface cursor-pointer">
                            <option value="" disabled selected>Pilih kategori...</option>
                            <option value="botol plastik" {{ old('jenis_sampah') === 'botol plastik' ? 'selected' : '' }}>Botol Plastik</option>
                            <option value="kardus" {{ old('jenis_sampah') === 'kardus' ? 'selected' : '' }}>Kardus / Karton</option>
                            <option value="kaleng" {{ old('jenis_sampah') === 'kaleng' ? 'selected' : '' }}>Kaleng Logam</option>
                        </select>
                    </div>

                    {{-- Berat --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Timbangan Berat</label>
                        <div class="relative">
                            <input type="number" step="0.01" min="0.01" name="berat_kg" required value="{{ old('berat_kg') }}" placeholder="Contoh: 4.5"
                                   class="w-full h-11 pl-4 pr-12 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-mono bg-surface-container-lowest text-on-surface">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-on-surface-variant/50 select-none">
                                KG
                            </span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-outline-variant/20 flex justify-end">
                    <button type="submit" class="h-10 px-4 bg-[#065f46] hover:bg-[#065f46]/90 text-[#FFFFFF] rounded-xl text-xs font-bold transition-all shadow-xs flex items-center gap-2 cursor-pointer border border-transparent">
                        <span class="material-symbols-outlined text-[16px]">save</span>
                        Simpan Setoran
                    </button>
                </div>
            </form>
        </div>

        {{-- Price Master Widget --}}
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-6 shadow-xs flex flex-col justify-between">
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider flex items-center gap-2 pb-3 border-b border-outline-variant/20">
                    <span class="material-symbols-outlined text-[18px] text-primary">sell</span>
                    Acuan Harga Beli ARUNA
                </h3>
                
                <div class="space-y-3">
                    {{-- Botol Plastik --}}
                    <div class="p-4 rounded-xl bg-surface-container border border-outline-variant/15 flex justify-between items-center gap-2">
                        <div>
                            <div class="text-xs font-bold text-on-surface">Botol Plastik</div>
                            <div class="text-[9px] text-on-surface-variant/60 font-medium mt-0.5">Konversi per kilogram</div>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="text-xs font-black text-primary font-mono">Rp {{ number_format($hargaMaster['botol plastik']->harga_beli_nasabah ?? 0, 0, ',', '.') }}/kg</div>
                            <div class="text-[9px] text-on-surface-variant/50 font-bold mt-0.5">Pabrik: Rp {{ number_format($hargaMaster['botol plastik']->harga_jual_pengepul ?? 0, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    {{-- Kardus --}}
                    <div class="p-4 rounded-xl bg-surface-container border border-outline-variant/15 flex justify-between items-center gap-2">
                        <div>
                            <div class="text-xs font-bold text-on-surface">Kardus / Karton</div>
                            <div class="text-[9px] text-on-surface-variant/60 font-medium mt-0.5">Konversi per kilogram</div>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="text-xs font-black text-primary font-mono">Rp {{ number_format($hargaMaster['kardus']->harga_beli_nasabah ?? 0, 0, ',', '.') }}/kg</div>
                            <div class="text-[9px] text-on-surface-variant/50 font-bold mt-0.5">Pabrik: Rp {{ number_format($hargaMaster['kardus']->harga_jual_pengepul ?? 0, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    {{-- Kaleng --}}
                    <div class="p-4 rounded-xl bg-surface-container border border-outline-variant/15 flex justify-between items-center gap-2">
                        <div>
                            <div class="text-xs font-bold text-on-surface">Kaleng Logam</div>
                            <div class="text-[9px] text-on-surface-variant/60 font-medium mt-0.5">Konversi per kilogram</div>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="text-xs font-black text-primary font-mono">Rp {{ number_format($hargaMaster['kaleng']->harga_beli_nasabah ?? 0, 0, ',', '.') }}/kg</div>
                            <div class="text-[9px] text-on-surface-variant/50 font-bold mt-0.5">Pabrik: Rp {{ number_format($hargaMaster['kaleng']->harga_jual_pengepul ?? 0, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Setoran Log Table & Mobile Cards --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 overflow-hidden shadow-xs">
        <div class="px-5 py-4 border-b border-outline-variant/20 flex items-center justify-between">
            <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Histori Jurnal Setoran Sampah Terakhir</h3>
            <span class="text-[10px] font-bold text-primary bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/10">{{ $recentSetoran->count() }} Setoran Terakhir</span>
        </div>

        {{-- MOBILE VIEW: Individual Distinct Cards (Per Kotak) --}}
        <div class="block md:hidden space-y-3.5 p-3.5 sm:p-4 bg-surface-container-low/20">
            @forelse($recentSetoran as $setoran)
                <div class="p-4 space-y-3 bg-surface-container-lowest rounded-2xl border border-outline-variant/40 shadow-xs hover:shadow-md transition-all duration-200">
                    {{-- Header: Nasabah & Status --}}
                    <div class="flex items-start justify-between gap-3 pb-2.5 border-b border-outline-variant/20">
                        <div class="min-w-0">
                            <div class="font-bold text-sm text-on-surface truncate">{{ $setoran->nasabah->name ?? 'Nasabah Terhapus' }}</div>
                            <div class="text-[11px] font-bold text-primary font-mono tracking-wide mt-0.5">{{ $setoran->nasabah->no_id ?? '-' }}</div>
                        </div>

                        {{-- Status Badge --}}
                        <div class="shrink-0">
                            @if($setoran->status === 'gudang')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-bold bg-primary/10 border border-primary/15 text-primary">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Mengendap di Gudang
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-bold bg-secondary-container/20 text-on-secondary-container border border-secondary-container/25">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    Dilikuidasi
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Details Grid --}}
                    <div class="grid grid-cols-2 gap-2 text-[11px]">
                        <div class="space-y-0.5">
                            <span class="text-on-surface-variant/60 font-medium block">Jenis Sampah:</span>
                            <span class="font-bold text-on-surface capitalize block text-xs">{{ $setoran->jenis_sampah }}</span>
                        </div>
                        <div class="space-y-0.5 text-right">
                            <span class="text-on-surface-variant/60 font-medium block">Berat Timbangan:</span>
                            <span class="font-bold text-on-surface font-mono block text-xs">{{ number_format($setoran->berat_kg, 2, ',', '.') }} kg</span>
                        </div>
                    </div>

                    {{-- Footer: Total Hasil & Date --}}
                    <div class="flex items-center justify-between pt-2.5 border-t border-outline-variant/20 text-[11px]">
                        <div class="flex items-center gap-1.5">
                            <span class="text-on-surface-variant/60 font-medium">Hasil:</span>
                            <span class="font-bold text-primary font-mono text-xs bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/15">Rp {{ number_format($setoran->total_harga_nasabah, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-on-surface-variant/60 font-mono text-[10px]">
                            {{ $setoran->created_at->translatedFormat('d M Y - H:i') }} WIB
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-on-surface-variant/50">
                    <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-2">history</span>
                    <p class="text-xs font-bold text-on-surface-variant/60">Belum ada riwayat setoran</p>
                </div>
            @endforelse
        </div>

        {{-- DESKTOP VIEW: Full Table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-outline-variant/20 bg-surface-container-low/20">
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nasabah</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Jenis Sampah</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Berat (KG)</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Total Hasil</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Status Gudang</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/15 text-xs">
                    @forelse($recentSetoran as $setoran)
                        <tr class="hover:bg-surface-container-low/20 transition-colors">
                            <td class="px-6 py-4 text-on-surface-variant/70 font-semibold">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-on-surface-variant/80 font-mono">{{ $setoran->created_at->translatedFormat('d M Y - H:i') }} WIB</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-on-surface">{{ $setoran->nasabah->name ?? 'Nasabah Terhapus' }}</div>
                                <div class="text-[10px] text-primary font-bold font-mono tracking-wide mt-0.5">{{ $setoran->nasabah->no_id ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-on-surface capitalize">{{ $setoran->jenis_sampah }}</td>
                            <td class="px-6 py-4 font-bold text-on-surface font-mono">{{ number_format($setoran->berat_kg, 2, ',', '.') }} kg</td>
                            <td class="px-6 py-4 font-bold text-primary font-mono">Rp {{ number_format($setoran->total_harga_nasabah, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($setoran->status === 'gudang')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-primary/10 border border-primary/15 text-primary">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Mengendap di Gudang
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-secondary-container/20 text-on-secondary-container border border-secondary-container/25">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        Sudah Dilikuidasi / Jual
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-on-surface-variant/50">
                                <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-2">history</span>
                                <p class="text-xs font-bold text-on-surface-variant/60">Belum ada riwayat setoran</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection