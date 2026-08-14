@extends('layouts.admin')

@section('title', 'Data Nasabah')
@section('page-title', 'Data Nasabah')

@section('content')
<div x-data="{ 
    search: '',
    createModalOpen: {{ $errors->any() && !old('_method') ? 'true' : 'false' }},
    editModalOpen: {{ $errors->any() && old('_method') === 'PUT' ? 'true' : 'false' }}, 
    deleteModalOpen: false, 
    currentNasabah: { id: '', no_id: '', name: '', email: '', phone_number: '', kk_number: '', address: '' } 
}" class="space-y-6">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Daftar Akun Anggota</h3>
            <p class="text-xs text-on-surface-variant/80 mt-1">Data seluruh nasabah terdaftar di Bank Sampah ARUNA</p>
        </div>

        {{-- Search & Add Button --}}
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <div class="relative flex-1 sm:flex-initial">
                <span class="material-symbols-outlined text-[18px] text-on-surface-variant/60 absolute left-3 top-1/2 -translate-y-1/2">search</span>
                <input type="text" x-model="search" placeholder="Cari nasabah..." 
                       class="h-10 w-full sm:w-64 pl-9 pr-4 rounded-xl border border-outline-variant/50 text-xs placeholder-on-surface-variant/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all duration-200 bg-surface-container-lowest">
            </div>

            <button @click="createModalOpen = true" 
                    class="px-5 py-2.5 bg-[#065f46] text-[#FFFFFF] rounded-xl text-xs font-bold hover:shadow-lg hover:shadow-primary/20 transition-all flex items-center justify-center gap-2 cursor-pointer shrink-0">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Tambah Nasabah
            </button>
        </div>
    </div>

    {{-- Stats Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 px-5 py-4 flex items-center gap-4 shadow-xs">
            <div class="w-10 h-10 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[20px]">group</span>
            </div>
            <div>
                <div class="text-lg font-extrabold text-on-surface">{{ $totalNasabah ?? 0 }}</div>
                <div class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider mt-0.5">Total Nasabah</div>
            </div>
        </div>
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 px-5 py-4 flex items-center gap-4 shadow-xs">
            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
            </div>
            <div>
                <div class="text-lg font-extrabold text-on-surface">{{ $totalNasabah ?? 0 }}</div>
                <div class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider mt-0.5">Nasabah Aktif</div>
            </div>
        </div>
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 px-5 py-4 flex items-center gap-4 shadow-xs">
            <div class="w-10 h-10 rounded-xl bg-tertiary-container/30 text-tertiary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
            </div>
            <div>
                <div class="text-lg font-extrabold text-on-surface">{{ $nasabahBaruBulanIni ?? 0 }}</div>
                <div class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider mt-0.5">Nasabah Baru</div>
            </div>
        </div>
    </div>

    {{-- Data Table & Mobile Cards Container --}}
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 overflow-hidden shadow-xs">
        <div class="px-5 py-4 border-b border-outline-variant/20 flex items-center justify-between">
            <h3 class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Tabel Data Nasabah</h3>
            <span class="text-[10px] font-bold text-primary bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/10">{{ $totalNasabah ?? 0 }} Data</span>
        </div>

        {{-- MOBILE VIEW: Individual Distinct Cards (Per Kotak) --}}
        <div class="block md:hidden space-y-3.5 p-3.5 sm:p-4 bg-surface-container-low/20">
            @forelse($nasabah as $item)
                <div class="p-4 space-y-3 bg-surface-container-lowest rounded-2xl border border-outline-variant/40 shadow-xs hover:shadow-md transition-all duration-200"
                     x-show="search === '' || '{{ strtolower($item->name) }}'.includes(search.toLowerCase()) || '{{ $item->kk_number }}'.includes(search) || '{{ $item->email }}'.includes(search) || '{{ strtolower($item->no_id) }}'.includes(search.toLowerCase())">
                    
                    {{-- Header: Avatar, Name, No ID, and Actions --}}
                    <div class="flex items-start justify-between gap-3 pb-2.5 border-b border-outline-variant/20">
                        <div class="flex items-center gap-2.5 min-w-0">
                            @if($item->profile_photo)
                                <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 border border-primary/20">
                                    <img src="{{ asset($item->profile_photo) }}" alt="Avatar" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs shrink-0 border border-primary/15">
                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <div class="font-bold text-sm text-on-surface truncate">{{ $item->name }}</div>
                                <div class="text-[11px] font-bold text-primary font-mono tracking-wide mt-0.5">{{ $item->no_id }}</div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-1.5 shrink-0">
                            <a href="{{ route('admin.nasabah.history', $item) }}"
                               class="w-8 h-8 rounded-lg bg-secondary-container/20 text-on-secondary-container flex items-center justify-center border border-secondary-container/25 transition-all hover:bg-secondary-container/45 cursor-pointer"
                               title="Buku Tabungan">
                                <span class="material-symbols-outlined text-[18px]">menu_book</span>
                            </a>
                            <button @click="currentNasabah = { id: '{{ $item->id }}', no_id: '{{ $item->no_id }}', name: '{{ addslashes($item->name) }}', email: '{{ $item->email }}', phone_number: '{{ $item->phone_number ?? '' }}', kk_number: '{{ $item->kk_number }}', address: '{{ addslashes($item->address ?? '') }}' }; editModalOpen = true;"
                                    class="w-8 h-8 rounded-lg bg-primary/5 text-primary flex items-center justify-center border border-primary/10 transition-all hover:bg-primary/10 cursor-pointer"
                                    title="Edit Data">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </button>
                            <button @click="currentNasabah = { id: '{{ $item->id }}', name: '{{ addslashes($item->name) }}' }; deleteModalOpen = true;"
                                    class="w-8 h-8 rounded-lg bg-error-container/20 text-error flex items-center justify-center border border-error-container/30 transition-all hover:bg-error-container/40 cursor-pointer"
                                    title="Hapus Nasabah">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </div>

                    {{-- Details Grid --}}
                    <div class="grid grid-cols-2 gap-2 text-[11px]">
                        <div class="col-span-2 flex items-center gap-2 text-on-surface-variant/80">
                            <span class="material-symbols-outlined text-[15px] text-primary/70 shrink-0">mail</span>
                            <span class="truncate font-medium">{{ $item->email }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant/80">
                            <span class="material-symbols-outlined text-[15px] text-primary/70 shrink-0">call</span>
                            <span class="font-mono font-semibold">{{ $item->phone_number ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant/80">
                            <span class="material-symbols-outlined text-[15px] text-primary/70 shrink-0">badge</span>
                            <span class="font-mono">{{ $item->kk_number }}</span>
                        </div>
                        <div class="col-span-2 flex items-start gap-2 text-on-surface-variant/80">
                            <span class="material-symbols-outlined text-[15px] text-primary/70 shrink-0 mt-0.5">location_on</span>
                            <span class="line-clamp-2 leading-relaxed">{{ $item->address ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Footer: Saldo & Date --}}
                    <div class="flex items-center justify-between pt-2.5 border-t border-outline-variant/20 text-[11px]">
                        <div class="flex items-center gap-1.5">
                            <span class="text-on-surface-variant/60 font-medium">Saldo:</span>
                            <span class="font-bold text-primary font-mono bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/15 text-xs">Rp {{ number_format($item->total_tabungan, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-on-surface-variant/60 font-mono text-[10px]">
                            {{ $item->created_at->translatedFormat('d M Y') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-on-surface-variant/50">
                    <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-2">person_off</span>
                    <p class="text-xs font-bold text-on-surface-variant/60">Belum ada data nasabah</p>
                    <p class="text-[10px] mt-0.5">Silakan tambahkan data baru melalui tombol di atas.</p>
                </div>
            @endforelse
        </div>

        {{-- DESKTOP VIEW: Table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-outline-variant/20 bg-surface-container-low/20">
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No. ID</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No. HP</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No. KK</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Saldo Tabungan</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Terdaftar</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/15 text-xs">
                    @forelse($nasabah as $item)
                        <tr class="hover:bg-surface-container-low/20 transition-colors"
                            x-show="search === '' || '{{ strtolower($item->name) }}'.includes(search.toLowerCase()) || '{{ $item->kk_number }}'.includes(search) || '{{ $item->email }}'.includes(search) || '{{ strtolower($item->no_id) }}'.includes(search.toLowerCase())">
                            <td class="px-6 py-4 text-on-surface-variant/70 font-bold">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-bold text-primary font-mono tracking-wide">{{ $item->no_id }}</td>
                            <td class="px-6 py-4 font-bold text-on-surface">
                                <div class="flex items-center gap-2">
                                    @if($item->profile_photo)
                                        <div class="w-6 h-6 rounded-full overflow-hidden shrink-0 border border-primary/20">
                                            <img src="{{ asset($item->profile_photo) }}" alt="Avatar" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-[9px] shrink-0 border border-primary/15">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span>{{ $item->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-on-surface-variant/80 font-medium">{{ $item->email }}</td>
                            <td class="px-6 py-4 font-mono font-semibold text-on-surface-variant/80">{{ $item->phone_number ?? '-' }}</td>
                            <td class="px-6 py-4 font-mono text-on-surface-variant/70">{{ $item->kk_number }}</td>
                            <td class="px-6 py-4 text-on-surface-variant/80 truncate max-w-[160px]" title="{{ $item->address }}">{{ $item->address ?? '-' }}</td>
                            <td class="px-6 py-4 font-bold text-primary font-mono">Rp {{ number_format($item->total_tabungan, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 font-mono text-on-surface-variant/70">{{ $item->created_at->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    {{-- History Button --}}
                                    <a href="{{ route('admin.nasabah.history', $item) }}"
                                       class="w-7 h-7 rounded-lg bg-secondary-container/20 text-on-secondary-container flex items-center justify-center border border-secondary-container/25 transition-all hover:bg-secondary-container/45 cursor-pointer"
                                       title="Buku Tabungan">
                                        <span class="material-symbols-outlined text-[16px]">menu_book</span>
                                    </a>

                                    {{-- Edit Button --}}
                                    <button 
                                        @click="
                                            currentNasabah = { 
                                                id: '{{ $item->id }}', 
                                                no_id: '{{ $item->no_id }}', 
                                                name: '{{ addslashes($item->name) }}', 
                                                email: '{{ $item->email }}', 
                                                phone_number: '{{ $item->phone_number ?? '' }}', 
                                                kk_number: '{{ $item->kk_number }}', 
                                                address: '{{ addslashes($item->address ?? '') }}' 
                                            };
                                            editModalOpen = true;
                                        "
                                        class="w-7 h-7 rounded-lg bg-primary/5 text-primary flex items-center justify-center border border-primary/10 transition-all hover:bg-primary/10 cursor-pointer"
                                        title="Edit Data">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                    </button>
                                    
                                    {{-- Delete Button --}}
                                    <button 
                                        @click="
                                            currentNasabah = { 
                                                id: '{{ $item->id }}', 
                                                name: '{{ addslashes($item->name) }}' 
                                            };
                                            deleteModalOpen = true;
                                        "
                                        class="w-7 h-7 rounded-lg bg-error-container/20 text-error flex items-center justify-center border border-error-container/30 transition-all hover:bg-error-container/40 cursor-pointer"
                                        title="Hapus Nasabah">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-12 text-center text-on-surface-variant/50">
                                <span class="material-symbols-outlined text-[40px] text-on-surface-variant/20 block mb-2">person_off</span>
                                <p class="text-xs font-bold text-on-surface-variant/60">Belum ada data nasabah</p>
                                <p class="text-[10px] mt-0.5">Silakan tambahkan data baru melalui tombol di atas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL REGISTRASI NASABAH BARU --}}
    {{-- ============================================================ --}}
    <div x-show="createModalOpen" 
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
            <div class="relative transform overflow-hidden rounded-2xl bg-surface-container-lowest text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-outline-variant/30"
                 @click.away="createModalOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <form action="{{ route('admin.nasabah.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    
                    <div class="flex items-center justify-between pb-3.5 border-b border-outline-variant/20 mb-2">
                        <h3 class="text-sm font-extrabold text-primary">Registrasi Nasabah Baru</h3>
                        <button type="button" @click="createModalOpen = false" class="text-on-surface-variant/40 hover:text-on-surface transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama nasabah..."
                                   class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                            @error('name')
                                <span class="text-[10px] text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@domain.com"
                                   class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                            @error('email')
                                <span class="text-[10px] text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nomor HP</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="08xxxxxxxxxx"
                                       class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                                @error('phone_number')
                                    <span class="text-[10px] text-red-500 font-medium">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nomor KK (16 digit)</label>
                                <input type="text" name="kk_number" value="{{ old('kk_number') }}" required maxlength="16" minlength="16" placeholder="Nomor KK..."
                                       class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                                @error('kk_number')
                                    <span class="text-[10px] text-red-500 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Alamat Lengkap</label>
                            <textarea name="address" rows="3" placeholder="Alamat domisili..."
                                      class="w-full p-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all resize-none bg-surface-container-lowest text-on-surface">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="text-[10px] text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Password Akun</label>
                            <input type="password" name="password" required placeholder="Minimal 8 karakter"
                                   class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                            @error('password')
                                <span class="text-[10px] text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/20">
                        <button type="button" @click="createModalOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-outline-variant/45 hover:bg-surface-container text-xs font-bold text-on-surface-variant transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="h-10 px-4 bg-[#065f46] hover:bg-[#065f46]/90 text-[#FFFFFF] rounded-xl text-xs font-bold transition-all shadow-xs flex items-center gap-2 cursor-pointer border border-transparent">
                            Daftarkan Nasabah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL EDIT NASABAH --}}
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
            <div class="relative transform overflow-hidden rounded-2xl bg-surface-container-lowest text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-outline-variant/30"
                 @click.away="editModalOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <form :action="'{{ url('admin/nasabah') }}/' + currentNasabah.id" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center justify-between pb-3.5 border-b border-outline-variant/20 mb-2">
                        <h3 class="text-sm font-extrabold text-primary">Perbarui Data Nasabah</h3>
                        <button type="button" @click="editModalOpen = false" class="text-on-surface-variant/40 hover:text-on-surface transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">No. ID Rekening</label>
                            <input type="text" x-model="currentNasabah.no_id" readonly
                                   class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs bg-surface-container text-on-surface-variant/60 cursor-not-allowed outline-none select-none">
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" name="name" x-model="currentNasabah.name" required
                                   class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Alamat Email</label>
                            <input type="email" name="email" x-model="currentNasabah.email" required
                                   class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nomor HP</label>
                                <input type="text" name="phone_number" x-model="currentNasabah.phone_number" required
                                       class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                            </div>

                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nomor KK (16 digit)</label>
                                <input type="text" name="kk_number" x-model="currentNasabah.kk_number" required maxlength="16" minlength="16"
                                       class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Alamat Lengkap</label>
                            <textarea name="address" x-model="currentNasabah.address" rows="3"
                                      class="w-full p-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all resize-none bg-surface-container-lowest text-on-surface"></textarea>
                        </div>

                        <div class="flex flex-col gap-1 pt-2 border-t border-outline-variant/20">
                            <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Password Baru (Opsional)</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah"
                                   class="w-full h-11 px-4 rounded-xl border border-outline-variant/45 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-surface-container-lowest text-on-surface">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/20">
                        <button type="button" @click="editModalOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-outline-variant/45 hover:bg-surface-container text-xs font-bold text-on-surface-variant transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 text-[#FFFFFF] rounded-xl bg-primary text-on-primary hover:bg-primary/95 text-xs font-bold transition-all shadow-xs cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL DELETE CONFIRMATION --}}
    {{-- ============================================================ --}}
    <div x-show="deleteModalOpen" 
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
                 @click.away="deleteModalOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <form :action="'{{ url('admin/nasabah') }}/' + currentNasabah.id" method="POST" class="p-6 text-center">
                    @csrf
                    @method('DELETE')

                    <div class="w-12 h-12 rounded-full bg-error-container/20 text-error flex items-center justify-center mx-auto mb-4 border border-error-container/30">
                        <span class="material-symbols-outlined text-[24px]">warning</span>
                    </div>

                    <h3 class="text-sm font-extrabold text-on-surface mb-2">Hapus Akun Nasabah?</h3>
                    <p class="text-xs text-on-surface-variant/80 leading-relaxed px-2 mb-6">
                        Apakah Anda yakin ingin menghapus akun nasabah <strong class="text-on-surface font-extrabold" x-text="currentNasabah.name"></strong>? Seluruh data tabungan dan riwayat transaksi nasabah ini juga akan terhapus secara permanen dari sistem.
                    </p>

                    <div class="flex items-center justify-center gap-3">
                        <button type="button" @click="deleteModalOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-outline-variant/45 hover:bg-surface-container text-xs font-bold text-on-surface-variant transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-error text-on-error hover:bg-error/95 text-xs font-bold transition-all shadow-xs cursor-pointer">
                            Ya, Hapus Permanen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection