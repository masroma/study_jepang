@extends('layouts.main')

@php
use Illuminate\Support\Facades\Storage;

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
@php
// Default person images
$defaultPersonImages = [
    'https://i.pravatar.cc/100?img=32',
    'https://i.pravatar.cc/100?img=47',
    'https://i.pravatar.cc/100?img=12'
];

// ============================================
// SLIDER HOMEPAGE: HARUS dari tabel 'hero_sliders'
// ============================================
// Data ini diambil dari controller: $hero_sliders = HeroSlider::publish()->ordered()->get()
// JANGAN menggunakan $slider (dari tabel galeri) karena strukturnya berbeda
// Pastikan controller mengirim $hero_sliders, bukan $slider
$sliders = isset($hero_sliders) && is_object($hero_sliders) && $hero_sliders->count() > 0 
    ? $hero_sliders 
    : collect();
$hasSliders = $sliders->count() > 0;

// If no sliders, create one default slider
if (!$hasSliders) {
    $sliders = collect([(object)[
        'title_id' => $content['hero_title'],
        'title_en' => $translations['en']['hero_title'],
        'title_jp' => $translations['jp']['hero_title'],
        'subtitle_id' => $content['hero_subtitle'],
        'subtitle_en' => $translations['en']['hero_subtitle'],
        'subtitle_jp' => $translations['jp']['hero_subtitle'],
        'country_id' => $content['hero_country'],
        'country_en' => $translations['en']['hero_country'],
        'country_jp' => $translations['jp']['hero_country'],
        'description_id' => $content['hero_description'],
        'description_en' => $translations['en']['hero_description'],
        'description_jp' => $translations['jp']['hero_description'],
        'background_image' => asset('template/img/image6.png'),
        'person_image' => asset('template/img/image5.png'),
        'button_text_id' => $content['button_text'],
        'button_text_en' => $translations['en']['button_text'],
        'button_text_jp' => $translations['jp']['button_text'],
        'button_link' => url('daftar'),
        'video_link' => $videos->first()->video ?? '#',
        'person_images' => $defaultPersonImages
    ]]);
}
@endphp

