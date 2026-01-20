@extends('layouts.main')

@section('title', 'Blog - StudyAbroad')

@section('nav-blog', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[800px] md:min-h-[750px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Blog" />
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
        <button onclick="openVideoModal('{{ asset('template/img/video-intro.mp4') }}')" class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition flex items-center justify-center w-full sm:w-auto border border-pink-100 sm:border-transparent">
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
        Temukan berbagai artikel informatif tentang kehidupan di Jepang, tips belajar bahasa Jepang, panduan visa, dan banyak lagi.
      </p>
      <div class="flex flex-wrap gap-2 mb-6">
        <span class="bg-pink-50 text-brand-pink px-3 py-1 rounded-full text-sm font-medium">Tips Belajar</span>
        <span class="bg-pink-50 text-brand-pink px-3 py-1 rounded-full text-sm font-medium">Panduan Visa</span>
        <span class="bg-pink-50 text-brand-pink px-3 py-1 rounded-full text-sm font-medium">Budaya Jepang</span>
        <span class="bg-pink-50 text-brand-pink px-3 py-1 rounded-full text-sm font-medium">Karier</span>
      </div>
    </div>
  </div>
</section>

<section class="py-16">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Artikel Pilihan</h2>
      <p class="text-gray-500 text-sm font-medium">Artikel terbaik untuk membantu perjalanan belajar dan karir Anda di Jepang.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <!-- Artikel 1: Tips Belajar Bahasa Jepang -->
      <article class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden bg-gray-50">
          <img src="{{ asset('template/img/blog-1.jpg') }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" alt="Tips Belajar Bahasa Jepang" />
        </div>
        <div class="p-6">
          <div class="flex items-center text-xs text-gray-400 mb-3">
            <span>📅</span>
            <span class="ml-2">15 Desember 2024</span>
            <span class="mx-2">•</span>
            <span class="text-brand-pink font-semibold">Tips & Trik</span>
          </div>
          <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-brand-pink transition">10 Tips Cepat Belajar Bahasa Jepang untuk Pemula</h3>
          <p class="text-gray-500 text-sm mb-4 leading-relaxed line-clamp-2">Pelajari cara efektif menguasai bahasa Jepang dari dasar dengan metode yang terbukti berhasil. Mulai dari hiragana hingga percakapan sehari-hari.</p>
          <a href="#" class="text-brand-pink font-bold text-sm hover:underline inline-flex items-center">Baca Selengkapnya <span class="ml-1">→</span></a>
        </div>
      </article>

      <!-- Artikel 2: Panduan Visa Jepang -->
      <article class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden bg-gray-50">
          <img src="{{ asset('template/img/blog-2.jpg') }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" alt="Panduan Visa Jepang" />
        </div>
        <div class="p-6">
          <div class="flex items-center text-xs text-gray-400 mb-3">
            <span>📅</span>
            <span class="ml-2">12 Desember 2024</span>
            <span class="mx-2">•</span>
            <span class="text-brand-pink font-semibold">Panduan</span>
          </div>
          <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-brand-pink transition">Panduan Lengkap Mengurus Visa Kerja ke Jepang</h3>
          <p class="text-gray-500 text-sm mb-4 leading-relaxed line-clamp-2">Semua yang perlu Anda ketahui tentang proses pengurusan visa kerja ke Jepang, dokumen yang diperlukan, dan tips agar aplikasi Anda disetujui.</p>
          <a href="#" class="text-brand-pink font-bold text-sm hover:underline inline-flex items-center">Baca Selengkapnya <span class="ml-1">→</span></a>
        </div>
      </article>

      <!-- Artikel 3: Budaya Kerja Jepang -->
      <article class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden bg-gray-50">
          <img src="{{ asset('template/img/blog-3.jpg') }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" alt="Budaya Kerja Jepang" />
        </div>
        <div class="p-6">
          <div class="flex items-center text-xs text-gray-400 mb-3">
            <span>📅</span>
            <span class="ml-2">10 Desember 2024</span>
            <span class="mx-2">•</span>
            <span class="text-brand-pink font-semibold">Budaya</span>
          </div>
          <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-brand-pink transition">Memahami Budaya Kerja di Jepang: Etika & Norma</h3>
          <p class="text-gray-500 text-sm mb-4 leading-relaxed line-clamp-2">Pelajari etika dan norma budaya kerja di Jepang yang penting untuk diketahui sebelum memulai karier di negeri sakura ini.</p>
          <a href="#" class="text-brand-pink font-bold text-sm hover:underline inline-flex items-center">Baca Selengkapnya <span class="ml-1">→</span></a>
        </div>
      </article>

      <!-- Artikel 4: Persiapan JLPT -->
      <article class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden bg-gray-50">
          <img src="{{ asset('template/img/blog-4.jpg') }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" alt="Persiapan JLPT" />
        </div>
        <div class="p-6">
          <div class="flex items-center text-xs text-gray-400 mb-3">
            <span>📅</span>
            <span class="ml-2">8 Desember 2024</span>
            <span class="mx-2">•</span>
            <span class="text-brand-pink font-semibold">Pendidikan</span>
          </div>
          <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-brand-pink transition">Strategi Sukses Lulus JLPT N3 dalam 6 Bulan</h3>
          <p class="text-gray-500 text-sm mb-4 leading-relaxed line-clamp-2">Rencana belajar terstruktur dan strategi efektif untuk mencapai target lulus JLPT N3 dalam waktu singkat dengan hasil maksimal.</p>
          <a href="#" class="text-brand-pink font-bold text-sm hover:underline inline-flex items-center">Baca Selengkapnya <span class="ml-1">→</span></a>
        </div>
      </article>

      <!-- Artikel 5: Industri Jepang -->
      <article class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden bg-gray-50">
          <img src="{{ asset('template/img/blog-5.jpg') }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" alt="Industri Jepang" />
        </div>
        <div class="p-6">
          <div class="flex items-center text-xs text-gray-400 mb-3">
            <span>📅</span>
            <span class="ml-2">5 Desember 2024</span>
            <span class="mx-2">•</span>
            <span class="text-brand-pink font-semibold">Karier</span>
          </div>
          <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-brand-pink transition">Peluang Karier di Industri Manufaktur Jepang</h3>
          <p class="text-gray-500 text-sm mb-4 leading-relaxed line-clamp-2">Eksplorasi berbagai peluang karier di sektor manufaktur Jepang, skill yang dibutuhkan, dan prospek gaji yang ditawarkan.</p>
          <a href="#" class="text-brand-pink font-bold text-sm hover:underline inline-flex items-center">Baca Selengkapnya <span class="ml-1">→</span></a>
        </div>
      </article>

      <!-- Artikel 6: Hidup di Jepang -->
      <article class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden bg-gray-50">
          <img src="{{ asset('template/img/blog-6.jpg') }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" alt="Hidup di Jepang" />
        </div>
        <div class="p-6">
          <div class="flex items-center text-xs text-gray-400 mb-3">
            <span>📅</span>
            <span class="ml-2">3 Desember 2024</span>
            <span class="mx-2">•</span>
            <span class="text-brand-pink font-semibold">Lifestyle</span>
          </div>
          <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-brand-pink transition">Panduan Hidup di Jepang: Akomodasi & Biaya Hidup</h3>
          <p class="text-gray-500 text-sm mb-4 leading-relaxed line-clamp-2">Informasi lengkap tentang mencari tempat tinggal, biaya hidup bulanan, dan tips menghemat pengeluaran saat tinggal di Jepang.</p>
          <a href="#" class="text-brand-pink font-bold text-sm hover:underline inline-flex items-center">Baca Selengkapnya <span class="ml-1">→</span></a>
        </div>
      </article>
    </div>

    <div class="text-center mt-12">
      <button class="bg-brand-yellow text-gray-900 px-10 py-3 rounded-full font-bold text-sm shadow-md hover:bg-yellow-300 transition inline-flex items-center">Lihat Semua Artikel <span class="ml-2">></span></button>
    </div>
  </div>
</section>

<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Kategori Artikel</h2>
      <p class="text-gray-500 text-sm font-medium">Jelajahi artikel berdasarkan kategori yang Anda minati.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
      <a href="#" class="bg-white rounded-xl shadow-soft p-6 text-center hover:shadow-xl transition hover:border-brand-pink border-2 border-transparent group">
        <div class="w-16 h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-pink transition">
          <span class="text-3xl group-hover:scale-110 transition">📚</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Tips & Trik</h3>
        <p class="text-xs text-gray-500 font-medium">12 Artikel</p>
      </a>

      <a href="#" class="bg-white rounded-xl shadow-soft p-6 text-center hover:shadow-xl transition hover:border-brand-pink border-2 border-transparent group">
        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-pink transition">
          <span class="text-3xl group-hover:scale-110 transition">📝</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Panduan</h3>
        <p class="text-xs text-gray-500 font-medium">8 Artikel</p>
      </a>

      <a href="#" class="bg-white rounded-xl shadow-soft p-6 text-center hover:shadow-xl transition hover:border-brand-pink border-2 border-transparent group">
        <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-pink transition">
          <span class="text-3xl group-hover:scale-110 transition">💼</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Karier</h3>
        <p class="text-xs text-gray-500 font-medium">15 Artikel</p>
      </a>

      <a href="#" class="bg-white rounded-xl shadow-soft p-6 text-center hover:shadow-xl transition hover:border-brand-pink border-2 border-transparent group">
        <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-pink transition">
          <span class="text-3xl group-hover:scale-110 transition">🏯</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Budaya</h3>
        <p class="text-xs text-gray-500 font-medium">10 Artikel</p>
      </a>
    </div>
  </div>
</section>

<section class="py-20 bg-white">
  <div class="max-w-4xl mx-auto px-6">
    <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-3xl p-8 md:p-12 text-center shadow-soft">
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink mb-4">Ingin Mendapatkan Update Artikel Terbaru?</h2>
      <p class="text-gray-600 mb-8 font-medium text-sm md:text-base max-w-2xl mx-auto">
        Daftar newsletter kami dan dapatkan artikel terbaru langsung di inbox Anda setiap minggu.
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 max-w-lg mx-auto">
        <input type="email" placeholder="Masukkan email Anda" class="w-full sm:flex-1 px-6 py-3 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-pink text-sm" />
        <button class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition w-full sm:w-auto">
          Berlangganan
        </button>
      </div>
    </div>
  </div>
</section>

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
        <source src="{{ asset('template/img/video-intro.mp4') }}" type="video/mp4">
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
@endsection
