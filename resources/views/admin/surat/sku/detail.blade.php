@extends('admin.layout.app')

@section('title', 'Detail Pengajuan Surat Keterangan Usaha')

@push('styles')
    <style>
        .ck-editor__editable {
            min-height: 150px;
        }

        .section-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            border-left-color: #15a776;

        }

        .section-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        }

        .input-group {
            position: relative;
        }

        .input-group input:focus,
        .input-group select:focus,
        .input-group textarea:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .icon-wrapper {
            background: linear-gradient(135deg, #15a776 0%, #0d8a5f 100%);
            box-shadow: 0 4px 12px rgba(21, 167, 118, 0.3);
        }

        .sticky-action {
            position: sticky;
            top: 20px;
            z-index: 10;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.3s ease-out;
        }
    </style>
@endpush



@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mx-auto py-8 px-2 max-w-full">
        <!-- Header -->
        <div class="mb-8 animate-slide-in">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="icon-wrapper p-3 rounded-2xl">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900 mb-2 tracking-tight">Detail Pengajuan SKD</h1>
                        <p class="text-sm text-gray-500 mb-3">Kelola dan verifikasi data pengajuan surat keterangan</p>
                        <span
                            class="inline-flex items-center px-5 py-2.5 rounded-full text-xs bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-bold shadow-lg hover:shadow-xl transition-all duration-300">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $pengajuan->nomor_pengajuan }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('admin.sku.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white rounded-full transition-all duration-200 shadow-sm hover:shadow-xl font-semibold text-xs">
                    <svg class="w-3 h-3 mr-2 font-semibold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div
                class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-xl shadow-md animate-slide-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="ml-3 font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div
                class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-xl shadow-md animate-slide-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="ml-3 font-semibold">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- UNIFIED FORM -->


        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-3 ">
                <form action="{{ route('admin.sku.update', ['id' => $pengajuan->id]) }}" method="POST" id="formUnified"
                    class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Data Pemohon -->
                    <div class="bg-white rounded-xl shadow-xs p-6 section-card  animate-slide-in">
                        <div class="mb-6">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-full">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-lg font-bold text-gray-800">Data Pemohon</h2>
                                    <p class="text-sm text-gray-500">Informasi identitas dan data diri pemohon</p>
                                </div>

                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" name="nama" value="{{ old('nama', $sku->nama) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                @error('nama')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">NIK *</label>
                                <input type="text" name="nik" value="{{ old('nik', $sku->nik) }}" required
                                    maxlength="16"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                @error('nik')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tempat Lahir *</label>
                                <input type="text" name="tempat_lahir"
                                    value="{{ old('tempat_lahir', $sku->tempat_lahir) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                @error('tempat_lahir')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir *</label>
                                <input type="date" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', optional($sku->tanggal_lahir)->format('Y-m-d')) }}"
                                    required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg
 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                @error('tanggal_lahir')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin *</label>
                                <select name="jenis_kelamin" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    <option value="Laki-Laki" {{ $sku->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan" {{ $sku->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Agama *</label>
                                <select name="agama" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                        <option value="{{ $agama }}"
                                            {{ $sku->agama == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Perkawinan *</label>
                                <select name="status_perkawinan" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    @foreach (['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                        <option value="{{ $status }}"
                                            {{ $sku->status_perkawinan == $status ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan *</label>
                                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $sku->pekerjaan) }}"
                                    required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">RT *</label>
                                <input type="text" name="rt" value="{{ old('rt', $sku->rt) }}" required
                                    maxlength="3"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">RW *</label>
                                <input type="text" name="rw" value="{{ old('rw', $sku->rw) }}" required
                                    maxlength="3"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Dusun</label>
                                <input type="text" name="dusun" value="{{ old('dusun', $sku->dusun) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                            </div>

                            <div class="md:col-span-2 input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap *</label>
                                <textarea name="alamat" rows="3" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">{{ old('alamat', $sku->alamat) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Surat RT -->
                    <div class="bg-white rounded-xl shadow-sm p-6 section-card animate-slide-in">
                        <div class="mb-6">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-lg font-bold text-gray-800">Surat Pengantar RT</h2>
                                    <p class="text-sm text-gray-500">Informasi surat pengantar dari RT setempat</p>
                                </div>
                            </div>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Surat RT *</label>
                                <input type="text" name="no_surat_rt"
                                    value="{{ old('no_surat_rt', $sku->no_surat_rt) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Surat RT *</label>
                                <input type="date" name="tanggal_surat_rt"
                                    value="{{ old('tanggal_surat_rt', optional($sku->tanggal_surat_rt)->format('Y-m-d')) }}"
                                    required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Keperluan -->
                    {{-- <div class="bg-white rounded-xl shadow-sm p-6 section-card keperluan animate-slide-in">
                        <div class="mb-6">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-lg font-bold text-gray-800">Keperluan</h2>
                                    <p class="text-sm text-gray-500">Tujuan dan keperluan pembuatan SKD</p>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <textarea name="keperluan" id="editor">{{ $sku->keperluan }}</textarea>
                        </div>
                    </div> --}}

                                        <div class="bg-white rounded-xl shadow-sm p-6 section-card animate-slide-in">
                        <div class="mb-6">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-lg font-bold text-gray-800">Informasi Usaha</h2>
                                    <p class="text-sm text-gray-500">Detail usaha yang dijalankan</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Usaha *</label>
                                <input type="text" name="nama_usaha"
                                    value="{{ old('nama_usaha', $sku->nama_usaha) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                @error('nama_usaha')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Usaha *</label>
                                <input type="text" name="jenis_usaha"
                                    value="{{ old('jenis_usaha', $sku->jenis_usaha) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                @error('jenis_usaha')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2 input-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Usaha *</label>
                                <textarea name="alamat_usaha" rows="3" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">{{ old('alamat_usaha', $sku->alamat_usaha) }}</textarea>
                                @error('alamat_usaha')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan Usaha -->
                    <div class="bg-white rounded-xl shadow-sm p-6 section-card animate-slide-in">
                        <div class="mb-6">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-lg font-bold text-gray-800">Keterangan Usaha</h2>
                                    <p class="text-sm text-gray-500">Informasi tambahan mengenai usaha (opsional)</p>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <textarea name="keterangan_usaha" id="editor">{{ old('keterangan_usaha', $sku->keterangan_usaha) }}</textarea>
                        </div>
                    </div>


                    {{-- Dokumen Pendukung --}}
                    <div class="bg-white rounded-2xl shadow-sm p-6 section-card border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-emerald-600 to-emerald-500 rounded-full flex items-center justify-center mr-2 shadow-md">
                                <i class="fa-solid fa-paperclip text-white text-sm"></i>
                            </div>
                            Dokumen Pendukung
                        </h3>

                        @php
                            $docs = [
                                ['label' => 'KTP', 'path' => $pengajuan->dokumen_ktp ?? null],
                                ['label' => 'KK', 'path' => $pengajuan->dokumen_kk ?? null],
                                ['label' => 'Surat Pengantar RT', 'path' => $pengajuan->dokumen_surat_rt ?? null],
                            ];

                            $isImage = fn($p) => $p && preg_match('/\.(jpg|jpeg|png|webp)$/i', $p);
                            $isPdf = fn($p) => $p && preg_match('/\.pdf$/i', $p);
                        @endphp

                        <div class="space-y-4">
                            @foreach ($docs as $doc)
                                <div class="border border-gray-200 rounded-xl p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800">{{ $doc['label'] }}</p>
                                            @if (!$doc['path'])
                                                <p class="text-xs text-rose-600 mt-1">Belum ada file</p>
                                            @else
                                                <p class="text-xs text-gray-500 mt-1">{{ basename($doc['path']) }}</p>
                                            @endif
                                        </div>

                                        @if ($doc['path'])
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.pengajuan.dokumen.view', [$pengajuan->id, 'file' => $doc['path']]) }}"
                                                    target="_blank"
                                                    class="inline-flex items-center px-3 py-2 rounded-lg bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700 transition">
                                                    Lihat
                                                </a>
                                                <a href="{{ route('admin.pengajuan.dokumen.download', [$pengajuan->id, 'file' => $doc['path']]) }}"
                                                    class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-800 text-xs font-semibold hover:bg-gray-200 transition">
                                                    Download
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Preview --}}
                                    @if ($doc['path'])
                                        <div class="mt-3">
                                            @if ($isImage($doc['path']))
                                                <img src="{{ asset('storage/' . $doc['path']) }}"
                                                    alt="Preview {{ $doc['label'] }}"
                                                    class="rounded-xl border border-gray-200" height="300">
                                            @elseif ($isPdf($doc['path']))
                                                <div class="rounded-xl border border-gray-200 overflow-hidden">
                                                    <iframe src="{{ asset('storage/' . $doc['path']) }}" class="w-full"
                                                        style="height: 320px;"></iframe>
                                                </div>
                                            @else
                                                <p class="text-xs text-gray-500">Preview tidak tersedia untuk tipe file
                                                    ini.</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <button type="submit"
                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:scale-105 border border-emerald-600 text-white rounded-2xl font-semibold transition-all duration-200 shadow-xs hover:shadow-xl text-base">
                        Simpan Perubahan
                    </button>
                </form>

            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="">
                    <div class="space-y-4">
                        <div
                            class="p-4 bg-white rounded-xl border-l-4 border-emerald-600 shadow-sm hover:shadow-md transition-all duration-200">
                            <label
                                class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block flex items-center">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                Status Saat Ini
                            </label>
                            <div class="mt-2">
                                @include('components.status-badge', ['status' => $pengajuan->status])
                            </div>
                        </div>

                        <div
                            class="p-4 bg-white rounded-xl border-l-4 border-emerald-600 shadow-sm hover:shadow-md transition-all duration-200">
                            <label
                                class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block flex items-center">
                                <svg class="w-4 h-4 text-emerald-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Tanggal Pengajuan
                            </label>
                            <p class="text-gray-900 font-bold mt-1 text-sm">
                                {{ $pengajuan->created_at->translatedFormat('d F Y') }}</p>
                            <div class="flex items-center mt-1">
                                <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-400 text-xs font-normal">
                                    {{ $pengajuan->created_at->translatedFormat('H:i') }} WIB</p>
                            </div>
                        </div>

                        @if ($pengajuan->admin)
                            <div
                                class="p-4 bg-white rounded-xl border-l-4 border-emerald-600 shadow-sm hover:shadow-md transition-all duration-200">
                                <label
                                    class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block flex items-center">
                                    <svg class="w-4 h-4 text-emerald-600 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Diproses Oleh
                                </label>
                                <div class="flex items-center mt-1">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-2">
                                        {{ substr($pengajuan->admin->nama, 0, 1) }}
                                    </div>
                                    <p class="text-gray-900 font-bold">{{ $pengajuan->admin->nama }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- FITUR BARU: File Surat & Print -->
                @if ($pengajuan->status == 'diproses' && $pengajuan->file_surat_cetak)
                    <div
                        class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 section-card border border-gray-100">
                        <h3
                            class="text-lg font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-5 flex items-center">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-emerald-600 to-emerald-500 rounded-full flex items-center justify-center mr-2 shadow-md">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            File Surat
                        </h3>

                        <div class="space-y-3">
                            <!-- Download Button -->
                            <a href="{{ route('admin.sku.download', $pengajuan->file_surat_cetak) }}"
                                class="group w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white rounded-full font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] relative overflow-hidden">
                                <div
                                    class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                                </div>
                                <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span>Download Surat</span>
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>

                        <!-- Info File TTD (jika sudah diupload) -->
                        @if ($pengajuan->file_surat_ttd)
                            <div class="mt-5 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-600 mt-0.5 mr-2" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-green-800">Surat Bertanda Tangan Tersedia</p>
                                        <p class="text-xs text-green-700 mt-1">Diupload:
                                            {{ $pengajuan->tanggal_upload_ttd ? \Carbon\Carbon::parse($pengajuan->tanggal_upload_ttd)->translatedFormat('d F Y H:i') : '-' }}
                                        </p>
                                        <a href="{{ asset('storage/surat_ttd/' . $pengajuan->file_surat_ttd) }}" download
                                            class="inline-flex items-center mt-2 text-xs font-semibold text-green-700 hover:text-green-900 transition">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Download File TTD
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Action Buttons -->
                @if ($pengajuan->status == 'pending')
                    <div class="">

                        <button type="button"
                            onclick="document.getElementById('modalApprove').classList.remove('hidden')"
                            class="group w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white rounded-full font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] relative overflow-hidden mb-1.5">

                            <div
                                class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-1.5">Setuju</span>
                        </button>

                        <button type="button" onclick="document.getElementById('modalReject').classList.remove('hidden')"
                            class="group w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-rose-600 to-rose-500 hover:from-rose-700 hover:to-rose-600 text-white rounded-full font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                            </div>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-1.5">Tolak</span>
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Modal Approve -->
    <div id="modalApprove"
        class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-brightness-50 backdrop-blur-sm">

        <div class="w-full max-w-md mx-auto bg-white rounded-3xl shadow-xs overflow-hidden animate-slide-in">

            <!-- Header -->
            <div class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white">
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold">Setujui Pengajuan</h3>
                    <p class="text-xs text-emerald-100">Pengajuan akan diproses dan surat dibuat</p>
                </div>
            </div>

            <!-- Body -->
            <div class="px-6 py-5 text-center">
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                    Dengan menyetujui pengajuan ini, sistem akan secara otomatis
                    <b>menghasilkan surat resmi</b> dan mengubah status pengajuan.
                    Pastikan seluruh data sudah benar.
                </p>

                <form action="{{ route('admin.sku.approve', $pengajuan->id) }}" method="POST">
                    @csrf

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <button type="button" onclick="document.getElementById('modalApprove').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition text-sm">
                            Batal
                        </button>

                        <button type="submit"
                            class="flex-1 px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white font-bold shadow-lg hover:shadow-xl transition text-sm">
                            Ya, Setujui
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>



    <!-- Modal Reject -->
    <div id="modalReject"
        class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-brightness-50 backdrop-blur-sm">

        <div class="w-full max-w-md mx-auto bg-white rounded-3xl shadow-xs overflow-hidden animate-slide-in">

            <!-- Header -->
            <div class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-rose-600 to-rose-500 text-white">
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold">Tolak Pengajuan</h3>
                    <p class="text-xs text-rose-100">Tindakan ini bersifat final</p>
                </div>
            </div>

            <!-- Body -->
            <div class="px-6 py-5">
                <form action="{{ route('admin.sku.reject', $pengajuan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="catatan_admin" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>

                        <textarea name="catatan_admin" id="catatan_admin" rows="4" required
                            placeholder="Contoh: Data tidak sesuai dengan dokumen pendukung..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all resize-none"></textarea>

                        <p class="text-xs text-gray-500 mt-1">
                            Alasan ini akan disimpan dan dapat dilihat oleh pemohon.
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3 mt-6">
                        <button type="button" onclick="document.getElementById('modalReject').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition text-sm">
                            Batal
                        </button>

                        <button type="submit"
                            class="flex-1 px-4 py-2.5 rounded-full bg-gradient-to-r from-rose-600 to-rose-500 hover:from-rose-700 hover:to-rose-00 text-white font-semibold shadow-lg hover:shadow-xl transition text-sm">
                            Tolak Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
