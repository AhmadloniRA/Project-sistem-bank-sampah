<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Bank Sampah — Platform pengelolaan sampah berbasis masyarakat.">
    <title>Login — Bank Sampah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-jakarta: 'Plus Jakarta Sans', sans-serif;

            --animate-fade-in-up: fadeInUp 0.8s ease-out both;
            --animate-fade-in-down: fadeInDown 0.8s ease-out 0.2s both;
            --animate-float: float 6s ease-in-out infinite;
            --animate-float-slow: floatSlow 8s ease-in-out infinite;
            --animate-pulse-glow: pulse-glow 2s ease-in-out infinite;
            --animate-spin-slow: spin-slow 20s linear infinite;
            --animate-blob: blob 8s ease-in-out infinite;
            --animate-blob-reverse: blob 10s ease-in-out infinite reverse;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3); }
            50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.6); }
        }

        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes blob {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        }

        /* Focus ring for inputs */
        .login-input:focus {
            outline: none;
            border-color: rgba(52, 211, 153, 0.6);
            box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.15), 0 0 20px rgba(52, 211, 153, 0.1);
        }

        /* Custom checkbox */
        .custom-checkbox:checked {
            background-color: #10b981;
            border-color: #10b981;
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
<body class="font-jakarta text-neutral-800 bg-neutral-50 leading-relaxed overflow-x-hidden [&_a]:no-underline [&_a]:text-inherit [&_img]:max-w-full [&_img]:block">

    <!-- ===== FULL-PAGE LOGIN ===== -->
    <section class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-green-950 via-green-800 via-60% to-green-500">

        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-[-20%] right-[-10%] w-[700px] h-[700px] bg-[radial-gradient(circle,rgba(52,211,153,0.25)_0%,transparent_70%)] animate-blob"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-[radial-gradient(circle,rgba(45,212,191,0.15)_0%,transparent_70%)] animate-blob-reverse"></div>
            <div class="absolute top-[40%] left-[50%] w-[300px] h-[300px] bg-[radial-gradient(circle,rgba(16,185,129,0.12)_0%,transparent_70%)] animate-blob" style="animation-delay: 2s;"></div>
        </div>

        <!-- Floating decorative elements -->
        <div class="absolute pointer-events-none z-[1] top-[10%] right-[8%] text-[4rem] animate-float opacity-15">🌿</div>
        <div class="absolute pointer-events-none z-[1] bottom-[15%] right-[12%] text-[3rem] animate-float-slow opacity-10">🌱</div>
        <div class="absolute pointer-events-none z-[1] top-[25%] left-[5%] text-[2.5rem] animate-float opacity-10" style="animation-delay: 1s;">🍃</div>
        <div class="absolute pointer-events-none z-[1] bottom-[25%] left-[8%] text-[2rem] animate-float-slow opacity-8" style="animation-delay: 2s;">♻️</div>
        <div class="absolute pointer-events-none z-[1] bottom-[10%] left-[15%] w-[100px] h-[100px] border-2 border-white/8 rounded-full animate-spin-slow"></div>
        <div class="absolute pointer-events-none z-[1] top-[15%] right-[25%] w-[60px] h-[60px] border-2 border-white/6 animate-blob" style="border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;"></div>
        <div class="absolute pointer-events-none z-[1] top-[60%] right-[5%] w-[40px] h-[40px] border border-white/5 animate-spin-slow" style="animation-duration: 15s; border-radius: 40% 60% 60% 40% / 60% 40% 60% 40%;"></div>

        <!-- Login Content -->
        <div class="relative z-[2] w-full max-w-[460px] mx-auto px-6 py-12">

            <!-- Logo / Brand -->
            <div class="text-center mb-10 animate-fade-in-down">
                <a href="/" class="inline-flex items-center gap-3 mb-4">
                    <div class="w-14 h-14 bg-white/15 backdrop-blur-[10px] rounded-2xl flex items-center justify-center border border-white/20 shadow-lg">
                        <img
                            src="https://img.icons8.com/?size=100&id=ngxhKjJtc4LX&format=png&color=000000"
                            alt="Recycle Icon"
                            class="w-8 h-8"
                        >
                    </div>
                    <span class="text-2xl font-extrabold text-white">Bank Sampah</span>
                </a>
                <p class="text-white/60 text-sm font-medium">Masuk ke akun nasabah Anda</p>
            </div>

            <!-- Login Card (Glassmorphism) -->
            <div class="bg-white/10 backdrop-blur-[24px] border border-white/15 rounded-2xl p-8 md:p-10 shadow-[0_8px_32px_rgba(0,0,0,0.15)] animate-fade-in-up">

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-3 rounded-lg bg-green-500/20 border border-green-400/30 text-green-200 text-sm font-medium text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-500/20 border border-red-400/30">
                        <div class="text-red-200 text-sm font-semibold mb-2">Terjadi kesalahan:</div>
                        <ul class="list-disc list-inside text-red-300 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('user.login.submit') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-white/80 text-sm font-semibold mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-green-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                                Alamat Email
                            </span>
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="contoh@email.com"
                            class="login-input w-full px-4 py-3.5 bg-white/8 border border-white/15 rounded-xl text-white placeholder-white/30 text-sm font-medium transition-all duration-300 hover:border-white/25"
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-white/80 text-sm font-semibold mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-green-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                                Kata Sandi
                            </span>
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="login-input w-full px-4 py-3.5 bg-white/8 border border-white/15 rounded-xl text-white placeholder-white/30 text-sm font-medium transition-all duration-300 hover:border-white/25 pr-12"
                            >
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/70 transition-colors duration-200" tabindex="-1">
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
                                class="custom-checkbox w-4 h-4 rounded border-2 border-white/25 bg-white/5 appearance-none cursor-pointer transition-all duration-200"
                            >
                            <span class="text-white/60 text-sm font-medium group-hover:text-white/80 transition-colors duration-200">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-3.5 px-6 bg-gradient-to-br from-green-500 to-teal-500 text-white font-bold text-sm rounded-xl border-none cursor-pointer transition-all duration-300 shadow-[0_4px_15px_rgba(16,185,129,0.4)] hover:-translate-y-0.5 hover:shadow-[0_8px_25px_rgba(16,185,129,0.5)] active:translate-y-0 active:shadow-[0_2px_10px_rgba(16,185,129,0.3)] flex items-center justify-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        Masuk ke Akun
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-white/10"></div>
                    <span class="text-white/30 text-xs font-medium uppercase tracking-wider">atau</span>
                    <div class="flex-1 h-px bg-white/10"></div>
                </div>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="w-full py-3.5 px-6 bg-white/8 hover:bg-white/15 border border-white/15 hover:border-white/25 text-white font-semibold text-sm rounded-xl cursor-pointer transition-all duration-300 flex items-center justify-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Buat Akun Baru
                    </a>
                @endif
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-8 animate-fade-in-up" style="animation-delay: 0.4s;">
                <a href="/" class="inline-flex items-center gap-2 text-white/50 hover:text-white/80 text-sm font-medium transition-all duration-300 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </section>

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
