@extends('admin.v2.layout.wrapper')

@section('page-title', 'Kelola Lowongan Pekerjaan')

@section('content')
<div class="space-y-6">
    <!-- Header dengan tombol tambah -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Kelola Lowongan Pekerjaan</h2>
            <p class="text-sm text-gray-600 mt-1">Atur lowongan pekerjaan yang ditampilkan di website</p>
        </div>
        <a href="{{ url('admin/v2/loker/tambah') }}" class="bg-brand-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-brand-pink/90 transition flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Lowongan</span>
        </a>
    </div>

    <!-- Daftar Lowongan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($lokers->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul Lowongan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Posisi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $no = 1; @endphp
                    @foreach($lokers as $loker)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $no++ }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($loker->gambar)
                                <img src="{{ Storage::disk('s3')->url('assets/upload/image/loker/' . $loker->gambar) }}" alt="Lowongan" class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-briefcase text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $loker->judul_loker }}</div>
                            @if($loker->deskripsi_singkat)
                            <div class="text-xs text-gray-500 mt-1">{{ Str::limit($loker->deskripsi_singkat, 50) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loker->posisi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loker->lokasi_kerja ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($loker->tanggal_mulai || $loker->tanggal_selesai)
                                <div class="text-xs">
                                    @if($loker->tanggal_mulai)
                                        Mulai: {{ date('d/m/Y', strtotime($loker->tanggal_mulai)) }}<br>
                                    @endif
                                    @if($loker->tanggal_selesai)
                                        Selesai: {{ date('d/m/Y', strtotime($loker->tanggal_selesai)) }}
                                    @endif
                                </div>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($loker->status_loker == 'Publish')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Publish
                                </span>
                            @elseif($loker->status_loker == 'Tutup')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Tutup
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
                                <a href="{{ url('admin/v2/loker/edit/' . $loker->id_loker) }}" class="text-brand-pink hover:text-brand-pink/80 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('admin/v2/loker/delete/' . $loker->id_loker) }}" 
                                   onclick="return confirm('Yakin ingin menghapus lowongan ini?')" 
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
            <i class="fas fa-briefcase text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 text-lg font-medium">Belum ada lowongan pekerjaan</p>
            <p class="text-gray-400 text-sm mt-2">Mulai dengan menambahkan lowongan pertama Anda</p>
            <a href="{{ url('admin/v2/loker/tambah') }}" class="inline-block mt-4 bg-brand-pink text-white px-6 py-2 rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Lowongan
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
