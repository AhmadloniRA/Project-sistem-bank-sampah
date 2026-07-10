<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bank Sampah - Platform pengelolaan sampah berbasis masyarakat. Tukarkan sampahmu menjadi rupiah, wujudkan lingkungan bersih dan sejahtera.">
    <title>Bank Sampah — Sampahmu Bernilai, Lingkungan Lestari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        /* ===== CUSTOM THEME ===== */
        @theme {
            --font-jakarta: 'Plus Jakarta Sans', sans-serif;

            --animate-fade-in-up: fadeInUp 1s ease-out;
            --animate-fade-in-left: fadeInLeft 1s ease-out;
            --animate-fade-in-right: fadeInRight 1s ease-out 0.3s both;
            --animate-float: float 6s ease-in-out infinite;
            --animate-float-slow: floatSlow 8s ease-in-out infinite;
            --animate-pulse-glow: pulse-glow 2s ease-in-out infinite;
            --animate-spin-slow: spin-slow 20s linear infinite;
            --animate-blob: blob 8s ease-in-out infinite;
            --animate-blob-reverse: blob 10s ease-in-out infinite reverse;
            --animate-blob-fast: blob 6s ease-in-out infinite;
        }

        /* ===== KEYFRAMES ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
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

        /* ===== SCROLL ANIMATION ===== */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .animate-delay-1 { transition-delay: 0.1s; }
        .animate-delay-2 { transition-delay: 0.2s; }
        .animate-delay-3 { transition-delay: 0.3s; }
        .animate-delay-4 { transition-delay: 0.4s; }
        .animate-delay-5 { transition-delay: 0.5s; }

        /* ===== NAV LINK UNDERLINE (pseudo-element) ===== */
        .nav-link-item::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #34d399;
            transition: width 0.3s;
            border-radius: 1px;
        }

        .nav-link-item:hover::after {
            width: 100%;
        }

        .nav-cta::after {
            display: none !important;
        }

        /* ===== FEATURE CARD TOP BAR (pseudo-element) ===== */
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #34d399, #2dd4bf);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        /* ===== HERO PSEUDO-ELEMENTS ===== */
        .hero-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.3) 0%, transparent 70%);
            animation: blob 8s ease-in-out infinite;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(45, 212, 191, 0.2) 0%, transparent 70%);
            animation: blob 10s ease-in-out infinite reverse;
        }

        /* ===== STATS PSEUDO-ELEMENT ===== */
        .stats-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* ===== HOW IT WORKS CONNECTOR LINE ===== */
        .steps-line::before {
            content: '';
            position: absolute;
            top: 60px;
            left: 12.5%;
            right: 12.5%;
            height: 3px;
            background: linear-gradient(90deg, #a7f3d0, #34d399, #2dd4bf, #a7f3d0);
            z-index: 0;
            border-radius: 2px;
        }

        /* ===== CTA PSEUDO-ELEMENT ===== */
        .cta-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.2) 0%, transparent 70%);
            animation: blob 10s ease-in-out infinite;
        }

        /* ===== IMPACT PSEUDO-ELEMENT ===== */
        .impact-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(circle at 20% 80%, rgba(16,185,129,0.08) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(20,184,166,0.08) 0%, transparent 50%);
        }
    </style>
</head>
<body class="font-jakarta text-neutral-800 bg-neutral-50 leading-relaxed overflow-x-hidden [&_a]:no-underline [&_a]:text-inherit [&_img]:max-w-full [&_img]:block">
    <!-- ===== NAVBAR ===== -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-[1000] py-4 transition-all duration-400 ease-in-out [&.scrolled]:bg-white/92 [&.scrolled]:backdrop-blur-[20px] [&.scrolled]:shadow-[0_4px_30px_rgba(0,0,0,0.08)] [&.scrolled]:py-2.5">
        <div class="max-w-[1200px] mx-auto px-6 flex items-center justify-between">
            <a href="#" class="flex items-center gap-3 font-extrabold text-2xl text-white transition-colors duration-300 navbar-brand">
<div class="w-11 h-11 flex items-center justify-center">
    <img
        src="https://img.icons8.com/?size=100&id=ngxhKjJtc4LX&format=png&color=000000"
        alt="Recycle Icon"
        class="w-7 h-7"
    >
