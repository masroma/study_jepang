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

  <section class="min-h-screen hero-bg flex items-center pt-24 md:pt-20 pb-20 px-4 md:px-6">
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none overflow-hidden">
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-30" alt="Verifikasi Ulang" />
      <div class="absolute inset-0 bg-gradient-to-b from-white/80 via-white/60 to-white/80"></div>
    </div>

    <div class="container max-w-7xl mx-auto w-full relative z-10">
      <div class="max-w-md mx-auto">
        <div class="bg-white rounded-3xl shadow-soft p-8 md:p-10 border border-gray-100">
          <div class="text-center mb-8">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Verifikasi Ulang Akun</h1>
            <p class="text-gray-500 text-sm font-medium">Masukkan email dan nomor WhatsApp Anda untuk mengirim ulang kode verifikasi</p>
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

          <form action="{{ url('daftar/verifikasi-ulang') }}" method="POST" class="space-y-6">
            @csrf
            <div>
              <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
              <input type="email" id="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm font-medium" placeholder="Masukkan email Anda" />
            </div>

            <div>
              <label for="whatsapp" class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
              <input type="tel" id="whatsapp" name="whatsapp" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm font-medium" placeholder="08xxxxxxxxxx" />
            </div>

            <button type="submit" class="w-full bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition text-sm">
              Kirim Ulang Kode Verifikasi
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

  @include('partials.footer', ['site_config' => $site_config])
</body>
</html>
