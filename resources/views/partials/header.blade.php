<header class="bg-white border-b border-gray-200 h-16 flex items-center px-6 sticky top-0 z-10">
    <div class="flex items-center justify-between w-full">
        <!-- Left: Hamburger Menu & Page Title -->
        <div class="flex items-center space-x-4">
            <!-- Hamburger Menu - Always Visible -->
            <button id="toggleSidebar" class="text-gray-600 hover:text-gray-900 focus:outline-none p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Page Title -->
            <div>
                <h2 class="text-xl font-bold text-gray-800">Dashboard</h2>
            </div>
        </div>

        <!-- Right: User Actions -->
        {{-- <div class="flex items-center space-x-2">
            <!-- Date Range Picker -->
            <button class="hidden md:flex items-center space-x-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg border border-gray-200 transition-colors">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="font-medium">1 Nov - 7 Nov 2024</span>
            </button>

            <!-- Add New Button -->
            <button class="hidden md:flex items-center space-x-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add New</span>
            </button>

            <!-- User Avatars -->
            <div class="hidden md:flex items-center -space-x-2">
                <img src="https://ui-avatars.com/api/?name=User+1&background=3B82F6&color=fff" alt="User" class="w-8 h-8 rounded-full border-2 border-white">
                <img src="https://ui-avatars.com/api/?name=User+2&background=8B5CF6&color=fff" alt="User" class="w-8 h-8 rounded-full border-2 border-white">
                <img src="https://ui-avatars.com/api/?name=User+3&background=EC4899&color=fff" alt="User" class="w-8 h-8 rounded-full border-2 border-white">
                <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center">
                    <span class="text-xs font-semibold text-gray-600">+2</span>
                </div>
            </div>

            <!-- Messages -->
            <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg focus:outline-none transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </button>

            <!-- Notifications -->
            <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg focus:outline-none transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>

            <!-- Share Button -->
            <button class="hidden md:flex items-center space-x-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                </svg>
                <span class="font-medium">Share</span>
            </button>

            <!-- More Options -->
            <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg focus:outline-none transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                </svg>
            </button>
        </div> --}}
    </div>
</header>