<header class="relative w-full min-h-[700px] sm:min-h-[750px] md:min-h-[800px] hero-bg overflow-hidden mt-0 pt-12 sm:pt-16 md:pt-96">
  <!-- Hero Slider Container -->
  <div class="hero-slider relative w-full h-full">
    @foreach($sliders as $index => $slide)
    @php
      $title = $slide->{'title_' . $language} ?? $slide->title_id ?? '';
      $subtitle = $slide->{'subtitle_' . $language} ?? $slide->subtitle_id ?? '';
      $country = $slide->{'country_' . $language} ?? $slide->country_id ?? '';
      $description = $slide->{'description_' . $language} ?? $slide->description_id ?? '';
      $buttonText = $slide->{'button_text_' . $language} ?? $slide->button_text_id ?? '';
    
    
      // Ambil gambar dari kolom person_image di database
      // Gunakan Storage untuk mendapatkan URL yang benar dari S3
      $personImage = asset('template/img/image5.png'); // default
      if (!empty($slide->person_image)) {
        // Gunakan Storage untuk mendapatkan URL dari S3
        $personImage = Storage::disk('s3')->url($slide->person_image);
      }
      
      $image = $personImage;
      
      // Ambil background image dengan cara yang sama
      $bgImage = asset('template/img/image6.png'); // default
      if (!empty($slide->background_image)) {
        // Gunakan Storage untuk mendapatkan URL dari S3
        $bgImage = Storage::disk('s3')->url($slide->background_image);
      }

     
     
      // Inisialisasi person_images untuk avatar kecil
      $personImages = $slide->person_images ?? $defaultPersonImages;
      if (is_string($personImages)) {
        $personImages = json_decode($personImages, true) ?? $defaultPersonImages;
      }
      if (empty($personImages) || !is_array($personImages)) {
        $personImages = $defaultPersonImages;
      }
      // Convert paths to URLs for person_images
      if (is_array($personImages) && !empty($personImages)) {
        $personImages = array_map(function($img) {
          // If it's a URL (starts with http), return as is
          if (is_string($img) && (strpos($img, 'http://') === 0 || strpos($img, 'https://') === 0)) {
            return $img;
          }
          // If it's a local path, convert to full URL using Storage
          if (is_string($img) && !empty($img)) {
            return Storage::disk('s3')->url($img);
          }
          return $img;
        }, $personImages);
      }
     
    @endphp
    <div class="hero-slide absolute inset-0 w-full h-full flex items-start md:items-center pt-0 {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-slide="{{ $index }}">
      <!-- Background -->
    
      <div class="absolute inset-0 w-full h-full z-0 pointer-events-none overflow-hidden">
        <img src="{{ $bgImage }}" class="hero-bg-image w-full h-full object-cover opacity-60 transition-all duration-1500 ease-in-out" alt="Background" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" />
        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/95 sm:via-white/90 md:via-white/80 to-transparent hero-gradient-overlay transition-opacity duration-1000"></div>
      </div>

      <!-- Content -->
      <div class="container max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 md:gap-10 relative z-10 items-start md:items-center py-4 sm:py-8 md:py-0">
        <div class="hero-content-text pt-0 md:pt-4 order-2 md:order-1">
          <h1 class="hero-title text-xl sm:text-2xl md:text-4xl font-extrabold leading-tight text-gray-900 mb-2 sm:mb-2">
            <span class="relative inline-block">
              <span class="absolute -left-4 sm:-left-6 top-1/2 transform -translate-y-1/2 w-3 h-3 sm:w-4 sm:h-4 rounded-full bg-red-500 border-2 border-white"></span>
              {{ $title }}
            </span>
            <br />
            <span class="text-lg sm:text-xl md:text-2xl font-normal text-brand-pink">{{ $subtitle }}</span> <span class="inline-block w-6 h-6 sm:w-8 sm:h-8 align-middle ml-1 sm:ml-2 shadow-sm rounded-full overflow-hidden border border-gray-200"><img src="https://flagcdn.com/w80/jp.png" class="w-full h-full object-cover" loading="lazy" /></span>
          </h1>

       

          <p class="hero-description text-gray-500 mb-4 sm:mb-6 max-w-md leading-relaxed text-xs sm:text-sm font-medium">{{ $description }}</p>

          <div class="hero-buttons flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-6">
            <a href="{{ $slide->button_link ?? url('daftar') }}" class="bg-brand-pink text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-full font-bold text-sm sm:text-base shadow-lg hover:shadow-pink-500/30 transition flex items-center justify-center w-full sm:w-auto">
              {{ $buttonText }} <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
            <button onclick="openVideoModal('{{ $slide->video_link ?? ($videos->first()->video ?? '#') }}')" class="text-brand-pink font-bold px-5 sm:px-6 py-2.5 sm:py-3 rounded-full hover:bg-pink-50 transition flex items-center justify-center w-full sm:w-auto border border-pink-100 sm:border-transparent text-sm sm:text-base">
              <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border-2 border-brand-pink flex items-center justify-center mr-2">
                <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" /></svg>
              </div>
              Lihat Video
            </button>
          </div>

          <div class="flex items-center space-x-2 sm:space-x-3">
            <div class="flex -space-x-2 sm:-space-x-3">
              @foreach(array_slice($personImages, 0, 3) as $personImg)
              <img class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-white shadow-sm" src="{{ $personImg }}" alt="" loading="lazy" />
              @endforeach
              <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">+1k</div>
            </div>
            <div class="text-xs sm:text-sm">
              <span class="text-brand-pink font-bold text-base sm:text-lg">1,200+</span>
              <p class="text-xs text-gray-500 font-medium">{{ $content['social_proof'] }}</p>
            </div>
          </div>
          </div>

          <div class="hero-person-container relative w-full md:h-full flex items-center justify-center md:justify-end mt-2 sm:mt-4 md:mt-0 order-1 md:order-2 min-h-[200px] sm:min-h-[250px] md:min-h-0">
            <img src="{{ $image }}" class="hero-person-image relative z-10 w-[60%] sm:w-[70%] md:w-[90%] max-w-xs sm:max-w-md md:max-w-none object-contain drop-shadow-2xl rounded-b-none mask-image-b transition-all duration-1500 ease-in-out transform" alt="Student" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" style="mask-image: linear-gradient(to bottom, black 80%, transparent 100%)" />
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Slider Navigation -->
  @if($sliders->count() > 1)
  <div class="absolute bottom-4 sm:bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex space-x-2">
    @foreach($sliders as $index => $slide)
    <button class="hero-slider-dot w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-brand-pink w-6 sm:w-8' : 'bg-gray-300 hover:bg-gray-400' }}" data-slide="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
    @endforeach
  </div>
  <button class="hero-slider-prev absolute left-2 sm:left-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/80 hover:bg-white rounded-full p-2 sm:p-3 shadow-lg transition-all duration-300" aria-label="Previous slide">
    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
  </button>
  <button class="hero-slider-next absolute right-2 sm:right-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/80 hover:bg-white rounded-full p-2 sm:p-3 shadow-lg transition-all duration-300" aria-label="Next slide">
    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
  </button>
  @endif

  <div class="absolute bottom-0 w-full h-16 sm:h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
