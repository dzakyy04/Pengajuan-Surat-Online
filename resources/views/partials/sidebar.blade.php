<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden hidden"></div>

<aside id="sidebar"
    class="fixed lg:static inset-y-0 left-0 z-30 sidebar-expanded bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out flex flex-col shadow-sm">
    <div class="flex items-center px-6 h-16 border-b border-gray-200 flex-shrink-0">
        <div class="flex items-center">
            <div class="w-12 h-12 flex items-center justify-center">
                <img src="{{ asset('assets/img/banyuasin.png') }}" alt="Logo Desa Sungai Rebo"
                    class="w-full h-full object-contain p-1.5">
            </div>
            <h1 class="text-base font-bold text-emerald-700 sidebar-text ml-2">DESA SUNGAI REBO</h1>
        </div>
        <button class="lg:hidden ml-auto text-gray-500 hover:text-gray-700 sidebar-text">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
    </div>

    <div class="px-4 py-2 flex-shrink-0">
    </div>

    <div class="px-6 py-2 flex-shrink-0 sidebar-text">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Main Menu</p>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 scrollbar-hide">

        @php
            // Rute spesifik untuk Dashboard
            $isDashboardActive =
                request()->routeIs('dashboard.welcome') ||
                request()->routeIs('user.dashboard') ||
                request()->routeIs('admin.dashboard');
        @endphp
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isDashboardActive ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700' }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ $isDashboardActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span class="font-medium text-sm sidebar-text">Dashboard</span>
        </a>

        {{-- @php
            // Rute spesifik untuk Pengajuan
            $isPengajuanActive = request()->routeIs('user.pengajuan.create') ||
                                 request()->routeIs('user.pengajuan.store') ||
                                 request()->routeIs('user.pengajuan.show') ||
                                 request()->routeIs('admin.pengajuan.index') ||
                                 request()->routeIs('admin.pengajuan.show') ||
                                 request()->routeIs('admin.pengajuan.approve') ||
                                 request()->routeIs('admin.pengajuan.reject');
        @endphp --}}
        {{-- <a href="{{ auth()->user() && auth()->user()->isAdmin() ? route('admin.pengajuan.index') : route('user.pengajuan.create') }}"
            class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isPengajuanActive ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700' }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ $isPengajuanActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                </path>
            </svg>
            <span class="font-medium text-sm sidebar-text">Pengajuan</span>
        </a> --}}

        <a href="#"
            class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-gray-700 group">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                </path>
            </svg>
            <span class="font-medium text-sm sidebar-text">Notes</span>
        </a>

        <a href="#"
            class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-gray-700 group">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                </path>
            </svg>
            <span class="font-medium text-sm sidebar-text">Email</span>
        </a>

        <a href="#"
            class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-gray-700 group">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="font-medium text-sm sidebar-text">Calendar</span>
        </a>

        <div class="my-4 border-t border-gray-200 sidebar-text"></div>

        <div class="px-3 py-2 sidebar-text">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Administration</p>
        </div>

        @if (auth()->check() && auth()->user()->isAdmin())
            @php
                // Rute spesifik untuk TTD Pejabat
                $isTtdActive =
                    request()->routeIs('admin.ttd.index') ||
                    request()->routeIs('admin.ttd.create') ||
                    request()->routeIs('admin.ttd.store') ||
                    request()->routeIs('admin.ttd.edit') ||
                    request()->routeIs('admin.ttd.update') ||
                    request()->routeIs('admin.ttd.destroy') ||
                    request()->routeIs('admin.ttd.toggle');
            @endphp
            <a href="{{ route('admin.ttd.index') }}"
                class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isTtdActive ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700' }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ $isTtdActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <span class="font-medium text-sm sidebar-text">TTD Pejabat</span>
            </a>
        @endif

        <a href="#"
            class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-gray-700 group">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
            <span class="font-medium text-sm sidebar-text">Contacts</span>
        </a>

        <a href="#"
            class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-gray-700 group">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            <span class="font-medium text-sm sidebar-text">Invite Team</span>
        </a>

    </nav>

    <div class="flex-shrink-0 px-4 py-4 border-t border-gray-200 bg-white">
        <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
            <div class="flex items-center space-x-3">
                <div class="relative flex-shrink-0">
                    <img src="https://ui-avatars.com/api/?name=Wolf+Pixel&background=0D9488&color=fff" alt="User"
                        class="w-9 h-9 rounded-full ring-2 ring-white">
                    <span
                        class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></span>
                </div>
                <div class="flex-1 min-w-0 sidebar-text">
                    <p class="text-sm font-semibold text-gray-800 truncate">Wolf Pixel</p>
                    <p class="text-xs text-gray-500 truncate">Workspace</p>
                </div>
            </div>
            <svg class="w-4 h-4 text-gray-400 sidebar-text" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4">
                </path>
            </svg>
        </div>
    </div>
</aside>
