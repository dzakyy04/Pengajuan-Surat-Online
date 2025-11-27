@extends('layouts.app')

@section('title', 'Dashboard Pejabat - Demo')

@section('content')
<!-- Welcome Section -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Pejabat ✍️</h1>
    <p class="text-gray-600">Kelola Penandatanganan Surat</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">1</h3>
        <p class="text-sm text-gray-600">Menunggu Tanda Tangan</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">24</h3>
        <p class="text-sm text-gray-600">Sudah Ditandatangani</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">8</h3>
        <p class="text-sm text-gray-600">Bulan Ini</p>
    </div>
</div>

<!-- Surat Menunggu TTD -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-900">Surat Menunggu Tanda Tangan</h2>
        <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">
            1 Surat
        </span>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Nomor Surat</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Pemohon</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Jenis Surat</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Diproses Oleh</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Tanggal</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-4 px-4 text-sm text-gray-900 font-medium">001/SKD/XI/2024</td>
                    <td class="py-4 px-4">
                        <div class="flex items-center space-x-3">
                            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3B82F6&color=fff" class="w-8 h-8 rounded-full" alt="">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Budi Santoso</p>
                                <p class="text-xs text-gray-500">3201234567890123</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-sm text-gray-700">Surat Keterangan Tidak Mampu</td>
                    <td class="py-4 px-4 text-sm text-gray-600">Admin System</td>
                    <td class="py-4 px-4 text-sm text-gray-600">27 Nov 2024</td>
                    <td class="py-4 px-4">
                        <a href="{{ route('demo.pejabat.detail') }}"
                           class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            Tandatangani
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Riwayat TTD Terbaru -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Riwayat Tanda Tangan Terbaru</h2>

    <div class="space-y-4">
        <div class="flex items-center justify-between p-4 bg-green-50 border border-green-100 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-green-200 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">Siti Aminah - Surat Keterangan Domisili</p>
                    <p class="text-xs text-gray-500">Ditandatangani 26 Nov 2024</p>
                </div>
            </div>
            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                Selesai
            </span>
        </div>

        <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-100 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">Ahmad Yani - Surat Keterangan Usaha</p>
                    <p class="text-xs text-gray-500">Ditandatangani 25 Nov 2024</p>
                </div>
            </div>
            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">
                Selesai
            </span>
        </div>
    </div>
</div>
@endsection