</div>Bank Sampah
            </a>
            <ul id="navLinks" class="flex items-center gap-8 list-none nav-links-list max-md:hidden">
                <li><a href="#beranda" class="nav-link-item text-white/85 font-medium text-[0.95rem] transition-all duration-300 relative hover:text-white">Beranda</a></li>
                <li><a href="#fitur" class="nav-link-item text-white/85 font-medium text-[0.95rem] transition-all duration-300 relative hover:text-white">Fitur</a></li>
                <li><a href="#cara-kerja" class="nav-link-item text-white/85 font-medium text-[0.95rem] transition-all duration-300 relative hover:text-white">Cara Kerja</a></li>
                <li><a href="#kategori" class="nav-link-item text-white/85 font-medium text-[0.95rem] transition-all duration-300 relative hover:text-white">Kategori</a></li>
                <li><a href="#dampak" class="nav-link-item text-white/85 font-medium text-[0.95rem] transition-all duration-300 relative hover:text-white">Dampak</a></li>
                <li><a href="#testimoni" class="nav-link-item text-white/85 font-medium text-[0.95rem] transition-all duration-300 relative hover:text-white">Testimoni</a></li>
                <li><a href="#gabung" class="nav-cta py-2.5 px-6 bg-gradient-to-br from-green-500 to-teal-500 !text-white rounded-full font-semibold text-sm transition-all duration-300 shadow-[0_4px_15px_rgba(16,185,129,0.3)] hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(16,185,129,0.4)]">Gabung Sekarang</a></li>
            </ul>
            <div id="mobileToggle" onclick="toggleNav()" class="hidden max-md:flex flex-col gap-[5px] cursor-pointer p-[5px]">
                <span class="w-[25px] h-[2.5px] bg-white rounded-sm transition-all duration-300 mobile-bar"></span>
                <span class="w-[25px] h-[2.5px] bg-white rounded-sm transition-all duration-300 mobile-bar"></span>
                <span class="w-[25px] h-[2.5px] bg-white rounded-sm transition-all duration-300 mobile-bar"></span>
            </div>
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="hero-bg min-h-screen flex items-center relative overflow-hidden bg-gradient-to-br from-green-950 via-green-800 via-60% to-green-500" id="beranda">
        <div class="absolute pointer-events-none z-[1] top-[15%] right-[8%] text-[4rem] animate-float opacity-15">🌿</div>
        <div class="absolute pointer-events-none z-[1] bottom-[20%] right-[15%] text-[3rem] animate-float-slow opacity-10">🌱</div>
        <div class="absolute pointer-events-none z-[1] top-[30%] left-[5%] text-[2.5rem] animate-float opacity-10" style="animation-delay: 1s;">🍃</div>
        <div class="absolute pointer-events-none z-[1] bottom-[15%] left-[10%] w-[100px] h-[100px] border-2 border-white/8 rounded-full animate-spin-slow"></div>
        <div class="absolute pointer-events-none z-[1] top-[20%] right-[30%] w-[60px] h-[60px] border-2 border-white/6 animate-blob" style="border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;"></div>

        <div class="max-w-[1200px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-[2]">
            <div class="animate-fade-in-left lg:text-left text-center">
                <div class="inline-flex items-center gap-2 py-2 px-5 bg-white/12 backdrop-blur-[10px] border border-white/15 rounded-full text-green-200 text-[0.85rem] font-medium mb-6">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse-glow"></span>
                    Platform Bank Sampah Digital
                </div>
                <h1 class="text-[clamp(2.5rem,5vw,3.75rem)] font-extrabold text-white leading-[1.15] mb-6 max-[480px]:text-[2rem]">
                    Sampahmu <span class="bg-gradient-to-br from-green-300 via-teal-400 to-lime-400 bg-clip-text text-transparent">Bernilai,</span><br>
                    Lingkungan <span class="bg-gradient-to-br from-green-300 via-teal-400 to-lime-400 bg-clip-text text-transparent">Lestari</span>
                </h1>
                <p class="text-[1.15rem] text-white/80 leading-[1.7] mb-10 max-w-[520px] lg:mx-0 mx-auto">
                    Bergabunglah dengan ribuan warga yang telah mengubah sampah menjadi berkah.
                    Kelola, pilah, dan tukarkan sampahmu menjadi rupiah sambil menjaga bumi tetap hijau.
                </p>
                <div class="flex gap-4 flex-wrap lg:justify-start justify-center max-[480px]:flex-col max-[480px]:items-center">
                    <a href="#gabung" class="inline-flex items-center gap-2 py-4 px-8 bg-white text-green-700 font-bold text-base rounded-full border-none cursor-pointer transition-all duration-300 shadow-[0_4px_20px_rgba(0,0,0,0.15)] hover:-translate-y-[3px] hover:shadow-[0_8px_30px_rgba(0,0,0,0.2)]">
    <img
        src="https://img.icons8.com/?size=100&id=B0YxODenuYvG&format=png&color=000000"
        alt="Mulai"
        class="w-6 h-6"
    >
    Mulai Sekarang
</a>
                    <a href="#cara-kerja" class="inline-flex items-center gap-2 py-4 px-8 bg-white/10 backdrop-blur-[10px] text-white font-semibold text-base rounded-full border-[1.5px] border-white/25 cursor-pointer transition-all duration-300 hover:bg-white/20 hover:-translate-y-[3px]">
    <img
        src="https://img.icons8.com/?size=100&id=bwUgs69v7bOd&format=png&color=000000"
        alt="Pelajari"
        class="w-6 h-6"
    >
    Pelajari Lebih Lanjut
</a>
                    </a>
                </div>
            </div>

            <div class="flex justify-center items-center relative animate-fade-in-right lg:mt-0 mt-8">
                <div class="bg-white/10 backdrop-blur-[20px] border border-white/15 rounded-2xl p-10 w-full max-w-[420px] relative">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-teal-400 rounded-lg flex items-center justify-center text-2xl">📊</div>
                        <div>
                            <div class="text-white font-bold text-[1.1rem]">Dashboard Sampah</div>
                            <div class="text-white/60 text-[0.85rem]">Ringkasan bulan ini</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/8 rounded-lg p-5 text-center border border-white/8 transition-all duration-300 hover:bg-white/15 hover:-translate-y-0.5">
                            <div class="mb-2">
    <img
        src="https://img.icons8.com/?size=100&id=XLYyiimvk3fV&format=png&color=000000"
        alt="Icon Tempat Sampah"
        class="w-10 h-10 mx-auto"
    >
</div>
                            <div class="text-2xl font-extrabold text-white">125<span class="text-lg text-green-300">kg</span></div>
                            <div class="text-xs text-white/60 mt-1">Sampah Terkumpul</div>
                        </div>
                        <div class="bg-white/8 rounded-lg p-5 text-center border border-white/8 transition-all duration-300 hover:bg-white/15 hover:-translate-y-0.5">
                            <div class="mb-2">
    <img
        src="https://img.icons8.com/?size=100&id=SQUhc67Yi70U&format=png&color=000000"
        alt="Icon Uang"
        class="w-10 h-10 mx-auto"
    >
</div>
                            <div class="text-2xl font-extrabold text-white">350<span class="text-lg text-green-300">rb</span></div>
                            <div class="text-xs text-white/60 mt-1">Total Pendapatan</div>
                        </div>
                        <div class="bg-white/8 rounded-lg p-5 text-center border border-white/8 transition-all duration-300 hover:bg-white/15 hover:-translate-y-0.5">
                            <div class="mb-2">
    <img
        src="https://img.icons8.com/?size=100&id=XsvEZR0h6fav&format=png&color=000000"
        alt="Icon Bumi"
        class="w-10 h-10 mx-auto"
    >
