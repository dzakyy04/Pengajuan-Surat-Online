@extends('layouts.app')

@section('title', 'Tandatangani Surat - Demo')

@section('content')
<div class="mb-6">
    <a href="{{ route('demo.pejabat.dashboard') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Dashboard
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Detail Surat -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Detail Surat</h2>
                    <p class="text-sm text-gray-500 mt-1">Nomor: 001/SKD/XI/2024</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                    Menunggu Tanda Tangan
                </span>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Jenis Surat</label>
                        <p class="text-gray-900 font-medium">Surat Keterangan Tidak Mampu</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tanggal Dibuat</label>
                        <p class="text-gray-900">27 Nov 2024</p>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-500">Keperluan</label>
                    <p class="text-gray-900 font-medium">Bantuan Pendidikan Anak</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Pemohon</label>
                        <p class="text-gray-900 font-semibold">Budi Santoso</p>
                        <p class="text-sm text-gray-600">NIK: 3201234567890123</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Diproses oleh Admin</label>
                        <p class="text-gray-900">Admin System</p>
                    </div>
                </div>

                <!-- Preview Document -->
                <div>
                    <label class="text-sm font-medium text-gray-500 mb-3 block">Preview Dokumen Surat</label>
                    <div class="border-2 border-gray-200 rounded-xl p-6 bg-gray-50">
                        <div class="text-center mb-6">
                            <svg class="w-16 h-16 mx-auto text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-sm font-medium text-gray-700 mb-2">Surat Keterangan Tidak Mampu</p>
                            <p class="text-xs text-gray-500">Nomor: 001/SKD/XI/2024</p>
                        </div>

                        <!-- Preview Info -->
                        <div class="bg-white rounded-lg p-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama:</span>
                                <span class="font-medium">Budi Santoso</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">NIK:</span>
                                <span class="font-medium">3201234567890123</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Keperluan:</span>
                                <span class="font-medium">Bantuan Pendidikan Anak</span>
                            </div>
                        </div>

                        <!-- Download Button -->
                        <button onclick="alert('Preview dokumen sebelum TTD')" class="w-full mt-4 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition text-sm font-medium">
                            Preview Full Document
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Warning Box -->
        <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-amber-700">
                        <strong>Perhatian:</strong> Dengan menandatangani dokumen ini, Anda menyatakan bahwa informasi dalam surat ini telah diperiksa dan disetujui untuk diterbitkan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar - Tanda Tangan -->
    <div class="space-y-6">
        <!-- Tanda Tangan Digital -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Tanda Tangan Digital</h3>

            <!-- Signature Preview -->
            <div class="mb-4 p-4 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                <p class="text-xs text-gray-500 mb-2 text-center">Preview Tanda Tangan:</p>
                <div class="bg-white p-3 rounded border border-gray-200">
                    <img src="{{ asset('resources/files/ttd_pejabat.png') }}"
                         alt="Tanda Tangan"
                         class="w-full h-20 object-contain"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <div class="text-center py-4 hidden">
                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        <p class="text-xs text-gray-500 mt-2">Tanda Tangan</p>
                    </div>
                </div>
                <p class="text-xs text-gray-600 mt-2 text-center font-medium">H. Ahmad Sudrajat, S.Sos</p>
                <p class="text-xs text-gray-500 text-center">Kepala Desa Sukamaju</p>
            </div>

            <!-- Sign Button -->
            <form action="{{ route('demo.pejabat.sign') }}" method="POST" onsubmit="return confirm('Yakin ingin menandatangani dokumen ini?')">
                @csrf
                <button type="submit"
                        class="w-full px-4 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition font-semibold flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Tandatangani Dokumen
                </button>
            </form>
        </div>

        <!-- Info TTD -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <h4 class="font-semibold text-blue-900 mb-2 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                Cara Kerja TTD Digital
            </h4>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• Tanda tangan akan otomatis masuk ke dokumen</li>
                <li>• Nama dan jabatan akan tertera</li>
                <li>• Tanggal penandatanganan tercatat</li>
                <li>• Dokumen langsung siap dikirim</li>
            </ul>
        </div>
    </div>
</div>
@endsection