</header>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.hero-slider-dot');
  const prevBtn = document.querySelector('.hero-slider-prev');
  const nextBtn = document.querySelector('.hero-slider-next');
  let currentSlide = 0;
  let slideInterval;

  if (slides.length <= 1) return;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      const bgImage = slide.querySelector('.hero-bg-image');
      const personImage = slide.querySelector('.hero-person-image');
      const contentText = slide.querySelector('.hero-content-text');
      const title = slide.querySelector('.hero-title');
      const description = slide.querySelector('.hero-description');
      const buttons = slide.querySelector('.hero-buttons');
      const personContainer = slide.querySelector('.hero-person-container');
      
      if (i === index) {
        // Fade in current slide
        slide.classList.remove('opacity-0', 'z-0');
        slide.classList.add('opacity-100', 'z-10');
        
        // Animate background with zoom and fade effect
        if (bgImage) {
          setTimeout(() => {
            bgImage.style.transform = 'scale(1)';
            bgImage.style.opacity = '0.6';
          }, 50);
        }
        
        // Animate person image with slide, fade, and scale
        if (personImage) {
          setTimeout(() => {
            personImage.style.transform = 'translateX(0) translateY(0) scale(1) rotate(0deg)';
            personImage.style.opacity = '1';
          }, 200);
        }
        
        // Animate content text (slide from left)
        if (contentText) {
          setTimeout(() => {
            contentText.style.transform = 'translateX(0) translateY(0)';
            contentText.style.opacity = '1';
          }, 300);
        }
        
        // Animate title
        if (title) {
          setTimeout(() => {
            title.style.transform = 'translateY(0)';
            title.style.opacity = '1';
          }, 400);
        }
        
        // Animate description
        if (description) {
          setTimeout(() => {
            description.style.transform = 'translateY(0)';
            description.style.opacity = '1';
          }, 500);
        }
        
        // Animate buttons
        if (buttons) {
          setTimeout(() => {
            buttons.style.transform = 'translateY(0)';
            buttons.style.opacity = '1';
          }, 600);
        }
        
        // Animate person container
        if (personContainer) {
          setTimeout(() => {
            personContainer.style.transform = 'translateX(0) scale(1)';
            personContainer.style.opacity = '1';
          }, 200);
        }
      } else {
        // Fade out other slides
        slide.classList.remove('opacity-100', 'z-10');
        slide.classList.add('opacity-0', 'z-0');
        
        // Reset background with zoom out
        if (bgImage) {
          bgImage.style.transform = 'scale(1.15)';
          bgImage.style.opacity = '0';
        }
        
        // Reset person image with slide out
        if (personImage) {
          personImage.style.transform = 'translateX(30px) translateY(15px) scale(0.9) rotate(-2deg)';
          personImage.style.opacity = '0';
        }
        
        // Reset content text
        if (contentText) {
          contentText.style.transform = 'translateX(-30px)';
          contentText.style.opacity = '0';
        }
        
        if (title) {
          title.style.transform = 'translateY(-20px)';
          title.style.opacity = '0';
        }
        
        if (description) {
          description.style.transform = 'translateY(-20px)';
          description.style.opacity = '0';
        }
        
        if (buttons) {
          buttons.style.transform = 'translateY(-20px)';
          buttons.style.opacity = '0';
        }
        
        if (personContainer) {
          personContainer.style.transform = 'translateX(50px) scale(0.95)';
          personContainer.style.opacity = '0';
        }
      }
    });

    dots.forEach((dot, i) => {
      if (i === index) {
        dot.classList.add('bg-brand-pink', 'w-8');
        dot.classList.remove('bg-gray-300', 'w-3');
      } else {
        dot.classList.remove('bg-brand-pink', 'w-8');
        dot.classList.add('bg-gray-300', 'w-3');
      }
    });

    currentSlide = index;
  }

  function nextSlide() {
    const next = (currentSlide + 1) % slides.length;
    showSlide(next);
  }

  function prevSlide() {
    const prev = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(prev);
  }

  function startAutoSlide() {
    slideInterval = setInterval(nextSlide, 6000); // Change slide every 6 seconds for better viewing
  }

  function stopAutoSlide() {
    clearInterval(slideInterval);
  }

  // Event listeners
  if (nextBtn) nextBtn.addEventListener('click', () => { stopAutoSlide(); nextSlide(); startAutoSlide(); });
  if (prevBtn) prevBtn.addEventListener('click', () => { stopAutoSlide(); prevSlide(); startAutoSlide(); });

  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      stopAutoSlide();
      showSlide(index);
      startAutoSlide();
    });
  });

  // Pause on hover
  const heroSlider = document.querySelector('.hero-slider');
  if (heroSlider) {
    heroSlider.addEventListener('mouseenter', stopAutoSlide);
    heroSlider.addEventListener('mouseleave', startAutoSlide);
  }

  // Initialize first slide animations
  setTimeout(() => {
    const firstSlide = slides[0];
    if (firstSlide) {
      const bgImage = firstSlide.querySelector('.hero-bg-image');
      const personImage = firstSlide.querySelector('.hero-person-image');
      const contentText = firstSlide.querySelector('.hero-content-text');
      const title = firstSlide.querySelector('.hero-title');
      const description = firstSlide.querySelector('.hero-description');
      const buttons = firstSlide.querySelector('.hero-buttons');
      const personContainer = firstSlide.querySelector('.hero-person-container');
      
      if (bgImage) {
        bgImage.style.transform = 'scale(1)';
        bgImage.style.opacity = '0.6';
      }
      
      if (personImage) {
        personImage.style.transform = 'translateX(0) translateY(0) scale(1) rotate(0deg)';
        personImage.style.opacity = '1';
      }
      
      if (contentText) {
        contentText.style.transform = 'translateX(0) translateY(0)';
        contentText.style.opacity = '1';
      }
      
      if (title) {
        title.style.transform = 'translateY(0)';
        title.style.opacity = '1';
      }
      
      if (description) {
        description.style.transform = 'translateY(0)';
        description.style.opacity = '1';
      }
      
      if (buttons) {
        buttons.style.transform = 'translateY(0)';
        buttons.style.opacity = '1';
      }
      
      if (personContainer) {
        personContainer.style.transform = 'translateX(0) scale(1)';
        personContainer.style.opacity = '1';
      }
    }
  }, 100);

  // Start auto slide
  startAutoSlide();
});
</script>