</div>
                            <div class="text-2xl font-extrabold text-white">89<span class="text-lg text-green-300">kg</span></div>
                            <div class="text-xs text-white/60 mt-1">CO₂ Dicegah</div>
                        </div>
                        <div class="bg-white/8 rounded-lg p-5 text-center border border-white/8 transition-all duration-300 hover:bg-white/15 hover:-translate-y-0.5">
                            <div class="mb-2">
    <img
        src="https://img.icons8.com/?size=100&id=XBMnwwJYQvfN&format=png&color=000000"
        alt="Icon Bintang"
        class="w-10 h-10 mx-auto"
    >
</div>
                            <div class="text-2xl font-extrabold text-white">12<span class="text-lg text-green-300">x</span></div>
                            <div class="text-xs text-white/60 mt-1">Setor Bulan Ini</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-[-1px] left-0 right-0 z-[3]">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="block w-full h-auto">
                <path d="M0 120L60 110C120 100 240 80 360 73.3C480 67 600 73 720 80C840 87 960 93 1080 90C1200 87 1320 73 1380 66.7L1440 60V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>

    <!-- ===== FEATURES SECTION ===== -->
    <section class="py-24 bg-white" id="fitur">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center max-w-[640px] mx-auto mb-16 animate-on-scroll">
               <div class="inline-flex items-center gap-2 py-1.5 px-4 bg-green-50 text-green-700 font-semibold text-[0.85rem] rounded-full mb-4 border border-green-100">
    <img
        src="https://img.icons8.com/?size=100&id=JqFP89u5slPn&format=png&color=000000"
        alt="Fitur Unggulan"
        class="w-5 h-5"
    >
    Fitur Unggulan
</div>
                <h2 class="text-[clamp(2rem,4vw,2.75rem)] font-extrabold text-neutral-900 leading-[1.2] mb-4">Semua yang Anda Butuhkan untuk Mengelola Sampah</h2>
                <p class="text-[1.05rem] text-neutral-500 leading-[1.7]">Platform lengkap untuk memudahkan warga dalam memilah, menyetor, dan mendapatkan manfaat dari pengelolaan sampah.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card p-10 rounded-2xl bg-neutral-50 border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] relative overflow-hidden hover:-translate-y-2 hover:shadow-xl hover:border-green-200 animate-on-scroll animate-delay-1">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center text-[1.75rem] mb-6 bg-gradient-to-br from-green-50 to-green-100">📱</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-3">Pencatatan Digital</h3>
                    <p class="text-[0.95rem] text-neutral-500 leading-[1.65]">Catat setiap setoran sampah secara digital. Pantau riwayat dan saldo Anda kapan saja, di mana saja.</p>
                </div>
                <div class="feature-card p-10 rounded-2xl bg-neutral-50 border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] relative overflow-hidden hover:-translate-y-2 hover:shadow-xl hover:border-green-200 animate-on-scroll animate-delay-2">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center text-[1.75rem] mb-6 bg-gradient-to-br from-teal-50 to-teal-100">💰</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-3">Tabungan Sampah</h3>
                    <p class="text-[0.95rem] text-neutral-500 leading-[1.65]">Setiap sampah yang Anda setorkan memiliki nilai ekonomis. Kumpulkan saldo dan tarik kapan saja.</p>
                </div>
                <div class="feature-card p-10 rounded-2xl bg-neutral-50 border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] relative overflow-hidden hover:-translate-y-2 hover:shadow-xl hover:border-green-200 animate-on-scroll animate-delay-3">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center text-[1.75rem] mb-6 bg-gradient-to-br from-amber-50 to-amber-100">📊</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-3">Laporan & Statistik</h3>
                    <p class="text-[0.95rem] text-neutral-500 leading-[1.65]">Lihat laporan lengkap kontribusi Anda dalam menjaga lingkungan melalui grafik interaktif.</p>
                </div>
                <div class="feature-card p-10 rounded-2xl bg-neutral-50 border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] relative overflow-hidden hover:-translate-y-2 hover:shadow-xl hover:border-green-200 animate-on-scroll animate-delay-1">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center text-[1.75rem] mb-6 bg-gradient-to-br from-emerald-50 to-emerald-200">🏆</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-3">Reward & Penghargaan</h3>
                    <p class="text-[0.95rem] text-neutral-500 leading-[1.65]">Dapatkan poin dan penghargaan untuk setiap kontribusi. Jadilah pahlawan lingkungan!</p>
                </div>
                <div class="feature-card p-10 rounded-2xl bg-neutral-50 border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] relative overflow-hidden hover:-translate-y-2 hover:shadow-xl hover:border-green-200 animate-on-scroll animate-delay-2">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center text-[1.75rem] mb-6 bg-gradient-to-br from-lime-50 to-lime-200">🚛</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-3">Penjemputan Sampah</h3>
                    <p class="text-[0.95rem] text-neutral-500 leading-[1.65]">Jadwalkan penjemputan sampah langsung dari rumah Anda. Praktis dan mudah.</p>
                </div>
                <div class="feature-card p-10 rounded-2xl bg-neutral-50 border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] relative overflow-hidden hover:-translate-y-2 hover:shadow-xl hover:border-green-200 animate-on-scroll animate-delay-3">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center text-[1.75rem] mb-6 bg-gradient-to-br from-cyan-50 to-cyan-100">🌍</div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-3">Dampak Lingkungan</h3>
                    <p class="text-[0.95rem] text-neutral-500 leading-[1.65]">Ketahui dampak positif kontribusi Anda terhadap pengurangan emisi karbon dan pelestarian alam.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== STATS SECTION ===== -->
    <section class="stats-bg py-24 bg-gradient-to-br from-green-800 to-green-900 relative overflow-hidden">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative z-[1]">
                <div class="text-center p-8 animate-on-scroll animate-delay-1">
                    <div class="mb-4">
    <img
        src="https://img.icons8.com/?size=100&id=YxIwF8tLXAsF&format=png&color=000000"
        alt="Icon Tim"
        class="w-16 h-16 mx-auto"
    >
