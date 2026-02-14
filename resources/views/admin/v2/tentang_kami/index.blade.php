@extends('admin.v2.layout.wrapper')

@section('page-title', 'Kelola Tentang Kami')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Kelola Tentang Kami</h2>
        <p class="text-sm text-gray-600 mt-1">Kelola konten halaman tentang kami yang ditampilkan di website</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ url('admin/v2/tentang-kami/update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="id_konfigurasi" value="{{ $site->id_konfigurasi ?? 1 }}">
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 space-y-8">
            <!-- Informasi Dasar -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-brand-pink mr-2"></i>
                    Informasi Dasar
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="nama_singkat" class="block text-sm font-semibold text-gray-700 mb-2">Nama Singkat Perusahaan</label>
                        <input type="text" id="nama_singkat" name="nama_singkat" value="{{ old('nama_singkat', $site->nama_singkat ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: MEGHANTARA">
                        @error('nama_singkat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="tentang" class="block text-sm font-semibold text-gray-700 mb-2">Tentang Kami</label>
                        <textarea id="tentang" name="tentang" rows="6"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan deskripsi tentang perusahaan">{{ old('tentang', $site->tentang ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Deskripsi lengkap tentang perusahaan, sejarah, dan profil perusahaan</p>
                        @error('tentang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-bullseye text-brand-pink mr-2"></i>
                    Visi & Misi
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="visi" class="block text-sm font-semibold text-gray-700 mb-2">Visi</label>
                        <textarea id="visi" name="visi" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan visi perusahaan">{{ old('visi', $site->visi ?? '') }}</textarea>
                        @error('visi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="misi" class="block text-sm font-semibold text-gray-700 mb-2">Misi</label>
                        <textarea id="misi" name="misi" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan misi perusahaan (satu per baris)">{{ old('misi', $site->misi ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Pisahkan setiap poin misi dengan baris baru</p>
                        @error('misi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Sejarah & Nilai Perusahaan -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-history text-brand-pink mr-2"></i>
                    Sejarah & Nilai Perusahaan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="sejarah" class="block text-sm font-semibold text-gray-700 mb-2">Sejarah Perusahaan</label>
                        <textarea id="sejarah" name="sejarah" rows="5"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan sejarah perusahaan">{{ old('sejarah', $site->sejarah ?? '') }}</textarea>
                        @error('sejarah')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nilai_perusahaan" class="block text-sm font-semibold text-gray-700 mb-2">Nilai-Nilai Perusahaan</label>
                        <textarea id="nilai_perusahaan" name="nilai_perusahaan" rows="5"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan nilai-nilai perusahaan (satu per baris)">{{ old('nilai_perusahaan', $site->nilai_perusahaan ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Pisahkan setiap nilai dengan baris baru</p>
                        @error('nilai_perusahaan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Media -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-images text-brand-pink mr-2"></i>
                    Media
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Perusahaan</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @if($site->gambar ?? null)
                            <div class="mt-3">
                                <img src="{{ Storage::disk('s3')->url('assets/upload/image/' . $site->gambar) }}" alt="Current image" class="w-64 h-48 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 mt-2">Gambar saat ini (upload baru akan mengganti gambar ini)</p>
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-end space-x-4">
            <button type="submit" class="px-6 py-3 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-save mr-2"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