<style>
.hero-bg-image {
  transition: transform 1.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 1.5s ease-in-out !important;
  will-change: transform, opacity;
}

.hero-person-image {
  transition: transform 1.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 1.5s ease-in-out !important;
  will-change: transform, opacity;
}

.hero-slide {
  transition: opacity 1s ease-in-out !important;
}

.hero-content-text {
  transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1), opacity 1s ease-in-out !important;
  will-change: transform, opacity;
}

.hero-title {
  transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.8s ease-in-out !important;
  will-change: transform, opacity;
}

.hero-description {
  transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.8s ease-in-out !important;
  will-change: transform, opacity;
}

.hero-buttons {
  transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.8s ease-in-out !important;
  will-change: transform, opacity;
}

.hero-person-container {
  transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1), opacity 1.2s ease-in-out !important;
  will-change: transform, opacity;
}

.hero-gradient-overlay {
  transition: opacity 1s ease-in-out !important;
}

/* Smooth hover effects */
.hero-slider-dot:hover {
  transform: scale(1.2);
}

.hero-slider-prev:hover,
.hero-slider-next:hover {
  transform: translateY(-50%) scale(1.1);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}
</style>
@endpush
@endsection

@section('content')
<section class="py-12 sm:py-16 md:py-20 max-w-7xl mx-auto px-4 sm:px-6">
  <div class="flex flex-col md:flex-row items-start justify-between gap-6 sm:gap-8 md:gap-10">
    <div class="w-full md:w-1/3">
      <div class="w-5 h-5 sm:w-6 sm:h-6 bg-red-600 rounded-full mb-3 sm:mb-4 shadow-sm"></div>
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-brand-pink leading-tight">{{ $content['jepang_title'] }}</h2>
    </div>
    <div class="w-full md:w-2/3">
      <p class="text-gray-500 leading-relaxed mb-5 sm:mb-6 font-medium text-sm sm:text-base">{{ $content['jepang_subtitle'] }}</p>
      <button class="bg-brand-yellow text-gray-900 px-6 sm:px-8 py-2.5 sm:py-3 rounded-full font-bold text-xs sm:text-sm shadow-md hover:bg-yellow-300 transition flex items-center inline-flex">{!! $home_contents['more_button']->content ?? 'Selengkapnya' !!} <span class="ml-2">></span></button>
    </div>
  </div>
