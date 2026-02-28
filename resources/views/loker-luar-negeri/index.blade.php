@extends('layouts.main')

@section('title', $title)

@section('hero')
<header class="relative w-full min-h-[600px] md:min-h-[650px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Lowongan Kerja Luar Negeri" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>
  <div class="container max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 md:gap-10 relative z-10 items-center py-4 sm:py-8 md:py-0">
    <div class="pt-0 md:pt-4 order-2 md:order-1">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
        <span class="text-brand-pink">Lowongan Kerja</span><br />
        Luar Negeri<br />
        <span class="text-lg md:text-2xl font-normal">Siap Kami Salurkan</span>
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
        Temukan berbagai kesempatan kerja di luar negeri yang siap kami salurkan. Kami membantu menyalurkan tenaga kerja terpilih ke berbagai negara dengan gaji kompetitif dan benefit lengkap.
      </p>
      <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="#lowongan" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
          Lihat Lowongan <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
      </div>
    </div>

    <div class="hero-person-container relative w-full md:h-full flex items-center justify-center md:justify-end mt-2 sm:mt-4 md:mt-0 order-1 md:order-2 min-h-[200px] sm:min-h-[250px] md:min-h-0">
      <img src="{{ asset('maskot/maskot3.png') }}" alt="Maskot Lowongan Kerja Luar Negeri" class="relative z-10 w-[60%] sm:w-[70%] md:w-[90%] max-w-xs sm:max-w-md md:max-w-none object-contain drop-shadow-2xl" loading="lazy">
    </div>
  </div>
  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section id="lowongan" class="py-16 md:py-20 max-w-7xl mx-auto px-6">
  <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10 mb-12">
    <div class="md:w-1/3">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Kesempatan<br />Kerja Luar Negeri</h2>
    </div>
    <div class="md:w-2/3">
      <p class="text-gray-500 leading-relaxed mb-6 font-medium text-sm md:text-base">
        Kami memiliki jaringan luas dengan berbagai perusahaan di luar negeri. Lowongan kerja yang tersedia di sini adalah kesempatan yang siap kami salurkan untuk tenaga kerja terpilih. Dapatkan gaji kompetitif, benefit lengkap, dan pengalaman bekerja di luar negeri.
      </p>
    </div>
  </div>

  @if(session('sukses'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-8" role="alert">
    <p class="font-bold">{{ session('sukses') }}</p>
  </div>
  @endif

  @if(session('warning'))
  <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-8" role="alert">
    <p class="font-bold">{{ session('warning') }}</p>
  </div>
  @endif

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
    @forelse($loker as $loker_item)
    <div class="bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
      @if($loker_item->gambar)
      <div class="h-48 overflow-hidden">
        <img src="{{ $loker_item->gambar }}" class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="{{ $loker_item->judul_loker }}" onerror="this.src='{{ asset('template/img/image6.png') }}'" />
      </div>
      @else
      <div class="h-48 overflow-hidden bg-gradient-to-br from-brand-pink/10 to-brand-yellow/10 flex items-center justify-center">
        <svg class="w-16 h-16 text-brand-pink/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
      </div>
      @endif
      <div class="p-6">
        <div class="flex items-center gap-2 mb-3">
          @if($loker_item->status_loker == 'Publish')
          <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Buka</span>
          @elseif($loker_item->status_loker == 'Tutup')
          <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">Tutup</span>
          @endif
          @if($loker_item->tipe_kerja)
          <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $loker_item->tipe_kerja }}</span>
          @endif
          <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded">Luar Negeri</span>
        </div>
        <h3 class="font-bold text-gray-800 text-lg mb-2 leading-snug">{{ $loker_item->judul_loker }}</h3>
        <p class="text-brand-pink font-semibold text-sm mb-3">{{ $loker_item->posisi }}</p>
        @if($loker_item->lokasi_kerja)
        <p class="text-gray-500 text-xs mb-3 flex items-center">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          {{ $loker_item->lokasi_kerja }}
        </p>
        @endif
        @if($loker_item->deskripsi_singkat)
        <p class="text-gray-500 text-sm mb-4 leading-relaxed">{{ Str::limit(strip_tags($loker_item->deskripsi_singkat), 100) }}</p>
        @else
        <p class="text-gray-500 text-sm mb-4 leading-relaxed">{{ Str::limit(strip_tags($loker_item->isi_loker), 100) }}</p>
        @endif
        <a href="{{ url('loker-luar-negeri/detail/'.$loker_item->slug_loker) }}" class="text-brand-pink font-bold text-sm hover:underline flex items-center">
          Lihat Detail & Daftar 
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12">
      <p class="text-gray-500">Tidak ada lowongan luar negeri yang tersedia saat ini. Silakan cek kembali nanti.</p>
    </div>
    @endforelse
  </div>
</section>
@endsection
