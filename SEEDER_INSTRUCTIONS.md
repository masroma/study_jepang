# Instruksi Menjalankan Seeder

## Cara Menghapus Data dan Menjalankan Seeder

Untuk menghapus semua data existing dan mengisi dengan dummy data baru, jalankan perintah berikut:

```bash
php artisan db:seed
```

Atau jika ingin menjalankan seeder tertentu saja:

```bash
# Hapus semua data dulu
php artisan db:seed --class=ClearDataSeeder

# Kemudian jalankan seeder yang diinginkan
php artisan db:seed --class=KategoriSeeder
php artisan db:seed --class=BeritaSeeder
# dst...
```

## Seeder yang Tersedia

1. **ClearDataSeeder** - Menghapus semua data dari tabel (kecuali migrations dan users)
2. **KonfigurasiSeeder** - Data konfigurasi website (meghantara)
3. **KategoriSeeder** - 6 kategori berita
4. **BeritaSeeder** - 4 berita + 3 layanan
5. **GaleriSeeder** - 10 gambar (Homepage, Beritapage, Galeri)
6. **VideoSeeder** - 3 video testimoni
7. **ProgramMasaDepanSeeder** - 8 program kerja di Jepang
8. **IndustriSeeder** - 8 industri/sektor
9. **KisahSuksesSeeder** - 6 testimoni alumni
10. **HeroSliderSeeder** - 3 hero slider untuk homepage
11. **LokerSeeder** - 3 lowongan kerja
12. **BlogPostSeeder** - 8 artikel blog (sudah ada sebelumnya)

## Catatan Penting

- Pastikan database sudah di-migrate terlebih dahulu
- Seeder akan menghapus semua data existing sebelum mengisi data baru
- Pastikan ada minimal 1 user di tabel `users` (untuk foreign key di berita)
- Jika ada error foreign key, pastikan tabel `users` sudah ada datanya

## Troubleshooting

Jika ada error foreign key constraint:
1. Pastikan tabel `users` sudah ada dan memiliki minimal 1 record
2. Atau buat user dummy terlebih dahulu:
   ```sql
   INSERT INTO users (id_user, nama, username, email, password) 
   VALUES (1, 'Admin', 'admin', 'admin@example.com', 'password');
   ```
