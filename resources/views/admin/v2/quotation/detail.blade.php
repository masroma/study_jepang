@extends('admin.v2.layout.wrapper')

@section('page-title', 'Detail Request Quotation')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Detail Request Quotation</h2>
            <p class="text-sm text-gray-600 mt-1">Informasi lengkap request quotation produk</p>
        </div>
        <a href="{{ url('admin/v2/quotation') }}" class="px-4 py-2 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informasi Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Pribadi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user text-brand-pink mr-2"></i>
                    Data Pribadi
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <p class="text-gray-900 font-medium">{{ $quotation->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900">{{ $quotation->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Telepon</label>
                        <p class="text-gray-900">{{ $quotation->telepon }}</p>
                    </div>
                    @if($quotation->detail['perusahaan'])
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Perusahaan</label>
                        <p class="text-gray-900">{{ $quotation->detail['perusahaan'] }}</p>
                    </div>
                    @endif
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Request</label>
                        <p class="text-gray-900">{{ date('d F Y H:i', strtotime($quotation->tanggal_kontak)) }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Produk -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-box text-brand-pink mr-2"></i>
                    Informasi Produk
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Produk yang Diminati</label>
                        <p class="text-gray-900 font-medium">{{ $quotation->detail['produk'] }}</p>
                    </div>
                    @if($quotation->detail['quantity'])
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Quantity / Jumlah</label>
                        <p class="text-gray-900">{{ $quotation->detail['quantity'] }}</p>
                    </div>
                    @endif
                    @if($quotation->detail['kebutuhan'])
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kebutuhan Khusus / Spesifikasi</label>
                        <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                            {{ $quotation->detail['kebutuhan'] }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Pesan Tambahan -->
            @if($quotation->detail['pesan'])
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-comment text-brand-pink mr-2"></i>
                    Pesan Tambahan
                </h3>
                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                    {{ $quotation->detail['pesan'] }}
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                <div class="mb-4">
                    @if($quotation->status_kontak == 'Baru')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                            Baru
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                            Dibaca
                        </span>
                    @endif
                </div>
                <form method="POST" action="{{ url('admin/v2/quotation/update-status') }}">
                    @csrf
                    <input type="hidden" name="id_kontak" value="{{ $quotation->id_kontak }}">
                    <select name="status_kontak" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition mb-3">
                        <option value="Baru" {{ $quotation->status_kontak == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Dibaca" {{ $quotation->status_kontak == 'Dibaca' ? 'selected' : '' }}>Dibaca</option>
                    </select>
                    <button type="submit" class="w-full px-4 py-2 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                        <i class="fas fa-save mr-2"></i>
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Aksi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                <div class="space-y-2">
                    <a href="mailto:{{ $quotation->email }}?subject=Re: Request Quotation - {{ $quotation->detail['produk'] }}" 
                       class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center">
                        <i class="fas fa-envelope mr-2"></i>
                        Kirim Email
                    </a>
                    <a href="tel:{{ $quotation->telepon }}" 
                       class="w-full px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition flex items-center justify-center">
                        <i class="fas fa-phone mr-2"></i>
                        Hubungi via Telepon
                    </a>
                    <a href="{{ url('admin/v2/quotation/delete/' . $quotation->id_kontak) }}" 
                       onclick="return confirm('Yakin ingin menghapus request quotation ini?')" 
                       class="w-full px-4 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition flex items-center justify-center">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