</div>
                    <div class="text-5xl font-extrabold text-white leading-none mb-2 stat-number" data-target="2500">0<span class="text-2xl text-green-300">+</span></div>
                    <div class="text-[0.95rem] text-green-300 font-medium">Nasabah Aktif</div>
                </div>
                <div class="text-center p-8 animate-on-scroll animate-delay-2">
                    <div class="mb-4">
    <img
        src="https://img.icons8.com/?size=100&id=AkCOclxuEDay&format=png&color=000000"
        alt="Icon Timbangan"
        class="w-16 h-16 mx-auto"
    >
</div>
                    <div class="text-5xl font-extrabold text-white leading-none mb-2 stat-number" data-target="15000">0<span class="text-2xl text-green-300"> kg</span></div>
                    <div class="text-[0.95rem] text-green-300 font-medium">Sampah Terkelola</div>
                </div>
                <div class="text-center p-8 animate-on-scroll animate-delay-3">
                    <div class="mb-4">
    <img
        src="https://img.icons8.com/?size=100&id=yUTNKgUuTlsA&format=png&color=000000"
        alt="Icon Uang"
        class="w-16 h-16 mx-auto"
    >
</div>
                    <div class="text-5xl font-extrabold text-white leading-none mb-2 stat-number">Rp 50<span class="text-2xl text-green-300"> jt+</span></div>
                    <div class="text-[0.95rem] text-green-300 font-medium">Dana Tersalurkan</div>
                </div>
                <div class="text-center p-8 animate-on-scroll animate-delay-4">
                    <div class="mb-4">
    <img
        src="https://img.icons8.com/?size=100&id=G0NpAnwlY0U4&format=png&color=000000"
        alt="Icon Pohon"
        class="w-16 h-16 mx-auto"
    >
</div>
                    <div class="text-5xl font-extrabold text-white leading-none mb-2 stat-number" data-target="500">0<span class="text-2xl text-green-300">+</span></div>
                    <div class="text-[0.95rem] text-green-300 font-medium">Pohon Diselamatkan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== HOW IT WORKS ===== -->
    <section class="py-24 bg-neutral-50" id="cara-kerja">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center max-w-[640px] mx-auto mb-16 animate-on-scroll">
                <div class="inline-flex items-center gap-2 py-1.5 px-4 bg-green-50 text-green-700 font-semibold text-[0.85rem] rounded-full mb-4 border border-green-100">🔄 Cara Kerja</div>
                <h2 class="text-[clamp(2rem,4vw,2.75rem)] font-extrabold text-neutral-900 leading-[1.2] mb-4">Mudah & Praktis dalam 4 Langkah</h2>
                <p class="text-[1.05rem] text-neutral-500 leading-[1.7]">Mulai perjalanan pengelolaan sampah Anda dengan langkah-langkah sederhana berikut.</p>
            </div>
            <div class="steps-line grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative max-lg:before:hidden">
                <div class="text-center relative z-[1] animate-on-scroll animate-delay-1 group">
                    <div class="w-[72px] h-[72px] mx-auto mb-6 bg-white border-3 border-green-400 rounded-full flex items-center justify-center text-2xl font-extrabold text-green-700 shadow-lg transition-all duration-300 group-hover:bg-gradient-to-br group-hover:from-green-500 group-hover:to-teal-500 group-hover:text-white group-hover:scale-110 group-hover:border-green-500">1</div>
                    <div class="mb-3">
    <img
        src="https://img.icons8.com/?size=100&id=oZAinaxvg8AD&format=png&color=000000"
        alt="Icon Dokumen"
        class="w-14 h-14 mx-auto"
    >
</div>
                    <h3 class="text-[1.1rem] font-bold text-neutral-900 mb-2">Daftar Akun</h3>
                    <p class="text-sm text-neutral-500 leading-relaxed">Daftarkan diri Anda sebagai nasabah Bank Sampah dengan mudah dan gratis.</p>
                </div>
                <div class="text-center relative z-[1] animate-on-scroll animate-delay-2 group">
                    <div class="w-[72px] h-[72px] mx-auto mb-6 bg-white border-3 border-green-400 rounded-full flex items-center justify-center text-2xl font-extrabold text-green-700 shadow-lg transition-all duration-300 group-hover:bg-gradient-to-br group-hover:from-green-500 group-hover:to-teal-500 group-hover:text-white group-hover:scale-110 group-hover:border-green-500">2</div>
                    <div class="mb-3">
    <img
        src="https://img.icons8.com/?size=100&id=ngxhKjJtc4LX&format=png&color=000000"
        alt="Icon Daur Ulang"
        class="w-14 h-14 mx-auto"
    >
</div>
                    <h3 class="text-[1.1rem] font-bold text-neutral-900 mb-2">Pilah Sampah</h3>
                    <p class="text-sm text-neutral-500 leading-relaxed">Pisahkan sampah berdasarkan jenisnya: plastik, kertas, logam, kaca, dan organik.</p>
                </div>
                <div class="text-center relative z-[1] animate-on-scroll animate-delay-3 group">
                    <div class="w-[72px] h-[72px] mx-auto mb-6 bg-white border-3 border-green-400 rounded-full flex items-center justify-center text-2xl font-extrabold text-green-700 shadow-lg transition-all duration-300 group-hover:bg-gradient-to-br group-hover:from-green-500 group-hover:to-teal-500 group-hover:text-white group-hover:scale-110 group-hover:border-green-500">3</div>
                    <div class="mb-3">
    <img
        src="https://img.icons8.com/?size=100&id=LcVQQn9beLrS&format=png&color=000000"
        alt="Icon Toko"
        class="w-16 h-16 mx-auto"
    >