</section>

<section class="py-12 sm:py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="text-center mb-8 sm:mb-12 md:mb-16">
      <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-pink mb-2 sm:mb-3">{{ $content['program_title'] }}</h2>
      <p class="text-gray-500 text-xs sm:text-sm font-medium px-4">{{ $content['program_subtitle'] }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 sm:mb-12">
      @forelse($program_masa_depan as $item)
      <div class="group bg-white rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer">
        <div class="h-40 sm:h-48 relative overflow-hidden bg-gray-50">
          @if(!empty($item->gambar))
            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul ?? 'Program Image' }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1576091160550-217358c7db81?auto=format&fit=crop&w=500&q=60'" />
          @else
            <img src="{{ asset('template/img/program-default.jpg') }}" alt="Default program image" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" loading="lazy" />
          @endif
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
        <div class="p-4 sm:p-6">
          <h3 class="font-bold text-sm sm:text-base text-gray-800 mb-2 group-hover:text-brand-pink transition">{{ $item->judul ?? 'Program Title' }}</h3>
          <p class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-2">{{ $item->deskripsi ?? 'Program description' }}</p>
          <div class="flex items-center justify-between">
            <span class="text-xs text-brand-pink font-semibold">{{ $item->lokasi ?? 'Location' }}</span>
            <span class="text-xs text-gray-500">{{ $item->durasi ?? 'Duration' }}</span>
          </div>
        </div>
      </div>
      @empty
      <div class="col-span-full text-center py-8 sm:py-12">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 sm:p-8 max-w-md mx-auto">
          <div class="text-yellow-600 mb-3 sm:mb-4">
            <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
          </div>
          <h3 class="text-base sm:text-lg font-semibold text-yellow-800 mb-2">Program Sedang Disiapkan</h3>
          <p class="text-yellow-700 text-xs sm:text-sm px-2">Program-program terbaik kami sedang dalam persiapan untuk membantu Anda meraih impian di Jepang.</p>
          <h3 class="font-bold text-gray-800 text-sm sm:text-base md:text-lg mb-3 sm:mb-4 leading-snug mt-4">Studi Program Sekolah (Bahasa)</h3>
          <ul class="space-y-2 sm:space-y-3">
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">📍</span> Tokyo, Osaka, Kyoto</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">⏱️</span> Durasi 1-2 Tahun</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">🎓</span> Visa Pelajar</li>
          </ul>
        </div>
      </div>
      <div class="group bg-white rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-40 sm:h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
        </div>
        <div class="p-4 sm:p-6">
          <h3 class="font-bold text-gray-800 text-sm sm:text-base md:text-lg mb-3 sm:mb-4 leading-snug">Tokutei Ginou (Skill Spesifik)</h3>
          <ul class="space-y-2 sm:space-y-3">
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">📍</span> Seluruh Jepang</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">⏱️</span> Kontrak 5 Tahun</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">💴</span> Gaji Standar Jepang</li>
          </ul>
        </div>
      </div>
      <div class="group bg-white rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-40 sm:h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
        </div>
        <div class="p-4 sm:p-6">
          <h3 class="font-bold text-gray-800 text-sm sm:text-base md:text-lg mb-3 sm:mb-4 leading-snug">Internship / Magang</h3>
          <ul class="space-y-2 sm:space-y-3">
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">🏭</span> Industri Manufaktur</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">⏱️</span> Durasi 3 Tahun</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">📜</span> Sertifikat JITCO</li>
          </ul>
        </div>
      </div>
      <div class="group bg-white rounded-xl sm:rounded-2xl shadow-soft hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100 overflow-hidden cursor-pointer">
        <div class="h-40 sm:h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
        </div>
        <div class="p-4 sm:p-6">
          <h3 class="font-bold text-gray-800 text-sm sm:text-base md:text-lg mb-3 sm:mb-4 leading-snug">Kursus Bahasa Jepang</h3>
          <ul class="space-y-2 sm:space-y-3">
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">🏫</span> Online / Offline</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">📚</span> JLPT N5 - N1</li>
            <li class="flex items-start text-xs font-medium text-gray-500"><span class="text-brand-pink mr-2">✅</span> Garansi Lulus</li>
          </ul>
        </div>
      </div>
      @endforelse
    </div>

    <div class="text-center mt-8 sm:mt-12">
      <button class="bg-brand-yellow text-gray-900 px-8 sm:px-10 py-2.5 sm:py-3 rounded-full font-bold text-xs sm:text-sm shadow-md hover:bg-yellow-300 transition inline-flex items-center">Lihat Semua Program <span class="ml-2">></span></button>
    </div>
  </div>
