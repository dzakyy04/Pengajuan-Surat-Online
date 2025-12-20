@extends('frontend.layout.app')

@section('content')
    <section id="form-pengajuan" class="py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-5 md:px-12" data-aos="fade-up">
            <div class="bg-white/95 border border-emerald-100 rounded-2xl shadow-lg shadow-black/5 p-5 md:p-7 lg:p-8">

                {{-- Step Indicator --}}
                <div class="mb-8">
                    <h3 class="text-lg md:text-xl font-extrabold text-emerald-950 mb-1 flex items-center gap-2">
                        <i class="fa-solid fa-file-pen text-emerald-600"></i>
                        Form Pengajuan Surat Online
                    </h3>
                    <p class="text-xs md:text-sm text-neutral-600 mb-5">
                        Isi data sesuai langkah-langkah berikut. Kolom bertanda <span class="text-red-500">*</span>
                        wajib diisi.
                    </p>

                    <div class="grid grid-cols-4 gap-3 text-[11px] md:text-xs">
                        <div data-step-indicator="1" class="flex flex-col items-center gap-1">
                            <div
                                class="w-8 h-8 rounded-full flex items-center justify-center font-bold border border-emerald-200 bg-emerald-600 text-white">
                                1
                            </div>
                            <span class="text-center text-neutral-700 font-semibold">Jenis Surat</span>
                        </div>
                        <div data-step-indicator="2" class="flex flex-col items-center gap-1 opacity-60">
                            <div
                                class="w-8 h-8 rounded-full flex items-center justify-center font-bold border border-emerald-200 bg-white text-emerald-700">
                                2
                            </div>
                            <span class="text-center text-neutral-700 font-semibold">Data Pribadi</span>
                        </div>
                        <div data-step-indicator="3" class="flex flex-col items-center gap-1 opacity-60">
                            <div
                                class="w-8 h-8 rounded-full flex items-center justify-center font-bold border border-emerald-200 bg-white text-emerald-700">
                                3
                            </div>
                            <span class="text-center text-neutral-700 font-semibold">Detail & Dokumen</span>
                        </div>
                        <div data-step-indicator="4" class="flex flex-col items-center gap-1 opacity-60">
                            <div
                                class="w-8 h-8 rounded-full flex items-center justify-center font-bold border border-emerald-200 bg-white text-emerald-700">
                                4
                            </div>
                            <span class="text-center text-neutral-700 font-semibold">Konfirmasi</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="" enctype="multipart/form-data" id="formPengajuan" class="space-y-6">
                    @csrf

                    {{-- STEP 1: Jenis Surat --}}
                    <div data-step="1" class="space-y-5">
                        <h4 class="text-sm font-bold text-emerald-900 mb-2">
                            Langkah 1: Pilih Jenis Surat
                        </h4>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-800">
                                Jenis Surat <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_surat" id="jenis_surat" required
                                class="w-full rounded-xl border border-emerald-100 bg-emerald-50/40 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                <option value="" disabled selected>Pilih jenis surat</option>
                                <option value="pengantar_nikah">Surat Pengantar Nikah</option>
                                <option value="tidak_mampu">Surat Keterangan Tidak Mampu</option>
                                <option value="domisili">Surat Keterangan Domisili</option>
                                <option value="usaha">Surat Keterangan Usaha</option>
                                <option value="penghasilan">Surat Keterangan Penghasilan</option>
                            </select>
                            <p id="error_step1" class="text-[11px] text-red-500 mt-1 hidden">
                                Silakan pilih jenis surat terlebih dahulu.
                            </p>
                        </div>

                        <div class="pt-4 flex justify-end">
                            <button type="button" data-next
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-400 text-white text-xs md:text-sm font-semibold shadow-md shadow-emerald-900/30 hover:brightness-110 hover:-translate-y-0.5 transition">
                                Lanjut ke Data Pribadi
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                    </div>

                    {{-- STEP 2: Data Pribadi --}}
                    <div data-step="2" class="space-y-5 hidden">
                        <h4 class="text-sm font-bold text-emerald-900 mb-2">
                            Langkah 2: Data Pribadi Pemohon
                        </h4>

                        <div class="space-y-4">
                            {{-- NIK --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    NIK <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nik" id="nik" required maxlength="16"
                                    inputmode="numeric" pattern="[0-9]{16}"
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="16 digit NIK sesuai KTP">
                            </div>

                            {{-- Nama --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama" id="nama" required
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="Nama sesuai KTP">
                            </div>

                            {{-- Tempat & Tanggal Lahir --}}
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Tempat Lahir <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" required
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                        placeholder="Contoh: Sungai Rebo">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Tanggal Lahir <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" required
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                </div>
                            </div>

                            {{-- Jenis Kelamin & Status Perkawinan --}}
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Jenis Kelamin <span class="text-red-500">*</span>
                                    </label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" required
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                        <option value="" disabled selected>Pilih jenis kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Status Perkawinan <span class="text-red-500">*</span>
                                    </label>
                                    <select name="status_perkawinan" id="status_perkawinan" required
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                        <option value="" disabled selected>Pilih status perkawinan</option>
                                        <option value="Belum Kawin">Belum Kawin</option>
                                        <option value="Kawin">Kawin</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                        <option value="Cerai Mati">Cerai Mati</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Kewarganegaraan & Agama --}}
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Kewarganegaraan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="kewarganegaraan" id="kewarganegaraan" required
                                        value="Indonesia"
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Agama <span class="text-red-500">*</span>
                                    </label>
                                    <select name="agama" id="agama" required
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                        <option value="" disabled selected>Pilih agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Pekerjaan --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Pekerjaan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="pekerjaan" id="pekerjaan" required
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="Contoh: Buruh Harian Lepas, Ibu Rumah Tangga, Pelajar, dll.">
                            </div>

                            {{-- Alamat --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Alamat <span class="text-red-500">*</span>
                                </label>
                                <textarea name="alamat" id="alamat" rows="2" required
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="Tulis alamat lengkap di Desa Sungai Rebo, termasuk RT/RW/RK/Dusun."></textarea>
                            </div>

                            {{-- No Telepon --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    No. Telepon / WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="no_telepon" id="no_telepon" required
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="Contoh: 0812xxxxxxx">
                            </div>
                        </div>

                        <div class="pt-4 flex justify-between">
                            <button type="button" data-prev
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-neutral-200 text-xs md:text-sm text-neutral-700 hover:bg-neutral-50">
                                <i class="fa-solid fa-arrow-left-long"></i>
                                Kembali
                            </button>
                            <button type="button" data-next
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-400 text-white text-xs md:text-sm font-semibold shadow-md shadow-emerald-900/30 hover:brightness-110 hover:-translate-y-0.5 transition">
                                Lanjut ke Detail & Dokumen
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                    </div>

                    {{-- STEP 3: Detail & Dokumen --}}
                    <div data-step="3" class="space-y-5 hidden">
                        <h4 class="text-sm font-bold text-emerald-900 mb-2">
                            Langkah 3: Detail Keperluan & Dokumen Pendukung
                        </h4>

                        {{-- Keperluan / Bermaksud --}}
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-800">
                                Keperluan / Bermaksud <span class="text-red-500">*</span>
                            </label>
                            <textarea name="keperluan" id="keperluan" rows="3" required
                                class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                placeholder="Contoh: untuk pelengkap administrasi pembuatan KIS, untuk keperluan beasiswa, untuk keterangan usaha warung sembako, dll."></textarea>
                        </div>

                        {{-- Keterangan Tambahan (opsional) --}}
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-800">
                                Keterangan Tambahan (opsional)
                            </label>
                            <textarea name="keterangan_tambahan" id="keterangan_tambahan" rows="2"
                                class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                placeholder="Contoh: nama anggota keluarga lain yang ikut dalam surat, detail usaha, atau informasi lain yang diperlukan."></textarea>
                        </div>

                        {{-- Data Surat Pengantar RT --}}
                        <div
                            class="space-y-3 rounded-xl border border-emerald-100 bg-emerald-50/50 px-3 py-3.5 md:px-4 md:py-4">
                            <p class="text-[13px] font-semibold text-emerald-900 flex items-center gap-2">
                                <i class="fa-solid fa-note-sticky text-emerald-600"></i>
                                Data Surat Pengantar dari RT
                            </p>
                            <p class="text-[11px] md:text-xs text-neutral-600">
                                Data ini digunakan untuk kalimat
                                <span class="italic">"Berdasarkan surat pengantar Ketua RT ... No ... tertanggal
                                    ..."</span>
                                pada surat keterangan.
                            </p>

                            <div class="grid md:grid-cols-2 gap-4 mt-2">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Nomor Surat Pengantar RT <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nomor_surat_rt" id="nomor_surat_rt" required
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                        placeholder="Contoh: 016/SR/2024">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Tanggal Surat Pengantar RT <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_surat_rt" id="tanggal_surat_rt" required
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                </div>
                            </div>
                        </div>

                        {{-- Surat Pengantar RT (WAJIB) --}}
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-neutral-800">
                                Scan / Foto Surat Pengantar dari RT <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="surat_pengantar_rt" id="surat_pengantar_rt"
                                accept="image/*,application/pdf" required
                                class="block w-full text-xs text-neutral-700 file:mr-3 file:px-3 file:py-1.5 file:rounded-lg file:border-none file:bg-emerald-600 file:text-white hover:file:brightness-110 cursor-pointer">
                            <p class="text-[11px] text-neutral-500">
                                Tanpa surat pengantar dari RT, pengajuan
                                <span class="font-semibold text-red-500">tidak dapat diproses</span>.
                                Format: JPG, PNG, atau PDF. Maksimal 2MB.
                            </p>
                            <p id="error_step3" class="text-[11px] text-red-500 mt-1 hidden">
                                Harap unggah scan/foto surat pengantar dari RT sebelum melanjutkan.
                            </p>
                        </div>

                        <div class="pt-4 flex justify-between">
                            <button type="button" data-prev
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-neutral-200 text-xs md:text-sm text-neutral-700 hover:bg-neutral-50">
                                <i class="fa-solid fa-arrow-left-long"></i>
                                Kembali
                            </button>
                            <button type="button" data-next
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-400 text-white text-xs md:text-sm font-semibold shadow-md shadow-emerald-900/30 hover:brightness-110 hover:-translate-y-0.5 transition">
                                Lanjut ke Konfirmasi
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                    </div>

                    {{-- STEP 4: Konfirmasi --}}
                    <div data-step="4" class="space-y-5 hidden">
                        <h4 class="text-sm font-bold text-emerald-900 mb-2">
                            Langkah 4: Konfirmasi Pengajuan
                        </h4>
                        <p class="text-xs md:text-sm text-neutral-600 mb-3">
                            Periksa kembali data berikut. Jika sudah sesuai, klik
                            <span class="font-semibold text-emerald-700">Kirim Pengajuan</span>.
                        </p>

                        <div class="space-y-4 text-sm">
                            <div class="bg-emerald-50/70 border border-emerald-100 rounded-xl p-4">
                                <h5 class="font-semibold text-emerald-900 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-list-check text-emerald-600"></i>
                                    Jenis Surat
                                </h5>
                                <p id="confirm_jenis_surat" class="text-neutral-800 text-sm">
                                    -
                                </p>
                            </div>

                            <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-4 space-y-1.5">
                                <h5 class="font-semibold text-emerald-900 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-user text-emerald-600"></i>
                                    Data Pribadi
                                </h5>
                                <p><span class="text-neutral-500">NIK:</span> <span id="confirm_nik"
                                        class="font-medium"></span></p>
                                <p><span class="text-neutral-500">Nama:</span> <span id="confirm_nama"
                                        class="font-medium"></span></p>
                                <p><span class="text-neutral-500">Tempat/Tgl Lahir:</span>
                                    <span id="confirm_tempat_tanggal_lahir" class="font-medium"></span>
                                </p>
                                <p><span class="text-neutral-500">Jenis Kelamin:</span>
                                    <span id="confirm_jenis_kelamin" class="font-medium"></span>
                                </p>
                                <p><span class="text-neutral-500">Status Perkawinan:</span>
                                    <span id="confirm_status_perkawinan" class="font-medium"></span>
                                </p>
                                <p><span class="text-neutral-500">Bangsa/Agama:</span>
                                    <span id="confirm_bangsa_agama" class="font-medium"></span>
                                </p>
                                <p><span class="text-neutral-500">Pekerjaan:</span>
                                    <span id="confirm_pekerjaan" class="font-medium"></span>
                                </p>
                                <p><span class="text-neutral-500">Alamat:</span> <span id="confirm_alamat"
                                        class="font-medium"></span>
                                </p>
                                <p><span class="text-neutral-500">No. Telepon:</span>
                                    <span id="confirm_no_telepon" class="font-medium"></span>
                                </p>
                            </div>

                            <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-4 space-y-1.5">
                                <h5 class="font-semibold text-emerald-900 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-file-lines text-emerald-600"></i>
                                    Detail Keperluan & Dokumen
                                </h5>
                                <p class="mb-2">
                                    <span class="text-neutral-500">Keperluan / Bermaksud:</span><br>
                                    <span id="confirm_keperluan" class="font-medium"></span>
                                </p>
                                <p class="mb-2">
                                    <span class="text-neutral-500">Keterangan Tambahan:</span><br>
                                    <span id="confirm_keterangan_tambahan" class="font-medium"></span>
                                </p>
                                <p class="mb-1">
                                    <span class="text-neutral-500">Nomor Surat Pengantar RT:</span>
                                    <span id="confirm_nomor_surat_rt" class="font-medium"></span>
                                </p>
                                <p class="mb-2">
                                    <span class="text-neutral-500">Tanggal Surat Pengantar RT:</span>
                                    <span id="confirm_tanggal_surat_rt" class="font-medium"></span>
                                </p>
                                <p>
                                    <span class="text-neutral-500">File Surat Pengantar RT:</span>
                                    <span id="confirm_surat_rt" class="font-medium"></span>
                                </p>
                            </div>

                            <div class="pt-2 flex flex-col md:flex-row md:items-center gap-3 md:justify-between">
                                <div class="flex items-start gap-2.5">
                                    <input id="setuju" type="checkbox" name="setuju" required
                                        class="mt-1 w-4 h-4 rounded border-emerald-300 text-emerald-600 focus:ring-emerald-500">
                                    <label for="setuju" class="text-xs md:text-sm text-neutral-700">
                                        Saya menyatakan bahwa seluruh data di atas sudah benar dan saya telah
                                        melampirkan
                                        <span class="font-semibold text-emerald-700">surat pengantar dari RT</span>.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 flex flex-col md:flex-row md:items-center gap-3 md:justify-between">
                            <p class="text-[11px] md:text-xs text-neutral-500 flex items-center gap-1.5">
                                <i class="fa-regular fa-clock text-emerald-500"></i>
                                Pengajuan akan diproses maksimal <span class="font-semibold text-emerald-700">1x24 jam
                                    kerja</span>.
                            </p>
                            <div class="flex flex-wrap gap-3 md:justify-end">
                                <button type="button" data-prev
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-neutral-200 text-xs md:text-sm text-neutral-700 hover:bg-neutral-50">
                                    <i class="fa-solid fa-arrow-left-long"></i>
                                    Kembali Ubah Data
                                </button>
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-400 text-white text-xs md:text-sm font-semibold shadow-md shadow-emerald-900/30 hover:brightness-110 hover:-translate-y-0.5 transition">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    Kirim Pengajuan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection