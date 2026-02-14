@extends('layouts.main')

@section('title', $title)

@section('nav-product', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[600px] md:min-h-[550px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Produk" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 relative z-10">
    <div class="pt-4 md:pt-10">
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
        <span class="relative inline-block">
          <span class="absolute -left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
          Produk & Komoditas
        </span>
        <br />
        <span class="text-brand-pink">Kualitas Terbaik</span>
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
        Produk dan komoditas berkualitas tinggi dengan standar internasional untuk pasar global.
      </p>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<!-- Hasil Pertanian -->
<section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
  <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10 mb-12">
    <div class="md:w-1/3">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Hasil<br />Pertanian</h2>
    </div>
    <div class="md:w-2/3">
      <p class="text-gray-500 leading-relaxed font-medium text-sm md:text-base">
        Produk pertanian premium dari Indonesia dengan kualitas terbaik untuk pasar internasional.
      </p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    @foreach($produk['hasil_pertanian'] as $item)
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden border border-gray-100 hover:shadow-xl transition">
      <div class="h-64 overflow-hidden bg-gray-50">
        <img src="{{ $item['gambar'] }}" class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="{{ $item['nama'] }}" />
      </div>
      <div class="p-6">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $item['nama'] }}</h3>
        
        <div class="mb-6">
          <h4 class="text-sm font-semibold text-gray-500 mb-3">Spesifikasi:</h4>
          <div class="space-y-2">
            @foreach($item['spesifikasi'] as $key => $value)
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600 font-medium">{{ $key }}:</span>
              <span class="text-sm font-bold text-gray-900">{{ $value }}</span>
            </div>
            @endforeach
          </div>
        </div>

        <div class="border-t border-gray-100 pt-4">
          <div class="flex justify-between items-center mb-3">
            <span class="text-sm font-semibold text-gray-500">MOQ:</span>
            <span class="text-sm font-bold text-brand-pink">{{ $item['moq'] }}</span>
          </div>
          <div class="flex justify-between items-center">
            <span class="text-sm font-semibold text-gray-500">Harga:</span>
            <span class="text-sm font-bold text-gray-900">{{ $item['harga'] }}</span>
          </div>
        </div>

        <a href="{{ url('kontak') }}" class="mt-6 block w-full bg-brand-pink text-white text-center px-6 py-3 rounded-full font-bold hover:bg-pink-600 transition shadow-lg">
          Request Quotation
        </a>
      </div>
    </div>
    @endforeach
  </div>
</section>

<!-- Seafood -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10 mb-12">
      <div class="md:w-1/3">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Seafood</h2>
      </div>
      <div class="md:w-2/3">
        <p class="text-gray-500 leading-relaxed font-medium text-sm md:text-base">
          Produk seafood segar dan beku dengan sertifikasi internasional untuk keamanan dan kualitas.
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      @foreach($produk['seafood'] as $item)
      <div class="bg-white rounded-2xl shadow-soft overflow-hidden border border-gray-100 hover:shadow-xl transition">
        <div class="h-64 overflow-hidden bg-gray-50">
          <img src="{{ $item['gambar'] }}" class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="{{ $item['nama'] }}" />
        </div>
        <div class="p-6">
          <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $item['nama'] }}</h3>
          
          <div class="mb-6">
            <h4 class="text-sm font-semibold text-gray-500 mb-3">Spesifikasi:</h4>
            <div class="space-y-2">
              @foreach($item['spesifikasi'] as $key => $value)
              <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600 font-medium">{{ $key }}:</span>
                <span class="text-sm font-bold text-gray-900">{{ $value }}</span>
              </div>
              @endforeach
            </div>
          </div>

          <div class="border-t border-gray-100 pt-4">
            <div class="flex justify-between items-center mb-3">
              <span class="text-sm font-semibold text-gray-500">MOQ:</span>
              <span class="text-sm font-bold text-brand-pink">{{ $item['moq'] }}</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-sm font-semibold text-gray-500">Harga:</span>
              <span class="text-sm font-bold text-gray-900">{{ $item['harga'] }}</span>
            </div>
          </div>

          <a href="{{ url('kontak') }}" class="mt-6 block w-full bg-brand-pink text-white text-center px-6 py-3 rounded-full font-bold hover:bg-pink-600 transition shadow-lg">
            Request Quotation
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Manufaktur -->
<section class="py-16 md:py-20">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10 mb-12">
      <div class="md:w-1/3">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Manufaktur</h2>
      </div>
      <div class="md:w-2/3">
        <p class="text-gray-500 leading-relaxed font-medium text-sm md:text-base">
          Produk manufaktur berkualitas dengan desain modern dan ramah lingkungan.
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      @foreach($produk['manufaktur'] as $item)
      <div class="bg-white rounded-2xl shadow-soft overflow-hidden border border-gray-100 hover:shadow-xl transition">
        <div class="h-64 overflow-hidden bg-gray-50">
          <img src="{{ $item['gambar'] }}" class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="{{ $item['nama'] }}" />
        </div>
        <div class="p-6">
          <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $item['nama'] }}</h3>
          
          <div class="mb-6">
            <h4 class="text-sm font-semibold text-gray-500 mb-3">Spesifikasi:</h4>
            <div class="space-y-2">
              @foreach($item['spesifikasi'] as $key => $value)
              <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600 font-medium">{{ $key }}:</span>
                <span class="text-sm font-bold text-gray-900">{{ $value }}</span>
              </div>
              @endforeach
            </div>
          </div>

          <div class="border-t border-gray-100 pt-4">
            <div class="flex justify-between items-center mb-3">
              <span class="text-sm font-semibold text-gray-500">MOQ:</span>
              <span class="text-sm font-bold text-brand-pink">{{ $item['moq'] }}</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-sm font-semibold text-gray-500">Harga:</span>
              <span class="text-sm font-bold text-gray-900">{{ $item['harga'] }}</span>
            </div>
          </div>

          <a href="{{ url('kontak') }}" class="mt-6 block w-full bg-brand-pink text-white text-center px-6 py-3 rounded-full font-bold hover:bg-pink-600 transition shadow-lg">
            Request Quotation
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-pink-50 to-blue-50">
  <div class="max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-3xl p-8 md:p-12 text-center shadow-soft border border-gray-100">
      <div class="w-8 h-8 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink mb-4">Butuh Informasi Lebih Lanjut?</h2>
      <p class="text-gray-600 mb-8 font-medium text-sm md:text-base max-w-2xl mx-auto">
        Hubungi kami untuk mendapatkan penawaran harga, katalog lengkap, dan konsultasi produk sesuai kebutuhan Anda.
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="{{ url('kontak') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition w-full sm:w-auto">
          Hubungi Kami
        </a>
        <a href="{{ url('service') }}" class="bg-white text-brand-pink px-8 py-3 rounded-full font-bold border-2 border-brand-pink hover:bg-pink-50 transition w-full sm:w-auto">
          Lihat Layanan
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