</section>

<section class="py-12 sm:py-16 md:py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="flex flex-col md:flex-row justify-between items-end mb-8 sm:mb-12">
      <div class="max-w-xl w-full">
        <h2 class="text-2xl sm:text-3xl font-bold text-brand-pink mb-3 sm:mb-4">{{ $content['industri_title'] }}</h2>
        <p class="text-gray-500 font-medium text-xs sm:text-sm">{{ $content['industri_subtitle'] }}</p>
      </div>
    </div>

    <div class="flex gap-4 sm:gap-6 md:gap-8 overflow-x-auto pb-6 sm:pb-10 justify-start md:justify-between px-2 sm:px-4 no-scrollbar">
      @forelse($industri as $item)
      <div class="group relative w-40 h-40 sm:w-48 sm:h-48 md:w-56 md:h-56 rounded-full overflow-hidden border-[4px] sm:border-[6px] border-white shadow-xl shrink-0 cursor-pointer transition transform hover:scale-105">
        <img src="{{ $item->gambar ?? 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60' }}" alt="{{ $item->nama ?? 'Industry Image' }}" class="w-full h-full object-cover" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60'" />
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-4 sm:pb-6">
          <span class="text-white font-bold text-sm sm:text-base md:text-lg text-center leading-tight px-2">{{ $item->nama ?? 'Industry Name' }}<br /><span class="text-xs font-normal text-gray-300">{{ $item->sub_nama ?? '' }}</span></span>
        </div>
      </div>
      @empty
      <div class="flex gap-4 sm:gap-6 md:gap-8 justify-start md:justify-between px-2 sm:px-4">
        <div class="group relative w-40 h-40 sm:w-48 sm:h-48 md:w-56 md:h-56 rounded-full overflow-hidden border-[4px] sm:border-[6px] border-white shadow-xl shrink-0 cursor-pointer transition transform hover:scale-105">
          <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60" alt="Manufacturing" class="w-full h-full object-cover" />
          <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-4 sm:pb-6">
            <span class="text-white font-bold text-sm sm:text-base md:text-lg text-center leading-tight px-2">Manufacturing<br /><span class="text-xs font-normal text-gray-300">Automotive & Electronics</span></span>
          </div>
        </div>
        <div class="group relative w-40 h-40 sm:w-48 sm:h-48 md:w-56 md:h-56 rounded-full overflow-hidden border-[4px] sm:border-[6px] border-white shadow-xl shrink-0 cursor-pointer transition transform hover:scale-105">
          <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=60" alt="Hospitality" class="w-full h-full object-cover" />
          <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-4 sm:pb-6">
            <span class="text-white font-bold text-sm sm:text-base md:text-lg text-center leading-tight px-2">Hospitality<br /><span class="text-xs font-normal text-gray-300">Hotel & Tourism</span></span>
          </div>
        </div>
        <div class="group relative w-40 h-40 sm:w-48 sm:h-48 md:w-56 md:h-56 rounded-full overflow-hidden border-[4px] sm:border-[6px] border-white shadow-xl shrink-0 cursor-pointer transition transform hover:scale-105">
          <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=500&q=60" alt="IT & Technology" class="w-full h-full object-cover" />
          <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-4 sm:pb-6">
            <span class="text-white font-bold text-sm sm:text-base md:text-lg text-center leading-tight px-2">IT & Technology<br /><span class="text-xs font-normal text-gray-300">Software & Startup</span></span>
          </div>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</section>

