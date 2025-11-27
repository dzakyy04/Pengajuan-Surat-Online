@extends('layouts.app')

@section('title', 'Dashboard - HiveQ')

@section('content')
<!-- Welcome Section -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back, Wolf Pixel sdfsdfsd👋</h1>
    <p class="text-gray-600">Your Team's Success Starts Here. Let's Make Progress Together!</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card 1: Attendance -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow font-poppins">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">560</h3>
        <p class="text-sm text-gray-600 mb-3">Attendance</p>
        <a href="#" class="text-sm text-emerald-600 font-medium hover:text-emerald-700 inline-flex items-center group">
            View details
            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>

    <!-- Card 2: Total Leave -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">010</h3>
        <p class="text-sm text-gray-600 mb-3">Total Leave</p>
        <a href="#" class="text-sm text-blue-600 font-medium hover:text-blue-700 inline-flex items-center group">
            View details
            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>

    <!-- Card 3: Leave Apply -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">40</h3>
        <p class="text-sm text-gray-600 mb-3">Leave Apply</p>
        <a href="#" class="text-sm text-orange-600 font-medium hover:text-orange-700 inline-flex items-center group">
            View details
            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>


<!-- Bottom Section - Top Performers & Job Applications -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
    <!-- Top Performers -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900">Top Performers</h2>
            <div class="flex space-x-1 text-xs">
                <button class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg font-medium">1d</button>
                <button class="px-3 py-1.5 hover:bg-gray-50 text-gray-600 rounded-lg">7d</button>
                <button class="px-3 py-1.5 hover:bg-gray-50 text-gray-600 rounded-lg">1y</button>
                <button class="px-3 py-1.5 hover:bg-gray-50 text-gray-600 rounded-lg">All</button>
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="flex items-center space-x-3">
                    <img src="https://ui-avatars.com/api/?name=Rainer+Brown&background=0D9488&color=fff" class="w-10 h-10 rounded-full" alt="">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Rainer Brown</p>
                        <p class="text-xs text-gray-500">Rainerbrown@mail.com</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>

            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="flex items-center space-x-3">
                    <img src="https://ui-avatars.com/api/?name=Conny+Rany&background=3B82F6&color=fff" class="w-10 h-10 rounded-full" alt="">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Conny Rany</p>
                        <p class="text-xs text-gray-500">connyrany@mail.com</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>

            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="flex items-center space-x-3">
                    <img src="https://ui-avatars.com/api/?name=Armin+Falcon&background=8B5CF6&color=fff" class="w-10 h-10 rounded-full" alt="">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Armin Falcon</p>
                        <p class="text-xs text-gray-500">armincon@mail.com</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Job Applications -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-lg font-bold text-gray-900">Job Applications</h2>
            </div>
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <span class="font-semibold text-gray-900">265</span>
                <span>Interviews</span>
                <span>•</span>
                <span class="font-semibold text-gray-900">101</span>
                <span>Hired</span>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="mb-6">
            <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-emerald-500 to-blue-500" style="width: 72%"></div>
            </div>
        </div>

        <!-- Upcoming Interviews -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Upcoming Interviews</h3>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-pink-50 border border-pink-100 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-pink-200 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Alex Sullivan</p>
                            <p class="text-xs text-gray-500">alexsullivan@mail.com</p>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
