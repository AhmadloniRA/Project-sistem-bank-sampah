@extends('layouts.admin')

@section('title', 'Pengaturan Panel Admin')
@section('page-title', 'Pengaturan & Profil')

@section('content')
<div class="max-w-5xl mx-auto space-y-6" x-data="{ 
    activeTab: 'profile',
    photoPreview: '{{ $admin->profile_photo ? asset($admin->profile_photo) : '' }}',
    showCurrentPass: false,
    showNewPass: false,
    showConfirmPass: false
}">

    {{-- Page Header --}}
    <div class="bg-surface-container-lowest p-6 sm:p-8 rounded-3xl border border-outline-variant/40 shadow-xs flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-primary-container/20 text-primary flex items-center justify-center shrink-0 border border-primary/20 shadow-xs">
                <span class="material-symbols-outlined text-[32px]">manage_accounts</span>
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-on-surface tracking-tight">Pengaturan &amp; Profil Admin</h1>
                <p class="text-xs text-on-surface-variant font-medium mt-1">Kelola informasi akun pengelola, keamanan password, dan lihat rincian sistem ARUNA.</p>
            </div>
        </div>
        <div class="flex items-center gap-2 bg-surface-container px-3 py-1.5 rounded-full text-xs font-bold text-primary border border-outline-variant/30">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Akun Aktif: {{ $admin->name ?? 'Admin Utama' }}</span>
        </div>
    </div>

    {{-- Tabs Navigation --}}
    <div class="flex items-center gap-2 border-b border-outline-variant/40 overflow-x-auto pb-2 scrollbar-none">
        <button @click="activeTab = 'profile'"
                :class="activeTab === 'profile' ? 'bg-primary text-white shadow-sm font-bold' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container font-semibold'"
                class="flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs transition-all duration-200 cursor-pointer whitespace-nowrap">
            <span class="material-symbols-outlined text-[18px]">person</span>
            <span>Profil Pengelola</span>
        </button>

        <button @click="activeTab = 'security'"
                :class="activeTab === 'security' ? 'bg-primary text-white shadow-sm font-bold' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container font-semibold'"
                class="flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs transition-all duration-200 cursor-pointer whitespace-nowrap">
            <span class="material-symbols-outlined text-[18px]">lock</span>
            <span>Keamanan &amp; Password</span>
        </button>

        <button @click="activeTab = 'system'"
                :class="activeTab === 'system' ? 'bg-primary text-white shadow-sm font-bold' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container font-semibold'"
                class="flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs transition-all duration-200 cursor-pointer whitespace-nowrap">
            <span class="material-symbols-outlined text-[18px]">info</span>
            <span>Informasi Sistem</span>
        </button>
    </div>

    {{-- ============================================================ --}}
    {{-- TAB 1: PROFIL ADMIN --}}
    {{-- ============================================================ --}}
    <div x-show="activeTab === 'profile'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0">
        
        <form action="{{ route('admin.settings.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-surface-container-lowest p-6 sm:p-8 rounded-3xl border border-outline-variant/40 shadow-xs space-y-6">
            @csrf
            @method('PUT')

            <div class="border-b border-outline-variant/30 pb-4">
                <h2 class="text-base font-bold text-on-surface">Informasi Akun Admin</h2>
                <p class="text-xs text-on-surface-variant">Perbarui nama lengkap, email, nomor telepon, dan foto profil Anda.</p>
            </div>

            {{-- Avatar Section --}}
            <div class="flex flex-col sm:flex-row items-center gap-6 p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30">
                <div class="relative group">
                    <template x-if="photoPreview">
                        <img :src="photoPreview" alt="Foto Profil Admin" class="w-24 h-24 rounded-full object-cover border-2 border-primary shadow-sm">
                    </template>
                    <template x-if="!photoPreview">
                        <div class="w-24 h-24 rounded-full bg-primary/10 text-primary flex items-center justify-center font-extrabold text-2xl border-2 border-primary/20 shadow-sm">
                            {{ strtoupper(substr($admin->name ?? $admin->email ?? 'A', 0, 2)) }}
                        </div>
                    </template>
                </div>

                <div class="space-y-2 text-center sm:text-left flex-1">
                    <h3 class="text-sm font-bold text-on-surface">Foto Profil Administrator</h3>
                    <p class="text-[11px] text-on-surface-variant">Format gambar: JPG, PNG, WEBP (Maksimal 2MB). Foto ini akan ditampilkan di bilah navigasi admin.</p>
                    
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 pt-1">
                        <label for="profile_photo" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white text-xs font-bold rounded-xl hover:bg-primary-container transition-all cursor-pointer shadow-xs active:scale-95">
                            <span class="material-symbols-outlined text-[16px]">upload</span>
                            <span>Pilih Foto Baru</span>
                        </label>
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden"
                               @change="
                                   const file = $event.target.files[0];
                                   if (file) {
                                       const reader = new FileReader();
                                       reader.onload = (e) => { photoPreview = e.target.result; };
                                       reader.readAsDataURL(file);
                                   }
                               ">
                    </div>
                </div>
            </div>

            {{-- Input Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Admin --}}
                <div class="space-y-1.5">
                    <label for="name" class="block text-xs font-bold text-on-surface">Nama Lengkap Admin <span class="text-error">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant/60">
                            <span class="material-symbols-outlined text-[18px]">badge</span>
                        </span>
                        <input type="text" id="name" name="name" value="{{ old('name', $admin->name ?? '') }}" placeholder="Contoh: Supriadi (Pengelola)" required
                               class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant/50 rounded-xl text-xs font-medium text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                {{-- Email --}}
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold text-on-surface">Alamat Email <span class="text-error">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant/60">
                            <span class="material-symbols-outlined text-[18px]">mail</span>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email', $admin->email ?? '') }}" placeholder="admin@aruna.com" required
                               class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant/50 rounded-xl text-xs font-medium text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                {{-- Phone Number --}}
                <div class="space-y-1.5 md:col-span-2">
                    <label for="phone_number" class="block text-xs font-bold text-on-surface">Nomor Telepon / WhatsApp (Opsional)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant/60">
                            <span class="material-symbols-outlined text-[18px]">call</span>
                        </span>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $admin->phone_number ?? '') }}" placeholder="Contoh: 081234567890"
                               class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-outline-variant/50 rounded-xl text-xs font-medium text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                    <p class="text-[10px] text-on-surface-variant">Digunakan untuk kontak darurat antar pengelola bank sampah.</p>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="pt-4 border-t border-outline-variant/30 flex justify-end">
                <button type="submit" class="flex items-center gap-2 px-6 py-3 bg-primary text-white text-xs font-bold rounded-xl hover:bg-primary-container transition-all shadow-md active:scale-95 cursor-pointer">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span>Simpan Perubahan Profil</span>
                </button>
            </div>
        </form>
    </div>

    {{-- ============================================================ --}}
    {{-- TAB 2: KEAMANAN & PASSWORD --}}
    {{-- ============================================================ --}}
    <div x-show="activeTab === 'security'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         style="display:none;">
        
        <form action="{{ route('admin.settings.password.update') }}" method="POST" class="bg-surface-container-lowest p-6 sm:p-8 rounded-3xl border border-outline-variant/40 shadow-xs space-y-6">
            @csrf
            @method('PUT')

            <div class="border-b border-outline-variant/30 pb-4">
                <h2 class="text-base font-bold text-on-surface">Pembaruan Kata Sandi</h2>
                <p class="text-xs text-on-surface-variant">Pastikan akun administrator Anda terlindungi dengan kombinasi password yang kuat.</p>
            </div>

            <div class="space-y-5 max-w-xl">
                {{-- Current Password --}}
                <div class="space-y-1.5">
                    <label for="current_password" class="block text-xs font-bold text-on-surface">Password Saat Ini <span class="text-error">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant/60">
                            <span class="material-symbols-outlined text-[18px]">key</span>
                        </span>
                        <input :type="showCurrentPass ? 'text' : 'password'" id="current_password" name="current_password" required placeholder="Masukkan password lama Anda"
                               class="w-full pl-10 pr-10 py-3 bg-surface-container-low border border-outline-variant/50 rounded-xl text-xs font-medium text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                        <button type="button" @click="showCurrentPass = !showCurrentPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-on-surface-variant/60 hover:text-on-surface">
                            <span class="material-symbols-outlined text-[18px]" x-text="showCurrentPass ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>

                {{-- New Password --}}
                <div class="space-y-1.5">
                    <label for="new_password" class="block text-xs font-bold text-on-surface">Password Baru <span class="text-error">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant/60">
                            <span class="material-symbols-outlined text-[18px]">lock_reset</span>
                        </span>
                        <input :type="showNewPass ? 'text' : 'password'" id="new_password" name="new_password" required placeholder="Minimal 6 karakter"
                               class="w-full pl-10 pr-10 py-3 bg-surface-container-low border border-outline-variant/50 rounded-xl text-xs font-medium text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                        <button type="button" @click="showNewPass = !showNewPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-on-surface-variant/60 hover:text-on-surface">
                            <span class="material-symbols-outlined text-[18px]" x-text="showNewPass ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="space-y-1.5">
                    <label for="new_password_confirmation" class="block text-xs font-bold text-on-surface">Konfirmasi Password Baru <span class="text-error">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant/60">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        </span>
                        <input :type="showConfirmPass ? 'text' : 'password'" id="new_password_confirmation" name="new_password_confirmation" required placeholder="Ulangi password baru Anda"
                               class="w-full pl-10 pr-10 py-3 bg-surface-container-low border border-outline-variant/50 rounded-xl text-xs font-medium text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                        <button type="button" @click="showConfirmPass = !showConfirmPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-on-surface-variant/60 hover:text-on-surface">
                            <span class="material-symbols-outlined text-[18px]" x-text="showConfirmPass ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Tips Card --}}
            <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-900 flex items-start gap-3">
                <span class="material-symbols-outlined text-amber-600 text-[22px] shrink-0 mt-0.5">shield</span>
                <div class="text-xs space-y-1">
                    <p class="font-bold">Tips Keamanan Akun Administrator:</p>
                    <ul class="list-disc pl-4 text-[11px] space-y-0.5 text-amber-800">
                        <li>Gunakan kombinasi huruf kapital, huruf kecil, angka, dan simbol.</li>
                        <li>Jangan bagikan kata sandi admin Anda kepada pihak yang tidak berwenang.</li>
                        <li>Selalu lakukan <i>Logout</i> setelah selesai mengelola data di komputer publik/bersama.</li>
                    </ul>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="pt-4 border-t border-outline-variant/30 flex justify-end">
                <button type="submit" class="flex items-center gap-2 px-6 py-3 bg-primary text-white text-xs font-bold rounded-xl hover:bg-primary-container transition-all shadow-md active:scale-95 cursor-pointer">
                    <span class="material-symbols-outlined text-[18px]">security</span>
                    <span>Perbarui Password</span>
                </button>
            </div>
        </form>
    </div>

    {{-- ============================================================ --}}
    {{-- TAB 3: INFORMASI SISTEM & BANK SAMPAH --}}
    {{-- ============================================================ --}}
    <div x-show="activeTab === 'system'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         style="display:none;"
         class="space-y-6">
        
        <div class="bg-surface-container-lowest p-6 sm:p-8 rounded-3xl border border-outline-variant/40 shadow-xs space-y-6">
            <div class="border-b border-outline-variant/30 pb-4">
                <h2 class="text-base font-bold text-on-surface">Informasi &amp; Status Sistem</h2>
                <p class="text-xs text-on-surface-variant">Rincian versi aplikasi, lingkungan server, dan status pengoperasian Bank Sampah Digital ARUNA.</p>
            </div>

            {{-- Status Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Platform Version --}}
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30 space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant">Versi Platform</span>
                    <p class="text-lg font-extrabold text-primary">v2.4.0 (ARUNA)</p>
                    <p class="text-[11px] text-on-surface-variant/70">Laravel {{ app()->version() }}</p>
                </div>

                {{-- PHP Version --}}
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30 space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant">Versi PHP</span>
                    <p class="text-lg font-extrabold text-on-surface">PHP {{ PHP_VERSION }}</p>
                    <p class="text-[11px] text-on-surface-variant/70">Zend Engine Built-in</p>
                </div>

                {{-- Timezone --}}
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30 space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant">Zona Waktu Server</span>
                    <p class="text-lg font-extrabold text-on-surface">{{ config('app.timezone', 'Asia/Jakarta') }}</p>
                    <p class="text-[11px] text-on-surface-variant/70">{{ date('d M Y, H:i') }} WIB</p>
                </div>

                {{-- System Status --}}
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-950 space-y-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700">Status Layanan</span>
                    <p class="text-lg font-extrabold text-emerald-700 flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Normal</span>
                    </p>
                    <p class="text-[11px] text-emerald-800 font-medium">Database &amp; Storage OK</p>
                </div>
            </div>

            {{-- System Description & Support Card --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="p-5 rounded-2xl bg-surface-container border border-outline-variant/40 space-y-3">
                    <div class="flex items-center gap-3 text-primary font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">nature_people</span>
                        <span>Tentang Bank Sampah ARUNA</span>
                    </div>
                    <p class="text-xs text-on-surface-variant leading-relaxed">
                        ARUNA Digital merupakan platform pencatatan transaksi bank sampah berbasis digital yang dikembangkan untuk memfasilitasi tabungan nasabah, pencatatan setoran sampah, gudang stok, dan pembukuan arus kas pengelola secara transparan dan efisien.
                    </p>
                </div>

                <div class="p-5 rounded-2xl bg-surface-container border border-outline-variant/40 space-y-3">
                    <div class="flex items-center gap-3 text-primary font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">contact_support</span>
                        <span>Bantuan &amp; Pengembang</span>
                    </div>
                    <p class="text-xs text-on-surface-variant leading-relaxed">
                        Jika Anda mengalami kendala teknis atau membutuhkan penambahan fitur pada sistem ini, silakan hubungi tim pengembang KKN / Administrator Teknis Bank Sampah.
                    </p>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
