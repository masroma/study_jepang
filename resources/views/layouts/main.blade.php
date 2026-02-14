<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'StudyAbroad - Belajar & Kerja di Jepang')</title>
    <link rel="icon" type="image/png" href="{{ asset('template/img/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('template/img/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Montserrat:wght@600;700;800;900&display=swap" rel="stylesheet" />
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ["Poppins", "sans-serif"],
            },
            colors: {
              "brand-pink": "#FF2E93",
              "brand-yellow": "#FFDE00",
              "brand-blue": "#E0F2FE",
            },
            boxShadow: {
              soft: "0 10px 40px -10px rgba(0,0,0,0.08)",
            },
          },
        },
      };
    </script>
    <style>
      .hero-bg {
        background: linear-gradient(100deg, #eff6ff 0%, #dbeafe 50%, #bfdbfe 100%);
      }
      /* Sembunyikan scrollbar tapi tetap bisa di-scroll */
      .no-scrollbar::-webkit-scrollbar {
        display: none;
      }
      .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
      /* Premium Corporate Text Design */
      .brand-main-text {
        font-family: 'Montserrat', sans-serif;
        font-weight: 900;
        font-size: 1.75rem;
        line-height: 1.1;
        letter-spacing: 0.15em;
        color: #1a1a1a;
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
  </head>
  <body class="font-sans text-gray-700 overflow-x-hidden">
    <nav class="absolute top-0 left-0 w-full z-50 pt-4 px-4 md:pt-6 md:px-12">
      <div class="flex justify-between items-center max-w-7xl mx-auto">
        <div class="flex items-center space-x-3">
          <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
            <img src="{{ asset('template/img/logo.png') }}" alt="Logo" class="h-9 md:h-11 w-auto transition-transform group-hover:scale-105 drop-shadow-sm">
            <div class="hidden md:flex flex-col items-start justify-center">
              <span class="brand-main-text">MEGAHNTARA</span>
              <span class="brand-sub-text">GLOBAL GROUP</span>
            </div>
          </a>
        </div>

        <div class="hidden md:flex items-center space-x-6 text-sm font-medium text-gray-600 bg-white/60 backdrop-blur-sm px-6 py-2 rounded-full shadow-sm">
          <a href="{{ url('/') }}" class="@yield('nav-home', 'hover:text-brand-pink transition')">Home</a>
          <a href="{{ url('training-center') }}" class="@yield('nav-training-center', 'hover:text-brand-pink transition')">Training Center</a>
          <a href="{{ url('kisah-sukses') }}" class="@yield('nav-kisah-sukses', 'hover:text-brand-pink transition')">Kisah Sukses</a>
          <a href="{{ url('blog') }}" class="@yield('nav-blog', 'hover:text-brand-pink transition')">Blog</a>
          <a href="{{ url('kontak') }}" class="@yield('nav-kontak', 'hover:text-brand-pink transition')">Kontak Kami</a>
        </div>

        <div class="flex items-center space-x-2 md:space-x-3">
          <div class="hidden sm:flex items-center space-x-1 bg-white px-2 py-1 rounded-full shadow-sm">
            <select class="text-xs font-bold text-gray-500 outline-none bg-transparent cursor-pointer" onchange="changeLanguage(this.value)">
              <option value="id" selected>
                <div class="flex items-center">
                  <img src="https://flagcdn.com/w40/id.png" class="w-5 h-auto rounded-sm" alt="ID" />
                  <span class="ml-1">ID</span>
                </div>
              </option>
              <option value="en">
                <div class="flex items-center">
                  <img src="https://flagcdn.com/w40/us.png" class="w-5 h-auto rounded-sm" alt="EN" />
                  <span class="ml-1">EN</span>
                </div>
              </option>
              <option value="jp">
                <div class="flex items-center">
                  <img src="https://flagcdn.com/w40/jp.png" class="w-5 h-auto rounded-sm" alt="JP" />
                  <span class="ml-1">JP</span>
                </div>
              </option>
            </select>
          </div>

          <a href="{{ url('login') }}" class="text-sm font-bold text-gray-600 hover:text-brand-pink px-2 md:px-3">Masuk</a>
          <a href="{{ url('daftar') }}" class="bg-brand-pink text-white px-4 py-2 md:px-5 md:py-2 rounded-full text-xs md:text-sm font-bold shadow-lg hover:bg-pink-600 transition">Daftar</a>
        </div>
      </div>
    </nav>

    @yield('hero')

    @yield('content')

    <footer class="bg-white pt-16 pb-10 border-t border-gray-100">
      <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
        <div class="col-span-1 md:col-span-2">
          <div class="text-2xl font-extrabold text-brand-pink mb-6">StudyAbroad</div>
          <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-6 font-medium">{{ $site_config->deskripsi ?? 'Lembaga resmi pelatihan bahasa dan kerja ke Jepang. Terakreditasi dan memiliki jaringan luas.' }}</p>
        </div>
        <div>
          <h4 class="font-bold text-gray-800 mb-6">Menu</h4>
          <ul class="space-y-3 text-sm text-gray-500 font-medium">
            <li><a href="{{ url('/') }}" class="hover:text-brand-pink transition">Beranda</a></li>
            <li><a href="{{ url('training-center') }}" class="hover:text-brand-pink transition">Training Center</a></li>
            <li><a href="{{ url('kisah-sukses') }}" class="hover:text-brand-pink transition">Kisah Sukses</a></li>
            <li><a href="{{ url('blog') }}" class="hover:text-brand-pink transition">Blog</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold text-gray-800 mb-6">Hubungi Kami</h4>
          <ul class="space-y-3 text-sm text-gray-500 font-medium">
            <li class="flex items-start"><span class="mr-2">📍</span> Jakarta Selatan</li>
            <li class="flex items-center"><span class="mr-2">📞</span> +62 812 3456 7890</li>
          </ul>
        </div>
      </div>
      <div class="max-w-7xl mx-auto px-6 text-center text-xs text-gray-400 pt-8 border-t border-gray-100 font-medium">&copy; 2024 StudyAbroad. All rights reserved.</div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281234567890?text=Halo%20StudyAbroad,%20saya%20ingin%20bertanya%20tentang%20program%20belajar%20dan%20kerja%20di%20Jepang" target="_blank" class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition-all duration-300 hover:scale-110 group">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
      </svg>
      <div class="absolute bottom-full right-0 mb-2 px-3 py-1 bg-gray-800 text-white text-xs rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
        Chat WhatsApp
        <div class="absolute top-full right-4 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-800"></div>
      </div>
    </a>
  </body>
  
  <script>
  function changeLanguage(lang) {
    console.log('Language changed to:', lang);
    
    // Save language preference to localStorage
    localStorage.setItem('selectedLanguage', lang);
    
    // Reload page with language parameter
    const currentUrl = new URL(window.location);
    currentUrl.searchParams.set('lang', lang);
    window.location.href = currentUrl.toString();
  }
  
  // Set initial language from localStorage or default
  document.addEventListener('DOMContentLoaded', function() {
    const savedLang = localStorage.getItem('selectedLanguage') || 'id';
    const langSelect = document.querySelector('select[onchange="changeLanguage(this.value)"]');
    if (langSelect) {
      langSelect.value = savedLang;
    }
  });
</script>
</html>