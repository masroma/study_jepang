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
        <span class="text-brand-pink">{{ $industri->nama }}</span>
        @if($industri->sub_nama)
        <br /><span class="text-xl sm:text-2xl md:text-3xl font-normal text-gray-600">{{ $industri->sub_nama }}</span>
        @endif
      </h1>
      <p class="text-gray-500 mb-6 max-w-2xl leading-relaxed text-sm sm:text-base font-medium">
        {{ \Illuminate\Support\Str::limit(strip_tags($industri->deskripsi ?? ''), 200) }}
      </p>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-16 sm:h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section class="py-12 sm:py-16 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
      <!-- Main Content -->
      <div class="lg:col-span-2">
        @if($industri->gambar_url)
        <div class="mb-8 rounded-2xl overflow-hidden shadow-xl">
          <img src="{{ $industri->gambar_url }}" alt="{{ $industri->nama }}" class="w-full h-auto object-cover" loading="lazy" />
        </div>
        @endif

        <div class="prose prose-lg max-w-none">
          <div class="text-gray-700 leading-relaxed text-sm sm:text-base">
            {!! nl2br(e($industri->deskripsi ?? 'Deskripsi industri akan segera tersedia.')) !!}
          </div>
        </div>

        <div class="mt-8 sm:mt-12">
          <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold text-sm sm:text-base shadow-lg hover:shadow-pink-500/30 transition inline-flex items-center">
            Daftar Sekarang <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
          </a>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="lg:col-span-1">
        <div class="bg-gray-50 rounded-2xl p-6 sticky top-24">
          <h3 class="font-bold text-gray-800 text-lg mb-6">Industri Lainnya</h3>
          <div class="space-y-4">
            @forelse($related_industries as $related)
            <a href="{{ url('industri/detail/'.$related->id_industri) }}" class="block group">
              <div class="bg-white rounded-xl p-4 hover:shadow-lg transition-all duration-300">
                @if($related->gambar_url)
                <div class="mb-3 rounded-lg overflow-hidden">
                  <img src="{{ $related->gambar_url }}" alt="{{ $related->nama }}" class="w-full h-32 object-cover rounded-full group-hover:scale-110 transition duration-500" loading="lazy" />
                </div>
                @endif
                <h4 class="font-bold text-gray-800 text-sm mb-1 group-hover:text-brand-pink transition">{{ $related->nama }}</h4>
                @if($related->sub_nama)
                <p class="text-gray-500 text-xs">{{ $related->sub_nama }}</p>
                @endif
              </div>
            </a>
            @empty
            <p class="text-gray-500 text-sm">Tidak ada industri lainnya.</p>
            @endforelse
          </div>

          <div class="mt-8 pt-8 border-t border-gray-200">
            <a href="{{ url('industri') }}" class="text-brand-pink hover:text-brand-pink/80 font-medium text-sm transition inline-flex items-center">
              Lihat Semua Industri <span class="ml-1">→</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
