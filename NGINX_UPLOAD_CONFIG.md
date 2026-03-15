# Konfigurasi Nginx untuk Upload File

## Warning yang Terjadi
```
[warn] a client request body is buffered to a temporary file
```

Warning ini muncul ketika nginx perlu menyimpan request body ke temporary file karena ukuran request terlalu besar untuk buffer memory.

## Solusi

### 1. Validasi di Laravel (Sudah Diterapkan)
- Maksimal ukuran file: **5MB** per file
- Tipe file yang diizinkan: jpeg, jpg, png, gif, webp
- Validasi dilakukan di `SliderController` untuk mencegah upload file terlalu besar

### 2. Konfigurasi Nginx (Opsional - jika warning masih muncul)

Tambahkan atau update konfigurasi berikut di file nginx config:

```nginx
http {
    # Increase client body buffer size
    client_body_buffer_size 128k;
    
    # Increase max body size (sesuaikan dengan kebutuhan)
    client_max_body_size 10M;
    
    # Increase buffer size untuk upload
    client_body_temp_path /var/cache/nginx/client_temp;
    
    # Timeout untuk upload
    client_body_timeout 60s;
}
```

Atau untuk konfigurasi server spesifik:

```nginx
server {
    # ... konfigurasi lainnya ...
    
    client_max_body_size 10M;
    client_body_buffer_size 128k;
    client_body_timeout 60s;
}
```

### 3. Konfigurasi PHP (Pastikan sudah sesuai)

Pastikan di `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
max_input_time = 300
```

### Catatan
- Warning ini biasanya **tidak kritis** jika upload berhasil
- Validasi di Laravel sudah membatasi ukuran file menjadi 5MB
- Jika warning masih muncul, bisa diabaikan selama upload berhasil
- Untuk menghilangkan warning, update konfigurasi nginx seperti di atas
