<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/* FRONT END */
// Home
Route::get('/', 'App\Http\Controllers\Home@index');
Route::get('home', 'App\Http\Controllers\Home@index');
Route::get('kontak', 'App\Http\Controllers\Home@kontak');
Route::get('pemesanan', 'App\Http\Controllers\Home@pemesanan');
Route::get('konfirmasi', 'App\Http\Controllers\Home@konfirmasi');
Route::get('pembayaran', 'App\Http\Controllers\Home@pembayaran');
Route::post('proses_pemesanan', 'App\Http\Controllers\Home@proses_pemesanan');
Route::get('berhasil/{par1}', 'App\Http\Controllers\Home@berhasil');
Route::get('cetak/{par1}', 'App\Http\Controllers\Home@cetak');
Route::get('info', 'App\Http\Controllers\Home@info');
// Route::get('aksi', 'App\Http\Controllers\Aksi@index');
// Route::get('aksi/status/{par1}', 'App\Http\Controllers\Aksi@status');
// Login
Route::get('login', 'App\Http\Controllers\Login@index');
Route::post('login/check', 'App\Http\Controllers\Login@check');
Route::get('login/lupa', 'App\Http\Controllers\Login@lupa');
Route::post('login/lupa', 'App\Http\Controllers\Login@lupa_proses');
Route::get('login/logout', 'App\Http\Controllers\Login@logout');
// Berita
Route::get('berita', 'App\Http\Controllers\Berita@index');
Route::get('berita/read/{par1}', 'App\Http\Controllers\Berita@read');
Route::get('berita/layanan/{par1}', 'App\Http\Controllers\Berita@layanan');
Route::get('berita/terjadi/{par1}', 'App\Http\Controllers\Berita@terjadi');
Route::get('berita/kategori/{par1}', 'App\Http\Controllers\Berita@kategori');
// Kisah Sukses
Route::get('kisah-sukses', 'App\Http\Controllers\KisahSuksesController@index');
// Training Center
Route::get('training-center', 'App\Http\Controllers\TrainingCenter@index');
// Blog
Route::get('blog', 'App\Http\Controllers\Blog@index')->name('blog.index');
Route::get('blog/detail/{slug}', 'App\Http\Controllers\Blog@detail')->name('blog.detail');
Route::get('blog/kategori/{kategori}', 'App\Http\Controllers\Blog@byCategory')->name('blog.category');
Route::get('blog/search', 'App\Http\Controllers\Blog@search')->name('blog.search');
// Kontak
Route::get('kontak', 'App\Http\Controllers\Home@kontak');
Route::post('kontak/kirim', 'App\Http\Controllers\Home@kirim_pesan');
// Daftar
Route::get('daftar', 'App\Http\Controllers\Daftar@index');
Route::post('daftar/proses', 'App\Http\Controllers\Daftar@proses');
Route::get('daftar/verifikasi', 'App\Http\Controllers\Daftar@verifikasi');
Route::post('daftar/verifikasi', 'App\Http\Controllers\Daftar@verifikasi_proses');
Route::post('daftar/kirim-ulang-otp', 'App\Http\Controllers\Daftar@kirim_ulang_otp');
// Akreditasi
// Route::get('provider-akreditasi', 'App\Http\Controllers\Akreditasi@index');
// Route::get('akreditasi/read/{par1}', 'App\Http\Controllers\Akreditasi@read');
// Route::get('layanan/{par1}', 'App\Http\Controllers\Akreditasi@layanan');
Route::get('layanan/{par1}', 'App\Http\Controllers\Berita@layanan');
// Route::get('akreditasi/kategori/{par1}', 'App\Http\Controllers\Akreditasi@kategori');
// project
Route::get('project', 'App\Http\Controllers\Download@index');
Route::get('project/unduh/{par1}', 'App\Http\Controllers\Download@unduh');
Route::get('project/kategori/{par1}', 'App\Http\Controllers\Download@kategori');
Route::get('dokumen', 'App\Http\Controllers\Download@index');
Route::get('dokumen/unduh/{par1}', 'App\Http\Controllers\Download@unduh');
Route::get('dokumen/detail/{par1}/{par2}', 'App\Http\Controllers\Download@detail');
Route::get('project/detail/{par1}/{par2}', 'App\Http\Controllers\Download@detail');
// galeri
Route::get('galeri', 'App\Http\Controllers\Galeri@index');
Route::get('galeri/detail/{par1}', 'App\Http\Controllers\Galeri@detail');
// agenda
Route::get('agenda', 'App\Http\Controllers\Agenda@index');
Route::get('agenda/detail/{par1}', 'App\Http\Controllers\Agenda@detail');
// video
Route::get('video', 'App\Http\Controllers\Video@index');
Route::get('video/detail/{par1}', 'App\Http\Controllers\Video@detail');
Route::get('webinar', 'App\Http\Controllers\Video@index');
Route::get('webinar/detail/{par1}/{par2}', 'App\Http\Controllers\Video@detail');
// loker
Route::get('loker', 'App\Http\Controllers\Loker@index');
Route::get('loker/detail/{slug_loker}', 'App\Http\Controllers\Loker@detail');
Route::post('loker/proses_pendaftaran', 'App\Http\Controllers\Loker@proses_pendaftaran');
// Company Profile / About Us
Route::get('tentang-kami', 'App\Http\Controllers\CompanyProfile@index');
Route::get('about-us', 'App\Http\Controllers\CompanyProfile@index');
Route::get('company-profile', 'App\Http\Controllers\CompanyProfile@index');
// Product / Komoditas
Route::get('produk', 'App\Http\Controllers\Product@index');
Route::get('product', 'App\Http\Controllers\Product@index');
Route::get('komoditas', 'App\Http\Controllers\Product@index');
Route::get('produk/request-quotation', 'App\Http\Controllers\Product@requestQuotation')->name('produk.request-quotation');
Route::post('produk/request-quotation', 'App\Http\Controllers\Product@kirimQuotation');
// Service / Layanan
Route::get('layanan', 'App\Http\Controllers\Service@index');
Route::get('service', 'App\Http\Controllers\Service@index');
// Proyek
// Route::get('proyek', 'App\Http\Controllers\Proyek@index');
// Route::get('proyek/kategori/{par1}', 'App\Http\Controllers\Proyek@kategori');
// Route::get('proyek/detail/{par1}', 'App\Http\Controllers\Proyek@detail');
// Route::get('proyek/cetak/{par1}', 'App\Http\Controllers\Proyek@cetak');
/* BACK END */

