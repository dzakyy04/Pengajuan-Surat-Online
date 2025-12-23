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
                            <select name="jenis_surat_id" id="jenis_surat" required
                                class="w-full rounded-xl border border-emerald-100 bg-emerald-50/40 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                <option value="" disabled selected>Pilih jenis surat</option>
                                @foreach ($jenisSurat as $js)
                                    <option value="{{ $js->id }}" data-kode="{{ $js->kode }}">{{ $js->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <p id="error_step1" class="text-[11px] text-red-500 mt-1 hidden">
                                Silakan pilih jenis surat terlebih dahulu.
                            </p>
                        </div>

                        {{-- Info Kontak Pemohon --}}
                        <div class="space-y-4 mt-6 p-4 bg-blue-50/50 rounded-xl border border-blue-100">
                            <p class="text-sm font-semibold text-blue-900 flex items-center gap-2">
                                <i class="fa-solid fa-envelope text-blue-600"></i>
                                Informasi Kontak untuk Notifikasi
                            </p>

                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email_pemohon" id="email_pemohon" required
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="email@example.com">
                                <p class="text-[11px] text-neutral-500">
                                    Email untuk menerima notifikasi status pengajuan surat
                                </p>
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    No. Telepon / WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="no_hp_pemohon" id="no_hp_pemohon" required
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="Contoh: 0812xxxxxxx">
                            </div>
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
                            Langkah 2: Data Pribadi <span id="label_subjek">Pemohon</span>
                        </h4>

                        <div class="space-y-4" id="data-pribadi-wrapper">
                            {{-- Nama --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama" id="nama" required
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="Nama sesuai KTP">
                            </div>

                            {{-- NIK (tidak untuk surat kematian almarhum) --}}
                            <div class="space-y-1.5" id="field_nik">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    NIK <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nik" id="nik" maxlength="16" inputmode="numeric"
                                    pattern="[0-9]{16}"
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="16 digit NIK sesuai KTP">
                            </div>

                            {{-- Tempat & Tanggal Lahir --}}
                            <div class="grid md:grid-cols-2 gap-4" id="field_ttl">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Tempat Lahir <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir"
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                        placeholder="Contoh: Sungai Rebo">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Tanggal Lahir <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                </div>
                            </div>

                            {{-- Umur (khusus surat kematian) --}}
                            <div class="space-y-1.5 hidden" id="field_umur">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Umur <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="umur" id="umur" min="0" max="150"
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="Umur dalam tahun">
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
                                <div class="space-y-1.5" id="field_status_perkawinan">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Status Perkawinan <span class="text-red-500">*</span>
                                    </label>
                                    <select name="status_perkawinan" id="status_perkawinan"
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                        <option value="" disabled selected>Pilih status perkawinan</option>
                                        <option value="Belum Kawin">Belum Kawin</option>
                                        <option value="Kawin">Kawin</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                        <option value="Cerai Mati">Cerai Mati</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Agama --}}
                            <div class="space-y-1.5" id="field_agama">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Agama <span class="text-red-500">*</span>
                                </label>
                                <select name="agama" id="agama"
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

                            {{-- Pekerjaan --}}
                            <div class="space-y-1.5" id="field_pekerjaan">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Pekerjaan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="pekerjaan" id="pekerjaan"
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="Contoh: Buruh Harian Lepas, Ibu Rumah Tangga, Pelajar, dll.">
                            </div>

                            {{-- Alamat Lengkap --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea name="alamat" id="alamat" rows="2" required
                                    class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                    placeholder="Alamat lengkap (tanpa RT/RW)"></textarea>
                            </div>

                            {{-- RT, RW, Dusun --}}
                            <div class="grid grid-cols-3 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        RT <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="rt" id="rt" required maxlength="5"
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                        placeholder="001">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        RW <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="rw" id="rw" required maxlength="5"
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                        placeholder="001">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Dusun
                                    </label>
                                    <input type="text" name="dusun" id="dusun" maxlength="50"
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                        placeholder="I, II, III, dst">
                                </div>
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

                        {{-- Dynamic Fields berdasarkan jenis surat --}}
                        <div id="dynamic-fields"></div>

                        {{-- Data Surat Pengantar RT --}}
                        <div
                            class="space-y-3 rounded-xl border border-emerald-100 bg-emerald-50/50 px-3 py-3.5 md:px-4 md:py-4">
                            <p class="text-[13px] font-semibold text-emerald-900 flex items-center gap-2">
                                <i class="fa-solid fa-note-sticky text-emerald-600"></i>
                                Data Surat Pengantar dari RT
                            </p>

                            <div class="grid md:grid-cols-2 gap-4 mt-2">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Nomor Surat RT <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="no_surat_rt" id="no_surat_rt" required
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                                        placeholder="Contoh: 016/SR/2024">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-neutral-800">
                                        Tanggal Surat RT <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal_surat_rt" id="tanggal_surat_rt" required
                                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                                </div>
                            </div>
                        </div>

                        {{-- Upload Dokumen --}}
                        <div class="space-y-4">
                            <p class="text-sm font-semibold text-emerald-900 flex items-center gap-2">
                                <i class="fa-solid fa-file-arrow-up text-emerald-600"></i>
                                Upload Dokumen Pendukung
                            </p>

                            {{-- KTP --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Foto/Scan KTP <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="dokumen_ktp" id="dokumen_ktp"
                                    accept="image/*,application/pdf" required
                                    class="block w-full text-xs text-neutral-700 file:mr-3 file:px-3 file:py-1.5 file:rounded-lg file:border-none file:bg-emerald-600 file:text-white hover:file:brightness-110 cursor-pointer">
                                <p class="text-[11px] text-neutral-500">Format: JPG, PNG, atau PDF. Maksimal 2MB.</p>
                            </div>

                            {{-- KK --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Foto/Scan Kartu Keluarga (KK) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="dokumen_kk" id="dokumen_kk" accept="image/*,application/pdf"
                                    required
                                    class="block w-full text-xs text-neutral-700 file:mr-3 file:px-3 file:py-1.5 file:rounded-lg file:border-none file:bg-emerald-600 file:text-white hover:file:brightness-110 cursor-pointer">
                                <p class="text-[11px] text-neutral-500">Format: JPG, PNG, atau PDF. Maksimal 2MB.</p>
                            </div>

                            {{-- Surat RT --}}
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-neutral-800">
                                    Foto/Scan Surat Pengantar RT <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="dokumen_surat_rt" id="dokumen_surat_rt"
                                    accept="image/*,application/pdf" required
                                    class="block w-full text-xs text-neutral-700 file:mr-3 file:px-3 file:py-1.5 file:rounded-lg file:border-none file:bg-emerald-600 file:text-white hover:file:brightness-110 cursor-pointer">
                                <p class="text-[11px] text-neutral-500">
                                    Tanpa surat pengantar dari RT, pengajuan <span class="font-semibold text-red-500">tidak
                                        dapat diproses</span>.
                                </p>
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
                            Periksa kembali data berikut. Jika sudah sesuai, klik <span
                                class="font-semibold text-emerald-700">Kirim Pengajuan</span>.
                        </p>

                        <div id="confirmation-summary" class="space-y-4 text-sm">
                            <!-- Summary akan diisi via JavaScript -->
                        </div>

                        <div class="pt-2 flex items-start gap-2.5">
                            <input id="setuju" type="checkbox" name="setuju" required
                                class="mt-1 w-4 h-4 rounded border-emerald-300 text-emerald-600 focus:ring-emerald-500">
                            <label for="setuju" class="text-xs md:text-sm text-neutral-700">
                                Saya menyatakan bahwa seluruh data di atas sudah benar dan saya bersedia bertanggung jawab
                                atas kebenaran data tersebut.
                            </label>
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

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 4;
    let anggotaKeluargaCounter = 0;

    // Field templates untuk setiap jenis surat
    const suratFields = {
        'SKTM': {
            fields: `
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Keperluan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="keperluan" rows="3" required
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Contoh: Untuk pelengkap administrasi membuat KIS"></textarea>
                    <p class="text-[11px] text-neutral-500">Jelaskan untuk keperluan apa surat keterangan tidak mampu ini dibutuhkan</p>
                </div>

                <div class="space-y-3 rounded-xl border border-blue-100 bg-blue-50/50 px-3 py-3.5 md:px-4 md:py-4">
                    <div class="flex items-center justify-between">
                        <p class="text-[13px] font-semibold text-blue-900 flex items-center gap-2">
                            <i class="fa-solid fa-users text-blue-600"></i>
                            Anggota Keluarga yang Ikut dalam Surat
                        </p>
                        <button type="button" id="btnTambahAnggota"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition">
                            <i class="fa-solid fa-plus"></i>
                            Tambah
                        </button>
                    </div>
                    <p class="text-[11px] text-blue-700">
                        Opsional. Tambahkan anggota keluarga lain yang akan dicantumkan dalam surat. Kosongkan jika hanya pemohon saja.
                    </p>

                    <div id="containerAnggotaKeluarga" class="space-y-3 mt-3">
                        <!-- Anggota keluarga akan ditambahkan di sini -->
                    </div>
                </div>
            `,
            pribadiConfig: {
                showNIK: true,
                showTTL: true,
                showUmur: false,
                showStatusPerkawinan: true,
                showAgama: true,
                showPekerjaan: true
            }
        },
        'SKD': {
            fields: `
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Keperluan
                    </label>
                    <textarea name="keperluan" rows="3"
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Contoh: Untuk keperluan pendaftaran sekolah"></textarea>
                    <p class="text-[11px] text-neutral-500">Opsional. Jelaskan untuk keperluan apa surat domisili ini</p>
                </div>
            `,
            pribadiConfig: {
                showNIK: true,
                showTTL: true,
                showUmur: false,
                showStatusPerkawinan: true,
                showAgama: true,
                showPekerjaan: true
            }
        },
        'SKU': {
            fields: `
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Nama Usaha <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_usaha" required
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Contoh: Warung Sembako Berkah">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Jenis Usaha <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jenis_usaha" required
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Contoh: Perdagangan Sembako">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Alamat Usaha <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alamat_usaha" rows="2" required
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Alamat lengkap lokasi usaha"></textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Keterangan Usaha
                    </label>
                    <textarea name="keterangan_usaha" rows="2"
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Informasi tambahan tentang usaha (opsional)"></textarea>
                </div>
            `,
            pribadiConfig: {
                showNIK: true,
                showTTL: true,
                showUmur: false,
                showStatusPerkawinan: true,
                showAgama: true,
                showPekerjaan: true
            }
        },
        'SKP': {
            fields: `
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Penghasilan per Bulan <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="penghasilan_perbulan" required min="0" step="1000"
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Contoh: 1500000">
                    <p class="text-[11px] text-neutral-500">Masukkan dalam angka (Rupiah)</p>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Nama Anak (jika untuk keperluan anak)
                    </label>
                    <input type="text" name="nama_anak"
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Contoh: Ibrahim Pako">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Keterangan Tambahan
                    </label>
                    <textarea name="keterangan_tambahan" rows="2"
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Contoh: Orang tua dari..."></textarea>
                </div>
            `,
            pribadiConfig: {
                showNIK: true,
                showTTL: true,
                showUmur: false,
                showStatusPerkawinan: true,
                showAgama: true,
                showPekerjaan: true
            }
        },
        'SKMT': {
            fields: `
                <h5 class="text-sm font-semibold text-emerald-900 mt-6 mb-3">Data Kematian</h5>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            Hari Meninggal <span class="text-red-500">*</span>
                        </label>
                        <select name="hari_meninggal" required
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                            <option value="">Pilih hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            Tanggal Meninggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_meninggal" required
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            Jam Meninggal <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="jam_meninggal" required
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            Tempat Meninggal <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="tempat_meninggal" required
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                            placeholder="Contoh: Rumah / RS">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Sebab Meninggal <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sebab_meninggal" required
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Contoh: Sakit">
                </div>

                <h5 class="text-sm font-semibold text-emerald-900 mt-6 mb-3">Data Pelapor</h5>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Nama Pelapor <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_pelapor" required
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        NIK Pelapor <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nik_pelapor" required maxlength="16"
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            Jenis Kelamin Pelapor <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_kelamin_pelapor" required
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                            <option value="">Pilih</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            Tempat Lahir Pelapor <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="tempat_lahir_pelapor" required
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            Tanggal Lahir Pelapor <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_lahir_pelapor" required
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            Agama Pelapor <span class="text-red-500">*</span>
                        </label>
                        <select name="agama_pelapor" required
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                            <option value="">Pilih agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Pekerjaan Pelapor <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pekerjaan_pelapor" required
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-neutral-800">
                        Alamat Pelapor <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alamat_pelapor" rows="2" required
                        class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"></textarea>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            RT Pelapor <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="rt_pelapor" required maxlength="5"
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            RW Pelapor <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="rw_pelapor" required maxlength="5"
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-neutral-800">
                            Hubungan Pelapor <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="hubungan_pelapor" required
                            class="w-full rounded-xl border border-emerald-100 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                            placeholder="Istri/Suami/Anak">
                    </div>
                </div>
            `,
            pribadiConfig: {
                showNIK: false,
                showTTL: false,
                showUmur: true,
                showStatusPerkawinan: false,
                showAgama: false,
                showPekerjaan: false
            }
        }
    };

    // Fungsi untuk menambah form anggota keluarga
    function tambahAnggotaKeluarga() {
        anggotaKeluargaCounter++;
        const container = document.getElementById('containerAnggotaKeluarga');
        
        if (!container) return;
        
        const div = document.createElement('div');
        div.className = 'anggota-item bg-white border border-blue-200 rounded-lg p-3';
        div.setAttribute('data-anggota-id', anggotaKeluargaCounter);
        
        div.innerHTML = `
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-semibold text-blue-800">Anggota #${anggotaKeluargaCounter}</span>
                <button type="button" class="btnHapusAnggota text-red-500 hover:text-red-700 text-xs" data-id="${anggotaKeluargaCounter}">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </div>
            <div class="grid md:grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-neutral-800">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="anggota_nama[]" required
                        class="w-full rounded-lg border border-emerald-100 px-2.5 py-2 text-xs focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="Nama sesuai KTP">
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-neutral-800">
                        NIK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="anggota_nik[]" required maxlength="16" inputmode="numeric" pattern="[0-9]{16}"
                        class="w-full rounded-lg border border-emerald-100 px-2.5 py-2 text-xs focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                        placeholder="16 digit NIK">
                </div>
            </div>
        `;
        
        container.appendChild(div);
        
        // Event listener untuk tombol hapus
        div.querySelector('.btnHapusAnggota').addEventListener('click', function() {
            div.remove();
            updateNomorAnggota();
        });
    }

    // Fungsi untuk update nomor urut anggota setelah ada yang dihapus
    function updateNomorAnggota() {
        const items = document.querySelectorAll('.anggota-item');
        items.forEach((item, index) => {
            const span = item.querySelector('span');
            if (span) {
                span.textContent = `Anggota #${index + 1}`;
            }
        });
    }

    // Event listener untuk tombol tambah anggota (menggunakan event delegation)
    document.addEventListener('click', function(e) {
        const target = e.target;
        // Check if clicked element or its parent is the button
        if (target.id === 'btnTambahAnggota' || target.closest('#btnTambahAnggota')) {
            e.preventDefault();
            e.stopPropagation();
            
            // Pastikan container sudah ada
            const container = document.getElementById('containerAnggotaKeluarga');
            if (container) {
                tambahAnggotaKeluarga();
            }
        }
    });

    // Handle jenis surat change
    document.getElementById('jenis_surat').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const kode = selectedOption.getAttribute('data-kode');

        // Update label di step 2
        if (kode === 'SKMT') {
            document.getElementById('label_subjek').textContent = 'Almarhum/Almarhumah';
            document.getElementById('nama').placeholder = 'Nama almarhum/almarhumah';
        } else {
            document.getElementById('label_subjek').textContent = 'Pemohon';
            document.getElementById('nama').placeholder = 'Nama sesuai KTP';
        }
    });

    // Navigation functions
    function showStep(step) {
        document.querySelectorAll('[data-step]').forEach(el => el.classList.add('hidden'));
        const stepEl = document.querySelector(`[data-step="${step}"]`);
        if (stepEl) {
            stepEl.classList.remove('hidden');
        }

        document.querySelectorAll('[data-step-indicator]').forEach(el => {
            const indicatorStep = parseInt(el.getAttribute('data-step-indicator'));
            const circleEl = el.querySelector('div');
            
            if (indicatorStep === step) {
                el.classList.remove('opacity-60');
                circleEl.classList.add('bg-emerald-600', 'text-white');
                circleEl.classList.remove('bg-white', 'text-emerald-700', 'bg-emerald-100');
            } else if (indicatorStep < step) {
                el.classList.remove('opacity-60');
                circleEl.classList.add('bg-emerald-100', 'text-emerald-700');
                circleEl.classList.remove('bg-emerald-600', 'text-white', 'bg-white');
            } else {
                el.classList.add('opacity-60');
                circleEl.classList.add('bg-white', 'text-emerald-700');
                circleEl.classList.remove('bg-emerald-600', 'text-white', 'bg-emerald-100');
            }
        });

        currentStep = step;
    }

    // Next button handlers
    document.querySelectorAll('[data-next]').forEach(btn => {
        btn.addEventListener('click', function() {
            if (currentStep === 1) {
                const jenisSurat = document.getElementById('jenis_surat').value;
                const errorStep1 = document.getElementById('error_step1');
                
                if (!jenisSurat) {
                    if (errorStep1) {
                        errorStep1.classList.remove('hidden');
                    }
                    return;
                }
                if (errorStep1) {
                    errorStep1.classList.add('hidden');
                }

                // Load dynamic fields for step 2
                const selectedOption = document.getElementById('jenis_surat').options[
                    document.getElementById('jenis_surat').selectedIndex];
                const kode = selectedOption.getAttribute('data-kode');
                const config = suratFields[kode];

                if (config) {
                    // Configure step 2 fields
                    const fieldNik = document.getElementById('field_nik');
                    const fieldTtl = document.getElementById('field_ttl');
                    const fieldUmur = document.getElementById('field_umur');
                    const fieldStatusPerkawinan = document.getElementById('field_status_perkawinan');
                    const fieldAgama = document.getElementById('field_agama');
                    const fieldPekerjaan = document.getElementById('field_pekerjaan');

                    if (fieldNik) fieldNik.style.display = config.pribadiConfig.showNIK ? 'block' : 'none';
                    if (fieldTtl) fieldTtl.style.display = config.pribadiConfig.showTTL ? 'block' : 'none';
                    if (fieldUmur) fieldUmur.style.display = config.pribadiConfig.showUmur ? 'block' : 'none';
                    if (fieldStatusPerkawinan) fieldStatusPerkawinan.style.display = config.pribadiConfig.showStatusPerkawinan ? 'block' : 'none';
                    if (fieldAgama) fieldAgama.style.display = config.pribadiConfig.showAgama ? 'block' : 'none';
                    if (fieldPekerjaan) fieldPekerjaan.style.display = config.pribadiConfig.showPekerjaan ? 'block' : 'none';

                    // Set required attributes
                    document.getElementById('nik').required = config.pribadiConfig.showNIK;
                    document.getElementById('tempat_lahir').required = config.pribadiConfig.showTTL;
                    document.getElementById('tanggal_lahir').required = config.pribadiConfig.showTTL;
                    const umurField = document.getElementById('umur');
                    if (umurField) umurField.required = config.pribadiConfig.showUmur;
                    document.getElementById('status_perkawinan').required = config.pribadiConfig.showStatusPerkawinan;
                    document.getElementById('agama').required = config.pribadiConfig.showAgama;
                    document.getElementById('pekerjaan').required = config.pribadiConfig.showPekerjaan;
                }
            }

            if (currentStep === 2) {
                // Load dynamic fields for step 3
                const selectedOption = document.getElementById('jenis_surat').options[
                    document.getElementById('jenis_surat').selectedIndex];
                const kode = selectedOption.getAttribute('data-kode');
                const config = suratFields[kode];

                if (config) {
                    const dynamicFields = document.getElementById('dynamic-fields');
                    if (dynamicFields) {
                        dynamicFields.innerHTML = config.fields;
                    }
                }
            }

            if (currentStep === 3) {
                // Build confirmation summary
                buildConfirmationSummary();
            }

            if (currentStep < totalSteps) {
                showStep(currentStep + 1);
            }
        });
    });

    // Previous button handlers
    document.querySelectorAll('[data-prev]').forEach(btn => {
        btn.addEventListener('click', function() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });
    });

    function buildConfirmationSummary() {
        const formData = new FormData(document.getElementById('formPengajuan'));
        const jenisSuratText = document.getElementById('jenis_surat').options[document.getElementById('jenis_surat').selectedIndex].text;

        let html = `
            <div class="bg-emerald-50/70 border border-emerald-100 rounded-xl p-4">
                <h5 class="font-semibold text-emerald-900 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-emerald-600"></i>
                    Jenis Surat
                </h5>
                <p class="text-neutral-800 text-sm">${jenisSuratText}</p>
            </div>
            
            <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-4 space-y-1.5">
                <h5 class="font-semibold text-emerald-900 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-user text-emerald-600"></i>
                    Data Kontak
                </h5>
                <p><span class="text-neutral-500">Email:</span> <span class="font-medium">${formData.get('email_pemohon') || '-'}</span></p>
                <p><span class="text-neutral-500">No. Telepon:</span> <span class="font-medium">${formData.get('no_hp_pemohon') || '-'}</span></p>
            </div>
            
            <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-4 space-y-1.5">
                <h5 class="font-semibold text-emerald-900 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-id-card text-emerald-600"></i>
                    Data Pribadi
                </h5>
                <p><span class="text-neutral-500">Nama:</span> <span class="font-medium">${formData.get('nama') || '-'}</span></p>
        `;

        if (formData.get('nik')) {
            html += `<p><span class="text-neutral-500">NIK:</span> <span class="font-medium">${formData.get('nik')}</span></p>`;
        }
        if (formData.get('tempat_lahir')) {
            html += `<p><span class="text-neutral-500">Tempat/Tgl Lahir:</span> <span class="font-medium">${formData.get('tempat_lahir')}, ${formData.get('tanggal_lahir')}</span></p>`;
        }
        if (formData.get('umur')) {
            html += `<p><span class="text-neutral-500">Umur:</span> <span class="font-medium">${formData.get('umur')} tahun</span></p>`;
        }

        html += `<p><span class="text-neutral-500">Jenis Kelamin:</span> <span class="font-medium">${formData.get('jenis_kelamin') || '-'}</span></p>`;

        if (formData.get('status_perkawinan')) {
            html += `<p><span class="text-neutral-500">Status Perkawinan:</span> <span class="font-medium">${formData.get('status_perkawinan')}</span></p>`;
        }
        if (formData.get('agama')) {
            html += `<p><span class="text-neutral-500">Agama:</span> <span class="font-medium">${formData.get('agama')}</span></p>`;
        }
        if (formData.get('pekerjaan')) {
            html += `<p><span class="text-neutral-500">Pekerjaan:</span> <span class="font-medium">${formData.get('pekerjaan')}</span></p>`;
        }

        html += `
                <p><span class="text-neutral-500">Alamat:</span> <span class="font-medium">${formData.get('alamat') || '-'}</span></p>
                <p><span class="text-neutral-500">RT/RW:</span> <span class="font-medium">${formData.get('rt')}/${formData.get('rw')}</span></p>
        `;

        if (formData.get('dusun')) {
            html += `<p><span class="text-neutral-500">Dusun:</span> <span class="font-medium">${formData.get('dusun')}</span></p>`;
        }

        html += `</div>`;

        // Dynamic fields based on jenis surat
        const selectedOption = document.getElementById('jenis_surat').options[document.getElementById('jenis_surat').selectedIndex];
        const kode = selectedOption.getAttribute('data-kode');

        html += `<div class="bg-neutral-50 border border-neutral-200 rounded-xl p-4 space-y-1.5">
            <h5 class="font-semibold text-emerald-900 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-file-lines text-emerald-600"></i>
                Detail Keperluan
            </h5>`;

        if (kode === 'SKTM') {
            html += `<p><span class="text-neutral-500">Keperluan:</span> <span class="font-medium">${formData.get('keperluan') || '-'}</span></p>`;
            
            // Tampilkan anggota keluarga jika ada
            const anggotaNama = formData.getAll('anggota_nama[]');
            const anggotaNIK = formData.getAll('anggota_nik[]');
            
            if (anggotaNama.length > 0 && anggotaNama[0] !== '') {
                html += `
                    <div class="mt-2 pt-2 border-t border-neutral-200">
                        <p class="font-semibold text-emerald-800 mb-2">Anggota Keluarga:</p>
                        <div class="space-y-1 pl-4">
                `;
                
                anggotaNama.forEach((nama, index) => {
                    if (nama && anggotaNIK[index]) {
                        html += `
                            <p class="text-sm">
                                <i class="fa-solid fa-user text-emerald-600 mr-1"></i>
                                <span class="font-medium">${nama}</span> 
                                <span class="text-neutral-500 text-xs">(NIK: ${anggotaNIK[index]})</span>
                            </p>
                        `;
                    }
                });
                
                html += `
                        </div>
                    </div>
                `;
            }
        } else if (kode === 'SKD') {
            if (formData.get('keperluan')) {
                html += `<p><span class="text-neutral-500">Keperluan:</span> <span class="font-medium">${formData.get('keperluan')}</span></p>`;
            }
        } else if (kode === 'SKU') {
            html += `
                <p><span class="text-neutral-500">Nama Usaha:</span> <span class="font-medium">${formData.get('nama_usaha') || '-'}</span></p>
                <p><span class="text-neutral-500">Jenis Usaha:</span> <span class="font-medium">${formData.get('jenis_usaha') || '-'}</span></p>
                <p><span class="text-neutral-500">Alamat Usaha:</span> <span class="font-medium">${formData.get('alamat_usaha') || '-'}</span></p>
            `;
            if (formData.get('keterangan_usaha')) {
                html += `<p><span class="text-neutral-500">Keterangan:</span> <span class="font-medium">${formData.get('keterangan_usaha')}</span></p>`;
            }
        } else if (kode === 'SKP') {
            html += `<p><span class="text-neutral-500">Penghasilan per Bulan:</span> <span class="font-medium">Rp ${parseInt(formData.get('penghasilan_perbulan') || 0).toLocaleString('id-ID')}</span></p>`;
            if (formData.get('nama_anak')) {
                html += `<p><span class="text-neutral-500">Nama Anak:</span> <span class="font-medium">${formData.get('nama_anak')}</span></p>`;
            }
            if (formData.get('keterangan_tambahan')) {
                html += `<p><span class="text-neutral-500">Keterangan:</span> <span class="font-medium">${formData.get('keterangan_tambahan')}</span></p>`;
            }
        } else if (kode === 'SKMT') {
            html += `
                <p><span class="text-neutral-500">Tanggal Meninggal:</span> <span class="font-medium">${formData.get('hari_meninggal')}, ${formData.get('tanggal_meninggal')}</span></p>
                <p><span class="text-neutral-500">Jam:</span> <span class="font-medium">${formData.get('jam_meninggal')}</span></p>
                <p><span class="text-neutral-500">Tempat:</span> <span class="font-medium">${formData.get('tempat_meninggal') || '-'}</span></p>
                <p><span class="text-neutral-500">Sebab:</span> <span class="font-medium">${formData.get('sebab_meninggal') || '-'}</span></p>
                <hr class="my-2">
                <p class="font-semibold text-emerald-800 mt-3 mb-1">Data Pelapor</p>
                <p><span class="text-neutral-500">Nama:</span> <span class="font-medium">${formData.get('nama_pelapor') || '-'}</span></p>
                <p><span class="text-neutral-500">NIK:</span> <span class="font-medium">${formData.get('nik_pelapor') || '-'}</span></p>
                <p><span class="text-neutral-500">Hubungan:</span> <span class="font-medium">${formData.get('hubungan_pelapor') || '-'}</span></p>
            `;
        }

        html += `</div>`;

        // Surat RT info
        html += `
            <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-4 space-y-1.5">
                <h5 class="font-semibold text-emerald-900 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-note-sticky text-emerald-600"></i>
                    Surat Pengantar RT
                </h5>
                <p><span class="text-neutral-500">Nomor Surat:</span> <span class="font-medium">${formData.get('no_surat_rt') || '-'}</span></p>
                <p><span class="text-neutral-500">Tanggal:</span> <span class="font-medium">${formData.get('tanggal_surat_rt') || '-'}</span></p>
            </div>
        `;

        // Documents uploaded
        html += `
            <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-4 space-y-1.5">
                <h5 class="font-semibold text-emerald-900 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-paperclip text-emerald-600"></i>
                    Dokumen yang Diupload
                </h5>
        `;

        const dokKtp = document.getElementById('dokumen_ktp').files[0];
        const dokKk = document.getElementById('dokumen_kk').files[0];
        const dokSuratRt = document.getElementById('dokumen_surat_rt').files[0];

        if (dokKtp) {
            html += `<p><i class="fa-solid fa-check text-emerald-600 mr-2"></i><span class="text-neutral-700">KTP: ${dokKtp.name} (${(dokKtp.size/1024).toFixed(1)} KB)</span></p>`;
        }
        if (dokKk) {
            html += `<p><i class="fa-solid fa-check text-emerald-600 mr-2"></i><span class="text-neutral-700">KK: ${dokKk.name} (${(dokKk.size/1024).toFixed(1)} KB)</span></p>`;
        }
        if (dokSuratRt) {
            html += `<p><i class="fa-solid fa-check text-emerald-600 mr-2"></i><span class="text-neutral-700">Surat RT: ${dokSuratRt.name} (${(dokSuratRt.size/1024).toFixed(1)} KB)</span></p>`;
        }

        html += `</div>`;

        const confirmationEl = document.getElementById('confirmation-summary');
        if (confirmationEl) {
            confirmationEl.innerHTML = html;
        }
    }

    // Initialize
    showStep(1);
});
        </script>
    @endpush
@endsection
