<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $title }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ["Poppins", "sans-serif"] },
          colors: {
            "brand-pink": "#FF2E93",
            "brand-yellow": "#FFDE00",
            "brand-blue": "#E0F2FE",
          },
          boxShadow: { soft: "0 10px 40px -10px rgba(0,0,0,0.08)" },
        },
      },
    };
  </script>
  <style>
    .hero-bg { background: linear-gradient(100deg, #eff6ff 0%, #dbeafe 50%, #bfdbfe 100%); }
  </style>
</head>
<body class="font-sans text-gray-700 overflow-x-hidden">
  @include('partials.navbar', ['site_config' => $site_config])

  <header class="relative w-full min-h-[400px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
      @if($loker->gambar)
      <img src="{{ asset('assets/upload/image/loker/'.$loker->gambar) }}" class="w-full h-full object-cover opacity-40" alt="{{ $loker->judul_loker }}" />
      @else
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Lowongan Kerja" />
      @endif
      <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
    </div>
    <div class="container max-w-7xl mx-auto px-6 relative z-10">
      <div class="max-w-3xl pt-4 md:pt-10">
        <a href="{{ asset('loker') }}" class="text-brand-pink hover:underline mb-4 inline-flex items-center">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
          Kembali ke Daftar Lowongan
        </a>
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <div class="flex items-center gap-2 mb-4">
          @if($loker->status_loker == 'Publish')
          <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Buka</span>
          @elseif($loker->status_loker == 'Tutup')
          <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">Tutup</span>
          @endif
          @if($loker->tipe_kerja)
          <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $loker->tipe_kerja }}</span>
          @endif
        </div>
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight text-gray-900 mb-4">
          {{ $loker->judul_loker }}
        </h1>
        <p class="text-brand-pink font-bold text-lg mb-2">{{ $loker->posisi }}</p>
        @if($loker->lokasi_kerja)
        <p class="text-gray-600 text-sm mb-4 flex items-center">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          {{ $loker->lokasi_kerja }}
        </p>
        @endif
      </div>
    </div>
    <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
  </header>

  <section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-8">
          <h2 class="text-2xl font-bold text-brand-pink mb-6">Deskripsi Lowongan</h2>
          <div class="prose max-w-none text-gray-700 leading-relaxed">
            {!! nl2br(e($loker->isi_loker)) !!}
          </div>
        </div>

        @if($loker->persyaratan)
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-8">
          <h2 class="text-2xl font-bold text-brand-pink mb-6">Persyaratan</h2>
          <div class="prose max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
            {{ $loker->persyaratan }}
          </div>
        </div>
        @endif

        @if($loker->tanggung_jawab)
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-8">
          <h2 class="text-2xl font-bold text-brand-pink mb-6">Tanggung Jawab</h2>
          <div class="prose max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
            {{ $loker->tanggung_jawab }}
          </div>
        </div>
        @endif
      </div>

      <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-soft p-8 sticky top-24">
          <h2 class="text-2xl font-bold text-brand-pink mb-6">Form Pendaftaran</h2>
          
          @if(session('sukses'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
            <p class="font-bold text-sm">{{ session('sukses') }}</p>
          </div>
          @endif

          @if($loker->status_loker != 'Publish')
          <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6" role="alert">
            <p class="font-bold text-sm">Lowongan ini sedang tidak menerima pendaftaran.</p>
          </div>
          @else
          <form action="{{ asset('loker/proses_pendaftaran') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_loker" value="{{ $loker->id_loker }}">

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                Nama Lengkap <span class="text-red-500">*</span>
              </label>
              <input type="text" name="nama" id="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-pink" value="{{ old('nama') }}" required>
              @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email <span class="text-red-500">*</span>
              </label>
              <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-pink" value="{{ old('email') }}" required>
              @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="telepon">
                Telepon <span class="text-red-500">*</span>
              </label>
              <input type="text" name="telepon" id="telepon" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-pink" value="{{ old('telepon') }}" required>
              @error('telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">
                Alamat
              </label>
              <textarea name="alamat" id="alamat" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-pink">{{ old('alamat') }}</textarea>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="pendidikan_terakhir">
                Pendidikan Terakhir
              </label>
              <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-pink" value="{{ old('pendidikan_terakhir') }}" placeholder="Contoh: S1 Pendidikan Bahasa Jepang">
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="pengalaman">
                Pengalaman
              </label>
              <textarea name="pengalaman" id="pengalaman" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-pink" placeholder="Ceritakan pengalaman Anda mengajar bahasa Jepang">{{ old('pengalaman') }}</textarea>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="cv_file">
                Upload CV / Resume <span class="text-red-500">*</span>
              </label>
              <input type="file" name="cv_file" id="cv_file" accept=".pdf,.doc,.docx" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-pink" required>
              <p class="text-gray-500 text-xs mt-1">Format: PDF, DOC, DOCX (Max: 5MB)</p>
              @error('cv_file')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-6">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="catatan">
                Catatan Tambahan
              </label>
              <textarea name="catatan" id="catatan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-pink" placeholder="Catatan atau informasi tambahan yang ingin disampaikan">{{ old('catatan') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-brand-pink text-white px-6 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition">
              Kirim Pendaftaran
            </button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </section>

  @if(count($loker_lain) > 0)
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Lowongan Lainnya</h2>
        <p class="text-gray-500 text-sm font-medium">Lihat lowongan kerja lainnya yang tersedia</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach($loker_lain as $loker_item)
        <div class="bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden">
          <div class="p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $loker_item->judul_loker }}</h3>
            <p class="text-brand-pink font-semibold text-sm mb-3">{{ $loker_item->posisi }}</p>
            <a href="{{ asset('loker/detail/'.$loker_item->slug_loker) }}" class="text-brand-pink font-bold text-sm hover:underline flex items-center">
              Lihat Detail 
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @include('layout.footer')
</body>
</html>
