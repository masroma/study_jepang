@extends('layouts.main')

@section('title', $title)

@section('nav-home', '')

@section('hero')
<header class="relative w-full min-h-[400px] sm:min-h-[450px] md:min-h-[500px] hero-bg overflow-hidden mt-0 pt-12 sm:pt-16 md:pt-24">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none overflow-hidden">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Background" loading="eager" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/95 sm:via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-4 sm:px-6 relative z-10 py-8 sm:py-12 md:py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
      <div class="max-w-2xl">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-gray-900 mb-4">
          <span class="text-brand-pink">Program Masa Depan</span>
        </h1>
        <p class="text-gray-500 mb-6 max-w-2xl leading-relaxed text-sm sm:text-base font-medium">
          Pilihan program terbaik untuk meraih impian Anda di Jepang. Dari program bahasa hingga skill spesifik, kami menyediakan berbagai pilihan yang sesuai dengan kebutuhan Anda.
        </p>
      </div>
      <div class="hidden md:flex justify-end">
        <img src="{{ asset('maskot/maskot1.png') }}" alt="Maskot Program" class="w-56 lg:w-64 h-auto object-contain drop-shadow-2xl" loading="lazy">
      </div>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-16 sm:h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section class="py-12 sm:py-16 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
      @forelse($programs as $program)
      <a href="{{ url('program/detail/'.$program->id_program) }}" class="group bg-white rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer">
        <div class="h-40 sm:h-48 relative overflow-hidden bg-gray-50">
          @if($program->gambar_url)
            <img src="{{ $program->gambar_url }}" alt="{{ $program->judul }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" loading="lazy" />
          @else
            <img src="{{ asset('template/img/program-default.jpg') }}" alt="Default program image" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" loading="lazy" />
          @endif
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
        <div class="p-4 sm:p-6">
          <h3 class="font-bold text-sm sm:text-base text-gray-800 mb-2 group-hover:text-brand-pink transition">{{ $program->judul }}</h3>
          <p class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($program->deskripsi ?? ''), 100) }}</p>
          <div class="flex items-center justify-between">
            @if($program->lokasi)
            <span class="text-xs text-brand-pink font-semibold">{{ $program->lokasi }}</span>
            @endif
            @if($program->durasi)
            <span class="text-xs text-gray-500">{{ $program->durasi }}</span>
            @endif
          </div>
        </div>
      </a>
      @empty
      <div class="col-span-full text-center py-12">
        <p class="text-gray-500">Belum ada program tersedia.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>
@endsection
