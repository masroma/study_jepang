@extends('admin.v2.layout.wrapper')

@section('page-title', 'Tambah Program Masa Depan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Tambah Program Masa Depan</h2>
        <p class="text-sm text-gray-600 mt-1">Tambahkan program baru untuk ditampilkan di website (Multi-bahasa: ID, EN, JP)</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ url('admin/v2/program-masa-depan/tambah_proses') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 space-y-6">
            <!-- Language Tabs -->
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button type="button" onclick="switchTab('id')" id="tab-id" class="tab-button active border-brand-pink text-brand-pink whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <img src="https://flagcdn.com/w20/id.png" class="inline mr-2" alt="ID">
                        Indonesia
                    </button>
                    <button type="button" onclick="switchTab('en')" id="tab-en" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <img src="https://flagcdn.com/w20/us.png" class="inline mr-2" alt="EN">
                        English
                    </button>
                    <button type="button" onclick="switchTab('jp')" id="tab-jp" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <img src="https://flagcdn.com/w20/jp.png" class="inline mr-2" alt="JP">
                        日本語
                    </button>
                </nav>
            </div>

            <!-- Tab Content: Indonesia -->
            <div id="content-id" class="tab-content">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-brand-pink mr-2"></i>
                    Informasi Dasar (Bahasa Indonesia)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="judul_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Program <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul_id" name="judul_id" value="{{ old('judul_id') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan judul program">
                        @error('judul_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi_id" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="deskripsi_id" name="deskripsi_id" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Masukkan deskripsi program">{{ old('deskripsi_id') }}</textarea>
                    </div>

                    <div>
                        <label for="lokasi_id" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                        <input type="text" id="lokasi_id" name="lokasi_id" value="{{ old('lokasi_id') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: Tokyo, Osaka, Nagoya">
                    </div>

                    <div>
                        <label for="durasi_id" class="block text-sm font-semibold text-gray-700 mb-2">Durasi</label>
                        <input type="text" id="durasi_id" name="durasi_id" value="{{ old('durasi_id') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: 6-24 bulan">
                    </div>

                    <div>
                        <label for="visa_id" class="block text-sm font-semibold text-gray-700 mb-2">Visa</label>
                        <input type="text" id="visa_id" name="visa_id" value="{{ old('visa_id') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Jenis Visa">
                    </div>

                    <div>
                        <label for="gaji_id" class="block text-sm font-semibold text-gray-700 mb-2">Gaji</label>
                        <input type="text" id="gaji_id" name="gaji_id" value="{{ old('gaji_id') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Contoh: ¥150,000 - ¥250,000">
                    </div>

                    <div>
                        <label for="sertifikat_id" class="block text-sm font-semibold text-gray-700 mb-2">Sertifikat</label>
                        <input type="text" id="sertifikat_id" name="sertifikat_id" value="{{ old('sertifikat_id') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Jenis Sertifikat">
                    </div>
                </div>
            </div>

            <!-- Tab Content: English -->
            <div id="content-en" class="tab-content hidden">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-brand-pink mr-2"></i>
                    Basic Information (English)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="judul_en" class="block text-sm font-semibold text-gray-700 mb-2">Program Title</label>
                        <input type="text" id="judul_en" name="judul_en" value="{{ old('judul_en') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Enter program title">
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi_en" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea id="deskripsi_en" name="deskripsi_en" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Enter program description">{{ old('deskripsi_en') }}</textarea>
                    </div>

                    <div>
                        <label for="lokasi_en" class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                        <input type="text" id="lokasi_en" name="lokasi_en" value="{{ old('lokasi_en') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="e.g., Tokyo, Osaka, Nagoya">
                    </div>

                    <div>
                        <label for="durasi_en" class="block text-sm font-semibold text-gray-700 mb-2">Duration</label>
                        <input type="text" id="durasi_en" name="durasi_en" value="{{ old('durasi_en') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="e.g., 6-24 months">
                    </div>

                    <div>
                        <label for="visa_en" class="block text-sm font-semibold text-gray-700 mb-2">Visa</label>
                        <input type="text" id="visa_en" name="visa_en" value="{{ old('visa_en') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Visa Type">
                    </div>

                    <div>
                        <label for="gaji_en" class="block text-sm font-semibold text-gray-700 mb-2">Salary</label>
                        <input type="text" id="gaji_en" name="gaji_en" value="{{ old('gaji_en') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="e.g., ¥150,000 - ¥250,000">
                    </div>

                    <div>
                        <label for="sertifikat_en" class="block text-sm font-semibold text-gray-700 mb-2">Certificate</label>
                        <input type="text" id="sertifikat_en" name="sertifikat_en" value="{{ old('sertifikat_en') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="Certificate Type">
                    </div>
                </div>
            </div>

            <!-- Tab Content: Japanese -->
            <div id="content-jp" class="tab-content hidden">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-brand-pink mr-2"></i>
                    基本情報（日本語）
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="judul_jp" class="block text-sm font-semibold text-gray-700 mb-2">プログラムタイトル</label>
                        <input type="text" id="judul_jp" name="judul_jp" value="{{ old('judul_jp') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="プログラムタイトルを入力">
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi_jp" class="block text-sm font-semibold text-gray-700 mb-2">説明</label>
                        <textarea id="deskripsi_jp" name="deskripsi_jp" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="プログラムの説明を入力">{{ old('deskripsi_jp') }}</textarea>
                    </div>

                    <div>
                        <label for="lokasi_jp" class="block text-sm font-semibold text-gray-700 mb-2">場所</label>
                        <input type="text" id="lokasi_jp" name="lokasi_jp" value="{{ old('lokasi_jp') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="例：東京、大阪、名古屋">
                    </div>

                    <div>
                        <label for="durasi_jp" class="block text-sm font-semibold text-gray-700 mb-2">期間</label>
                        <input type="text" id="durasi_jp" name="durasi_jp" value="{{ old('durasi_jp') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="例：6-24ヶ月">
                    </div>

                    <div>
                        <label for="visa_jp" class="block text-sm font-semibold text-gray-700 mb-2">ビザ</label>
                        <input type="text" id="visa_jp" name="visa_jp" value="{{ old('visa_jp') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="ビザの種類">
                    </div>

                    <div>
                        <label for="gaji_jp" class="block text-sm font-semibold text-gray-700 mb-2">給料</label>
                        <input type="text" id="gaji_jp" name="gaji_jp" value="{{ old('gaji_jp') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="例：¥150,000 - ¥250,000">
                    </div>

                    <div>
                        <label for="sertifikat_jp" class="block text-sm font-semibold text-gray-700 mb-2">証明書</label>
                        <input type="text" id="sertifikat_jp" name="sertifikat_jp" value="{{ old('sertifikat_jp') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition"
                            placeholder="証明書の種類">
                    </div>
                </div>
            </div>

            <!-- Media & Pengaturan (Common for all languages) -->
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
                    </div>

                    <div>
                        <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">Urutan</label>
                        <input type="number" id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Urutan tampil program (angka lebih kecil tampil lebih dulu)</p>
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

<script>
function switchTab(lang) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-brand-pink', 'text-brand-pink');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById('content-' + lang).classList.remove('hidden');
    
    // Add active class to selected tab
    const selectedTab = document.getElementById('tab-' + lang);
    selectedTab.classList.add('active', 'border-brand-pink', 'text-brand-pink');
    selectedTab.classList.remove('border-transparent', 'text-gray-500');
}
</script>

<style>
.tab-button.active {
    border-bottom-color: #FF2E93;
    color: #FF2E93;
}
</style>
@endsection
