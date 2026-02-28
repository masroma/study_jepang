@extends('admin.v2.layout.wrapper')

@section('page-title', 'Edit Berita')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Berita</h2>
        <p class="text-sm text-gray-600 mt-1">Edit berita untuk ditampilkan di website</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ url('admin/v2/berita/edit_proses') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="id_berita" value="{{ $berita->id_berita }}">
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 space-y-6">
            <!-- Informasi Dasar -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-brand-pink mr-2"></i>
                    Informasi Dasar
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="judul_berita" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul_berita" name="judul_berita" value="{{ old('judul_berita', $berita->judul_berita) }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan judul berita">
                        @error('judul_berita')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="id_kategori" name="id_kategori" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori', $berita->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $berita->urutan) }}" min="0"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Urutan tampil berita (angka lebih kecil tampil lebih dulu)</p>
                        @error('urutan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="isi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Isi Berita <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi" name="isi" rows="15" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan isi berita">{{ old('isi', $berita->isi) }}</textarea>
                        @error('isi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="keywords" class="block text-sm font-semibold text-gray-700 mb-2">Keywords (untuk SEO)</label>
                        <textarea id="keywords" name="keywords" rows="2"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan keywords untuk SEO, pisahkan dengan koma">{{ old('keywords', $berita->keywords) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Keywords untuk optimasi mesin pencari (pisahkan dengan koma)</p>
                        @error('keywords')
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
                        <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Berita</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @if($berita->gambar)
                            <div class="mt-3">
                                <img src="{{ asset('storage/assets/upload/image/' . $berita->gambar) }}" alt="Current image" class="w-64 h-48 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 mt-2">Gambar saat ini (kosongkan jika tidak ingin mengubah)</p>
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="icon" class="block text-sm font-semibold text-gray-700 mb-2">Icon</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $berita->icon) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: fa fa-newspaper">
                        <p class="text-xs text-gray-500 mt-1">Icon menggunakan Fontawesome (opsional)</p>
                        @error('icon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_publish" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Publish</label>
                        <input type="date" id="tanggal_publish" name="tanggal_publish" value="{{ old('tanggal_publish', $berita->tanggal_publish ? date('Y-m-d', strtotime($berita->tanggal_publish)) : date('Y-m-d')) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @error('tanggal_publish')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jam_publish" class="block text-sm font-semibold text-gray-700 mb-2">Jam Publish</label>
                        <input type="time" id="jam_publish" name="jam_publish" value="{{ old('jam_publish', $berita->tanggal_publish ? date('H:i', strtotime($berita->tanggal_publish)) : date('H:i')) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @error('jam_publish')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status_berita" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status_berita" name="status_berita" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                            <option value="Publish" {{ old('status_berita', $berita->status_berita) == 'Publish' ? 'selected' : '' }}>Publish</option>
                            <option value="Draft" {{ old('status_berita', $berita->status_berita) == 'Draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status_berita')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ url('admin/v2/berita') }}" class="px-6 py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-save mr-2"></i>
                Update Berita
            </button>
        </div>
    </form>
</div>
@endsection
