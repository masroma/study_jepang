@extends('member.layout.wrapper')

@section('page-title', 'Request Quotation')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Request Quotation Saya</h2>
            <p class="text-sm text-gray-500 mt-1">Daftar semua request quotation produk export yang telah Anda kirim</p>
        </div>
        <a href="{{ url('member/quotation/baru') }}" class="flex items-center space-x-2 px-4 py-2 bg-brand-pink text-white rounded-lg hover:bg-pink-600 transition">
            <i class="fas fa-plus-circle"></i>
            <span>Request Baru</span>
        </a>
    </div>

    <!-- Filter Status -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <div class="flex items-center space-x-2 overflow-x-auto">
            <span class="text-sm font-medium text-gray-700 whitespace-nowrap">Filter Status:</span>
            <a href="{{ url('member/quotation') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap {{ $current_status == 'all' ? 'bg-brand-pink text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua
            </a>
            <a href="{{ url('member/quotation?status=Baru') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap {{ $current_status == 'Baru' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Baru
            </a>
            <a href="{{ url('member/quotation?status=Dibaca') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap {{ $current_status == 'Dibaca' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Dibaca
            </a>
            <a href="{{ url('member/quotation?status=Ditanggapi') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap {{ $current_status == 'Ditanggapi' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Ditanggapi
            </a>
        </div>
    </div>

    <!-- List Quotation -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        @if($quotations && $quotations->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($quotations as $item)
                <div class="p-6 hover:bg-gray-50 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600">
                                        <i class="fas fa-file-invoice text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->produk_nama ?? 'Request Quotation' }}</h3>
                                    <div class="space-y-1 mb-2">
                                        @if(isset($item->detail['perusahaan']) && $item->detail['perusahaan'] != '-')
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-building mr-2"></i>
                                            Perusahaan: {{ $item->detail['perusahaan'] }}
                                        </p>
                                        @endif
                                        @if(isset($item->detail['produk']) && $item->detail['produk'] != '-')
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-box mr-2"></i>
                                            Produk: {{ $item->detail['produk'] }}
                                        </p>
                                        @endif
                                        @if(isset($item->detail['quantity']) && $item->detail['quantity'] != '-')
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-hashtag mr-2"></i>
                                            Quantity: {{ $item->detail['quantity'] }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                                        <span>
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ date('d M Y', strtotime($item->tanggal_kontak)) }}
                                        </span>
                                        @if(isset($item->detail['kebutuhan']) && $item->detail['kebutuhan'] != '-' && strlen($item->detail['kebutuhan']) > 0)
                                        <span>
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Ada Kebutuhan
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 ml-4">
                            <div class="text-right">
                                @if($item->status_kontak == 'Baru')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Baru
                                    </span>
                                @elseif($item->status_kontak == 'Dibaca')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-eye mr-1"></i>
                                        Dibaca
                                    </span>
                                @elseif($item->status_kontak == 'Ditanggapi')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Ditanggapi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $item->status_kontak }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ url('member/quotation/detail/' . $item->id_kontak) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($quotations->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $quotations->firstItem() }} sampai {{ $quotations->lastItem() }} dari {{ $quotations->total() }} request quotation
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($quotations->onFirstPage())
                            <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed text-sm">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $quotations->previousPageUrl() }}" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        @foreach($quotations->getUrlRange(1, $quotations->lastPage()) as $page => $url)
                            @if($page == $quotations->currentPage())
                                <span class="px-3 py-2 bg-brand-pink text-white rounded-lg text-sm font-medium">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($quotations->hasMorePages())
                            <a href="{{ $quotations->nextPageUrl() }}" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm">
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
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Request Quotation</h3>
                <p class="text-sm text-gray-500 mb-6">
                    @if($current_status != 'all')
                        Tidak ada request quotation dengan status "{{ $current_status }}"
                    @else
                        Anda belum mengirim request quotation. Mulai request produk export yang Anda butuhkan.
                    @endif
                </p>
                <a href="{{ url('member/quotation/baru') }}" class="inline-flex items-center space-x-2 px-6 py-3 bg-brand-pink text-white rounded-lg hover:bg-pink-600 transition">
                    <i class="fas fa-plus-circle"></i>
                    <span>Buat Request Quotation Baru</span>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
