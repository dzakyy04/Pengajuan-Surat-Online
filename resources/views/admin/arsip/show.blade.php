@extends('admin.layout.app')

@section('title', 'Detail Arsip Surat')

@push('styles')
    <style>
        .info-card {
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #10b981, #059669);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 30px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -26px;
            top: 5px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: white;
            border: 3px solid #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .timeline-item.active::before {
            background: #10b981;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            }

            50% {
                box-shadow: 0 0 0 8px rgba(16, 185, 129, 0.2);
            }
        }

        .document-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .document-card:hover {
            border-left-color: #10b981;
            background: #f0fdf4;
            transform: translateX(4px);
        }
    </style>
@endpush

@section('content')

    @php
        $kode = $pengajuan->jenisSurat->kode;
    @endphp

    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Detail Arsip Surat</h1>
                    <p class="text-gray-600 mt-2">Informasi lengkap arsip surat</p>
                </div>
                <a href="{{ route('admin.arsip.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow-sm transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Info Pengajuan Card -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Info Surat -->
            <div class="border border-emerald-200 bg-white rounded-2xl shadow-sm overflow-hidden info-card">
                <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 px-6 py-4 border-b border-emerald-200">
                    <h3 class="text-lg font-bold text-emerald-700 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Informasi Surat
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">Nomor Pengajuan</span>
                        <span class="text-sm font-bold text-gray-900">{{ $pengajuan->nomor_pengajuan }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">Nomor Surat</span>
                        @if ($pengajuan->nomor_surat)
                            <span
                                class="px-3 py-1 text-xs font-bold bg-emerald-100 text-emerald-700 rounded-lg">{{ $pengajuan->nomor_surat }}</span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-600 rounded-lg">Belum
                                ada</span>
                        @endif
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">Jenis Surat</span>
                        <span class="text-sm font-bold text-gray-900">{{ $pengajuan->jenisSurat->nama }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">Status</span>
                        @include('components.status-badge', ['status' => $pengajuan->status])
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">Tanggal Pengajuan</span>
                        <span class="text-sm text-gray-900">{{ $pengajuan->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Info Pemohon -->
            <div class="border border-blue-200 bg-white rounded-2xl shadow-sm overflow-hidden info-card">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                    <h3 class="text-lg font-bold text-blue-700 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Informasi Pemohon
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">Nama Pemohon</span>
                        <span class="text-sm font-bold text-gray-900">{{ $pengajuan->nama_pemohon }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">Email</span>
                        <span class="text-sm text-gray-900">{{ $pengajuan->email_pemohon }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">No. HP</span>
                        <span class="text-sm text-gray-900">{{ $pengajuan->no_hp_pemohon }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">Diproses Oleh</span>
                        <span class="text-sm font-bold text-gray-900">
                            @if ($pengajuan->admin)
                                {{ $pengajuan->admin->nama }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold text-gray-600">Tanggal Diproses</span>
                        <span class="text-sm text-gray-900">
                            @if ($pengajuan->tanggal_diproses)
                                {{ \Carbon\Carbon::parse($pengajuan->tanggal_diproses)->format('d/m/Y H:i') }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @if ($pengajuan->catatan_admin)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-6 rounded-r-xl shadow-sm">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-1">Catatan Admin</h4>
                        <p class="text-blue-800">{{ $pengajuan->catatan_admin }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Detail Data Surat -->
        @if ($detailSurat)
            <div class="border border-slate-200 bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
                <div class="bg-gradient-to-l from-white to-purple-100 px-6 py-4 border-b border-slate-200">
                    <h2 class="text-xl font-bold text-purple-700 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Detail Data Surat - {{ $pengajuan->jenisSurat->nama }}
                    </h2>
                </div>
                <div class="p-6">
                    {{-- SURAT TIDAK MAMPU --}}
                    @if ($kode === 'SKTM')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Data Pemohon -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-emerald-200">Data
                                    Pemohon</h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Nama</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nama }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">NIK</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nik }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Tempat, Tgl Lahir</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($detailSurat->tanggal_lahir)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Jenis Kelamin</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->jenis_kelamin }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Status Perkawinan</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->status_perkawinan }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Agama</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->agama }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Pekerjaan</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->pekerjaan }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Alamat</span>
                                        <span class="text-sm text-gray-900 text-right">{{ $detailSurat->alamat }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">RT/RW</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $detailSurat->rt }}/{{ $detailSurat->rw }}</span>
                                    </div>
                                    @if ($detailSurat->dusun)
                                        <div class="flex justify-between py-2">
                                            <span class="text-sm font-semibold text-gray-600">Dusun</span>
                                            <span class="text-sm text-gray-900">{{ $detailSurat->dusun }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Data Surat RT -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-200">Data Surat
                                    RT</h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">No. Surat RT</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->no_surat_rt }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Tanggal Surat RT</span>
                                        <span
                                            class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($detailSurat->tanggal_surat_rt)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between py-2">
                                        <span class="text-sm font-semibold text-gray-600">Keperluan</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->keperluan }}</span>
                                    </div>
                                </div>

                                @if ($detailSurat->anggota_keluarga)
                                    <h5
                                        class="text-lg font-bold text-gray-800 mt-6 mb-4 pb-2 border-b-2 border-purple-200">
                                        Anggota Keluarga</h5>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase border-b">
                                                        No</th>
                                                    <th
                                                        class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase border-b">
                                                        Nama</th>
                                                    <th
                                                        class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase border-b">
                                                        NIK</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach ($detailSurat->anggota_keluarga as $key => $anggota)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $key + 1 }}
                                                        </td>
                                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $anggota['nama'] }}
                                                        </td>
                                                        <td class="px-4 py-3 text-sm text-gray-900">
                                                            {{ $anggota['nik'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @elseif($kode === 'SKD')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">Nama</span>
                                <span class="text-sm text-gray-900">{{ $detailSurat->nama }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">NIK</span>
                                <span class="text-sm text-gray-900">{{ $detailSurat->nik }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">Tempat Lahir</span>
                                <span class="text-sm text-gray-900">{{ $detailSurat->tempat_lahir }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">Tanggal Lahir</span>
                                <span
                                    class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($detailSurat->tanggal_lahir)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">Jenis Kelamin</span>
                                <span class="text-sm text-gray-900">{{ $detailSurat->jenis_kelamin }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">Status Perkawinan</span>
                                <span class="text-sm text-gray-900">{{ $detailSurat->status_perkawinan }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">Agama</span>
                                <span class="text-sm text-gray-900">{{ $detailSurat->agama }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">Pekerjaan</span>
                                <span class="text-sm text-gray-900">{{ $detailSurat->pekerjaan }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100 md:col-span-2">
                                <span class="text-sm font-semibold text-gray-600">Alamat</span>
                                <span class="text-sm text-gray-900 text-right">{{ $detailSurat->alamat }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">RT/RW</span>
                                <span class="text-sm text-gray-900">{{ $detailSurat->rt }}/{{ $detailSurat->rw }}</span>
                            </div>
                            @if ($detailSurat->dusun)
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-semibold text-gray-600">Dusun</span>
                                    <span class="text-sm text-gray-900">{{ $detailSurat->dusun }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">No. Surat RT</span>
                                <span class="text-sm text-gray-900">{{ $detailSurat->no_surat_rt }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600">Tanggal Surat RT</span>
                                <span
                                    class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($detailSurat->tanggal_surat_rt)->format('d/m/Y') }}</span>
                            </div>
                            @if ($detailSurat->keperluan)
                                <div class="flex justify-between py-2 md:col-span-2">
                                    <span class="text-sm font-semibold text-gray-600">Keperluan</span>
                                    <span class="text-sm text-gray-900">{{ $detailSurat->keperluan }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- SURAT KETERANGAN USAHA --}}
                    @elseif($kode === 'SKU')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Data Pemohon -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-emerald-200">Data
                                    Pemohon</h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Nama</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nama }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">NIK</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nik }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Tempat, Tgl Lahir</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($detailSurat->tanggal_lahir)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Jenis Kelamin</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->jenis_kelamin }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Status Perkawinan</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->status_perkawinan }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Agama</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->agama }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Pekerjaan</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->pekerjaan }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Alamat</span>
                                        <span class="text-sm text-gray-900 text-right">{{ $detailSurat->alamat }}</span>
                                    </div>
                                    <div class="flex justify-between py-2">
                                        <span class="text-sm font-semibold text-gray-600">RT/RW</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $detailSurat->rt }}/{{ $detailSurat->rw }}</span>
                                    </div>
                                    @if ($detailSurat->dusun)
                                        <div class="flex justify-between py-2">
                                            <span class="text-sm font-semibold text-gray-600">Dusun</span>
                                            <span class="text-sm text-gray-900">{{ $detailSurat->dusun }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Data Usaha -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-200">Data Usaha
                                </h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Nama Usaha</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nama_usaha }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Jenis Usaha</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->jenis_usaha }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Alamat Usaha</span>
                                        <span
                                            class="text-sm text-gray-900 text-right">{{ $detailSurat->alamat_usaha }}</span>
                                    </div>
                                    @if ($detailSurat->keterangan_usaha)
                                        <div class="py-2">
                                            <span class="text-sm font-semibold text-gray-600 block mb-2">Keterangan
                                                Usaha</span>
                                            <div class="bg-gray-50 p-3 rounded-lg">
                                                <span
                                                    class="text-sm text-gray-900">{{ $detailSurat->keterangan_usaha }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- SURAT PENGHASILAN --}}
                    @elseif($kode === 'SKP')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Data Pemohon -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-emerald-200">Data
                                    Pemohon</h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Nama</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nama }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">NIK</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nik }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Tempat, Tgl Lahir</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($detailSurat->tanggal_lahir)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Jenis Kelamin</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->jenis_kelamin }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Status Perkawinan</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->status_perkawinan }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Agama</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->agama }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Pekerjaan</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->pekerjaan }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Alamat</span>
                                        <span class="text-sm text-gray-900 text-right">{{ $detailSurat->alamat }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">RT/RW</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $detailSurat->rt }}/{{ $detailSurat->rw }}</span>
                                    </div>
                                    @if ($detailSurat->dusun)
                                        <div class="flex justify-between py-2">
                                            <span class="text-sm font-semibold text-gray-600">Dusun</span>
                                            <span class="text-sm text-gray-900">{{ $detailSurat->dusun }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Data Penghasilan & Surat RT -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-200">Data Surat
                                    RT</h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">No. Surat RT</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->no_surat_rt }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Tanggal Surat RT</span>
                                        <span
                                            class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($detailSurat->tanggal_surat_rt)->format('d/m/Y') }}</span>
                                    </div>
                                </div>

                                <h5 class="text-lg font-bold text-gray-800 mt-6 mb-4 pb-2 border-b-2 border-green-200">
                                    Informasi Penghasilan</h5>
                                <div class="space-y-3">
                                    <div class="py-3 bg-green-50 rounded-lg px-4 border border-green-200">
                                        <span class="text-xs font-semibold text-green-600 uppercase block mb-1">Penghasilan
                                            Per Bulan</span>
                                        <span class="text-2xl font-bold text-green-700">Rp
                                            {{ number_format($detailSurat->penghasilan_perbulan, 0, ',', '.') }}</span>
                                    </div>
                                    @if ($detailSurat->nama_anak)
                                        <div class="flex justify-between py-2 border-b border-gray-100">
                                            <span class="text-sm font-semibold text-gray-600">Nama Anak</span>
                                            <span class="text-sm text-gray-900">{{ $detailSurat->nama_anak }}</span>
                                        </div>
                                    @endif
                                    @if ($detailSurat->keterangan_tambahan)
                                        <div class="py-2">
                                            <span class="text-sm font-semibold text-gray-600 block mb-2">Keterangan
                                                Tambahan</span>
                                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                                                <span
                                                    class="text-sm text-gray-900">{{ $detailSurat->keterangan_tambahan }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- SURAT KEMATIAN --}}
                    @elseif($kode === 'SKMT')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Data Almarhum -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-red-200">Data
                                    Almarhum
                                </h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Nama Almarhum</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nama_almarhum }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Jenis Kelamin</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->jenis_kelamin }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Umur</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->umur }} tahun</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Alamat</span>
                                        <span class="text-sm text-gray-900 text-right">{{ $detailSurat->alamat }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">RT/RW</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $detailSurat->rt }}/{{ $detailSurat->rw }}</span>
                                    </div>
                                    @if ($detailSurat->dusun)
                                        <div class="flex justify-between py-2 border-b border-gray-100">
                                            <span class="text-sm font-semibold text-gray-600">Dusun</span>
                                            <span class="text-sm text-gray-900">{{ $detailSurat->dusun }}</span>
                                        </div>
                                    @endif
                                </div>

                                <h5 class="text-lg font-bold text-gray-800 mt-6 mb-4 pb-2 border-b-2 border-orange-200">
                                    Data
                                    Kematian</h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Tanggal Meninggal</span>
                                        <span
                                            class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($detailSurat->tanggal_meninggal)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Hari Meninggal</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->hari_meninggal }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Jam Meninggal</span>
                                        <span
                                            class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($detailSurat->jam_meninggal)->format('H:i') }}
                                            WIB</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Tempat Meninggal</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->tempat_meninggal }}</span>
                                    </div>
                                    <div class="flex justify-between py-2">
                                        <span class="text-sm font-semibold text-gray-600">Sebab Meninggal</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->sebab_meninggal }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Pelapor -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-200">Data
                                    Pelapor
                                </h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Nama Pelapor</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nama_pelapor }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">NIK Pelapor</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->nik_pelapor }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Jenis Kelamin</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $detailSurat->jenis_kelamin_pelapor }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Tempat, Tgl Lahir</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->tempat_lahir_pelapor }},
                                            {{ \Carbon\Carbon::parse($detailSurat->tanggal_lahir_pelapor)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Agama</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->agama_pelapor }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Pekerjaan</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->pekerjaan_pelapor }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">Alamat Pelapor</span>
                                        <span
                                            class="text-sm text-gray-900 text-right">{{ $detailSurat->alamat_pelapor }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-semibold text-gray-600">RT/RW</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $detailSurat->rt_pelapor }}/{{ $detailSurat->rw_pelapor }}</span>
                                    </div>
                                    <div class="flex justify-between py-2">
                                        <span class="text-sm font-semibold text-gray-600">Hubungan dengan Almarhum</span>
                                        <span class="text-sm text-gray-900">{{ $detailSurat->hubungan_pelapor }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
