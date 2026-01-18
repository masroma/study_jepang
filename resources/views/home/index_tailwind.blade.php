@php
    // Normalisasi nomor WhatsApp dari konfigurasi (hanya digit)
    $waNumber = isset($site_config->telepon) ? preg_replace('/\D+/', '', $site_config->telepon) : '';
@endphp
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'StudyAbroad - Belajar & Kerja di Jepang' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ["Poppins", "sans-serif"],
            },
            colors: {
              "brand-pink": "#FF2E93",
              "brand-yellow": "#FFDE00",
              "brand-blue": "#E0F2FE",
            },
            boxShadow: {
              soft: "0 10px 40px -10px rgba(0,0,0,0.08)",
            },
          },
        },
      };
    </script>
    <style>
      .hero-bg {
        background: linear-gradient(100deg, #eff6ff 0%, #dbeafe 50%, #bfdbfe 100%);
      }
      .no-scrollbar::-webkit-scrollbar {
        display: none;
      }
      .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
    </style>
  </head>
  <body class="font-sans text-gray-700 overflow-x-hidden">
    {{-- NAVBAR --}}
    <nav class="absolute top-0 left-0 w-full z-50 pt-4 px-4 md:pt-6 md:px-12">
      <div class="flex justify-between items-center max-w-7xl mx-auto">
        <div class="text-xl md:text-2xl font-extrabold text-brand-pink tracking-tight">
          <a href="{{ url('/') }}">{{ $site_config->nama_singkat ?? 'StudyAbroad' }}</a>
        </div>

        <div class="hidden md:flex items-center space-x-6 text-sm font-medium text-gray-600 bg-white/60 backdrop-blur-sm px-6 py-2 rounded-full shadow-sm">
          <a href="{{ url('/') }}" class="text-brand-pink font-semibold">Home</a>
          <a href="{{ url('info') }}" class="hover:text-brand-pink transition">Tentang Kami</a>
          <a href="{{ url('proyek') }}" class="hover:text-brand-pink transition">Projects</a>
          <a href="{{ url('berita') }}" class="hover:text-brand-pink transition">Blog</a>
          <a href="{{ url('kontak') }}" class="hover:text-brand-pink transition">Kontak Kami</a>
        </div>

        <div class="flex items-center space-x-2 md:space-x-3">
          <div class="hidden sm:flex items-center space-x-1 bg-white px-2 py-1 rounded-full shadow-sm">
            <img src="https://flagcdn.com/w40/id.png" class="w-5 h-auto rounded-sm" alt="ID" />
            <span class="text-xs font-bold text-gray-500">ID</span>
            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>

          <a href="{{ url('login') }}" class="text-sm font-bold text-gray-600 hover:text-brand-pink px-2 md:px-3">Masuk</a>
          <a href="{{ url('pemesanan') }}" class="bg-brand-pink text-white px-4 py-2 md:px-5 md:py-2 rounded-full text-xs md:text-sm font-bold shadow-lg hover:bg-pink-600 transition">Daftar</a>
        </div>
      </div>
    </nav>

    {{-- HERO + SLIDER (gabungkan slider lama ke hero baru) --}}
    <header class="relative w-full min-h-[800px] md:min-h-[750px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
      <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
        <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Latar Belakang Jepang" />
        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
      </div>

      <div class="container max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10 items-center">
        <div class="pt-4 md:pt-10">
          <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-2">
            <span class="relative inline-block">
              <span class="absolute -left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
              Program Resmi
            </span>
            <br />
            <span class="text-brand-pink">Belajar & Kerja</span> di <br />
            Jepang
          </h1>

          {{-- Kutipan singkat dari konfigurasi / tentang --}}
          <p class="text-gray-500 mb-6 max-w-md leading-relaxed text-sm font-medium">
            {{ $site_config->namaweb ?? 'Program resmi belajar dan bekerja di Jepang.' }}
          </p>

          {{-- Tombol CTA: Daftar & WhatsApp --}}
          <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
            <a href="{{ url('pemesanan') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
              Daftar Sekarang
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
              </svg>
            </a>
            @if($waNumber)
            <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition flex items-center justify-center w-full sm:w-auto border border-pink-100 sm:border-transparent">
              <div class="w-8 h-8 rounded-full border-2 border-brand-pink flex items-center justify-center mr-2">
                <span class="text-xl">💬</span>
              </div>
              Chat via WhatsApp
            </a>
            @endif
          </div>

          {{-- Info singkat jumlah berita/layanan sebagai \"statistik\" --}}
          <div class="flex items-center space-x-3">
            <div class="flex -space-x-3">
              <div class="w-10 h-10 rounded-full border-2 border-white shadow-sm bg-pink-100 flex items-center justify-center text-xs font-bold text-brand-pink">
                {{ $berita->count() }}
              </div>
              <div class="w-10 h-10 rounded-full border-2 border-white shadow-sm bg-blue-100 flex items-center justify-center text-xs font-bold text-blue-600">
                {{ $layanan->count() }}
              </div>
            </div>
            <div class="text-sm">
              <span class="text-brand-pink font-bold text-lg">{{ $berita->count() }}+</span>
              <p class="text-xs text-gray-500 font-medium">artikel & program telah dipublikasikan</p>
            </div>
          </div>
        </div>

        {{-- Gambar slider utama: ambil satu gambar dari $slider --}}
        <div class="relative h-full flex items-end justify-center md:justify-end mt-10 md:mt-0">
          @php
              $sliderUtama = $slider->first();
          @endphp
          @if($sliderUtama)
            <img src="{{ asset('assets/upload/image/'.$sliderUtama->gambar) }}" class="relative z-10 w-[80%] md:w-[90%] object-cover drop-shadow-2xl rounded-3xl" alt="{{ $sliderUtama->judul_galeri ?? 'Slider' }}" />
          @else
            <img src="{{ asset('template/img/image5.png') }}" class="relative z-10 w-[80%] md:w-[90%] object-contain drop-shadow-2xl rounded-b-none" alt="Student" />
          @endif
        </div>
      </div>

      <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
    </header>

    {{-- LAYANAN (gunakan $layanan lama dalam kartu Tailwind) --}}
    <section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10">
        <div class="md:w-1/3">
          <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
          <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Program & Layanan</h2>
        </div>
        <div class="md:w-2/3">
          <p class="text-gray-500 leading-relaxed mb-6 font-medium text-sm md:text-base">
            Pilihan layanan dan program resmi yang dikelola oleh {{ $site_config->namaweb ?? 'lembaga kami' }}. Semua program telah
            dikurasi untuk mendukung perjalanan Anda ke Jepang.
          </p>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-6">
        @foreach($layanan as $item)
          <div class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
            <div class="h-48 overflow-hidden">
              <img src="{{ asset('assets/upload/image/thumbs/'.$item->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $item->judul_berita }}" />
            </div>
            <div class="p-6 flex flex-col h-full">
              <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug">{{ $item->judul_berita }}</h3>
              <p class="text-gray-500 text-sm mb-4 leading-relaxed">
                {{ \Illuminate\Support\Str::limit(strip_tags($item->keywords ?? $item->isi ?? ''), 100, '...') }}
              </p>
              <a href="{{ url('berita/layanan/'.$item->slug_berita) }}" class="mt-auto text-brand-pink font-bold text-sm hover:underline inline-flex items-center">
                Lihat Detail <span class="ml-1">→</span>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    {{-- WEBINAR / VIDEO (gunakan $videos) --}}
    @if($videos->count())
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12">
          <div class="max-w-xl">
            <h2 class="text-3xl font-bold text-brand-pink mb-4">Webinar & Video</h2>
            <p class="text-gray-500 font-medium text-sm">
              Ikuti webinar dan materi video terbaru kami seputar persiapan studi dan kerja di Jepang.
            </p>
          </div>
          <div class="hidden md:flex space-x-3 mt-6 md:mt-0">
            <a href="{{ url('video') }}" class="w-40 h-12 rounded-full border border-pink-200 text-brand-pink flex items-center justify-center hover:bg-brand-pink hover:text-white transition shadow-sm text-sm font-bold">
              Lihat Semua
            </a>
          </div>
        </div>

        <div class="flex gap-6 md:gap-8 overflow-x-auto pb-10 justify-start md:justify-between px-1 md:px-0 no-scrollbar">
          @foreach($videos as $video)
          <div class="group relative w-64 md:w-72 bg-white rounded-2xl shadow-soft overflow-hidden shrink-0 cursor-pointer transition transform hover:scale-105">
            <div class="h-40 relative overflow-hidden">
              <img src="{{ asset('assets/upload/image/'.$video->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $video->judul }}" />
              <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                <div class="w-14 h-14 rounded-full bg-white/90 flex items-center justify-center">
                  <svg class="w-7 h-7 text-brand-pink ml-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z" />
                  </svg>
                </div>
              </div>
            </div>
            <div class="p-5">
              <h3 class="font-bold text-gray-800 mb-2 text-sm md:text-base leading-snug">{{ $video->judul }}</h3>
              <a href="https://youtu.be/{{ $video->video }}" target="_blank" class="text-brand-pink font-bold text-xs md:text-sm hover:underline inline-flex items-center">
                Tonton di YouTube <span class="ml-1">→</span>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    {{-- BERITA TERBARU (gunakan $berita) --}}
    <section class="py-16 md:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10 mb-8 md:mb-12">
          <div class="md:w-1/3">
            <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
            <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Berita & Updates</h2>
          </div>
          <div class="md:w-2/3 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <p class="text-gray-500 leading-relaxed font-medium text-sm md:text-base">
              Temukan update terbaru mengenai program, kegiatan, dan informasi penting lainnya dari {{ $site_config->namaweb ?? 'kami' }}.
            </p>
            <a href="{{ url('berita') }}" class="bg-brand-yellow text-gray-900 px-6 py-3 rounded-full font-bold text-xs md:text-sm shadow-md hover:bg-yellow-300 transition inline-flex items-center justify-center">
              Lihat Semua Berita <span class="ml-2">></span>
            </a>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
          @foreach($berita as $b)
          <article class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
            <div class="h-48 overflow-hidden">
              <img src="{{ asset('assets/upload/image/thumbs/'.$b->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $b->judul_berita }}" />
            </div>
            <div class="p-6 flex flex-col h-full">
              <div class="flex items-center text-xs text-gray-400 mb-3">
                <span>📅</span>
                <span class="ml-2">{{ tanggal('tanggal_id', $b->tanggal_publish) }}</span>
                @if(!empty($b->nama_kategori))
                  <span class="mx-2">•</span>
                  <span class="text-brand-pink font-semibold">{{ $b->nama_kategori }}</span>
                @endif
              </div>
              <h3 class="font-bold text-gray-800 text-base md:text-lg mb-3 leading-snug group-hover:text-brand-pink transition">
                {{ $b->judul_berita }}
              </h3>
              <p class="text-gray-500 text-sm mb-4 leading-relaxed">
                {{ \Illuminate\Support\Str::limit(strip_tags($b->isi), 110, '...') }}
              </p>
              <a href="{{ url('berita/read/'.$b->slug_berita) }}" class="mt-auto text-brand-pink font-bold text-sm hover:underline inline-flex items-center">
                Baca Selengkapnya <span class="ml-1">→</span>
              </a>
            </div>
          </article>
          @endforeach
        </div>
      </div>
    </section>

    {{-- PROJECTS (menggunakan kategori_download seperti di footer lama) --}}
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center mb-8 md:mb-12">
          <h2 class="text-2xl md:text-3xl font-bold text-brand-pink">Projects</h2>
          <a href="{{ url('project') }}" class="text-sm font-bold text-brand-pink hover:underline">Lihat Semua Projects →</a>
        </div>

        @php
          $kategori_download = DB::table('kategori_download')
                ->orderBy('kategori_download.urutan','ASC')
                ->limit(4)
                ->get();
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
          @foreach($kategori_download as $kd)
          <div class="bg-white rounded-2xl shadow-soft p-6 text-center hover:shadow-xl transition border border-transparent hover:border-pink-100">
            <h3 class="font-bold text-gray-800 mb-2 text-base md:text-lg">{{ $kd->nama_kategori_download }}</h3>
            <p class="text-xs text-gray-500 font-medium mb-4">
              {{ \Illuminate\Support\Str::limit(strip_tags($kd->keterangan), 90, '...') }}
            </p>
            <a href="{{ url('project/kategori/'.$kd->slug_kategori_download) }}" class="bg-brand-pink text-white px-4 py-2 rounded-full text-xs font-bold shadow hover:bg-pink-600 transition inline-flex items-center">
              Lihat Detail <span class="ml-1">→</span>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    {{-- CTA PENDAFTARAN --}}
    <section class="py-20 bg-white">
      <div class="max-w-4xl mx-auto px-6">
        <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-3xl p-8 md:p-12 text-center shadow-soft">
          <h2 class="text-3xl md:text-4xl font-bold text-brand-pink mb-4">Siap Memulai Perjalanan ke Jepang?</h2>
          <p class="text-gray-600 mb-8 font-medium text-sm md:text-base max-w-2xl mx-auto">
            Daftar sekarang atau hubungi kami untuk mendapatkan konsultasi awal secara gratis mengenai program yang paling sesuai untuk Anda.
          </p>
          <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="{{ url('pemesanan') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition w-full sm:w-auto">
              Mulai Pendaftaran
            </a>
            @if($waNumber)
            <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition border border-pink-100 w-full sm:w-auto inline-block text-center">
              Konsultasi via WhatsApp
            </a>
            @endif
          </div>
        </div>
      </div>
    </section>

    {{-- FOOTER SEDERHANA (adaptasi dari template) --}}
    <footer class="bg-white pt-16 pb-10 border-t border-gray-100">
      <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
        <div class="col-span-1 md:col-span-2">
          <div class="text-2xl font-extrabold text-brand-pink mb-6">
            <a href="{{ url('/') }}">{{ $site_config->nama_singkat ?? 'StudyAbroad' }}</a>
          </div>
          <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-6 font-medium">
            {{ $site_config->deskripsi ?? 'Lembaga resmi pelatihan bahasa dan kerja ke Jepang.' }}
          </p>
        </div>
        <div>
          <h4 class="font-bold text-gray-800 mb-6">Menu</h4>
          <ul class="space-y-3 text-sm text-gray-500 font-medium">
            <li><a href="{{ url('/') }}" class="hover:text-brand-pink transition">Beranda</a></li>
            <li><a href="{{ url('info') }}" class="hover:text-brand-pink transition">Tentang Kami</a></li>
            <li><a href="{{ url('proyek') }}" class="hover:text-brand-pink transition">Projects</a></li>
            <li><a href="{{ url('berita') }}" class="hover:text-brand-pink transition">Blog</a></li>
            <li><a href="{{ url('kontak') }}" class="hover:text-brand-pink transition">Kontak</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold text-gray-800 mb-6">Hubungi Kami</h4>
          <ul class="space-y-3 text-sm text-gray-500 font-medium">
            @if(!empty($site_config->alamat))
            <li class="flex items-start">
              <span class="mr-2">📍</span> {{ $site_config->alamat }}
            </li>
            @endif
            @if(!empty($site_config->telepon))
            <li class="flex items-center">
              <span class="mr-2">📞</span> {{ $site_config->telepon }}
            </li>
            @endif
            @if(!empty($site_config->email))
            <li class="flex items-center">
              <span class="mr-2">✉️</span> {{ $site_config->email }}
            </li>
            @endif
          </ul>
        </div>
      </div>
      <div class="max-w-7xl mx-auto px-6 text-center text-xs text-gray-400 pt-8 border-t border-gray-100 font-medium">
        &copy; {{ date('Y') }} {{ $site_config->namaweb ?? 'StudyAbroad' }}. All rights reserved.
      </div>
    </footer>
  </body>
</html>

