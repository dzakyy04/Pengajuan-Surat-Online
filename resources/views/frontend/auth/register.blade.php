<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-bl from-white to-emerald-100 min-h-screen">
    <div class="flex flex-col lg:flex-row min-h-screen">

        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 sm:p-8 order-2 lg:order-1">
            <div
                class="bg-white/10 backdrop-blur-md rounded-3xl shadow-sm border border-slate-50 p-6 sm:p-12 w-full max-w-md">
                
                <!-- Logo Section -->
                <div class="flex justify-center mb-6">
                    <div class="bg-white rounded-2xl p-4 shadow-lg">
                        <img src="{{ asset('assets/img/banyuasin.png') }}" alt="Logo Banyuasin"
                            class="w-16 h-16 object-contain">
                    </div>
                </div>

                <div class="mb-6 sm:mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Daftar Akun Baru</h2>
                    <p class="text-gray-500 text-sm">Isi form di bawah untuk membuat akun</p>
                </div>

                <!-- Alert Success -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Alert Error -->
                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- Nama Lengkap -->
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama sesuai KTP"
                            class="w-full px-4 py-3 border @error('nama') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 @error('name') focus:ring-red-500 @else focus:ring-emerald-500 @enderror focus:border-transparent transition"
                            required>
                        @error('nama')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email"
                            class="w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 @error('email') focus:ring-red-500 @else focus:ring-emerald-500 @enderror focus:border-transparent transition"
                            required>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Kata Sandi -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" id="passwordField" name="password"
                                placeholder="Masukkan kata sandi"
                                class="w-full px-4 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 @error('password') focus:ring-red-500 @else focus:ring-emerald-500 @enderror focus:border-transparent transition"
                                required>
                            <button type="button" id="togglePasswordBtn"
                                class="absolute cursor-pointer right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg id="eyeIconShow" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg id="eyeIconHide" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input type="password" id="passwordConfirmField" name="password_confirmation"
                                placeholder="Ulangi kata sandi"
                                class="w-full px-4 py-3 border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 @error('password_confirmation') focus:ring-red-500 @else focus:ring-emerald-500 @enderror focus:border-transparent transition"
                                required>
                            <button type="button" id="togglePasswordConfirmBtn"
                                class="absolute cursor-pointer right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg id="eyeIconShowConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg id="eyeIconHideConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-emerald-800 text-white py-3 rounded-lg font-medium hover:bg-emerald-900 transition duration-300 mb-2 cursor-pointer">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600 text-sm">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-emerald-800 hover:text-emerald-900 font-semibold">
                            Masuk Sekarang
                        </a>
                    </p>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('beranda') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Splash Section - Hidden on mobile, visible on large screens -->
        <div
            class="hidden lg:flex w-full lg:w-1/2 items-center justify-center p-2 order-1 lg:order-2 lg:min-h-screen">
            <div
                class="bg-gradient-to-br from-emerald-900 to-emerald-950 backdrop-blur-md border border-slate-200 shadow-sm rounded-xl w-full h-full flex items-center justify-center relative overflow-hidden">

                <div class="orbit-container">
                    <div class="orbit-blob blob-1">
                        <div
                            class="w-36 h-36 bg-emerald-900 rounded-full mix-blend-multiply filter blur-xl opacity-80">
                        </div>
                    </div>
                    <div class="orbit-blob blob-2">
                        <div
                            class="w-32 h-32 bg-emerald-800 rounded-full mix-blend-multiply filter blur-xl opacity-80">
                        </div>
                    </div>
                    <div class="orbit-blob blob-3">
                        <div
                            class="w-20 h-20 bg-lime-800 rounded-full mix-blend-multiply filter blur-xl opacity-80">
                        </div>
                    </div>
                    <div class="orbit-blob blob-4">
                        <div
                            class="w-28 h-28 bg-green-800 rounded-full mix-blend-multiply filter blur-xl opacity-80">
                        </div>
                    </div>
                </div>

                <div
                    class="absolute top-4 right-4 z-20 bg-white backdrop-blur-lg rounded-2xl p-3 shadow-sm border border-white/30">
                    <img src="{{ asset('assets/img/banyuasin.png') }}" alt="Logo Desa"
                        class="relative z-10 w-10 h-auto drop-shadow-2xl">
                </div>

                <div class="splash-carousel relative z-10 w-full max-w-lg px-8">
                    <div class="splash-slide active">
                        <div class="flex flex-col items-center text-center py-3">
                            <div class="mb-6 bg-white/10 backdrop-blur-md rounded-full p-8 border border-white/20">
                                <img src="{{ asset('assets/img/login.png') }}" alt="Bergabung"
                                    class="w-32 h-32 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">Bergabung Bersama Kami</h3>
                            <p class="text-white/80 text-lg leading-relaxed">
                                Daftarkan diri Anda untuk mengakses layanan surat digital yang cepat, mudah, dan terpercaya
                            </p>
                        </div>
                    </div>

                    <div class="splash-slide">
                        <div class="flex flex-col items-center text-center py-3">
                            <div class="mb-6 bg-white/10 backdrop-blur-md rounded-full p-8 border border-white/20">
                                <img src="{{ asset('assets/img/login-2.png') }}" alt="Akses Mudah"
                                    class="w-32 h-32 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">Akses Kapan Saja</h3>
                            <p class="text-white/80 text-lg leading-relaxed">
                                Dengan akun Anda, ajukan berbagai jenis surat kapan saja dan dari mana saja
                            </p>
                        </div>
                    </div>

                    <div class="splash-slide">
                        <div class="flex flex-col items-center text-center py-3">
                            <div class="mb-6 bg-white/10 backdrop-blur-md rounded-full p-8 border border-white/20">
                                <img src="{{ asset('assets/img/login-3.png') }}" alt="Data Aman"
                                    class="w-32 h-32 object-contain">
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">Data Terlindungi</h3>
                            <p class="text-white/80 text-lg leading-relaxed">
                                Keamanan data pribadi Anda adalah prioritas utama kami dengan enkripsi tingkat tinggi
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-20 flex gap-3">
                    <button class="dot active" onclick="goToSlide(0)"></button>
                    <button class="dot" onclick="goToSlide(1)"></button>
                    <button class="dot" onclick="goToSlide(2)"></button>
                </div>

            </div>
        </div>

    </div>

    <style>
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

        .blob-1 {
            animation: orbit-large 15s linear infinite;
        }

        .blob-2 {
            animation: orbit-medium 12s linear infinite reverse;
        }

        .blob-3 {
            animation: orbit-small 10s linear infinite;
        }

        .blob-4 {
            animation: orbit-extra 18s linear infinite reverse;
        }

        @keyframes orbit-large {
            0% {
                transform: translate(-50%, -50%) rotate(0deg) translateX(280px) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg) translateX(280px) rotate(-360deg);
            }
        }

        @keyframes orbit-medium {
            0% {
                transform: translate(-50%, -50%) rotate(0deg) translateX(220px) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg) translateX(220px) rotate(-360deg);
            }
        }

        @keyframes orbit-small {
            0% {
                transform: translate(-50%, -50%) rotate(0deg) translateX(160px) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg) translateX(160px) rotate(-360deg);
            }
        }

        @keyframes orbit-extra {
            0% {
                transform: translate(-50%, -50%) rotate(0deg) translateX(320px) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg) translateX(320px) rotate(-360deg);
            }
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
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle Password
            const toggleBtn = document.getElementById('togglePasswordBtn');
            const passwordField = document.getElementById('passwordField');
            const eyeShow = document.getElementById('eyeIconShow');
            const eyeHide = document.getElementById('eyeIconHide');

            if (toggleBtn && passwordField && eyeShow && eyeHide) {
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
            }

            // Toggle Password Confirmation
            const toggleConfirmBtn = document.getElementById('togglePasswordConfirmBtn');
            const passwordConfirmField = document.getElementById('passwordConfirmField');
            const eyeShowConfirm = document.getElementById('eyeIconShowConfirm');
            const eyeHideConfirm = document.getElementById('eyeIconHideConfirm');

            if (toggleConfirmBtn && passwordConfirmField && eyeShowConfirm && eyeHideConfirm) {
                toggleConfirmBtn.addEventListener('click', function() {
                    if (passwordConfirmField.type === 'password') {
                        passwordConfirmField.type = 'text';
                        eyeShowConfirm.classList.add('hidden');
                        eyeHideConfirm.classList.remove('hidden');
                    } else {
                        passwordConfirmField.type = 'password';
                        eyeShowConfirm.classList.remove('hidden');
                        eyeHideConfirm.classList.add('hidden');
                    }
                });
            }
        });

        let currentSlide = 0;
        let autoSlide;
        const slides = document.querySelectorAll('.splash-slide');
        const dots = document.querySelectorAll('.dot');
        const slideInterval = 5000;

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

</html>