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
    <div class="max-w-4xl">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
      <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-gray-900 mb-4">
        <span class="text-brand-pink">Pilihan Industri</span>
      </h1>
      <p class="text-gray-500 mb-6 max-w-2xl leading-relaxed text-sm sm:text-base font-medium">
        Kami membantu menempatkan Anda ke berbagai sektor industri pemberi kerja (Perusahaan) yang terpercaya di Jepang.
      </p>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-16 sm:h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section class="py-12 sm:py-16 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="flex flex-wrap gap-6 sm:gap-8 justify-center">
      @forelse($industries as $industri)
      <a href="{{ url('industri/detail/'.$industri->id_industri) }}" class="group relative w-40 h-40 sm:w-48 sm:h-48 md:w-56 md:h-56 rounded-full overflow-hidden border-[4px] sm:border-[6px] border-white shadow-xl shrink-0 cursor-pointer transition transform hover:scale-105">
        <img src="{{ $industri->gambar_url ?? 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60' }}" alt="{{ $industri->nama }}" class="w-full h-full object-cover" loading="lazy" />
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-4 sm:pb-6">
          <span class="text-white font-bold text-sm sm:text-base md:text-lg text-center leading-tight px-2">
            {{ $industri->nama }}
            @if($industri->sub_nama)
            <br /><span class="text-xs font-normal text-gray-300">{{ $industri->sub_nama }}</span>
            @endif
          </span>
        </div>
      </a>
      @empty
      <div class="col-span-full text-center py-12">
        <p class="text-gray-500">Belum ada industri tersedia.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>
@endsection
