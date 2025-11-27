@extends('layouts.app')

@section('title', 'Admin Dashboard - Demo')

@section('content')
<!-- Welcome Section -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard 👨‍💼</h1>
    <p class="text-gray-600">Kelola Pengajuan Surat Warga</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">3</h3>
        <p class="text-sm text-gray-600">Menunggu Review</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">12</h3>
        <p class="text-sm text-gray-600">Disetujui</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">5</h3>
        <p class="text-sm text-gray-600">Menunggu TTD</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">45</h3>
        <p class="text-sm text-gray-600">Selesai</p>
    </div>
</div>

<!-- Pengajuan List -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-900">Daftar Pengajuan Surat</h2>
        <div class="flex space-x-2">
            <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                <option>Semua Status</option>
                <option>Pending</option>
                <option>Disetujui</option>
                <option>Ditolak</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">ID</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Pemohon</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Jenis Surat</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Keperluan</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Tanggal</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Status</th>
                    <th class="text-left py-4 px-4 text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 - DEMO ITEM -->
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-4 px-4 text-sm text-gray-900">#001</td>
                    <td class="py-4 px-4">
                        <div class="flex items-center space-x-3">
                            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3B82F6&color=fff" class="w-8 h-8 rounded-full" alt="">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Budi Santoso</p>
                                <p class="text-xs text-gray-500">budi@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-sm text-gray-700">Surat Keterangan Tidak Mampu</td>
                    <td class="py-4 px-4 text-sm text-gray-600">Bantuan Pendidikan Anak</td>
                    <td class="py-4 px-4 text-sm text-gray-600">27 Nov 2024</td>
                    <td class="py-4 px-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    </td>
                    <td class="py-4 px-4">
                        <a href="{{ route('demo.admin.detail') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Review
                        </a>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-4 px-4 text-sm text-gray-900">#002</td>
                    <td class="py-4 px-4">
                        <div class="flex items-center space-x-3">
                            <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=8B5CF6&color=fff" class="w-8 h-8 rounded-full" alt="">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Siti Aminah</p>
                                <p class="text-xs text-gray-500">siti@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-sm text-gray-700">Surat Keterangan Domisili</td>
                    <td class="py-4 px-4 text-sm text-gray-600">Pengurusan KTP</td>
                    <td class="py-4 px-4 text-sm text-gray-600">26 Nov 2024</td>
                    <td class="py-4 px-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                            Disetujui
                        </span>
                    </td>
                    <td class="py-4 px-4">
                        <button class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                            Lihat
                        </button>
                    </td>
                </tr>

                <!-- Row 3 -->
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-4 px-4 text-sm text-gray-900">#003</td>
                    <td class="py-4 px-4">
                        <div class="flex items-center space-x-3">
                            <img src="https://ui-avatars.com/api/?name=Ahmad+Yani&background=10B981&color=fff" class="w-8 h-8 rounded-full" alt="">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Ahmad Yani</p>
                                <p class="text-xs text-gray-500">ahmad@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-sm text-gray-700">Surat Keterangan Usaha</td>
                    <td class="py-4 px-4 text-sm text-gray-600">Pengajuan Modal Usaha</td>
                    <td class="py-4 px-4 text-sm text-gray-600">25 Nov 2024</td>
                    <td class="py-4 px-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    </td>
                    <td class="py-4 px-4">
                        <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Review
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
