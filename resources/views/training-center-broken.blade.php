@extends('layouts.main')

@section('title', 'Training Center - StudyAbroad')

@section('nav-training-center', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[800px] md:min-h-[750px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Training Center" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10 items-center">
    <div class="pt-4 md:pt-10">
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-2">
        <span class="relative inline-block">
          <span class="absolute -left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
          Training Center
        </span>
        <br />
        <span class="text-brand-pink">Pelatihan Bahasa Jepang Profesional</span>
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
        Pusat pelatihan bahasa Jepang terpercaya dengan metode pembelajaran modern, instruktur berpengalaman, dan fasilitas lengkap untuk mempersiapkan Anda meraih kesuksesan di Jepang.
      </p>
      <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
          Daftar Training <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
        <button onclick="@if(isset($videos) && $videos->isNotEmpty()) openVideoModal('{{ $videos->first()->video }}')" @else="#" class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition flex items-center justify-center w-full sm:w-auto border border-pink-100 sm:border-transparent">
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
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Kenapa Pilih<br />Training Center Kami?</h2>
    </div>
    <div class="md:w-2/3">
      <p class="text-gray-500 leading-relaxed mb-6 font-medium text-sm md:text-base">
        Pusat pelatihan bahasa Jepang yang dirancang khusus untuk membantu Anda meraih kesuksesan karir di Jepang. Dengan metode pembelajaran modern dan instruktur berpengalaman, kami siap mendukung perjalanan Anda.
      </p>
      <div class="flex flex-wrap gap-2 mb-6">
        @if($programs->isNotEmpty())
          @foreach($programs->take(3) as $program)
            @if(!empty($program->keywords))
              @foreach(explode(',', $program->keywords) as $tag)
                <span class="bg-pink-50 text-brand-pink px-3 py-1 rounded-full text-sm font-medium">{{ trim($tag) }}</span>
              @endforeach
            @endif
          @endforeach
        @endif
      </div>
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
        <div class="h-48 overflow-hidden bg-gray-50">
          @if(!empty($program->gambar))
            <img src="{{ asset($program->gambar) }}" alt="{{ $program->judul_berita ?? $program->judul_agenda }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" />
          @else
            <img src="{{ asset('template/img/program-default.jpg') }}" alt="Default program image" class="w-full h-full object-contain bg-gray-50 group-hover:scale-110 transition duration-500" />
          @endif
        </div>
        <div class="p-6">
          <h3 class="font-bold text-gray-800 text-lg mb-4 leading-snug">{{ $program->judul_berita ?? $program->judul_agenda }}</h3>
          <p class="text-xs text-gray-500 font-medium mb-4">{{ Str::limit(strip_tags($program->isi ?? $program->isi_agenda), 100) }}</p>
          @if(isset($program->slug_berita))
            <a href="{{ url('berita/read/' . $program->slug_berita) }}" class="text-brand-pink font-bold text-sm hover:underline">Pelajari Lebih Lanjut →</a>
          @elseif(isset($program->slug_agenda))
            <a href="{{ url('agenda/detail/' . $program->slug_agenda) }}" class="text-brand-pink font-bold text-sm hover:underline">Lihat Detail Agenda →</a>
          @else
            <span class="text-gray-500 text-sm">Detail tidak tersedia</span>
          @endif
        </div>
      </div>
      @empty
      <p class="text-center text-gray-500">Belum ada program training tersedia.</p>
      @endforelse
    </div>

    <div class="text-center mt-12">
      <button class="bg-brand-yellow text-gray-900 px-10 py-3 rounded-full font-bold text-sm shadow-md hover:bg-yellow-300 transition inline-flex items-center">Lihat Semua Program <span class="ml-2">></span></button>
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
        <p class="text-xs text-gray-500 font-medium">Instruktur native speaker dan lokal dengan sertifikasi resmi dan pengalaman mengajar bertahun-tahun.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-6 text-center hover:shadow-xl transition">
        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
          <span class="text-3xl">💻</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Kelas Online & Offline</h3>
        <p class="text-xs text-gray-500 font-medium">Fleksibel belajar dari rumah atau datang ke training center dengan fasilitas modern dan nyaman.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-6 text-center hover:shadow-xl transition">
        <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-4">
          <span class="text-3xl">📚</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Materi Terupdate</h3>
        <p class="text-xs text-gray-500 font-medium">Kurikulum mengikuti standar JLPT terbaru dengan materi lengkap dan latihan soal yang beragam.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-6 text-center hover:shadow-xl transition">
        <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
          <span class="text-3xl">🎯</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Garansi Lulus</h3>
        <p class="text-xs text-gray-500 font-medium">Program garansi lulus JLPT dengan sistem pembelajaran yang terstruktur dan support penuh dari mentor.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-16 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-bold text-brand-pink text-center mb-16">Metode Pembelajaran</h2>

    <div class="flex flex-col md:flex-row justify-between items-start text-center relative px-4">
      <div class="hidden md:block absolute top-10 left-0 w-full h-[2px] bg-gray-100 -z-0"></div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">📖</span>
        </div>
        <h4 class="font-bold text-gray-900 mb-2">1. Teori & Konsep</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Pembelajaran dasar bahasa Jepang dengan penjelasan yang mudah dipahami.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">💬</span>
        </div>
        <h4 class="font-bold text-gray-900 mb-2">2. Praktik & Diskusi</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Latihan percakapan dan diskusi aktif untuk meningkatkan kemampuan komunikasi.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">✍️</span>
        </div>
        <h4 class="font-bold text-gray-900 mb-2">3. Latihan & Evaluasi</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Latihan soal dan evaluasi berkala untuk mengukur progress pembelajaran.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10">
        <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">🏆</span>
        </div>
        <h4 class="font-bold text-gray-900 mb-2">4. Sertifikasi</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Ujian JLPT dan sertifikat resmi sebagai bukti kemampuan bahasa Jepang Anda.</p>
      </div>
    </div>

    <div class="text-center mt-12">
      <button class="bg-brand-yellow text-gray-900 px-10 py-3 rounded-full font-bold text-sm shadow-md hover:bg-yellow-300 transition">Daftar Sekarang ></button>
    </div>
  </div>
</section>

<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center mb-12">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink">Testimoni Siswa</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      @forelse($testimoni_training as $testi)
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col">
        <div class="w-full relative">
          <div class="absolute inset-0 bg-orange-500 mix-blend-multiply opacity-20 z-10"></div>
          @if(!empty($testi->gambar))
            <img src="{{ asset($testi->gambar) }}" alt="{{ $testi->judul_berita }}" class="w-full h-48 object-contain bg-gray-50" />
          @else
            <img src="{{ asset('template/img/ChatGPT Image 18 Jan 2026, 07.02.36.png') }}" alt="Default testimonial image" class="w-full h-48 object-contain bg-gray-50" />
          @endif
        </div>
        <div class="p-8 flex flex-col justify-center flex-grow">
          <div class="flex text-yellow-400 mb-4 text-sm">★★★★★</div>
          <p class="text-gray-600 mb-6 italic leading-relaxed text-sm">"{{ Str::limit($testi->isi, 150) }}"</p>
          <div>
            <h4 class="font-bold text-gray-900 text-lg">{{ $testi->judul_berita }}</h4>
            <p class="text-xs text-brand-pink font-semibold uppercase tracking-wide">Testimoni Training</p>
          </div>
        </div>
      </div>
      @empty
      <p class="text-center text-gray-500">Belum ada testimoni tersedia.</p>
      @endforelse
    </div>
  </div>
</section>

<section class="py-20 bg-white">
  <div class="max-w-4xl mx-auto px-6">
    <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-3xl p-8 md:p-12 text-center shadow-soft">
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink mb-4">Siap Memulai Perjalanan Bahasa Jepang Anda?</h2>
      <p class="text-gray-600 mb-8 font-medium text-sm md:text-base max-w-2xl mx-auto">
        Daftar sekarang dan dapatkan konsultasi gratis untuk menemukan program yang tepat sesuai dengan kebutuhan Anda.
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition w-full sm:w-auto">
          Daftar Training Center
        </a>
        <a href="{{ url('kontak') }}" class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition border border-pink-100 w-full sm:w-auto inline-block text-center">
          Hubungi Kami
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Video Modal -->
@if(isset($videos) && $videos->isNotEmpty())
<div id="videoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-lg max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-bold text-gray-900">Video Testimoni</h3>
      <button onclick="closeVideoModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="relative w-full" style="padding-bottom: 56.25%;">
      <video id="modalVideo" class="w-full rounded-lg" controls>
        @if(isset($videos) && $videos->isNotEmpty())
          <source src="{{ $videos->first()->video }}" type="video/mp4">
        @endif
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
