@extends('member.layout.wrapper')

@section('page-title', 'Detail Lamaran')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ url('member/lamaran') }}" class="inline-flex items-center space-x-2 text-sm text-gray-600 hover:text-brand-pink transition mb-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Lamaran</span>
            </a>
            <h2 class="text-2xl font-bold text-gray-900">Detail Lamaran</h2>
        </div>
        <div>
            @if($lamaran->status_pendaftaran == 'Baru')
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    <i class="fas fa-clock mr-2"></i>
                    Baru
                </span>
            @elseif($lamaran->status_pendaftaran == 'Diproses')
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                    <i class="fas fa-spinner mr-2"></i>
                    Diproses
                </span>
            @elseif($lamaran->status_pendaftaran == 'Diterima')
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-2"></i>
                    Diterima
                </span>
            @elseif($lamaran->status_pendaftaran == 'Ditolak')
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    <i class="fas fa-times-circle mr-2"></i>
                    Ditolak
                </span>
            @else
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    {{ $lamaran->status_pendaftaran }}
                </span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Lowongan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-brand-pink mr-3"></i>
                    Informasi Lowongan
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Judul Lowongan</label>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $lamaran->judul_loker }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Posisi</label>
                        <p class="text-gray-900 mt-1">{{ $lamaran->posisi }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Deskripsi Lowongan</label>
                        <div class="text-gray-900 mt-2 prose max-w-none">
                            {!! $lamaran->isi_loker !!}
                        </div>
                    </div>
                    <div>
                        <a href="{{ url('loker/' . $lamaran->slug_loker) }}" target="_blank" class="inline-flex items-center space-x-2 text-sm text-brand-pink hover:underline">
                            <i class="fas fa-external-link-alt"></i>
                            <span>Lihat Lowongan di Website</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Informasi Lamaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-file-alt text-brand-pink mr-3"></i>
                    Informasi Lamaran
                </h3>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Melamar</label>
                            <p class="text-gray-900 mt-1">
                                <i class="fas fa-calendar mr-2 text-gray-400"></i>
                                {{ date('d F Y, H:i', strtotime($lamaran->tanggal_pendaftaran)) }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Status</label>
                            <p class="text-gray-900 mt-1">
                                @if($lamaran->status_pendaftaran == 'Baru')
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Baru
                                    </span>
                                @elseif($lamaran->status_pendaftaran == 'Diproses')
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-orange-100 text-orange-800">
                                        Diproses
                                    </span>
                                @elseif($lamaran->status_pendaftaran == 'Diterima')
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                        Diterima
                                    </span>
                                @elseif($lamaran->status_pendaftaran == 'Ditolak')
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $lamaran->status_pendaftaran }}
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                    @if($lamaran->catatan_admin)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Catatan dari Admin</label>
                        <div class="mt-2 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-sm text-gray-900">{{ $lamaran->catatan_admin }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- CV File -->
            @if($lamaran->cv_file)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-file-pdf text-brand-pink mr-3"></i>
                    File CV
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-file-pdf text-red-600 text-2xl"></i>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $lamaran->cv_file }}</p>
                            <p class="text-xs text-gray-500">File CV yang diupload</p>
                        </div>
                    </div>
                    <a href="{{ url('member/lamaran/download-cv/' . $lamaran->id_pendaftaran) }}" class="w-full flex items-center justify-center space-x-2 px-4 py-2 bg-brand-pink text-white rounded-lg hover:bg-pink-600 transition">
                        <i class="fas fa-download"></i>
                        <span>Download CV</span>
                    </a>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-2">
                    <a href="{{ url('member/lamaran') }}" class="block w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium text-center">
                        <i class="fas fa-list mr-2"></i>
                        Kembali ke Daftar
                    </a>
                    <a href="{{ url('loker') }}" target="_blank" class="block w-full px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition text-sm font-medium text-center">
                        <i class="fas fa-search mr-2"></i>
                        Cari Lowongan Lain
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
