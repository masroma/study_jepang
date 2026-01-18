@extends('layouts.main')

@section('title', 'Agenda')

@section('nav-agenda', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[500px] md:min-h-[600px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Agenda" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 relative z-10">
    <div class="max-w-4xl">
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
        Agenda & Event
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base">
        Informasi agenda dan event terkini dari {{ $site->namaweb }}.
      </p>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
    @forelse($agenda as $item)
    <div class="bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden">
      <div class="h-48 overflow-hidden">
        <img src="{{ asset('upload/' . ($item->gambar ?? 'default.jpg')) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
      </div>
      <div class="p-6">
        <h3 class="font-bold text-gray-800 text-lg mb-4 leading-snug">{{ $item->judul_agenda }}</h3>
        <p class="text-xs text-gray-500 font-medium mb-4">{{ Str::limit($item->isi ?? 'Deskripsi agenda', 100) }}</p>
        <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
          <span>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</span>
          <span>{{ $item->tempat ?? 'Lokasi' }}</span>
        </div>
        <a href="{{ url('agenda/detail/' . $item->slug_agenda) }}" class="text-brand-pink font-bold text-sm hover:underline">Lihat Detail →</a>
      </div>
    </div>
    @empty
    <p class="text-center text-gray-500 col-span-full">Belum ada agenda tersedia.</p>
    @endforelse
  </div>
</section>
@endsection