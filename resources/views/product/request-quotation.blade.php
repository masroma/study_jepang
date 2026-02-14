@extends('layouts.main')

@section('title', $title)

@section('nav-product', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[500px] md:min-h-[550px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Request Quotation" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 relative z-10">
    <div class="max-w-3xl pt-4 md:pt-10">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
        <span class="text-brand-pink">Request Quotation</span><br />
        Dapatkan Penawaran Harga<br />
        Terbaik untuk Produk Anda
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
        Isi formulir di bawah ini untuk mendapatkan penawaran harga terbaik. Tim kami akan menghubungi Anda secepatnya dengan informasi lengkap.
      </p>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section class="py-16 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
      <!-- Form Section -->
      <div class="lg:col-span-2">
        <div class="mb-8">
          <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
          <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight mb-4">Form Request Quotation</h2>
          <p class="text-gray-500 font-medium text-sm">Lengkapi informasi di bawah ini untuk mendapatkan penawaran harga terbaik.</p>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6">
          <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="font-semibold">{{ session('success') }}</span>
          </div>
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6">
          <div class="font-semibold mb-2">Terjadi kesalahan:</div>
          <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form class="space-y-6" action="{{ url('produk/request-quotation') }}" method="POST">
          @csrf
          
          <!-- Informasi Pribadi -->
          <div class="bg-gray-50 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Pribadi</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap *</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Masukkan nama lengkap" required />
              </div>
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="nama@email.com" required />
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon *</label>
                <input type="tel" name="telepon" value="{{ old('telepon') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="+62 812 3456 7890" required />
              </div>
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Perusahaan</label>
                <input type="text" name="perusahaan" value="{{ old('perusahaan') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Nama perusahaan (opsional)" />
              </div>
            </div>
          </div>

          <!-- Informasi Produk -->
          <div class="bg-gray-50 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Produk</h3>
            
            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2">Produk yang Diminati *</label>
              <select name="produk" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm bg-white" required>
                <option value="">Pilih produk</option>
                @foreach($all_produk as $produk_item)
                <option value="{{ $produk_item['nama'] }}" {{ (old('produk') == $produk_item['nama'] || ($selected_produk && $selected_produk['nama'] == $produk_item['nama'])) ? 'selected' : '' }}>
                  {{ $produk_item['nama'] }} ({{ $produk_item['kategori'] }})
                </option>
                @endforeach
              </select>
            </div>

            @if($selected_produk)
            <div class="mt-4 p-4 bg-white rounded-xl border border-gray-200">
              <div class="flex items-start gap-4">
                @if(isset($selected_produk['gambar']))
                <img src="{{ $selected_produk['gambar'] }}" alt="{{ $selected_produk['nama'] }}" class="w-20 h-20 object-cover rounded-lg" />
                @endif
                <div class="flex-grow">
                  <h4 class="font-bold text-gray-800 mb-2">{{ $selected_produk['nama'] }}</h4>
                  <p class="text-xs text-brand-pink font-semibold mb-2">{{ $selected_produk['kategori'] }}</p>
                  <p class="text-xs text-gray-600"><strong>MOQ:</strong> {{ $selected_produk['moq'] }}</p>
                </div>
              </div>
            </div>
            @endif

            <div class="mt-6">
              <label class="block text-sm font-bold text-gray-700 mb-2">Quantity / Jumlah yang Dibutuhkan</label>
              <input type="text" name="quantity" value="{{ old('quantity') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Contoh: 1 Container, 1000 kg, dll" />
            </div>

            <div class="mt-6">
              <label class="block text-sm font-bold text-gray-700 mb-2">Kebutuhan Khusus / Spesifikasi</label>
              <textarea name="kebutuhan" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm resize-none" placeholder="Jelaskan kebutuhan khusus atau spesifikasi yang diinginkan...">{{ old('kebutuhan') }}</textarea>
            </div>
          </div>

          <!-- Pesan Tambahan -->
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Pesan Tambahan</label>
            <textarea name="pesan" rows="5" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm resize-none" placeholder="Tulis pesan tambahan jika ada...">{{ old('pesan') }}</textarea>
          </div>

          <button type="submit" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition w-full md:w-auto">
            Kirim Request Quotation <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
          </button>
        </form>
      </div>

      <!-- Info Section -->
      <div>
        <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-2xl p-6 shadow-soft sticky top-24">
          <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
          <h3 class="text-xl font-bold text-brand-pink mb-4">Mengapa Request Quotation?</h3>
          
          <div class="space-y-4 mb-6">
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                <span class="text-lg">✓</span>
              </div>
              <div>
                <h4 class="font-bold text-gray-800 text-sm mb-1">Harga Kompetitif</h4>
                <p class="text-xs text-gray-600">Dapatkan penawaran harga terbaik sesuai kebutuhan Anda</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                <span class="text-lg">✓</span>
              </div>
              <div>
                <h4 class="font-bold text-gray-800 text-sm mb-1">Respon Cepat</h4>
                <p class="text-xs text-gray-600">Tim kami akan merespons dalam 24 jam kerja</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                <span class="text-lg">✓</span>
              </div>
              <div>
                <h4 class="font-bold text-gray-800 text-sm mb-1">Konsultasi Gratis</h4>
                <p class="text-xs text-gray-600">Konsultasi dengan tim ahli untuk solusi terbaik</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                <span class="text-lg">✓</span>
              </div>
              <div>
                <h4 class="font-bold text-gray-800 text-sm mb-1">Kualitas Terjamin</h4>
                <p class="text-xs text-gray-600">Produk dengan standar internasional</p>
              </div>
            </div>
          </div>

          <div class="border-t border-gray-200 pt-6">
            <h4 class="font-bold text-gray-800 mb-3 text-sm">Butuh Bantuan?</h4>
            <p class="text-xs text-gray-600 mb-4">Hubungi kami langsung untuk konsultasi lebih lanjut</p>
            <a href="{{ url('kontak') }}" class="block text-center bg-white text-brand-pink px-4 py-2 rounded-full font-bold border-2 border-brand-pink hover:bg-pink-50 transition text-sm">
              Hubungi Kami
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
