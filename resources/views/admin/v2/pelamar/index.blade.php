@extends('admin.v2.layout.wrapper')

@section('page-title', 'Kelola Pelamar')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Kelola Pelamar</h2>
        <p class="text-sm text-gray-600 mt-1">Lihat dan kelola data pelamar lowongan pekerjaan</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
        <a href="{{ url('admin/v2/pelamar') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
            <div class="text-sm text-gray-600">Total Pelamar</div>
        </a>
        <a href="{{ url('admin/v2/pelamar?status=Baru') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-red-600">{{ $stats['baru'] }}</div>
            <div class="text-sm text-gray-600">Baru</div>
        </a>
        <a href="{{ url('admin/v2/pelamar?status=Dibaca') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-blue-600">{{ $stats['dibaca'] }}</div>
            <div class="text-sm text-gray-600">Dibaca</div>
        </a>
        <a href="{{ url('admin/v2/pelamar?status=Diproses') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-yellow-600">{{ $stats['diproses'] }}</div>
            <div class="text-sm text-gray-600">Diproses</div>
        </a>
        <a href="{{ url('admin/v2/pelamar?status=Diterima') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-green-600">{{ $stats['diterima'] }}</div>
            <div class="text-sm text-gray-600">Diterima</div>
        </a>
        <a href="{{ url('admin/v2/pelamar?status=Ditolak') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition">
            <div class="text-2xl font-bold text-gray-600">{{ $stats['ditolak'] }}</div>
            <div class="text-sm text-gray-600">Ditolak</div>
        </a>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <form method="GET" action="{{ url('admin/v2/pelamar') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ $current_search }}" placeholder="Cari nama, email, atau lowongan..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
            </div>
            <div class="md:w-48">
                <select name="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    <option value="">Semua Status</option>
                    <option value="Baru" {{ $current_status == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Dibaca" {{ $current_status == 'Dibaca' ? 'selected' : '' }}>Dibaca</option>
                    <option value="Diproses" {{ $current_status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Diterima" {{ $current_status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="Ditolak" {{ $current_status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <button type="submit" class="px-6 py-2 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-search mr-2"></i>
                Cari
            </button>
            @if($current_search || $current_status)
            <a href="{{ url('admin/v2/pelamar') }}" class="px-6 py-2 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Daftar Pelamar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($pelamars->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Telepon</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Lowongan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $no = 1; @endphp
                    @foreach($pelamars as $pelamar)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $no++ }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $pelamar->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pelamar->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div>{{ $pelamar->telepon }}</div>
                            @if($pelamar->whatsapp)
                            <div class="text-xs text-green-600">
                                <i class="fab fa-whatsapp"></i> {{ $pelamar->whatsapp }}
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $pelamar->judul_loker }}</div>
                            <div class="text-xs text-gray-500">{{ $pelamar->posisi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('d/m/Y H:i', strtotime($pelamar->tanggal_pendaftaran)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($pelamar->status_pendaftaran == 'Baru')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    Baru
                                </span>
                            @elseif($pelamar->status_pendaftaran == 'Dibaca')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    Dibaca
                                </span>
                            @elseif($pelamar->status_pendaftaran == 'Diproses')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    Diproses
                                </span>
                            @elseif($pelamar->status_pendaftaran == 'Diterima')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    Diterima
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ url('admin/v2/pelamar/detail/' . $pelamar->id_pendaftaran) }}" class="text-brand-pink hover:text-brand-pink/80 transition" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($pelamar->cv_file)
                                <a href="{{ url('admin/v2/pelamar/download-cv/' . $pelamar->id_pendaftaran) }}" class="text-blue-600 hover:text-blue-800 transition" title="Download CV">
                                    <i class="fas fa-download"></i>
                                </a>
                                @endif
                                <a href="{{ url('admin/v2/pelamar/delete/' . $pelamar->id_pendaftaran) }}" 
                                   onclick="return confirm('Yakin ingin menghapus data pelamar ini?')" 
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
        @else
        <div class="p-12 text-center">
            <i class="fas fa-users text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 text-lg font-medium">Belum ada pelamar</p>
            <p class="text-gray-400 text-sm mt-2">Data pelamar akan muncul di sini setelah ada yang mendaftar</p>
        </div>
        @endif
    </div>
</div>
@endsection