// Member Portal Routes
Route::prefix('member')->group(function() {
    Route::get('dashboard', 'App\Http\Controllers\Member\Dashboard@index');
    Route::get('lamaran', 'App\Http\Controllers\Member\Lamaran@index');
    Route::get('lamaran/detail/{id_pendaftaran}', 'App\Http\Controllers\Member\Lamaran@detail');
    Route::get('lamaran/download-cv/{id_pendaftaran}', 'App\Http\Controllers\Member\Lamaran@download_cv');
    Route::get('quotation', 'App\Http\Controllers\Member\Quotation@index');
    Route::get('quotation/detail/{id_kontak}', 'App\Http\Controllers\Member\Quotation@detail');
    Route::get('quotation/baru', 'App\Http\Controllers\Member\Quotation@baru');
    Route::post('quotation/kirim', 'App\Http\Controllers\Member\Quotation@kirim');
    Route::get('profile', 'App\Http\Controllers\Member\Profile@index');
    Route::post('profile/update', 'App\Http\Controllers\Member\Profile@update');
    Route::get('password', 'App\Http\Controllers\Member\Profile@password');
    Route::post('password/update', 'App\Http\Controllers\Member\Profile@updatePassword');
});

// admin redirect
Route::get('admin', function () {
    return redirect('admin/v2');
});