<section class="py-12 sm:py-16 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <h2 class="text-2xl sm:text-3xl font-bold text-brand-pink text-center mb-10 sm:mb-12 md:mb-16">Alur Pendaftaran</h2>

    <div class="flex flex-col md:flex-row justify-between items-start text-center relative px-2 sm:px-4">
      <div class="hidden md:block absolute top-10 left-0 w-full h-[2px] bg-gray-100 -z-0"></div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-red-50 rounded-full flex items-center justify-center mb-4 sm:mb-6 shadow-sm ring-4 sm:ring-8 ring-white">
          <span class="text-xl sm:text-2xl">📄</span>
        </div>
        <h4 class="font-bold text-sm sm:text-base text-gray-800 mb-2">1. Konsultasi & Daftar</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto px-2">Diskusi pilihan program & isi formulir.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-blue-50 rounded-full flex items-center justify-center mb-4 sm:mb-6 shadow-sm ring-4 sm:ring-8 ring-white">
          <span class="text-xl sm:text-2xl">🔍</span>
        </div>
        <h4 class="font-bold text-sm sm:text-base text-gray-800 mb-2">2. Seleksi & Interview</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto px-2">Tes potensi & wawancara user.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10 mb-8 md:mb-0">
        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-purple-50 rounded-full flex items-center justify-center mb-4 sm:mb-6 shadow-sm ring-4 sm:ring-8 ring-white">
          <span class="text-xl sm:text-2xl">📝</span>
        </div>
        <h4 class="font-bold text-sm sm:text-base text-gray-800 mb-2">3. Pelatihan Bahasa</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto px-2">Belajar intensif 3-6 bulan.</p>
      </div>

      <div class="flex flex-col items-center w-full md:w-1/4 relative z-10">
        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-green-50 rounded-full flex items-center justify-center mb-4 sm:mb-6 shadow-sm ring-4 sm:ring-8 ring-white">
          <span class="text-xl sm:text-2xl">✈️</span>
        </div>
        <h4 class="font-bold text-sm sm:text-base text-gray-800 mb-2">4. Terbang ke Jepang</h4>
        <p class="text-xs text-gray-500 max-w-[200px] mx-auto px-2">Visa turun & berangkat kerja.</p>
      </div>
    </div>

    <div class="text-center mt-8 sm:mt-12">
      <a href="{{ url('daftar') }}" class="bg-brand-yellow text-gray-900 px-8 sm:px-10 py-2.5 sm:py-3 rounded-full font-bold text-xs sm:text-sm shadow-md hover:bg-yellow-300 transition inline-block">Mulai Pendaftaran ></a>
    </div>
  </div>
