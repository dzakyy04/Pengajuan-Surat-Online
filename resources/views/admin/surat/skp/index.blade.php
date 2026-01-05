@extends('admin.layout.app')

@section('title', 'Kelola Pengajuan Surat Keterangan Penghasilan')

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwind.min.css">

    <style>
        .card-stats {
            transition: all 0.3s ease;
        }

        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .pagination a {
            @apply rounded-xl border border-emerald-200 px-4 py-2 text-sm;
        }

        .pagination .active span {
            @apply bg-emerald-600 text-white border-emerald-600;
        }

        /* Dropdown styles */
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

        /* Prevent table overflow from hiding dropdown */
        .table-wrapper {
            position: relative;
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
            <div class="flex flex-col md:flex-row items-center justify-between gap-2">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Kelola Pengajuan Surat</h1>
                    <p class="text-gray-600 mt-2">Surat Keterangan Penghasilan (SKP)</p>
                </div>
                <div class="flex gap-2 items-center flex-wrap">
                    <!-- Filter Tanggal -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">
                                @if (request()->get('start_date') && request()->get('end_date'))
                                    {{ \Carbon\Carbon::parse(request()->get('start_date'))->format('d/m/Y') }} -
                                    {{ \Carbon\Carbon::parse(request()->get('end_date'))->format('d/m/Y') }}
                                @else
                                    Hari Ini
                                @endif
                            </span>
                            <svg class="w-4 h-4 ml-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu Tanggal -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                            <form method="GET" action="{{ route('admin.skp.index') }}" class="p-4">
                                <input type="hidden" name="status" value="{{ request()->get('status') }}">
                                <input type="hidden" name="search" value="{{ request()->get('search') }}">

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                                        <input type="date" name="start_date"
                                            value="{{ request()->get('start_date', now()->format('Y-m-d')) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                                        <input type="date" name="end_date"
                                            value="{{ request()->get('end_date', now()->format('Y-m-d')) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    </div>

                                    <!-- Quick Filters -->
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 mb-2">Filter Cepat</p>
                                        <div class="grid grid-cols-2 gap-2">
                                            <button type="button" onclick="setDateRange('today')"
                                                class="px-3 py-1.5 text-xs bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                                                Hari Ini
                                            </button>
                                            <button type="button" onclick="setDateRange('yesterday')"
                                                class="px-3 py-1.5 text-xs bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                                                Kemarin
                                            </button>
                                            <button type="button" onclick="setDateRange('week')"
                                                class="px-3 py-1.5 text-xs bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                                                7 Hari Terakhir
                                            </button>
                                            <button type="button" onclick="setDateRange('month')"
                                                class="px-3 py-1.5 text-xs bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                                                30 Hari Terakhir
                                            </button>
                                        </div>
                                    </div>

                                    <div class="flex gap-2 pt-2">
                                        <button type="submit"
                                            class="flex-1 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition">
                                            Terapkan
                                        </button>
                                        <a href="{{ route('admin.skp.index', ['status' => request()->get('status')]) }}"
                                            class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition text-center">
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Filter Status -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">
                                @if (request()->get('status') == 'submitted')
                                    Diajukan
                                @elseif(request()->get('status') == 'verified')
                                    Diverifikasi
                                @elseif(request()->get('status') == 'approved')
                                    Ditandatangani
                                @elseif(request()->get('status') == 'notified')
                                    Diberitahukan
                                @elseif(request()->get('status') == 'rejected')
                                    Ditolak
                                @else
                                    Semua Status
                                @endif
                            </span>
                            <svg class="w-4 h-4 ml-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu Status -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                            <div class="py-1">
                                <a href="{{ route('admin.skp.index', array_filter(['start_date' => request()->get('start_date'), 'end_date' => request()->get('end_date')])) }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition {{ request()->get('status') == null ? 'bg-emerald-50 text-emerald-700 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Semua Status
                                </a>
                                <a href="{{ route('admin.skp.index', array_filter(['status' => 'submitted', 'start_date' => request()->get('start_date'), 'end_date' => request()->get('end_date')])) }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition {{ request()->get('status') == 'submitted' ? 'bg-yellow-50 text-yellow-700 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Diajukan
                                </a>
                                <a href="{{ route('admin.skp.index', array_filter(['status' => 'verified', 'start_date' => request()->get('start_date'), 'end_date' => request()->get('end_date')])) }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition {{ request()->get('status') == 'verified' ? 'bg-emerald-50 text-emerald-700 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Diverifikasi
                                </a>
                                <a href="{{ route('admin.skp.index', array_filter(['status' => 'approved', 'start_date' => request()->get('start_date'), 'end_date' => request()->get('end_date')])) }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition {{ request()->get('status') == 'approved' ? 'bg-purple-50 text-purple-700 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Ditandatangani
                                </a>
                                <a href="{{ route('admin.skp.index', array_filter(['status' => 'notified', 'start_date' => request()->get('start_date'), 'end_date' => request()->get('end_date')])) }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition {{ request()->get('status') == 'notified' ? 'bg-emerald-50 text-emerald-700 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Dinotifikasi
                                </a>
                                <a href="{{ route('admin.skp.index', array_filter(['status' => 'rejected', 'start_date' => request()->get('start_date'), 'end_date' => request()->get('end_date')])) }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition {{ request()->get('status') == 'rejected' ? 'bg-red-50 text-red-700 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Ditolak
                                </a>
                            </div>
                        </div>
                    </div>

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
                <p class="text-emerald-600 text-sm font-semibold mb-2">Total</p>
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $pengajuanList->total() }}</h3>
                </div>
            </div>

            <!-- Diajukan Card -->
            <div
                class="border border-orange-200 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl shadow-sm p-6 text-orange-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-orange-600 text-sm font-semibold mb-2">Diajukan</p>
                <div class="flex items-center gap-3">
                    <div class="bg-orange-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $submittedSkp }}</h3>
                </div>
            </div>

            <!-- Diverifikasi Card -->
            <div
                class="border border-blue-200 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-sm p-6 text-blue-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-blue-600 text-sm font-semibold mb-2">Diverifikasi</p>
                <div class="flex items-center gap-3">
                    <div class="bg-blue-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $verifiedSkp }}</h3>
                </div>
            </div>

            <!-- Ditandatangani Card -->
            <div
                class="border border-green-200 bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-sm p-6 text-green-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-green-600 text-sm font-semibold mb-2">Ditandatangani</p>
                <div class="flex items-center gap-3">
                    <div class="bg-green-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $approvedSkp }}</h3>
                </div>
            </div>

            <!-- Dinotifikasi Card -->
            <div
                class="border border-teal-200 bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl shadow-sm p-6 text-teal-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-teal-600 text-sm font-semibold mb-2">Dinotifikasi</p>
                <div class="flex items-center gap-3">
                    <div class="bg-teal-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $notifiedSkp }}</h3>
                </div>
            </div>

            <!-- Ditolak Card -->
            <div
                class="border border-rose-200 bg-gradient-to-br from-rose-50 to-rose-100 rounded-xl shadow-sm p-6 text-rose-600 hover:shadow-md transition-shadow duration-200">
                <p class="text-rose-600 text-sm font-semibold mb-2">Ditolak</p>
                <div class="flex items-center gap-3">
                    <div class="bg-rose-200 bg-opacity-40 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold">{{ $rejectedSkp }}</h3>
                </div>
            </div>
        </div>

        <!-- Table Card with DataTables -->
        <div class="border border-slate-200 bg-white rounded-2xl shadow-xs overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-l from-white to-emerald-100 px-6 py-4 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-emerald-700 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Daftar Pengajuan Surat Keterangan Penghasilan
                    </h2>
                    <input type="text" id="searchInput" value="{{ request('search') }}"
                        placeholder="Cari nama, nomor pengajuan, email..."
                        class="w-full md:w-80 px-4 py-2.5 rounded-xl border border-emerald-200
               focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300
               shadow-sm transition text-sm" />
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                No. Pengajuan
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Pemohon
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Kontak
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <!-- Ganti bagian tbody table Anda dengan kode ini -->

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pengajuanList as $pengajuan)
                            <tr class="hover:bg-emerald-50 transition">
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
                                            <div class="text-sm font-bold text-gray-900">{{ $pengajuan->nomor_pengajuan }}
                                            </div>
                                            @if ($pengajuan->nomor_surat)
                                                <div class="text-xs text-gray-500">{{ $pengajuan->nomor_surat }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $pengajuan->nama_pemohon }}</div>
                                    <div class="text-xs text-gray-500 flex items-center mt-1">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $pengajuan->email_pemohon }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center text-sm text-gray-900">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $pengajuan->no_hp_pemohon }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $pengajuan->created_at->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $pengajuan->created_at->format('H:i') }} WIB
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @include('components.status-badge', ['status' => $pengajuan->status])
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="relative inline-block text-left">
                                        <button onclick="toggleDropdown({{ $pengajuan->id }})"
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-emerald-100 to-emerald-200 hover:from-emerald-200 hover:to-emerald-300 text-emerald-700 shadow-xs border border-emerald-300/70 hover:shadow-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>

                                        <div id="dropdown-{{ $pengajuan->id }}" class="dropdown-menu">
                                            <!-- Lihat Detail - Selalu tampil untuk semua status -->
                                            <a href="{{ route('admin.skp.detail', $pengajuan->id) }}"
                                                class="dropdown-item">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <span class="font-semibold">Lihat Detail</span>
                                            </a>

                                            <!-- ========== STATUS: VERIFIED ========== -->
                                            @if ($pengajuan->status === 'verified')
                                                <div class="dropdown-divider"></div>

                                                <button onclick="openUploadModal({{ $pengajuan->id }})"
                                                    class="dropdown-item w-full text-left">
                                                    <svg class="w-4 h-4 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    <span class="font-semibold">Upload Surat TTD</span>
                                                </button>
                                            @endif

                                            <!-- ========== STATUS: APPROVED ========== -->
                                            @if ($pengajuan->status === 'approved')
                                                <div class="dropdown-divider"></div>

                                                @if (!empty($pengajuan->file_surat_ttd))
                                                    <!-- Download File TTD -->
                                                    <a href="{{ route('admin.skp.download-ttd', $pengajuan->id) }}"
                                                        class="dropdown-item">
                                                        <svg class="w-4 h-4 text-green-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        <span class="font-semibold">Download File TTD</span>
                                                    </a>

                                                    <!-- Re-upload File TTD -->
                                                    <button onclick="openUploadModal({{ $pengajuan->id }})"
                                                        class="dropdown-item w-full text-left">
                                                        <svg class="w-4 h-4 text-orange-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                        <span class="font-semibold">Re-upload File TTD</span>
                                                    </button>

                                                    <!-- Kirim Email Notifikasi -->
                                                    <button
                                                        onclick="openEmailModal({{ $pengajuan->id }}, '{{ $pengajuan->email_pemohon }}', '{{ $pengajuan->nama_pemohon }}')"
                                                        class="dropdown-item w-full text-left">
                                                        <svg class="w-4 h-4 text-green-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                        </svg>
                                                        <span class="font-semibold">Kirim Email</span>
                                                    </button>
                                                @else
                                                    <!-- Jika belum ada file TTD -->
                                                    <button onclick="openUploadModal({{ $pengajuan->id }})"
                                                        class="dropdown-item w-full text-left">
                                                        <svg class="w-4 h-4 text-blue-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                        </svg>
                                                        <span class="font-semibold">Upload Surat TTD</span>
                                                    </button>
                                                @endif
                                            @endif

                                            <!-- ========== STATUS: NOTIFIED ========== -->
                                            @if ($pengajuan->status === 'notified')
                                                <div class="dropdown-divider"></div>

                                                <!-- Download File TTD -->
                                                <a href="{{ route('admin.skp.download-ttd', $pengajuan->id) }}"
                                                    class="dropdown-item">
                                                    <svg class="w-4 h-4 text-green-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span class="font-semibold">Download File TTD</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- Empty State -->
                            <tr>
                                <td colspan="6" class="px-6 py-16">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <!-- Icon -->
                                        <div
                                            class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6 shadow-inner">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>

                                        <!-- Message -->
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                                            @if (request()->get('search'))
                                                Tidak Ada Hasil Pencarian
                                            @elseif(request()->get('status'))
                                                Tidak Ada Data dengan Status Ini
                                            @else
                                                Belum Ada Pengajuan Surat
                                            @endif
                                        </h3>

                                        <p class="text-gray-500 mb-6 max-w-md">
                                            @if (request()->get('search'))
                                                Pencarian untuk "<span
                                                    class="font-semibold text-gray-700">{{ request()->get('search') }}</span>"
                                                tidak ditemukan. Coba kata kunci lain atau hapus filter.
                                            @elseif(request()->get('status'))
                                                Tidak ada pengajuan dengan status
                                                <span class="font-semibold text-gray-700">
                                                    @if (request()->get('status') == 'submitted')
                                                        Diajukan
                                                    @elseif(request()->get('status') == 'verified')
                                                        Diverifikasi
                                                    @elseif(request()->get('status') == 'approved')
                                                        Ditandatangani
                                                    @elseif(request()->get('status') == 'notified')
                                                        Dinotifikasi
                                                    @elseif(request()->get('status') == 'rejected')
                                                        Ditolak
                                                    @endif
                                                </span>
                                                saat ini.
                                            @else
                                                Belum ada pengajuan surat keterangan domisili yang masuk ke sistem.
                                            @endif
                                        </p>

                                        <!-- Action Buttons -->
                                        @if (request()->get('search') || request()->get('status'))
                                            <div class="flex gap-3">
                                                @if (request()->get('search'))
                                                    <button
                                                        onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchInput').dispatchEvent(new Event('input'));"
                                                        class="inline-flex items-center px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition shadow-sm">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Hapus Pencarian
                                                    </button>
                                                @endif

                                                @if (request()->get('status'))
                                                    <a href="{{ route('admin.skp.index') }}"
                                                        class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition shadow-sm">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                        Tampilkan Semua
                                                    </a>
                                                @endif
                                            </div>
                                        @else
                                            <div
                                                class="inline-flex items-center px-5 py-2.5 bg-emerald-100 text-emerald-700 font-semibold rounded-xl">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Data akan muncul setelah ada pengajuan
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($pengajuanList->hasPages())
                <div class="py-1 px-4">
                    {{ $pengajuanList->links('pagination::tailwind') }}
                </div>
            @endif

        </div>
    </div>

    <!-- Modal Upload TTD -->
    <div id="uploadModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-brightness-50 backdrop-blur-sm">
        <div class="w-full max-w-md mx-auto bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold">Upload Surat Bertanda Tangan</h3>
                    <p class="text-xs text-blue-100">Upload file surat yang sudah ditandatangani</p>
                </div>
            </div>

            <form id="uploadForm" method="POST" enctype="multipart/form-data" class="px-6 py-5">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        File Surat (PDF/DOCX) <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="file_ttd" accept=".pdf,.docx" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <p class="text-xs text-gray-500 mt-1">Format: PDF atau DOCX, Maksimal: 5MB</p>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeUploadModal()"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition text-sm">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold shadow-lg hover:shadow-xl transition text-sm">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Kirim Email -->
    <div id="emailModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-brightness-50 backdrop-blur-sm modal-backdrop">
        <div class="w-full max-w-lg mx-4 bg-white rounded-3xl shadow-xl overflow-hidden modal-content">
            <div class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-green-600 to-green-500 text-white">
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold">Kirim Email Notifikasi</h3>
                    <p class="text-xs text-green-100">Konfirmasi pengiriman email ke pemohon</p>
                </div>
            </div>

            <form id="emailForm" method="POST" class="px-6 py-5">
                @csrf
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="flex-1">
                            <h4 class="font-semibold text-green-800 mb-2">Detail Pengiriman Email</h4>
                            <div class="space-y-2 text-sm text-green-700">
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <div>
                                        <span class="font-medium">Penerima:</span>
                                        <span id="emailRecipientName" class="font-semibold"></span>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <span class="font-medium">Email:</span>
                                        <span id="emailRecipientEmail"
                                            class="font-mono text-xs bg-green-100 px-2 py-0.5 rounded"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4">
                    <h5 class="font-semibold text-blue-800 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Isi Email
                    </h5>
                    <ul class="space-y-1.5 text-sm text-blue-700">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-blue-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Informasi pengajuan telah disetujui</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-blue-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>File PDF surat (lampiran)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-blue-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Instruksi pengambilan di kantor desa</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-5">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-sm text-amber-700">
                            Pastikan file surat sudah benar sebelum mengirim email.
                            Email hanya dapat dikirim <strong>satu kali</strong>.
                        </p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeEmailModal()"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition text-sm">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-bold shadow-lg hover:shadow-xl transition text-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Kirim Email
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwind.min.js"></script>

    <script>
        let timeout = null;

        document.getElementById('searchInput')?.addEventListener('input', function() {
            clearTimeout(timeout);
            const value = this.value;

            timeout = setTimeout(() => {
                const params = new URLSearchParams(window.location.search);

                if (value) {
                    params.set('search', value);
                    params.delete('page'); // reset ke page 1
                } else {
                    params.delete('search');
                }

                window.location.search = params.toString();
            }, 400); // debounce 400ms
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

        // Upload Modal Functions
        function openUploadModal(id) {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('uploadForm').action = `/admin/skp/${id}/upload-ttd`;

            // Close dropdown when opening modal
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }

        function closeUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('uploadModal')?.addEventListener('click', function(event) {
            if (event.target === this) {
                closeUploadModal();
            }
        });

        function openEmailModal(id, email, name) {
            document.getElementById('emailModal').classList.remove('hidden');
            document.getElementById('emailForm').action = `/admin/skp/${id}/send-notification`;
            document.getElementById('emailRecipientName').textContent = name;
            document.getElementById('emailRecipientEmail').textContent = email;

            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }

        function closeEmailModal() {
            document.getElementById('emailModal').classList.add('hidden');
        }

        document.getElementById('emailModal')?.addEventListener('click', function(event) {
            if (event.target === this) {
                closeEmailModal();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function setDateRange(type) {
            const today = new Date();
            let startDate, endDate;

            switch (type) {
                case 'today':
                    startDate = endDate = today;
                    break;
                case 'yesterday':
                    startDate = endDate = new Date(today.setDate(today.getDate() - 1));
                    break;
                case 'week':
                    endDate = new Date();
                    startDate = new Date(today.setDate(today.getDate() - 7));
                    break;
                case 'month':
                    endDate = new Date();
                    startDate = new Date(today.setDate(today.getDate() - 30));
                    break;
            }

            document.querySelector('input[name="start_date"]').value = formatDate(startDate);
            document.querySelector('input[name="end_date"]').value = formatDate(endDate);
        }

        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
    </script>
@endpush