</div>
                    <h3 class="text-[1.1rem] font-bold text-neutral-900 mb-2">Setor ke Bank Sampah</h3>
                    <p class="text-sm text-neutral-500 leading-relaxed">Bawa sampah yang sudah dipilah ke Bank Sampah atau jadwalkan penjemputan.</p>
                </div>
                <div class="text-center relative z-[1] animate-on-scroll animate-delay-4 group">
                    <div class="w-[72px] h-[72px] mx-auto mb-6 bg-white border-3 border-green-400 rounded-full flex items-center justify-center text-2xl font-extrabold text-green-700 shadow-lg transition-all duration-300 group-hover:bg-gradient-to-br group-hover:from-green-500 group-hover:to-teal-500 group-hover:text-white group-hover:scale-110 group-hover:border-green-500">4</div>
                   <div class="mb-3">
    <img
        src="https://img.icons8.com/?size=100&id=EAJO2Tj4XI6Z&format=png&color=000000"
        alt="Icon Uang"
        class="w-16 h-16 mx-auto"
    >
</div>
                    <h3 class="text-[1.1rem] font-bold text-neutral-900 mb-2">Terima Penghasilan</h3>
                    <p class="text-sm text-neutral-500 leading-relaxed">Sampah Anda ditimbang, dicatat, dan saldo langsung masuk ke rekening tabungan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== WASTE CATEGORIES ===== -->
    <section class="py-24 bg-white" id="kategori">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center max-w-[640px] mx-auto mb-16 animate-on-scroll">
                <div class="inline-flex items-center gap-2 py-1.5 px-4 bg-green-50 text-green-700 font-semibold text-[0.85rem] rounded-full mb-4 border border-green-100">
    <img
        src="https://img.icons8.com/?size=100&id=Vps0Nsl80v4P&format=png&color=000000"
        alt="Kategori Sampah"
        class="w-5 h-5"
    >
    Kategori Sampah
