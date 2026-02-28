@extends('admin.v2.layout.wrapper')

@section('page-title', 'Edit Layanan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Layanan</h2>
        <p class="text-sm text-gray-600 mt-1">Edit layanan untuk ditampilkan di website</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ url('admin/v2/layanan/edit_proses') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="id_layanan" value="{{ $layanan->id_layanan }}">
        
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
                            Judul Layanan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $layanan->judul) }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan judul layanan">
                        @error('judul')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="icon" class="block text-sm font-semibold text-gray-700 mb-2">Icon (Emoji)</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $layanan->icon) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: 📤, 📥, 🚢, 🏭">
                        <p class="text-xs text-gray-500 mt-1">Gunakan emoji atau icon untuk layanan (opsional)</p>
                        @error('icon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $layanan->urutan) }}" min="0"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Urutan tampil layanan (angka lebih kecil tampil lebih dulu)</p>
                        @error('urutan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan deskripsi layanan">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="fitur" class="block text-sm font-semibold text-gray-700 mb-2">Fitur Layanan</label>
                        <textarea id="fitur" name="fitur" rows="6"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan fitur layanan (satu per baris)">{{ old('fitur', $layanan->fitur) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Masukkan setiap fitur dalam satu baris. Contoh: Dokumentasi ekspor lengkap, Pengurusan izin ekspor</p>
                        @error('fitur')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi (Opsional)</label>
                        <textarea id="lokasi" name="lokasi" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan lokasi layanan (satu per baris). Contoh untuk warehousing: Jakarta - 5,000 m²">{{ old('lokasi', $layanan->lokasi) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Untuk layanan seperti warehousing, masukkan lokasi gudang (satu per baris)</p>
                        @error('lokasi')
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
                        <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Layanan</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @if($layanan->gambar)
                            <div class="mt-3">
                                <img src="{{ asset('storage/uploads/layanan/' . $layanan->gambar) }}" alt="Current image" class="w-64 h-48 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 mt-2">Gambar saat ini (kosongkan jika tidak ingin mengubah)</p>
                            </div>
                        @elseif($layanan->icon)
                            <div class="mt-3">
                                <div class="w-64 h-48 bg-gray-100 rounded-lg flex items-center justify-center text-6xl border border-gray-200">
                                    {{ $layanan->icon }}
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Icon saat ini</p>
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB). Jika tidak diisi, akan menggunakan icon</p>
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                            <option value="Publish" {{ old('status', $layanan->status) == 'Publish' ? 'selected' : '' }}>Publish</option>
                            <option value="Draft" {{ old('status', $layanan->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
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
            <a href="{{ url('admin/v2/layanan') }}" class="px-6 py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-save mr-2"></i>
                Update Layanan
            </button>
        </div>
    </form>
</div>
@endsection
