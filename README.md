# COMPANY PROFILE JEMARI EDU - LARAVEL 12
 Website Company Profile dengan Laravel 12. 
 CMS ini didedikasikan kepada Jemari Edu (http://jemari-edu.web.id).
 
 # Server Requirements
 Server Anda harus memenuhi kriteria ini:
- PHP >= 8.4.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
 
 # Cara Install di Localhost
 1. Download ZIP/RAR dari CMS ini
 2. Buat folder root Anda (misalnya *htdocs* jika menggunakan XAMPP)
 3. Extract file yang telah Anda unduh
 4. Copy isi file tersebut ke folder tersebut
 5. Buat database *jemari_edu* di MySQL/PHPMyAdmin Anda
 6. Import database *jemari_edu.sql* yang ada di folder *db*
 
# Cara install Online di Server:
Berikut cara install online di CPANEL:
1. Download ZIP/RAR dari CMS ini
2. Upload file ZIP tadi ke server Anda, lalu extract. Extract juga file *vendor.zip* ke folder utama tersebut
3. Buat database di server Anda
4. Import database jemari_edu.sql yang ada di folder db

# Konfigurasi file .env :
Selanjutnya lakukan konfigurasi file *.env* Anda sesuai dengan data website dan koneksi databasenya.
1. Buka file *.env.example*, rename menjadi *.env* lalu edit
2. Setting APP_URL=http://alamatwebsitemu,
3. Setting DB_DATABASE=namadatabase
4. Setting DB_USERNAME=usernamedatabase
5. Setting DB_PASSWORD=passworddatabase
6. Simpan kembali file .env

# Cara mengakses
 1. Buka browser
 2. Ketik alamat http://localhost/jemari-edu
 
 # Halaman Administrator
 - Buka alamat: http://localhost/jemari-edu/login
 - Username: root
 - Password:
