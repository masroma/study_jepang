# Panduan Update Pagination untuk Admin V2

## Status Update Controller
✅ **Semua controller sudah diupdate** untuk menggunakan pagination dengan perPage yang bisa diatur (default 10)

## Controller yang Sudah Diupdate:
1. ✅ ProgramMasaDepanV2Controller
2. ✅ IndustriV2Controller
3. ✅ KisahSuksesV2Controller
4. ✅ ProdukV2Controller
5. ✅ LayananV2Controller
6. ✅ LokerV2Controller
7. ✅ SliderController
8. ✅ BeritaV2Controller
9. ✅ PendaftaranLokerV2Controller
10. ✅ KontakV2Controller
11. ✅ QuotationV2Controller

## Template untuk Update View Index

### 1. Tambahkan Filter & Search dengan Per Page Selector

Tambahkan sebelum tabel/list:

```blade
<!-- Filter & Search -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
    <form method="GET" action="{{ url('admin/v2/[MODULE]') }}" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input type="text" name="search" value="{{ $current_search ?? '' }}" placeholder="Cari..."
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
        </div>
        <div class="md:w-48">
            <select name="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                <option value="">Semua Status</option>
                <option value="Publish" {{ ($current_status ?? '') == 'Publish' ? 'selected' : '' }}>Publish</option>
                <option value="Draft" {{ ($current_status ?? '') == 'Draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <div class="md:w-40">
            <select name="per_page" onchange="this.form.submit()" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                <option value="10" {{ ($current_per_page ?? 10) == 10 ? 'selected' : '' }}>10 per halaman</option>
                <option value="25" {{ ($current_per_page ?? 10) == 25 ? 'selected' : '' }}>25 per halaman</option>
                <option value="50" {{ ($current_per_page ?? 10) == 50 ? 'selected' : '' }}>50 per halaman</option>
                <option value="100" {{ ($current_per_page ?? 10) == 100 ? 'selected' : '' }}>100 per halaman</option>
            </select>
        </div>
        <button type="submit" class="px-6 py-2 bg-brand-pink text-white rounded-lg font-semibold hover:bg-brand-pink/90 transition">
            <i class="fas fa-search mr-2"></i>
            Cari
        </button>
        @if(($current_search ?? '') || ($current_status ?? ''))
        <a href="{{ url('admin/v2/[MODULE]') }}" class="px-6 py-2 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition">
            Reset
        </a>
        @endif
    </form>
</div>
```

### 2. Update Nomor Urut untuk Pagination

Ganti:
```blade
@php $no = 1; @endphp
```

Dengan:
```blade
@php $no = ($items->currentPage() - 1) * $items->perPage() + 1; @endphp
```

### 3. Tambahkan Pagination Links

Tambahkan setelah tabel (sebelum @else atau @endif):

```blade
<!-- Pagination -->
<div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
    <div class="text-sm text-gray-700">
        Menampilkan {{ $items->firstItem() ?? 0 }} sampai {{ $items->lastItem() ?? 0 }} dari {{ $items->total() }} item
    </div>
    <div class="flex items-center space-x-2">
        {{ $items->links('pagination::tailwind') }}
    </div>
</div>
```

## View yang Perlu Diupdate:

1. ✅ program_masa_depan/index.blade.php - **SUDAH DIUPDATE**
2. ✅ berita/index.blade.php - **SUDAH DIUPDATE** (perlu cek pagination)
3. ⏳ industri/index.blade.php
4. ⏳ kisah_sukses/index.blade.php
5. ⏳ produk/index.blade.php
6. ⏳ layanan/index.blade.php
7. ⏳ loker/index.blade.php
8. ⏳ slider/index.blade.php
9. ⏳ pelamar/index.blade.php (sudah ada search, perlu perPage selector)
10. ⏳ kontak/index.blade.php (sudah ada search, perlu perPage selector)
11. ⏳ quotation/index.blade.php (sudah ada search, perlu perPage selector)

## Catatan Penting:

- Semua controller sudah menggunakan `->paginate($perPage)->withQueryString()`
- Per page default: 10
- Opsi per page: 10, 25, 50, 100
- Pagination view sudah dibuat di `resources/views/pagination/tailwind.blade.php`
- Search sudah diimplementasikan di semua controller
- Filter status sudah diimplementasikan di semua controller

## Cara Update View:

1. Copy template Filter & Search di atas
2. Ganti `[MODULE]` dengan nama modul (contoh: `program-masa-depan`)
3. Update nomor urut menggunakan formula pagination
4. Tambahkan pagination links di akhir tabel
5. Pastikan semua variable sudah ada di controller (`current_search`, `current_status`, `current_per_page`)
