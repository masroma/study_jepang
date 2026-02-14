@extends('admin.v2.layout.wrapper')

@section('page-title', 'Kelola Produk')

@section('content')
<div class="space-y-6">
    <!-- Header dengan tombol tambah -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Kelola Produk</h2>
            <p class="text-sm text-gray-600 mt-1">Atur produk dan komoditas yang ditampilkan di website</p>
        </div>
        <a href="{{ url('admin/v2/produk/tambah') }}" class="bg-brand-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-brand-pink/90 transition flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Produk</span>
        </a>
    </div>

    <!-- Daftar Produk -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($produks->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">MOQ</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Urutan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $no = 1; @endphp
                    @foreach($produks as $produk)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $no++ }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($produk->gambar)
                                <img src="{{ Storage::disk('s3')->url('uploads/produk/' . $produk->gambar) }}" alt="Produk" class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-box text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $produk->nama }}</div>
                            @if($produk->deskripsi)
                            <div class="text-xs text-gray-500 mt-1">{{ Str::limit($produk->deskripsi, 50) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($produk->kategori)
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $produk->kategori }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->moq ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->urutan ?? 0 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($produk->status == 'Publish')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Publish
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ url('admin/v2/produk/edit/' . $produk->id_produk) }}" class="text-brand-pink hover:text-brand-pink/80 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('admin/v2/produk/delete/' . $produk->id_produk) }}" 
                                   onclick="return confirm('Yakin ingin menghapus produk ini?')" 
                                   class="text-red-600 hover:text-red-800 transition">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="p-12 text-center">
            <i class="fas fa-box text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 text-lg font-medium">Belum ada produk</p>
            <p class="text-gray-400 text-sm mt-2">Mulai dengan menambahkan produk pertama Anda</p>
            <a href="{{ url('admin/v2/produk/tambah') }}" class="inline-block mt-4 bg-brand-pink text-white px-6 py-2 rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Produk
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