</div>
                <h2 class="text-[clamp(2rem,4vw,2.75rem)] font-extrabold text-neutral-900 leading-[1.2] mb-4">Jenis Sampah yang Kami Terima</h2>
                <p class="text-[1.05rem] text-neutral-500 leading-[1.7]">Berbagai jenis sampah bernilai yang dapat Anda setorkan ke Bank Sampah kami.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <div class="p-8 rounded-2xl text-center border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] cursor-pointer relative overflow-hidden bg-gradient-to-br from-amber-100 to-amber-50 hover:-translate-y-1.5 hover:shadow-xl hover:border-amber-400 animate-on-scroll animate-delay-1">
                    <div class="text-5xl mb-4">🧴</div>
                    <h3 class="text-[1.15rem] font-bold text-neutral-900 mb-2">Plastik</h3>
                    <span class="text-[0.85rem] text-green-600 font-semibold py-1 px-3 bg-green-500/10 rounded-full inline-block">Rp 2.000 - 5.000/kg</span>
                    <p class="text-xs text-neutral-400 mt-3">Botol, gelas, kantong, ember</p>
                </div>
                <div class="p-8 rounded-2xl text-center border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] cursor-pointer relative overflow-hidden bg-gradient-to-br from-blue-100 to-blue-50 hover:-translate-y-1.5 hover:shadow-xl hover:border-blue-400 animate-on-scroll animate-delay-2">
                    <div class="text-5xl mb-4">📄</div>
                    <h3 class="text-[1.15rem] font-bold text-neutral-900 mb-2">Kertas & Kardus</h3>
                    <span class="text-[0.85rem] text-green-600 font-semibold py-1 px-3 bg-green-500/10 rounded-full inline-block">Rp 1.500 - 3.000/kg</span>
                    <p class="text-xs text-neutral-400 mt-3">Koran, majalah, kardus, buku</p>
                </div>
                <div class="p-8 rounded-2xl text-center border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] cursor-pointer relative overflow-hidden bg-gradient-to-br from-gray-200 to-gray-100 hover:-translate-y-1.5 hover:shadow-xl hover:border-gray-400 animate-on-scroll animate-delay-3">
                    <div class="text-5xl mb-4">🔩</div>
                    <h3 class="text-[1.15rem] font-bold text-neutral-900 mb-2">Logam</h3>
                    <span class="text-[0.85rem] text-green-600 font-semibold py-1 px-3 bg-green-500/10 rounded-full inline-block">Rp 5.000 - 15.000/kg</span>
                    <p class="text-xs text-neutral-400 mt-3">Kaleng, besi, aluminium, tembaga</p>
                </div>
                <div class="p-8 rounded-2xl text-center border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] cursor-pointer relative overflow-hidden bg-gradient-to-br from-teal-100 to-teal-50 hover:-translate-y-1.5 hover:shadow-xl hover:border-teal-400 animate-on-scroll animate-delay-4">
                    <div class="text-5xl mb-4">🫙</div>
                    <h3 class="text-[1.15rem] font-bold text-neutral-900 mb-2">Kaca</h3>
                    <span class="text-[0.85rem] text-green-600 font-semibold py-1 px-3 bg-green-500/10 rounded-full inline-block">Rp 500 - 2.000/kg</span>
                    <p class="text-xs text-neutral-400 mt-3">Botol kaca, toples, cermin</p>
                </div>
                <div class="p-8 rounded-2xl text-center border border-neutral-100 transition-all duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] cursor-pointer relative overflow-hidden bg-gradient-to-br from-green-100 to-green-50 hover:-translate-y-1.5 hover:shadow-xl hover:border-green-400 animate-on-scroll animate-delay-5">
                    <div class="text-5xl mb-4">🌿</div>
                    <h3 class="text-[1.15rem] font-bold text-neutral-900 mb-2">Organik</h3>
                    <span class="text-[0.85rem] text-green-600 font-semibold py-1 px-3 bg-green-500/10 rounded-full inline-block">Rp 500 - 1.000/kg</span>
                    <p class="text-xs text-neutral-400 mt-3">Sisa makanan, daun, ranting</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== IMPACT SECTION ===== -->
    <section class="impact-bg py-24 bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 relative overflow-hidden" id="dampak">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-[1]">
                <div class="animate-on-scroll">
                    <div class="inline-flex items-center gap-2 py-1.5 px-4 bg-green-50 text-green-700 font-semibold text-[0.85rem] rounded-full mb-4 border border-green-100">🌍 Dampak Positif</div>
                    <h3 class="text-[2.25rem] font-extrabold text-neutral-900 mb-6 leading-[1.2]">Bersama Kita Ciptakan Perubahan Nyata untuk Bumi</h3>
                    <p class="text-[1.05rem] text-neutral-500 leading-[1.7] mb-8">Setiap kilogram sampah yang Anda setorkan adalah langkah nyata dalam menjaga kelestarian lingkungan. Bersama Bank Sampah, kita bisa membuat perubahan besar.</p>
                    <ul class="list-none flex flex-col gap-4">
                        <li class="flex items-center gap-3 text-base text-neutral-700 font-medium">
                            <span class="w-7 h-7 rounded-full bg-gradient-to-br from-green-400 to-teal-400 flex items-center justify-center text-white text-xs shrink-0">✓</span>
                            Mengurangi volume sampah di TPA hingga 40%
                        </li>
                        <li class="flex items-center gap-3 text-base text-neutral-700 font-medium">
                            <span class="w-7 h-7 rounded-full bg-gradient-to-br from-green-400 to-teal-400 flex items-center justify-center text-white text-xs shrink-0">✓</span>
                            Menurunkan emisi gas rumah kaca secara signifikan
                        </li>
                        <li class="flex items-center gap-3 text-base text-neutral-700 font-medium">
                            <span class="w-7 h-7 rounded-full bg-gradient-to-br from-green-400 to-teal-400 flex items-center justify-center text-white text-xs shrink-0">✓</span>
                            Menciptakan lapangan kerja baru bagi masyarakat
                        </li>
                        <li class="flex items-center gap-3 text-base text-neutral-700 font-medium">
                            <span class="w-7 h-7 rounded-full bg-gradient-to-br from-green-400 to-teal-400 flex items-center justify-center text-white text-xs shrink-0">✓</span>
                            Meningkatkan kesadaran lingkungan di komunitas
                        </li>
                        <li class="flex items-center gap-3 text-base text-neutral-700 font-medium">
                            <span class="w-7 h-7 rounded-full bg-gradient-to-br from-green-400 to-teal-400 flex items-center justify-center text-white text-xs shrink-0">✓</span>
                            Mendukung ekonomi sirkular yang berkelanjutan
                        </li>
                    </ul>
                </div>
                <div class="grid grid-cols-2 gap-6 animate-on-scroll animate-delay-2">
                    <div class="p-8 rounded-2xl bg-white shadow-lg text-center transition-all duration-300 border border-neutral-100 hover:-translate-y-1 hover:shadow-2xl">
                        <div class="text-[2.5rem] mb-3">🌊</div>
                        <div class="text-[1.75rem] font-extrabold text-green-700 mb-1">40%</div>
                        <div class="text-[0.85rem] text-neutral-500">Pengurangan sampah TPA</div>
                    </div>
                    <div class="p-8 rounded-2xl bg-white shadow-lg text-center transition-all duration-300 border border-neutral-100 translate-y-8 hover:translate-y-[calc(2rem-4px)] hover:shadow-2xl">
                        <div class="text-[2.5rem] mb-3">🌱</div>
                        <div class="text-[1.75rem] font-extrabold text-green-700 mb-1">12 ton</div>
                        <div class="text-[0.85rem] text-neutral-500">CO₂ berhasil dicegah</div>
                    </div>
                    <div class="p-8 rounded-2xl bg-white shadow-lg text-center transition-all duration-300 border border-neutral-100 hover:-translate-y-1 hover:shadow-2xl">
                        <div class="text-[2.5rem] mb-3">👨‍👩‍👧‍👦</div>
                        <div class="text-[1.75rem] font-extrabold text-green-700 mb-1">50+</div>
                        <div class="text-[0.85rem] text-neutral-500">Keluarga terbantu</div>
                    </div>
                    <div class="p-8 rounded-2xl bg-white shadow-lg text-center transition-all duration-300 border border-neutral-100 hover:-translate-y-1 hover:shadow-2xl">
                        <div class="text-[2.5rem] mb-3">🏘️</div>
                        <div class="text-[1.75rem] font-extrabold text-green-700 mb-1">8</div>
                        <div class="text-[0.85rem] text-neutral-500">Kelurahan terjangkau</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONIALS ===== -->
    <section class="py-24 bg-white" id="testimoni">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center max-w-[640px] mx-auto mb-16 animate-on-scroll">
                <div class="inline-flex items-center gap-2 py-1.5 px-4 bg-green-50 text-green-700 font-semibold text-[0.85rem] rounded-full mb-4 border border-green-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
