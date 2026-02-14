@extends('admin.v2.layout.wrapper')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-brand-pink to-pink-600 rounded-xl p-6 text-white">
        <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ session('nama') }}!</h2>
        <p class="text-pink-100">Ini adalah dashboard admin versi 2. Kelola konten website Anda dari sini.</p>
    </div>

    <!-- Stats Grid - Utama -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Product -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Product</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['product'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Produk</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Loker -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Loker</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['loker'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Lowongan</p>
                </div>
                <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-briefcase text-teal-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pelamar -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Pelamar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['pelamar'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Pendaftar</p>
                </div>
                <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-check text-cyan-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Industri -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Industri</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['industri'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Industri</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-industry text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- More Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Video -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Video</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['video'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Video</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-video text-red-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Staff -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Staff</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['staff'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Orang</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-indigo-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Berita -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Berita</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['berita'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Artikel</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Kontak Baru -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Kontak Baru</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['kontak'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Pesan</p>
                </div>
                <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-pink-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ url('admin/berita/tambah') }}" class="flex items-center space-x-3 p-4 rounded-lg border border-gray-200 hover:border-brand-pink hover:bg-pink-50 transition">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus text-blue-600"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Tambah Berita</p>
                    <p class="text-xs text-gray-500">Buat artikel baru</p>
                </div>
            </a>
            <a href="{{ url('admin/loker/tambah') }}" class="flex items-center space-x-3 p-4 rounded-lg border border-gray-200 hover:border-brand-pink hover:bg-pink-50 transition">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus text-green-600"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Tambah Lowongan</p>
                    <p class="text-xs text-gray-500">Posting lowongan baru</p>
                </div>
            </a>
            <a href="{{ url('admin/kontak') }}" class="flex items-center space-x-3 p-4 rounded-lg border border-gray-200 hover:border-brand-pink hover:bg-pink-50 transition">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-purple-600"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Lihat Kontak</p>
                    <p class="text-xs text-gray-500">{{ $stats['kontak'] ?? 0 }} pesan baru</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
