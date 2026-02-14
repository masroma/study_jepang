@extends('admin.v2.layout.wrapper')

@section('page-title', 'Detail Pelamar')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Detail Pelamar</h2>
            <p class="text-sm text-gray-600 mt-1">Informasi lengkap data pelamar</p>
        </div>
        <a href="{{ url('admin/v2/pelamar') }}" class="px-4 py-2 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
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
                        <p class="text-gray-900 font-medium">{{ $pelamar->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900">{{ $pelamar->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Telepon</label>
                        <p class="text-gray-900">{{ $pelamar->telepon }}</p>
                    </div>
                    @if($pelamar->whatsapp)
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">WhatsApp</label>
                        <a href="https://wa.me/{{ str_replace(['+', '-', ' ', '(', ')'], '', $pelamar->whatsapp) }}" target="_blank" class="text-green-600 hover:text-green-800 font-medium">
                            <i class="fab fa-whatsapp mr-1"></i>
                            {{ $pelamar->whatsapp }}
                        </a>
                    </div>
                    @endif
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                        <p class="text-gray-900">{{ $pelamar->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Pendidikan Terakhir</label>
                        <p class="text-gray-900">{{ $pelamar->pendidikan_terakhir ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Pendaftaran</label>
                        <p class="text-gray-900">{{ date('d F Y H:i', strtotime($pelamar->tanggal_pendaftaran)) }}</p>
                    </div>
                </div>
            </div>

            <!-- Lowongan yang Didaftar -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-brand-pink mr-2"></i>
                    Lowongan yang Didaftar
                </h3>
                <div class="space-y-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Lowongan</label>
                        <p class="text-gray-900 font-medium">{{ $pelamar->judul_loker }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Posisi</label>
                        <p class="text-gray-900">{{ $pelamar->posisi }}</p>
                    </div>
                    <div>
                        <a href="{{ url('loker/detail/' . $pelamar->slug_loker) }}" target="_blank" class="text-brand-pink hover:text-brand-pink/80 transition text-sm">
                            <i class="fas fa-external-link-alt mr-1"></i>
                            Lihat Lowongan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pengalaman -->
            @if($pelamar->pengalaman)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-brand-pink mr-2"></i>
                    Pengalaman
                </h3>
                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                    {{ $pelamar->pengalaman }}
                </div>
            </div>
            @endif

            <!-- Catatan -->
            @if($pelamar->catatan)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-sticky-note text-brand-pink mr-2"></i>
                    Catatan
                </h3>
                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                    {{ $pelamar->catatan }}
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
                    @if($pelamar->status_pendaftaran == 'Baru')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                            Baru
                        </span>
                    @elseif($pelamar->status_pendaftaran == 'Dibaca')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                            Dibaca
                        </span>
                    @elseif($pelamar->status_pendaftaran == 'Diproses')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                            Diproses
                        </span>
                    @elseif($pelamar->status_pendaftaran == 'Diterima')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            Diterima
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">
                            Ditolak
                        </span>
                    @endif
                </div>
                <form method="POST" action="{{ url('admin/v2/pelamar/update-status') }}">
                    @csrf
                    <input type="hidden" name="id_pendaftaran" value="{{ $pelamar->id_pendaftaran }}">
                    <select name="status_pendaftaran" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition mb-3">
                        <option value="Baru" {{ $pelamar->status_pendaftaran == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Dibaca" {{ $pelamar->status_pendaftaran == 'Dibaca' ? 'selected' : '' }}>Dibaca</option>
                        <option value="Diproses" {{ $pelamar->status_pendaftaran == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Diterima" {{ $pelamar->status_pendaftaran == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Ditolak" {{ $pelamar->status_pendaftaran == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <button type="submit" class="w-full px-4 py-2 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                        <i class="fas fa-save mr-2"></i>
                        Update Status
                    </button>
                </form>
            </div>

            <!-- CV / Resume -->
            @if($pelamar->cv_file)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">CV / Resume</h3>
                <a href="{{ url('admin/v2/pelamar/download-cv/' . $pelamar->id_pendaftaran) }}" target="_blank" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center">
                    <i class="fas fa-download mr-2"></i>
                    Download CV
                </a>
                <p class="text-xs text-gray-500 mt-2 text-center">{{ $pelamar->cv_file }}</p>
            </div>
            @endif

            <!-- Aksi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                <div class="space-y-2">
                    <a href="{{ url('admin/v2/pelamar/delete/' . $pelamar->id_pendaftaran) }}" 
                       onclick="return confirm('Yakin ingin menghapus data pelamar ini?')" 
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
