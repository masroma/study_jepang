@php
$waNumber = isset($site_config->telepon) ? preg_replace('/\D+/', '', $site_config->telepon) : '';
$currentRoute = request()->path();
@endphp
<style>
  /* Premium Corporate Text Design */
  .brand-main-text {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    /* font-size: 1.75rem; */
    line-height: 1.1;
    letter-spacing: 0.15em;
    /* color: #1a1a1a; */
    text-transform: uppercase;
    text-shadow: 
      0 1px 0 rgba(255, 255, 255, 0.8),
      0 2px 2px rgba(0, 0, 0, 0.1),
      0 4px 4px rgba(0, 0, 0, 0.05);
    position: relative;
  }
  .brand-sub-text {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    font-size: 0.65rem;
    line-height: 1.2;
    letter-spacing: 0.25em;
    color: #8b6914;
    text-transform: uppercase;
    margin-top: 2px;
    position: relative;
  }
  .brand-sub-text::before,
  .brand-sub-text::after {
    content: '—';
    color: #d4af37;
    margin: 0 8px;
    font-weight: 300;
  }
  @media (min-width: 768px) {
    .brand-main-text {
      font-size: 2rem;
    }
    .brand-sub-text {
      font-size: 0.75rem;
    }
  }
</style>
<nav class="absolute top-0 left-0 w-full z-50 pt-4 px-4 md:pt-6 md:px-12">
  <div class="flex justify-between items-center max-w-7xl mx-auto">
    <div class="flex items-center space-x-3">
      <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
        <img src="{{ asset('template/img/logo.png') }}" alt="Logo" class="h-9 md:h-11 w-auto transition-transform group-hover:scale-105 drop-shadow-sm">
        <div class="hidden md:flex flex-col items-start justify-center">
          <span class="text-xl text-gray-900">MEGHANTARA</span>
          <span class="text-sm font-medium text-gray-500">GLOBAL GROUP</span>
        </div>
      </a>
    </div>

    <div class="hidden md:flex items-center space-x-6 text-sm font-medium text-gray-600 bg-white/60 backdrop-blur-sm px-6 py-2 rounded-full shadow-sm">
      <a href="{{ url('/') }}" class="{{ $currentRoute == '/' ? 'text-brand-pink font-semibold' : 'hover:text-brand-pink transition' }}">Home</a>
      <a href="{{ url('training-center') }}" class="{{ $currentRoute == 'training-center' ? 'text-brand-pink font-semibold' : 'hover:text-brand-pink transition' }}">Training Center</a>
      <a href="{{ url('kisah-sukses') }}" class="{{ $currentRoute == 'kisah-sukses' ? 'text-brand-pink font-semibold' : 'hover:text-brand-pink transition' }}">Kisah Sukses</a>
      <a href="{{ url('berita') }}" class="{{ strpos($currentRoute, 'berita') !== false ? 'text-brand-pink font-semibold' : 'hover:text-brand-pink transition' }}">Blog</a>
      <a href="{{ url('loker') }}" class="{{ strpos($currentRoute, 'loker') !== false ? 'text-brand-pink font-semibold' : 'hover:text-brand-pink transition' }}">Lowongan Kerja</a>
      <a href="{{ url('kontak') }}" class="{{ $currentRoute == 'kontak' ? 'text-brand-pink font-semibold' : 'hover:text-brand-pink transition' }}">Kontak Kami</a>
    </div>

    <div class="flex items-center space-x-2 md:space-x-3">
      <div class="hidden sm:flex items-center space-x-1 bg-white px-2 py-1 rounded-full shadow-sm">
        <img src="https://flagcdn.com/w40/id.png" class="w-5 h-auto rounded-sm" alt="ID" />
        <span class="text-xs font-bold text-gray-500">ID</span>
        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
      </div>

      <a href="{{ url('login') }}" class="text-sm font-bold text-gray-600 hover:text-brand-pink px-2 md:px-3">Masuk</a>
      <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-4 py-2 md:px-5 md:py-2 rounded-full text-xs md:text-sm font-bold shadow-lg hover:bg-pink-600 transition">Daftar</a>
    </div>
  </div>
</nav>
