@extends('admin.v2.layout.wrapper')

@section('page-title', 'Tambah Lowongan Pekerjaan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Tambah Lowongan Pekerjaan</h2>
        <p class="text-sm text-gray-600 mt-1">Tambahkan lowongan pekerjaan baru untuk ditampilkan di website</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ url('admin/v2/loker/tambah_proses') }}" enctype="multipart/form-data" class="space-y-6">
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
                        <label for="judul_loker" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Lowongan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul_loker" name="judul_loker" value="{{ old('judul_loker') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan judul lowongan pekerjaan">
                        @error('judul_loker')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="posisi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Posisi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="posisi" name="posisi" value="{{ old('posisi') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: Instruktur Bahasa Jepang">
                        @error('posisi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lokasi_kerja" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Kerja</label>
                        <input type="text" id="lokasi_kerja" name="lokasi_kerja" value="{{ old('lokasi_kerja') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: Jakarta, Bandung, Online">
                        @error('lokasi_kerja')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tipe_kerja" class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kerja</label>
                        <select id="tipe_kerja" name="tipe_kerja"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                            <option value="">Pilih Tipe Kerja</option>
                            <option value="Full-time" {{ old('tipe_kerja') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('tipe_kerja') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ old('tipe_kerja') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Freelance" {{ old('tipe_kerja') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                        </select>
                        @error('tipe_kerja')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Urutan tampil lowongan (angka lebih kecil tampil lebih dulu)</p>
                        @error('urutan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi_singkat" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                        <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Ringkasan singkat tentang lowongan (opsional)">{{ old('deskripsi_singkat') }}</textarea>
                        @error('deskripsi_singkat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="isi_loker" class="block text-sm font-semibold text-gray-700 mb-2">
                            Isi Lowongan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi_loker" name="isi_loker" rows="10" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan detail lengkap tentang lowongan pekerjaan">{{ old('isi_loker') }}</textarea>
                        @error('isi_loker')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Detail Pekerjaan -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-brand-pink mr-2"></i>
                    Detail Pekerjaan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="persyaratan" class="block text-sm font-semibold text-gray-700 mb-2">Persyaratan</label>
                        <textarea id="persyaratan" name="persyaratan" rows="6"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Sebutkan persyaratan yang dibutuhkan (satu per baris)">{{ old('persyaratan') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Masukkan setiap persyaratan dalam satu baris</p>
                        @error('persyaratan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggung_jawab" class="block text-sm font-semibold text-gray-700 mb-2">Tanggung Jawab</label>
                        <textarea id="tanggung_jawab" name="tanggung_jawab" rows="6"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Sebutkan tanggung jawab pekerjaan (satu per baris)">{{ old('tanggung_jawab') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Masukkan setiap tanggung jawab dalam satu baris</p>
                        @error('tanggung_jawab')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tanggal & Status -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-calendar text-brand-pink mr-2"></i>
                    Tanggal & Status
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @error('tanggal_mulai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Tanggal penutupan lowongan</p>
                        @error('tanggal_selesai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status_loker" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status_loker" name="status_loker" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                            <option value="Publish" {{ old('status_loker', 'Publish') == 'Publish' ? 'selected' : '' }}>Publish</option>
                            <option value="Draft" {{ old('status_loker') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Tutup" {{ old('status_loker') == 'Tutup' ? 'selected' : '' }}>Tutup</option>
                        </select>
                        @error('status_loker')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Media -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-images text-brand-pink mr-2"></i>
                    Media
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Lowongan</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
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
            <a href="{{ url('admin/v2/loker') }}" class="px-6 py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-save mr-2"></i>
                Simpan Lowongan
            </button>
        </div>
    </form>
</div>
@endsection
