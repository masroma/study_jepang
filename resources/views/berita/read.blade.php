@extends('layouts.main')

@section('title', $title)

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
      <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-12">
        <div class="md:w-2/3">
          <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
            {{ $title }}
          </h1>
          <p class="text-gray-500 mb-6 max-w-2xl leading-relaxed text-sm md:text-base">
            {{ $read->jenis_berita == 'Layanan' ? 'Program pelatihan bahasa Jepang profesional untuk meraih kesuksesan karir Anda' : $read->judul_berita }}
          </p>
          <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
            <span class="flex items-center">
              <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              {{ \Carbon\Carbon::parse($read->tanggal_publish)->format('d M Y') }}
            </span>
            @if($read->jenis_berita)
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                {{ $read->jenis_berita }}
              </span>
            @endif
            @if($read->jenis_berita == 'Layanan')
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Program Training
              </span>
            @endif
          </div>
        </div>
        <div class="md:w-1/3 flex flex-col items-start md:items-end space-y-4">
          @if($read->jenis_berita == 'Layanan')
            <button class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
              </svg>
              Daftar Sekarang
            </button>
            <button class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition flex items-center border border-pink-100">
              <div class="w-6 h-6 rounded-full border-2 border-brand-pink flex items-center justify-center mr-2">
                <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>
              </div>
              Konsultasi Gratis
            </button>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
    <div class="lg:col-span-2">
      <div class="bg-white rounded-2xl shadow-soft p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Deskripsi Program</h2>
        <div class="prose prose-lg max-w-none">
          {!! $read->isi !!}
        </div>
      </div>

      @if($read->jenis_berita == 'Layanan')
      <div class="bg-white rounded-2xl shadow-soft p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Materi Pembelajaran</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-1">Grammar Fundamental</h4>
              <p class="text-sm text-gray-600">Pemahaman dasar grammar Jepang</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-1">Kanji Mastery</h4>
              <p class="text-sm text-gray-600">Belajar karakter kanji sistematis</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-1">Conversation Practice</h4>
              <p class="text-sm text-gray-600">Latihan percakapan harian</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900 mb-1">JLPT Preparation</h4>
              <p class="text-sm text-gray-600">Persiapan ujian JLPT</p>
            </div>
          </div>
        </div>
      </div>
      @endif

      @if($read->keywords)
      <div class="mt-8">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Tags:</h3>
        <div class="flex flex-wrap gap-2">
          @foreach(explode(',', $read->keywords) as $tag)
            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">{{ trim($tag) }}</span>
          @endforeach
        </div>
      </div>
      @endif
    </div>

    <div class="lg:col-span-1">
      <div class="sticky top-8 space-y-6">
        @if($read->jenis_berita == 'Layanan')
        <div class="bg-white rounded-2xl shadow-soft p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Program</h3>
          <div class="space-y-4 text-sm">
            <div class="flex justify-between">
              <span class="text-gray-600">Durasi</span>
              <span class="font-semibold text-gray-900">3 Bulan</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Level</span>
              <span class="font-semibold text-gray-900">{{ $read->jenis_berita ?? 'Beginner' }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Sesi</span>
              <span class="font-semibold text-gray-900">12 Sesi</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Sertifikat</span>
              <span class="font-semibold text-green-600">Tersedia</span>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl shadow-soft p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Jadwal</h3>
          <div class="space-y-3 text-sm">
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div>
                <div class="font-semibold text-gray-900">Senin & Rabu</div>
                <div class="text-gray-600">19:00 - 21:00 WIB</div>
              </div>
            </div>
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                </svg>
              </div>
              <div>
                <div class="font-semibold text-gray-900">Online & Offline</div>
                <div class="text-gray-600">Fleksibel pilih mode</div>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-2xl p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Harga Program</h3>
          <div class="text-3xl font-bold text-brand-pink mb-2">Rp 2.500.000</div>
          <p class="text-sm text-gray-600 mb-4">Cicilan 0% tersedia</p>
          <button class="w-full bg-brand-pink text-white px-6 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition">
            Daftar Sekarang
          </button>
        </div>
        @endif

        <div class="text-center">
          <a href="{{ url('training-center') }}" class="inline-flex items-center text-brand-pink font-bold hover:underline text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Training Center
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@if($read->jenis_berita == 'Layanan')
<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Program Lainnya</h2>
      <p class="text-gray-500 text-sm font-medium">Jelajahi program pelatihan lainnya</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @php
        $related_programs = DB::table('berita')
            ->where('jenis_berita', 'Layanan')
            ->where('status_berita', 'Publish')
            ->where('id_berita', '!=', $read->id_berita)
            ->limit(3)
            ->get();
      @endphp
      @forelse($related_programs as $program)
      <div class="bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer">
        <div class="h-32 overflow-hidden bg-gray-50">
          @if(!empty($program->gambar))
            <img src="{{ asset($program->gambar) }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" />
          @else
            <img src="{{ asset('template/img/program-default.jpg') }}" class="w-full h-full object-contain bg-gray-50" />
          @endif
        </div>
        <div class="p-4">
          <h4 class="font-bold text-gray-800 text-sm mb-2">{{ $program->judul_berita }}</h4>
          <a href="{{ url('berita/read/' . $program->slug_berita) }}" class="text-brand-pink font-bold text-sm hover:underline">
            Pelajari Lebih Lanjut →
          </a>
        </div>
      </div>
      @empty
      <p class="col-span-full text-center text-gray-500">Belum ada program terkait.</p>
      @endforelse
    </div>
  </div>
</section>
@endif
@endsection



