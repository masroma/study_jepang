@extends('layouts.main')

@php
// Get language from URL parameter or localStorage, default to 'id'
$language = request()->get('lang', 'id');

// Content translations based on language
$translations = [
    'id' => [
        'hero_title' => 'Program Resmi',
        'hero_subtitle' => 'Belajar & Kerja',
        'hero_country' => 'Jepang',
        'hero_description' => 'Raih beasiswa pendidikan dan karier di Jepang dengan mentor yang sudah berpengalaman, jaringan luas, dan sertifikat pelatihan yang terakreditasi.',
        'button_text' => 'Daftar Sekarang',
        'search_category' => 'Kategori',
        'search_level' => 'Jenjang',
        'search_button' => 'Terjemahkan',
        'jepang_title' => 'Jepang Menanti Anda',
        'jepang_subtitle' => 'Temukan berbagai program pelatihan dan kesempatan kerja yang sesuai dengan minat dan bakat Anda.',
        'program_title' => 'Pilihan Program Masa Depan',
        'program_subtitle' => 'Kami menyediakan profesionalitas serta studi gelar atau bahasa.',
        'industri_title' => 'Beberapa Pilihan Industri',
        'industri_subtitle' => 'Kami membantu menempatkan ke berbagai sektor industri pemberi kerja (Perusahaan) yang terpercaya di Jepang.',
        'alur_title' => 'Alur Pendaftaran',
        'kisah_title' => 'Kisah Sukses',
        'kisah_subtitle' => 'Dengarkan langsung pengalaman mereka yang telah sukses berkarir di Jepang.',
        'social_proof' => 'siswa telah bergabung & bekerja'
    ],
    'en' => [
        'hero_title' => 'Official Program',
        'hero_subtitle' => 'Study & Work',
        'hero_country' => 'Japan',
        'hero_description' => 'Achieve scholarships and careers in Japan with experienced mentors, extensive networks, and accredited training certificates.',
        'button_text' => 'Register Now',
        'search_category' => 'Category',
        'search_level' => 'Level',
        'search_button' => 'Translate',
        'jepang_title' => 'Japan is Waiting for You',
        'jepang_subtitle' => 'Find various training programs and job opportunities that match your interests and talents.',
        'program_title' => 'Future Program Options',
        'program_subtitle' => 'We provide professionalism as well as degree or language studies.',
        'industri_title' => 'Various Industry Options',
        'industri_subtitle' => 'We help place you in various industrial sectors (companies) trusted employers in Japan.',
        'alur_title' => 'Registration Process',
        'kisah_title' => 'Success Stories',
        'kisah_subtitle' => 'Listen directly to their experiences who have succeeded in their careers in Japan.',
        'social_proof' => 'students have joined & worked'
    ],
    'jp' => [
        'hero_title' => '公式プログラム',
        'hero_subtitle' => '学習＆仕事',
        'hero_country' => '日本',
        'hero_description' => '経験豊富なメンター、広範なネットワーク、認定されたトレーニング証明書で日本の奨学金とキャリアを達成してください。',
        'button_text' => '今すぐ登録',
        'search_category' => 'カテゴリ',
        'search_level' => 'レベル',
        'search_button' => '翻訳',
        'jepang_title' => '日本があなたを待っています',
        'jepang_subtitle' => '興味や才能に合った様々な研修プログラムや仕事の機会を見つけてください。',
        'program_title' => '将来のプログラムオプション',
        'program_subtitle' => '私たちは、専門性だけでなく、学位や語学の勉強も提供します。',
        'industri_title' => '様々な業界オプション',
        'industri_subtitle' => '私たちは、日本の信頼できる雇用主である様々な業界（企業）への配置を支援します。',
        'alur_title' => '登録プロセス',
        'kisah_title' => '成功事例',
        'kisah_subtitle' => '日本でのキャリアに成功した彼らの経験を直接聞いてください。',
        'social_proof' => '学生が参加し、働いています'
    ]
];

$content = $translations[$language] ?? $translations['id'];
@endphp

@section('title', 'StudyAbroad - ' . $content['hero_subtitle'] . ' di ' . $content['hero_country'])

