@extends('admin.layout.app')

@section('title', 'Dashboard Pengajuan Surat')

@section('content')

    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">
            Dashboard Pengajuan Surat
        </h1>
        <p class="text-gray-600">
            Ringkasan aktivitas dan status pengajuan surat masyarakat hari ini.
        </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-4">

        <div class="col-span-1">
            <div
                class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl shadow-xl p-6 text-white hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] relative overflow-hidden h-full">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-1">{{ $totalPengajuan }}</h3>
                    <p class="text-sm text-blue-100 font-semibold">Total Pengajuan</p>
                    <span class="text-xs text-blue-100 opacity-80 mt-2 block">
                        Data bulan ini
                    </span>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div
                class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-3xl shadow-xl p-6 text-white hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] h-full">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-bold mb-1">{{ $sedangDiproses }}</h3>
                <p class="text-sm text-orange-100 font-semibold">Sedang Diproses</p>
                <span class="text-xs text-orange-100 opacity-80 mt-2 block">
                    Menunggu proses
                </span>
            </div>
        </div>

        <div class="col-span-1">
            <div
                class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-3xl shadow-xl p-6 text-white hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] h-full">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <h3 class="text-4xl font-bold mb-1">{{ $diverifikasi }}</h3>
                <p class="text-sm text-yellow-100 font-semibold">Diverifikasi</p>
                <span class="text-xs text-yellow-100 opacity-80 mt-2 block">
                    Sudah diverifikasi
                </span>
            </div>
        </div>

        <div class="col-span-1">
            <div
                class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-3xl shadow-xl p-6 text-white hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] h-full">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-bold mb-1">{{ $disetujui }}</h3>
                <p class="text-sm text-emerald-100 font-semibold">Disetujui</p>
                <span class="text-xs text-emerald-100 opacity-80 mt-2 block">
                    Surat diterbitkan
                </span>
            </div>
        </div>

        <div class="col-span-1">
            <div
                class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-3xl shadow-xl p-6 text-white hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] h-full">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-bold mb-1">{{ $diberitakan }}</h3>
                <p class="text-sm text-emerald-100 font-semibold">Diberitahu</p>
                <span class="text-xs text-emerald-100 opacity-80 mt-2 block">
                    Surat Dinotifikasikan
                </span>
            </div>
        </div>

        <div class="col-span-1">
            <div
                class="bg-gradient-to-br from-red-500 to-red-600 rounded-3xl shadow-xl p-6 text-white hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] h-full">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-bold mb-1">{{ $ditolak }}</h3>
                <p class="text-sm text-red-100 font-semibold">Ditolak</p>
                <span class="text-xs text-red-100 opacity-80 mt-2 block">
                    Tidak memenuhi
                </span>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-12 gap-4 mb-4">

        <div class="col-span-12 lg:col-span-4">
            <div
                class="bg-white rounded-3xl shadow-xs border border-slate-300/70 p-5 hover:shadow-md transition-all duration-300 h-full">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-900">
                        Trend 7 Hari Terakhir
                    </h2>
                </div>
                <div class="h-[240px]">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-3">
            <div
                class="bg-white rounded-3xl shadow-xs border border-slate-300/70 p-5 hover:shadow-md transition-all duration-300 h-full">
                <h2 class="text-lg font-bold text-gray-900 mb-4">
                    Status
                </h2>
                <div class="h-[240px]">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-5">
            <div
                class="bg-white rounded-3xl shadow-xs border border-slate-300/70 p-5 hover:shadow-md transition-all duration-300 h-full">
                <h2 class="text-lg font-bold text-gray-900 mb-4">
                    Progress Layanan
                </h2>

                <div class="space-y-3 max-h-[240px] overflow-y-auto custom-scrollbar pr-2">
                    @forelse($progressPerJenis as $progress)
                        <div
                            class="bg-white rounded-xl p-3 border border-gray-100 hover:border-emerald-200 transition-all duration-300 hover:shadow-sm">
                            <div class="flex justify-between items-center mb-1.5">
                                <span
                                    class="text-xs font-semibold text-gray-700 truncate pr-2">{{ Str::limit($progress['nama'], 30) }}</span>
                                <span class="text-xs font-bold text-emerald-600">{{ $progress['persentase'] }}%</span>
                            </div>
                            <div class="h-2 bg-gray-100 rounded-full overflow-hidden mb-1.5">
                                <div class="h-full rounded-full transition-all duration-500
                            @if ($progress['persentase'] >= 70) bg-gradient-to-r from-emerald-400 to-emerald-600
                            @elseif($progress['persentase'] >= 40) bg-gradient-to-r from-blue-400 to-blue-600
                            @else bg-gradient-to-r from-yellow-400 to-yellow-600 @endif"
                                    style="width: {{ $progress['persentase'] }}%">
                                </div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>✓ {{ $progress['approved'] }}</span>
                                <span>{{ $progress['total'] }} total</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400">
                            <p class="text-sm">Belum ada data</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-12 gap-4">

        <div class="col-span-12 lg:col-span-5">
            <div
                class="bg-white rounded-3xl shadow-xl border border-slate-300/70 p-5 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-900">
                        Pengajuan Terbaru
                    </h2>
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                </div>

                <div class="space-y-2.5 max-h-[220px] overflow-y-auto custom-scrollbar pr-2">
                    @forelse($pengajuanTerbaru as $pengajuan)
                        <div
                            class="flex items-center justify-between p-3.5 bg-white hover:bg-gradient-to-r hover:from-white hover:to-emerald-50 rounded-2xl transition-all duration-300 border border-gray-100 hover:border-emerald-200 hover:shadow-md group">
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-sm font-semibold text-gray-900 group-hover:text-emerald-700 transition-colors truncate">
                                    {{ $pengajuan->jenisSurat->nama ?? 'Unknown' }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $pengajuan->nama_pemohon }} • {{ $pengajuan->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <span
                                class="px-3 py-1.5 text-xs rounded-xl font-semibold whitespace-nowrap ml-3 flex-shrink-0
                        @if ($pengajuan->status == 'submitted') bg-orange-100 text-orange-700
                        @elseif($pengajuan->status == 'verified') bg-yellow-100 text-yellow-700
                        @elseif($pengajuan->status == 'approved') bg-emerald-100 text-emerald-700
                        @elseif($pengajuan->status == 'notified') bg-indigo-100 text-indigo-700
                        @elseif($pengajuan->status == 'rejected') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700 @endif">
                                @if ($pengajuan->status == 'submitted')
                                    Diajukan
                                @elseif($pengajuan->status == 'verified')
                                    Diverifikasi
                                @elseif($pengajuan->status == 'approved')
                                    Disetujui
                                @elseif($pengajuan->status == 'notified')
                                    Diberitahu
                                @elseif($pengajuan->status == 'rejected')
                                    Ditolak
                                @else
                                    {{ ucfirst($pengajuan->status) }}
                                @endif
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="font-medium text-sm">Belum ada pengajuan surat</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-7">
            <div
                class="bg-white rounded-3xl shadow-xs border border-slate-300/70 p-5 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-900">
                        Per Jenis Surat
                    </h2>
                    <span class="px-3 py-1.5 bg-white text-emerald-600 text-xs font-semibold rounded-xl shadow-sm">
                        {{ $statistikPerJenis->sum('total') }} Total
                    </span>
                </div>
                <div class="h-[220px] bg-white rounded-2xl p-3">
                    <canvas id="jenisChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .grid>div {
            animation: fadeInUp 0.4s ease-out;
        }

        canvas {
            display: block;
        }
    </style>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Chart Trend 7 Hari
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($statistik7Hari, 'tanggal')) !!},
                datasets: [{
                    label: 'Jumlah Pengajuan',
                    data: {!! json_encode(array_column($statistik7Hari, 'jumlah')) !!},
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: 'rgb(16, 185, 129)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverBackgroundColor: 'rgb(16, 185, 129)',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.9)',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(16, 185, 129, 0.5)',
                        borderWidth: 2,
                        cornerRadius: 10,
                        displayColors: false,
                        titleFont: {
                            size: 13,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Status
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Diajukan', 'Diverifikasi', 'Disetujui', 'Diberitahu', 'Ditolak'],
                datasets: [{
                    data: [
                        {{ $statistikStatus['submitted'] }},
                        {{ $statistikStatus['verified'] }},
                        {{ $statistikStatus['approved'] }},
                        {{ $statistikStatus['notified'] }},
                        {{ $statistikStatus['rejected'] }}
                    ],
                    backgroundColor: [
                        'rgb(250, 87, 0)',
                        'rgb(222, 152, 0)',
                        'rgb(0, 168, 112)',
                        'rgb(91, 82, 250)',
                        'rgb(242, 19, 38)'
                    ],
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 12,
                            font: {
                                size: 10,
                                weight: '500'
                            },
                            usePointStyle: true,
                            pointStyle: 'circle',
                            boxWidth: 8
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.9)',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 2,
                        cornerRadius: 10,
                        displayColors: true,
                        titleFont: {
                            size: 13,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        }
                    }
                }
            }
        });

        // Chart Per Jenis Surat
        const jenisCtx = document.getElementById('jenisChart').getContext('2d');
        new Chart(jenisCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($statistikPerJenis->pluck('nama')) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode($statistikPerJenis->pluck('total')) !!},
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.9)',
                        'rgba(16, 185, 129, 0.9)',
                        'rgba(251, 146, 60, 0.9)',
                        'rgba(168, 85, 247, 0.9)',
                        'rgba(236, 72, 153, 0.9)',
                        'rgba(59, 130, 246, 0.9)'
                    ],
                    borderColor: [
                        'rgb(99, 102, 241)',
                        'rgb(16, 185, 129)',
                        'rgb(251, 146, 60)',
                        'rgb(168, 85, 247)',
                        'rgb(236, 72, 153)',
                        'rgb(59, 130, 246)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.9)',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 2,
                        cornerRadius: 10,
                        displayColors: false,
                        titleFont: {
                            size: 13,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 9
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endpush
