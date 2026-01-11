@extends('admin.layout.app')

@section('title', 'Arsip Data Surat')

@push('styles')
    <style>
        .card-stats {
            transition: all 0.3s ease;
        }

        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .dropdown-menu {
            display: none;
            position: fixed;
            z-index: 9999;
            min-width: 12rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }

        .dropdown-menu.show {
            display: block;
            animation: slideDown 0.2s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            transition: all 0.15s;
        }

        .dropdown-item:hover {
            background: #f3f4f6;
            color: #111827;
        }

        .dropdown-item:first-child {
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .dropdown-item:last-child {
            border-radius: 0 0 0.75rem 0.75rem;
        }

        .dropdown-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 0.25rem 0;
        }
    </style>
@endpush

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Arsip Data Surat</h1>
                    <p class="text-gray-600 mt-2">Kelola dan pantau arsip surat yang telah diproses</p>
                </div>
                <div class="flex gap-2 items-center">
                    <!-- Refresh Button -->
                    <button onclick="window.location.reload()"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow-sm transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
            <!-- Total Card -->
            <div
                class="border border-emerald-200 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl shadow-sm p-6 text-emerald-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-emerald-600 text-sm font-semibold mb-2">Total Arsip</p>
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $pengajuan->total() }}</h3>
                </div>
            </div>

            <!-- Submitted -->
            <div
                class="border border-orange-200 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl shadow-sm p-6 text-orange-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-sm font-semibold mb-2">Diajukan</p>
                <div class="flex items-center gap-3">
                    <div class="bg-orange-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $pengajuan->where('status', 'submitted')->count() }}</h3>
                </div>
            </div>

            <!-- Verified -->
            <div
                class="border border-blue-200 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-sm p-6 text-blue-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-sm font-semibold mb-2">Diverifikasi</p>
                <div class="flex items-center gap-3">
                    <div class="bg-blue-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $pengajuan->where('status', 'verified')->count() }}</h3>
                </div>
            </div>

            <!-- Approved -->
            <div
                class="border border-green-200 bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-sm p-6 text-green-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-sm font-semibold mb-2">Ditandatangani</p>
                <div class="flex items-center gap-3">
                    <div class="bg-green-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $pengajuan->where('status', 'approved')->count() }}</h3>
                </div>
            </div>

            <!-- Notified -->
            <div
                class="border border-teal-200 bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-sm p-6 text-teal-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-sm font-semibold mb-2">Dinotifikasi</p>
                <div class="flex items-center gap-3">
                    <div class="bg-teal-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $pengajuan->where('status', 'notified')->count() }}</h3>
                </div>
            </div>

            <!-- Rejected -->
            <div
                class="border border-rose-200 bg-gradient-to-br from-rose-50 to-rose-100 rounded-xl shadow-sm p-6 text-rose-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-sm font-semibold mb-2">Ditolak</p>
                <div class="flex items-center gap-3">
                    <div class="bg-rose-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $pengajuan->where('status', 'rejected')->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="border border-slate-200 bg-white rounded-2xl shadow-xs overflow-hidden mb-6">
            <div class="bg-gradient-to-l from-white to-emerald-100 px-6 py-4 border-b border-slate-200">
                <h2 class="text-xl font-bold text-emerald-700 flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter Pencarian
                </h2>
            </div>
            <div class="p-6">
                <form method="GET" action="{{ route('admin.arsip.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                        <!-- Search -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pencarian</label>
                            <input type="text" name="search" placeholder="Cari nomor, nama, email, HP..."
                                value="{{ request('search') }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-emerald-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 shadow-sm transition text-sm">
                        </div>

                        <!-- Jenis Surat -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Surat</label>
                            <select name="jenis_surat"
                                class="w-full px-4 py-2.5 rounded-xl border border-emerald-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 shadow-sm transition text-sm">
                                <option value="">Semua Jenis</option>
                                @foreach ($jenisSurat as $js)
                                    <option value="{{ $js->id }}"
                                        {{ request('jenis_surat') == $js->id ? 'selected' : '' }}>
                                        {{ $js->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status"
                                class="w-full px-4 py-2.5 rounded-xl border border-emerald-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 shadow-sm transition text-sm">
                                <option value="">Semua Status</option>
                                <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>
                                    Diajukan</option>
                                <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>
                                    Diverifikasi</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                    Ditandatangani
                                </option>
                                <option value="notified" {{ request('status') == 'notified' ? 'selected' : '' }}>
                                    Dinotifikasi</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>

                        <!-- Tanggal Dari -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dari</label>
                            <input type="date" name="tanggal_dari"
                                value="{{ request('tanggal_dari', date('Y-m-d')) }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-emerald-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 shadow-sm transition text-sm">
                        </div>

                        <!-- Tanggal Sampai -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Sampai</label>
                            <input type="date" name="tanggal_sampai"
                                value="{{ request('tanggal_sampai', date('Y-m-d')) }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-emerald-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 shadow-sm transition text-sm">
                        </div>
                    </div>

                    <div class="flex gap-3 mt-4">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>
                        @if (request()->hasAny(['search', 'jenis_surat', 'status', 'tanggal_dari', 'tanggal_sampai']))
                            <a href="{{ route('admin.arsip.index') }}"
                                class="inline-flex items-center px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="border border-slate-200 bg-white rounded-2xl shadow-xs overflow-hidden">
            <div class="bg-gradient-to-l from-white to-emerald-100 px-6 py-4 border-b border-slate-200">
                <h2 class="text-xl font-bold text-emerald-700 flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Daftar Arsip Surat
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No.
                                Pengajuan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Pemohon</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Jenis
                                Surat</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pengajuan as $key => $item)
                            <tr class="hover:bg-emerald-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $pengajuan->firstItem() + $key }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $item->nomor_pengajuan }}
                                            </div>
                                            @if ($item->nomor_surat)
                                                <div class="text-xs text-emerald-600 font-semibold">
                                                    {{ $item->nomor_surat }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $item->nama_pemohon }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->email_pemohon }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->no_hp_pemohon }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">{{ $item->jenisSurat->nama }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @include('components.status-badge', ['status' => $item->status])
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $item->created_at->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="relative inline-block text-left">
                                        <button onclick="toggleDropdown({{ $item->id }})"
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-emerald-100 to-emerald-200 hover:from-emerald-200 hover:to-emerald-300 text-emerald-700 shadow-xs border border-emerald-300/70 hover:shadow-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>

                                        <div id="dropdown-{{ $item->id }}" class="dropdown-menu">
                                            <a href="{{ route('admin.arsip.show', $item->id) }}" class="dropdown-item">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <span class="font-semibold">Lihat Detail</span>
                                            </a>
                                            @if ($item->file_surat_cetak)
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ route('admin.arsip.download.cetak', $item->id) }}"
                                                    class="dropdown-item">
                                                    <svg class="w-4 h-4 text-green-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span class="font-semibold">Download Surat Belum TTD</span>
                                                </a>
                                            @endif
                                            @if ($item->file_surat_ttd)
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ route('admin.arsip.download-ttd', $item->id) }}"
                                                    class="dropdown-item">
                                                    <svg class="w-4 h-4 text-green-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span class="font-semibold">Download Surat TTD</span>
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <div
                                            class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6 shadow-inner">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak Ada Data Arsip</h3>
                                        <p class="text-gray-500 mb-6 max-w-md">
                                            Belum ada data arsip surat yang tersedia saat ini.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pengajuan->hasPages())
                <div class="py-1 px-4">
                    {{ $pengajuan->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Auto submit form when select changed
            $('select[name="jenis_surat"], select[name="status"]').change(function() {
                $(this).closest('form').submit();
            });
        });
    </script>

    @push('scripts')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script>
            let timeout = null;

            document.getElementById('searchInput')?.addEventListener('input', function() {
                clearTimeout(timeout);
                const value = this.value;

                timeout = setTimeout(() => {
                    const params = new URLSearchParams(window.location.search);

                    if (value) {
                        params.set('search', value);
                        params.delete('page');
                    } else {
                        params.delete('search');
                    }

                    window.location.search = params.toString();
                }, 400);
            });
        </script>

        <script>
            // Dropdown Toggle Function with dynamic positioning
            function toggleDropdown(id) {
                const dropdown = document.getElementById(`dropdown-${id}`);
                const allDropdowns = document.querySelectorAll('.dropdown-menu');
                const button = event.currentTarget;

                // Close all other dropdowns
                allDropdowns.forEach(menu => {
                    if (menu.id !== `dropdown-${id}`) {
                        menu.classList.remove('show');
                    }
                });

                // Toggle current dropdown
                const isShowing = dropdown.classList.contains('show');

                if (!isShowing) {
                    // Show dropdown temporarily to get actual height
                    dropdown.style.visibility = 'hidden';
                    dropdown.style.display = 'block';
                    const dropdownHeight = dropdown.offsetHeight;
                    const dropdownWidth = dropdown.offsetWidth;
                    dropdown.style.display = '';
                    dropdown.style.visibility = '';

                    // Calculate position
                    const rect = button.getBoundingClientRect();
                    const spaceBelow = window.innerHeight - rect.bottom;
                    const spaceAbove = rect.top;

                    // Vertical position based on actual height
                    if (spaceBelow < dropdownHeight + 20 && spaceAbove > spaceBelow) {
                        // Show above if not enough space below
                        dropdown.style.top = (rect.top - dropdownHeight - 8) + 'px';
                    } else {
                        // Show below by default
                        dropdown.style.top = (rect.bottom + 8) + 'px';
                    }

                    // Horizontal position - align to the LEFT of button (ke kiri)
                    const spaceLeft = rect.left;

                    if (spaceLeft < dropdownWidth) {
                        // Not enough space on left, align to button's left edge
                        dropdown.style.left = rect.left + 'px';
                    } else {
                        // Align dropdown's right edge to button's left edge
                        dropdown.style.left = (rect.left - dropdownWidth + rect.width) + 'px';
                    }

                    dropdown.classList.add('show');
                } else {
                    dropdown.classList.remove('show');
                }
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.relative') && !event.target.closest('.dropdown-menu')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });

            // Reposition dropdown on scroll
            window.addEventListener('scroll', function() {
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                });
            }, true);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @endpush
