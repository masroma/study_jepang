<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $title ?? 'Portal Member')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Poppins", "sans-serif"],
                    },
                    colors: {
                        "brand-pink": "#FF2E93",
                        "brand-yellow": "#FFDE00",
                        "brand-blue": "#E0F2FE",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 px-4 border-b border-gray-100">
                <a href="{{ url('member/dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('template/img/logo.png') }}" alt="Logo" class="h-10 w-auto">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-gray-900">PORTAL MEMBER</span>
                        <span class="text-xs text-gray-500">{{ $site->nama_singkat ?? 'Study Jepang' }}</span>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-4 overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ url('member/dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->is('member/dashboard') ? 'bg-brand-pink text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fas fa-home w-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="pt-4">
                        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase">Lamaran Kerja</div>
                    </li>
                    <li>
                        <a href="{{ url('member/lamaran') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->is('member/lamaran*') ? 'bg-brand-pink text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fas fa-briefcase w-5"></i>
                            <span>Lamaran Saya</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('loker') }}" target="_blank" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                            <i class="fas fa-search w-5"></i>
                            <span>Lihat Lowongan</span>
                        </a>
                    </li>
                    <li class="pt-4">
                        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase">Product Export</div>
                    </li>
                    <li>
                        <a href="{{ url('member/quotation') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->is('member/quotation*') ? 'bg-brand-pink text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fas fa-file-invoice w-5"></i>
                            <span>Request Quotation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('member/quotation/baru') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->is('member/quotation/baru') ? 'bg-brand-pink text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fas fa-plus-circle w-5"></i>
                            <span>Request Baru</span>
                        </a>
                    </li>
                    <li class="pt-4">
                        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase">Mitra & Komisi</div>
                    </li>
                    <li>
                        <a href="{{ url('member/mitra/dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->is('member/mitra*') ? 'bg-brand-pink text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fas fa-handshake w-5"></i>
                            <span>Dashboard Mitra</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('member/mitra/referal') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->is('member/mitra/referal*') ? 'bg-brand-pink text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fas fa-users w-5"></i>
                            <span>List Referal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('member/mitra/withdraw') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->is('member/mitra/withdraw*') ? 'bg-brand-pink text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fas fa-money-bill-wave w-5"></i>
                            <span>Withdraw</span>
                        </a>
                    </li>
                    <li class="pt-4">
                        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase">Akun</div>
                    </li>
                    <li>
                        <a href="{{ url('member/profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->is('member/profile') ? 'bg-brand-pink text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fas fa-user w-5"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Dropdown -->
            <div class="px-4 py-4 border-t border-gray-100">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition focus:outline-none">
                        <div class="w-10 h-10 bg-brand-pink rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                            {{ strtoupper(substr(session('nama') ?? 'M', 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0 text-left">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ session('nama') ?? 'Member' }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ session('email') ?? session('username') ?? 'email' }}</p>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden z-50"
                         style="display: none;">
                        <a href="{{ url('member/profile') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                            <i class="fas fa-user w-5"></i>
                            <span>Edit Profile</span>
                        </a>
                        <a href="{{ url('member/password') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                            <i class="fas fa-lock w-5"></i>
                            <span>Ubah Password</span>
                        </a>
                        <div class="border-t border-gray-200"></div>
                        <a href="{{ url('login/logout') }}" onclick="return confirm('Yakin ingin logout?')" class="flex items-center space-x-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-40">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-4">
                    <button id="sidebar-toggle" class="lg:hidden text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/') }}" target="_blank" class="text-sm text-gray-600 hover:text-brand-pink transition">
                        <i class="fas fa-external-link-alt mr-2"></i>
                        Lihat Website
                    </a>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6">
            @if ($message = Session::get('sukses'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 text-sm flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ $message }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @if ($message = Session::get('warning'))
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg mb-6 text-sm flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span>{{ $message }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-yellow-600 hover:text-yellow-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 text-sm flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-times-circle mr-2"></i>
                    <span>{{ $message }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        document.getElementById('sidebar-toggle')?.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>
