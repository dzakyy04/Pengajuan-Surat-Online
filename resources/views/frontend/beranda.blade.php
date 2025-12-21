@extends('frontend.layout.app')

@section('content')
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
            <div class="absolute inset-0 z-10 bg-gradient-to-b from-emerald-950/70 via-emerald-900/60 to-emerald-950/80">
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
                    <a href="{{ route('pengajuan') }}"
                        class="px-8 py-3 md:px-10 md:py-3.5 rounded-xl text-sm md:text-base font-bold bg-gradient-to-r from-emerald-500 via-emerald-400 to-emerald-300 shadow-lg shadow-emerald-900/40 hover:brightness-110 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-emerald-900/50 transition">
                        <i class="fa-solid fa-file-signature mr-2"></i>
                        Ajukan Surat Sekarang
                    </a>
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
                <!-- 1. Surat Kematian -->
                <a href="{{ route('pengajuan') }}"
                    class="service-card w-full sm:w-[48%] lg:w-[30%] cursor-pointer bg-white/95 border border-emerald-50 rounded-2xl px-6 py-8 text-center hover:border-emerald-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-900/10 transition">
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-400 flex items-center justify-center text-3xl text-white shadow-lg shadow-emerald-900/20">
                        <i class="fa-solid fa-file-circle-xmark"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-neutral-800">Surat Kematian</h3>
                    <p class="text-sm text-neutral-600">
                        Surat resmi dari desa untuk pencatatan kematian di Dinas Kependudukan dan Catatan Sipil
                        (Disdukcapil) atau lembaga terkait lainnya.
                    </p>
                </a>

                <!-- 2. Surat Keterangan Tidak Mampu -->
                <a href="{{ route('pengajuan') }}"
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
                </a>

                <!-- 3. Surat Keterangan Domisili -->
                <a href="{{ route('pengajuan') }}"
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
                </a>

                <!-- 4. Surat Keterangan Usaha -->
                <a href="{{ route('pengajuan') }}"
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
                </a>

                <!-- 5. Surat Keterangan Penghasilan -->
                <a href="{{ route('pengajuan') }}"
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
                </a>
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
                        <i class="fa-solid fa-hand-paper text-emerald-600"></i>
                        Ambil Manual
                    </h3>
                    <p class="text-sm text-neutral-600 leading-relaxed">
                        Setelah disetujui, Anda dapat mengambil surat secara langsung di kantor desa atau instansi
                        terkait pada jam operasional.
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
                <iframe src="https://maps.google.com/maps?q=kantor+desa+sungai+rebo&t=k&z=18&ie=UTF8&iwloc=&output=embed"
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
                    <a href="{{ route('pengajuan') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white text-emerald-800 font-semibold text-sm md:text-base shadow-lg shadow-emerald-900/40 hover:bg-emerald-50 hover:-translate-y-0.5 transition">
                        <i class="fa-solid fa-paper-plane"></i>
                        Ajukan Surat Sekarang
                    </a>
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
@endsection
