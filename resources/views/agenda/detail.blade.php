@extends('layouts.main')

@section('title', $read->judul_agenda)

@section('hero')
<header class="relative w-full min-h-[500px] md:min-h-[600px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    @if($read->gambar)
      <img src="{{ asset('assets/upload/image/' . $read->gambar) }}" class="w-full h-full object-cover opacity-60" alt="{{ $title }}" />
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
        {{ $read->judul_agenda }}
      </p>
      <div class="flex items-center space-x-4 text-sm text-gray-600">
        <span>Tanggal: {{ \Carbon\Carbon::parse($read->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($read->tanggal_selesai)->format('d M Y') }}</span>
        <span>Tempat: {{ $read->tempat ?? 'TBD' }}</span>
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

      @if($read->jam_mulai)
      <div class="mt-8">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Detail Acara</h3>
        <div class="bg-gray-50 p-6 rounded-lg">
          <p><strong>Waktu:</strong> {{ $read->jam_mulai }} - {{ $read->jam_selesai }}</p>
          <p><strong>Tempat:</strong> {{ $read->tempat }}</p>
          <p><strong>Penyelenggara:</strong> {{ $read->penyelenggara ?? $site->namaweb }}</p>
        </div>
      </div>
      @endif
    </div>

    <div class="lg:col-span-1">
      <div class="sticky top-8">
        <div class="bg-white rounded-2xl shadow-soft p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Agenda</h3>
          <div class="space-y-3 text-sm">
            <div><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($read->tanggal_mulai)->format('d F Y') }}</div>
            <div><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($read->tanggal_selesai)->format('d F Y') }}</div>
            <div><strong>Tempat:</strong> {{ $read->tempat }}</div>
            @if($read->jam_mulai)
              <div><strong>Jam:</strong> {{ $read->jam_mulai }} - {{ $read->jam_selesai }}</div>
            @endif
            <div><strong>Status:</strong> {{ $read->status_agenda }}</div>
          </div>
        </div>

        <div class="mt-6">
          <a href="{{ url('agenda') }}" class="w-full bg-brand-pink text-white px-6 py-3 rounded-full font-bold text-center block hover:bg-pink-600 transition">
            ← Kembali ke Agenda
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection