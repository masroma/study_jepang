@extends('admin.v2.layout.wrapper')

@section('page-title', 'Edit Kisah Sukses')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Kisah Sukses</h2>
        <p class="text-sm text-gray-600 mt-1">Edit testimoni dan kisah sukses alumni</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ url('admin/v2/kisah-sukses/edit_proses') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="id_kisah" value="{{ $kisah->id_kisah }}">
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 space-y-6">
            <!-- Informasi Alumni -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user text-brand-pink mr-2"></i>
                    Informasi Alumni
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Alumni <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $kisah->nama) }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan nama alumni">
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pekerjaan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $kisah->pekerjaan) }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: Production Worker, Caregiver">
                        @error('pekerjaan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $kisah->lokasi) }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: Tokyo, Osaka, Aichi">
                        @error('lokasi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="program" class="block text-sm font-semibold text-gray-700 mb-2">Program</label>
                        <select id="program" name="program"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                            <option value="">Pilih Program</option>
                            <option value="JLPT N3" {{ old('program', $kisah->program) == 'JLPT N3' ? 'selected' : '' }}>JLPT N3</option>
                            <option value="JLPT N2" {{ old('program', $kisah->program) == 'JLPT N2' ? 'selected' : '' }}>JLPT N2</option>
                            <option value="JLPT N1" {{ old('program', $kisah->program) == 'JLPT N1' ? 'selected' : '' }}>JLPT N1</option>
                            <option value="Tokutei Ginou" {{ old('program', $kisah->program) == 'Tokutei Ginou' ? 'selected' : '' }}>Tokutei Ginou</option>
                            <option value="Caregiver" {{ old('program', $kisah->program) == 'Caregiver' ? 'selected' : '' }}>Caregiver</option>
                            <option value="Internship" {{ old('program', $kisah->program) == 'Internship' ? 'selected' : '' }}>Internship</option>
                            <option value="Magang" {{ old('program', $kisah->program) == 'Magang' ? 'selected' : '' }}>Magang</option>
                        </select>
                        @error('program')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tahun" class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
                        <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $kisah->tahun) }}" min="2000" max="{{ date('Y') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Tahun lulus/bergabung">
                        @error('tahun')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rating" class="block text-sm font-semibold text-gray-700 mb-2">Rating</label>
                        <select id="rating" name="rating"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                            <option value="5" {{ old('rating', $kisah->rating ?? 5) == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
                            <option value="4" {{ old('rating', $kisah->rating) == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
                            <option value="3" {{ old('rating', $kisah->rating) == '3' ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
                            <option value="2" {{ old('rating', $kisah->rating) == '2' ? 'selected' : '' }}>⭐⭐ (2)</option>
                            <option value="1" {{ old('rating', $kisah->rating) == '1' ? 'selected' : '' }}>⭐ (1)</option>
                        </select>
                        @error('rating')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="testimoni" class="block text-sm font-semibold text-gray-700 mb-2">
                            Testimoni <span class="text-red-500">*</span>
                        </label>
                        <textarea id="testimoni" name="testimoni" rows="5" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan testimoni dari alumni">{{ old('testimoni', $kisah->testimoni) }}</textarea>
                        @error('testimoni')
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
                        <label for="foto" class="block text-sm font-semibold text-gray-700 mb-2">Foto Alumni</label>
                        <input type="file" id="foto" name="foto" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @if($kisah->foto)
                            <div class="mt-3">
                                <img src="{{ asset('storage/uploads/kisah-sukses/' . $kisah->foto) }}" alt="Current photo" class="w-48 h-48 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 mt-2">Foto saat ini (kosongkan jika tidak ingin mengubah)</p>
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                        @error('foto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">Video URL (YouTube)</label>
                        <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $kisah->video_url) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="https://youtube.com/watch?v=...">
                        @if($kisah->video_url)
                            <p class="text-xs text-blue-600 mt-2">
                                <i class="fab fa-youtube"></i> Video URL saat ini: 
                                <a href="{{ $kisah->video_url }}" target="_blank" class="underline">{{ $kisah->video_url }}</a>
                            </p>
                        @endif
                        @error('video_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="video_file" class="block text-sm font-semibold text-gray-700 mb-2">Upload Video File</label>
                        <input type="file" id="video_file" name="video_file" accept="video/mp4,video/avi,video/mov,video/wmv"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @if($kisah->video_file)
                            <p class="text-xs text-green-600 mt-2">
                                <i class="fas fa-video"></i> Video file saat ini: {{ $kisah->video_file }} (kosongkan jika tidak ingin mengubah)
                            </p>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Format: MP4, AVI, MOV, WMV (Max: 10MB)</p>
                        @error('video_file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pengaturan -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-cog text-gray-600 mr-2"></i>
                    Pengaturan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $kisah->urutan) }}" min="0"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Urutan tampil (angka lebih kecil tampil lebih dulu)</p>
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
                            <option value="Publish" {{ old('status', $kisah->status) == 'Publish' ? 'selected' : '' }}>Publish</option>
                            <option value="Draft" {{ old('status', $kisah->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
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
            <a href="{{ url('admin/v2/kisah-sukses') }}" class="px-6 py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-save mr-2"></i>
                Update Kisah Sukses
            </button>
        </div>
    </form>
</div>
@endsection