// Admin V2 - Dashboard Baru
Route::get('admin/v2', 'App\Http\Controllers\Admin\DashboardV2@index');
Route::get('admin/v2/profile/edit', 'App\Http\Controllers\Admin\DashboardV2@editProfile');
Route::post('admin/v2/profile/update', 'App\Http\Controllers\Admin\DashboardV2@updateProfile');
Route::get('admin/v2/password/edit', 'App\Http\Controllers\Admin\DashboardV2@editPassword');
Route::post('admin/v2/password/update', 'App\Http\Controllers\Admin\DashboardV2@updatePassword');
Route::get('admin/v2/logout', 'App\Http\Controllers\Admin\DashboardV2@logout');
// Admin V2 - Setting
Route::get('admin/v2/setting', 'App\Http\Controllers\Admin\Setting@index');
Route::post('admin/v2/setting/update', 'App\Http\Controllers\Admin\Setting@update');
// Admin V2 - Slider
Route::get('admin/v2/slider', 'App\Http\Controllers\Admin\SliderController@index');
Route::get('admin/v2/slider/tambah', 'App\Http\Controllers\Admin\SliderController@tambah');
Route::get('admin/v2/slider/edit/{id}', 'App\Http\Controllers\Admin\SliderController@edit');
Route::get('admin/v2/slider/delete/{id}', 'App\Http\Controllers\Admin\SliderController@delete');
Route::post('admin/v2/slider/tambah_proses', 'App\Http\Controllers\Admin\SliderController@tambah_proses');
Route::post('admin/v2/slider/edit_proses', 'App\Http\Controllers\Admin\SliderController@edit_proses');
// Admin V2 - Program Masa Depan
Route::get('admin/v2/program-masa-depan', 'App\Http\Controllers\Admin\ProgramMasaDepanV2Controller@index');
Route::get('admin/v2/program-masa-depan/tambah', 'App\Http\Controllers\Admin\ProgramMasaDepanV2Controller@tambah');
Route::get('admin/v2/program-masa-depan/edit/{id_program}', 'App\Http\Controllers\Admin\ProgramMasaDepanV2Controller@edit');
Route::get('admin/v2/program-masa-depan/delete/{id_program}', 'App\Http\Controllers\Admin\ProgramMasaDepanV2Controller@delete');
Route::post('admin/v2/program-masa-depan/tambah_proses', 'App\Http\Controllers\Admin\ProgramMasaDepanV2Controller@tambah_proses');
Route::post('admin/v2/program-masa-depan/edit_proses', 'App\Http\Controllers\Admin\ProgramMasaDepanV2Controller@edit_proses');
// Admin V2 - Industri
Route::get('admin/v2/industri', 'App\Http\Controllers\Admin\IndustriV2Controller@index');
Route::get('admin/v2/industri/tambah', 'App\Http\Controllers\Admin\IndustriV2Controller@tambah');
Route::get('admin/v2/industri/edit/{id_industri}', 'App\Http\Controllers\Admin\IndustriV2Controller@edit');
Route::get('admin/v2/industri/delete/{id_industri}', 'App\Http\Controllers\Admin\IndustriV2Controller@delete');
Route::post('admin/v2/industri/tambah_proses', 'App\Http\Controllers\Admin\IndustriV2Controller@tambah_proses');
Route::post('admin/v2/industri/edit_proses', 'App\Http\Controllers\Admin\IndustriV2Controller@edit_proses');
// Admin V2 - Kisah Sukses
Route::get('admin/v2/kisah-sukses', 'App\Http\Controllers\Admin\KisahSuksesV2Controller@index');
Route::get('admin/v2/kisah-sukses/tambah', 'App\Http\Controllers\Admin\KisahSuksesV2Controller@tambah');
Route::get('admin/v2/kisah-sukses/edit/{id_kisah}', 'App\Http\Controllers\Admin\KisahSuksesV2Controller@edit');
Route::get('admin/v2/kisah-sukses/delete/{id_kisah}', 'App\Http\Controllers\Admin\KisahSuksesV2Controller@delete');
Route::post('admin/v2/kisah-sukses/tambah_proses', 'App\Http\Controllers\Admin\KisahSuksesV2Controller@tambah_proses');
Route::post('admin/v2/kisah-sukses/edit_proses', 'App\Http\Controllers\Admin\KisahSuksesV2Controller@edit_proses');
// Admin V2 - Tentang Kami
Route::get('admin/v2/tentang-kami', 'App\Http\Controllers\Admin\TentangKamiV2Controller@index');
Route::post('admin/v2/tentang-kami/update', 'App\Http\Controllers\Admin\TentangKamiV2Controller@update');
// Admin V2 - Produk
Route::get('admin/v2/produk', 'App\Http\Controllers\Admin\ProdukV2Controller@index');
Route::get('admin/v2/produk/tambah', 'App\Http\Controllers\Admin\ProdukV2Controller@tambah');
Route::get('admin/v2/produk/edit/{id_produk}', 'App\Http\Controllers\Admin\ProdukV2Controller@edit');
Route::get('admin/v2/produk/delete/{id_produk}', 'App\Http\Controllers\Admin\ProdukV2Controller@delete');
Route::post('admin/v2/produk/tambah_proses', 'App\Http\Controllers\Admin\ProdukV2Controller@tambah_proses');
Route::post('admin/v2/produk/edit_proses', 'App\Http\Controllers\Admin\ProdukV2Controller@edit_proses');
// Admin V2 - Layanan
Route::get('admin/v2/layanan', 'App\Http\Controllers\Admin\LayananV2Controller@index');
Route::get('admin/v2/layanan/tambah', 'App\Http\Controllers\Admin\LayananV2Controller@tambah');
Route::get('admin/v2/layanan/edit/{id_layanan}', 'App\Http\Controllers\Admin\LayananV2Controller@edit');
Route::get('admin/v2/layanan/delete/{id_layanan}', 'App\Http\Controllers\Admin\LayananV2Controller@delete');
Route::post('admin/v2/layanan/tambah_proses', 'App\Http\Controllers\Admin\LayananV2Controller@tambah_proses');
Route::post('admin/v2/layanan/edit_proses', 'App\Http\Controllers\Admin\LayananV2Controller@edit_proses');
// Admin V2 - Lowongan Pekerjaan
Route::get('admin/v2/loker', 'App\Http\Controllers\Admin\LokerV2Controller@index');
Route::get('admin/v2/loker/tambah', 'App\Http\Controllers\Admin\LokerV2Controller@tambah');
Route::get('admin/v2/loker/edit/{id_loker}', 'App\Http\Controllers\Admin\LokerV2Controller@edit');
Route::get('admin/v2/loker/delete/{id_loker}', 'App\Http\Controllers\Admin\LokerV2Controller@delete');
Route::post('admin/v2/loker/tambah_proses', 'App\Http\Controllers\Admin\LokerV2Controller@tambah_proses');
Route::post('admin/v2/loker/edit_proses', 'App\Http\Controllers\Admin\LokerV2Controller@edit_proses');
// Admin V2 - Pelamar
Route::get('admin/v2/pelamar', 'App\Http\Controllers\Admin\PendaftaranLokerV2Controller@index');
Route::get('admin/v2/pelamar/detail/{id_pendaftaran}', 'App\Http\Controllers\Admin\PendaftaranLokerV2Controller@detail');
Route::get('admin/v2/pelamar/delete/{id_pendaftaran}', 'App\Http\Controllers\Admin\PendaftaranLokerV2Controller@delete');
Route::get('admin/v2/pelamar/download-cv/{id_pendaftaran}', 'App\Http\Controllers\Admin\PendaftaranLokerV2Controller@download_cv');
Route::post('admin/v2/pelamar/update-status', 'App\Http\Controllers\Admin\PendaftaranLokerV2Controller@update_status');
// Admin V2 - Request Quotation
Route::get('admin/v2/quotation', 'App\Http\Controllers\Admin\QuotationV2Controller@index');
Route::get('admin/v2/quotation/detail/{id_kontak}', 'App\Http\Controllers\Admin\QuotationV2Controller@detail');
Route::get('admin/v2/quotation/delete/{id_kontak}', 'App\Http\Controllers\Admin\QuotationV2Controller@delete');
Route::post('admin/v2/quotation/update-status', 'App\Http\Controllers\Admin\QuotationV2Controller@update_status');
// Admin V2 - Kontak
Route::get('admin/v2/kontak', 'App\Http\Controllers\Admin\KontakV2Controller@index');
Route::get('admin/v2/kontak/detail/{id_kontak}', 'App\Http\Controllers\Admin\KontakV2Controller@detail');
Route::get('admin/v2/kontak/delete/{id_kontak}', 'App\Http\Controllers\Admin\KontakV2Controller@delete');
Route::post('admin/v2/kontak/update-status', 'App\Http\Controllers\Admin\KontakV2Controller@update_status');
// Admin V2 - Berita
Route::get('admin/v2/berita', 'App\Http\Controllers\Admin\BeritaV2Controller@index');
Route::get('admin/v2/berita/tambah', 'App\Http\Controllers\Admin\BeritaV2Controller@tambah');
Route::get('admin/v2/berita/edit/{id_berita}', 'App\Http\Controllers\Admin\BeritaV2Controller@edit');
Route::get('admin/v2/berita/delete/{id_berita}', 'App\Http\Controllers\Admin\BeritaV2Controller@delete');
Route::post('admin/v2/berita/tambah_proses', 'App\Http\Controllers\Admin\BeritaV2Controller@tambah_proses');
Route::post('admin/v2/berita/edit_proses', 'App\Http\Controllers\Admin\BeritaV2Controller@edit_proses');

