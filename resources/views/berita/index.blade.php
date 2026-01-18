<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $title }} - {{ $site->namaweb }}</title>
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
          boxShadow: {
            soft: "0 10px 40px -10px rgba(0,0,0,0.08)",
          },
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
  @include('partials.navbar', ['site_config' => $site])

  <header class="relative w-full min-h-[500px] md:min-h-[550px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
      @php $bg = DB::table('heading')->where('halaman','Berita')->orderBy('id_heading','DESC')->first(); @endphp
      @if($bg && $bg->gambar)
      <img src="{{ asset('assets/upload/image/'.$bg->gambar) }}" class="w-full h-full object-cover opacity-60" alt="Blog" />
      @else
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Blog" />
      @endif
      <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
    </div>
    <div class="container max-w-7xl mx-auto px-6 relative z-10">
      <div class="max-w-3xl pt-4 md:pt-10">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
          <span class="text-brand-pink">Blog</span><br />
          Tips & Informasi<br />
          Seputar Jepang
        </h1>
        <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
          Dapatkan informasi terbaru, tips belajar bahasa Jepang, panduan bekerja di Jepang, dan berbagai artikel menarik lainnya untuk membantu perjalanan Anda.
        </p>
      </div>
    </div>
    <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
  </header>

  <section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10 mb-12">
      <div class="md:w-1/3">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Artikel<br />Terbaru</h2>
      </div>
      <div class="md:w-2/3">
        <p class="text-gray-500 leading-relaxed mb-6 font-medium text-sm md:text-base">
          Temukan berbagai artikel informatif tentang kehidupan di Jepang, tips belajar bahasa Jepang, panduan visa, dan banyak lagi.
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      @forelse($berita as $item)
      <article class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden">
          <img src="{{ asset('assets/upload/image/thumbs/'.$item->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $item->judul_berita }}" />
        </div>
        <div class="p-6">
          <div class="flex items-center text-xs text-gray-400 mb-3">
            <span>📅</span>
            <span class="ml-2">{{ tanggal('tanggal_id', $item->tanggal_publish) }}</span>
            <span class="mx-2">•</span>
            <span class="text-brand-pink font-semibold">{{ $item->nama_kategori ?? 'Berita' }}</span>
          </div>
          <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-brand-pink transition">
            <a href="{{ url('berita/read/'.$item->slug_berita) }}">{{ $item->judul_berita }}</a>
          </h3>
          <p class="text-gray-500 text-sm mb-4 leading-relaxed line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100, $end='...') }}</p>
          <a href="{{ url('berita/read/'.$item->slug_berita) }}" class="text-brand-pink font-bold text-sm hover:underline inline-flex items-center">Baca Selengkapnya <span class="ml-1">→</span></a>
        </div>
      </article>
      @empty
      <div class="col-span-full text-center py-12">
        <p class="text-gray-500">Belum ada artikel tersedia.</p>
      </div>
      @endforelse
    </div>

    @if(method_exists($beritas, 'links'))
    <div class="text-center mt-12">
      {{ $beritas->links() }}
    </div>
    @endif
  </section>

  @php
  $kategori_berita = DB::table('kategori')->orderBy('nama_kategori', 'ASC')->get();
  @endphp
  @if($kategori_berita->count() > 0)
  <section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12 md:mb-16">
        <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Kategori Artikel</h2>
        <p class="text-gray-500 text-sm font-medium">Jelajahi artikel berdasarkan kategori yang Anda minati.</p>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        @foreach($kategori_berita as $kat)
        <a href="{{ url('berita/kategori/'.$kat->slug_kategori) }}" class="bg-white rounded-xl shadow-soft p-6 text-center hover:shadow-xl transition hover:border-brand-pink border-2 border-transparent group">
          <div class="w-16 h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-pink transition">
            <span class="text-3xl group-hover:scale-110 transition">📚</span>
          </div>
          <h3 class="font-bold text-gray-800 mb-2">{{ $kat->nama_kategori }}</h3>
        </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @include('partials.footer', ['site_config' => $site])
</body>
</html>
