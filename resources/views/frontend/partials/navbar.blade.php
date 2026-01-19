{{-- Navbar --}}
<nav class="sticky top-0 z-50 border-b border-emerald-100/60 bg-white/85 backdrop-blur-xl">
    <div class="max-w-6xl mx-auto px-5 md:px-12 py-3 md:py-4 flex items-center justify-between gap-3">
        <!-- Logo & Title -->
        <div class="flex items-center gap-3 md:gap-4" data-aos="fade-down">
            <div
                class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-white shadow-lg shadow-emerald-900/25 border border-emerald-100 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('assets/img/banyuasin.png') }}" alt="Logo Desa Sungai Rebo"
                    class="w-full h-full object-contain p-1.5">
            </div>
            <div class="leading-tight">
                <p class="inline-flex items-center gap-2 text-[10px] uppercase tracking-[0.25em] text-emerald-700/80">
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
                <a href="{{ Request::routeIs('beranda') ? '#beranda' : route('beranda') . '#beranda' }}"
                    class="px-4 py-2 rounded-full text-neutral-700 hover:text-emerald-900 hover:bg-emerald-50 transition">
                    Beranda
                </a>
                <a href="{{ Request::routeIs('beranda') ? '#layanan' : route('beranda') . '#layanan' }}"
                    class="px-4 py-2 rounded-full text-neutral-700 hover:text-emerald-900 hover:bg-emerald-50 transition">
                    Layanan
                </a>
                <a href="{{ Request::routeIs('beranda') ? '#alur-pengajuan' : route('beranda') . '#alur-pengajuan' }}"
                    class="px-4 py-2 rounded-full text-neutral-700 hover:text-emerald-900 hover:bg-emerald-50 transition">
                    Alur
                </a>
                <a href="{{ Request::routeIs('beranda') ? '#lokasi' : route('beranda') . '#lokasi' }}"
                    class="px-4 py-2 rounded-full text-neutral-700 hover:text-emerald-900 hover:bg-emerald-50 transition">
                    Lokasi
                </a>
            </div>

            <!-- CTA kecil di navbar desktop -->
            @auth
                <a href="{{ route('pengajuan') }}"
                    class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-gradient-to-r from-emerald-600 via-emerald-500 to-emerald-400 text-white text-xs font-semibold shadow-md shadow-emerald-900/30 hover:brightness-110 transition scroll-smooth">
                    <i class="fa-solid fa-paper-plane"></i>
                    Ajukan Surat
                </a>
            @else
                <a href="{{ route('register') }}"
                    class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-emerald-200 text-emerald-700 text-xs font-semibold hover:bg-emerald-50 transition">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Daftar
                </a>
                <a href="{{ route('login') }}"
                    class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-gradient-to-r from-emerald-600 via-emerald-500 to-emerald-400 text-white text-xs font-semibold shadow-md shadow-emerald-900/30 hover:brightness-110 transition">
                    <i class="fa-solid fa-user-plus"></i>
                    Masuk
                </a>
            @endauth

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
            <a href="{{ Request::routeIs('beranda') ? '#beranda' : route('beranda') . '#beranda' }}"
                class="px-3 py-2 rounded-lg text-neutral-800 hover:bg-emerald-50 active:bg-emerald-100">
                Beranda
            </a>
            <a href="{{ Request::routeIs('beranda') ? '#layanan' : route('beranda') . '#layanan' }}"
                class="px-3 py-2 rounded-lg text-neutral-800 hover:bg-emerald-50 active:bg-emerald-100">
                Layanan
            </a>
            <a href="{{ Request::routeIs('beranda') ? '#alur-pengajuan' : route('beranda') . '#alur-pengajuan' }}"
                class="px-3 py-2 rounded-lg text-neutral-800 hover:bg-emerald-50 active:bg-emerald-100">
                Alur
            </a>
            <a href="{{ Request::routeIs('beranda') ? '#lokasi' : route('beranda') . '#lokasi' }}"
                class="px-3 py-2 rounded-lg text-neutral-800 hover:bg-emerald-50 active:bg-emerald-100">
                Lokasi
            </a>

            <!-- CTA Ajukan Surat di mobile -->
            @auth
                <a href="{{ route('pengajuan') }}"
                    class="mt-2 inline-flex md:hidden items-center justify-center gap-1.5 px-4 py-2 rounded-full
                    bg-gradient-to-r from-emerald-600 via-emerald-500 to-emerald-400
                    text-white text-sm font-semibold shadow-md shadow-emerald-900/30
                    hover:brightness-110 transition">
                    <i class="fa-solid fa-paper-plane"></i>
                    Ajukan Surat
                </a>
            @else
                <a href="{{ route('register') }}"
                    class="inline-flex md:hidden items-center justify-center gap-1.5 px-4 py-2 rounded-full
                        border border-emerald-200 text-emerald-700 text-sm font-semibold 
                        hover:bg-emerald-50 transition">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Daftar
                </a>
                <a href="{{ route('login') }}"
                    class="mt-2 inline-flex md:hidden items-center justify-center gap-1.5 px-4 py-2 rounded-full
                        bg-gradient-to-r from-emerald-600 via-emerald-500 to-emerald-400
                        text-white text-sm font-semibold shadow-md shadow-emerald-900/30
                        hover:brightness-110 transition">
                    <i class="fa-solid fa-user-plus"></i>
                    Masuk
                </a>
            @endauth
        </div>
    </div>
</nav>
