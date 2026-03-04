# Troubleshooting S3 Configuration Error

## Error yang Terjadi
```
ERROR: League\Flysystem\AwsS3V3\AwsS3V3Adapter::__construct(): 
Argument #2 ($bucket) must be of type string, null given
```

## Penyebab
Error ini terjadi ketika variabel environment `AWS_BUCKET` tidak terbaca dengan benar dari file `.env`.

## Solusi

### 1. Pastikan File .env Terisi dengan Benar
Pastikan di file `.env` (baris 35-41) ada konfigurasi berikut:
```env
AWS_ACCESS_KEY_ID=your-access-key-id
AWS_SECRET_ACCESS_KEY=your-secret-access-key
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=fls-a137973c-ada3-4ed3-b3f9-7a6bd7d54698
AWS_URL=
AWS_ENDPOINT=
AWS_USE_PATH_STYLE_ENDPOINT=false
```

**PENTING:**
- Pastikan tidak ada spasi di sekitar tanda `=`
- Pastikan tidak ada tanda kutip (`"` atau `'`) di sekitar nilai
- Pastikan tidak ada karakter khusus yang tidak terlihat

### 2. Clear Cache Config di Server
Jalankan perintah berikut di server (via SSH):
```bash
cd /var/www/html
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

Atau jika menggunakan production:
```bash
php artisan config:cache --env=production
```

### 3. Verifikasi Variabel Environment
Untuk memastikan variabel terbaca, tambahkan sementara di controller untuk debug:
```php
dd([
    'bucket' => env('AWS_BUCKET'),
    'key' => env('AWS_ACCESS_KEY_ID'),
    'region' => env('AWS_DEFAULT_REGION'),
]);
```

### 4. Pastikan File .env Ada di Server
Pastikan file `.env` ada di root direktori project (`/var/www/html/.env`).

### 5. Set Permission File .env
Pastikan file `.env` bisa dibaca oleh web server:
```bash
chmod 644 /var/www/html/.env
chown www-data:www-data /var/www/html/.env
```

### 6. Restart Web Server
Setelah mengubah `.env`, restart web server:
```bash
# Untuk Nginx + PHP-FPM
sudo systemctl restart php8.2-fpm
sudo systemctl restart nginx

# Atau jika menggunakan Apache
sudo systemctl restart apache2
```

### 7. Cek Log Error
Cek log Laravel untuk detail error:
```bash
tail -f /var/www/html/storage/logs/laravel.log
```

## Checklist
- [ ] File `.env` ada di server
- [ ] Variabel `AWS_BUCKET` terisi dengan benar (tidak kosong)
- [ ] Tidak ada spasi di sekitar tanda `=`
- [ ] Sudah menjalankan `php artisan config:clear`
- [ ] Sudah menjalankan `php artisan config:cache`
- [ ] Permission file `.env` sudah benar (644)
- [ ] Web server sudah di-restart

## Catatan
Jika setelah melakukan semua langkah di atas masih error, pastikan:
1. Package `league/flysystem-aws-s3-v3` sudah terinstall: `composer show league/flysystem-aws-s3-v3`
2. Credentials AWS S3 valid dan bucket ada
3. IAM user memiliki permission untuk mengakses bucket
