<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-manrope">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('partials.header')

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('partials.footer')
        </div>
    </div>

    <!-- Toggle Sidebar Script (Pure JavaScript) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const overlay = document.getElementById('overlay');

            function toggleSidebar() {
                // Toggle collapsed state
                sidebar.classList.toggle('sidebar-collapsed');
                sidebar.classList.toggle('sidebar-expanded');

                // On mobile, show/hide sidebar completely
                if (window.innerWidth < 1024) {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                }
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }

            // Handle mobile on resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    overlay.classList.add('hidden');
                }
            });
        });
    </script>

    <!-- Sidebar Collapse Styles -->
    <style>
        /* Expanded State (Default) */
        .sidebar-expanded {
            width: 18rem;
            /* 288px */
        }

        /* Collapsed State */
        .sidebar-collapsed {
            width: 5rem;
            /* 80px */
        }

        /* Hide ALL text when collapsed */
        .sidebar-collapsed .sidebar-text {
            display: none !important;
        }

        /* Hide search placeholder when collapsed */
        .sidebar-collapsed .sidebar-search::placeholder {
            color: transparent;
        }

        /* Center logo when collapsed */
        .sidebar-collapsed .flex.items-center.px-6 {
            justify-content: center;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Adjust search bar padding when collapsed */
        .sidebar-collapsed .sidebar-search {
            padding-left: 2.5rem;
            padding-right: 0.5rem;
        }

        /* Center icons in nav items when collapsed */
        .sidebar-collapsed nav a,
        .sidebar-collapsed nav button {
            justify-content: center;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        /* Remove margin from icons when collapsed */
        .sidebar-collapsed nav a svg,
        .sidebar-collapsed nav button svg {
            margin-right: 0;
        }

        /* Center user profile when collapsed */
        .sidebar-collapsed .flex-shrink-0.px-4.py-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .sidebar-collapsed .flex-shrink-0.px-4.py-4>div {
            justify-content: center;
        }

        /* Mobile - Always hide sidebar off-screen */
        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar:not(.-translate-x-full) {
                transform: translateX(0);
            }
        }

        /* Desktop - Smooth transition */
        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0) !important;
            }
        }

        /* Hide scrollbar but keep functionality */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Smooth transitions for all changes */
        #sidebar * {
            transition: all 0.3s ease-in-out;
        }
    </style>
</body>

</html>
