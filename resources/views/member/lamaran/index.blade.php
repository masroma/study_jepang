@extends('member.layout.wrapper')

@section('page-title', 'Lamaran Saya')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Lamaran Saya</h2>
            <p class="text-sm text-gray-500 mt-1">Daftar semua lamaran kerja yang telah Anda kirim</p>
        </div>
        <a href="{{ url('loker') }}" target="_blank" class="flex items-center space-x-2 px-4 py-2 bg-brand-pink text-white rounded-lg hover:bg-pink-600 transition">
            <i class="fas fa-search"></i>
            <span>Cari Lowongan</span>
        </a>
    </div>

    <!-- Filter Status -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <div class="flex items-center space-x-2 overflow-x-auto">
            <span class="text-sm font-medium text-gray-700 whitespace-nowrap">Filter Status:</span>
            <a href="{{ url('member/lamaran') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap {{ $current_status == 'all' ? 'bg-brand-pink text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua
            </a>
            <a href="{{ url('member/lamaran?status=Baru') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap {{ $current_status == 'Baru' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Baru
            </a>
            <a href="{{ url('member/lamaran?status=Diproses') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap {{ $current_status == 'Diproses' ? 'bg-orange-100 text-orange-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Diproses
            </a>
            <a href="{{ url('member/lamaran?status=Diterima') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap {{ $current_status == 'Diterima' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Diterima
            </a>
            <a href="{{ url('member/lamaran?status=Ditolak') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap {{ $current_status == 'Ditolak' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Ditolak
            </a>
        </div>
    </div>

    <!-- List Lamaran -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        @if($lamaran && $lamaran->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($lamaran as $item)
                <div class="p-6 hover:bg-gray-50 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-brand-pink rounded-lg flex items-center justify-center text-white">
                                        <i class="fas fa-briefcase text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->judul_loker }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <i class="fas fa-user-tie mr-2"></i>
                                        Posisi: {{ $item->posisi }}
                                    </p>
                                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                                        <span>
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ date('d M Y', strtotime($item->tanggal_pendaftaran)) }}
                                        </span>
                                        @if($item->cv_file)
                                        <span>
                                            <i class="fas fa-file-pdf mr-1"></i>
                                            CV Terlampir
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 ml-4">
                            <div class="text-right">
                                @if($item->status_pendaftaran == 'Baru')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Baru
                                    </span>
                                @elseif($item->status_pendaftaran == 'Diproses')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        <i class="fas fa-spinner mr-1"></i>
                                        Diproses
                                    </span>
                                @elseif($item->status_pendaftaran == 'Diterima')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Diterima
                                    </span>
                                @elseif($item->status_pendaftaran == 'Ditolak')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $item->status_pendaftaran }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ url('member/lamaran/detail/' . $item->id_pendaftaran) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($lamaran->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $lamaran->firstItem() }} sampai {{ $lamaran->lastItem() }} dari {{ $lamaran->total() }} lamaran
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($lamaran->onFirstPage())
                            <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed text-sm">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $lamaran->previousPageUrl() }}" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        @foreach($lamaran->getUrlRange(1, $lamaran->lastPage()) as $page => $url)
                            @if($page == $lamaran->currentPage())
                                <span class="px-3 py-2 bg-brand-pink text-white rounded-lg text-sm font-medium">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($lamaran->hasMorePages())
                            <a href="{{ $lamaran->nextPageUrl() }}" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed text-sm">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @else
            <div class="p-12 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-inbox text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Lamaran</h3>
                <p class="text-sm text-gray-500 mb-6">
                    @if($current_status != 'all')
                        Tidak ada lamaran dengan status "{{ $current_status }}"
                    @else
                        Anda belum mengirim lamaran kerja. Mulai cari lowongan yang sesuai dengan Anda.
                    @endif
                </p>
                <a href="{{ url('loker') }}" target="_blank" class="inline-flex items-center space-x-2 px-6 py-3 bg-brand-pink text-white rounded-lg hover:bg-pink-600 transition">
                    <i class="fas fa-search"></i>
                    <span>Cari Lowongan Kerja</span>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
