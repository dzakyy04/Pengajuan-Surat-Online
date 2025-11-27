@extends('layouts.app')

@section('title', 'Surat Berhasil Ditandatangani')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 text-center">
            <!-- Success Icon with Animation -->
            <div class="mx-auto w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mb-6 animate-bounce">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Title -->
            <h1 class="text-3xl font-bold text-gray-900 mb-3">
                Surat Berhasil Ditandatangani! ✅
            </h1>

            <p class="text-gray-600 mb-6">
                Tanda tangan digital Anda telah berhasil ditambahkan ke dokumen. Surat sekarang lengkap dan siap dikirim ke pemohon.
            </p>

            <!-- Success Info -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-6 mb-6">
                <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                    <div class="text-left">
                        <p class="text-gray-500 mb-1">Nomor Surat</p>
                        <p class="font-bold text-gray-900">001/SKD/XI/2024</p>
                    </div>
                    <div class="text-left">
                        <p class="text-gray-500 mb-1">Pemohon</p>
                        <p class="font-bold text-gray-900">Budi Santoso</p>
                    </div>
                    <div class="text-left">
                        <p class="text-gray-500 mb-1">Ditandatangani Oleh</p>
                        <p class="font-bold text-gray-900">H. Ahmad Sudrajat, S.Sos</p>
                    </div>
                    <div class="text-left">
                        <p class="text-gray-500 mb-1">Tanggal</p>
                        <p class="font-bold text-gray-900">{{ now()->translatedFormat('d F Y') }}</p>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="flex items-center justify-center space-x-2">
                    <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-bold">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Status: Selesai
                    </span>
                </div>
            </div>

            <!-- What Happens Next -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6 text-left">
                <h3 class="font-bold text-blue-900 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    Yang Terjadi Selanjutnya:
                </h3>
                <ul class="text-sm text-blue-800 space-y-2">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Email notifikasi otomatis dikirim ke pemohon</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Pemohon dapat langsung download surat</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Riwayat tersimpan di sistem</span>
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center mb-4">
                @if($latestFile)
                <a href="{{ route('demo.admin.download', $latestFile) }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition font-semibold shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download Surat Final
                </a>
                @endif

                <a href="{{ route('demo.pejabat.dashboard') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">atau lihat</span>
                </div>
            </div>

            <!-- Additional Links -->
            <div class="flex justify-center space-x-4 text-sm">
                <a href="{{ route('demo.admin.dashboard') }}" class="text-gray-600 hover:text-gray-900 transition">
                    Admin Dashboard
                </a>
                <span class="text-gray-300">•</span>
                <button onclick="alert('Tampilkan riwayat lengkap')" class="text-gray-600 hover:text-gray-900 transition">
                    Riwayat TTD
                </button>
            </div>
        </div>

        <!-- Demo Note -->
        <div class="mt-6 bg-gradient-to-r from-purple-50 to-pink-50 border-l-4 border-purple-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-purple-700">
                        <strong>Demo Mode:</strong> Ini adalah versi demo untuk presentasi.
                        Di versi production, sistem akan terintegrasi dengan database, email otomatis,
                        dan fitur manajemen user lengkap.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.animate-bounce {
    animation: bounce 1s ease-in-out 3;
}
</style>
@endsection
