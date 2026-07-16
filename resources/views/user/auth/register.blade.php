<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Daftar akun ARUNA — Administrasi Ramah Untuk Nasabah Bank Sampah.">
    <title>Daftar — ARUNA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-jakarta: 'Plus Jakarta Sans', sans-serif;
            --animate-fade-in: fadeIn 0.7s ease-out both;
            --animate-slide-up: slideUp 0.7s ease-out both;
            --animate-slide-right: slideRight 0.8s ease-out both;
            --animate-float: float 6s ease-in-out infinite;
            --animate-float-slow: floatSlow 8s ease-in-out infinite;
            --animate-spin-slow: spinSlow 25s linear infinite;
            --animate-blob: blob 10s ease-in-out infinite;
            --animate-pulse-soft: pulseSoft 3s ease-in-out infinite;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideRight {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-18px); }
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(4deg); }
        }
        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes blob {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        }
        @keyframes pulseSoft {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        .register-input {
            @apply w-full px-4 py-3.5 bg-neutral-50/80 border border-neutral-200/80 rounded-xl text-neutral-800 placeholder-neutral-400 text-sm font-medium transition-all duration-300;
        }
        .register-input:hover {
            @apply border-emerald-300 bg-white;
        }
        .register-input:focus {
            @apply outline-none border-emerald-500 bg-white ring-4 ring-emerald-500/10;
        }
    </style>
</head>
<body class="font-jakarta text-neutral-800 antialiased min-h-screen overflow-x-hidden selection:bg-emerald-500/20 selection:text-emerald-900">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- ========== LEFT SIDE: White Form Area ========== -->
        <div class="w-full lg:w-[55%] min-h-screen flex items-center justify-center bg-white relative px-6 py-12 lg:py-0">

            <!-- Subtle decorative circles -->
            <div class="absolute top-[-8%] right-[-5%] w-[300px] h-[300px] bg-emerald-50 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="absolute bottom-[-5%] left-[-8%] w-[250px] h-[250px] bg-teal-50 rounded-full blur-[60px] pointer-events-none"></div>

            <div class="relative z-10 w-full max-w-[420px] animate-slide-up">

                <!-- Logo & Title -->
                <div class="mb-8">
                    <a href="/" class="inline-flex items-center gap-3 mb-6 group">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:shadow-emerald-500/40 transition-shadow duration-300">
                            <img
                                src="https://img.icons8.com/?size=100&id=ngxhKjJtc4LX&format=png&color=ffffff"
                                alt="Recycle Icon"
                                class="w-6 h-6"
                            >
                        </div>
                        <span class="text-xl font-extrabold text-neutral-800">ARUNA</span>
                    </a>
                    <h1 class="text-3xl font-extrabold text-neutral-900 mb-2 tracking-tight">Buat Akun Baru</h1>
                    <p class="text-neutral-500 text-sm font-medium">Bergabunglah bersama kami untuk lingkungan yang lebih bersih.</p>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
                        <div class="text-red-700 text-sm font-bold mb-1.5 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                            </svg>
                            Terjadi kesalahan
                        </div>
                        <ul class="list-disc list-inside text-red-600/90 text-sm font-medium space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Register Form -->
                <form method="POST" action="{{ route('user.register.submit') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-neutral-700 text-sm font-bold mb-2">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-neutral-400 group-focus-within:text-emerald-500 transition-colors duration-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Masukkan nama lengkap"
                                class="w-full h-14 pl-12 pr-4 rounded-2xl border border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
                            >
                        </div>
                    </div>

                    <!-- No Kartu Keluarga (KK) -->
                    <div>
                        <label for="kk_number" class="block text-neutral-700 text-sm font-bold mb-2">No. Kartu Keluarga (KK)</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-neutral-400 group-focus-within:text-emerald-500 transition-colors duration-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm-1.25 6c0-1.217-.983-2.203-2.2-2.203-1.217 0-2.2.986-2.2 2.203v.273h8.8v-.273Z" />
                                </svg>
                            </div>
                            <input
                                id="kk_number"
                                type="text"
                                name="kk_number"
                                value="{{ old('kk_number') }}"
                                required
                                maxlength="16"
                                placeholder="16 digit No. KK"
                                class="w-full h-14 pl-12 pr-4 rounded-2xl border border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 16)"
                            >
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-neutral-700 text-sm font-bold mb-2">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-neutral-400 group-focus-within:text-emerald-500 transition-colors duration-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="contoh@email.com"
                                class="w-full h-14 pl-12 pr-4 rounded-2xl border border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"

                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-neutral-700 text-sm font-bold mb-2">Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-neutral-400 group-focus-within:text-emerald-500 transition-colors duration-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Minimal 8 karakter"
                                class="w-full h-14 pl-12 pr-4 rounded-2xl border border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"

                            >
                            <button type="button" onclick="togglePassword('password', 'eyeIcon', 'eyeSlashIcon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-neutral-400 hover:text-emerald-600 transition-colors" tabindex="-1">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg id="eyeSlashIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-neutral-700 text-sm font-bold mb-2">Konfirmasi Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-neutral-400 group-focus-within:text-emerald-500 transition-colors duration-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                </svg>
                            </div>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi kata sandi"
                                class="w-full h-14 pl-12 pr-4 rounded-2xl border border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"

                            >
                            <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2', 'eyeSlashIcon2')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-neutral-400 hover:text-emerald-600 transition-colors" tabindex="-1">
                                <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg id="eyeSlashIcon2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-3.5 px-6 mt-2 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white font-bold text-sm rounded-xl transition-all duration-300 shadow-lg shadow-emerald-500/25 hover:shadow-xl hover:shadow-emerald-500/30 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 group"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Daftar Sekarang
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-4 my-5">
                    <div class="flex-1 h-px bg-neutral-200"></div>
                    <span class="text-neutral-400 text-xs font-semibold uppercase tracking-wider">atau</span>
                    <div class="flex-1 h-px bg-neutral-200"></div>
                </div>

                <!-- Login Link -->
                <a
                    href="/login"
                    class="w-full py-3.5 px-6 bg-neutral-50 hover:bg-emerald-50 border border-neutral-200 hover:border-emerald-300 text-neutral-700 hover:text-emerald-700 font-semibold text-sm rounded-xl cursor-pointer transition-all duration-300 flex items-center justify-center gap-2 group"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-neutral-400 group-hover:text-emerald-500 transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Sudah punya akun? Masuk
                </a>

                <!-- Back to Home -->
                <div class="text-center mt-6">
                    <a href="/" class="inline-flex items-center gap-2 text-neutral-400 hover:text-emerald-600 text-sm font-medium transition-all duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover:-translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- ========== RIGHT SIDE: Green Branding Panel ========== -->
        <div class="hidden lg:flex w-[45%] bg-gradient-to-br from-emerald-900 via-emerald-700 to-teal-600 relative items-center justify-center p-16 overflow-hidden">

            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 1.5px 1.5px, white 1px, transparent 0); background-size: 28px 28px;"></div>

            <!-- Glowing Orbs -->
            <div class="absolute top-[-15%] right-[-10%] w-[450px] h-[450px] bg-emerald-400/20 rounded-full blur-[100px] pointer-events-none animate-blob"></div>
            <div class="absolute bottom-[-15%] left-[-10%] w-[400px] h-[400px] bg-teal-300/15 rounded-full blur-[90px] pointer-events-none animate-blob" style="animation-delay: 3s;"></div>

            <!-- Decorative floating elements -->
            <div class="absolute top-[8%] right-[10%] text-[3.5rem] animate-float opacity-20">🌿</div>
            <div class="absolute bottom-[12%] right-[15%] text-[2.5rem] animate-float-slow opacity-15">🌱</div>
            <div class="absolute top-[20%] left-[8%] text-[2rem] animate-float opacity-12" style="animation-delay: 1.5s;">🍃</div>
            <div class="absolute bottom-[8%] left-[25%] w-[80px] h-[80px] border-2 border-white/10 rounded-full animate-spin-slow"></div>

            <!-- Content -->
            <div class="relative z-10 max-w-md animate-slide-right">
                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-3xl p-10 shadow-2xl">
                    <div class="w-16 h-16 bg-white/15 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20 mb-8">
                        <img src="https://img.icons8.com/?size=100&id=ngxhKjJtc4LX&format=png&color=ffffff" alt="Recycle" class="w-9 h-9">
                    </div>

                    <h2 class="text-3xl font-extrabold text-white mb-4 leading-tight">
                        Bergabung Sekarang!
                    </h2>

                    <p class="text-emerald-100/80 text-base leading-relaxed mb-8 font-medium">
                        Jadilah bagian dari komunitas peduli lingkungan. Kelola sampah Anda dengan mudah dan dapatkan nilai ekonomi dari sampah yang Anda setor.
                    </p>

                    <!-- Steps -->
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-9 h-9 rounded-full bg-white/15 border border-white/20 flex items-center justify-center text-white font-bold text-sm shrink-0">1</div>
                            <div>
                                <div class="text-white font-bold text-sm">Daftar Akun</div>
                                <div class="text-emerald-200/60 text-xs font-medium mt-0.5">Buat akun gratis dalam hitungan detik</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-9 h-9 rounded-full bg-white/15 border border-white/20 flex items-center justify-center text-white font-bold text-sm shrink-0">2</div>
                            <div>
                                <div class="text-white font-bold text-sm">Setor Sampah</div>
                                <div class="text-emerald-200/60 text-xs font-medium mt-0.5">Kunjungi lokasi ARUNA terdekat</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-9 h-9 rounded-full bg-white/15 border border-white/20 flex items-center justify-center text-white font-bold text-sm shrink-0">3</div>
                            <div>
                                <div class="text-white font-bold text-sm">Dapatkan Saldo</div>
                                <div class="text-emerald-200/60 text-xs font-medium mt-0.5">Pantau saldo dan riwayat transaksi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Toggle Password Script -->
    <script>
        function togglePassword(inputId, eyeId, eyeSlashId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(eyeId);
            const eyeSlashIcon = document.getElementById(eyeSlashId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
