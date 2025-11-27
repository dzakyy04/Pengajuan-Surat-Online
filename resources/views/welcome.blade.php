<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    @vite('resources/css/app.css')

    <style>
        /* Animasi panel navbar mobile */
        .nav-mobile-panel {
            transition: max-height 0.3s ease, opacity 0.3s ease, transform 0.3s ease;
            transform-origin: top;
        }

        .nav-mobile-panel.closed {
            max-height: 0;
            opacity: 0;
            transform: scaleY(0.96);
            overflow: hidden;
        }

        .nav-mobile-panel.open {
            max-height: 260px;
            opacity: 1;
            transform: scaleY(1);
        }
    </style>
</head>

<body
    class="font-sans bg-gradient-to-b from-emerald-50 via-emerald-50/50 to-emerald-100/50 text-neutral-800 overflow-x-hidden">
    {{-- Background --}}
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-32 -left-24 w-72 h-72 bg-emerald-300/35 blur-3xl rounded-full"></div>
        <div class="absolute top-32 -right-20 w-80 h-80 bg-emerald-300/30 blur-3xl rounded-full"></div>
        <div class="absolute bottom-[-120px] left-1/3 w-96 h-96 bg-emerald-100/55 blur-3xl rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-52 h-52 bg-teal-100/45 blur-3xl rounded-full"></div>
    </div>

    {{-- Top header --}}
    <div
        class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-emerald-900 text-emerald-50 text-xs md:text-sm px-5 md:px-12 py-2 flex items-center justify-between shadow-md shadow-black/25">
        <div class="flex items-center gap-4 md:gap-8">
            <span class="flex items-center gap-1.5">
                <i class="fa-solid fa-envelope text-emerald-300 text-sm"></i>
                <span class="font-medium">sungairebo.desa@gmail.com</span>
            </span>
            <span class="hidden sm:flex items-center gap-1.5">
                <i class="fa-solid fa-phone text-emerald-300 text-sm"></i>
                <span class="font-medium">+62 812-3456-7890</span>
            </span>
        </div>
        <div class="flex items-center gap-2">
            <i class="fa-regular fa-clock text-emerald-300 hidden sm:inline"></i>
            <span>Senin - Jumat, 08.00 - 16.00 WIB</span>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 border-b border-emerald-100/60 bg-white/85 backdrop-blur-xl">
        <div class="max-w-6xl mx-auto px-5 md:px-12 py-3 md:py-4 flex items-center justify-between gap-3">
            <!-- Logo & Title -->
            <div class="flex items-center gap-3 md:gap-4" data-aos="fade-down">
                <div
                    class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-white shadow-lg shadow-emerald-900/25 border border-emerald-100 flex items-center justify-center overflow-hidden">
                    <!-- Logo gambar desa -->
                    <img src="{{ asset('assets/img/banyuasin.png') }}" alt="Logo Desa Sungai Rebo"
                        class="w-full h-full object-contain p-1.5">
                </div>
                <div class="leading-tight">
                    <p
                        class="inline-flex items-center gap-2 text-[10px] uppercase tracking-[0.25em] text-emerald-700/80">
                        Portal Desa Sungai Rebo
                        <span class="inline-block w-8 h-px bg-gradient-to-r from-emerald-400 to-teal-300"></span>
                    </p>
                    <h1 class="text-lg md:text-2xl font-extrabold text-emerald-950">
                        DESA SUNGAI REBO
                    </h1>
                    <p class="text-[11px] md:text-xs text-neutral-500 mt-0.5">
                        Kec. Banyuasin I, Kab. Banyuasin, Sumatera Selatan
                    </p>
                </div>
            </div>

            <!-- Nav links -->
            <div class="flex items-center gap-3">
                <div id="navLinks"
                    class="hidden md:flex md:flex-row flex-col md:items-center md:gap-6 gap-2 text-sm md:text-[15px] font-medium">
                    <a href="#beranda"
                        class="px-4 py-2 rounded-full text-neutral-700 hover:text-emerald-900 hover:bg-emerald-50 transition">
                        Beranda
                    </a>
                    <a href="#layanan"
                        class="px-4 py-2 rounded-full text-neutral-700 hover:text-emerald-900 hover:bg-emerald-50 transition">
                        Layanan
                    </a>
                    <a href="#alur-pengajuan"
                        class="px-4 py-2 rounded-full text-neutral-700 hover:text-emerald-900 hover:bg-emerald-50 transition">
                        Alur
                    </a>
                    <a href="#lokasi"
                        class="px-4 py-2 rounded-full text-neutral-700 hover:text-emerald-900 hover:bg-emerald-50 transition">
                        Lokasi
                    </a>
                </div>

                <!-- CTA kecil di navbar desktop -->
                <button
                    class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-gradient-to-r from-emerald-600 via-emerald-500 to-emerald-400 text-white text-xs font-semibold shadow-md shadow-emerald-900/30 hover:brightness-110 transition"
                    onclick="document.querySelector('#kontak').scrollIntoView({behavior:'smooth'})">
                    <i class="fa-solid fa-paper-plane"></i>
                    Ajukan Surat
                </button>

                <!-- Hamburger -->
                <button id="navToggle"
                    class="md:hidden inline-flex flex-col items-center justify-center w-9 h-9 rounded-full border border-emerald-200 bg-white/90 shadow-sm">
                    <span class="block w-5 h-0.5 bg-emerald-900 rounded-full mb-1 transition-all duration-200"></span>
                    <span class="block w-4 h-0.5 bg-emerald-900 rounded-full mb-1 transition-all duration-200"></span>
                    <span class="block w-6 h-0.5 bg-emerald-900 rounded-full transition-all duration-200"></span>
                </button>
            </div>
        </div>

        <!-- Nav mobile dropdown (smooth) -->
        <div id="navMobile"
            class="nav-mobile-panel closed md:hidden border-t border-emerald-50 bg-white/95 backdrop-blur-xl">
            <div class="max-w-6xl mx-auto px-5 py-3 flex flex-col gap-1 text-sm">
                <a href="#beranda"
                    class="px-3 py-2 rounded-lg text-neutral-800 hover:bg-emerald-50 active:bg-emerald-100">
                    Beranda
                </a>
                <a href="#layanan"
                    class="px-3 py-2 rounded-lg text-neutral-800 hover:bg-emerald-50 active:bg-emerald-100">
                    Layanan
                </a>
                <a href="#alur-pengajuan"
                    class="px-3 py-2 rounded-lg text-neutral-800 hover:bg-emerald-50 active:bg-emerald-100">
                    Alur
                </a>
                <a href="#lokasi"
                    class="px-3 py-2 rounded-lg text-neutral-800 hover:bg-emerald-50 active:bg-emerald-100">
                    Lokasi
                </a>

                <!-- CTA Ajukan Surat di mobile -->
                <button
                    class="mt-2 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-full bg-gradient-to-r from-emerald-600 via-emerald-500 to-emerald-400 text-white text-xs font-semibold shadow-md shadow-emerald-900/25 hover:brightness-110 transition"
                    onclick="document.querySelector('#kontak').scrollIntoView({behavior:'smooth'})">
                    <i class="fa-solid fa-paper-plane"></i>
                    Ajukan Surat
                </button>
            </div>
        </div>
    </nav>

    {{-- Hero section --}}
    <section class="relative h-[580px] md:h-[620px]" id="beranda">
        <div
            class="relative w-full h-full overflow-hidden shadow-xl shadow-emerald-900/20 rounded-b-3xl md:rounded-b-[2.5rem]">

            <!-- Background container -->
            <div class="absolute inset-0 z-0">
                <div id="heroBg"
                    class="h-full w-full bg-cover bg-center opacity-100 transition-opacity duration-1000 ease-out">
                </div>
            </div>

            <!-- Overlay gradient di atas background (soft emerald) -->
            <div
                class="absolute inset-0 z-10 bg-gradient-to-b from-emerald-950/70 via-emerald-900/60 to-emerald-950/80">
            </div>

            <!-- Konten hero -->
            <div class="relative z-20 max-w-4xl w-11/12 mx-auto text-center text-white top-1/2 -translate-y-1/2 space-y-5 md:space-y-6"
                data-aos="fade-up">
                <div
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/10 border border-emerald-200/60 backdrop-blur-md text-xs md:text-sm font-semibold">
                    <span
                        class="w-7 h-7 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-400 flex items-center justify-center text-[12px] shadow-md shadow-emerald-900/40">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span>Layanan Digital Desa Sungai Rebo</span>
                </div>
                <h1
                    class="text-3xl md:text-5xl lg:text-6xl font-black leading-tight drop-shadow-[0_15px_35px_rgba(0,0,0,0.55)]">
                    Sistem Pelayanan Surat Online Desa Sungai Rebo
                </h1>
                <p class="text-sm md:text-lg lg:text-xl opacity-95 max-w-3xl mx-auto">
                    Warga Desa Sungai Rebo dapat mengurus administrasi kependudukan dari rumah dengan mudah,
                    transparan, dan terpantau secara real-time.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <button
                        class="px-8 py-3 md:px-10 md:py-3.5 rounded-xl text-sm md:text-base font-bold bg-gradient-to-r from-emerald-500 via-emerald-400 to-emerald-300 shadow-lg shadow-emerald-900/40 hover:brightness-110 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-emerald-900/50 transition"
                        onclick="alert('Silakan login atau daftar terlebih dahulu untuk mengajukan surat.')">
                        <i class="fa-solid fa-file-signature mr-2"></i>
                        Ajukan Surat Sekarang
                    </button>
                    <button
                        class="px-8 py-3 md:px-10 md:py-3.5 rounded-xl text-sm md:text-base font-semibold bg-white/10 border border-emerald-200/70 text-white hover:bg-white/15 hover:-translate-y-0.5 transition"
                        onclick="document.querySelector('#layanan').scrollIntoView({behavior:'smooth'})">
                        <i class="fa-solid fa-list-check mr-2"></i>
                        Lihat Jenis Layanan
                    </button>
                </div>
                <div
                    class="mt-2 flex flex-wrap items-center justify-center gap-3 text-[11px] md:text-xs text-emerald-100/90">
                    <span class="inline-flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Pengajuan surat online 24/7</span>
                    </span>
                    <span class="hidden sm:inline-block w-px h-4 bg-white/25"></span>
                    <span class="inline-flex items-center gap-1.5">
                        <i class="fa-regular fa-clock text-emerald-300"></i>
                        <span>Proses maksimal 1x24 jam kerja</span>
                    </span>
                </div>
            </div>

            <!-- Pagination dots -->
            <div id="heroBgPagination"
                class="flex items-center justify-center gap-1 absolute bottom-6 md:bottom-8 left-1/2 -translate-x-1/2 z-30">
            </div>

            <!-- Prev / Next buttons -->
            <button
                class="hero-bg-prev z-30 absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-11 md:h-11 rounded-full border border-white/40 bg-white/10 backdrop-blur-md flex items-center justify-center text-white text-lg cursor-pointer hover:bg-white/20 hover:border-white/60 transition">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button
                class="hero-bg-next z-30 absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-11 md:h-11 rounded-full border border-white/40 bg-white/10 backdrop-blur-md flex items-center justify-center text-white text-lg cursor-pointer hover:bg-white/20 hover:border-white/60 transition">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </section>


    {{-- Layanan surat --}}
    <section class="py-16 md:py-20" id="layanan">
        <div class="max-w-6xl mx-auto px-5 md:px-12" data-aos="fade-up">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="relative inline-block text-2xl md:text-4xl font-extrabold text-emerald-950">
                    Layanan Surat Online Desa Sungai Rebo
                    <span
                        class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-20 h-[3px] rounded-full bg-gradient-to-r from-emerald-600 to-teal-500"></span>
                </h2>
                <p class="mt-6 text-neutral-600 text-base md:text-lg max-w-2xl mx-auto">
                    Ajukan berbagai jenis surat administrasi desa tanpa harus datang langsung. Cukup daftar, isi
                    formulir, dan pantau status pengajuan secara online.
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-6 md:gap-7">
                <!-- 1. Surat Pengantar Nikah -->
                <div
                    class="service-card w-full sm:w-[48%] lg:w-[30%] cursor-pointer bg-white/95 border border-emerald-50 rounded-2xl px-6 py-8 text-center hover:border-emerald-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-400 flex items-center justify-center text-3xl text-white shadow-lg shadow-emerald-900/20">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-neutral-800">Surat Pengantar Nikah</h3>
                    <p class="text-sm text-neutral-600">
                        Pengantar resmi dari desa untuk proses pencatatan pernikahan di KUA atau lembaga terkait
                        lainnya.
                    </p>
                </div>

                <!-- 2. Surat Keterangan Tidak Mampu -->
                <div
                    class="service-card w-full sm:w-[48%] lg:w-[30%] cursor-pointer bg-white/95 border border-emerald-50 rounded-2xl px-6 py-8 text-center hover:border-emerald-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-emerald-700 via-emerald-500 to-emerald-400 flex items-center justify-center text-3xl text-white shadow-lg shadow-emerald-900/20">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-neutral-800">Surat Keterangan Tidak Mampu</h3>
                    <p class="text-sm text-neutral-600">
                        Keterangan bagi warga kurang mampu untuk keperluan pendidikan, kesehatan, atau pengajuan
                        bantuan sosial.
                    </p>
                </div>

                <!-- 3. Surat Keterangan Domisili -->
                <div
                    class="service-card w-full sm:w-[48%] lg:w-[30%] cursor-pointer bg-white/95 border border-emerald-50 rounded-2xl px-6 py-8 text-center hover:border-emerald-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-emerald-600 via-emerald-500 to-emerald-400 flex items-center justify-center text-3xl text-white shadow-lg shadow-emerald-900/20">
                        <i class="fa-solid fa-house-chimney"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-neutral-800">Surat Keterangan Domisili</h3>
                    <p class="text-sm text-neutral-600">
                        Keterangan alamat tempat tinggal resmi warga Desa Sungai Rebo untuk berbagai kebutuhan
                        administrasi.
                    </p>
                </div>

                <!-- 4. Surat Keterangan Usaha -->
                <div
                    class="service-card w-full sm:w-[48%] lg:w-[30%] cursor-pointer bg-white/95 border border-emerald-50 rounded-2xl px-6 py-8 text-center hover:border-emerald-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-teal-600 via-teal-500 to-emerald-400 flex items-center justify-center text-3xl text-white shadow-lg shadow-emerald-900/20">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-neutral-800">Surat Keterangan Usaha</h3>
                    <p class="text-sm text-neutral-600">
                        Legalisasi usaha warga desa untuk perizinan, pengajuan bantuan modal, maupun kerja sama
                        dengan pihak lain.
                    </p>
                </div>

                <!-- 5. Surat Keterangan Penghasilan -->
                <div
                    class="service-card w-full sm:w-[48%] lg:w-[30%] cursor-pointer bg-white/95 border border-emerald-50 rounded-2xl px-6 py-8 text-center hover:border-emerald-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-emerald-500 via-emerald-400 to-teal-300 flex items-center justify-center text-3xl text-white shadow-lg shadow-emerald-900/20">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-neutral-800">Surat Keterangan Penghasilan</h3>
                    <p class="text-sm text-neutral-600">
                        Keterangan besaran penghasilan sebagai syarat pengajuan beasiswa, pinjaman, atau keperluan
                        administrasi lainnya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Alur Pengajuan --}}
    <section class="py-16 md:py-20 bg-gradient-to-b from-emerald-50 via-white to-emerald-50/80" id="alur-pengajuan">
        <div class="max-w-6xl mx-auto px-5 md:px-12" data-aos="fade-up">
            <div class="text-center mb-12 md:mb-14">
                <h2 class="relative inline-block text-2xl md:text-4xl font-extrabold text-emerald-950">
                    Alur Pengajuan Surat Online
                    <span
                        class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-20 h-[3px] rounded-full bg-gradient-to-r from-emerald-600 to-teal-500"></span>
                </h2>
                <p class="mt-6 text-neutral-600 text-base md:text-lg max-w-2xl mx-auto">
                    Ikuti langkah sederhana berikut untuk mengajukan surat secara online tanpa harus antre di kantor
                    desa.
                </p>
            </div>

            <div class="grid gap-6 md:gap-8 md:grid-cols-3">
                <!-- Step 1 -->
                <div
                    class="relative bg-white/95 border border-emerald-50 rounded-2xl px-6 py-8 shadow-md shadow-black/5 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="w-11 h-11 flex items-center justify-center rounded-full bg-gradient-to-br from-emerald-600 to-teal-500 text-white font-bold text-lg mb-4 shadow-md shadow-emerald-900/30">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-neutral-800 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-file-pen text-emerald-600"></i>
                        Isi Formulir Pengajuan
                    </h3>
                    <p class="text-sm text-neutral-600 leading-relaxed">
                        Pilih jenis surat yang dibutuhkan lalu isi formulir pengajuan secara lengkap dan benar,
                        sertakan juga dokumen pendukung jika diminta.
                    </p>
                </div>

                <!-- Step 2 -->
                <div
                    class="relative bg-white/95 border border-emerald-50 rounded-2xl px-6 py-8 shadow-md shadow-black/5 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="w-11 h-11 flex items-center justify-center rounded-full bg-gradient-to-br from-emerald-600 to-teal-500 text-white font-bold text-lg mb-4 shadow-md shadow-emerald-900/30">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-neutral-800 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-emerald-600"></i>
                        Tunggu Proses Verifikasi
                    </h3>
                    <p class="text-sm text-neutral-600 leading-relaxed">
                        Petugas desa akan memeriksa data dan dokumen pengajuan Anda.
                        <span class="font-semibold text-emerald-700">Proses maksimal 1x24 jam kerja.</span>
                    </p>
                </div>

                <!-- Step 3 -->
                <div
                    class="relative bg-white/95 border border-emerald-50 rounded-2xl px-6 py-8 shadow-md shadow-black/5 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="w-11 h-11 flex items-center justify-center rounded-full bg-gradient-to-br from-emerald-600 to-teal-500 text-white font-bold text-lg mb-4 shadow-md shadow-emerald-900/30">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-neutral-800 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-download text-emerald-600"></i>
                        Download Surat Online
                    </h3>
                    <p class="text-sm text-neutral-600 leading-relaxed">
                        Setelah disetujui, surat akan tersedia dalam bentuk digital.
                        Anda dapat mengunduh dan mencetak surat tersebut kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Lokasi --}}
    <section class="bg-gradient-to-b from-neutral-50 via-white to-emerald-50/70 py-16 md:py-20" id="lokasi">
        <div class="max-w-6xl mx-auto px-5 md:px-12" data-aos="fade-up">
            <div class="text-center mb-12 md:mb-14">
                <h2 class="relative inline-block text-2xl md:4xl font-extrabold text-emerald-950">
                    Lokasi Kantor Desa Sungai Rebo
                    <span
                        class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-20 h-[3px] rounded-full bg-gradient-to-r from-emerald-600 to-teal-500"></span>
                </h2>
                <p class="mt-6 text-neutral-600 text-base md:text-lg max-w-2xl mx-auto">
                    Untuk layanan tatap muka, warga dapat datang langsung ke kantor Desa Sungai Rebo pada jam
                    pelayanan berikut.
                </p>
            </div>

            <div
                class="map-container mb-8 md:mb-10 rounded-2xl overflow-hidden shadow-xl shadow-black/10 border border-emerald-100/70">
                <iframe
                    src="https://maps.google.com/maps?q=kantor+desa+sungai+rebo&t=k&z=18&ie=UTF8&iwloc=&output=embed"
                    width="100%" height="450" class="border-0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="location-info grid gap-6 md:gap-7 grid-cols-1 md:grid-cols-3">
                <div
                    class="location-card bg-white rounded-2xl px-6 py-6 flex gap-4 items-start shadow-md shadow-black/5 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="location-icon w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-600 to-teal-500 flex items-center justify-center text-lg text-white flex-shrink-0 shadow-md shadow-emerald-900/25">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-emerald-800 mb-1">Alamat</h4>
                        <p class="text-sm text-neutral-700">
                            Jl. Raya Sungai Rebo, Desa Sungai Rebo,
                            Kec. Banyuasin I, Kab. Banyuasin, Sumatera Selatan.
                        </p>
                    </div>
                </div>

                <div
                    class="location-card bg-white rounded-2xl px-6 py-6 flex gap-4 items-start shadow-md shadow-black/5 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="location-icon w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-600 to-emerald-400 flex items-center justify-center text-lg text-white flex-shrink-0 shadow-md shadow-emerald-900/25">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-emerald-800 mb-1">Jam Buka</h4>
                        <p class="text-sm text-neutral-700">
                            Senin - Kamis: 08.00 - 16.00 WIB<br />
                            Jumat: 08.00 - 16.30 WIB
                        </p>
                    </div>
                </div>

                <div
                    class="location-card bg-white rounded-2xl px-6 py-6 flex gap-4 items-start shadow-md shadow-black/5 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="location-icon w-11 h-11 rounded-xl bg-gradient-to-br from-teal-600 to-emerald-500 flex items-center justify-center text-lg text-white flex-shrink-0 shadow-md shadow-emerald-900/25">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-emerald-800 mb-1">Kontak</h4>
                        <p class="text-sm text-neutral-700">
                            Telepon Kantor: (0711) 123-456<br />
                            WhatsApp Admin: 0812-3456-7890
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA  --}}
    <section class="py-10 md:py-14 bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-500" data-aos="fade-up">
        <div class="max-w-6xl mx-auto px-5 md:px-12">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div>
                    <p class="text-xs uppercase tracking-[0.25em] text-emerald-100/80 mb-2">
                        Layanan Surat Online
                    </p>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-3">
                        Siap Mengurus Surat Desa Hari Ini?
                    </h3>
                    <p class="text-emerald-50/90 text-sm md:text-base max-w-xl">
                        Ajukan permohonan surat secara online tanpa perlu antre di kantor desa. Cukup isi formulir,
                        unggah berkas yang dibutuhkan, dan pantau prosesnya dari rumah.
                    </p>
                    <div class="mt-4 flex flex-wrap gap-3 text-xs md:text-sm text-emerald-50/90">
                        <span class="inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-check text-emerald-200"></i>
                            Pengajuan surat online 24/7
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-check text-emerald-200"></i>
                            Proses maksimal 1x24 jam kerja
                        </span>
                    </div>
                </div>
                <div class="flex flex-col items-stretch gap-3 w-full md:w-auto">
                    <button
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white text-emerald-800 font-semibold text-sm md:text-base shadow-lg shadow-emerald-900/40 hover:bg-emerald-50 hover:-translate-y-0.5 transition"
                        onclick="document.querySelector('#kontak').scrollIntoView({behavior:'smooth'})">
                        <i class="fa-solid fa-paper-plane"></i>
                        Ajukan Surat Sekarang
                    </button>
                    <button
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-emerald-100/70 text-emerald-50 text-xs md:text-sm hover:bg-emerald-800/30 transition"
                        onclick="document.querySelector('#layanan').scrollIntoView({behavior:'smooth'})">
                        <i class="fa-solid fa-list-check"></i>
                        Lihat Jenis Layanan
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer id="kontak" class="bg-emerald-950 text-emerald-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center overflow-hidden mr-2">
                            <img src="{{ asset('assets/img/banyuasin.png') }}" alt="Logo Desa Sungai Rebo"
                                class="w-full h-full object-contain p-1">
                        </div>
                        <span class="text-xl font-bold tracking-tight">Desa Sungai Rebo</span>
                    </div>
                    <p class="text-emerald-100/80 mb-4 text-sm">
                        Portal layanan surat online Desa Sungai Rebo untuk memudahkan warga dalam pengurusan
                        administrasi desa secara cepat dan transparan.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-emerald-200/70 hover:text-emerald-400 transition">
                            <i class="fab fa-facebook text-2xl"></i>
                        </a>
                        <a href="#" class="text-emerald-200/70 hover:text-emerald-400 transition">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a href="#" class="text-emerald-200/70 hover:text-emerald-400 transition">
                            <i class="fab fa-youtube text-2xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold text-lg mb-4 text-emerald-100">Link Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#beranda"
                                class="text-emerald-100/80 hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="#layanan"
                                class="text-emerald-100/80 hover:text-emerald-400 transition">Layanan</a></li>
                        <li><a href="#lokasi" class="text-emerald-100/80 hover:text-emerald-400 transition">Lokasi</a>
                        </li>
                        <li><a href="#kontak" class="text-emerald-100/80 hover:text-emerald-400 transition">Kontak</a>
                        </li>
                        <li><a href="#" class="text-emerald-100/80 hover:text-emerald-400 transition">FAQ</a>
                        </li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h3 class="font-semibold text-lg mb-4 text-emerald-100">Layanan</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#layanan" class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                                Pengantar
                                Nikah</a></li>
                        <li><a href="#layanan" class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                                Keterangan
                                Tidak Mampu</a></li>
                        <li><a href="#layanan" class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                                Keterangan
                                Domisili</a></li>
                        <li><a href="#layanan" class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                                Keterangan
                                Usaha</a></li>
                        <li><a href="#layanan" class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                                Keterangan
                                Penghasilan</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="font-semibold text-lg mb-4 text-emerald-100">Kontak</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-emerald-300 mr-3 mt-1"></i>
                            <span class="text-emerald-100/80">
                                Kantor Desa Sungai Rebo<br>
                                Kec. Banyuasin I, Kab. Banyuasin, Sumatera Selatan
                            </span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-emerald-300 mr-3"></i>
                            <span class="text-emerald-100/80">(0711) 123-456</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fab fa-whatsapp text-emerald-300 mr-3"></i>
                            <span class="text-emerald-100/80">0812-3456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-emerald-300 mr-3"></i>
                            <span class="text-emerald-100/80">sungairebo.desa@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-emerald-800 mt-12 pt-8 text-center text-sm">
                <p class="text-emerald-200/80">
                    &copy; 2025 Desa Sungai Rebo. Semua hak dilindungi. Dibuat dengan
                    <i class="fas fa-heart text-emerald-400 mx-1"></i>
                    untuk masyarakat Desa Sungai Rebo
                </p>
            </div>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        // Mobile nav toggle dengan animasi smooth
        const navToggle = document.getElementById('navToggle');
        const navMobile = document.getElementById('navMobile');

        if (navToggle && navMobile) {
            navToggle.addEventListener('click', () => {
                const isOpen = navMobile.classList.contains('open');
                if (isOpen) {
                    navMobile.classList.remove('open');
                    navMobile.classList.add('closed');
                } else {
                    navMobile.classList.remove('closed');
                    navMobile.classList.add('open');
                }
            });
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
                if (navMobile && navMobile.classList.contains('open')) {
                    navMobile.classList.remove('open');
                    navMobile.classList.add('closed');
                }
            });
        });

        // Hero background slider
        const heroImages = [
            'https://images.unsplash.com/photo-1482192596544-9eb780fc7f66?w=1600&h=600&fit=crop',
            'https://images.unsplash.com/photo-1516483638261-f4dbaf036963?w=1600&h=600&fit=crop',
            'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1600&h=600&fit=crop'
        ];

        const heroBg = document.getElementById('heroBg');
        const pagination = document.getElementById('heroBgPagination');
        const prevBtn = document.querySelector('.hero-bg-prev');
        const nextBtn = document.querySelector('.hero-bg-next');

        let currentHeroIndex = 0;
        let heroInterval = null;

        function renderPagination() {
            if (!pagination) return;
            pagination.innerHTML = '';
            heroImages.forEach((_, idx) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className =
                    'w-2.5 h-2.5 rounded-full mx-1 border border-white/60 transition ' +
                    (idx === currentHeroIndex ? 'bg-white' : 'bg-white/10');
                dot.addEventListener('click', () => {
                    currentHeroIndex = idx;
                    setHeroBg(false);
                    resetHeroInterval();
                });
                pagination.appendChild(dot);
            });
        }

        function setHeroBg(firstLoad = false) {
            if (!heroBg) return;

            if (firstLoad) {
                heroBg.style.backgroundImage = `url('${heroImages[currentHeroIndex]}')`;
                heroBg.classList.remove('opacity-0');
                heroBg.classList.add('opacity-100');
                renderPagination();
                return;
            }

            // Fade-out dulu
            heroBg.classList.remove('opacity-100');
            heroBg.classList.add('opacity-0');

            // Setelah sebagian durasi, ganti gambar lalu fade-in lagi
            setTimeout(() => {
                heroBg.style.backgroundImage = `url('${heroImages[currentHeroIndex]}')`;
                heroBg.classList.remove('opacity-0');
                heroBg.classList.add('opacity-100');
                renderPagination();
            }, 400); // 400ms dari 1000ms => smooth tanpa kedip
        }

        function nextHero() {
            currentHeroIndex = (currentHeroIndex + 1) % heroImages.length;
            setHeroBg(false);
        }

        function prevHero() {
            currentHeroIndex = (currentHeroIndex - 1 + heroImages.length) % heroImages.length;
            setHeroBg(false);
        }

        function startHeroInterval() {
            if (heroInterval) clearInterval(heroInterval);
            heroInterval = setInterval(nextHero, 5000);
        }

        function resetHeroInterval() {
            startHeroInterval();
        }

        if (heroBg && heroImages.length > 0) {
            setHeroBg(true);
            startHeroInterval();

            if (nextBtn) nextBtn.addEventListener('click', () => {
                nextHero();
                resetHeroInterval();
            });

            if (prevBtn) prevBtn.addEventListener('click', () => {
                prevHero();
                resetHeroInterval();
            });
        }

        // Inisialisasi AOS (kalem)
        AOS.init({
            duration: 600,
            once: true,
            offset: 120,
            easing: 'ease-out-cubic',
        });
    </script>

</body>

</html>
