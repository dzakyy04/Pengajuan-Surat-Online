@extends('admin.layout.app')

@section('title', 'Surat Berhasil Dibuat')

@section('content')
    <div class="container mx-auto p-4">
        <div class="max-w-full mx-auto">

            <!-- Success Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-in">

                <!-- Header -->
                <div class="px-8 py-6 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white text-center">
                    <div class="mx-auto mb-4 w-16 h-16 flex items-center justify-center rounded-full bg-white/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <h1 class="text-2xl md:text-3xl font-extrabold">
                        Surat Berhasil Dibuat
                    </h1>
                    <p class="text-sm text-emerald-100 mt-2">
                        Dokumen SKD telah berhasil di-generate oleh sistem
                    </p>
                </div>

                <!-- Body -->
                <div class="px-8 py-8">

                    <!-- Info File -->
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>

                            <div class="flex-1">
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">
                                    Nama File Surat
                                </p>
                                <p class="text-gray-900 font-semibold break-all mt-1">
                                    {{ $file }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10">
                        <a href="{{ route('admin.skd.download', $file) }}"
                            class="group inline-flex items-center justify-center px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-700 text-white font-bold shadow-lg hover:shadow-xl transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download Surat
                        </a>

                        <a href="{{ route('admin.skd.index') }}"
                            class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Kembali ke Daftar Pengajuan
                        </a>
                    </div>

                    <!-- Next Steps -->
                    <div class="pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">
                            Langkah Selanjutnya
                        </h3>

                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="flex items-start gap-3">
                                <span
                                    class="w-6 h-6 flex items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                    ✓
                                </span>
                                Surat telah berhasil dibuat dan tersimpan di sistem
                            </li>

                            <li class="flex items-start gap-3">
                                <span
                                    class="w-6 h-6 flex items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                    i
                                </span>
                                Surat akan dilanjutkan ke proses penandatanganan Kepala Desa
                            </li>

                            {{-- <li class="flex items-start gap-3">
                                <span
                                    class="w-6 h-6 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600">
                                    !
                                </span>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis labore accusantium accusamus!
                            </li> --}}
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
