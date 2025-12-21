<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome Back - Login')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-bl from-white to-emerald-100 min-h-screen">
    <div class="flex min-h-screen">

        <!-- Left Section - Login Form (w-1/2) -->
        <div class="w-1/2 flex items-center justify-center p-8">
            <div class="bg-white/10 backdrop-blur-md rounded-3xl shadow-sm border border-slate-50 p-12 w-full max-w-md">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang Kembali</h2>
                    <p class="text-gray-500 text-sm">Lanjutkan dengan salah satu opsi berikut</p>
                </div>

                <form action="#" method="POST">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="Alamat Email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                            required>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" id="passwordField" name="password" placeholder="Kata Sandi 8-16 karakter"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                                required>
                            <button type="button" id="togglePasswordBtn"
                                class="absolute cursor-pointer right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <!-- Eye Icon (Show) -->
                                <svg id="eyeIconShow" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <!-- Eye Slash Icon (Hide) - Hidden by default -->
                                <svg id="eyeIconHide" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-start mb-6">
                        <label class="flex items-start">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Sign In Button -->
                    <button type="submit"
                        class="w-full bg-emerald-800 text-white py-3 rounded-lg font-medium hover:bg-emerald-900 transition duration-300 mb-2 cursor-pointer">
                        Masuk
                    </button>

                    <!-- Register Link -->
                    <p class="text-center text-sm text-gray-600 mt-2">
                        Belum punya akun? <a href="#" class="text-gray-800 font-medium hover:underline">Daftar Sekarang</a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Right Section - Splash Screen -->
        <div class="w-1/2 flex items-center justify-center p-2">
            <div class="bg-gradient-to-br from-emerald-900 to-emerald-950 backdrop-blur-md border border-slate-200 shadow-sm rounded-xl w-full h-full flex items-center justify-center relative overflow-hidden">

                <div class="orbit-container">
                    <!-- Blob 1 -->
                    <div class="orbit-blob blob-1">
                        <div class="w-36 h-36 bg-emerald-900 rounded-full mix-blend-multiply filter blur-xl opacity-80"></div>
                    </div>
                    <!-- Blob 2 -->
                    <div class="orbit-blob blob-2">
                        <div class="w-32 h-32 bg-emerald-800 rounded-full mix-blend-multiply filter blur-xl opacity-80"></div>
                    </div>
                    <!-- Blob 3 -->
                    <div class="orbit-blob blob-3">
                        <div class="w-30 h-20 bg-lime-800 rounded-full mix-blend-multiply filter blur-xl opacity-80"></div>
                    </div>
                    <!-- Blob 4 -->
                    <div class="orbit-blob blob-4">
                        <div class="w-28 h-28 bg-green-800 rounded-full mix-blend-multiply filter blur-xl opacity-80"></div>
                    </div>
                </div>

                <div class="absolute top-4 right-4 z-20 bg-white backdrop-blur-lg rounded-2xl p-3 shadow-sm border border-white/30">
                    <img src="{{ asset('assets/img/banyuasin.png') }}" alt="Logo Desa" class="relative z-10 w-10 h-auto drop-shadow-2xl">
                </div>

                <!-- Splash Screen Carousel -->
                <div class="splash-carousel relative z-10 w-full max-w-lg px-8">
                    <!-- Slide 1 - Layanan Surat -->
                    <div class="splash-slide active">
                        <div class="flex flex-col items-center text-center">
                            <div class="mb-6 bg-white/10 backdrop-blur-md rounded-full p-8 border border-white/20">
                                <img src="{{ asset('assets/img/login.png') }}" alt="Layanan Surat" class="w-32 h-32 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">Layanan Surat Digital</h3>
                            <p class="text-white/80 text-lg leading-relaxed">
                                Buat surat keterangan tidak mampu, domisili, dan berbagai surat administratif lainnya dengan mudah dan cepat secara online
                            </p>
                        </div>
                    </div>

                    <div class="splash-slide">
                        <div class="flex flex-col items-center text-center">
                            <div class="mb-6 bg-white/10 backdrop-blur-md rounded-full p-8 border border-white/20">
                                <img src="{{ asset('assets/img/login-2.png') }}" alt="Proses Cepat" class="w-32 h-32 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">Proses Cepat & Mudah</h3>
                            <p class="text-white/80 text-lg leading-relaxed">
                                Tidak perlu antri! Ajukan permohonan surat dari rumah dan dapatkan hasilnya dalam hitungan menit
                            </p>
                        </div>
                    </div>

                    <div class="splash-slide">
                        <div class="flex flex-col items-center text-center">
                            <div class="mb-6 bg-white/10 backdrop-blur-md rounded-full p-8 border border-white/20">
                                <img src="{{ asset('assets/img/login-3.png') }}" alt="Aman Terpercaya" class="w-32 h-32 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">Aman & Terpercaya</h3>
                            <p class="text-white/80 text-lg leading-relaxed">
                                Data Anda terlindungi dengan sistem keamanan tinggi. Semua surat memiliki validasi resmi dari kelurahan
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Dots Indicator -->
                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex gap-3">
                    <button class="dot active" onclick="goToSlide(0)"></button>
                    <button class="dot" onclick="goToSlide(1)"></button>
                    <button class="dot" onclick="goToSlide(2)"></button>
                </div>

            </div>
        </div>

    </div>

    <style>
        /* Orbit Container */
        .orbit-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .orbit-blob {
            position: absolute;
            top: 50%;
            left: 50%;
            transform-origin: center center;
        }

        .blob-1 { animation: orbit-large 15s linear infinite; }
        .blob-2 { animation: orbit-medium 12s linear infinite reverse; }
        .blob-3 { animation: orbit-small 10s linear infinite; }
        .blob-4 { animation: orbit-extra 18s linear infinite reverse; }

        @keyframes orbit-large {
            0% { transform: translate(-50%, -50%) rotate(0deg) translateX(280px) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg) translateX(280px) rotate(-360deg); }
        }

        @keyframes orbit-medium {
            0% { transform: translate(-50%, -50%) rotate(0deg) translateX(220px) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg) translateX(220px) rotate(-360deg); }
        }

        @keyframes orbit-small {
            0% { transform: translate(-50%, -50%) rotate(0deg) translateX(160px) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg) translateX(160px) rotate(-360deg); }
        }

        @keyframes orbit-extra {
            0% { transform: translate(-50%, -50%) rotate(0deg) translateX(320px) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg) translateX(320px) rotate(-360deg); }
        }

        .splash-carousel {
            position: relative;
            min-height: 400px;
        }

        .splash-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.6s ease-in-out;
            pointer-events: none;
        }

        .splash-slide.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
        }

        /* Dots Indicator */
        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: white;
            width: 36px;
            border-radius: 6px;
        }

        .dot:hover {
            background: rgba(255, 255, 255, 0.6);
            transform: scale(1.2);
        }
    </style>

    <script>
        // ========== TOGGLE PASSWORD VISIBILITY ==========
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('togglePasswordBtn');
            const passwordField = document.getElementById('passwordField');
            const eyeShow = document.getElementById('eyeIconShow');
            const eyeHide = document.getElementById('eyeIconHide');

            toggleBtn.addEventListener('click', function() {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeShow.classList.add('hidden');
                    eyeHide.classList.remove('hidden');
                } else {
                    passwordField.type = 'password';
                    eyeShow.classList.remove('hidden');
                    eyeHide.classList.add('hidden');
                }
            });
        });

        // ========== SPLASH SCREEN CAROUSEL ==========
        let currentSlide = 0;
        let autoSlide;
        const slides = document.querySelectorAll('.splash-slide');
        const dots = document.querySelectorAll('.dot');
        const slideInterval = 5000; // 5 detik

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function goToSlide(index) {
            currentSlide = index;
            showSlide(currentSlide);
            clearInterval(autoSlide);
            autoSlide = setInterval(nextSlide, slideInterval);
        }

        document.addEventListener('DOMContentLoaded', function() {
            showSlide(0);
            autoSlide = setInterval(nextSlide, slideInterval);
        });
    </script>
</body>

</html>4