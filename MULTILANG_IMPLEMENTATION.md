# Implementasi Multi-Bahasa (ID, EN, JP) untuk Admin V2

## Status
✅ **Migration sudah dibuat** untuk menambahkan field multi-bahasa ke semua tabel
✅ **Contoh implementasi** untuk modul Program Masa Depan sudah dibuat
⏳ **Perlu diupdate**: Controller dan View untuk semua modul lainnya

## Migration yang Sudah Dibuat

1. `2026_02_15_000001_add_multilang_to_program_masa_depan.php`
2. `2026_02_15_000002_add_multilang_to_industri.php`
3. `2026_02_15_000003_add_multilang_to_kisah_sukses.php`
4. `2026_02_15_000004_add_multilang_to_produk.php`
5. `2026_02_15_000005_add_multilang_to_layanan.php`
6. `2026_02_15_000006_add_multilang_to_loker.php`
7. `2026_02_15_000007_add_multilang_to_berita.php`

**Catatan**: Hero Sliders sudah memiliki struktur multi-bahasa dari awal.

## Cara Menjalankan Migration

```bash
php artisan migrate
```

## Struktur Field Multi-Bahasa

Setiap field yang perlu multi-bahasa akan memiliki 3 variasi:
- `field_name` (atau `field_name_id`) - Bahasa Indonesia
- `field_name_en` - Bahasa Inggris
- `field_name_jp` - Bahasa Jepang

### Contoh:
- `judul` → `judul_id`, `judul_en`, `judul_jp`
- `deskripsi` → `deskripsi_id`, `deskripsi_en`, `deskripsi_jp`

## Modul yang Perlu Diupdate

### 1. ✅ Program Masa Depan (Contoh Template)
- Controller: `ProgramMasaDepanV2Controller.php` - **SUDAH DIUPDATE**
- View Tambah: `tambah_multilang.blade.php` - **SUDAH DIBUAT** (contoh dengan tabs)
- View Edit: Perlu dibuat dengan struktur yang sama
- View Index: Perlu update untuk menampilkan bahasa yang dipilih

### 2. ⏳ Industri
- Controller: `IndustriV2Controller.php`
- View: `tambah.blade.php`, `edit.blade.php`
- Field: `nama`, `sub_nama`, `deskripsi`

### 3. ⏳ Kisah Sukses
- Controller: `KisahSuksesV2Controller.php`
- View: `tambah.blade.php`, `edit.blade.php`
- Field: `nama`, `pekerjaan`, `lokasi`, `testimoni`, `program`

### 4. ⏳ Produk
- Controller: `ProdukV2Controller.php`
- View: `tambah.blade.php`, `edit.blade.php`
- Field: `nama`, `kategori`, `deskripsi`, `spesifikasi`, `asal`, `sertifikasi`, `kemasan`

### 5. ⏳ Layanan
- Controller: `LayananV2Controller.php`
- View: `tambah.blade.php`, `edit.blade.php`
- Field: `judul`, `deskripsi`, `fitur`, `lokasi`

### 6. ⏳ Lowongan Pekerjaan (Loker)
- Controller: `LokerV2Controller.php`
- View: `tambah.blade.php`, `edit.blade.php`
- Field: `judul_loker`, `deskripsi_singkat`, `isi_loker`, `posisi`, `lokasi_kerja`, `tipe_kerja`, `persyaratan`, `tanggung_jawab`

### 7. ⏳ Berita
- Controller: `BeritaV2Controller.php`
- View: `tambah.blade.php`, `edit.blade.php`
- Field: `judul_berita`, `isi`, `keywords`

### 8. ✅ Slider (Hero Sliders)
- **SUDAH SUPPORT MULTI-BAHASA** dari awal
- Field: `title_id/en/jp`, `subtitle_id/en/jp`, `description_id/en/jp`, dll

## Template View dengan Tabs Multi-Bahasa

File contoh: `resources/views/admin/v2/program_masa_depan/tambah_multilang.blade.php`

### Struktur Tabs:
```html
<!-- Language Tabs -->
<div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8">
        <button type="button" onclick="switchTab('id')" id="tab-id" class="tab-button active">
            <img src="https://flagcdn.com/w20/id.png" class="inline mr-2">
            Indonesia
        </button>
        <button type="button" onclick="switchTab('en')" id="tab-en" class="tab-button">
            <img src="https://flagcdn.com/w20/us.png" class="inline mr-2">
            English
        </button>
        <button type="button" onclick="switchTab('jp')" id="tab-jp" class="tab-button">
            <img src="https://flagcdn.com/w20/jp.png" class="inline mr-2">
            日本語
        </button>
    </nav>
</div>

<!-- Tab Content -->
<div id="content-id" class="tab-content">
    <!-- Form fields dengan suffix _id -->
</div>
<div id="content-en" class="tab-content hidden">
    <!-- Form fields dengan suffix _en -->
</div>
<div id="content-jp" class="tab-content hidden">
    <!-- Form fields dengan suffix _jp -->
</div>
```

### JavaScript untuk Switch Tab:
```javascript
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
```

## Update Controller

### Validasi:
```php
$request->validate([
    'judul_id' => 'required|string|max:255',
    'judul_en' => 'nullable|string|max:255',
    'judul_jp' => 'nullable|string|max:255',
    // ... field lainnya dengan suffix _id, _en, _jp
]);
```

### Backward Compatibility:
```php
// Map old field names to new multi-language fields
if ($request->has('judul') && !$request->has('judul_id')) {
    $data['judul_id'] = $request->judul;
}
```

## Update Model (Opsional)

Tambahkan accessor untuk mendapatkan field berdasarkan bahasa:
```php
public function getJudulAttribute($value)
{
    $lang = app()->getLocale(); // atau dari request
    $field = 'judul_' . $lang;
    return $this->$field ?? $this->judul_id ?? $value;
}
```

## Langkah Selanjutnya

1. **Jalankan Migration**: `php artisan migrate`
2. **Update Controller**: Ikuti contoh di `ProgramMasaDepanV2Controller.php`
3. **Update View**: Gunakan template `tambah_multilang.blade.php` sebagai referensi
4. **Test**: Pastikan semua field multi-bahasa tersimpan dan ditampilkan dengan benar

## Catatan Penting

- Field dengan suffix `_id` adalah **required** (Bahasa Indonesia sebagai default)
- Field dengan suffix `_en` dan `_jp` adalah **optional**
- Untuk backward compatibility, field lama tetap digunakan sebagai `_id`
- Frontend akan menggunakan field sesuai bahasa yang dipilih user (ID, EN, JP)