@section('nav-home', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[800px] md:min-h-[750px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Latar Belakang Jepang" />
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
  </div>

  <div class="container max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10 items-center">
    <div class="pt-4 md:pt-10">
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-2">
        <span class="relative inline-block">
          <span class="absolute -left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
          {{ $content['hero_title'] }}
        </span>
        <br />
        <span class="text-brand-pink">{{ $content['hero_subtitle'] }}</span> di <br />
        {{ $content['hero_country'] }} <span class="inline-block w-8 h-8 align-middle ml-2 shadow-sm rounded-full overflow-hidden border border-gray-200"><img src="https://flagcdn.com/w80/jp.png" class="w-full h-full object-cover" /></span>
      </h1>

      <div class="bg-white p-6 rounded-2xl md:rounded-full shadow-soft max-w-lg mt-8 mb-6 border border-gray-100">
        <div class="grid grid-cols-3 gap-4 md:gap-6">
          <div class="text-center group cursor-pointer transition-all duration-300 hover:scale-105">
            <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-green-500/25 transition-all duration-300">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
            </div>
            <span class="text-xs font-bold text-gray-700 block">{{ $language == 'en' ? 'Safe' : ($language == 'jp' ? '安全' : 'Aman') }}</span>
            <span class="text-xs text-gray-500 mt-1 block">{{ $language == 'en' ? 'Guaranteed' : ($language == 'jp' ? '保証' : 'Terjamin') }}</span>
          </div>
          <div class="text-center group cursor-pointer transition-all duration-300 hover:scale-105">
            <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-blue-500/25 transition-all duration-300">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
              </svg>
            </div>
            <span class="text-xs font-bold text-gray-700 block">{{ $language == 'en' ? 'Trusted' : ($language == 'jp' ? '信頼' : 'Terpercaya') }}</span>
            <span class="text-xs text-gray-500 mt-1 block">{{ $language == 'en' ? '1000+ Users' : ($language == 'jp' ? '1000+ユーザー' : '1000+ Pengguna') }}</span>
          </div>
          <div class="text-center group cursor-pointer transition-all duration-300 hover:scale-105">
            <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-purple-500/25 transition-all duration-300">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
            </div>
            <span class="text-xs font-bold text-gray-700 block">{{ $language == 'en' ? 'Legal' : ($language == 'jp' ? '合法' : 'Legal') }}</span>
            <span class="text-xs text-gray-500 mt-1 block">{{ $language == 'en' ? 'Official' : ($language == 'jp' ? '公式' : 'Resmi') }}</span>
          </div>
        </div>
      </div>

      <p class="text-gray-500 mb-8 max-w-md leading-relaxed text-sm font-medium">{{ $content['hero_description'] }}</p>

      <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
        <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
          {{ $content['button_text'] }} <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
        <button onclick="openVideoModal('{{ $videos->first()->video ?? '#' }}')" class="text-brand-pink font-bold px-6 py-3 rounded-full hover:bg-pink-50 transition flex items-center justify-center w-full sm:w-auto border border-pink-100 sm:border-transparent">
          <div class="w-8 h-8 rounded-full border-2 border-brand-pink flex items-center justify-center mr-2">
            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" /></svg>
          </div>
          Lihat Video
        </button>
      </div>

      <div class="flex items-center space-x-3">
        <div class="flex -space-x-3">
          <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm" src="https://i.pravatar.cc/100?img=32" alt="" />
          <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm" src="https://i.pravatar.cc/100?img=47" alt="" />
          <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm" src="https://i.pravatar.cc/100?img=12" alt="" />
          <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">+1k</div>
        </div>
        <div class="text-sm">
          <span class="text-brand-pink font-bold text-lg">1,200+</span>
          <p class="text-xs text-gray-500 font-medium">{{ $content['social_proof'] }}</p>
        </div>
      </div>
    </div>

    <div class="relative h-full flex items-end justify-center md:justify-end mt-10 md:mt-0">
      <img src="{{ asset('template/img/image5.png') }}" class="relative z-10 w-[80%] md:w-[90%] object-contain drop-shadow-2xl rounded-b-none mask-image-b" alt="Student" style="mask-image: linear-gradient(to bottom, black 80%, transparent 100%)" />
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
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight">{{ $content['jepang_title'] }}</h2>
    </div>
    <div class="md:w-2/3">
      <p class="text-gray-500 leading-relaxed mb-6 font-medium text-sm md:text-base">{{ $content['jepang_subtitle'] }}</p>
      <button class="bg-brand-yellow text-gray-900 px-8 py-3 rounded-full font-bold text-sm shadow-md hover:bg-yellow-300 transition flex items-center inline-flex">{!! $home_contents['more_button']->content ?? 'Selengkapnya' !!} <span class="ml-2">></span></button>
    </div>
  </div>
</section>

<section class="py-16">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink mb-3">{{ $content['program_title'] }}</h2>
      <p class="text-gray-500 text-sm font-medium">{{ $content['program_subtitle'] }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
      {{-- Debug info --}}
      @php
        $debug_count = isset($program_masa_depan) ? count($program_masa_depan) : 0;
        error_log('DEBUG: Program count = ' . $debug_count);
        if(isset($program_masa_depan) && count($program_masa_depan) > 0) {
          foreach($program_masa_depan as $idx => $prog) {
            error_log('DEBUG: Program ' . $idx . ' - ' . $prog->judul . ' - Image: ' . ($prog->gambar ?? 'NULL'));
          }
        }
      @endphp
      
      @forelse($program_masa_depan as $item)
      <div class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer">
        <div class="h-48 relative overflow-hidden">
          <img src="{{ $item->gambar ?? 'https://images.unsplash.com/photo-1576091160550-217358c7db81?auto=format&fit=crop&w=500&q=60' }}" alt="{{ $item->judul ?? 'Program Image' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://images.unsplash.com/photo-1576091160550-217358c7db81?auto=format&fit=crop&w=500&q=60'" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
        <div class="p-6">
          <h3 class="font-bold text-gray-800 mb-2 group-hover:text-brand-pink transition">{{ $item->judul ?? 'Program Title' }}</h3>
          <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $item->deskripsi ?? 'Program description' }}</p>
          <div class="flex items-center justify-between">
            <span class="text-xs text-brand-pink font-semibold">{{ $item->lokasi ?? 'Location' }}</span>
            <span class="text-xs text-gray-500">{{ $item->durasi ?? 'Duration' }}</span>
          </div>
        </div>
      </div>
      @empty
      <div class="col-span-full text-center py-12">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 max-w-md mx-auto">
          <div class="text-yellow-600 mb-4">
            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-yellow-800 mb-2">Program Sedang Disiapkan</h3>
          <p class="text-yellow-700 text-sm">Program-program terbaik kami sedang dalam persiapan untuk membantu Anda meraih impian di Jepang.</p>
          <h3 class="font-bold text-gray-800 text-lg mb-4 leading-snug">Studi Program Sekolah (Bahasa)</h3>
          <ul class="space-y-3">
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">📍</span> Tokyo, Osaka, Kyoto</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">⏱️</span> Durasi 1-2 Tahun</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">🎓</span> Visa Pelajar</li>
          </ul>
        </div>
      </div>
      <div class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
        </div>
        <div class="p-6">
          <h3 class="font-bold text-gray-800 text-lg mb-4 leading-snug">Tokutei Ginou (Skill Spesifik)</h3>
          <ul class="space-y-3">
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">📍</span> Seluruh Jepang</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">⏱️</span> Kontrak 5 Tahun</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">💴</span> Gaji Standar Jepang</li>
          </ul>
        </div>
      </div>
      <div class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
        </div>
        <div class="p-6">
          <h3 class="font-bold text-gray-800 text-lg mb-4 leading-snug">Internship / Magang</h3>
          <ul class="space-y-3">
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">🏭</span> Industri Manufaktur</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">⏱️</span> Durasi 3 Tahun</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">📜</span> Sertifikat JITCO</li>
          </ul>
        </div>
      </div>
      <div class="group bg-white rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
        </div>
        <div class="p-6">
          <h3 class="font-bold text-gray-800 text-lg mb-4 leading-snug">Kursus Bahasa Jepang</h3>
          <ul class="space-y-3">
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">🏫</span> Online / Offline</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">📚</span> JLPT N5 - N1</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">✅</span> Garansi Lulus</li>
          </ul>
        </div>
      </div>
      @endforelse
    </div>

    <div class="text-center mt-12">
      <button class="bg-brand-yellow text-gray-900 px-10 py-3 rounded-full font-bold text-sm shadow-md hover:bg-yellow-300 transition inline-flex items-center">Lihat Semua Program <span class="ml-2">></span></button>
    </div>
  </div>
</section>

<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12">
      <div class="max-w-xl">
        <h2 class="text-3xl font-bold text-brand-pink mb-4">{{ $content['industri_title'] }}</h2>
        <p class="text-gray-500 font-medium text-sm">{{ $content['industri_subtitle'] }}</p>
      </div>
    </div>

    <div class="flex gap-6 md:gap-8 overflow-x-auto pb-10 justify-start md:justify-between px-4 no-scrollbar">
      @php
        error_log('DEBUG: Industri count = ' . (isset($industri) ? count($industri) : 0));
        if(isset($industri) && count($industri) > 0) {
          foreach($industri as $idx => $ind) {
            error_log('DEBUG: Industri ' . $idx . ' - ' . $ind->nama . ' - Image: ' . ($ind->gambar ?? 'NULL'));
          }
        }
      @endphp
      
      @forelse($industri as $item)
      <div class="group relative w-48 h-48 md:w-56 md:h-56 rounded-full overflow-hidden border-[6px] border-white shadow-xl shrink-0 cursor-pointer transition transform hover:scale-105">
        @if(!empty($item->gambar))
          <img src="{{ $item->gambar }}" alt="{{ $item->nama ?? 'Industry Image' }}" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60'" />
        @else
          <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60" alt="Default industry image" class="w-full h-full object-cover" />
        @endif
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-6">
          <span class="text-white font-bold text-base md:text-lg text-center leading-tight">{{ $item->nama ?? 'Industry Name' }}<br /><span class="text-xs font-normal text-gray-300">{{ $item->sub_nama ?? '' }}</span></span>
        </div>
      </div>
      @empty
      <div class="flex gap-6 md:gap-8 justify-start md:justify-between px-4">
        <div class="group relative w-48 h-48 md:w-56 md:h-56 rounded-full overflow-hidden border-[6px] border-white shadow-xl shrink-0 cursor-pointer transition transform hover:scale-105">
          <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60" alt="Manufacturing" class="w-full h-full object-cover" />
          <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-6">
            <span class="text-white font-bold text-base md:text-lg text-center leading-tight">Manufacturing<br /><span class="text-xs font-normal text-gray-300">Automotive & Electronics</span></span>
          </div>
        </div>
        <div class="group relative w-48 h-48 md:w-56 md:h-56 rounded-full overflow-hidden border-[6px] border-white shadow-xl shrink-0 cursor-pointer transition transform hover:scale-105">
          <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=60" alt="Hospitality" class="w-full h-full object-cover" />
          <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-6">
            <span class="text-white font-bold text-base md:text-lg text-center leading-tight">Hospitality<br /><span class="text-xs font-normal text-gray-300">Hotel & Tourism</span></span>
          </div>
        </div>
        <div class="group relative w-48 h-48 md:w-56 md:h-56 rounded-full overflow-hidden border-[6px] border-white shadow-xl shrink-0 cursor-pointer transition transform hover:scale-105">
          <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=500&q=60" alt="IT & Technology" class="w-full h-full object-cover" />
          <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-6">
            <span class="text-white font-bold text-base md:text-lg text-center leading-tight">IT & Technology<br /><span class="text-xs font-normal text-gray-300">Software & Startup</span></span>
          </div>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</section>

<section class="py-16 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-bold text-brand-pink text-center mb-16">Alur Pendaftaran</h2>

    <div class="flex flex-col md:flex-row justify-between items-start text-center relative px-4">
      <div class="hidden md:block absolute top-10 left-0 w-full h-[2px] bg-gray-100 -z-0"></div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">📄</span>
        </div>
        <h4 class="font-bold text-gray-800 mb-2">1. Konsultasi & Daftar</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Diskusi pilihan program & isi formulir.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">🔍</span>
        </div>
        <h4 class="font-bold text-gray-800 mb-2">2. Seleksi & Interview</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Tes potensi & wawancara user.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">📝</span>
        </div>
        <h4 class="font-bold text-gray-800 mb-2">3. Pelatihan Bahasa</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Belajar intensif 3-6 bulan.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10">
        <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mb-6 shadow-sm ring-8 ring-white">
          <span class="text-2xl">✈️</span>
        </div>
        <h4 class="font-bold text-gray-800 mb-2">4. Terbang ke Jepang</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto">Visa turun & berangkat kerja.</p>
      </div>
    </div>

    <div class="text-center mt-12">
      <a href="{{ url('daftar') }}" class="bg-brand-yellow text-gray-900 px-10 py-3 rounded-full font-bold text-sm shadow-md hover:bg-yellow-300 transition inline-block">Mulai Pendaftaran ></a>
    </div>
  </div>
</section>

<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center mb-12">
      <h2 class="text-2xl md:text-3xl font-bold text-brand-pink">{{ $content['kisah_title'] ?? 'Kisah Sukses' }}</h2>
      <a href="{{ url('kisah-sukses') }}" class="text-brand-pink hover:text-brand-pink/80 font-medium text-sm transition">Lihat Semua →</a>
    </div>

    @php
      error_log('DEBUG: Kisah Sukses count = ' . (isset($kisah_sukses) ? count($kisah_sukses) : 0));
      if(isset($kisah_sukses) && count($kisah_sukses) > 0) {
        foreach($kisah_sukses as $idx => $ks) {
          error_log('DEBUG: Kisah ' . $idx . ' - ' . $ks->nama . ' - Image: ' . ($ks->foto ?? 'NULL'));
        }
      }
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($kisah_sukses as $item)
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 group">
        <div class="relative">
          <div class="aspect-w-16 aspect-h-12 overflow-hidden">
            {{-- Fallback images yang berbeda berdasarkan nama --}}
            @if($item->nama == 'Anisa Rahmawati')
              <img src="https://images.unsplash.com/photo-1494790106753-9e7f7d7f6d6?auto=format&fit=crop&w=500&q=80" alt="Anisa Rahmawati" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @elseif($item->nama == 'Budi Santoso')
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=500&q=80" alt="Budi Santoso" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @elseif($item->nama == 'Siti Nurhaliza')
              <img src="https://images.unsplash.com/photo-1573497019923-4c8c5b0e5cf?auto=format&fit=crop&w=500&q=80" alt="Siti Nurhaliza" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @elseif($item->nama == 'Ahmad Fauzi')
              <img src="https://images.unsplash.com/photo-1592928985038-b273a1c0b85b?auto=format&fit=crop&w=500&q=80" alt="Ahmad Fauzi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @elseif($item->nama == 'Maya Putri')
              <img src="https://images.unsplash.com/photo-1438761681033-6471a4ab5fa5?auto=format&fit=crop&w=500&q=80" alt="Maya Putri" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @else
              <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80" alt="Default testimonial" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
            <div class="flex text-yellow-400 text-xs">
              @for($i = 0; $i < ($item->rating ?? 5); $i++)
                <span class="text-yellow-400">★</span>
              @endfor
              @for($i = ($item->rating ?? 5); $i < 5; $i++)
                <span class="text-gray-300">★</span>
              @endfor
            </div>
          </div>
        </div>
        
        <div class="p-6">
          <div class="flex items-center justify-between mb-3">
            <div>
              <h4 class="font-bold text-gray-900 text-lg">{{ $item->nama ?? 'Nama Alumni' }}</h4>
              <p class="text-xs text-brand-pink font-semibold uppercase tracking-wide">{{ $item->pekerjaan ?? 'Profesi' }}</p>
            </div>
            <div class="text-right">
              <p class="text-xs text-gray-500 font-medium">{{ $item->lokasi ?? 'Lokasi' }}</p>
              <p class="text-xs text-gray-400">{{ $item->tahun ?? date('Y') }}</p>
            </div>
          </div>
          
          <p class="text-gray-600 italic leading-relaxed text-sm mb-4 line-clamp-3">{{ $item->testimoni ?? 'Testimoni alumni' }}</p>
          
          <div class="flex items-center justify-between">
            <span class="text-xs bg-brand-pink/10 text-brand-pink px-2 py-1 rounded-full font-medium">{{ $item->program ?? 'Program' }}</span>
            @if(!empty($item->video_url))
              <button onclick="window.open('{{ $item->video_url }}', '_blank')" class="text-brand-pink hover:text-brand-pink/80 text-xs font-medium transition flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010.905 6.5L3 13.586V16a1 1 0 001 1h6a1 1 0 001-1v-2.414l-3.197-2.132A1 1 0 0013.248 6.5L14.752 11.168z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v-1.236a1 1 0 00-.447-.894l-4.553-2.276A1 1 0 0014 4.618v1.236a1 1 0 00.447.894l4.553 2.276A1 1 0 0016 9.618V8.382a1 1 0 00-.447-.894L11 5.212V3a1 1 0 00-1-1H7a1 1 0 00-1 1v2.212L5.447 7.488A1 1 0 005 8.382v9.236a1 1 0 00.447.894L10 18.788V21a1 1 0 001 1h6a1 1 0 001-1v-2.212l13.553-2.276A1 1 0 0018 17.618v8.236z"></path>
                </svg>
                Video
              </button>
            @endif
          </div>
        </div>
      </div>
      @empty
      <div class="col-span-full text-center py-12">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 max-w-md mx-auto">
          <div class="text-yellow-600 mb-4">
            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-3.397 3.397 3.397 0 00-1.455-1.96 3.397 3.397 0 00-3.189 0H4a3 3 0 00-3 3v2H2"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6.188-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-yellow-800 mb-2">Kisah Sukses Sedang Disiapkan</h3>
          <p class="text-yellow-700 text-sm">Alumni-alumni sukses kami akan segera ditampilkan untuk memberikan inspirasi bagi Anda yang ingin meraih impian di Jepang.</p>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</section>

<!-- Video Modal -->
<div id="videoModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-lg max-w-4xl w-full">
    <div class="flex justify-between items-center p-4 border-b">
      <h3 class="text-lg font-semibold text-gray-900">Video</h3>
      <button onclick="closeVideoModal()" class="text-gray-400 hover:text-gray-600 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="p-4">
      <div id="videoContainer" style="position: relative; padding-bottom: 56.25%; height: 0;">
        <!-- Video akan dimuat di sini -->
      </div>
    </div>
  </div>
</div>

<script>
function openVideoModal(videoUrl) {
  console.log('=== VIDEO MODAL DEBUG ===');
  console.log('1. Original URL:', videoUrl);
  console.log('2. URL type:', typeof videoUrl);
  console.log('3. URL length:', videoUrl ? videoUrl.length : 'null/undefined');
  
  const modal = document.getElementById('videoModal');
  const container = document.getElementById('videoContainer');
  
  if (!modal || !container) {
    console.error('Modal or container not found');
    return;
  }
  
  // Extract video ID from YouTube URL
  let videoId = '';
  
  if (videoUrl && videoUrl.includes('youtube.com/watch?v=')) {
    videoId = videoUrl.split('v=')[1].split('&')[0];
    console.log('4. YouTube watch URL detected, videoId:', videoId);
  } else if (videoUrl && videoUrl.includes('youtu.be/')) {
    videoId = videoUrl.split('youtu.be/')[1].split('?')[0];
    console.log('5. YouTube short URL detected, videoId:', videoId);
  } else {
    console.log('6. No valid YouTube URL pattern detected');
    console.log('7. URL contains youtube.com:', videoUrl ? videoUrl.includes('youtube.com') : 'null');
    console.log('8. URL contains watch?v=', videoUrl ? videoUrl.includes('watch?v=') : 'null');
  }
  
  console.log('9. Final videoId:', videoId);
  
  if (videoId && videoId.length > 0) {
    const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
    console.log('10. Embed URL:', embedUrl);
    
    container.innerHTML = `
      <iframe 
        src="${embedUrl}" 
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen>
      </iframe>
    `;
    
    console.log('11. Iframe inserted successfully');
  } else {
    console.log('12. Invalid video URL - showing error message');
    container.innerHTML = `
      <div class="text-center p-8">
        <p class="text-red-500 font-semibold mb-2">Invalid video URL</p>
        <p class="text-gray-600 text-sm">URL: ${videoUrl || 'undefined'}</p>
        <button onclick="closeVideoModal()" class="mt-4 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">Close</button>
      </div>
    `;
  }
  
  modal.classList.remove('hidden');
  document.body.style.overflow = 'hidden';
  console.log('13. Modal should be visible now');
}

function closeVideoModal() {
  console.log('Closing video modal');
  const modal = document.getElementById('videoModal');
  const container = document.getElementById('videoContainer');
  
  if (modal && container) {
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    container.innerHTML = '';
  }
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('videoModal');
  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === this) {
        closeVideoModal();
      }
    });
  }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeVideoModal();
  }
});
</script>
@endsection