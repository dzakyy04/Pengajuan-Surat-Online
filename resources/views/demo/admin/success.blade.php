@extends('layouts.app')

@section('title', 'Surat Berhasil Dibuat')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 text-center">
            <!-- Success Icon -->
            <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <!-- Title -->
            <h1 class="text-3xl font-bold text-gray-900 mb-3">
                Surat Berhasil Dibuat! 🎉
            </h1>

            <p class="text-gray-600 mb-6">
                Surat Keterangan Tidak Mampu telah berhasil digenerate dan siap untuk ditandatangani oleh pejabat.
            </p>

            <!-- File Info -->
            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6 mb-6">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <div class="text-left">
                        <p class="text-sm font-medium text-gray-700">Nama File:</p>
                        <p class="font-semibold text-gray-900">{{ $file }}</p>
                        <span class="inline-block mt-1 px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">
                            📄 PDF Format
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Nomor Surat</p>
                        <p class="font-semibold text-gray-900">001/SKD/XI/2024</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Pemohon</p>
                        <p class="font-semibold text-gray-900">Budi Santoso</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Status</p>
                        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                            Menunggu TTD
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('demo.admin.download', $file) }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download Preview
                </a>

                <a href="{{ route('demo.pejabat.dashboard') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Lanjut ke Dashboard Pejabat
                </a>
            </div>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">atau</span>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('demo.admin.dashboard') }}"
               class="inline-flex items-center text-gray-600 hover:text-gray-900 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Dashboard Admin
            </a>
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-amber-50 border-l-4 border-amber-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-amber-700">
                        <strong>Next Step:</strong> Surat ini sekarang menunggu tanda tangan digital dari pejabat.
                        Setelah ditandatangani, surat akan otomatis lengkap dan siap dikirim ke pemohon.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
