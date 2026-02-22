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
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-30" alt="Verifikasi Reset Password" />
      <div class="absolute inset-0 bg-gradient-to-b from-white/80 via-white/60 to-white/80"></div>
    </div>

    <div class="container max-w-7xl mx-auto w-full relative z-10">
      <div class="max-w-md mx-auto">
        <div class="bg-white rounded-3xl shadow-soft p-8 md:p-10 border border-gray-100">
          <div class="text-center mb-8">
            <div class="w-16 h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
              </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Verifikasi Reset Password</h1>
            <p class="text-gray-500 text-sm font-medium">Masukkan kode OTP yang telah dikirim ke WhatsApp Anda</p>
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

          @if (!Session::has('reset_password_user_id'))
          <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6 text-sm">
            Sesi reset password tidak ditemukan. Silakan lakukan reset password ulang.
          </div>
          <div class="text-center mt-6">
            <a href="{{ url('login/lupa') }}" class="text-sm text-brand-pink hover:underline font-medium">
              Kembali ke Halaman Lupa Password
            </a>
          </div>
          @else
          <form action="{{ url('login/verifikasi-reset') }}" method="POST" class="space-y-6">
            @csrf
            <div>
              <label for="otp" class="block text-sm font-bold text-gray-700 mb-2">Kode OTP (6 digit)</label>
              <input type="text" id="otp" name="otp" required maxlength="6" pattern="[0-9]{6}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm font-medium text-center text-2xl tracking-widest" placeholder="000000" />
              <p class="text-xs text-gray-500 mt-2 text-center">Masukkan 6 digit kode yang diterima via WhatsApp</p>
            </div>

            <button type="submit" class="w-full bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition text-sm">
              Verifikasi Kode OTP
            </button>
          </form>

          <div class="mt-6 pt-6 border-t border-gray-200">
            <p class="text-center text-sm text-gray-500 font-medium mb-4">Tidak menerima kode?</p>
            <form action="{{ url('login/kirim-ulang-otp-reset') }}" method="POST" class="mb-4">
              @csrf
              <button type="submit" class="w-full bg-gray-100 text-gray-700 px-8 py-3 rounded-full font-bold shadow-md hover:bg-gray-200 transition text-sm">
                Kirim Ulang Kode
              </button>
            </form>
          </div>

          <div class="text-center mt-6">
            <a href="{{ url('login/lupa') }}" class="text-sm text-gray-500 hover:text-brand-pink font-medium transition inline-flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              Kembali ke Lupa Password
            </a>
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer', ['site_config' => $site])

  <script>
    // Auto focus and validate input
    document.getElementById('otp').addEventListener('input', function(e) {
      this.value = this.value.replace(/[^0-9]/g, '');
    });
  </script>
</body>
</html>
