@extends('admin.v2.layout.wrapper')

@section('page-title', 'Kelola Berita')

@section('content')
<div class="space-y-6">
    <!-- Header dengan tombol tambah -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Kelola Berita</h2>
            <p class="text-sm text-gray-600 mt-1">Atur berita yang ditampilkan di website</p>
        </div>
        <a href="{{ url('admin/v2/berita/tambah') }}" class="bg-brand-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-brand-pink/90 transition flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Berita</span>
        </a>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ url('admin/v2/berita') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
            <div class="text-sm text-gray-600">Total Berita</div>
        </a>
        <a href="{{ url('admin/v2/berita?status=Publish') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-green-600">{{ $stats['publish'] }}</div>
            <div class="text-sm text-gray-600">Publish</div>
        </a>
        <a href="{{ url('admin/v2/berita?status=Draft') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-yellow-600">{{ $stats['draft'] }}</div>
            <div class="text-sm text-gray-600">Draft</div>
        </a>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <form method="GET" action="{{ url('admin/v2/berita') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ $current_search }}" placeholder="Cari judul atau isi berita..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
            </div>
            <div class="md:w-48">
                <select name="kategori" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id_kategori }}" {{ $current_kategori == $kategori->id_kategori ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="md:w-48">
                <select name="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    <option value="">Semua Status</option>
                    <option value="Publish" {{ $current_status == 'Publish' ? 'selected' : '' }}>Publish</option>
                    <option value="Draft" {{ $current_status == 'Draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="md:w-40">
                <select name="per_page" onchange="this.form.submit()" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    <option value="10" {{ ($current_per_page ?? 10) == 10 ? 'selected' : '' }}>10 per halaman</option>
                    <option value="25" {{ ($current_per_page ?? 10) == 25 ? 'selected' : '' }}>25 per halaman</option>
                    <option value="50" {{ ($current_per_page ?? 10) == 50 ? 'selected' : '' }}>50 per halaman</option>
                    <option value="100" {{ ($current_per_page ?? 10) == 100 ? 'selected' : '' }}>100 per halaman</option>
                </select>
            </div>
            <button type="submit" class="px-6 py-2 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-search mr-2"></i>
                Cari
            </button>
            @if($current_search || $current_status || $current_kategori)
            <a href="{{ url('admin/v2/berita') }}" class="px-6 py-2 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Daftar Berita -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($beritas->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul Berita</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Publish</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $no = ($beritas->currentPage() - 1) * $beritas->perPage() + 1; @endphp
                    @foreach($beritas as $berita)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $no++ }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($berita->gambar)
                                <img src="{{ Storage::disk('public')->url('assets/upload/image/' . $berita->gambar) }}" alt="Berita" class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-newspaper text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $berita->judul_berita }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ Str::limit(strip_tags($berita->isi), 60) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($berita->kategori)
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $berita->kategori->nama_kategori }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($berita->tanggal_publish)
                                {{ date('d/m/Y H:i', strtotime($berita->tanggal_publish)) }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($berita->status_berita == 'Publish')
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
                                <a href="{{ url('admin/v2/berita/edit/' . $berita->id_berita) }}" class="text-brand-pink hover:text-brand-pink/80 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('admin/v2/berita/delete/' . $berita->id_berita) }}" 
                                   onclick="return confirm('Yakin ingin menghapus berita ini?')" 
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
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Menampilkan {{ $beritas->firstItem() ?? 0 }} sampai {{ $beritas->lastItem() ?? 0 }} dari {{ $beritas->total() }} berita
            </div>
            <div class="flex items-center space-x-2">
                {{ $beritas->links('pagination::tailwind') }}
            </div>
        </div>
        @else
        <div class="p-12 text-center">
            <i class="fas fa-newspaper text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 text-lg font-medium">Belum ada berita</p>
            <p class="text-gray-400 text-sm mt-2">Mulai dengan menambahkan berita pertama Anda</p>
            <a href="{{ url('admin/v2/berita/tambah') }}" class="inline-block mt-4 bg-brand-pink text-white px-6 py-2 rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Berita
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