</svg>

                Testimoni</div>
                <h2 class="text-[clamp(2rem,4vw,2.75rem)] font-extrabold text-neutral-900 leading-[1.2] mb-4">Apa Kata Mereka tentang Bank Sampah?</h2>
                <p class="text-[1.05rem] text-neutral-500 leading-[1.7]">Cerita sukses dari para nasabah yang telah merasakan manfaat bergabung dengan Bank Sampah.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-lg:max-w-[500px] max-lg:mx-auto">
                <div class="p-8 rounded-2xl bg-neutral-50 border border-neutral-100 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 animate-on-scroll animate-delay-1">
                    <div class="text-amber-400 text-base mb-4 tracking-[2px]">★★★★★</div>
                    <p class="text-[0.95rem] text-neutral-600 leading-[1.7] mb-6 italic">"Sejak bergabung dengan Bank Sampah, rumah jadi lebih bersih dan saya bisa menabung dari sampah. Luar biasa!"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold text-white bg-gradient-to-br from-green-400 to-green-600">S</div>
                        <div>
                            <div class="font-bold text-[0.95rem] text-neutral-900">Ibu Sari</div>
                            <div class="text-xs text-neutral-400">Nasabah sejak 2024</div>
                        </div>
                    </div>
                </div>
                <div class="p-8 rounded-2xl bg-neutral-50 border border-neutral-100 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 animate-on-scroll animate-delay-2">
                    <div class="text-amber-400 text-base mb-4 tracking-[2px]">★★★★★</div>
                    <p class="text-[0.95rem] text-neutral-600 leading-[1.7] mb-6 italic">"Anak-anak jadi lebih peduli lingkungan. Mereka senang memilah sampah karena tahu sampah bisa jadi uang tabungan."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold text-white bg-gradient-to-br from-teal-400 to-teal-500">B</div>
                        <div>
                            <div class="font-bold text-[0.95rem] text-neutral-900">Pak Budi</div>
                            <div class="text-xs text-neutral-400">Nasabah sejak 2023</div>
                        </div>
                    </div>
                </div>
                <div class="p-8 rounded-2xl bg-neutral-50 border border-neutral-100 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 animate-on-scroll animate-delay-3">
                    <div class="text-amber-400 text-base mb-4 tracking-[2px]">★★★★★</div>
                    <p class="text-[0.95rem] text-neutral-600 leading-[1.7] mb-6 italic">"Program yang sangat bermanfaat! Lingkungan RT kami jadi jauh lebih bersih dan warga semakin kompak."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold text-white bg-gradient-to-br from-amber-400 to-amber-500">A</div>
                        <div>
                            <div class="font-bold text-[0.95rem] text-neutral-900">Ibu Ani</div>
                            <div class="text-xs text-neutral-400">Ketua RT 05</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
    <section class="cta-bg py-24 bg-gradient-to-br from-green-600 via-green-700 to-green-800 relative overflow-hidden" id="gabung">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center relative z-[1] max-w-[700px] mx-auto animate-on-scroll">
                <div class="text-[3.5rem] mb-6">🌿</div>
                <h2 class="text-[clamp(2rem,4vw,2.75rem)] font-extrabold text-white mb-4">Siap Mengubah Sampahmu Jadi Berkah?</h2>
                <p class="text-[1.1rem] text-white/80 mb-10 leading-[1.7]">Bergabung bersama ribuan nasabah Bank Sampah dan mulai perjalananmu menuju lingkungan yang lebih bersih dan kehidupan yang lebih sejahtera.</p>
                <div class="flex gap-4 justify-center flex-wrap max-[480px]:flex-col max-[480px]:items-center">
                    <a href="#" class="inline-flex items-center gap-2 py-4 px-10 bg-white text-green-700 font-bold text-[1.05rem] rounded-full border-none cursor-pointer transition-all duration-300 shadow-[0_4px_20px_rgba(0,0,0,0.15)] hover:-translate-y-[3px] hover:shadow-[0_8px_30px_rgba(0,0,0,0.2)]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
</svg>
                    Daftar Gratis Sekarang
                    </a>
                    <a href="#" class="inline-flex items-center gap-3 py-4 px-10 bg-transparent text-white font-semibold text-[1.05rem] rounded-full border-2 border-white/30 transition-all duration-300 hover:bg-white hover:text-green-700 hover:border-white hover:shadow-lg hover:-translate-y-1">
    <svg xmlns="http://www.w3.org/2000/svg"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         class="w-5 h-5">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
    </svg>

    <span>Hubungi Kami</span>
