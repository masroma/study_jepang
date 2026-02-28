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
<body class="font-sans text-gray-700 overflow-x-hidden bg-gray-50">
  @include('partials.navbar', ['site_config' => $site_config])

  <header class="relative w-full min-h-[400px] md:min-h-[450px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Daftar" />
      <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
    </div>
    <div class="container max-w-7xl mx-auto px-6 relative z-10">
      <div class="max-w-3xl pt-4 md:pt-10">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
          <span class="text-brand-pink">Daftar Sekarang</span><br />
          Mulai Perjalanan Anda<br />
          ke Jepang
        </h1>
        <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
          Isi formulir di bawah ini untuk membuat akun. Setelah pendaftaran, Anda akan menerima kode verifikasi via WhatsApp yang harus dimasukkan sebelum dapat login.
        </p>
      </div>
    </div>
    <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-gray-50 to-transparent z-10"></div>
  </header>

  <section class="py-16 md:py-20 max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-3xl shadow-soft p-8 md:p-12">
      <form action="{{ url('daftar/proses') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" name="nama_lengkap" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Masukkan nama lengkap" />
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="contoh@email.com" />
            <p class="text-xs text-gray-500 mt-1">Email akan digunakan untuk login</p>
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp <span class="text-red-500">*</span></label>
            <input type="tel" name="whatsapp" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="08xxxxxxxxxx" />
            <p class="text-xs text-gray-500 mt-1">Kode verifikasi akan dikirim ke nomor WhatsApp ini</p>
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
            <div class="relative">
              <input type="password" id="password" name="password" required minlength="6" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm pr-12" placeholder="Masukkan password (min. 6 karakter)" />
              <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password', 'eye-icon-password')">
                <svg id="eye-icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </button>
            </div>
          </div>
        </div>
        <div class="flex items-start">
          <input type="checkbox" required class="mt-1 mr-3 w-4 h-4 text-brand-pink border-gray-300 rounded focus:ring-brand-pink" />
          <label class="text-sm text-gray-600 font-medium">
            Saya menyetujui syarat dan ketentuan serta kebijakan privasi yang berlaku <span class="text-red-500">*</span>
          </label>
        </div>
        <div class="pt-4">
          <button type="submit" class="w-full bg-brand-pink text-white px-8 py-4 rounded-full font-bold text-sm md:text-base shadow-lg hover:bg-pink-600 transition flex items-center justify-center">
            Daftar Sekarang
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
          </button>
        </div>
        <div class="text-center pt-4">
          <p class="text-sm text-gray-500 font-medium">
            Sudah punya akun? <a href="{{ url('login') }}" class="text-brand-pink font-bold hover:underline">Masuk di sini</a>
          </p>
        </div>
      </form>
    </div>
  </section>

  @include('partials.footer', ['site_config' => $site_config])

  <script>
    function togglePassword(inputId, iconId) {
      const passwordInput = document.getElementById(inputId);
      const eyeIcon = document.getElementById(iconId);
      
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
        `;
      } else {
        passwordInput.type = "password";
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        `;
      }
    }
  </script>
</body>
</html>
