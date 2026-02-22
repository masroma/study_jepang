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
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
            <input type="text" name="username" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Masukkan username" />
            <p class="text-xs text-gray-500 mt-1">Username akan digunakan untuk login</p>
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
            <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Masukkan password" />
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp <span class="text-red-500">*</span></label>
            <input type="tel" name="whatsapp" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="08xxxxxxxxxx" />
            <p class="text-xs text-gray-500 mt-1">Kode verifikasi akan dikirim ke nomor WhatsApp ini</p>
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
            <input type="tel" name="nomor_telepon" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="08xxxxxxxxxx" />
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Program yang Diminati <span class="text-red-500">*</span></label>
            <select name="program" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm bg-white">
              <option value="">Pilih Program</option>
              <option value="sekolah-bahasa">Studi Program Sekolah (Bahasa)</option>
              <option value="tokutei-ginou">Tokutei Ginou (Skill Spesifik)</option>
              <option value="internship">Internship / Magang</option>
              <option value="kursus-bahasa">Kursus Bahasa Jepang</option>
              <option value="training-center">Training Center</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Level Bahasa Jepang</label>
            <select name="level_bahasa" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm bg-white">
              <option value="">Pilih Level</option>
              <option value="pemula">Pemula (Belum ada)</option>
              <option value="n5">N5</option>
              <option value="n4">N4</option>
              <option value="n3">N3</option>
              <option value="n2">N2</option>
              <option value="n1">N1</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Pendidikan Terakhir <span class="text-red-500">*</span></label>
            <select name="pendidikan" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm bg-white">
              <option value="">Pilih Pendidikan</option>
              <option value="sma">SMA/SMK</option>
              <option value="d3">D3</option>
              <option value="s1">S1</option>
              <option value="s2">S2</option>
            </select>
          </div>
        </div>
        <div>
          <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
          <textarea name="alamat" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm resize-none" placeholder="Masukkan alamat lengkap"></textarea>
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
</body>
</html>
