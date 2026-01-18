@extends('layouts.main')

@section('title', 'Kisah Sukses - StudyAbroad')

@section('nav-kisah-sukses', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[600px] md:min-h-[650px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Kisah Sukses" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 relative z-10">
    <div class="max-w-3xl pt-4 md:pt-10">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
        <span class="text-brand-pink">Kisah Sukses</span><br />
        Alumni Kami di<br />
        Jepang
      </h1>
      <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
        Inspirasi dari mereka yang telah meraih kesuksesan di Jepang. Dari nol hingga bekerja di perusahaan terbaik, berikut adalah kisah perjalanan mereka bersama StudyAbroad.
      </p>
      <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
        <button class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
          Daftar Sekarang <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </button>
        <button class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition flex items-center justify-center w-full sm:w-auto border border-pink-100 sm:border-transparent">
          <div class="w-8 h-8 rounded-full border-2 border-brand-pink flex items-center justify-center mr-2">
            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" /></svg>
          </div>
          Lihat Video Testimoni
        </button>
      </div>
    </div>
  </div>

  <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>
@endsection

@section('content')
<section class="py-16 md:py-20 max-w-7xl mx-auto px-6">
  <div class="flex flex-col md:flex-row items-start justify-between gap-8 md:gap-10">
    <div class="md:w-1/3">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">Inspirasi<br />Kesuksesan</h2>
    </div>
    <div class="md:w-2/3">
      <p class="text-gray-500 leading-relaxed mb-6 font-medium text-sm md:text-base">
        Lebih dari 1,200+ alumni telah berhasil meraih impian mereka bekerja di Jepang. Dari berbagai latar belakang dan profesi, mereka membuktikan bahwa dengan dedikasi, pelatihan yang tepat, dan dukungan yang kuat, kesuksesan di Jepang bukanlah hal yang mustahil.
      </p>
      <button class="bg-brand-yellow text-gray-900 px-8 py-3 rounded-full font-bold text-sm shadow-md hover:bg-yellow-300 transition flex items-center inline-flex">Pelajari Lebih Lanjut <span class="ml-2">></span></button>
    </div>
  </div>
</section>

<section class="py-16">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Kisah Sukses Alumni</h2>
      <p class="text-gray-500 text-sm font-medium">Perjalanan mereka dari Indonesia hingga sukses bekerja di Jepang.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
      @forelse($kisah_sukses as $kisah)
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col">
        <div class="w-full relative">
          <div class="absolute inset-0 bg-orange-500 mix-blend-multiply opacity-20 z-10"></div>
          @if($kisah->foto)
            <img src="{{ asset('uploads/kisah-sukses/'.$kisah->foto) }}" class="w-full h-64 object-cover" />
          @else
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80" class="w-full h-64 object-cover" />
          @endif
        </div>
        <div class="p-8 flex flex-col justify-center">
          <div class="flex text-yellow-400 mb-4 text-sm">{{ str_repeat('★', $kisah->rating) }}{{ str_repeat('☆', 5-$kisah->rating) }}</div>
          <p class="text-gray-600 mb-6 italic leading-relaxed text-sm">"{{ $kisah->testimoni }}"</p>
          <div class="mb-4">
            <h4 class="font-bold text-gray-900 text-lg">{{ $kisah->nama }}</h4>
            <p class="text-xs text-brand-pink font-semibold uppercase tracking-wide mb-2">{{ $kisah->pekerjaan }}, {{ $kisah->lokasi }}</p>
            <div class="flex flex-wrap gap-2 mt-3">
              @if($kisah->program)
                <span class="text-xs bg-pink-50 text-brand-pink px-3 py-1 rounded-full font-medium">{{ $kisah->program }}</span>
              @endif
              @if($kisah->tahun)
                <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-medium">{{ $kisah->tahun }}</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      @empty
      <!-- Default data jika belum ada di database -->
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col">
        <div class="w-full relative">
          <div class="absolute inset-0 bg-orange-500 mix-blend-multiply opacity-20 z-10"></div>
          <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80" class="w-full h-64 object-cover" />
        </div>
        <div class="p-8 flex flex-col justify-center">
          <div class="flex text-yellow-400 mb-4 text-sm">★★★★★</div>
          <p class="text-gray-600 mb-6 italic leading-relaxed text-sm">"Saya sangat terbantu dengan program ini. Mentornya sabar membimbing dari nol sampai saya bisa N3 dalam 6 bulan. Sekarang saya bekerja sebagai Engineering Staff di Nagoya dan sangat menikmati kehidupan di Jepang."</p>
          <div class="mb-4">
            <h4 class="font-bold text-gray-900 text-lg">Anisa Rahmawati</h4>
            <p class="text-xs text-brand-pink font-semibold uppercase tracking-wide mb-2">Engineering Staff, Nagoya</p>
            <div class="flex flex-wrap gap-2 mt-3">
              <span class="text-xs bg-pink-50 text-brand-pink px-3 py-1 rounded-full font-medium">JLPT N3</span>
              <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-medium">2023</span>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col">
        <div class="w-full relative">
          <div class="absolute inset-0 bg-blue-500 mix-blend-multiply opacity-20 z-10"></div>
          <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=500&q=80" class="w-full h-64 object-cover" />
        </div>
        <div class="p-8 flex flex-col justify-center">
          <div class="flex text-yellow-400 mb-4 text-sm">★★★★★</div>
          <p class="text-gray-600 mb-6 italic leading-relaxed text-sm">"Program Tokutei Ginou sangat membantu saya. Setelah pelatihan intensif selama 6 bulan, saya berhasil bekerja di perusahaan konstruksi di Tokyo. Gaji dan lingkungan kerja sangat baik, dan saya belajar banyak hal baru setiap hari."</p>
          <div class="mb-4">
            <h4 class="font-bold text-gray-900 text-lg">Budi Santoso</h4>
            <p class="text-xs text-brand-pink font-semibold uppercase tracking-wide mb-2">Construction Worker, Tokyo</p>
            <div class="flex flex-wrap gap-2 mt-3">
              <span class="text-xs bg-pink-50 text-brand-pink px-3 py-1 rounded-full font-medium">Tokutei Ginou</span>
              <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-medium">2022</span>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col">
        <div class="w-full relative">
          <div class="absolute inset-0 bg-green-500 mix-blend-multiply opacity-20 z-10"></div>
          <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=500&q=80" class="w-full h-64 object-cover" />
        </div>
        <div class="p-8 flex flex-col justify-center">
          <div class="flex text-yellow-400 mb-4 text-sm">★★★★★</div>
          <p class="text-gray-600 mb-6 italic leading-relaxed text-sm">"Sebagai caregiver, saya sangat senang bisa membantu lansia di Jepang. Program pelatihan bahasa dan keterampilan yang diberikan sangat lengkap. Sekarang saya sudah 2 tahun bekerja dan sangat puas dengan kehidupan di sini."</p>
          <div class="mb-4">
            <h4 class="font-bold text-gray-900 text-lg">Sari Indah</h4>
            <p class="text-xs text-brand-pink font-semibold uppercase tracking-wide mb-2">Caregiver, Osaka</p>
            <div class="flex flex-wrap gap-2 mt-3">
              <span class="text-xs bg-pink-50 text-brand-pink px-3 py-1 rounded-full font-medium">Caregiver</span>
              <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-medium">2022</span>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col">
        <div class="w-full relative">
          <div class="absolute inset-0 bg-purple-500 mix-blend-multiply opacity-20 z-10"></div>
          <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=500&q=80" class="w-full h-64 object-cover" />
        </div>
        <div class="p-8 flex flex-col justify-center">
          <div class="flex text-yellow-400 mb-4 text-sm">★★★★★</div>
          <p class="text-gray-600 mb-6 italic leading-relaxed text-sm">"Setelah lulus program magang, saya langsung diterima bekerja di pabrik manufaktur di Kyoto. Pengalaman magang sangat membantu adaptasi saya. Sekarang saya sudah naik jabatan dan gaji pun meningkat signifikan."</p>
          <div class="mb-4">
            <h4 class="font-bold text-gray-900 text-lg">Ahmad Fauzi</h4>
            <p class="text-xs text-brand-pink font-semibold uppercase tracking-wide mb-2">Manufacturing Staff, Kyoto</p>
            <div class="flex flex-wrap gap-2 mt-3">
              <span class="text-xs bg-pink-50 text-brand-pink px-3 py-1 rounded-full font-medium">Internship</span>
              <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-medium">2023</span>
            </div>
          </div>
        </div>
      </div>
      @endforelse
    </div>

    <div class="text-center">
      <button class="bg-brand-yellow text-gray-900 px-10 py-3 rounded-full font-bold text-sm shadow-md hover:bg-yellow-300 transition inline-flex items-center">Lihat Lebih Banyak Kisah <span class="ml-2">></span></button>
    </div>
  </div>
</section>

<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">Statistik Kesuksesan</h2>
      <p class="text-gray-500 text-sm font-medium">Bukti nyata kesuksesan program kami.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
      <div class="bg-white rounded-2xl shadow-soft p-8 text-center hover:shadow-xl transition">
        <div class="text-4xl md:text-5xl font-extrabold text-brand-pink mb-2">1,200+</div>
        <h3 class="font-bold text-gray-800 mb-2">Alumni Sukses</h3>
        <p class="text-xs text-gray-500 font-medium">Siswa yang telah bekerja di Jepang</p>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-8 text-center hover:shadow-xl transition">
        <div class="text-4xl md:text-5xl font-extrabold text-brand-pink mb-2">95%</div>
        <h3 class="font-bold text-gray-800 mb-2">Tingkat Kelulusan</h3>
        <p class="text-xs text-gray-500 font-medium">Siswa yang lulus JLPT</p>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-8 text-center hover:shadow-xl transition">
        <div class="text-4xl md:text-5xl font-extrabold text-brand-pink mb-2">50+</div>
        <h3 class="font-bold text-gray-800 mb-2">Perusahaan Mitra</h3>
        <p class="text-xs text-gray-500 font-medium">Perusahaan terpercaya di Jepang</p>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-8 text-center hover:shadow-xl transition">
        <div class="text-4xl md:text-5xl font-extrabold text-brand-pink mb-2">10+</div>
        <h3 class="font-bold text-gray-800 mb-2">Tahun Pengalaman</h3>
        <p class="text-xs text-gray-500 font-medium">Membantu siswa meraih impian</p>
      </div>
    </div>
  </div>
</section>

<section class="py-16 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-bold text-brand-pink text-center mb-16">Perjalanan Menuju Kesuksesan</h2>

    <div class="flex flex-col md:flex-row justify-between items-start text-center relative px-4">
      <div class="hidden md:block absolute top-10 left-0 w-full h-[2px] bg-gray-100 -z-0"></div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">📚</span>
        </div>
        <h4 class="font-bold text-gray-800 mb-2">1. Pelatihan Bahasa</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Belajar bahasa Jepang intensif hingga mencapai level yang dibutuhkan.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">🎯</span>
        </div>
        <h4 class="font-bold text-gray-800 mb-2">2. Persiapan Kerja</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Pelatihan keterampilan dan persiapan interview untuk pekerjaan.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">✈️</span>
        </div>
        <h4 class="font-bold text-gray-800 mb-2">3. Berangkat ke Jepang</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Visa turun dan memulai perjalanan baru di Jepang.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10">
        <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">🏆</span>
        </div>
        <h4 class="font-bold text-gray-800 mb-2">4. Meraih Kesuksesan</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Bekerja dan berkembang di perusahaan terbaik di Jepang.</p>
      </div>
    </div>

    <div class="text-center mt-12">
      <button class="bg-brand-yellow text-gray-900 px-10 py-3 rounded-full font-bold text-sm shadow-md hover:bg-yellow-300 transition">Mulai Perjalanan Anda ></button>
    </div>
  </div>
</section>

<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center mb-12">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink">Video Testimoni</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
      @forelse($kisah_sukses->take(3) as $kisah)
        @if($kisah->video_url || $kisah->video_file)
        <div class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer" 
             @if($kisah->video_url) 
               onclick="window.open('{{ $kisah->video_url }}', '_blank')"
             @elseif($kisah->video_file) 
               onclick="window.open('{{ asset('uploads/kisah-sukses/videos/'.$kisah->video_file) }}', '_blank')"
             @endif
        >
          <div class="h-48 relative overflow-hidden">
            @if($kisah->foto)
              <img src="{{ asset('uploads/kisah-sukses/'.$kisah->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @else
              <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @endif
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
              <div class="w-16 h-16 rounded-full bg-white/90 flex items-center justify-center">
                <svg class="w-8 h-8 text-brand-pink ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" /></svg>
              </div>
            </div>
          </div>
          <div class="p-6">
            <h3 class="font-bold text-gray-800 mb-2">{{ $kisah->nama }}</h3>
            <p class="text-xs text-gray-500 font-medium">{{ $kisah->pekerjaan }}, {{ $kisah->lokasi }}</p>
            @if($kisah->video_url)
              <p class="text-xs text-blue-500 mt-2"><i class="fas fa-external-link-alt"></i> YouTube Video</p>
            @endif
            @if($kisah->video_file)
              <p class="text-xs text-green-500 mt-2"><i class="fas fa-video"></i> Video File</p>
            @endif
          </div>
        </div>
        @endif
      @empty
      <!-- Default data jika belum ada video di database -->
      <div class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer">
        <div class="h-48 relative overflow-hidden">
          <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
          <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
            <div class="w-16 h-16 rounded-full bg-white/90 flex items-center justify-center">
              <svg class="w-8 h-8 text-brand-pink ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" /></svg>
            </div>
          </div>
        </div>
        <div class="p-6">
          <h3 class="font-bold text-gray-800 mb-2">Anisa Rahmawati</h3>
          <p class="text-xs text-gray-500 font-medium">Engineering Staff, Nagoya</p>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</section>

@endsection