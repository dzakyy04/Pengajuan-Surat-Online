<footer id="kontak" class="bg-emerald-950 text-emerald-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <div class="grid md:grid-cols-5 gap-8">
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
                    <li>
                        <a href="{{ Request::routeIs('beranda') ? '#beranda' : route('beranda') . '#beranda' }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ Request::routeIs('beranda') ? '#layanan' : route('beranda') . '#layanan' }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">
                            Layanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ Request::routeIs('beranda') ? '#alur-pengajuan' : route('beranda') . '#alur-pengajuan' }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">
                            Alur Pengajuan
                        </a>
                    </li>
                    <li>
                        <a href="{{ Request::routeIs('beranda') ? '#lokasi' : route('beranda') . '#lokasi' }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">
                            Lokasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengajuan') }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">
                            Ajukan Surat
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Layanan -->
            <div>
                <h3 class="font-semibold text-lg mb-4 text-emerald-100">Layanan</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('pengajuan') }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                            Kematian</a></li>
                    <li><a href="{{ route('pengajuan') }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                            Keterangan Tidak Mampu</a></li>
                    <li><a href="{{ route('pengajuan') }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                            Keterangan Domisili</a></li>
                    <li><a href="{{ route('pengajuan') }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                            Keterangan Usaha</a></li>
                    <li><a href="{{ route('pengajuan') }}"
                            class="text-emerald-100/80 hover:text-emerald-400 transition">Surat
                            Keterangan Penghasilan</a></li>
                </ul>
            </div>

            <!-- Alur Pengajuan -->
            <div>
                <h3 class="font-semibold text-lg mb-4 text-emerald-100">Alur Pengajuan</h3>
                <ol class="text-xs md:text-sm text-emerald-100/85 list-decimal list-inside space-y-1">
                    <li>Isi form pengajuan surat secara online.</li>
                    <li>Tunggu proses verifikasi maksimal 1x24 jam kerja.</li>
                    <li>Ambil surat yang sudah disetujui.</li>
                </ol>
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
                        <span class="text-emerald-100/80">kantordesasungairebo@gmail.com</span>
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
