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
  @include('partials.navbar', ['site_config' => $site])

  <section class="min-h-screen hero-bg flex items-center pt-24 md:pt-20 pb-20 px-4 md:px-6">
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none overflow-hidden">
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-30" alt="Login" />
      <div class="absolute inset-0 bg-gradient-to-b from-white/80 via-white/60 to-white/80"></div>
    </div>

    <div class="container max-w-7xl mx-auto w-full relative z-10">
      <div class="max-w-md mx-auto">
        <div class="bg-white rounded-3xl shadow-soft p-8 md:p-10 border border-gray-100">
          <div class="text-center mb-8">
            <div class="w-16 h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Masuk ke Akun</h1>
            <p class="text-gray-500 text-sm font-medium">Selamat datang kembali! Silakan masuk ke akun Anda.</p>
          </div>

          @if ($message = Session::get('warning'))
          <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-xl mb-6 text-sm">
            {{ $message }}
          </div>
          @endif

          @if ($message = Session::get('sukses'))
          <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-6 text-sm">
            {{ $message }}
          </div>
          @endif

          <form action="{{ url('login/check') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Login Method Toggle -->
            <div class="flex items-center justify-center gap-4 mb-4">
              <button type="button" id="btn-email" class="flex-1 px-4 py-2 rounded-xl font-bold text-sm transition login-method-btn active" data-method="email">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Email
              </button>
              <button type="button" id="btn-whatsapp" class="flex-1 px-4 py-2 rounded-xl font-bold text-sm transition login-method-btn" data-method="whatsapp">
                <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                WhatsApp
              </button>
            </div>
            <input type="hidden" id="login_method" name="login_method" value="email" />
            
            <div id="email-field">
              <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email atau Username</label>
              <input type="text" id="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm font-medium" placeholder="Masukkan email atau username" />
            </div>
            
            <div id="whatsapp-field" style="display: none;">
              <label for="whatsapp" class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
              <input type="tel" id="whatsapp" name="whatsapp" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm font-medium" placeholder="08xxxxxxxxxx" />
            </div>

            <div>
              <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
              <div class="relative">
                <input type="password" id="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm font-medium pr-12" placeholder="Masukkan password" />
                <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword()">
                  <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
              </div>
            </div>

            <div class="flex items-center justify-between">
              <label class="flex items-center">
                <input type="checkbox" name="remember" class="w-4 h-4 text-brand-pink border-gray-300 rounded focus:ring-brand-pink" />
                <span class="ml-2 text-sm text-gray-600 font-medium">Ingat saya</span>
              </label>
              <a href="{{ url('login/lupa') }}" class="text-sm font-bold text-brand-pink hover:underline">Lupa password?</a>
            </div>

            <button type="submit" class="w-full bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition text-sm">
              Masuk
            </button>
          </form>

          <div class="mt-6 pt-6 border-t border-gray-200">
            <p class="text-center text-sm text-gray-500 font-medium mb-4">Belum punya akun?</p>
            <a href="{{ url('daftar') }}" class="block w-full bg-brand-yellow text-gray-900 px-8 py-3 rounded-full font-bold shadow-md hover:bg-yellow-300 transition text-sm text-center">
              Daftar Sekarang
            </a>
          </div>

          <div class="mt-6 pt-6 border-t border-gray-200">
            <p class="text-center text-xs text-gray-400 font-medium mb-3">Atau masuk dengan</p>
            <div class="flex gap-3">
              <button type="button" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl border border-gray-200 hover:bg-gray-50 transition text-sm font-medium text-gray-700">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                  <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                  <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                  <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                  <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                </svg>
                Google
              </button>
              <button type="button" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl border border-gray-200 hover:bg-gray-50 transition text-sm font-medium text-gray-700">
                <svg class="w-5 h-5" fill="#1877F2" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                </svg>
                Facebook
              </button>
            </div>
          </div>

          <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-brand-pink font-medium transition inline-flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              Kembali ke Beranda
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer', ['site_config' => $site])

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const eyeIcon = document.getElementById("eye-icon");
      
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

    // Login method toggle
    document.addEventListener('DOMContentLoaded', function() {
      const emailBtn = document.getElementById('btn-email');
      const whatsappBtn = document.getElementById('btn-whatsapp');
      const emailField = document.getElementById('email-field');
      const whatsappField = document.getElementById('whatsapp-field');
      const emailInput = document.getElementById('email');
      const whatsappInput = document.getElementById('whatsapp');
      const loginMethodInput = document.getElementById('login_method');

      function switchToEmail() {
        emailBtn.classList.add('active', 'bg-brand-pink', 'text-white');
        emailBtn.classList.remove('bg-gray-100', 'text-gray-700');
        whatsappBtn.classList.remove('active', 'bg-brand-pink', 'text-white');
        whatsappBtn.classList.add('bg-gray-100', 'text-gray-700');
        emailField.style.display = 'block';
        whatsappField.style.display = 'none';
        emailInput.setAttribute('required', 'required');
        whatsappInput.removeAttribute('required');
        loginMethodInput.value = 'email';
      }

      function switchToWhatsApp() {
        whatsappBtn.classList.add('active', 'bg-brand-pink', 'text-white');
        whatsappBtn.classList.remove('bg-gray-100', 'text-gray-700');
        emailBtn.classList.remove('active', 'bg-brand-pink', 'text-white');
        emailBtn.classList.add('bg-gray-100', 'text-gray-700');
        whatsappField.style.display = 'block';
        emailField.style.display = 'none';
        whatsappInput.setAttribute('required', 'required');
        emailInput.removeAttribute('required');
        loginMethodInput.value = 'whatsapp';
      }

      emailBtn.addEventListener('click', switchToEmail);
      whatsappBtn.addEventListener('click', switchToWhatsApp);
    });
  </script>
  <style>
    .login-method-btn {
      border: 2px solid transparent;
    }
    .login-method-btn.active {
      border-color: #FF2E93;
    }
    .login-method-btn:not(.active) {
      background-color: #f3f4f6;
      color: #374151;
    }
  </style>
</body>
</html>
