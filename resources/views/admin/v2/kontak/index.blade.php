@extends('admin.v2.layout.wrapper')

@section('page-title', 'Kontak Kami')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Kontak Kami</h2>
        <p class="text-sm text-gray-600 mt-1">Lihat dan kelola pesan kontak dari pengunjung website</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ url('admin/v2/kontak') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
            <div class="text-sm text-gray-600">Total Pesan</div>
        </a>
        <a href="{{ url('admin/v2/kontak?status=Baru') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-red-600">{{ $stats['baru'] }}</div>
            <div class="text-sm text-gray-600">Baru</div>
        </a>
        <a href="{{ url('admin/v2/kontak?status=Dibaca') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-blue-600">{{ $stats['dibaca'] }}</div>
            <div class="text-sm text-gray-600">Dibaca</div>
        </a>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <form method="GET" action="{{ url('admin/v2/kontak') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ $current_search }}" placeholder="Cari nama, email, subjek, atau pesan..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
            </div>
            <div class="md:w-48">
                <select name="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    <option value="">Semua Status</option>
                    <option value="Baru" {{ $current_status == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Dibaca" {{ $current_status == 'Dibaca' ? 'selected' : '' }}>Dibaca</option>
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
            @if($current_search || $current_status)
            <a href="{{ url('admin/v2/kontak') }}" class="px-6 py-2 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Daftar Kontak -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($kontaks->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Telepon</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Subjek</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $no = ($kontaks->currentPage() - 1) * $kontaks->perPage() + 1; @endphp
                    @foreach($kontaks as $kontak)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $no++ }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('d/m/Y H:i', strtotime($kontak->tanggal_kontak)) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $kontak->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kontak->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kontak->telepon }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $kontak->subjek }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ Str::limit($kontak->pesan, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($kontak->status_kontak == 'Baru')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    Baru
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    Dibaca
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ url('admin/v2/kontak/detail/' . $kontak->id_kontak) }}" class="text-brand-pink hover:text-brand-pink/80 transition" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ url('admin/v2/kontak/delete/' . $kontak->id_kontak) }}" 
                                   onclick="return confirm('Yakin ingin menghapus pesan kontak ini?')" 
                                   class="text-red-600 hover:text-red-800 transition" title="Hapus">
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
                Menampilkan {{ $kontaks->firstItem() ?? 0 }} sampai {{ $kontaks->lastItem() ?? 0 }} dari {{ $kontaks->total() }} pesan kontak
            </div>
            <div class="flex items-center space-x-2">
                {{ $kontaks->links('pagination::tailwind') }}
            </div>
        </div>
        @else
        <div class="p-12 text-center">
            <i class="fas fa-envelope text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 text-lg font-medium">Belum ada pesan kontak</p>
            <p class="text-gray-400 text-sm mt-2">Pesan kontak akan muncul di sini setelah ada yang mengirim</p>
        </div>
        @endif
    </div>
</div>
@endsection
