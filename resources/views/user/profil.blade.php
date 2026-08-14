@extends('layouts.nasabah')
@section('title', 'Profil Saya')
@section('meta-description', 'Profil dan informasi akun nasabah ARUNA.')
@section('page-title', 'Profil Saya')

@section('content')

{{-- Hero Banner --}}
<div data-reveal="flip" data-reveal-delay="50" class="bg-gradient-to-r from-primary via-[#14422e] to-primary rounded-3xl p-6 sm:p-8 text-on-primary relative overflow-hidden card-shadow mb-6 tilt-card">
    <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 float-bubble" data-parallax="0.15"></div>
    <div class="relative z-10 flex flex-col sm:flex-row sm:items-center gap-5">
        <div class="shrink-0" data-reveal="scale" data-reveal-delay="200">
            @if($user->profile_photo)
                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-xl border border-white/20 pulse-glow">
                    <img src="{{ asset($user->profile_photo) }}" alt="Avatar" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-extrabold text-primary bg-white/95 shadow-xl border border-white/20 pulse-glow">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif
        </div>
        <div>
            <span class="text-white/60 text-xs font-semibold uppercase tracking-wider block mb-1">Anggota Resmi ARUNA</span>
            <h2 class="text-2xl font-black tracking-tight" data-typewriter="{{ $user->name }}" data-typewriter-speed="50">{{ $user->name }}</h2>
            <div class="flex items-center gap-2 mt-1" data-reveal="left" data-reveal-delay="400">
                <span class="text-emerald-300 text-xs font-mono font-bold">{{ $user->no_id }}</span>
                <span class="text-white/40 text-xs">•</span>
                <span class="text-white/70 text-xs font-semibold">
                    @if($totalTransaksi >= 10)
                        Level 3 Eco-Hero
                    @elseif($totalTransaksi >= 5)
                        Level 2 Eco-Hero
                    @else
                        Eco-Citizen
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{ activeTab: 'info' }">
    {{-- Info Utama & Edit Tab Container --}}
    <div data-reveal data-reveal-delay="150" class="lg:col-span-2 bg-surface-container-lowest rounded-[2rem] border border-outline-variant/30 shadow-sm overflow-hidden flex flex-col" data-glow>
        {{-- Navigation Tabs --}}
        <div class="flex border-b border-outline-variant/20 bg-surface-container-low/10">
            <button @click="activeTab = 'info'" 
                    :class="activeTab === 'info' ? 'border-primary text-primary font-bold bg-surface-container-lowest' : 'border-transparent text-on-surface-variant/70 font-semibold hover:text-on-surface'"
                    class="flex-1 py-4 text-center border-b-2 text-xs transition-all cursor-pointer ripple-container">
                Informasi Akun
            </button>
            <button @click="activeTab = 'edit'" 
                    :class="activeTab === 'edit' ? 'border-primary text-primary font-bold bg-surface-container-lowest' : 'border-transparent text-on-surface-variant/70 font-semibold hover:text-on-surface'"
                    class="flex-1 py-4 text-center border-b-2 text-xs transition-all cursor-pointer ripple-container">
                Edit &amp; Verifikasi Profil
            </button>
        </div>

        {{-- Tab Content: View Info --}}
        <div x-show="activeTab === 'info'" class="divide-y divide-outline-variant/10 text-xs flex-1">
            <div class="px-6 py-4.5 flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4" data-reveal data-reveal-delay="200">
                <span class="w-32 text-[10px] font-bold text-on-surface-variant/50 uppercase tracking-wider shrink-0 pt-0.5">Nama Lengkap</span>
                <span class="font-bold text-on-surface text-sm">{{ $user->name }}</span>
            </div>
            <div class="px-6 py-4.5 flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4" data-reveal data-reveal-delay="250">
                <span class="w-32 text-[10px] font-bold text-on-surface-variant/50 uppercase tracking-wider shrink-0 pt-0.5">ID Nasabah</span>
                <span class="font-bold font-mono text-primary bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/10 tracking-wide text-xs w-fit">
                    {{ $user->no_id }}
                </span>
            </div>
            <div class="px-6 py-4.5 flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4" data-reveal data-reveal-delay="300">
                <span class="w-32 text-[10px] font-bold text-on-surface-variant/50 uppercase tracking-wider shrink-0 pt-0.5">No. Kartu Keluarga</span>
                <span class="font-semibold text-on-surface font-mono">{{ $user->kk_number ?? '-' }}</span>
            </div>
            <div class="px-6 py-4.5 flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4" data-reveal data-reveal-delay="350">
                <span class="w-32 text-[10px] font-bold text-on-surface-variant/50 uppercase tracking-wider shrink-0 pt-0.5">No. Telepon / WA</span>
                @if($user->phone_number)
                    <span class="font-semibold text-on-surface font-mono">{{ $user->phone_number }}</span>
                @else
                    <span class="text-rose-500 font-semibold italic flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        Belum terverifikasi (Silakan input di tab Edit)
                    </span>
                @endif
            </div>
            <div class="px-6 py-4.5 flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4" data-reveal data-reveal-delay="400">
                <span class="w-32 text-[10px] font-bold text-on-surface-variant/50 uppercase tracking-wider shrink-0 pt-0.5">Alamat Domisili</span>
                @if($user->address)
                    <span class="font-semibold text-on-surface leading-relaxed max-w-lg">{{ $user->address }}</span>
                @else
                    <span class="text-rose-500 font-semibold italic flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        Belum terverifikasi (Silakan input di tab Edit)
                    </span>
                @endif
            </div>
            <div class="px-6 py-4.5 flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4" data-reveal data-reveal-delay="450">
                <span class="w-32 text-[10px] font-bold text-on-surface-variant/50 uppercase tracking-wider shrink-0 pt-0.5">Status Keanggotaan</span>
                <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-primary bg-primary/5 px-3 py-1 rounded-full border border-primary/10 w-fit">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                    Aktif Terdaftar
                </span>
            </div>
        </div>

        {{-- Tab Content: Edit Form --}}
        <div x-show="activeTab === 'edit'" style="display: none;" class="p-6 flex-1">
            <form action="{{ route('user.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                {{-- Edit Avatar Block --}}
                <div x-data="{ photoName: null, photoPreview: null }" class="flex flex-col items-center gap-3 border-b border-outline-variant/20 pb-6">
                    <span class="text-[10px] font-bold text-on-surface-variant/50 uppercase tracking-wider">Foto Profil</span>
                    
                    {{-- Hidden File Input --}}
                    <input type="file" name="profile_photo" class="hidden" x-ref="photo" accept="image/*"
                           x-on:change="
                               photoName = $refs.photo.files[0].name;
                               const reader = new FileReader();
                               reader.onload = (e) => {
                                   photoPreview = e.target.result;
                               };
                               reader.readAsDataURL($refs.photo.files[0]);
                           " />

                    {{-- Current Avatar --}}
                    <div class="relative w-20 h-20 rounded-full overflow-hidden border border-outline-variant/30 shadow-xs shrink-0 pulse-glow" x-show="!photoPreview">
                        @if($user->profile_photo)
                            <img src="{{ asset($user->profile_photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-primary/10 text-primary flex items-center justify-center text-2xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    {{-- New Photo Preview --}}
                    <div class="relative w-20 h-20 rounded-full overflow-hidden border border-outline-variant/30 shadow-xs shrink-0" x-show="photoPreview" style="display: none;">
                        <img :src="photoPreview" class="w-full h-full object-cover">
                    </div>

                    <button type="button" class="px-4 py-1.5 border border-outline/30 rounded-xl text-[11px] font-bold text-on-surface hover:bg-surface-container transition-colors cursor-pointer ripple-container" x-on:click.prevent="$refs.photo.click()">
                        Ubah Foto Profil
                    </button>
                    <p class="text-[9px] text-on-surface-variant/50">Format JPEG/PNG, Maks. 2MB</p>
                </div>

                {{-- Edit Fields --}}
                <div class="space-y-4">
                    {{-- Name input --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-2.5 bg-surface rounded-xl border border-outline-variant/40 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                    </div>

                    {{-- Phone input --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider flex items-center gap-1">
                            Nomor Handphone / WhatsApp
                            <span class="text-[9px] text-primary/70 font-semibold lowercase font-sans">(Verifikasi Kontak)</span>
                        </label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Contoh: 08123456789"
                               class="w-full px-4 py-2.5 bg-surface rounded-xl border border-outline-variant/40 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                    </div>

                    {{-- Address textarea --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-wider flex items-center gap-1">
                            Alamat Lengkap
                            <span class="text-[9px] text-primary/70 font-semibold lowercase font-sans">(Verifikasi Domisili)</span>
                        </label>
                        <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap RT/RW, Dusun, Desa, Kec. Karawang..."
                                  class="w-full px-4 py-2.5 bg-surface rounded-xl border border-outline-variant/40 text-xs focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all resize-none">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 pt-3 border-t border-outline-variant/10">
                    <button type="button" @click="activeTab = 'info'"
                            class="px-5 py-2.5 border border-outline-variant/50 rounded-xl text-xs font-bold text-on-surface-variant hover:bg-surface-container-low transition-colors cursor-pointer ripple-container">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2.5 bg-primary text-on-primary rounded-xl text-xs font-bold hover:shadow-lg hover:shadow-primary/20 transition-all flex items-center gap-2 cursor-pointer ripple-container">
                        <span class="material-symbols-outlined text-[16px]">save</span>
                        Simpan &amp; Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Stats Cards Grid (Side Column) --}}
    <div class="space-y-4" data-stagger="150">
        {{-- Card Saldo --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300 tilt-card ripple-container" data-glow>
            <p class="text-[9px] text-on-surface-variant/50 font-bold uppercase tracking-wider">Saldo Tabungan</p>
            <h3 class="text-xl font-black text-primary mt-1 font-mono data-glow">Rp <span data-count="{{ $user->total_tabungan }}" data-count-duration="1800">{{ number_format($user->total_tabungan, 0, ',', '.') }}</span></h3>
        </div>

        {{-- Card Setoran --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300 tilt-card ripple-container" data-glow>
            <p class="text-[9px] text-on-surface-variant/50 font-bold uppercase tracking-wider">Total Sampah Disetor</p>
            <h3 class="text-xl font-black text-primary mt-1 font-mono">
                <span data-count="{{ $totalTimbangan }}" data-count-decimals="1" data-count-duration="2000">{{ number_format($totalTimbangan, 1, ',', '.') }}</span> <span class="text-xs font-bold text-on-surface-variant/60">kg</span>
            </h3>
        </div>

        {{-- Card Transaksi --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300 tilt-card ripple-container" data-glow>
            <p class="text-[9px] text-on-surface-variant/50 font-bold uppercase tracking-wider">Total Transaksi</p>
            <h3 class="text-xl font-black text-primary mt-1 font-mono">
                <span data-count="{{ $totalTransaksi }}" data-count-duration="1500">{{ $totalTransaksi }}</span> <span class="text-xs font-bold text-on-surface-variant/60">kali</span>
            </h3>
        </div>

        {{-- Card Tanggal Gabung --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/30 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300 tilt-card ripple-container" data-glow>
            <p class="text-[9px] text-on-surface-variant/50 font-bold uppercase tracking-wider">Bergabung Sejak</p>
            <h3 class="text-sm font-bold text-on-surface mt-1 font-mono">{{ $user->created_at->translatedFormat('d M Y') }}</h3>
        </div>

        {{-- Card Logout Sesi --}}
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-error-container/30 shadow-xs">
            <p class="text-[9px] text-error font-bold uppercase tracking-wider mb-2">Sesi Akses</p>
            <form method="POST" action="{{ route('user.logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 text-error bg-error-container/20 hover:bg-error-container hover:text-on-error-container border border-error-container/30 px-4 py-3 rounded-xl transition-all cursor-pointer font-bold text-xs shadow-xs">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    <span>Keluar dari Sesi Akun</span>
                </button>
            </form>
        </div>
    </div>
</div>


@endsection