// dasbor
Route::get('admin/dasbor', 'App\Http\Controllers\Admin\Dasbor@index');
Route::get('admin/dasbor/konfigurasi', 'App\Http\Controllers\Admin\Dasbor@konfigurasi');
// pemesanan
// Route::get('admin/pemesanan', 'App\Http\Controllers\Admin\Pemesanan@index');
// Route::get('admin/pemesanan/tambah', 'App\Http\Controllers\Admin\Pemesanan@tambah');
// Route::get('admin/pemesanan/detail/{par1}', 'App\Http\Controllers\Admin\Pemesanan@detail');
// Route::get('admin/pemesanan/status_pemesanan/{par1}', 'App\Http\Controllers\Admin\Pemesanan@status_pemesanan');
// Route::get('admin/pemesanan/cetak/{par1}', 'App\Http\Controllers\Admin\Pemesanan@cetak');
// Route::get('admin/pemesanan/edit/{par1}', 'App\Http\Controllers\Admin\Pemesanan@edit');
// Route::get('admin/pemesanan/filter/{par1}/{par2}/{par3}', 'App\Http\Controllers\Admin\Pemesanan@filter');
// Route::get('admin/pemesanan/cari', 'App\Http\Controllers\Admin\Pemesanan@cari');
// Route::post('admin/pemesanan/proses', 'App\Http\Controllers\Admin\Pemesanan@proses');
// Route::post('admin/pemesanan/tambah_proses', 'App\Http\Controllers\Admin\Pemesanan@tambah_proses');
// Route::post('admin/pemesanan/edit_proses', 'App\Http\Controllers\Admin\Pemesanan@edit_proses');
// user
Route::get('admin/user', 'App\Http\Controllers\Admin\User@index');
Route::post('admin/user/tambah', 'App\Http\Controllers\Admin\User@tambah');
Route::get('admin/user/edit/{par1}', 'App\Http\Controllers\Admin\User@edit');
Route::post('admin/user/proses_edit', 'App\Http\Controllers\Admin\User@proses_edit');
Route::get('admin/user/delete/{par1}', 'App\Http\Controllers\Admin\User@delete');
Route::post('admin/user/proses', 'App\Http\Controllers\Admin\User@proses');
// konfigurasi
Route::get('admin/konfigurasi', 'App\Http\Controllers\Admin\Konfigurasi@index');
Route::get('admin/konfigurasi/logo', 'App\Http\Controllers\Admin\Konfigurasi@logo');
Route::get('admin/konfigurasi/profil', 'App\Http\Controllers\Admin\Konfigurasi@profil');
Route::get('admin/konfigurasi/icon', 'App\Http\Controllers\Admin\Konfigurasi@icon');
Route::get('admin/konfigurasi/email', 'App\Http\Controllers\Admin\Konfigurasi@email');
Route::get('admin/konfigurasi/gambar', 'App\Http\Controllers\Admin\Konfigurasi@gambar');
Route::get('admin/konfigurasi/pembayaran', 'App\Http\Controllers\Admin\Konfigurasi@pembayaran');
Route::post('admin/konfigurasi/proses', 'App\Http\Controllers\Admin\Konfigurasi@proses');
Route::post('admin/konfigurasi/proses_logo', 'App\Http\Controllers\Admin\Konfigurasi@proses_logo');
Route::post('admin/konfigurasi/proses_icon', 'App\Http\Controllers\Admin\Konfigurasi@proses_icon');
Route::post('admin/konfigurasi/proses_email', 'App\Http\Controllers\Admin\Konfigurasi@proses_email');
Route::post('admin/konfigurasi/proses_gambar', 'App\Http\Controllers\Admin\Konfigurasi@proses_gambar');
Route::post('admin/konfigurasi/proses_pembayaran', 'App\Http\Controllers\Admin\Konfigurasi@proses_pembayaran');
Route::post('admin/konfigurasi/proses_profil', 'App\Http\Controllers\Admin\Konfigurasi@proses_profil');
// berita
Route::get('admin/berita', 'App\Http\Controllers\Admin\Berita@index');
Route::get('admin/berita/cari', 'App\Http\Controllers\Admin\Berita@cari');
Route::get('admin/berita/status_berita/{par1}', 'App\Http\Controllers\Admin\Berita@status_berita');
Route::get('admin/berita/kategori/{par1}', 'App\Http\Controllers\Admin\Berita@kategori');
Route::get('admin/berita/jenis_berita/{par1}', 'App\Http\Controllers\Admin\Berita@jenis_berita');
Route::get('admin/berita/author/{par1}', 'App\Http\Controllers\Admin\Berita@author');
Route::get('admin/berita/tambah', 'App\Http\Controllers\Admin\Berita@tambah');
Route::get('admin/berita/edit/{par1}', 'App\Http\Controllers\Admin\Berita@edit');
Route::get('admin/berita/delete/{par1}/{par2}', 'App\Http\Controllers\Admin\Berita@delete');
Route::post('admin/berita/tambah_proses', 'App\Http\Controllers\Admin\Berita@tambah_proses');
Route::post('admin/berita/edit_proses', 'App\Http\Controllers\Admin\Berita@edit_proses');
Route::post('admin/berita/proses', 'App\Http\Controllers\Admin\Berita@proses');
Route::get('admin/berita/add', 'App\Http\Controllers\Admin\Berita@add');
// agenda
Route::get('admin/agenda', 'App\Http\Controllers\Admin\Agenda@index');
Route::get('admin/agenda/cari', 'App\Http\Controllers\Admin\Agenda@cari');
Route::get('admin/agenda/status_agenda/{par1}', 'App\Http\Controllers\Admin\Agenda@status_agenda');
Route::get('admin/agenda/kategori/{par1}', 'App\Http\Controllers\Admin\Agenda@kategori');
Route::get('admin/agenda/jenis_agenda/{par1}', 'App\Http\Controllers\Admin\Agenda@jenis_agenda');
Route::get('admin/agenda/author/{par1}', 'App\Http\Controllers\Admin\Agenda@author');
Route::get('admin/agenda/tambah', 'App\Http\Controllers\Admin\Agenda@tambah');
Route::get('admin/agenda/edit/{par1}', 'App\Http\Controllers\Admin\Agenda@edit');
Route::get('admin/agenda/delete/{par1}', 'App\Http\Controllers\Admin\Agenda@delete');
Route::post('admin/agenda/tambah_proses', 'App\Http\Controllers\Admin\Agenda@tambah_proses');
Route::post('admin/agenda/edit_proses', 'App\Http\Controllers\Admin\Agenda@edit_proses');
Route::post('admin/agenda/proses', 'App\Http\Controllers\Admin\Agenda@proses');
Route::get('admin/agenda/add', 'App\Http\Controllers\Admin\Agenda@add');
// rekening
Route::get('admin/rekening', 'App\Http\Controllers\Admin\Rekening@index');
Route::get('admin/rekening/edit/{par1}', 'App\Http\Controllers\Admin\Rekening@edit');
Route::post('admin/rekening/tambah', 'App\Http\Controllers\Admin\Rekening@tambah');
Route::post('admin/rekening/proses_edit', 'App\Http\Controllers\Admin\Rekening@proses_edit');
Route::get('admin/rekening/delete/{par1}', 'App\Http\Controllers\Admin\Rekening@delete');
Route::post('admin/rekening/proses', 'App\Http\Controllers\Admin\Rekening@proses');
// kategori
Route::get('admin/kategori', 'App\Http\Controllers\Admin\Kategori@index');
Route::post('admin/kategori/tambah', 'App\Http\Controllers\Admin\Kategori@tambah');
Route::post('admin/kategori/edit', 'App\Http\Controllers\Admin\Kategori@edit');
Route::get('admin/kategori/delete/{par1}', 'App\Http\Controllers\Admin\Kategori@delete');
// status
// Route::get('admin/status_site', 'App\Http\Controllers\Admin\Status_site@index');
// Route::post('admin/status_site/tambah', 'App\Http\Controllers\Admin\Status_site@tambah');
// Route::post('admin/status_site/edit', 'App\Http\Controllers\Admin\Status_site@edit');
// Route::get('admin/status_site/delete/{par1}', 'App\Http\Controllers\Admin\Status_site@delete');
// status
Route::get('admin/heading', 'App\Http\Controllers\Admin\Heading@index');
Route::post('admin/heading/tambah', 'App\Http\Controllers\Admin\Heading@tambah');
Route::post('admin/heading/edit', 'App\Http\Controllers\Admin\Heading@edit');
Route::get('admin/heading/delete/{par1}', 'App\Http\Controllers\Admin\Heading@delete');
// status
// Route::get('admin/status_proyek', 'App\Http\Controllers\Admin\Status_proyek@index');
// Route::post('admin/status_proyek/tambah', 'App\Http\Controllers\Admin\Status_proyek@tambah');
// Route::post('admin/status_proyek/edit', 'App\Http\Controllers\Admin\Status_proyek@edit');
// Route::get('admin/status_proyek/delete/{par1}', 'App\Http\Controllers\Admin\Status_proyek@delete');
// video
Route::get('admin/video', 'App\Http\Controllers\Admin\Video@index');
Route::get('admin/video/edit/{par1}', 'App\Http\Controllers\Admin\Video@edit');
Route::post('admin/video/tambah', 'App\Http\Controllers\Admin\Video@tambah');
Route::post('admin/video/proses_edit', 'App\Http\Controllers\Admin\Video@proses_edit');
Route::get('admin/video/delete/{par1}', 'App\Http\Controllers\Admin\Video@delete');
Route::post('admin/video/proses', 'App\Http\Controllers\Admin\Video@proses');
// kategori_proyek
// Route::get('admin/kategori_proyek', 'App\Http\Controllers\Admin\Kategori_proyek@index');
// Route::post('admin/kategori_proyek/tambah', 'App\Http\Controllers\Admin\Kategori_proyek@tambah');
// Route::post('admin/kategori_proyek/edit', 'App\Http\Controllers\Admin\Kategori_proyek@edit');
// Route::get('admin/kategori_proyek/delete/{par1}', 'App\Http\Controllers\Admin\Kategori_proyek@delete');
// kategori_download
Route::get('admin/kategori_project', 'App\Http\Controllers\Admin\Kategori_download@index');
Route::post('admin/kategori_project/tambah', 'App\Http\Controllers\Admin\Kategori_download@tambah');
Route::post('admin/kategori_project/edit', 'App\Http\Controllers\Admin\Kategori_download@edit');
Route::get('admin/kategori_project/delete/{par1}', 'App\Http\Controllers\Admin\Kategori_download@delete');
// kategori_galeri
Route::get('admin/kategori_galeri', 'App\Http\Controllers\Admin\Kategori_galeri@index');
Route::post('admin/kategori_galeri/tambah', 'App\Http\Controllers\Admin\Kategori_galeri@tambah');
Route::post('admin/kategori_galeri/edit', 'App\Http\Controllers\Admin\Kategori_galeri@edit');
Route::get('admin/kategori_galeri/delete/{par1}', 'App\Http\Controllers\Admin\Kategori_galeri@delete');
// kategori_staff
Route::get('admin/kategori_staff', 'App\Http\Controllers\Admin\Kategori_staff@index');
Route::post('admin/kategori_staff/tambah', 'App\Http\Controllers\Admin\Kategori_staff@tambah');
Route::post('admin/kategori_staff/edit', 'App\Http\Controllers\Admin\Kategori_staff@edit');
Route::get('admin/kategori_staff/delete/{par1}', 'App\Http\Controllers\Admin\Kategori_staff@delete');
// kategori_agenda
Route::get('admin/kategori_agenda', 'App\Http\Controllers\Admin\Kategori_agenda@index');
Route::post('admin/kategori_agenda/tambah', 'App\Http\Controllers\Admin\Kategori_agenda@tambah');
Route::post('admin/kategori_agenda/edit', 'App\Http\Controllers\Admin\Kategori_agenda@edit');
Route::get('admin/kategori_agenda/delete/{par1}', 'App\Http\Controllers\Admin\Kategori_agenda@delete');
// kategori_akreditasi
// Route::get('admin/kategori_akreditasi', 'App\Http\Controllers\Admin\Kategori_akreditasi@index');
// Route::post('admin/kategori_akreditasi/tambah', 'App\Http\Controllers\Admin\Kategori_akreditasi@tambah');
// Route::post('admin/kategori_akreditasi/edit', 'App\Http\Controllers\Admin\Kategori_akreditasi@edit');
// Route::get('admin/kategori_akreditasi/delete/{par1}', 'App\Http\Controllers\Admin\Kategori_akreditasi@delete');
// galeri
Route::get('admin/galeri', 'App\Http\Controllers\Admin\Galeri@index');
Route::get('admin/galeri/cari', 'App\Http\Controllers\Admin\Galeri@cari');
Route::get('admin/galeri/status_galeri/{par1}', 'App\Http\Controllers\Admin\Galeri@status_galeri');
Route::get('admin/galeri/kategori/{par1}', 'App\Http\Controllers\Admin\Galeri@kategori');
Route::get('admin/galeri/tambah', 'App\Http\Controllers\Admin\Galeri@tambah');
Route::get('admin/galeri/edit/{par1}', 'App\Http\Controllers\Admin\Galeri@edit');
Route::get('admin/galeri/delete/{par1}', 'App\Http\Controllers\Admin\Galeri@delete');
Route::post('admin/galeri/tambah_proses', 'App\Http\Controllers\Admin\Galeri@tambah_proses');
Route::post('admin/galeri/edit_proses', 'App\Http\Controllers\Admin\Galeri@edit_proses');
Route::post('admin/galeri/proses', 'App\Http\Controllers\Admin\Galeri@proses');
// staff
Route::get('admin/staff', 'App\Http\Controllers\Admin\Staff@index');
Route::get('admin/staff/cari', 'App\Http\Controllers\Admin\Staff@cari');
Route::get('admin/staff/status_staff/{par1}', 'App\Http\Controllers\Admin\Staff@status_staff');
Route::get('admin/staff/kategori/{par1}', 'App\Http\Controllers\Admin\Staff@kategori');
Route::get('admin/staff/detail/{par1}', 'App\Http\Controllers\Admin\Staff@detail');
Route::get('admin/staff/tambah', 'App\Http\Controllers\Admin\Staff@tambah');
Route::get('admin/staff/edit/{par1}', 'App\Http\Controllers\Admin\Staff@edit');
Route::get('admin/staff/delete/{par1}', 'App\Http\Controllers\Admin\Staff@delete');
Route::post('admin/staff/tambah_proses', 'App\Http\Controllers\Admin\Staff@tambah_proses');
Route::post('admin/staff/edit_proses', 'App\Http\Controllers\Admin\Staff@edit_proses');
Route::post('admin/staff/proses', 'App\Http\Controllers\Admin\Staff@proses');
// site
// Route::get('admin/site', 'App\Http\Controllers\Admin\Site@index');
// Route::get('admin/site/cari', 'App\Http\Controllers\Admin\Site@cari');
// Route::get('admin/site/status_site/{par1}', 'App\Http\Controllers\Admin\Site@status_site');
// Route::get('admin/site/kategori/{par1}', 'App\Http\Controllers\Admin\Site@kategori');
// Route::get('admin/site/detail/{par1}', 'App\Http\Controllers\Admin\Site@detail');
// Route::get('admin/site/tambah', 'App\Http\Controllers\Admin\Site@tambah');
// Route::get('admin/site/edit/{par1}', 'App\Http\Controllers\Admin\Site@edit');
// Route::get('admin/site/status/{par1}', 'App\Http\Controllers\Admin\Site@status');
// Route::get('admin/site/delete/{par1}', 'App\Http\Controllers\Admin\Site@delete');
// Route::post('admin/site/tambah_proses', 'App\Http\Controllers\Admin\Site@tambah_proses');
// Route::post('admin/site/edit_proses', 'App\Http\Controllers\Admin\Site@edit_proses');
// Route::post('admin/site/proses', 'App\Http\Controllers\Admin\Site@proses');
// proyek
// Route::get('admin/proyek', 'App\Http\Controllers\Admin\Proyek@index');
// Route::get('admin/proyek/cari', 'App\Http\Controllers\Admin\Proyek@cari');
// Route::get('admin/proyek/status_proyek/{par1}', 'App\Http\Controllers\Admin\Proyek@status_proyek');
// Route::get('admin/proyek/kategori/{par1}', 'App\Http\Controllers\Admin\Proyek@kategori');
// Route::get('admin/proyek/detail/{par1}', 'App\Http\Controllers\Admin\Proyek@detail');
// Route::get('admin/proyek/tambah', 'App\Http\Controllers\Admin\Proyek@tambah');
// Route::get('admin/proyek/edit/{par1}', 'App\Http\Controllers\Admin\Proyek@edit');
// Route::get('admin/proyek/status/{par1}', 'App\Http\Controllers\Admin\Proyek@status');
// Route::get('admin/proyek/delete/{par1}', 'App\Http\Controllers\Admin\Proyek@delete');
// Route::post('admin/proyek/tambah_proses', 'App\Http\Controllers\Admin\Proyek@tambah_proses');
// Route::post('admin/proyek/edit_proses', 'App\Http\Controllers\Admin\Proyek@edit_proses');
// Route::post('admin/proyek/proses', 'App\Http\Controllers\Admin\Proyek@proses');
// akreditasi
// Route::get('admin/akreditasi', 'App\Http\Controllers\Admin\Akreditasi@index');
// Route::get('admin/akreditasi/cari', 'App\Http\Controllers\Admin\Akreditasi@cari');
// Route::get('admin/akreditasi/status_akreditasi/{par1}', 'App\Http\Controllers\Admin\Akreditasi@status_akreditasi');
// Route::get('admin/akreditasi/kategori/{par1}', 'App\Http\Controllers\Admin\Akreditasi@kategori');
// Route::get('admin/akreditasi/detail/{par1}', 'App\Http\Controllers\Admin\Akreditasi@detail');
// Route::get('admin/akreditasi/tambah', 'App\Http\Controllers\Admin\Akreditasi@tambah');
// Route::get('admin/akreditasi/edit/{par1}', 'App\Http\Controllers\Admin\Akreditasi@edit');
// Route::get('admin/akreditasi/delete/{par1}', 'App\Http\Controllers\Admin\Akreditasi@delete');
// Route::post('admin/akreditasi/tambah_proses', 'App\Http\Controllers\Admin\Akreditasi@tambah_proses');
// Route::post('admin/akreditasi/edit_proses', 'App\Http\Controllers\Admin\Akreditasi@edit_proses');
// Route::post('admin/akreditasi/proses', 'App\Http\Controllers\Admin\Akreditasi@proses');
// download
Route::get('admin/project', 'App\Http\Controllers\Admin\Download@index');
Route::get('admin/project/cari', 'App\Http\Controllers\Admin\Download@cari');
Route::get('admin/project/status_project/{par1}', 'App\Http\Controllers\Admin\Download@status_download');
Route::get('admin/project/kategori/{par1}', 'App\Http\Controllers\Admin\Download@kategori');
Route::get('admin/project/tambah', 'App\Http\Controllers\Admin\Download@tambah');
Route::get('admin/project/edit/{par1}', 'App\Http\Controllers\Admin\Download@edit');
Route::get('admin/project/unduh/{par1}', 'App\Http\Controllers\Admin\Download@unduh');
Route::get('admin/project/delete/{par1}', 'App\Http\Controllers\Admin\Download@delete');
Route::post('admin/project/tambah_proses', 'App\Http\Controllers\Admin\Download@tambah_proses');
Route::post('admin/project/edit_proses', 'App\Http\Controllers\Admin\Download@edit_proses');
Route::post('admin/project/proses', 'App\Http\Controllers\Admin\Download@proses');
// kontak
Route::get('admin/kontak', 'App\Http\Controllers\Admin\Kontak@index');
Route::get('admin/kontak/cari', 'App\Http\Controllers\Admin\Kontak@cari');
Route::get('admin/kontak/status_kontak/{par1}', 'App\Http\Controllers\Admin\Kontak@status_kontak');
Route::get('admin/kontak/detail/{par1}', 'App\Http\Controllers\Admin\Kontak@detail');
Route::get('admin/kontak/delete/{par1}', 'App\Http\Controllers\Admin\Kontak@delete');
Route::post('admin/kontak/proses', 'App\Http\Controllers\Admin\Kontak@proses');
// home_content
Route::get('admin/home_content', 'App\Http\Controllers\Admin\HomeContentController@index');
Route::get('admin/home_content/tambah', 'App\Http\Controllers\Admin\HomeContentController@tambah');
Route::get('admin/home_content/edit/{par1}', 'App\Http\Controllers\Admin\HomeContentController@edit');
Route::get('admin/home_content/delete/{par1}', 'App\Http\Controllers\Admin\HomeContentController@delete');
Route::post('admin/home_content/tambah_proses', 'App\Http\Controllers\Admin\HomeContentController@tambah_proses');
Route::post('admin/home_content/edit_proses', 'App\Http\Controllers\Admin\HomeContentController@edit_proses');
// hero slider
Route::get('admin/hero-slider', 'App\Http\Controllers\Admin\HeroSliderController@index');
Route::get('admin/hero-slider/tambah', 'App\Http\Controllers\Admin\HeroSliderController@tambah');
Route::get('admin/hero-slider/edit/{par1}', 'App\Http\Controllers\Admin\HeroSliderController@edit');
Route::get('admin/hero-slider/delete/{par1}', 'App\Http\Controllers\Admin\HeroSliderController@delete');
Route::post('admin/hero-slider/tambah_proses', 'App\Http\Controllers\Admin\HeroSliderController@tambah_proses');
Route::post('admin/hero-slider/edit_proses', 'App\Http\Controllers\Admin\HeroSliderController@edit_proses');
// program masa depan
Route::get('admin/program-masa-depan', 'App\Http\Controllers\Admin\ProgramMasaDepanController@index');
Route::get('admin/program-masa-depan/tambah', 'App\Http\Controllers\Admin\ProgramMasaDepanController@tambah');
Route::get('admin/program-masa-depan/edit/{par1}', 'App\Http\Controllers\Admin\ProgramMasaDepanController@edit');
Route::get('admin/program-masa-depan/delete/{par1}', 'App\Http\Controllers\Admin\ProgramMasaDepanController@delete');
Route::post('admin/program-masa-depan/tambah_proses', 'App\Http\Controllers\Admin\ProgramMasaDepanController@tambah_proses');
Route::post('admin/program-masa-depan/edit_proses/{par1}', 'App\Http\Controllers\Admin\ProgramMasaDepanController@edit_proses');
// industri
Route::get('admin/industri', 'App\Http\Controllers\Admin\IndustriController@index');
Route::get('admin/industri/tambah', 'App\Http\Controllers\Admin\IndustriController@tambah');
Route::get('admin/industri/edit/{par1}', 'App\Http\Controllers\Admin\IndustriController@edit');
Route::get('admin/industri/delete/{par1}', 'App\Http\Controllers\Admin\IndustriController@delete');
Route::post('admin/industri/tambah_proses', 'App\Http\Controllers\Admin\IndustriController@tambah_proses');
Route::post('admin/industri/edit_proses/{par1}', 'App\Http\Controllers\Admin\IndustriController@edit_proses');
// kisah sukses
Route::get('admin/kisah-sukses', 'App\Http\Controllers\Admin\KisahSuksesController@index');
Route::get('admin/kisah-sukses/tambah', 'App\Http\Controllers\Admin\KisahSuksesController@tambah');
Route::get('admin/kisah-sukses/edit/{par1}', 'App\Http\Controllers\Admin\KisahSuksesController@edit');
Route::get('admin/kisah-sukses/delete/{par1}', 'App\Http\Controllers\Admin\KisahSuksesController@delete');
Route::post('admin/kisah-sukses/tambah_proses', 'App\Http\Controllers\Admin\KisahSuksesController@tambah_proses');
Route::post('admin/kisah-sukses/edit_proses/{par1}', 'App\Http\Controllers\Admin\KisahSuksesController@edit_proses');
// loker
Route::get('admin/loker', 'App\Http\Controllers\Admin\Loker@index');
Route::get('admin/loker/cari', 'App\Http\Controllers\Admin\Loker@cari');
Route::get('admin/loker/status_loker/{par1}', 'App\Http\Controllers\Admin\Loker@status_loker');
Route::get('admin/loker/tambah', 'App\Http\Controllers\Admin\Loker@tambah');
Route::get('admin/loker/edit/{par1}', 'App\Http\Controllers\Admin\Loker@edit');
Route::get('admin/loker/delete/{par1}', 'App\Http\Controllers\Admin\Loker@delete');
Route::post('admin/loker/tambah_proses', 'App\Http\Controllers\Admin\Loker@tambah_proses');
Route::post('admin/loker/edit_proses', 'App\Http\Controllers\Admin\Loker@edit_proses');
Route::post('admin/loker/proses', 'App\Http\Controllers\Admin\Loker@proses');
// pendaftaran loker
Route::get('admin/pendaftaran-loker', 'App\Http\Controllers\Admin\PendaftaranLoker@index');
Route::get('admin/pendaftaran-loker/cari', 'App\Http\Controllers\Admin\PendaftaranLoker@cari');
Route::get('admin/pendaftaran-loker/status_pendaftaran/{par1}', 'App\Http\Controllers\Admin\PendaftaranLoker@status_pendaftaran');
Route::get('admin/pendaftaran-loker/detail/{par1}', 'App\Http\Controllers\Admin\PendaftaranLoker@detail');
Route::get('admin/pendaftaran-loker/delete/{par1}', 'App\Http\Controllers\Admin\PendaftaranLoker@delete');
Route::post('admin/pendaftaran-loker/proses', 'App\Http\Controllers\Admin\PendaftaranLoker@proses');

/* END BACK END*/
