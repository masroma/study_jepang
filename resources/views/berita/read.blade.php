@extends('layouts.main')

@section('title', $title)

@section('hero')
<header class="relative w-full min-h-[500px] md:min-h-[600px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    @if($read->gambar)
      <img src="{{ asset('upload/' . $read->gambar) }}" class="w-full h-full object-cover opacity-60" alt="{{ $title }}" />
    @else
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="{{ $title }}" />
    @endif
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 relative z-10">
    <div class="max-w-4xl">
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
        {{ $title }}
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base">
        {{ $read->judul_berita }}
      </p>
      <div class="flex items-center space-x-4 text-sm text-gray-600">
        <span>Dipublikasikan: {{ \Carbon\Carbon::parse($read->tanggal_publish)->format('d M Y') }}</span>
        @if($read->nama_kategori)
          <span>Kategori: {{ $read->nama_kategori }}</span>
        @endif
        @if($read->nama)
          <span>Oleh: {{ $read->nama }}</span>
        @endif
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
      <article class="prose prose-lg max-w-none">
        {!! $read->isi !!}
      </article>

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
      <div class="sticky top-8">
        <div class="bg-white rounded-2xl shadow-soft p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi</h3>
          <div class="space-y-3 text-sm">
            <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($read->tanggal_publish)->format('d F Y') }}</div>
            @if($read->nama_kategori)
              <div><strong>Kategori:</strong> {{ $read->nama_kategori }}</div>
            @endif
            @if($read->nama)
              <div><strong>Penulis:</strong> {{ $read->nama }}</div>
            @endif
            @if($read->status_berita)
              <div><strong>Status:</strong> {{ $read->status_berita }}</div>
            @endif
          </div>
        </div>

        <div class="mt-6">
          <a href="{{ url('berita') }}" class="w-full bg-brand-pink text-white px-6 py-3 rounded-full font-bold text-center block hover:bg-pink-600 transition">
            ← Kembali ke Berita
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection



