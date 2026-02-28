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
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-30" alt="Reset Password" />
      <div class="absolute inset-0 bg-gradient-to-b from-white/80 via-white/60 to-white/80"></div>
    </div>

    <div class="container max-w-7xl mx-auto w-full relative z-10">
      <div class="max-w-md mx-auto">
        <div class="bg-white rounded-3xl shadow-soft p-8 md:p-10 border border-gray-100">
          <div class="text-center mb-8">
            <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Reset Password</h1>
            <p class="text-gray-500 text-sm font-medium">Masukkan password baru Anda</p>
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

          @if ($message = Session::get('error'))
          <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6 text-sm">
            {{ $message }}
          </div>
          @endif

          <form action="{{ url('login/reset-password') }}" method="POST" class="space-y-6">
            @csrf
            <div>
              <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
              <div class="relative">
                <input type="password" id="password" name="password" required minlength="6" autofocus class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm font-medium pr-12" placeholder="Masukkan password baru (min. 6 karakter)" />
                <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password', 'eye-icon-password')">
                  <svg id="eye-icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
              </div>
              <p class="text-xs text-gray-500 mt-1">Password minimal 6 karakter</p>
            </div>

            <div>
              <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password</label>
              <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm font-medium pr-12" placeholder="Masukkan ulang password baru" />
                <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password_confirmation', 'eye-icon-password-confirmation')">
                  <svg id="eye-icon-password-confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
              </div>
            </div>

            <button type="submit" class="w-full bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition text-sm">
              Reset Password
            </button>
          </form>

          <div class="text-center mt-6">
            <a href="{{ url('login') }}" class="text-sm text-gray-500 hover:text-brand-pink font-medium transition inline-flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              Kembali ke Login
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer', ['site_config' => $site])

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
