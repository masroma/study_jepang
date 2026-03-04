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
        <span class="text-brand-pink">Kisah Sukses</span><br />
        <span class="text-xl sm:text-2xl md:text-3xl font-normal">{{ $kisah->nama }}</span>
      </h1>
      <div class="flex flex-wrap gap-3 mb-6">
        @if($kisah->pekerjaan)
        <span class="bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-semibold text-brand-pink shadow-sm">
          {{ $kisah->pekerjaan }}
        </span>
        @endif
        @if($kisah->lokasi)
        <span class="bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-semibold text-gray-700 shadow-sm">
          📍 {{ $kisah->lokasi }}
        </span>
        @endif
        @if($kisah->program)
        <span class="bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-semibold text-gray-700 shadow-sm">
          {{ $kisah->program }}
        </span>
        @endif
      </div>
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
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
          @if($kisah->foto_url)
          <div class="h-64 sm:h-80 overflow-hidden bg-gray-50">
            <img src="{{ $kisah->foto_url }}" alt="{{ $kisah->nama }}" class="w-full h-full object-contain" loading="lazy" />
          </div>
          @endif
          
          <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-4">
              <div>
                <h2 class="font-bold text-gray-900 text-xl sm:text-2xl mb-2">{{ $kisah->nama }}</h2>
                @if($kisah->pekerjaan)
                <p class="text-brand-pink font-semibold text-sm uppercase tracking-wide">{{ $kisah->pekerjaan }}</p>
                @endif
              </div>
              @if($kisah->rating)
              <div class="flex text-yellow-400 text-lg">
                @for($i = 0; $i < $kisah->rating; $i++)
                  <span>★</span>
                @endfor
                @for($i = $kisah->rating; $i < 5; $i++)
                  <span class="text-gray-300">★</span>
                @endfor
              </div>
              @endif
            </div>

            @if($kisah->lokasi || $kisah->tahun)
            <div class="flex items-center gap-4 mb-6 text-sm text-gray-500">
              @if($kisah->lokasi)
              <span>📍 {{ $kisah->lokasi }}</span>
              @endif
              @if($kisah->tahun)
              <span>📅 {{ $kisah->tahun }}</span>
              @endif
            </div>
            @endif

            <div class="prose prose-lg max-w-none">
              <div class="text-gray-700 leading-relaxed text-sm sm:text-base italic">
                {!! nl2br(e($kisah->testimoni ?? 'Testimoni akan segera tersedia.')) !!}
              </div>
            </div>

            @if($kisah->video_url)
            <div class="mt-6">
              <a href="{{ $kisah->video_url }}" target="_blank" class="inline-flex items-center text-brand-pink hover:text-brand-pink/80 font-medium text-sm transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tonton Video Testimoni
              </a>
            </div>
            @endif
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
          <h3 class="font-bold text-gray-800 text-lg mb-6">Kisah Sukses Lainnya</h3>
          <div class="space-y-4">
            @forelse($related_kisah as $related)
            <a href="{{ url('kisah-sukses/detail/'.$related->id_kisah) }}" class="block group">
              <div class="bg-white rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                @if($related->foto_url)
                <div class="h-32 overflow-hidden bg-gray-50">
                  <img src="{{ $related->foto_url }}" alt="{{ $related->nama }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" loading="lazy" />
                </div>
                @endif
                <div class="p-4">
                  <h4 class="font-bold text-gray-800 text-sm mb-1 group-hover:text-brand-pink transition">{{ $related->nama }}</h4>
                  @if($related->pekerjaan)
                  <p class="text-brand-pink text-xs font-semibold uppercase mb-2">{{ $related->pekerjaan }}</p>
                  @endif
                  <p class="text-gray-500 text-xs line-clamp-2 italic">{{ \Illuminate\Support\Str::limit(strip_tags($related->testimoni ?? ''), 80) }}</p>
                </div>
              </div>
            </a>
            @empty
            <p class="text-gray-500 text-sm">Tidak ada kisah sukses lainnya.</p>
            @endforelse
          </div>

          <div class="mt-8 pt-8 border-t border-gray-200">
            <a href="{{ url('kisah-sukses') }}" class="text-brand-pink hover:text-brand-pink/80 font-medium text-sm transition inline-flex items-center">
              Lihat Semua Kisah Sukses <span class="ml-1">→</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
