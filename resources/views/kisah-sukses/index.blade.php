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
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
  </style>
</head>
<body class="font-sans text-gray-700 overflow-x-hidden">
  @include('partials.navbar', ['site_config' => $site_config])

  <header class="relative w-full min-h-[600px] md:min-h-[650px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Kisah Sukses" />
      <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
    </div>
    <div class="container max-w-7xl mx-auto px-6 relative z-10">
      <div class="max-w-3xl pt-4 md:pt-10">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
          <span class="text-brand-pink">Kisah Sukses</span><br />
          Alumni Kami di<br />
          Jepang
        </h1>
        <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
          Inspirasi dari mereka yang telah meraih kesuksesan di Jepang. Dari nol hingga bekerja di perusahaan terbaik, berikut adalah kisah perjalanan mereka bersama {{ $site_config->nama_singkat ?? $site_config->namaweb }}.
        </p>
        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
          <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
            Daftar Sekarang <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
        <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Inspirasi<br />Kesuksesan</h2>
      </div>
      <div class="md:w-2/3">
        <p class="text-gray-500 leading-relaxed mb-6 font-medium text-sm md:text-base">
          Lebih dari 1,200+ alumni telah berhasil meraih impian mereka bekerja di Jepang. Dari berbagai latar belakang dan profesi, mereka membuktikan bahwa dengan dedikasi, pelatihan yang tepat, dan dukungan yang kuat, kesuksesan di Jepang bukanlah hal yang mustahil.
        </p>
      </div>
    </div>
  </section>

  <section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12 md:mb-16">
        <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Kisah Sukses Alumni</h2>
        <p class="text-gray-500 text-sm font-medium">Perjalanan mereka dari Indonesia hingga sukses bekerja di Jepang.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        @forelse($testimoni as $testi)
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col">
          <div class="w-full relative">
            <div class="absolute inset-0 bg-orange-500 mix-blend-multiply opacity-20 z-10"></div>
            @if(isset($testi->gambar))
            <img src="{{ asset('assets/upload/image/'.$testi->gambar) }}" class="w-full h-64 object-cover" alt="{{ $testi->judul_berita ?? $testi->nama_staff ?? 'Testimoni' }}" />
            @else
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80" class="w-full h-64 object-cover" alt="Testimoni" />
            @endif
          </div>
          <div class="p-8 flex flex-col justify-center">
            <div class="flex text-yellow-400 mb-4 text-sm">★★★★★</div>
            <p class="text-gray-600 mb-6 italic leading-relaxed text-sm">
              {{ isset($testi->isi) ? \Illuminate\Support\Str::limit(strip_tags($testi->isi), 200) : (isset($testi->keterangan) ? \Illuminate\Support\Str::limit(strip_tags($testi->keterangan), 200) : 'Testimoni alumni yang sukses bekerja di Jepang.') }}
            </p>
            <div class="mb-4">
              <h4 class="font-bold text-gray-900 text-lg">{{ $testi->judul_berita ?? $testi->nama_staff ?? 'Alumni' }}</h4>
              <p class="text-xs text-brand-pink font-semibold uppercase tracking-wide mb-2">
                {{ isset($testi->keywords) ? $testi->keywords : (isset($testi->jabatan) ? $testi->jabatan : 'Alumni Sukses') }}
              </p>
            </div>
          </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
          <p class="text-gray-500">Belum ada testimoni tersedia.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12 md:mb-16">
        <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Statistik Kesuksesan</h2>
        <p class="text-gray-500 text-sm font-medium">Bukti nyata kesuksesan program kami.</p>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
        <div class="bg-white rounded-2xl shadow-soft p-8 text-center hover:shadow-xl transition">
          <div class="text-4xl md:text-5xl font-extrabold text-brand-pink mb-2">1,200+</div>
          <h3 class="font-bold text-gray-800 mb-2">Alumni Sukses</h3>
          <p class="text-xs text-gray-500 font-medium">Siswa yang telah bekerja di Jepang</p>
        </div>
        <div class="bg-white rounded-2xl shadow-soft p-8 text-center hover:shadow-xl transition">
          <div class="text-4xl md:text-5xl font-extrabold text-brand-pink mb-2">95%</div>
          <h3 class="font-bold text-gray-800 mb-2">Tingkat Kelulusan</h3>
          <p class="text-xs text-gray-500 font-medium">Siswa yang lulus JLPT</p>
        </div>
        <div class="bg-white rounded-2xl shadow-soft p-8 text-center hover:shadow-xl transition">
          <div class="text-4xl md:text-5xl font-extrabold text-brand-pink mb-2">50+</div>
          <h3 class="font-bold text-gray-800 mb-2">Perusahaan Mitra</h3>
          <p class="text-xs text-gray-500 font-medium">Perusahaan terpercaya di Jepang</p>
        </div>
        <div class="bg-white rounded-2xl shadow-soft p-8 text-center hover:shadow-xl transition">
          <div class="text-4xl md:text-5xl font-extrabold text-brand-pink mb-2">10+</div>
          <h3 class="font-bold text-gray-800 mb-2">Tahun Pengalaman</h3>
          <p class="text-xs text-gray-500 font-medium">Membantu siswa meraih impian</p>
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer', ['site_config' => $site_config])
</body>
</html>
