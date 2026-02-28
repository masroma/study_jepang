@extends('admin.v2.layout.wrapper')

@section('page-title', 'Edit Slider Homepage')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Slider Homepage</h2>
        <p class="text-sm text-gray-600 mt-1">Edit slider untuk halaman utama</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ url('admin/v2/slider/edit_proses') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="id_hero" value="{{ $slider->id_hero }}">
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 space-y-8">
            <!-- Bahasa Indonesia -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-flag text-red-500 mr-2"></i>
                    Bahasa Indonesia
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Title (ID) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title_id" name="title_id" value="{{ old('title_id', $slider->title_id) }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Judul dalam Bahasa Indonesia">
                        @error('title_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subtitle_id" class="block text-sm font-semibold text-gray-700 mb-2">Subtitle (ID)</label>
                        <input type="text" id="subtitle_id" name="subtitle_id" value="{{ old('subtitle_id', $slider->subtitle_id) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Subtitle dalam Bahasa Indonesia">
                    </div>

                    <div>
                        <label for="country_id" class="block text-sm font-semibold text-gray-700 mb-2">Country (ID)</label>
                        <input type="text" id="country_id" name="country_id" value="{{ old('country_id', $slider->country_id) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Negara dalam Bahasa Indonesia">
                    </div>

                    <div>
                        <label for="button_text_id" class="block text-sm font-semibold text-gray-700 mb-2">Button Text (ID)</label>
                        <input type="text" id="button_text_id" name="button_text_id" value="{{ old('button_text_id', $slider->button_text_id) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Teks tombol dalam Bahasa Indonesia">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description_id" class="block text-sm font-semibold text-gray-700 mb-2">Description (ID)</label>
                        <textarea id="description_id" name="description_id" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Deskripsi dalam Bahasa Indonesia">{{ old('description_id', $slider->description_id) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Bahasa Inggris -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-flag text-blue-500 mr-2"></i>
                    Bahasa Inggris
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_en" class="block text-sm font-semibold text-gray-700 mb-2">Title (EN)</label>
                        <input type="text" id="title_en" name="title_en" value="{{ old('title_en', $slider->title_en) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Title in English">
                    </div>

                    <div>
                        <label for="subtitle_en" class="block text-sm font-semibold text-gray-700 mb-2">Subtitle (EN)</label>
                        <input type="text" id="subtitle_en" name="subtitle_en" value="{{ old('subtitle_en', $slider->subtitle_en) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Subtitle in English">
                    </div>

                    <div>
                        <label for="country_en" class="block text-sm font-semibold text-gray-700 mb-2">Country (EN)</label>
                        <input type="text" id="country_en" name="country_en" value="{{ old('country_en', $slider->country_en) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Country in English">
                    </div>

                    <div>
                        <label for="button_text_en" class="block text-sm font-semibold text-gray-700 mb-2">Button Text (EN)</label>
                        <input type="text" id="button_text_en" name="button_text_en" value="{{ old('button_text_en', $slider->button_text_en) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Button text in English">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description_en" class="block text-sm font-semibold text-gray-700 mb-2">Description (EN)</label>
                        <textarea id="description_en" name="description_en" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Description in English">{{ old('description_en', $slider->description_en) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Bahasa Jepang -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-flag text-red-600 mr-2"></i>
                    Bahasa Jepang
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_jp" class="block text-sm font-semibold text-gray-700 mb-2">Title (JP)</label>
                        <input type="text" id="title_jp" name="title_jp" value="{{ old('title_jp', $slider->title_jp) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="タイトル（日本語）">
                    </div>

                    <div>
                        <label for="subtitle_jp" class="block text-sm font-semibold text-gray-700 mb-2">Subtitle (JP)</label>
                        <input type="text" id="subtitle_jp" name="subtitle_jp" value="{{ old('subtitle_jp', $slider->subtitle_jp) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="サブタイトル（日本語）">
                    </div>

                    <div>
                        <label for="country_jp" class="block text-sm font-semibold text-gray-700 mb-2">Country (JP)</label>
                        <input type="text" id="country_jp" name="country_jp" value="{{ old('country_jp', $slider->country_jp) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="国（日本語）">
                    </div>

                    <div>
                        <label for="button_text_jp" class="block text-sm font-semibold text-gray-700 mb-2">Button Text (JP)</label>
                        <input type="text" id="button_text_jp" name="button_text_jp" value="{{ old('button_text_jp', $slider->button_text_jp) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="ボタンテキスト（日本語）">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description_jp" class="block text-sm font-semibold text-gray-700 mb-2">Description (JP)</label>
                        <textarea id="description_jp" name="description_jp" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="説明（日本語）">{{ old('description_jp', $slider->description_jp) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Media & Links -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-images text-brand-pink mr-2"></i>
                    Media & Links
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="person_image" class="block text-sm font-semibold text-gray-700 mb-2">Person Image</label>
                        <input type="file" id="person_image" name="person_image" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @if($slider->person_image_url)
                            <div class="mt-3">
                                <img src="{{ $slider->person_image_url }}" alt="Current person" class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 mt-2">Gambar saat ini (kosongkan jika tidak ingin mengubah)</p>
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Gambar orang/karakter utama</p>
                    </div>

                    <div class="md:col-span-2">
                        <label for="person_images" class="block text-sm font-semibold text-gray-700 mb-2">Person Images (Multiple)</label>
                        <input type="file" id="person_images" name="person_images[]" accept="image/*" multiple
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        @php
                            // Decode person_images if it's a JSON string
                            $personImages = $slider->person_images ?? null;
                            if (is_string($personImages)) {
                                $personImages = json_decode($personImages, true) ?? [];
                            }
                            if (!is_array($personImages)) {
                                $personImages = [];
                            }
                        @endphp
                        @if(!empty($slider->person_images_urls) && count($slider->person_images_urls) > 0)
                            <div class="mt-3 flex flex-wrap gap-3">
                                @foreach($slider->person_images_urls as $imgUrl)
                                    @if(!empty($imgUrl))
                                        <img src="{{ $imgUrl }}" alt="Person image" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                                    @endif
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Gambar saat ini (upload baru akan mengganti semua gambar)</p>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Beberapa gambar orang (bisa pilih lebih dari satu)</p>
                    </div>

                    <div>
                        <label for="button_link" class="block text-sm font-semibold text-gray-700 mb-2">Button Link</label>
                        <input type="text" id="button_link" name="button_link" value="{{ old('button_link', $slider->button_link) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="URL untuk tombol (contoh: /berita, https://example.com)">
                    </div>

                    <div>
                        <label for="video_link" class="block text-sm font-semibold text-gray-700 mb-2">Video Link</label>
                        <input type="text" id="video_link" name="video_link" value="{{ old('video_link', $slider->video_link) }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="URL video (YouTube, Vimeo, dll)">
                    </div>
                </div>
            </div>

            <!-- Pengaturan -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-cog text-gray-600 mr-2"></i>
                    Pengaturan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $slider->urutan) }}" min="0"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Urutan tampil slider (angka lebih kecil tampil lebih dulu)</p>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select id="status" name="status"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                            <option value="Publish" {{ old('status', $slider->status) == 'Publish' ? 'selected' : '' }}>Publish</option>
                            <option value="Draft" {{ old('status', $slider->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ url('admin/v2/slider') }}" class="px-6 py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
                <i class="fas fa-save mr-2"></i>
                Update Slider
            </button>
        </div>
    </form>
</div>
@endsection