</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-neutral-900 text-neutral-400 pt-20">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_1fr] gap-12 mb-16">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-11 h-11 bg-gradient-to-br from-green-400 to-teal-400 rounded-lg flex items-center justify-center text-[1.4rem]">♻️</div>
                        <span class="text-2xl font-extrabold text-white">Bank Sampah</span>
                    </div>
                    <p class="text-[0.95rem] leading-[1.7] mb-6">
                        Platform pengelolaan sampah berbasis masyarakat yang membantu warga mengubah sampah menjadi nilai ekonomis sambil menjaga kelestarian lingkungan.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-neutral-800 flex items-center justify-center text-neutral-400 text-[1.1rem] transition-all duration-300 hover:bg-green-600 hover:text-white hover:-translate-y-0.5" aria-label="Facebook">📘</a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-neutral-800 flex items-center justify-center text-neutral-400 text-[1.1rem] transition-all duration-300 hover:bg-green-600 hover:text-white hover:-translate-y-0.5" aria-label="Instagram">📷</a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-neutral-800 flex items-center justify-center text-neutral-400 text-[1.1rem] transition-all duration-300 hover:bg-green-600 hover:text-white hover:-translate-y-0.5" aria-label="WhatsApp">💬</a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-neutral-800 flex items-center justify-center text-neutral-400 text-[1.1rem] transition-all duration-300 hover:bg-green-600 hover:text-white hover:-translate-y-0.5" aria-label="YouTube">🎬</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-base font-bold text-white mb-5">Navigasi</h4>
                    <ul class="list-none flex flex-col gap-3">
                        <li><a href="#beranda" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Beranda</a></li>
                        <li><a href="#fitur" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Fitur</a></li>
                        <li><a href="#cara-kerja" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Cara Kerja</a></li>
                        <li><a href="#kategori" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Kategori Sampah</a></li>
                        <li><a href="#dampak" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Dampak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-base font-bold text-white mb-5">Layanan</h4>
                    <ul class="list-none flex flex-col gap-3">
                        <li><a href="#" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Setor Sampah</a></li>
                        <li><a href="#" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Penjemputan</a></li>
                        <li><a href="#" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Tabungan</a></li>
                        <li><a href="#" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Edukasi</a></li>
                        <li><a href="#" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">→ Kemitraan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-base font-bold text-white mb-5">Kontak</h4>
                    <ul class="list-none flex flex-col gap-3">
                        <li><a href="#" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">📍 Jl. Lingkungan Hijau No. 1</a></li>
                        <li><a href="#" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">📞 (021) 123-4567</a></li>
                        <li><a href="#" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">📧 info@banksampah.id</a></li>
                        <li><a href="#" class="text-neutral-400 text-sm transition-all duration-300 flex items-center gap-2 hover:text-green-400 hover:pl-1">🕐 Senin - Sabtu: 08.00 - 16.00</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-neutral-800 py-8 flex items-center justify-between flex-wrap gap-4 max-[480px]:flex-col max-[480px]:text-center">
                <p class="text-[0.85rem]">&copy; {{ date('Y') }} Bank Sampah. Seluruh hak cipta dilindungi.</p>
                <div class="flex gap-8">
                    <a href="#" class="text-[0.85rem] text-neutral-400 transition-colors duration-300 hover:text-green-400">Kebijakan Privasi</a>
                    <a href="#" class="text-[0.85rem] text-neutral-400 transition-colors duration-300 hover:text-green-400">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button id="backToTop" onclick="scrollToTop()" aria-label="Kembali ke atas" class="fixed bottom-8 right-8 w-[50px] h-[50px] bg-gradient-to-br from-green-500 to-teal-500 text-white border-none rounded-full text-xl cursor-pointer flex items-center justify-center opacity-0 invisible transition-all duration-300 shadow-[0_4px_20px_rgba(16,185,129,0.4)] z-[999] [&.visible]:opacity-100 [&.visible]:visible hover:-translate-y-[3px] hover:shadow-[0_6px_25px_rgba(16,185,129,0.5)]">↑</button>

    <script>
        // ===== NAVBAR SCROLL =====
        const navbar = document.getElementById('navbar');
        const backToTop = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                // Update navbar brand and link colors when scrolled
                navbar.querySelector('.navbar-brand').classList.add('!text-green-800');
                navbar.querySelectorAll('.nav-link-item').forEach(l => {
                    l.classList.add('!text-neutral-600');
                    l.classList.remove('hover:text-white');
                    l.addEventListener('mouseenter', () => l.classList.add('!text-green-600'));
                    l.addEventListener('mouseleave', () => l.classList.remove('!text-green-600'));
                });
                navbar.querySelectorAll('.mobile-bar').forEach(b => b.classList.add('!bg-neutral-700'));
            } else {
                navbar.classList.remove('scrolled');
                navbar.querySelector('.navbar-brand').classList.remove('!text-green-800');
                navbar.querySelectorAll('.nav-link-item').forEach(l => {
                    l.classList.remove('!text-neutral-600', '!text-green-600');
                });
                navbar.querySelectorAll('.mobile-bar').forEach(b => b.classList.remove('!bg-neutral-700'));
            }

            if (window.scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        // ===== MOBILE NAV =====
        function toggleNav() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('max-md:hidden');
            if (!navLinks.classList.contains('max-md:hidden')) {
                navLinks.classList.add('!flex', '!flex-col', 'absolute', 'top-full', 'left-0', 'right-0', 'bg-white', 'p-6', 'rounded-b-2xl', 'shadow-xl', 'gap-4');
                navLinks.querySelectorAll('.nav-link-item').forEach(l => l.classList.add('!text-neutral-700'));
            } else {
                navLinks.classList.remove('!flex', '!flex-col', 'absolute', 'top-full', 'left-0', 'right-0', 'bg-white', 'p-6', 'rounded-b-2xl', 'shadow-xl', 'gap-4');
                navLinks.querySelectorAll('.nav-link-item').forEach(l => l.classList.remove('!text-neutral-700'));
            }
        }

        // Close mobile nav when clicking a link
        document.querySelectorAll('#navLinks a').forEach(link => {
            link.addEventListener('click', () => {
                const navLinks = document.getElementById('navLinks');
                navLinks.classList.add('max-md:hidden');
                navLinks.classList.remove('!flex', '!flex-col', 'absolute', 'top-full', 'left-0', 'right-0', 'bg-white', 'p-6', 'rounded-b-2xl', 'shadow-xl', 'gap-4');
            });
        });

        // ===== SCROLL TO TOP =====
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // ===== SCROLL ANIMATIONS =====
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // ===== COUNTER ANIMATION =====
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number[data-target]');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const suffix = counter.querySelector('.text-2xl')?.textContent || '';
                const duration = 2000;
                const startTime = performance.now();

                function updateCounter(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);

                    // Easing function for smooth animation
                    const easeOut = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(easeOut * target);

                    counter.innerHTML = current.toLocaleString('id-ID') + '<span class="text-2xl text-green-300">' + suffix + '</span>';

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerHTML = target.toLocaleString('id-ID') + '<span class="text-2xl text-green-300">' + suffix + '</span>';
                    }
                }

                requestAnimationFrame(updateCounter);
            });
        }

        // Trigger counter animation when stats section is visible
        const statsSection = document.querySelector('.stats-bg');
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        statsObserver.observe(statsSection);

        // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {

        const href = this.getAttribute('href');

        // Abaikan jika hanya "#"
        if (href === '#') return;

        e.preventDefault();

        const target = document.querySelector(href);

        if (target) {
            const headerOffset = 80;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    });
});
    </script>
</body>
</html>