@extends('admin.v2.layout.wrapper')

@section('page-title', 'Tambah Program Masa Depan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Tambah Program Masa Depan</h2>
        <p class="text-sm text-gray-600 mt-1">Tambahkan program baru untuk ditampilkan di website</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ url('admin/v2/program-masa-depan/tambah_proses') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 space-y-6">
            <!-- Informasi Dasar -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-brand-pink mr-2"></i>
                    Informasi Dasar
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Program <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan judul program">
                        @error('judul')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan deskripsi program">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: Tokyo, Osaka, Nagoya">
                        @error('lokasi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="durasi" class="block text-sm font-semibold text-gray-700 mb-2">Durasi</label>
                        <input type="text" id="durasi" name="durasi" value="{{ old('durasi') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: 6-24 bulan">
                        @error('durasi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="visa" class="block text-sm font-semibold text-gray-700 mb-2">Visa</label>
                        <input type="text" id="visa" name="visa" value="{{ old('visa') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Jenis Visa">
                        @error('visa')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gaji" class="block text-sm font-semibold text-gray-700 mb-2">Gaji</label>
                        <input type="text" id="gaji" name="gaji" value="{{ old('gaji') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Estimasi gaji">
                        @error('gaji')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="sertifikat" class="block text-sm font-semibold text-gray-700 mb-2">Sertifikat</label>
                        <input type="text" id="sertifikat" name="sertifikat" value="{{ old('sertifikat') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Jenis sertifikat yang didapat">
                        @error('sertifikat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Media & Pengaturan -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-images text-brand-pink mr-2"></i>
                    Media & Pengaturan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Program</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Urutan tampil program (angka lebih kecil tampil lebih dulu)</p>
                        @error('urutan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                            <option value="Publish" {{ old('status', 'Publish') == 'Publish' ? 'selected' : '' }}>Publish</option>
                            <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ url('admin/v2/program-masa-depan') }}" class="px-6 py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-save mr-2"></i>
                Simpan Program
            </button>
        </div>
    </form>
</div>
@endsection
