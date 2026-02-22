@extends('member.layout.wrapper')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-brand-pink to-pink-600 rounded-xl p-6 text-white">
        <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ session('nama') }}!</h2>
        <p class="text-pink-100">Portal member untuk mengelola lamaran kerja dan request quotation produk export Anda.</p>
    </div>

    <!-- Stats Grid - Lamaran -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Lamaran -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Lamaran</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_lamaran'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Lamaran kerja</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-briefcase text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Lamaran Baru -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Lamaran Baru</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['lamaran_baru'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Status: Baru</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Lamaran Diproses -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Diproses</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['lamaran_diproses'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Sedang diproses</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-spinner text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Lamaran Diterima -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Diterima</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['lamaran_diterima'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Lamaran diterima</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid - Quotation -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Quotation -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Request Quotation</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_quotation'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Request produk export</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-invoice text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Quotation Baru -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Quotation Baru</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['quotation_baru'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Belum dibaca</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-indigo-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Lamaran Terbaru -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Lamaran Terbaru</h3>
                    <a href="{{ url('member/lamaran') }}" class="text-sm text-brand-pink hover:underline">Lihat Semua</a>
                </div>
            </div>
            <div class="p-6">
                @if($lamaran_terbaru && $lamaran_terbaru->count() > 0)
                    <div class="space-y-4">
                        @foreach($lamaran_terbaru as $lamaran)
                        <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-brand-pink rounded-lg flex items-center justify-center text-white">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $lamaran->judul_loker }}</p>
                                <p class="text-xs text-gray-500 mt-1">Posisi: {{ $lamaran->posisi }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ date('d M Y', strtotime($lamaran->tanggal_pendaftaran)) }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                @if($lamaran->status_pendaftaran == 'Baru')
                                    <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Baru</span>
                                @elseif($lamaran->status_pendaftaran == 'Diterima')
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Diterima</span>
                                @elseif($lamaran->status_pendaftaran == 'Ditolak')
                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Ditolak</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">{{ $lamaran->status_pendaftaran }}</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500 text-sm">Belum ada lamaran</p>
                        <a href="{{ url('loker') }}" class="text-brand-pink hover:underline text-sm mt-2 inline-block">Lihat Lowongan</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quotation Terbaru -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Request Quotation Terbaru</h3>
                    <a href="{{ url('member/quotation') }}" class="text-sm text-brand-pink hover:underline">Lihat Semua</a>
                </div>
            </div>
            <div class="p-6">
                @if($quotation_terbaru && $quotation_terbaru->count() > 0)
                    <div class="space-y-4">
                        @foreach($quotation_terbaru as $quotation)
                        <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $quotation->produk_nama ?? $quotation->detail['produk'] ?? 'Produk' }}</p>
                                @if(isset($quotation->detail['quantity']) && $quotation->detail['quantity'] != '-')
                                <p class="text-xs text-gray-500 mt-1">Quantity: {{ $quotation->detail['quantity'] }}</p>
                                @endif
                                <p class="text-xs text-gray-400 mt-1">{{ date('d M Y', strtotime($quotation->tanggal_kontak)) }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                @if($quotation->status_kontak == 'Baru')
                                    <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Baru</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Dibaca</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500 text-sm">Belum ada request quotation</p>
                        <a href="{{ url('member/quotation/baru') }}" class="text-brand-pink hover:underline text-sm mt-2 inline-block">Buat Request Baru</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ url('loker') }}" target="_blank" class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                <i class="fas fa-search text-blue-600 text-xl"></i>
                <div>
                    <p class="font-semibold text-gray-900">Lihat Lowongan</p>
                    <p class="text-xs text-gray-500">Cari lowongan kerja</p>
                </div>
            </a>
            <a href="{{ url('member/quotation/baru') }}" class="flex items-center space-x-3 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                <i class="fas fa-plus-circle text-purple-600 text-xl"></i>
                <div>
                    <p class="font-semibold text-gray-900">Request Quotation</p>
                    <p class="text-xs text-gray-500">Request produk export</p>
                </div>
            </a>
            <a href="{{ url('member/profile') }}" class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                <i class="fas fa-user text-green-600 text-xl"></i>
                <div>
                    <p class="font-semibold text-gray-900">Edit Profil</p>
                    <p class="text-xs text-gray-500">Update data pribadi</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
