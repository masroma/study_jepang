-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jan 2026 pada 02.29
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jemari_edu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kategori_agenda` int(11) NOT NULL,
  `bahasa` enum('ID','EN') NOT NULL,
  `slug_agenda` varchar(255) NOT NULL,
  `judul_agenda` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `status_agenda` varchar(20) NOT NULL,
  `jenis_agenda` varchar(20) NOT NULL,
  `keywords` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT 0,
  `urutan` int(11) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `tempat` text DEFAULT NULL,
  `google_map` text DEFAULT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_publish` datetime NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `id_user`, `id_kategori_agenda`, `bahasa`, `slug_agenda`, `judul_agenda`, `isi`, `status_agenda`, `jenis_agenda`, `keywords`, `gambar`, `icon`, `hits`, `urutan`, `tanggal_mulai`, `tanggal_selesai`, `jam_mulai`, `jam_selesai`, `tempat`, `google_map`, `tanggal_post`, `tanggal_publish`, `tanggal`) VALUES
(1, 4, 6, 'ID', 'latihan-agenda', 'Latihan Agenda', '<p>Latihan</p>', 'Publish', 'Agenda', 'adad', NULL, 'daad', 0, NULL, '2020-09-12', '2020-09-12', '08:00:00', '17:00:00', 'AWS Indonesia', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7930.3386078467065!2d106.82893243028725!3d-6.372131203377098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed5d166b756d%3A0x41d8cdc14c819774!2sDepok%20Town%20Square!5e0!3m2!1sen!2sid!4v1579565022446!5m2!1sen!2sid\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', '2020-09-12 23:46:53', '2020-09-12 23:42:16', '2020-09-13 00:09:38'),
(2, 4, 6, 'ID', 'contoh-agenda', 'Contoh Agenda', '<p><strong>Deskripsi Kegiatan Studi Jepang</strong></p>\r\n\r\n<p>Kegiatan Studi Jepang merupakan program pembelajaran dan pengenalan budaya, sistem pendidikan, teknologi, serta tata kelola kehidupan masyarakat Jepang. Kegiatan ini bertujuan untuk memperluas wawasan peserta mengenai nilai-nilai kedisiplinan, etos kerja, inovasi teknologi, serta budaya kerja yang diterapkan di Jepang dan dapat menjadi referensi untuk pengembangan sumber daya manusia di Indonesia.</p>\r\n\r\n<p>Dalam pelaksanaannya, kegiatan Studi Jepang meliputi berbagai agenda seperti kunjungan ke institusi pendidikan, instansi pemerintahan, perusahaan, serta pusat kebudayaan Jepang. Peserta juga mengikuti sesi pemaparan materi, diskusi, dan observasi langsung terkait sistem manajemen, penggunaan teknologi, serta praktik terbaik (best practices) yang diterapkan di Jepang.</p>\r\n\r\n<p>Melalui kegiatan ini, peserta diharapkan mampu memahami perbedaan dan persamaan sistem sosial, budaya, dan kerja antara Jepang dan Indonesia, serta mengambil nilai-nilai positif yang dapat diadaptasi dan diimplementasikan dalam kehidupan akademik, profesional, maupun organisasi di tanah air.</p>', 'Publish', 'Event', 'Study Jepang', 'zaynah-1768382566.png', 'Layanan', 0, NULL, '2026-01-14', '2026-01-14', '08:00:00', '17:00:00', 'ACE BSD', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7930.3386078467065!2d106.82893243028725!3d-6.372131203377098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed5d166b756d%3A0x41d8cdc14c819774!2sDepok%20Town%20Square!5e0!3m2!1sen!2sid!4v1579565022446!5m2!1sen!2sid\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', '2026-01-14 09:22:50', '2026-01-14 09:20:54', '2026-01-14 09:22:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT 0,
  `bahasa` enum('ID','EN') NOT NULL,
  `updater` varchar(32) DEFAULT '-',
  `slug_berita` varchar(255) NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `status_berita` varchar(20) NOT NULL,
  `jenis_berita` varchar(20) DEFAULT 'Berita',
  `keywords` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_publish` datetime NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `id_user`, `id_kategori`, `bahasa`, `updater`, `slug_berita`, `judul_berita`, `isi`, `status_berita`, `jenis_berita`, `keywords`, `gambar`, `icon`, `hits`, `urutan`, `tanggal_mulai`, `tanggal_selesai`, `tanggal_post`, `tanggal_publish`, `tanggal`) VALUES
(28, 1, 0, 'ID', '-', 'pembukaan-kelas-baru-bahasa-jepang-2024', 'Pembukaan Kelas Baru Bahasa Jepang 2024', 'Pendaftaran kelas baru bahasa Jepang untuk tahun 2024 telah dibuka dengan kurikulum yang lebih baik dan metode pembelajaran yang interaktif. Kami menawarkan program dari N5 hingga N1 dengan pengajar native speaker.', 'Publish', 'Berita', 'bahasa jepang, kelas baru, program 2024, study abroad', 'berita-kelas-baru.jpg', NULL, NULL, 1, NULL, NULL, '2024-01-15 10:00:00', '0000-00-00 00:00:00', '2026-01-18 15:07:29'),
(29, 1, 0, 'ID', '-', 'kerjasama-dengan-10-perusahaan-jepang', 'Kerjasama dengan 10 Perusahaan Jepang', 'StudyAbroad menjalin kerjasama dengan 10 perusahaan besar di Jepang untuk program magang. Perusahaan tersebut berasal dari berbagai sektor seperti manufaktur, IT, dan hospitality.', 'Publish', 'Berita', 'kerjasama, perusahaan jepang, magang, TIT', 'berita-kerjasama.jpg', NULL, NULL, 2, NULL, NULL, '2024-01-10 10:00:00', '0000-00-00 00:00:00', '2026-01-18 15:07:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `download`
--

CREATE TABLE `download` (
  `id_download` int(11) NOT NULL,
  `id_kategori_download` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `bahasa` enum('ID','EN') NOT NULL,
  `judul_download` varchar(200) DEFAULT NULL,
  `jenis_download` varchar(20) NOT NULL,
  `isi` text DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `hits` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `download`
--

INSERT INTO `download` (`id_download`, `id_kategori_download`, `id_user`, `bahasa`, `judul_download`, `jenis_download`, `isi`, `file`, `website`, `hits`, `tanggal`) VALUES
(3, 1, 4, 'ID', 'The AWS Standard 2.0 Bahasa Indonesia', 'Download', '<p>Versi Bahasa Indonesia dari AWS Standar, Panduan dan Skoring Rubrik sudah tersedia online. <a href=\"https://a4ws.org/download-standard-2/\" style=\"color:#0563c1; text-decoration:underline\">Unduh</a> untuk Anda sekarang dan hubungi tim kami di Indonesia untuk mendukung Anda dalam perjalanan penatalayanan air.</p>', 'aws-standard-20-2019-bahasa-indonesia-1600653859.pdf', NULL, 22, '2020-09-21 02:06:43'),
(4, 1, 4, 'ID', 'The AWS Standard Guidance 2.0 Bahasa Indonesia', 'Download', '<p>The AWS Standard Guidance 2.0 Bahasa Indonesia</p>', 'aws-standard-20-guidance-final-january-2020-bahasa-indonesia-1600654043.pdf', NULL, 2, '2020-09-21 02:08:09'),
(5, 1, 4, 'ID', 'The AWS Standard Scoring 2.0 Bahasa Indonesia', 'Download', '<p>The AWS Standard Scoring 2.0 Bahasa Indonesia</p>', 'aws-standard-20-scoring-criteria-revised-june-1-2020-bahasa-indonesia-1600654078.pdf', NULL, 0, '2020-09-21 02:07:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `id_kategori_galeri` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `bahasa` enum('ID','EN') NOT NULL,
  `judul_galeri` varchar(200) DEFAULT NULL,
  `jenis_galeri` varchar(20) NOT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `popup_status` enum('Publish','Draft','','') NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `status_text` enum('Ya','Tidak','','') NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `id_kategori_galeri`, `id_user`, `bahasa`, `judul_galeri`, `jenis_galeri`, `isi`, `gambar`, `website`, `hits`, `popup_status`, `urutan`, `status_text`, `tanggal`) VALUES
(15, 4, 15, 'ID', 'Jemari Edu', 'Homepage', NULL, 'banner-3-1-1600727828-1741675500.png', 'https://blog.jemari-edu.web.id/info', 1, 'Publish', NULL, 'Ya', '2025-03-11 06:45:01'),
(17, 6, 4, 'ID', 'Kisah Sukses Berkarir dijepang', 'Galeri', 'isi', 'vpn-1768384319.PNG', 'http://ahmsourc.com', NULL, 'Publish', 1, 'Ya', '2026-01-14 09:52:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `heading`
--

CREATE TABLE `heading` (
  `id_heading` int(11) NOT NULL,
  `id_user` int(11) DEFAULT 0,
  `judul_heading` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `halaman` varchar(255) DEFAULT 'NULL',
  `tanggal` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `heading`
--

INSERT INTO `heading` (`id_heading`, `id_user`, `judul_heading`, `keterangan`, `gambar`, `halaman`, `tanggal`) VALUES
(1, 0, 'Berita dan Updates', '<p>Berita dan Updates</p>', 'heading-03-1600256326.jpg', 'Berita', '2020-09-16 11:38:46'),
(2, 0, 'AWS Indonesia', '<p>AWS Indonesia</p>', 'aws-indonesia-1600259780.jpg', 'AWS', '2020-09-16 12:36:20'),
(3, 0, 'Halaman Kontak', '<p>Halaman Kontak</p>', 'kontak-1600257025.jpg', 'Kontak', '2020-09-16 11:50:25'),
(4, 0, 'Board and Team', '<p>Board and Team</p>', 'board-and-team-300-1600260175.jpg', 'Team', '2020-09-16 12:42:55'),
(5, 0, 'Layanan', '<p>Penatalayanan air memungkinkan pengguna air bekerjasama untuk mengidentifikasi dan mencapai tujuan bersama untuk pengelolaan air yang berkelanjutan dan keamanan air bersama. Penatalayanan air yang baik didefinisikan sebagai penggunaan air yang adil secara sosial dan budaya, berkelanjutan secara lingkungan dan menguntungkan secara ekonomi, dicapai melalui proses inklusif pemangku kepentingan yang mencakup tindakan berbasis wilayah operasional dan daerah tangkapan air (DAS).</p>\r\n<p>AWS Indonesia meripakan promosi dan penerapan penatalayanan air yang baik dan standar penatalayanan air internasional (<a href=\"https://a4ws.org/the-aws-standard-2-0/\">AWS Standard</a>) di Indonesia sebagai mitra negara <a href=\"https://waterstewardship.org.au/\">Alliance for Water Stewardship Asia-Pacific</a> dan <a href=\"https://a4ws.org/about/\">Alliance for Water Stewardship SCIO</a>.</p>\r\n<p>Apakah Anda tertarik untuk mempelajari lebih lanjut mengenai penatalayanan air dan aktivitas kami di Indonesia? Apakah Anda Manajer Sustainability atau Engineer Air yang ingin menerapkan penatalayanan air di wilayah operasional Anda? Hubungi kami dan mari kita mulai penatalayanan air bersama-sama.</p>', 'layanan-1600315713.jpg', 'Layanan', '2020-09-17 04:08:33'),
(6, 0, 'Dokumen', '<p>Dokumen</p>', 'dokumen-1600317093.jpg', 'Dokumen', '2020-09-17 04:31:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `industri`
--

CREATE TABLE `industri` (
  `id_industri` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `status` enum('Publish','Draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `industri`
--

INSERT INTO `industri` (`id_industri`, `nama`, `sub_nama`, `gambar`, `deskripsi`, `urutan`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Manufacturing', 'Automotive & Electronics', 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60', 'Perusahaan manufaktur otomotif dan elektronik ternama di Jepang seperti Toyota, Honda, Sony', 1, 'Publish', NULL, NULL),
(3, 'Hospitality', 'Hotel & Tourism', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=60', 'Hotel, restoran, dan layanan pariwisata di kota-kota besar Jepang', 2, 'Publish', NULL, NULL),
(4, 'IT & Technology', 'Software & Startup', 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=500&q=60', 'Perusahaan teknologi dan startup di Tokyo dan kota teknologi lainnya', 3, 'Publish', NULL, NULL),
(5, 'Healthcare', 'Medical Services', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=500&q=60', 'Rumah sakit dan fasilitas kesehatan dengan standar Jepang', 4, 'Publish', NULL, NULL),
(6, 'Agriculture', 'Modern Farming', 'https://images.unsplash.com/photo-1592982879839-15db0a407bfe?auto=format&fit=crop&w=500&q=60', 'Pertanian modern dan perkebunan dengan teknologi Jepang', 5, 'Publish', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `bahasa` enum('ID','EN') NOT NULL,
  `slug_kategori` varchar(255) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `id_user`, `bahasa`, `slug_kategori`, `nama_kategori`, `urutan`, `hits`, `tanggal`) VALUES
(6, 4, 'ID', 'berita', 'Berita', 3, 0, '2020-09-12 21:36:42'),
(8, 4, 'ID', 'updates', 'Updates', 2, NULL, '2020-09-12 21:36:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_agenda`
--

CREATE TABLE `kategori_agenda` (
  `id_kategori_agenda` int(11) NOT NULL,
  `bahasa` enum('ID','EN') NOT NULL,
  `slug_kategori_agenda` varchar(255) NOT NULL,
  `nama_kategori_agenda` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_agenda`
--

INSERT INTO `kategori_agenda` (`id_kategori_agenda`, `bahasa`, `slug_kategori_agenda`, `nama_kategori_agenda`, `keterangan`, `urutan`) VALUES
(4, 'ID', 'kegiatan-eksternal', 'Kegiatan Eksternal', NULL, 2),
(6, 'ID', 'kegiatan-internal', 'Kegiatan Internal', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_download`
--

CREATE TABLE `kategori_download` (
  `id_kategori_download` int(11) NOT NULL,
  `bahasa` enum('ID','EN') NOT NULL,
  `slug_kategori_download` varchar(255) NOT NULL,
  `nama_kategori_download` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_download`
--

INSERT INTO `kategori_download` (`id_kategori_download`, `bahasa`, `slug_kategori_download`, `nama_kategori_download`, `keterangan`, `urutan`) VALUES
(1, 'ID', 'dokumen', 'Dokumen', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1),
(4, 'ID', 'download-pricelist', 'Download Pricelist', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 0),
(5, 'ID', 'studi-kasus', 'Studi Kasus', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 2),
(6, 'ID', 'webinar', 'Webinar', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_galeri`
--

CREATE TABLE `kategori_galeri` (
  `id_kategori_galeri` int(11) NOT NULL,
  `bahasa` enum('ID','EN') NOT NULL,
  `slug_kategori_galeri` varchar(255) NOT NULL,
  `nama_kategori_galeri` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_galeri`
--

INSERT INTO `kategori_galeri` (`id_kategori_galeri`, `bahasa`, `slug_kategori_galeri`, `nama_kategori_galeri`, `urutan`) VALUES
(4, 'ID', 'kegiatan', 'Kegiatan', 2),
(6, 'ID', 'kegiatan-kampus', 'Kegiatan Kampus', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_staff`
--

CREATE TABLE `kategori_staff` (
  `id_kategori_staff` int(11) NOT NULL,
  `bahasa` enum('ID','EN') NOT NULL,
  `slug_kategori_staff` varchar(255) NOT NULL,
  `nama_kategori_staff` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_staff`
--

INSERT INTO `kategori_staff` (`id_kategori_staff`, `bahasa`, `slug_kategori_staff`, `nama_kategori_staff`, `keterangan`, `urutan`) VALUES
(4, 'ID', 'senyum-programmer', 'Senyum Programmer', 'Yeay...selain tim tutor kita juga ada tim programmer yang bekerja full time maupun part time', 2),
(6, 'ID', 'happy-tutor', 'Happy Tutor', 'Jemari Edu didampingi oleh tutor-tutor dan instruktur yang berpengalaman di bidangnya.', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kisah_sukses`
--

CREATE TABLE `kisah_sukses` (
  `id_kisah` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimoni` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `video_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `status` enum('Publish','Draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kisah_sukses`
--

INSERT INTO `kisah_sukses` (`id_kisah`, `nama`, `pekerjaan`, `lokasi`, `testimoni`, `foto`, `program`, `tahun`, `rating`, `video_url`, `video_file`, `urutan`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Anisa Rahmawati', 'Engineering Staff', 'Nagoya', 'Saya sangat terbantu dengan program ini. Mentornya sabar membimbing dari nol sampai saya bisa N3 dalam 6 bulan. Sekarang saya bekerja di perusahaan otomotif besar di Nagoya dengan gaji yang sangat baik.', NULL, 'Bahasa Jepang N5-N1', 2023, 5, 'https://www.youtube.com/watch?v=L_Guz73e6fw', NULL, 1, 'Publish', NULL, NULL),
(5, 'Budi Santoso', 'IT Developer', 'Tokyo', 'Program TIT memberikan pengalaman kerja nyata di Jepang. Saya sekarang bekerja di perusahaan teknologi besar di Tokyo dengan gaji yang sangat baik dan jenjang karir yang jelas.', NULL, 'Technical Intern Training', 2023, 5, 'https://www.youtube.com/watch?v=Kd7j0fLkOXE', NULL, 2, 'Publish', NULL, NULL),
(6, 'Siti Nurhaliza', 'Hospitality Staff', 'Osaka', 'Dari tidak bisa bahasa Jepang sama sekali, sekarang saya bisa melayani tamu hotel dengan percaya diri. Program ini benar-benar mengubah hidup saya.', NULL, 'Bahasa Jepang N5-N1', 2022, 4, 'https://www.youtube.com/watch?v=example3', NULL, 3, 'Publish', NULL, NULL),
(7, 'Ahmad Fauzi', 'Agriculture Specialist', 'Hokkaido', 'Saya belajar pertanian modern dengan teknologi Jepang. Sekarang saya mengelola greenhouse di Hokkaido dengan metode terbaru dan hasil panen yang luar biasa.', NULL, 'Technical Intern Training', 2023, 5, 'https://www.youtube.com/watch?v=example4', NULL, 4, 'Publish', NULL, NULL),
(8, 'Maya Putri', 'University Student', 'Kyoto', 'Program persiapan universitas sangat membantu saya. Sekarang saya kuliah di Kyoto University dengan beasiswa dan prestasi yang membanggakan.', NULL, 'University Preparation', 2023, 5, 'https://www.youtube.com/watch?v=example5', NULL, 5, 'Publish', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `bahasa` enum('ID','EN') NOT NULL,
  `namaweb` varchar(200) NOT NULL,
  `nama_singkat` varchar(200) DEFAULT NULL,
  `tagline` varchar(200) DEFAULT NULL,
  `tagline2` varchar(255) DEFAULT NULL,
  `tentang` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_cadangan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `keywords` varchar(400) DEFAULT NULL,
  `metatext` text DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `google_plus` varchar(255) DEFAULT NULL,
  `nama_facebook` varchar(255) NOT NULL,
  `nama_twitter` varchar(255) NOT NULL,
  `nama_instagram` varchar(255) NOT NULL,
  `nama_google_plus` varchar(255) NOT NULL,
  `singkatan` varchar(255) NOT NULL,
  `google_map` text DEFAULT NULL,
  `judul_1` varchar(200) DEFAULT NULL,
  `pesan_1` varchar(200) DEFAULT NULL,
  `judul_2` varchar(200) DEFAULT NULL,
  `pesan_2` varchar(200) DEFAULT NULL,
  `judul_3` varchar(200) DEFAULT NULL,
  `pesan_3` varchar(200) DEFAULT NULL,
  `judul_4` varchar(200) DEFAULT NULL,
  `pesan_4` varchar(200) DEFAULT NULL,
  `judul_5` varchar(200) DEFAULT NULL,
  `pesan_5` varchar(200) NOT NULL,
  `judul_6` varchar(200) DEFAULT NULL,
  `pesan_6` varchar(200) NOT NULL,
  `isi_1` varchar(500) DEFAULT NULL,
  `isi_2` varchar(500) DEFAULT NULL,
  `isi_3` varchar(500) DEFAULT NULL,
  `isi_4` varchar(500) DEFAULT NULL,
  `isi_5` varchar(500) DEFAULT NULL,
  `isi_6` varchar(500) DEFAULT NULL,
  `link_1` varchar(255) DEFAULT NULL,
  `link_2` varchar(255) DEFAULT NULL,
  `link_3` varchar(255) DEFAULT NULL,
  `link_4` varchar(255) DEFAULT NULL,
  `link_5` varchar(255) DEFAULT NULL,
  `link_6` varchar(255) DEFAULT NULL,
  `javawebmedia` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `rekening` text DEFAULT NULL,
  `prolog_topik` text DEFAULT NULL,
  `prolog_program` text DEFAULT NULL,
  `prolog_sekretariat` text DEFAULT NULL,
  `prolog_aksi` text DEFAULT NULL,
  `prolog_kolaborasi` text DEFAULT NULL,
  `prolog_sebaran` text DEFAULT NULL,
  `gambar_berita` varchar(255) DEFAULT NULL,
  `prolog_agenda` text DEFAULT NULL,
  `prolog_wawasan` text DEFAULT NULL,
  `protocol` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_timeout` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `judul_pembayaran` varchar(255) DEFAULT NULL,
  `isi_pembayaran` text DEFAULT NULL,
  `gambar_pembayaran` varchar(255) DEFAULT NULL,
  `link_bawah_peta` varchar(255) DEFAULT NULL,
  `text_bawah_peta` varchar(255) DEFAULT NULL,
  `cara_pesan` enum('Keranjang Belanja','Formulir Pemesanan') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `bahasa`, `namaweb`, `nama_singkat`, `tagline`, `tagline2`, `tentang`, `deskripsi`, `website`, `email`, `email_cadangan`, `alamat`, `telepon`, `hp`, `fax`, `logo`, `icon`, `keywords`, `metatext`, `facebook`, `twitter`, `instagram`, `google_plus`, `nama_facebook`, `nama_twitter`, `nama_instagram`, `nama_google_plus`, `singkatan`, `google_map`, `judul_1`, `pesan_1`, `judul_2`, `pesan_2`, `judul_3`, `pesan_3`, `judul_4`, `pesan_4`, `judul_5`, `pesan_5`, `judul_6`, `pesan_6`, `isi_1`, `isi_2`, `isi_3`, `isi_4`, `isi_5`, `isi_6`, `link_1`, `link_2`, `link_3`, `link_4`, `link_5`, `link_6`, `javawebmedia`, `gambar`, `video`, `rekening`, `prolog_topik`, `prolog_program`, `prolog_sekretariat`, `prolog_aksi`, `prolog_kolaborasi`, `prolog_sebaran`, `gambar_berita`, `prolog_agenda`, `prolog_wawasan`, `protocol`, `smtp_host`, `smtp_port`, `smtp_timeout`, `smtp_user`, `smtp_pass`, `judul_pembayaran`, `isi_pembayaran`, `gambar_pembayaran`, `link_bawah_peta`, `text_bawah_peta`, `cara_pesan`, `id_user`, `tanggal`) VALUES
(1, 'ID', 'Study Jepang', 'Study Jepang', 'Pusat Kursus & Privat Bahasa Jepang', 'Pusat Kursus Private', '<p><strong>Kata Sambutan Direktur [Nama Kursus]</strong></p>\r\n\r\n<p>&quot;Kon&#39;nichiwa, Selamat Datang di [Nama Kursus].</p>\r\n\r\n<p>Jepang bukan sekadar destinasi impian, melainkan pintu gerbang menuju peluang karier dan pendidikan global yang tak terbatas. Di [Nama Kursus], kami percaya bahwa penguasaan bahasa adalah kunci utama untuk membuka pintu tersebut. Kami hadir bukan hanya untuk mengajarkan tata bahasa dan kanji, tetapi untuk menjadi jembatan yang menghubungkan semangat Anda dengan masa depan yang gemilang di Negeri Sakura.</p>\r\n\r\n<p>Dengan metode pembelajaran yang adaptif terhadap perkembangan teknologi tahun 2026 dan pengajar yang berpengalaman, kami berkomitmen menemani perjalanan Anda hingga mencapai impian. Mari melangkah bersama kami menuju kesuksesan.</p>\r\n\r\n<p><em>Ganbarimashou!</em>&quot;</p>\r\n\r\n<p>&nbsp;</p>', 'Grow And Strengthen Leadership On Good IT Team Performance for Now And The Feature.', 'https://.com', 'contact@jemari-edu.web.id', 'masroma75@gmail.com', 'Mall Depok Town Square\r\nLt 2 Blok SS1 No. 5-7\r\nJl. Margonda Raya Kota Depok', '081260191282', '+62812 6019 1282', '081260191282', 'chatgpt-image-18-jan-2026-070236.png', 'chatgpt-image-18-jan-2026-070236.png', 'study jepang, bahas jepang, laravel, online course, kursus online', NULL, 'https://www.facebook.com/', 'http://twitter.com/', 'https://instagram.com/', 'https://www.youtube.com/channel/UCmm6mFZXYQ3ZylUMa0Tmc2Q', 'Study Jepang', 'Study Jepang', 'Study Jepang', '', 'JWM', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7930.3386078467065!2d106.82893243028725!3d-6.372131203377098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed5d166b756d%3A0x41d8cdc14c819774!2sDepok%20Town%20Square!5e0!3m2!1sen!2sid!4v1579565022446!5m2!1sen!2sid\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', 'Tempat belajar nyaman', 'fa fa-home', 'Materi Kursus Selalu Update', 'fa fa-laptop', 'Jadwal Flexibel', 'fa fa-thumbs-up', 'Menjaga Amanah', 'fa-check-square-o', 'Tempat belajar nyaman', 'fa-home', 'Online service', 'fa-laptop', 'Kami menyediakan tempat belajar yang nyaman dan menyenangkan serasa di rumah sendiri', 'Materi kursus kamu selalu uptodate, Anda bisa mengunduh apa yang dipelajari', 'Bagi Anda siswa yang ingin belajar, kami menerapkan jadwal flexibel', 'Kami senantiasa menjaga amanah yang diberikan kepada donatur agar sampai di tangan yang berhak.', 'Kami menyediakan tempat belajar yang nyaman dan menyenangkan', 'Website kamu selalu uptodate, Anda bisa mengunduh apa yang dipelajari', '', '', '', '', '', '', '<p>Berawal dari keinginan ibunda Hj.Masah Muhari diakhir hidupnya untuk mewakaan sebagian hartanya dijalan Allah, gayungpun bersambut pada bulan Mei 2011 saat kami akan melaksanakan ibadah umrah, Seorang rekan kami sesama Jamaah bernama ustadzah Hj. Zainur Fahmid memberikan informasi Tentang Anggota yang hendak mewakaan sebidang tanahnya di wilayah Beji Timur. Kami pun memanjatkan doa di kota suci dengan penuh rasa harap pertolongan Allah untuk menunjukan jalan terbaik-Nya, maka sepulang umroh kami mengadakan pertemuan di kediaman Ibu Dra Hj Ratna Mardjanah untuk membicarakan visi misi kami dalam wakaf tersebut dan sepakat untuk mendirikan Istana Yatim Riyadhul Jannah ini.</p>\r\n<p>Nama Riyadhul Jannah Sendiri diambil dari nama pengelola wakaf (H. Ahmad Riyadh Muchtar, Lc) dan pemberi wakaf (Dra Hj Ratna Mardjanah). Istana Yatim Riyadhul Jannah hadir untuk melayani dan memfasilitasi segala kebutuhan anak yatim, terutama pendidikan agama, akhlak dan kehidupan yang layak untuk bekal masa depan mereka yang cerah agar bisa memberi manfaat bagi umat. Harapan kami semoga dengan membangunkan istana untuk anak yatim, maka Allah akan berikan istana-Nya di surga kelak dan kita termasuk manusia yang bisa memberika manfaat bagi sesama sebagaimana sabda Rasulullah SAW yang artinya:&nbsp;</p>\r\n<p>&ldquo;Sebaik-baik manusia adalah yang paling bermanfaat bagi manusia lainnya&rdquo;&nbsp;</p>\r\n<p>erimakasih atas segala bentuk bantuan yang dipercayakan kepada kami baik secara materi, tenaga dan kiran serta doa para muhsinin dan muhsinat Istana Yatim Riyadhul Jannah selama ini, mulai dari rencana pendirian hingga berkembang seperti saat ini. Semoga segala amal menjadi shadaqah jariyah disisi-Nya.&nbsp;</p>\r\n<p>&nbsp;</p>', '7.png', 'fsH_KhUWfho', '<table id=\"dataTables-example\" class=\"table table-bordered\" width=\"100%\">\r\n<thead>\r\n<tr>\r\n<th tabindex=\"0\" colspan=\"1\" rowspan=\"1\" width=\"19%\">Nama Bank</th>\r\n<th tabindex=\"0\" colspan=\"1\" rowspan=\"1\" width=\"21%\">Nomor Rekening</th>\r\n<th tabindex=\"0\" colspan=\"1\" rowspan=\"1\" width=\"7%\">Atas nama</th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>BCA KCP Margo City</td>\r\n<td>4212548204</td>\r\n<td>Andoyo</td>\r\n</tr>\r\n<tr>\r\n<td>Bank Mandiri KCP Universitas Indonesia</td>\r\n<td>1570001807768</td>\r\n<td>Eflita Meiyetriani</td>\r\n</tr>\r\n<tr>\r\n<td>Bank BNI Syariah Kantor Cabang Jakarta Selatan</td>\r\n<td>0105301001</td>\r\n<td>Eflita Meiyetriani</td>\r\n</tr>\r\n</tbody>\r\n</table>', '<p>Dalam mewujudkan pembangunan berkelanjutan, pemerintah kabupaten anggota LTKL telah mengidentifikasi dan memilih topik yang sesuai dengan kondisi di daerahnya. Ada 5 topik prioritas yang dipilih dengan penerapan yang disesuaikan kembali di masing-masing kabupaten.</p>', NULL, '<p>Setelah Lingkar Temu Kabupaten Lestari (LTKL) diinisiasi, kesekretariatan dibentuk untuk membantu para pemerintah kabupaten anggota bekerja dan berkolaborasi. Walaupun tidak memiliki mandat implementasi, Sekretariat LTKL menjadi vital dalam melancarkan koordinasi, pengumpulan basis data, hingga pelaporan perkembangan. Sekretariat LTKL juga diperkuat dengan kehadiran personil yang telah berpengalaman di bidang management pengetahuan, program pembangunan berkelanjutan hingga kebijakan.</p>', '', '<p>Lingkar Temu Kabupaten Lestari (LTKL) mengedepankan kolaborasi dalam mewududkan pembangunan berkelanjutan. Ada 10 kabupaten yang tersebar di 6 provinsi di Indonesia telah menjadi anggota LTKL.</p>\r\n<p>Hingga kini, berbagai pihak telah ikut berkolaborasi, mulai dari pemerintah kabupaten, sekeretariat LTKL, mitra pembangunan hingga pihak swasta.</p>', '', 'balairung-budiutomo-01.jpg', '<p>Acara yang ditampilkan merupakan kumpulan acara LTKL, mitra, maupun pemerintah kabupaten anggota LTKL, mulai dari acara seminar hingga festival.</p>', '<p>LTKL bukan satu-satunya yang bergerak dalam mewujudkan pembangunan berkelanjutan, serta upaya penanggulangan perubahan iklim. Ikuti terus perkembangan usaha LTKL serta rekan-rekan lain menuju bumi dan Indonesia yang lestari.</p>', 'smtp', 'ssl://mail.jemari-edu.web.id', '465', '12', 'info@jemari-edu.web.id', 'jemariedu', 'Metode Pembayaran Produk', '<p>Anda dapat melakukan pembayaran dengan beberapa cara, yaitu:</p>\r\n<ol>\r\n<li><strong>Pembayaran Tunai</strong>, dapat Anda serahkan secara langsung ke salah satu staff Jemari Edu</li>\r\n<li><strong>Pembayar Via Transfer Rekening</strong></li>\r\n</ol>\r\n<p>Lakukan transfer biaya atas layanan dan produk&nbsp;<strong>Jemari Edu</strong>&nbsp;ke salah satu rekening di bawah ini.</p>\r\n<h3>Konfirmasi Pembayaran</h3>\r\n<p>Anda dapat melakukan konfirmasi pembayaran melalui:</p>\r\n<ul>\r\n<li><strong>Melalui Email</strong>, silakan kirim bukti pembayaran ke:&nbsp;<strong><a href=\"mailto:contact@jemari-edu.web.id?subject=Konfirmasi%20Pembayaran\">contact@jemari-edu.web.id</a></strong></li>\r\n<li><strong>Melalui Whatsapp</strong>, kirimkan bukti pembayaran Anda ke&nbsp;<strong>+6281210697841</strong></li>\r\n<li><strong>Melalui Formulir Konfirmasi Pembayaran</strong>, Anda dapat mengunggah bukti pembayaran Anda melalui form&nbsp;<strong><a title=\"Konfirmasi Pembayaran\" href=\"https://javawebmedia.com/konfirmasi\">&nbsp;Konfirmasi Pembayaran</a></strong></li>\r\n</ul>', 'payment.jpg', NULL, NULL, 'Formulir Pemesanan', 4, '2026-01-18 00:25:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2026_01_14_130000_create_kisah_sukses_table', 1),
(5, '2026_01_14_120000_create_program_masa_depan_table', 2),
(6, '2026_01_14_120001_create_industri_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_masa_depan`
--

CREATE TABLE `program_masa_depan` (
  `id_program` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gaji` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `status` enum('Publish','Draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program_masa_depan`
--

INSERT INTO `program_masa_depan` (`id_program`, `judul`, `gambar`, `deskripsi`, `lokasi`, `durasi`, `visa`, `gaji`, `sertifikat`, `urutan`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Bahasa Jepang N5-N1', 'https://images.unsplash.com/photo-1576091160550-217358c7db81?auto=format&fit=crop&w=500&q=60', 'Program intensif belajar bahasa Jepang dari dasar hingga mahir dengan kurikulum resmi JLPT', 'Tokyo, Osaka, Nagoya', '6-24 bulan', 'Student Visa', '-', 'JLPT N5-N1', 1, 'Publish', NULL, NULL),
(6, 'Technical Intern Training', 'https://images.unsplash.com/photo-1551434678110-93598bea8edb?auto=format&fit=crop&w=500&q=60', 'Program magang teknis di perusahaan Jepang dengan visa dan sertifikat resmi', 'Aichi, Shizuoka', '3 tahun', 'Technical Intern Visa', '¥150,000-200,000/bulan', 'TIT Certificate', 2, 'Publish', NULL, NULL),
(7, 'University Preparation', 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=500&q=60', 'Persiapan masuk universitas di Jepang dengan bimbingan lengkap', 'Tokyo, Kyoto', '12 bulan', 'Student Visa', '-', 'University Prep Certificate', 3, 'Publish', NULL, NULL),
(8, 'Job Placement', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=500&q=60', 'Penempatan kerja langsung di perusahaan Jepang yang terpercaya', 'Seluruh Jepang', '2-3 tahun', 'Working Visa', '¥200,000-300,000/bulan', 'Job Placement Certificate', 4, 'Publish', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `nama_bank`, `nomor_rekening`, `atas_nama`, `gambar`, `urutan`, `tanggal`) VALUES
(1, 'BCA KCP DEPOK', '4212-5482-04', 'ANDOYO', 'bca.jpg', 1, '2020-06-11 21:36:46'),
(2, 'BNI SYARIAH DEPOK', '0611-9927-06', 'CV Jemari Edu', 'Logo_BNI_Syariah.png', 2, '2019-11-12 23:54:18'),
(4, 'BANK MANDIRI KCU DEPOK', '157-00-0180776-8', 'EFLITA MEIYETRIANI', 'mandiri.png', 4, '2019-11-12 23:58:42'),
(5, 'BANK BNI KCU DEPOK', '0105-3010-01', 'EFLITA MEIYETRIANI', 'bni.png', 5, '2019-11-13 00:00:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kategori_staff` int(11) NOT NULL,
  `slug_staff` varchar(255) NOT NULL,
  `nama_staff` varchar(255) NOT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `status_staff` varchar(20) NOT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `staff`
--

INSERT INTO `staff` (`id_staff`, `id_user`, `id_kategori_staff`, `slug_staff`, `nama_staff`, `jabatan`, `pendidikan`, `expertise`, `email`, `telepon`, `isi`, `gambar`, `status_staff`, `keywords`, `urutan`, `tanggal`) VALUES
(1, 15, 4, 'bina-rika-program-director', 'Bina Rika', 'Program Director', NULL, NULL, NULL, NULL, NULL, 'board-and-team-01-1599999423a.png', 'Tidak', NULL, 1, '2025-03-11 07:25:51'),
(2, 15, 4, 'karyani-knowledge-and-learning-officer', 'Karyani', 'Knowledge and Learning Officer', NULL, NULL, NULL, NULL, NULL, 'board-and-team-05-15a99999506.png', 'Tidak', NULL, 2, '2025-03-11 07:25:29'),
(3, 15, 4, 'programmer-communication-and-project-officer', 'Programmer', 'Communication and Project Officer', NULL, NULL, NULL, NULL, NULL, 'manajemen-1741677911.png', 'Ya', NULL, 3, '2025-03-11 07:25:11'),
(4, 15, 6, 'nofal-anam-ketua-dewan-pembina', 'Nofal Anam', 'Ketua Dewan Pembina', 'S1', NULL, NULL, NULL, NULL, 'nofal-anam-1741668647.jpg', 'Ya', NULL, 0, '2025-03-11 04:50:47'),
(5, 15, 6, 'firyanul-rizky-ketua-dewan-pengawas', 'Firyanul Rizky', 'Ketua Dewan Pengawas', 'S1', NULL, NULL, '0895606181117', NULL, 'firyanul-rizky-1741668812.jpg', 'Ya', NULL, 2, '2025-03-11 04:53:32'),
(6, 15, 6, 'audini-nifira-ketua-dewan-pengurus', 'Audini Nifira', 'Ketua Dewan Pengurus', 'S1', NULL, NULL, NULL, NULL, 'audini-nifira-1741668961.jpg', 'Ya', NULL, 3, '2025-03-11 04:56:01'),
(7, 15, 6, 'gungwik-dewi-lestari-sekretaris-dewan-pengurus', 'Gungwik Dewi Lestari', 'Sekretaris Dewan Pengurus', 'S1', NULL, NULL, NULL, NULL, 'gungwik-1741669362.jpg', 'Ya', NULL, 4, '2025-03-11 05:03:00'),
(8, 15, 6, 'dani-widya-bendahara-dewan-pengurus', 'Dani Widya', 'Bendahara Dewan Pengurus', NULL, NULL, NULL, NULL, NULL, 'board-and-team-02-160000a0191.png', 'Tidak', NULL, 5, '2025-03-11 04:58:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `akses_level` varchar(20) NOT NULL,
  `kode_rahasia` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `akses_level`, `kode_rahasia`, `gambar`, `tanggal`) VALUES
(4, 'Admin S.J', 'javawebmedia@gmail.com', 'javawebmedia', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', NULL, 'chatgpt-image-18-jan-2026-070236-1768694635.png', '2026-01-18 00:04:52'),
(14, 'Eflita Meiyetriani', 'eflita@gmail.com', 'eflita', '4228f9df60d56e866971c15271382b9f10251ce0', 'Admin', NULL, 'course-8-1599013102.jpg', '2020-09-02 02:18:22'),
(15, 'Rizky User', 'rizki@tcontinent.com', 'rizky', '829b36babd21be519fa5f9353daf5dbdb796993e', 'User', NULL, 'robusta-1741667887.png', '2025-03-11 04:38:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `video` text NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `bahasa` varchar(20) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `video`
--

INSERT INTO `video` (`id_video`, `judul`, `posisi`, `keterangan`, `video`, `urutan`, `bahasa`, `gambar`, `id_user`, `tanggal`) VALUES
(72, 'StudyAbroad - Program Belajar & Kerja di Jepang', 'Homepage', 'Program resmi untuk belajar bahasa Jepang dan bekerja di Jepang dengan visa yang terjamin', 'https://www.youtube.com/watch?v=L_Guz73e6fw', 1, 'Indonesia', 'study-abroad-japan.jpg', 1, '2026-01-18 14:23:15'),
(73, 'Tips Sukses Bekerja di Jepang untuk Pemula', 'Homepage', 'Panduan lengkap untuk sukses bekerja di Jepang bagi pemula', 'https://www.youtube.com/watch?v=Kd7j0fLkOXE', 2, 'Indonesia', 'kerja-jepang-tips.jpg', 1, '2026-01-18 14:23:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id_download`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `heading`
--
ALTER TABLE `heading`
  ADD PRIMARY KEY (`id_heading`);

--
-- Indeks untuk tabel `industri`
--
ALTER TABLE `industri`
  ADD PRIMARY KEY (`id_industri`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indeks untuk tabel `kategori_agenda`
--
ALTER TABLE `kategori_agenda`
  ADD PRIMARY KEY (`id_kategori_agenda`);

--
-- Indeks untuk tabel `kategori_download`
--
ALTER TABLE `kategori_download`
  ADD PRIMARY KEY (`id_kategori_download`);

--
-- Indeks untuk tabel `kategori_galeri`
--
ALTER TABLE `kategori_galeri`
  ADD PRIMARY KEY (`id_kategori_galeri`);

--
-- Indeks untuk tabel `kategori_staff`
--
ALTER TABLE `kategori_staff`
  ADD PRIMARY KEY (`id_kategori_staff`);

--
-- Indeks untuk tabel `kisah_sukses`
--
ALTER TABLE `kisah_sukses`
  ADD PRIMARY KEY (`id_kisah`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `program_masa_depan`
--
ALTER TABLE `program_masa_depan`
  ADD PRIMARY KEY (`id_program`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `download`
--
ALTER TABLE `download`
  MODIFY `id_download` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `heading`
--
ALTER TABLE `heading`
  MODIFY `id_heading` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `industri`
--
ALTER TABLE `industri`
  MODIFY `id_industri` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kategori_agenda`
--
ALTER TABLE `kategori_agenda`
  MODIFY `id_kategori_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori_download`
--
ALTER TABLE `kategori_download`
  MODIFY `id_kategori_download` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori_galeri`
--
ALTER TABLE `kategori_galeri`
  MODIFY `id_kategori_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori_staff`
--
ALTER TABLE `kategori_staff`
  MODIFY `id_kategori_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kisah_sukses`
--
ALTER TABLE `kisah_sukses`
  MODIFY `id_kisah` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `program_masa_depan`
--
ALTER TABLE `program_masa_depan`
  MODIFY `id_program` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
