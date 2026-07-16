@extends('layouts.admin')

@section('title', 'Data Nasabah')
@section('page-title', 'Data Nasabah')
@section('page-subtitle', 'Kelola data akun nasabah ARUNA')

@section('content')
<div x-data="{ 
    search: '',
    editModalOpen: false, 
    deleteModalOpen: false, 
    currentNasabah: { id: '', no_id: '', name: '', email: '', phone_number: '', kk_number: '', address: '' } 
}">

    {{-- Alert Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between" x-data="{ show: true }" x-show="show">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75 7.5 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75 7.5 0 10-1.06 1.061l2.5 2.5a.75 7.5 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold" x-data="{ show: true }" x-show="show">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-rose-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <span>Terjadi kesalahan pengisian data:</span>
                </div>
                <button @click="show = false" class="text-rose-500 hover:text-rose-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <ul class="list-disc pl-5 space-y-1 text-[11px]">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Daftar Akun Nasabah</h2>
            <p class="text-[13px] text-gray-400 mt-0.5">Data seluruh nasabah yang terdaftar di ARUNA</p>
        </div>

        {{-- Search bar --}}
        <div class="flex items-center gap-3">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input type="text" x-model="search" placeholder="Cari nasabah..." class="h-10 w-full sm:w-64 pl-9 pr-4 rounded-xl border border-gray-200 text-[13px] placeholder-gray-400 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all duration-200 bg-white">
            </div>
        </div>
    </div>

    {{-- Stats Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-100 px-5 py-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
            <div>
                <div class="text-xl font-extrabold text-gray-900">{{ $totalNasabah ?? 0 }}</div>
                <div class="text-[11px] text-gray-400 font-medium">Total Nasabah</div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 px-5 py-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <div class="text-xl font-extrabold text-gray-900">{{ $totalNasabah ?? 0 }}</div>
                <div class="text-[11px] text-gray-400 font-medium">Nasabah Aktif</div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 px-5 py-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </div>
            <div>
                <div class="text-xl font-extrabold text-gray-900">{{ $nasabahBaruBulanIni ?? 0 }}</div>
                <div class="text-[11px] text-gray-400 font-medium">Nasabah Baru (Bulan Ini)</div>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        {{-- Table Header --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-[14px] font-bold text-gray-900">Tabel Nasabah</h3>
            <span class="text-[11px] text-gray-400 font-medium bg-gray-50 px-2.5 py-1 rounded-lg">{{ $totalNasabah ?? 0 }} data</span>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-50">
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No. ID</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No. HP</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No. KK</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Terdaftar</th>
                        <th class="px-6 py-3.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($nasabah as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors"
                            x-show="search === '' || '{{ strtolower($item->name) }}'.includes(search.toLowerCase()) || '{{ $item->kk_number }}'.includes(search) || '{{ $item->email }}'.includes(search) || '{{ strtolower($item->no_id) }}'.includes(search.toLowerCase())">
                            <td class="px-6 py-4 text-xs font-semibold text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-xs font-bold text-emerald-600 font-mono">{{ $item->no_id }}</td>
                            <td class="px-6 py-4 text-xs font-bold text-gray-900">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-xs text-gray-600">{{ $item->email }}</td>
                            <td class="px-6 py-4 text-xs text-gray-600 font-mono">{{ $item->phone_number ?? '-' }}</td>
                            <td class="px-6 py-4 text-xs text-gray-600 font-mono">{{ $item->kk_number }}</td>
                            <td class="px-6 py-4 text-xs text-gray-600 max-w-[200px] truncate" title="{{ $item->address }}">{{ $item->address ?? '-' }}</td>
                            <td class="px-6 py-4 text-xs text-gray-500">{{ $item->created_at->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4 text-xs text-center flex items-center justify-center gap-2">
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
                                    class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-600 flex items-center justify-center transition-colors border border-emerald-100 cursor-pointer"
                                    title="Edit Data">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
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
                                    class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center transition-colors border border-red-100 cursor-pointer"
                                    title="Hapus Nasabah">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>
                                    </div>
                                    <p class="text-[13px] font-semibold text-gray-500 mb-1">Belum ada data nasabah</p>
                                    <p class="text-[12px] text-gray-400">Data nasabah akan tampil di sini setelah ada yang mendaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL EDIT NASABAH --}}
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
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-neutral-900/60 backdrop-blur-xs transition-opacity"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div 
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100"
                @click.away="editModalOpen = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                {{-- Form action is bound to the current nasabah ID --}}
                <form :action="'{{ url('admin/nasabah') }}/' + currentNasabah.id" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    {{-- Modal Header --}}
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-5">
                        <h3 class="text-sm font-bold text-gray-900">Perbarui Data Nasabah</h3>
                        <button type="button" @click="editModalOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Modal Inputs --}}
                    <div class="space-y-4">
                        {{-- No. ID --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">No. ID</label>
                            <input type="text" x-model="currentNasabah.no_id" readonly
                                   class="w-full h-11 px-4 rounded-xl border border-gray-200 text-xs bg-gray-100 text-gray-400 cursor-not-allowed outline-none select-none">
                        </div>

                        {{-- Name --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Nama Lengkap</label>
                            <input type="text" name="name" x-model="currentNasabah.name" required
                                   class="w-full h-11 px-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Alamat Email</label>
                            <input type="email" name="email" x-model="currentNasabah.email" required
                                   class="w-full h-11 px-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            {{-- Phone Number --}}
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Nomor HP</label>
                                <input type="text" name="phone_number" x-model="currentNasabah.phone_number" required readonly
                                       class="w-full h-11 px-4 rounded-xl border border-gray-200 text-xs bg-gray-100 text-gray-400 cursor-not-allowed outline-none select-none">
                            </div>

                            {{-- KK Number --}}
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Nomor KK (16 digit)</label>
                                <input type="text" name="kk_number" x-model="currentNasabah.kk_number" required maxlength="16" minlength="16" readonly
                                       class="w-full h-11 px-4 rounded-xl border border-gray-200 text-xs bg-gray-100 text-gray-400 cursor-not-allowed outline-none select-none">
                            </div>
                        </div>

                        {{-- Address --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Alamat Lengkap</label>
                            <textarea name="address" x-model="currentNasabah.address" rows="3" readonly
                                      class="w-full p-4 rounded-xl border border-gray-200 text-xs bg-gray-100 text-gray-400 cursor-not-allowed outline-none select-none resize-none"></textarea>
                        </div>

                        {{-- Password (Optional) --}}
                        <div class="pt-2 border-t border-gray-100">
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Password Baru (Opsional)</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                                   class="w-full h-11 px-4 rounded-xl border border-gray-200 text-xs focus:border-emerald-400 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                        <button type="button" @click="editModalOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-gray-200 hover:bg-gray-50 text-xs font-semibold text-gray-600 transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-md shadow-emerald-600/15 cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL DELETE NASABAH --}}
    {{-- ============================================================ --}}
    <div 
        x-show="deleteModalOpen" 
        class="fixed inset-0 z-50 overflow-y-auto" 
        style="display: none;"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-neutral-900/60 backdrop-blur-xs transition-opacity"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div 
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100"
                @click.away="deleteModalOpen = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <form :action="'{{ url('admin/nasabah') }}/' + currentNasabah.id" method="POST" class="p-6 text-center">
                    @csrf
                    @method('DELETE')

                    {{-- Warning Icon --}}
                    <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center mx-auto mb-4 border border-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <h3 class="text-sm font-bold text-gray-900 mb-2">Hapus Akun Nasabah?</h3>
                    <p class="text-xs text-gray-500 leading-relaxed px-2 mb-6">
                        Apakah Anda yakin ingin menghapus akun nasabah <strong class="text-gray-800" x-text="currentNasabah.name"></strong>? Data tabungan dan riwayat transaksi nasabah ini juga akan terhapus permanen dari sistem.
                    </p>

                    {{-- Actions --}}
                    <div class="flex items-center justify-center gap-3">
                        <button type="button" @click="deleteModalOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-gray-200 hover:bg-gray-50 text-xs font-semibold text-gray-600 transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-bold transition-all shadow-md shadow-red-600/15 cursor-pointer">
                            Ya, Hapus Permanen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
