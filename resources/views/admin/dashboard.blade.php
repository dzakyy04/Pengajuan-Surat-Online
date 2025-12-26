@extends('admin.layout.app')

@section('title', 'Dashboard Pengajuan Surat')

@section('content')

<!-- Header -->
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">
        Dashboard Pengajuan Surat
    </h1>
    <p class="text-gray-600">
        Ringkasan aktivitas dan status pengajuan surat masyarakat hari ini.
    </p>
</div>

<!-- Statistik Utama -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <!-- Pengajuan Masuk -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900">128</h3>
        <p class="text-sm text-gray-600 mb-3">Total Pengajuan Masuk</p>
        <span class="text-xs text-gray-500">
            Data kumulatif bulan ini
        </span>
    </div>

    <!-- Diproses -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900">34</h3>
        <p class="text-sm text-gray-600 mb-3">Sedang Diproses</p>
        <span class="text-xs text-gray-500">
            Menunggu verifikasi & persetujuan
        </span>
    </div>

    <!-- Disetujui -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900">82</h3>
        <p class="text-sm text-gray-600 mb-3">Pengajuan Disetujui</p>
        <span class="text-xs text-gray-500">
            Surat berhasil diterbitkan
        </span>
    </div>

</div>

<!-- Section Bawah -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Pengajuan Terbaru -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900">
                Pengajuan Terbaru
            </h2>
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-xl transition">
                <div>
                    <p class="text-sm font-semibold text-gray-900">
                        Surat Keterangan Tidak Mampu
                    </p>
                    <p class="text-xs text-gray-500">
                        A.n. Ahmad Fauzi • 12 Jan 2025
                    </p>
                </div>
                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                    Diproses
                </span>
            </div>

            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-xl transition">
                <div>
                    <p class="text-sm font-semibold text-gray-900">
                        Surat Keterangan Domisili
                    </p>
                    <p class="text-xs text-gray-500">
                        A.n. Siti Aminah • 11 Jan 2025
                    </p>
                </div>
                <span class="px-3 py-1 text-xs rounded-full bg-emerald-100 text-emerald-700 font-semibold">
                    Disetujui
                </span>
            </div>

            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-xl transition">
                <div>
                    <p class="text-sm font-semibold text-gray-900">
                        Surat Keterangan Usaha
                    </p>
                    <p class="text-xs text-gray-500">
                        A.n. Budi Santoso • 10 Jan 2025
                    </p>
                </div>
                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 font-semibold">
                    Ditolak
                </span>
            </div>
        </div>
    </div>

    <!-- Progres Layanan Surat -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-6">
            Progres Layanan Surat
        </h2>

        <div class="space-y-4 text-sm">
            <div>
                <div class="flex justify-between mb-1">
                    <span>Surat Keterangan Tidak Mampu</span>
                    <span class="font-semibold">75%</span>
                </div>
                <div class="h-2 bg-gray-100 rounded-full">
                    <div class="h-full bg-emerald-500 rounded-full" style="width: 75%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-1">
                    <span>Surat Domisili</span>
                    <span class="font-semibold">60%</span>
                </div>
                <div class="h-2 bg-gray-100 rounded-full">
                    <div class="h-full bg-blue-500 rounded-full" style="width: 60%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-1">
                    <span>Surat Keterangan Usaha</span>
                    <span class="font-semibold">40%</span>
                </div>
                <div class="h-2 bg-gray-100 rounded-full">
                    <div class="h-full bg-yellow-500 rounded-full" style="width: 40%"></div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
