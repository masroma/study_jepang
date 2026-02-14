@extends('admin.v2.layout.wrapper')

@section('page-title', 'Pengaturan Website')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Pengaturan Website</h2>

        <form action="{{ url('admin/v2/setting/update') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="id_konfigurasi" value="{{ $site->id_konfigurasi ?? 1 }}">

            <!-- Informasi Dasar -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-brand-pink mr-2"></i>
                    Informasi Dasar
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="namaweb" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Website <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="namaweb" name="namaweb" value="{{ old('namaweb', $site->namaweb ?? '') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @error('namaweb')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_singkat" class="block text-sm font-semibold text-gray-700 mb-2">Nama Singkat</label>
                        <input type="text" id="nama_singkat" name="nama_singkat" value="{{ old('nama_singkat', $site->nama_singkat ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>

                    <div>
                        <label for="tagline" class="block text-sm font-semibold text-gray-700 mb-2">Tagline</label>
                        <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $site->tagline ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>

                    <div>
                        <label for="tagline2" class="block text-sm font-semibold text-gray-700 mb-2">Tagline 2</label>
                        <input type="text" id="tagline2" name="tagline2" value="{{ old('tagline2', $site->tagline2 ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Website</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">{{ old('deskripsi', $site->deskripsi ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Kontak & Alamat -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-address-book text-brand-pink mr-2"></i>
                    Kontak & Alamat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">{{ old('alamat', $site->alamat ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="telepon" class="block text-sm font-semibold text-gray-700 mb-2">Telepon</label>
                        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $site->telepon ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: +62 812 3456 7890">
                    </div>

                    <div>
                        <label for="whatsapp" class="block text-sm font-semibold text-gray-700 mb-2">
                            WhatsApp <span class="text-green-600">*</span>
                        </label>
                        <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $site->whatsapp ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: 6281234567890 (tanpa + dan spasi)">
                        <p class="text-xs text-gray-500 mt-1">Format: 6281234567890 (tanpa + dan spasi)</p>
                    </div>

                    <div>
                        <label for="hp" class="block text-sm font-semibold text-gray-700 mb-2">Handphone</label>
                        <input type="text" id="hp" name="hp" value="{{ old('hp', $site->hp ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $site->email ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>

                    <div>
                        <label for="email_cadangan" class="block text-sm font-semibold text-gray-700 mb-2">Email Cadangan</label>
                        <input type="email" id="email_cadangan" name="email_cadangan" value="{{ old('email_cadangan', $site->email_cadangan ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>

                    <div>
                        <label for="fax" class="block text-sm font-semibold text-gray-700 mb-2">Fax</label>
                        <input type="text" id="fax" name="fax" value="{{ old('fax', $site->fax ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>

                    <div>
                        <label for="website" class="block text-sm font-semibold text-gray-700 mb-2">Website URL</label>
                        <input type="url" id="website" name="website" value="{{ old('website', $site->website ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="https://example.com">
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-share-alt text-brand-pink mr-2"></i>
                    Social Media
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="facebook" class="block text-sm font-semibold text-gray-700 mb-2">Facebook URL</label>
                        <input type="url" id="facebook" name="facebook" value="{{ old('facebook', $site->facebook ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>

                    <div>
                        <label for="twitter" class="block text-sm font-semibold text-gray-700 mb-2">Twitter URL</label>
                        <input type="url" id="twitter" name="twitter" value="{{ old('twitter', $site->twitter ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>

                    <div>
                        <label for="instagram" class="block text-sm font-semibold text-gray-700 mb-2">Instagram URL</label>
                        <input type="url" id="instagram" name="instagram" value="{{ old('instagram', $site->instagram ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-search text-brand-pink mr-2"></i>
                    SEO (Search Engine Optimization)
                </h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="keywords" class="block text-sm font-semibold text-gray-700 mb-2">Keywords</label>
                        <input type="text" id="keywords" name="keywords" value="{{ old('keywords', $site->keywords ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="keyword1, keyword2, keyword3">
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma</p>
                    </div>

                    <div>
                        <label for="metatext" class="block text-sm font-semibold text-gray-700 mb-2">Meta Description</label>
                        <textarea id="metatext" name="metatext" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">{{ old('metatext', $site->metatext ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Maksimal 160 karakter untuk hasil terbaik</p>
                    </div>
                </div>
            </div>

            <!-- Google Map -->
            <div class="pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-map-marker-alt text-brand-pink mr-2"></i>
                    Google Map
                </h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="google_map" class="block text-sm font-semibold text-gray-700 mb-2">Embed Google Map</label>
                        <textarea id="google_map" name="google_map" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition font-mono text-sm">{{ old('google_map', $site->google_map ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Paste kode embed iframe dari Google Maps</p>
                    </div>

                    <div>
                        <label for="text_bawah_peta" class="block text-sm font-semibold text-gray-700 mb-2">Text di Bawah Peta</label>
                        <textarea id="text_bawah_peta" name="text_bawah_peta" rows="2"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">{{ old('text_bawah_peta', $site->text_bawah_peta ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="link_bawah_peta" class="block text-sm font-semibold text-gray-700 mb-2">Link di Bawah Peta</label>
                        <input type="url" id="link_bawah_peta" name="link_bawah_peta" value="{{ old('link_bawah_peta', $site->link_bawah_peta ?? '') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
                <button type="submit" class="bg-brand-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-pink-600 transition shadow-sm flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Pengaturan
                </button>
                <a href="{{ url('admin/v2') }}" class="px-6 py-3 rounded-lg font-semibold border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
