@extends('admin.v2.layout.wrapper')

@section('page-title', 'Edit Industri')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Industri</h2>
        <p class="text-sm text-gray-600 mt-1">Edit industri untuk ditampilkan di website</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ url('admin/v2/industri/edit_proses') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="id_industri" value="{{ $industry->id_industri }}">
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 space-y-6">
            <!-- Informasi Dasar -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-brand-pink mr-2"></i>
                    Informasi Dasar
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Industri <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $industry->nama) }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan nama industri">
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="sub_nama" class="block text-sm font-semibold text-gray-700 mb-2">Sub Nama</label>
                        <input type="text" id="sub_nama" name="sub_nama" value="{{ old('sub_nama', $industry->sub_nama) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Sub nama atau nama alternatif">
                        @error('sub_nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan deskripsi industri">{{ old('deskripsi', $industry->deskripsi) }}</textarea>
                        @error('deskripsi')
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
                        <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">Logo Industri</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @if($industry->gambar)
                            <div class="mt-3">
                                <img src="{{ Storage::disk('s3')->url('uploads/industri/' . $industry->gambar) }}" alt="Current logo" class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 mt-2">Logo saat ini (kosongkan jika tidak ingin mengubah)</p>
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $industry->urutan) }}" min="0"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Urutan tampil industri (angka lebih kecil tampil lebih dulu)</p>
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
                            <option value="Publish" {{ old('status', $industry->status) == 'Publish' ? 'selected' : '' }}>Publish</option>
                            <option value="Draft" {{ old('status', $industry->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
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
            <a href="{{ url('admin/v2/industri') }}" class="px-6 py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-save mr-2"></i>
                Update Industri
            </button>
        </div>
    </form>
</div>
@endsection
