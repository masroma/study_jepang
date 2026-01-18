<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $title }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ["Poppins", "sans-serif"] },
          colors: {
            "brand-pink": "#FF2E93",
            "brand-yellow": "#FFDE00",
            "brand-blue": "#E0F2FE",
          },
          boxShadow: { soft: "0 10px 40px -10px rgba(0,0,0,0.08)" },
        },
      },
    };
  </script>
  <style>
    .hero-bg { background: linear-gradient(100deg, #eff6ff 0%, #dbeafe 50%, #bfdbfe 100%); }
  </style>
</head>
<body class="font-sans text-gray-700 overflow-x-hidden">
  @include('partials.navbar', ['site_config' => $site_config])

  <header class="relative w-full min-h-[600px] md:min-h-[650px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Training Center" />
      <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
    </div>
    <div class="container max-w-7xl mx-auto px-6 relative z-10">
      <div class="max-w-3xl pt-4 md:pt-10">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
          <span class="text-brand-pink">Training Center</span><br />
          Pelatihan Bahasa Jepang<br />
          Profesional
        </h1>
        <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
          Pusat pelatihan bahasa Jepang terpercaya dengan metode pembelajaran modern, instruktur berpengalaman, dan fasilitas lengkap untuk mempersiapkan Anda meraih kesuksesan di Jepang.
        </p>
        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
          <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
            Daftar Training <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
          </a>
        </div>
      </div>
    </div>
    <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
  </header>

  <section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10">
      <div class="md:w-1/3">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Kenapa Pilih<br />Training Center Kami?</h2>
      </div>
      <div class="md:w-2/3">
        <p class="text-gray-500 leading-relaxed mb-6 font-medium text-sm md:text-base">
          Kami menyediakan program pelatihan bahasa Jepang yang komprehensif dengan kurikulum terstruktur, metode pembelajaran interaktif, dan dukungan penuh untuk mencapai target JLPT Anda. Dengan pengalaman lebih dari 10 tahun, kami telah membantu ribuan siswa meraih kesuksesan.
        </p>
      </div>
    </div>
  </section>

  <section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12 md:mb-16">
        <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Program Pelatihan Kami</h2>
        <p class="text-gray-500 text-sm font-medium">Pilih program yang sesuai dengan kebutuhan dan level Anda.</p>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @forelse($programs as $program)
        <div class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
          <div class="h-48 overflow-hidden">
            @if(isset($program->gambar))
            <img src="{{ asset('assets/upload/image/thumbs/'.$program->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @else
            <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @endif
          </div>
          <div class="p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4 leading-snug">{{ $program->judul_berita ?? $program->judul_agenda ?? 'Program Training' }}</h3>
            <p class="text-gray-500 text-sm mb-4 leading-relaxed">{{ \Illuminate\Support\Str::limit(strip_tags($program->isi ?? $program->keterangan ?? ''), 100) }}</p>
            <a href="{{ isset($program->slug_berita) ? url('berita/layanan/'.$program->slug_berita) : '#' }}" class="text-brand-pink font-bold text-sm hover:underline">Pelajari Lebih Lanjut →</a>
          </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
          <p class="text-gray-500">Program pelatihan sedang dalam persiapan.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12 md:mb-16">
        <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Fasilitas & Keunggulan</h2>
        <p class="text-gray-500 text-sm font-medium">Fasilitas lengkap untuk mendukung pembelajaran optimal Anda.</p>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
        <div class="bg-white rounded-2xl shadow-soft p-6 text-center hover:shadow-xl transition">
          <div class="w-16 h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-3xl">👨‍🏫</span>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">Instruktur Berpengalaman</h3>
          <p class="text-xs text-gray-500 font-medium">Instruktur native speaker dan lokal dengan sertifikasi resmi.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-soft p-6 text-center hover:shadow-xl transition">
          <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-3xl">💻</span>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">Kelas Online & Offline</h3>
          <p class="text-xs text-gray-500 font-medium">Fleksibel belajar dari rumah atau datang ke training center.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-soft p-6 text-center hover:shadow-xl transition">
          <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-3xl">📚</span>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">Materi Terupdate</h3>
          <p class="text-xs text-gray-500 font-medium">Kurikulum mengikuti standar JLPT terbaru.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-soft p-6 text-center hover:shadow-xl transition">
          <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-3xl">🎯</span>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">Garansi Lulus</h3>
          <p class="text-xs text-gray-500 font-medium">Program garansi lulus JLPT dengan sistem pembelajaran terstruktur.</p>
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer', ['site_config' => $site_config])
</body>
</html>
