@extends('layouts.app')

@section('title', 'Review Pengajuan - Demo')

@section('content')
<div class="mb-6">
    <a href="{{ route('demo.admin.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Dashboard
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Detail Pengajuan -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Detail Pengajuan</h2>
                    <p class="text-sm text-gray-500 mt-1">ID: #001</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                    Menunggu Review
                </span>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Jenis Surat</label>
                        <p class="text-gray-900 font-medium">Surat Keterangan Tidak Mampu</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tanggal Pengajuan</label>
                        <p class="text-gray-900">27 Nov 2024, 10:30</p>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-500">Keperluan</label>
                    <p class="text-gray-900 font-medium">Bantuan Pendidikan Anak</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-500">Keterangan Tambahan</label>
                    <p class="text-gray-900">Untuk mengajukan beasiswa pendidikan anak SD di sekolah setempat</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-500 mb-2 block">Surat Pengantar RT</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-sm text-gray-600 mb-2">surat_pengantar_rt_budi.pdf</p>
                        <button onclick="alert('Preview surat pengantar RT')" class="inline-flex items-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Dokumen
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Pemohon -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Data Pemohon</h3>
            <div class="space-y-3">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                        <p class="text-gray-900">Budi Santoso</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">NIK</label>
                        <p class="text-gray-900">3201234567890123</p>
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Email</label>
                    <p class="text-gray-900">budi.santoso@example.com</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">No. Telepon</label>
                    <p class="text-gray-900">0812-3456-7890</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Alamat</label>
                    <p class="text-gray-900">Jl. Merdeka No. 123, RT 001/RW 002, Kelurahan Sukamaju, Kecamatan Cikarang Utara</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Actions -->
    <div class="space-y-6">
        <!-- Action Buttons -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Tindakan</h3>

            <!-- Form Approve -->
            <form action="{{ route('demo.admin.approve') }}" method="POST" class="mb-4">
                @csrf
                <label class="text-sm font-medium text-gray-700 mb-2 block">Catatan Admin (Opsional)</label>
                <textarea name="catatan_admin"
                          rows="3"
                          placeholder="Tambahkan catatan jika diperlukan..."
                          class="w-full border-gray-300 rounded-lg shadow-sm mb-3 text-sm focus:ring-2 focus:ring-green-500"></textarea>
                <button type="submit"
                        class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Setujui & Generate Surat
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">atau</span>
                </div>
            </div>

            <!-- Form Reject -->
            <form action="{{ route('demo.admin.reject') }}" method="POST" onsubmit="return confirm('Yakin ingin menolak pengajuan ini?')">
                @csrf
                <label class="text-sm font-medium text-gray-700 mb-2 block">Alasan Penolakan</label>
                <textarea name="catatan_admin"
                          rows="3"
                          required
                          placeholder="Jelaskan alasan penolakan..."
                          class="w-full border-gray-300 rounded-lg shadow-sm mb-3 text-sm focus:ring-2 focus:ring-red-500"></textarea>
                <button type="submit"
                        class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Tolak Pengajuan
                </button>
            </form>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        <strong>Tips:</strong> Periksa kelengkapan surat pengantar RT sebelum menyetujui. Surat akan otomatis digenerate setelah disetujui.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
