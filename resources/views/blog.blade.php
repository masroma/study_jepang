@extends('layouts.main')

@section('title', 'Blog - StudyAbroad')

@section('nav-blog', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[800px] md:min-h-[750px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Blog" loading="eager" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10 items-center">
    <div class="pt-4 md:pt-10">
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-2">
        <span class="relative inline-block">
          <span class="absolute -left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
          Blog
        </span>
        <br />
        <span class="text-brand-pink">Tips & Informasi</span> di <br />
        Jepang <span class="inline-block w-8 h-8 align-middle ml-2 shadow-sm rounded-full overflow-hidden border border-gray-200"><img src="https://flagcdn.com/w80/jp.png" class="w-full h-full object-cover" /></span>
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
        Dapatkan informasi terbaru, tips belajar bahasa Jepang, panduan bekerja di Jepang, dan berbagai artikel menarik lainnya untuk membantu perjalanan Anda.
      </p>
      <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
          Mulai Belajar <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
        <button onclick="openVideoModal('#')" class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition flex items-center justify-center w-full sm:w-auto border border-pink-100 sm:border-transparent">
          <div class="w-8 h-8 rounded-full border-2 border-brand-pink flex items-center justify-center mr-2">
            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" /></svg>
          </div>
          Lihat Video
        </button>
      </div>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
  <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10">
    <div class="md:w-1/3">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Artikel<br />Terbaru</h2>
    </div>
    <div class="md:w-2/3">
      <p class="text-gray-500 leading-relaxed mb-6 font-medium text-sm md:text-base">
        Jelajahi artikel informatif tentang peluang belajar dan bekerja di Jepang, tips menguasai bahasa Jepang, panduan visa, budaya kerja, dan kesuksesan alumni kami.
      </p>
      <div class="flex flex-wrap gap-2 mb-6">
        @foreach(collect(['Tips Belajar', 'Panduan Visa', 'Budaya Jepang', 'Karier']) as $tag)
        <span class="bg-pink-50 text-brand-pink px-3 py-1 rounded-full text-sm font-medium">{{ $tag }}</span>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section class="py-16">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Artikel Pilihan</h2>
      <p class="text-gray-500 text-sm font-medium">
        @if(isset($search_query))
          Hasil pencarian untuk: <strong>{{ $search_query }}</strong> ({{ $articles->total() }} artikel ditemukan)
        @elseif(isset($current_category))
          Kategori: <strong>{{ $current_category }}</strong>
        @else
          Artikel terbaik untuk membantu perjalanan belajar dan karir Anda di Jepang.
        @endif
      </p>
    </div>

    @if($articles->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      @foreach($articles as $article)
      <article class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden bg-gray-50">
          <img src="{{ $article->gambar }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $article->judul }}" loading="lazy" />
        </div>
        <div class="p-6">
          <div class="flex items-center text-xs text-gray-400 mb-3">
            <span>📅</span>
            <span class="ml-2">{{ $article->tanggal_publish->format('d M Y') }}</span>
            <span class="mx-2">•</span>
            <span class="text-brand-pink font-semibold">{{ $article->kategori }}</span>
          </div>
          <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-brand-pink transition line-clamp-2">{{ $article->judul }}</h3>
          <p class="text-gray-500 text-sm mb-4 leading-relaxed line-clamp-2">{{ $article->deskripsi_singkat }}</p>
          <div class="flex items-center justify-between">
            <a href="{{ route('blog.detail', $article->slug) }}" class="text-brand-pink font-bold text-sm hover:underline inline-flex items-center">Baca Selengkapnya <span class="ml-1">→</span></a>
            <span class="text-xs text-gray-400">👁 {{ $article->views }}</span>
          </div>
        </div>
      </article>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
      {{ $articles->links('pagination::bootstrap-4') }}
    </div>
    @else
    <div class="text-center py-12">
      <p class="text-gray-500 text-lg mb-4">Artikel tidak ditemukan</p>
      <a href="{{ route('blog.index') }}" class="text-brand-pink font-bold hover:underline">Kembali ke Blog</a>
    </div>
    @endif
  </div>
</section>

<!-- Kategori Section -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Kategori Artikel</h2>
      <p class="text-gray-600 text-sm font-medium">Jelajahi artikel berdasarkan kategori minat Anda untuk mendapatkan informasi yang paling relevan.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6">
      @php
      $colors = [
          'Pendidikan' => 'pink',
          'Panduan' => 'blue',
          'Karier' => 'yellow',
          'Budaya' => 'green',
          'Tips & Trik' => 'purple',
          'Lifestyle' => 'red',
      ];
      $emojis = [
          'Pendidikan' => '📚',
          'Panduan' => '📝',
          'Karier' => '💼',
          'Budaya' => '🏯',
          'Tips & Trik' => '💡',
          'Lifestyle' => '🌸',
      ];
      @endphp
      
      @foreach($categories as $category => $count)
      @if($count > 0)
      <a href="{{ route('blog.category', $category) }}" class="bg-{{ $colors[$category] }}-50 rounded-xl shadow-soft p-6 text-center hover:shadow-xl transition hover:border-brand-pink border-2 border-transparent group">
        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-pink transition">
          <span class="text-3xl group-hover:scale-110 transition">{{ $emojis[$category] }}</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">{{ $category }}</h3>
        <p class="text-xs text-gray-600 font-medium">{{ $count }} Artikel</p>
      </a>
      @endif
      @endforeach
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-pink-50 to-blue-50">
  <div class="max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-3xl p-8 md:p-12 text-center shadow-soft border border-gray-100">
      <div class="w-8 h-8 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink mb-4">Siap Mulai Perjalananmu ke Jepang?</h2>
      <p class="text-gray-600 mb-8 font-medium text-sm md:text-base max-w-2xl mx-auto">
        Konsultasikan impianmu bersama kami. Tim profesional Jemari Edu siap membantu dari persiapan, pelatihan bahasa, hingga penempatan kerja di Jepang.
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition w-full sm:w-auto">
          Konsultasi Gratis
        </a>
        <a href="{{ url('kontak') }}" class="bg-white text-brand-pink px-8 py-3 rounded-full font-bold border-2 border-brand-pink hover:bg-pink-50 transition w-full sm:w-auto">
          Hubungi Kami
        </a>
      </div>
    </div>
  </div>
</section>

@endsection

<!-- Video Modal -->
<div id="videoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-lg max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-bold text-gray-900">Video Blog</h3>
      <button onclick="closeVideoModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="relative w-full" style="padding-bottom: 56.25%;">
      <video id="modalVideo" class="w-full rounded-lg" controls>
        <source src="#" type="video/mp4">
      </video>
    </div>
  </div>
</div>

<script>
function openVideoModal(videoUrl) {
  const modal = document.getElementById('videoModal');
  const video = document.getElementById('modalVideo');
  
  if (modal && video) {
    modal.classList.remove('hidden');
    video.src = videoUrl;
    video.play();
  }
}

function closeVideoModal() {
  const modal = document.getElementById('videoModal');
  const video = document.getElementById('modalVideo');
  
  if (modal && video) {
    modal.classList.add('hidden');
    video.pause();
    video.src = '';
  }
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
  const modal = document.getElementById('videoModal');
  if (modal && event.target === modal) {
    closeVideoModal();
  }
});

// Close modal with ESC key
document.addEventListener('keydown', function(event) {
  if (event.key === 'Escape') {
    closeVideoModal();
  }
});
</script>

