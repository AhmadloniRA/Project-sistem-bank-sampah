<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke ARUNA — Administrasi Ramah Untuk Nasabah Bank Sampah.">
    <title>Login — ARUNA</title>
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

        .login-input {
            @apply w-full px-4 py-3.5 bg-neutral-50/80 border border-neutral-200/80 rounded-xl text-neutral-800 placeholder-neutral-400 text-sm font-medium transition-all duration-300;
        }
        .login-input:hover {
            @apply border-emerald-300 bg-white;
        }
        .login-input:focus {
            @apply outline-none border-emerald-500 bg-white ring-4 ring-emerald-500/10;
        }

        .custom-checkbox:checked {
            background-color: #059669;
            border-color: #059669;
        }
        .custom-checkbox:checked::after {
            content: '✓';
            color: white;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body class="font-jakarta text-neutral-800 antialiased min-h-screen overflow-x-hidden selection:bg-emerald-500/20 selection:text-emerald-900">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- ========== LEFT SIDE: White Form Area ========== -->
        <div class="w-full lg:w-[55%] min-h-screen flex items-center justify-center bg-white relative px-6 py-12 lg:py-0">

            <!-- Subtle decorative circles on white side -->
            <div class="absolute top-[-8%] right-[-5%] w-[300px] h-[300px] bg-emerald-50 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="absolute bottom-[-5%] left-[-8%] w-[250px] h-[250px] bg-teal-50 rounded-full blur-[60px] pointer-events-none"></div>

            <div class="relative z-10 w-full max-w-[420px] animate-slide-up">

                <!-- Logo & Title -->
                <div class="mb-10">
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
                    <h1 class="text-3xl font-extrabold text-neutral-900 mb-2 tracking-tight">Masuk ke Akun Anda</h1>
                    <p class="text-neutral-500 text-sm font-medium">Selamat datang kembali! Silakan masukkan data Anda.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-emerald-500 shrink-0">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

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

                <!-- Login Form -->
                <form method="POST" action="{{ route('user.login.submit') }}" class="space-y-5">
                    @csrf

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
                                autofocus
                                autocomplete="username"
                                placeholder="contoh@email.com"
                                class="w-full h-16 pl-14 pr-4 rounded-2xl border border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"

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
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full h-16 pl-14 pr-4 rounded-2xl border border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"

                            >
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-neutral-400 hover:text-emerald-600 transition-colors" tabindex="-1">
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

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center gap-2.5 cursor-pointer group">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="custom-checkbox w-4 h-4 rounded border-2 border-neutral-300 bg-white appearance-none cursor-pointer transition-all duration-200"
                            >
                            <span class="text-neutral-500 text-sm font-semibold group-hover:text-emerald-600 transition-colors">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-3.5 px-6 mt-2 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white font-bold text-sm rounded-xl transition-all duration-300 shadow-lg shadow-emerald-500/25 hover:shadow-xl hover:shadow-emerald-500/30 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 group"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-0.5 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        Masuk ke Akun
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-neutral-200"></div>
                    <span class="text-neutral-400 text-xs font-semibold uppercase tracking-wider">atau</span>
                    <div class="flex-1 h-px bg-neutral-200"></div>
                </div>

                <!-- Register Link -->
                <a
                    href="/register"
                    class="w-full py-3.5 px-6 bg-neutral-50 hover:bg-emerald-50 border border-neutral-200 hover:border-emerald-300 text-neutral-700 hover:text-emerald-700 font-semibold text-sm rounded-xl cursor-pointer transition-all duration-300 flex items-center justify-center gap-2 group"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-neutral-400 group-hover:text-emerald-500 transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    Belum punya akun? Daftar Sekarang
                </a>

                <!-- Back to Home -->
                <div class="text-center mt-8">
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
            <div class="absolute top-[50%] left-[50%] -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] bg-white/5 rounded-full blur-[80px] pointer-events-none"></div>

            <!-- Decorative floating elements -->
            <div class="absolute top-[8%] right-[10%] text-[3.5rem] animate-float opacity-20">🌿</div>
            <div class="absolute bottom-[12%] right-[15%] text-[2.5rem] animate-float-slow opacity-15">🌱</div>
            <div class="absolute top-[20%] left-[8%] text-[2rem] animate-float opacity-12" style="animation-delay: 1.5s;">🍃</div>
            <div class="absolute bottom-[20%] left-[10%] text-[1.5rem] animate-float-slow opacity-10" style="animation-delay: 2.5s;">♻️</div>
            <div class="absolute bottom-[8%] left-[25%] w-[80px] h-[80px] border-2 border-white/10 rounded-full animate-spin-slow"></div>
            <div class="absolute top-[12%] right-[30%] w-[50px] h-[50px] border border-white/8 animate-blob" style="border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;"></div>

            <!-- Content -->
            <div class="relative z-10 max-w-md animate-slide-right">
                <!-- Glass card -->
                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-3xl p-10 shadow-2xl">
                    <div class="w-16 h-16 bg-white/15 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20 mb-8">
                        <img src="https://img.icons8.com/?size=100&id=ngxhKjJtc4LX&format=png&color=ffffff" alt="Recycle" class="w-9 h-9">
                    </div>

                    <h2 class="text-3xl font-extrabold text-white mb-4 leading-tight">
                        Kelola Sampah,<br>Jaga Lingkungan
                    </h2>

                    <p class="text-emerald-100/80 text-base leading-relaxed mb-8 font-medium">
                        ARUNA (Administrasi Ramah Untuk Nasabah Bank Sampah) hadir untuk memudahkan nasabah dalam mengelola, menyetor, dan memantau nilai sampah secara transparan.
                    </p>

                    <!-- Feature pills -->
                    <div class="flex flex-wrap gap-2.5">
                        <div class="flex items-center gap-2 py-2 px-4 bg-white/10 border border-white/15 rounded-full text-emerald-100 text-xs font-semibold backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-emerald-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Setoran Mudah
                        </div>
                        <div class="flex items-center gap-2 py-2 px-4 bg-white/10 border border-white/15 rounded-full text-emerald-100 text-xs font-semibold backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-emerald-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Riwayat Lengkap
                        </div>
                        <div class="flex items-center gap-2 py-2 px-4 bg-white/10 border border-white/15 rounded-full text-emerald-100 text-xs font-semibold backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-emerald-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Saldo Transparan
                        </div>
                        <div class="flex items-center gap-2 py-2 px-4 bg-white/10 border border-white/15 rounded-full text-emerald-100 text-xs font-semibold backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-emerald-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Ramah Lingkungan
                        </div>
                    </div>
                </div>

                <!-- Stats row -->
                <div class="grid grid-cols-3 gap-3 mt-6">
                    <div class="bg-white/8 backdrop-blur-sm border border-white/10 rounded-2xl p-4 text-center">
                        <div class="text-2xl font-extrabold text-white animate-pulse-soft">500+</div>
                        <div class="text-emerald-200/60 text-[11px] font-semibold mt-1">Nasabah Aktif</div>
                    </div>
                    <div class="bg-white/8 backdrop-blur-sm border border-white/10 rounded-2xl p-4 text-center">
                        <div class="text-2xl font-extrabold text-white animate-pulse-soft" style="animation-delay: 0.5s;">2 Ton</div>
                        <div class="text-emerald-200/60 text-[11px] font-semibold mt-1">Sampah Terkelola</div>
                    </div>
                    <div class="bg-white/8 backdrop-blur-sm border border-white/10 rounded-2xl p-4 text-center">
                        <div class="text-2xl font-extrabold text-white animate-pulse-soft" style="animation-delay: 1s;">98%</div>
                        <div class="text-emerald-200/60 text-[11px] font-semibold mt-1">Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Toggle Password Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

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