</section>

<section class="py-12 sm:py-16 md:py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 sm:mb-12 gap-4">
      <h2 class="text-2xl sm:text-2xl md:text-3xl font-bold text-brand-pink">{{ $content['kisah_title'] ?? 'Kisah Sukses' }}</h2>
      <a href="{{ url('kisah-sukses') }}" class="text-brand-pink hover:text-brand-pink/80 font-medium text-xs sm:text-sm transition">Lihat Semua →</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
      @forelse($kisah_sukses as $item)
      <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 group">
        <div class="relative">
          <div class="h-40 sm:h-48 overflow-hidden bg-gray-50">
            @if(!empty($item->foto))
              <img src="{{ asset($item->foto) }}" alt="{{ $item->nama ?? 'Testimonial' }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80'" />
            @else
              <img src="{{ asset('template/img/ChatGPT Image 18 Jan 2026, 07.02.36.png') }}" alt="Default testimonial" class="w-full h-full object-contain group-hover:scale-110 transition duration-500" loading="lazy" />
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          <div class="absolute top-3 sm:top-4 right-3 sm:right-4 bg-white/90 backdrop-blur-sm rounded-full px-2 sm:px-3 py-1">
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
        
        <div class="p-4 sm:p-6">
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-3 gap-2">
            <div>
              <h4 class="font-bold text-gray-900 text-base sm:text-lg">{{ $item->nama ?? 'Nama Alumni' }}</h4>
              <p class="text-xs text-brand-pink font-semibold uppercase tracking-wide">{{ $item->pekerjaan ?? 'Profesi' }}</p>
            </div>
            <div class="text-left sm:text-right">
              <p class="text-xs text-gray-500 font-medium">{{ $item->lokasi ?? 'Lokasi' }}</p>
              <p class="text-xs text-gray-400">{{ $item->tahun ?? date('Y') }}</p>
            </div>
          </div>
          
          <p class="text-gray-600 italic leading-relaxed text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-3">{{ $item->testimoni ?? 'Testimoni alumni' }}</p>
          
          <div class="flex items-center justify-between flex-wrap gap-2">
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
      <div class="col-span-full text-center py-8 sm:py-12">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 sm:p-8 max-w-md mx-auto">
          <div class="text-yellow-600 mb-3 sm:mb-4">
            <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-3.397 3.397 3.397 0 00-1.455-1.96 3.397 3.397 0 00-3.189 0H4a3 3 0 00-3 3v2H2"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6.188-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
          </div>
          <h3 class="text-base sm:text-lg font-semibold text-yellow-800 mb-2">Kisah Sukses Sedang Disiapkan</h3>
          <p class="text-yellow-700 text-xs sm:text-sm px-2">Alumni-alumni sukses kami akan segera ditampilkan untuk memberikan inspirasi bagi Anda yang ingin meraih impian di Jepang.</p>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</section>

<!-- Video Modal -->
<div id="videoModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-2 sm:p-4">
  <div class="bg-white rounded-lg max-w-4xl w-full mx-2 sm:mx-4">
    <div class="flex justify-between items-center p-3 sm:p-4 border-b">
      <h3 class="text-base sm:text-lg font-semibold text-gray-900">Video</h3>
      <button onclick="closeVideoModal()" class="text-gray-400 hover:text-gray-600 transition">
        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="p-2 sm:p-4">
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