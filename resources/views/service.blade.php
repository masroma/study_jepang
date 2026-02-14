@extends('layouts.main')

@section('title', $title)

@section('nav-service', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[600px] md:min-h-[550px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Layanan" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 relative z-10">
    <div class="pt-4 md:pt-10">
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
        <span class="relative inline-block">
          <span class="absolute -left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
          Layanan
        </span>
        <br />
        <span class="text-brand-pink">Solusi Lengkap</span>
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
        Layanan ekspor-impor profesional dengan dukungan customs clearance, freight, dan warehousing terintegrasi.
      </p>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<!-- Export Service -->
<section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
  <div class="bg-white rounded-2xl shadow-soft p-8 md:p-12 border border-gray-100 mb-12">
    <div class="flex items-start gap-6">
      <div class="w-20 h-20 bg-gradient-to-br from-brand-pink to-pink-600 rounded-2xl flex items-center justify-center flex-shrink-0">
        <span class="text-4xl">{{ $layanan['export_service']['icon'] }}</span>
      </div>
      <div class="flex-1">
        <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $layanan['export_service']['judul'] }}</h2>
        <p class="text-gray-600 mb-6 font-medium">{{ $layanan['export_service']['deskripsi'] }}</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          @foreach($layanan['export_service']['fitur'] as $fitur)
          <div class="flex items-start">
            <span class="text-brand-pink mr-3 mt-1">✓</span>
            <span class="text-gray-700">{{ $fitur }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Import Service -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="bg-gradient-to-br from-blue-50 to-pink-50 rounded-2xl shadow-soft p-8 md:p-12 border border-gray-100 mb-12">
      <div class="flex items-start gap-6">
        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0">
          <span class="text-4xl">{{ $layanan['import_service']['icon'] }}</span>
        </div>
        <div class="flex-1">
          <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $layanan['import_service']['judul'] }}</h2>
          <p class="text-gray-600 mb-6 font-medium">{{ $layanan['import_service']['deskripsi'] }}</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($layanan['import_service']['fitur'] as $fitur)
            <div class="flex items-start">
              <span class="text-blue-600 mr-3 mt-1">✓</span>
              <span class="text-gray-700">{{ $fitur }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Customs Clearance -->
<section class="py-16 md:py-20">
  <div class="max-w-7xl mx-auto px-6">
    <div class="bg-white rounded-2xl shadow-soft p-8 md:p-12 border border-gray-100 mb-12">
      <div class="flex items-start gap-6">
        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center flex-shrink-0">
          <span class="text-4xl">{{ $layanan['customs_clearance']['icon'] }}</span>
        </div>
        <div class="flex-1">
          <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $layanan['customs_clearance']['judul'] }}</h2>
          <p class="text-gray-600 mb-6 font-medium">{{ $layanan['customs_clearance']['deskripsi'] }}</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($layanan['customs_clearance']['fitur'] as $fitur)
            <div class="flex items-start">
              <span class="text-green-600 mr-3 mt-1">✓</span>
              <span class="text-gray-700">{{ $fitur }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Freight Service -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">{{ $layanan['freight']['judul'] }}</h2>
      <p class="text-gray-600 text-sm font-medium">{{ $layanan['freight']['deskripsi'] }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Sea Freight -->
      <div class="bg-white rounded-2xl shadow-soft p-8 border border-gray-100 hover:shadow-xl transition">
        <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mb-6">
          <span class="text-3xl">🚢</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $layanan['freight']['sea_freight']['judul'] }}</h3>
        <ul class="space-y-3">
          @foreach($layanan['freight']['sea_freight']['fitur'] as $fitur)
          <li class="flex items-start">
            <span class="text-blue-600 mr-3 mt-1">✓</span>
            <span class="text-gray-700">{{ $fitur }}</span>
          </li>
          @endforeach
        </ul>
      </div>

      <!-- Air Freight -->
      <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-2xl shadow-soft p-8 border border-gray-100 hover:shadow-xl transition">
        <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-6">
          <span class="text-3xl">✈️</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $layanan['freight']['air_freight']['judul'] }}</h3>
        <ul class="space-y-3">
          @foreach($layanan['freight']['air_freight']['fitur'] as $fitur)
          <li class="flex items-start">
            <span class="text-brand-pink mr-3 mt-1">✓</span>
            <span class="text-gray-700">{{ $fitur }}</span>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Warehousing -->
<section class="py-16 md:py-20">
  <div class="max-w-7xl mx-auto px-6">
    <div class="bg-white rounded-2xl shadow-soft p-8 md:p-12 border border-gray-100">
      <div class="flex items-start gap-6 mb-8">
        <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center flex-shrink-0">
          <span class="text-4xl">{{ $layanan['warehousing']['icon'] }}</span>
        </div>
        <div class="flex-1">
          <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $layanan['warehousing']['judul'] }}</h2>
          <p class="text-gray-600 mb-6 font-medium">{{ $layanan['warehousing']['deskripsi'] }}</p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        @foreach($layanan['warehousing']['fitur'] as $fitur)
        <div class="flex items-start">
          <span class="text-orange-500 mr-3 mt-1">✓</span>
          <span class="text-gray-700">{{ $fitur }}</span>
        </div>
        @endforeach
      </div>

      <div class="border-t border-gray-100 pt-8">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Lokasi Gudang:</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          @foreach($layanan['warehousing']['lokasi'] as $lokasi)
          <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 text-center">
            <div class="text-2xl mb-2">📍</div>
            <p class="font-bold text-gray-900">{{ $lokasi }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-pink-50 to-blue-50">
  <div class="max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-3xl p-8 md:p-12 text-center shadow-soft border border-gray-100">
      <div class="w-8 h-8 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink mb-4">Butuh Bantuan dengan Layanan Kami?</h2>
      <p class="text-gray-600 mb-8 font-medium text-sm md:text-base max-w-2xl mx-auto">
        Konsultasikan kebutuhan ekspor-impor Anda dengan tim profesional kami. Kami siap membantu dari awal hingga akhir proses.
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="{{ url('kontak') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition w-full sm:w-auto">
          Konsultasi Gratis
        </a>
        <a href="{{ url('product') }}" class="bg-white text-brand-pink px-8 py-3 rounded-full font-bold border-2 border-brand-pink hover:bg-pink-50 transition w-full sm:w-auto">
          Lihat Produk
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
