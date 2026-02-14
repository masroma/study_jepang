@extends('layouts.main')

@section('title', $title)

@section('nav-about', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[600px] md:min-h-[550px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Company Profile" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 relative z-10">
    <div class="pt-4 md:pt-10">
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
        <span class="relative inline-block">
          <span class="absolute -left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
          Tentang Kami
        </span>
        <br />
        <span class="text-brand-pink">Company Profile</span>
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
        Profil perusahaan, visi-misi, dan pengalaman kami dalam menghubungkan Indonesia dengan pasar global.
      </p>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<!-- Legalitas Section -->
<section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
  <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10 mb-16">
    <div class="md:w-1/3">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Legalitas<br />Perusahaan</h2>
    </div>
    <div class="md:w-2/3">
      <div class="bg-white rounded-2xl shadow-soft p-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h3 class="text-sm font-semibold text-gray-500 mb-2">Badan Hukum</h3>
            <p class="text-lg font-bold text-gray-900">{{ $legalitas['badan_hukum'] }}</p>
          </div>
          <div>
            <h3 class="text-sm font-semibold text-gray-500 mb-2">Izin Usaha</h3>
            <p class="text-lg font-bold text-gray-900">{{ $legalitas['izin_usaha'] }}</p>
          </div>
          <div>
            <h3 class="text-sm font-semibold text-gray-500 mb-2">NPWP</h3>
            <p class="text-lg font-bold text-gray-900">{{ $legalitas['npwp'] }}</p>
          </div>
          <div>
            <h3 class="text-sm font-semibold text-gray-500 mb-2">Alamat</h3>
            <p class="text-lg font-bold text-gray-900">{{ $legalitas['alamat'] }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Visi Misi Section -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Visi & Misi</h2>
      <p class="text-gray-600 text-sm font-medium">Komitmen kami untuk menjadi mitra terpercaya dalam perdagangan internasional</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
      <!-- Visi -->
      <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-2xl p-8 shadow-soft border border-gray-100">
        <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-6 mx-auto">
          <span class="text-3xl">👁️</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Visi</h3>
        <p class="text-gray-700 leading-relaxed text-center font-medium">{{ $visi_misi['visi'] }}</p>
      </div>

      <!-- Misi -->
      <div class="bg-white rounded-2xl p-8 shadow-soft border border-gray-100">
        <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mb-6 mx-auto">
          <span class="text-3xl">🎯</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Misi</h3>
        <ul class="space-y-4">
          @foreach($visi_misi['misi'] as $misi)
          <li class="flex items-start">
            <span class="text-brand-pink mr-3 mt-1">✓</span>
            <span class="text-gray-700 leading-relaxed">{{ $misi }}</span>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Pengalaman & Partner Section -->
<section class="py-16 md:py-20">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Pengalaman & Partner Negara</h2>
      <p class="text-gray-600 text-sm font-medium">Jaringan global kami yang telah terbukti</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
      <div class="bg-white rounded-2xl p-8 shadow-soft text-center border border-gray-100">
        <div class="text-5xl font-extrabold text-brand-pink mb-2">{{ $pengalaman['tahun_pengalaman'] }}</div>
        <p class="text-gray-600 font-medium">Tahun Pengalaman</p>
      </div>
      <div class="bg-white rounded-2xl p-8 shadow-soft text-center border border-gray-100">
        <div class="text-5xl font-extrabold text-brand-pink mb-2">{{ $pengalaman['jumlah_transaksi'] }}+</div>
        <p class="text-gray-600 font-medium">Transaksi Berhasil</p>
      </div>
      <div class="bg-white rounded-2xl p-8 shadow-soft text-center border border-gray-100">
        <div class="text-5xl font-extrabold text-brand-pink mb-2">{{ count($pengalaman['partner_negara']) }}</div>
        <p class="text-gray-600 font-medium">Partner Negara</p>
      </div>
    </div>

    <!-- Partner Negara -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
      @foreach($pengalaman['partner_negara'] as $partner)
      <div class="bg-white rounded-xl p-6 shadow-soft text-center hover:shadow-xl transition border border-gray-100 hover:border-brand-pink group">
        <div class="w-20 h-20 mx-auto mb-4 rounded-full overflow-hidden border-2 border-gray-200 group-hover:border-brand-pink transition">
          <img src="https://flagcdn.com/w160/{{ $partner['flag'] }}.png" class="w-full h-full object-cover" alt="{{ $partner['nama'] }}" />
        </div>
        <h3 class="font-bold text-gray-900 mb-1">{{ $partner['nama'] }}</h3>
        <p class="text-xs text-gray-500">Sejak {{ $partner['sejak'] }}</p>
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
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink mb-4">Ingin Bekerja Sama dengan Kami?</h2>
      <p class="text-gray-600 mb-8 font-medium text-sm md:text-base max-w-2xl mx-auto">
        Hubungi kami untuk konsultasi dan penawaran terbaik untuk kebutuhan ekspor-impor Anda.
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="{{ url('kontak') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition w-full sm:w-auto">
          Hubungi Kami
        </a>
        <a href="{{ url('product') }}" class="bg-white text-brand-pink px-8 py-3 rounded-full font-bold border-2 border-brand-pink hover:bg-pink-50 transition w-full sm:w-auto">
          Lihat Produk
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
