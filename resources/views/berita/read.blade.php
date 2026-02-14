@extends('layouts.main')

@section('title', $title)

@section('nav-blog', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[500px] md:min-h-[600px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    @if($read->gambar)
      <img src="{{ asset($read->gambar) }}" class="w-full h-full object-cover opacity-60" alt="{{ $title }}" />
    @else
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="{{ $title }}" />
    @endif
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 relative z-10">
    <div class="max-w-4xl">
      @if($read->jenis_berita == 'Layanan')
      <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-12">
        <div class="md:w-2/3">
          <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
            <span class="relative inline-block">
              <span class="absolute -left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
              {{ $title }}
            </span>
          </h1>
          <p class="text-gray-500 mb-6 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
            Program pelatihan bahasa Jepang profesional untuk meraih kesuksesan karir Anda
          </p>
          <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 font-medium">
            <span class="flex items-center">
              <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              {{ \Carbon\Carbon::parse($read->tanggal_publish)->format('d M Y') }}
            </span>
            @if($read->jenis_berita)
              <span class="flex items-center bg-pink-50 text-brand-pink px-3 py-1 rounded-full font-medium">
                {{ $read->jenis_berita }}
              </span>
            @endif
            <span class="flex items-center">
              <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
              </svg>
              Program Training
            </span>
          </div>
        </div>
        <div class="md:w-1/3 flex flex-col items-start md:items-end space-y-4">
          <button class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
            Daftar Sekarang
          </button>
          <button class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition flex items-center justify-center w-full sm:w-auto border border-pink-100">
            <div class="w-8 h-8 rounded-full border-2 border-brand-pink flex items-center justify-center mr-2">
              <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z" />
              </svg>
            </div>
            Konsultasi Gratis
          </button>
        </div>
      </div>
      @else
      <!-- Hero untuk Artikel Blog -->
      <div>
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
          <span class="relative inline-block">
            <span class="absolute -left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
            {{ $title }}
          </span>
        </h1>
        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6 font-medium">
          <span class="flex items-center">
            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            {{ \Carbon\Carbon::parse($read->tanggal_publish)->format('d M Y') }}
          </span>
          @if($read->jenis_berita)
            <span class="flex items-center bg-pink-50 text-brand-pink px-3 py-1 rounded-full font-medium">
              {{ $read->jenis_berita }}
            </span>
          @endif
        </div>
      </div>
      @endif
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
    <div class="lg:col-span-2">
      @if($read->jenis_berita == 'Layanan')
      <div class="bg-white rounded-2xl shadow-soft p-8 md:p-10 mb-8">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-6 leading-tight">Deskripsi Program</h2>
        <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-headings:font-bold prose-p:text-gray-700 prose-p:leading-relaxed prose-p:text-sm md:prose-p:text-base prose-p:font-medium prose-p:mb-4 prose-a:text-brand-pink prose-a:no-underline hover:prose-a:underline prose-strong:text-gray-900 prose-ul:text-gray-700 prose-ol:text-gray-700 prose-li:text-gray-700 prose-li:leading-relaxed prose-img:rounded-xl prose-img:shadow-md prose-h2:text-2xl prose-h2:font-bold prose-h2:text-gray-900 prose-h2:mb-4 prose-h3:text-xl prose-h3:font-bold prose-h3:text-gray-900 prose-h3:mb-3">
          {!! $read->isi !!}
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-8 md:p-10">
        <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-6 leading-tight">Materi Pembelajaran</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-900 mb-1 text-sm md:text-base">Grammar Fundamental</h4>
              <p class="text-xs md:text-sm text-gray-500 font-medium leading-relaxed">Pemahaman dasar grammar Jepang</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-900 mb-1 text-sm md:text-base">Kanji Mastery</h4>
              <p class="text-xs md:text-sm text-gray-500 font-medium leading-relaxed">Belajar karakter kanji sistematis</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-900 mb-1 text-sm md:text-base">Conversation Practice</h4>
              <p class="text-xs md:text-sm text-gray-500 font-medium leading-relaxed">Latihan percakapan harian</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-900 mb-1 text-sm md:text-base">JLPT Preparation</h4>
              <p class="text-xs md:text-sm text-gray-500 font-medium leading-relaxed">Persiapan ujian JLPT</p>
            </div>
          </div>
        </div>
      </div>
      @else
      <!-- Artikel Blog Biasa -->
      <article class="bg-white rounded-2xl shadow-soft p-8 md:p-10 mb-8">
        @if($read->gambar)
        <div class="mb-8 rounded-xl overflow-hidden">
          <img src="{{ asset($read->gambar) }}" alt="{{ $read->judul_berita }}" class="w-full h-auto object-cover">
        </div>
        @endif
        
        <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-headings:font-bold prose-p:text-gray-700 prose-p:leading-relaxed prose-p:text-sm md:prose-p:text-base prose-p:font-medium prose-p:mb-6 prose-a:text-brand-pink prose-a:no-underline hover:prose-a:underline prose-strong:text-gray-900 prose-strong:font-bold prose-ul:text-gray-700 prose-ol:text-gray-700 prose-li:text-gray-700 prose-li:leading-relaxed prose-li:mb-2 prose-img:rounded-xl prose-img:shadow-md prose-img:my-8 prose-h2:text-2xl prose-h2:font-bold prose-h2:text-gray-900 prose-h2:mb-4 prose-h2:mt-8 prose-h3:text-xl prose-h3:font-bold prose-h3:text-gray-900 prose-h3:mb-3 prose-h3:mt-6 prose-h4:text-lg prose-h4:font-bold prose-h4:text-gray-900 prose-h4:mb-2 prose-blockquote:border-l-4 prose-blockquote:border-brand-pink prose-blockquote:pl-4 prose-blockquote:italic prose-blockquote:text-gray-600">
          {!! $read->isi !!}
        </div>
      </article>

      @if($read->keywords)
      <div class="bg-white rounded-2xl shadow-soft p-6 md:p-8 mb-8">
        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-4">Tags:</h3>
        <div class="flex flex-wrap gap-2">
          @foreach(explode(',', $read->keywords) as $tag)
            <span class="bg-pink-50 text-brand-pink px-4 py-2 rounded-full text-sm font-medium">{{ trim($tag) }}</span>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Artikel Terkait -->
      @php
        $related_articles = DB::table('berita')
            ->where('status_berita', 'Publish')
            ->where('id_berita', '!=', $read->id_berita)
            ->where('jenis_berita', '!=', 'Layanan')
            ->orderBy('tanggal_publish', 'DESC')
            ->limit(3)
            ->get();
      @endphp
      
      @if($related_articles->count() > 0)
      <div class="bg-white rounded-2xl shadow-soft p-8 md:p-10">
        <h3 class="text-2xl md:text-3xl font-bold text-brand-pink mb-6 leading-tight">Artikel Terkait</h3>
        <div class="space-y-6">
          @foreach($related_articles as $article)
          <a href="{{ url('berita/read/' . $article->slug_berita) }}" class="block group hover:bg-gray-50 p-4 rounded-xl transition">
            <div class="flex flex-col md:flex-row gap-4">
              @if($article->gambar)
              <div class="md:w-32 md:flex-shrink-0">
                <img src="{{ asset($article->gambar) }}" alt="{{ $article->judul_berita }}" class="w-full h-24 md:h-20 object-cover rounded-lg">
              </div>
              @endif
              <div class="flex-1">
                <h4 class="font-bold text-gray-900 mb-2 group-hover:text-brand-pink transition line-clamp-2 text-sm md:text-base">{{ $article->judul_berita }}</h4>
                <div class="flex items-center text-xs text-gray-500 font-medium">
                  <span>{{ \Carbon\Carbon::parse($article->tanggal_publish)->format('d M Y') }}</span>
                </div>
              </div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
      @endif
      @endif
    </div>

    <div class="lg:col-span-1">
      <div class="sticky top-8 space-y-6">
        @if($read->jenis_berita == 'Layanan')
        <div class="bg-white rounded-2xl shadow-soft p-6 md:p-8">
          <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-4">Informasi Program</h3>
          <div class="space-y-4 text-sm">
            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-medium">Durasi</span>
              <span class="font-bold text-gray-900">3 Bulan</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-medium">Level</span>
              <span class="font-bold text-gray-900">{{ $read->jenis_berita ?? 'Beginner' }}</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-medium">Sesi</span>
              <span class="font-bold text-gray-900">12 Sesi</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-medium">Sertifikat</span>
              <span class="font-bold text-green-600">Tersedia</span>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow-soft p-6 md:p-8">
          <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-4">Jadwal</h3>
          <div class="space-y-3 text-sm">
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div>
                <div class="font-bold text-gray-900 text-sm md:text-base">Senin & Rabu</div>
                <div class="text-gray-500 font-medium text-xs md:text-sm">19:00 - 21:00 WIB</div>
              </div>
            </div>
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                </svg>
              </div>
              <div>
                <div class="font-bold text-gray-900 text-sm md:text-base">Online & Offline</div>
                <div class="text-gray-500 font-medium text-xs md:text-sm">Fleksibel pilih mode</div>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-2xl p-6 md:p-8">
          <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-4">Harga Program</h3>
          <div class="text-3xl font-bold text-brand-pink mb-2">Rp 2.500.000</div>
          <p class="text-sm text-gray-500 font-medium mb-4">Cicilan 0% tersedia</p>
          <button class="w-full bg-brand-pink text-white px-6 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 hover:bg-pink-600 transition">
            Daftar Sekarang
          </button>
        </div>

        <div class="text-center">
          <a href="{{ url('training-center') }}" class="inline-flex items-center text-brand-pink font-bold hover:underline text-sm font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Training Center
          </a>
        </div>
        @else
        <!-- Sidebar untuk Artikel Blog -->
        <div class="bg-white rounded-2xl shadow-soft p-6 md:p-8">
          <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-4">Share Artikel</h3>
          <div class="flex flex-wrap gap-3">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="flex items-center justify-center w-10 h-10 bg-blue-50 text-blue-600 rounded-full hover:bg-blue-100 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($read->judul_berita) }}" target="_blank" class="flex items-center justify-center w-10 h-10 bg-sky-50 text-sky-600 rounded-full hover:bg-sky-100 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
              </svg>
            </a>
            <a href="https://wa.me/?text={{ urlencode($read->judul_berita . ' ' . url()->current()) }}" target="_blank" class="flex items-center justify-center w-10 h-10 bg-green-50 text-green-600 rounded-full hover:bg-green-100 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
              </svg>
            </a>
          </div>
        </div>

        <div class="text-center">
          <a href="{{ url('berita') }}" class="inline-flex items-center text-brand-pink font-bold hover:underline text-sm font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Blog
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

@if($read->jenis_berita == 'Layanan')
<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Program Lainnya</h2>
      <p class="text-gray-500 text-sm font-medium">Jelajahi program pelatihan lainnya</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @php
        $related_programs = DB::table('berita')
            ->where('jenis_berita', 'Layanan')
            ->where('status_berita', 'Publish')
            ->where('id_berita', '!=', $read->id_berita)
            ->limit(3)
            ->get();
      @endphp
      @forelse($related_programs as $program)
      <div class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer">
        <div class="h-48 relative overflow-hidden bg-gray-50">
          @if(!empty($program->gambar))
            <img src="{{ asset($program->gambar) }}" alt="{{ $program->judul_berita ?? 'Program Image' }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1576091160550-217358c7db81?auto=format&fit=crop&w=500&q=60'" />
          @else
            <img src="{{ asset('template/img/program-default.jpg') }}" alt="Default program image" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" loading="lazy" />
          @endif
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
        <div class="p-6">
          <h4 class="font-bold text-gray-800 mb-2 group-hover:text-brand-pink transition text-sm md:text-base">{{ $program->judul_berita }}</h4>
          <a href="{{ url('berita/read/' . $program->slug_berita) }}" class="text-brand-pink font-bold text-sm hover:underline inline-flex items-center">
            Pelajari Lebih Lanjut 
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </a>
        </div>
      </div>
      @empty
      <p class="col-span-full text-center text-gray-500 font-medium">Belum ada program terkait.</p>
      @endforelse
    </div>
  </div>
</section>
@endif
@endsection



