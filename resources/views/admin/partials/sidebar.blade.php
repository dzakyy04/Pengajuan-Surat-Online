<div id="overlay" class="fixed inset-0 backdrop-brightness-50 backdrop-blur-md bg-opacity-50 z-20 lg:hidden hidden">
</div>

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
            class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isDashboardActive ? 'bg-emerald-50 text-emerald-600 font-semibold' : 'text-gray-500' }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ $isDashboardActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span class="text-sm sidebar-text {{ $isDashboardActive ? 'font-semibold' : '' }}">Dashboard</span>
        </a>

        @php
            // Rute spesifik untuk Kelola Surat
            $isKelolaSuratActive =
                request()->routeIs('admin.sktm.*') ||
                request()->routeIs('admin.skp.*') ||
                request()->routeIs('admin.skd.*') ||
                request()->routeIs('admin.sku.*') ||
                request()->routeIs('admin.skmt.*');

            // Check if subsidebar should be open
            $isSubSidebarOpen = $isKelolaSuratActive;
        @endphp

        <!-- Kelola Surat dengan Subsidebar -->
        <div class="mb-1">
            <button type="button" onclick="toggleSubSidebar('kelolaSuratSub')"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isKelolaSuratActive ? 'bg-emerald-50 text-emerald-600' : 'text-gray-500' }}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ $isKelolaSuratActive ? 'text-emerald-600 font-semibold' : 'text-gray-400 group-hover:text-gray-600' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span
                        class="text-sm sidebar-text {{ $isKelolaSuratActive ? 'text-emerald-600 font-semibold' : 'text-gray-500 group-hover:text-gray-600' }}">Kelola
                        Surat</span>
                </div>
                <svg id="kelolaSuratSubIcon"
                    class="w-4 h-4 transition-transform duration-200 text-gray-400 {{ $isSubSidebarOpen ? 'rotate-180' : '' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Subsidebar dengan Garis Vertikal -->
            <div id="kelolaSuratSub"
                class="relative ml-8 mt-1 space-y-1 sidebar-text {{ $isSubSidebarOpen ? '' : 'hidden' }}">
                <!-- Garis Vertikal -->
                <div
                    class="absolute -left-2 top-4 bottom-4 w-0.5 bg-gradient-to-b from-emerald-300 via-emerald-400 to-emerald-500 rounded-full">
                </div>

                @php
                    $isSktmActive = request()->routeIs('admin.sktm.*');
                    $isSkpActive = request()->routeIs('admin.skp.*');
                    $isSkdActive = request()->routeIs('admin.skd.*');
                    $isSkuActive = request()->routeIs('admin.sku.*');
                    $isSkmtActive = request()->routeIs('admin.skmt.*');
                @endphp

                <!-- SKTM -->
                <a href="{{ route('admin.sktm.index') }}"
                    class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isSktmActive ? 'text-emerald-600' : 'text-gray-400' }}">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0 {{ $isSktmActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="text-xs {{ $isSktmActive ? 'font-semibold' : '' }}">Surat Keterangan Miskin</span>
                    </div>
                    @if (isset($pendingSktm) && $pendingSktm > 0)
                        <span
                            class="inline-flex items-center justify-center ml-2 w-5 h-5 text-xs font-bold leading-none text-white bg-amber-500 rounded-full">
                            {{ $pendingSktm }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.skd.index') }}"
                    class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isSkdActive ? 'text-emerald-600' : 'text-gray-400' }}">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0 {{ $isSkdActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="text-xs {{ $isSkdActive ? 'font-semibold' : '' }}">Surat Keterangan
                            Domisili</span>
                    </div>
                    @if (isset($pendingSkd) && $pendingSkd > 0)
                        <span
                            class="inline-flex items-center justify-center ml-2 w-5 h-5 text-xs font-bold leading-none text-white bg-amber-500 rounded-full">
                            {{ $pendingSkd }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.sku.index') }}"
                    class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isSkuActive ? 'text-emerald-600' : 'text-gray-400' }}">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0 {{ $isSkuActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="text-xs {{ $isSkuActive ? 'font-semibold' : '' }}">Surat Keterangan Usaha</span>
                    </div>
                    @if (isset($pendingSku) && $pendingSku > 0)
                        <span
                            class="inline-flex items-center justify-center ml-2 w-5 h-5 text-xs font-bold leading-none text-white bg-amber-500 rounded-full">
                            {{ $pendingSku }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.skp.index') }}"
                    class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isSkpActive ? 'text-emerald-600' : 'text-gray-400' }}">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0 {{ $isSkpActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="text-xs {{ $isSkpActive ? 'font-semibold' : '' }}">Surat Keterangan
                            Penghasilan</span>
                    </div>
                    @if (isset($pendingSkp) && $pendingSkp > 0)
                        <span
                            class="inline-flex items-center justify-center ml-2 w-5 h-5 text-xs font-bold leading-none text-white bg-amber-500 rounded-full">
                            {{ $pendingSkp }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.skmt.index') }}"
                    class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isSkmtActive ? 'text-emerald-600' : 'text-gray-400' }}">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0 {{ $isSkmtActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="text-xs {{ $isSkmtActive ? 'font-semibold' : '' }}">Surat Keterangan
                            Kematian</span>
                    </div>
                    @if (isset($pendingSkmt) && $pendingSkmt > 0)
                        <span
                            class="inline-flex items-center justify-center ml-2 w-5 h-5 text-xs font-bold leading-none text-white bg-amber-500 rounded-full">
                            {{ $pendingSkmt }}
                        </span>
                    @endif
                </a>
            </div>
        </div>

        @php
            $isArchiveActive =
                request()->routeIs('admin.arsip') ||
                request()->routeIs('admin.arsip.index') ||
                request()->routeIs('admin.arsip.show');
        @endphp
        <a href="{{ route('admin.arsip.index') }}"
            class="flex items-center px-3 py-2.5 mb-1 rounded-lg hover:bg-gray-50 transition-colors duration-200 group {{ $isArchiveActive ? 'bg-emerald-50 text-emerald-600 font-semibold' : 'text-gray-500' }}">

                                <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ $isArchiveActive ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
            <span class="text-sm sidebar-text {{ $isArchiveActive ? 'font-semibold' : '' }}">Arsip Data</span>
        </a>

    </nav>

    <!-- User Profile & Logout -->
    <div class="flex-shrink-0 px-4 py-4 border-t border-gray-200 bg-white">
        <div class="relative">
            <button type="button" onclick="toggleUserMenu()"
                class="w-full flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                <div class="flex items-center space-x-3">
                    <div class="relative flex-shrink-0">
                        <div
                            class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-600 to-green-700 flex items-center justify-center ring-2 ring-white">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>

                        <!-- Status Online -->
                        <span
                            class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>

                    <div class="flex-1 min-w-0 sidebar-text text-left">
                        @auth('admin')
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ auth('admin')->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth('admin')->user()->email }}</p>
                        @else
                            <p class="text-sm font-semibold text-gray-800 truncate">Guest User</p>
                            <p class="text-xs text-gray-500 truncate">guest@example.com</p>
                        @endauth
                    </div>
                </div>
                <svg class="w-4 h-4 text-gray-400 sidebar-text" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 9l4-4 4 4m0 6l-4 4-4-4">
                    </path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="userMenu"
                class="hidden absolute bottom-full left-0 right-0 mb-2 bg-white rounded-lg shadow-lg border border-gray-200 py-1">
                <a href="#"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
                <a href="#"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
                <div class="border-t border-gray-200 my-1"></div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Keluar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

<script>
    function toggleSubSidebar(id) {
        const element = document.getElementById(id);
        const icon = document.getElementById(id + 'Icon');

        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            element.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
    }

    // Close user menu when clicking outside
    document.addEventListener('click', function(event) {
        const userMenu = document.getElementById('userMenu');
        const userButton = event.target.closest('button[onclick="toggleUserMenu()"]');

        if (!userButton && !userMenu.contains(event.target)) {
            userMenu.classList.add('hidden');
        }
    });
</script>
