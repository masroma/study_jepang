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

  <header class="relative w-full min-h-[500px] md:min-h-[550px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
      @php $bg = DB::table('heading')->where('halaman','Kontak')->orderBy('id_heading','DESC')->first(); @endphp
      @if($bg && $bg->gambar)
      <img src="{{ asset('assets/upload/image/'.$bg->gambar) }}" class="w-full h-full object-cover opacity-60" alt="Kontak" />
      @else
      <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Kontak" />
      @endif
      <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 md:via-white/80 to-transparent"></div>
    </div>
    <div class="container max-w-7xl mx-auto px-6 relative z-10">
      <div class="max-w-3xl pt-4 md:pt-10">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-4">
          <span class="text-brand-pink">Hubungi Kami</span><br />
          Kami Siap Membantu<br />
          Perjalanan Anda
        </h1>
        <p class="text-gray-500 mb-8 max-w-2xl leading-relaxed text-sm md:text-base font-medium">
          Tim kami siap membantu menjawab pertanyaan Anda tentang program belajar dan kerja di Jepang. Jangan ragu untuk menghubungi kami melalui berbagai cara yang tersedia.
        </p>
      </div>
    </div>
    <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white to-transparent z-10"></div>
  </header>

  @php
  $waNumber = isset($site_config->telepon) ? preg_replace('/\D+/', '', $site_config->telepon) : '';
  @endphp

  <section class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div>
          <div class="mb-8">
            <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
            <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight mb-4">Kirim Pesan</h2>
            <p class="text-gray-500 font-medium text-sm">Isi formulir di bawah ini dan kami akan menghubungi Anda secepatnya.</p>
          </div>

          <form class="space-y-6" action="#" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap *</label>
                <input type="text" name="nama" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Masukkan nama lengkap" />
              </div>
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email *</label>
                <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="nama@email.com" />
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon *</label>
                <input type="tel" name="telepon" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="+62 812 3456 7890" />
              </div>
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Subjek *</label>
                <select name="subjek" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm bg-white">
                  <option value="">Pilih subjek</option>
                  <option value="program">Informasi Program</option>
                  <option value="training">Training Center</option>
                  <option value="pendaftaran">Pendaftaran</option>
                  <option value="lainnya">Lainnya</option>
                </select>
              </div>
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2">Pesan *</label>
              <textarea name="pesan" rows="6" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm resize-none" placeholder="Tulis pesan Anda di sini..."></textarea>
            </div>

            <button type="submit" class="bg-brand-pink text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-600 transition w-full md:w-auto">
              Kirim Pesan <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
          </form>
        </div>

        <!-- Contact Information -->
        <div>
          <div class="mb-8">
            <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm"></div>
            <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight mb-4">Informasi Kontak</h2>
            <p class="text-gray-500 font-medium text-sm">Hubungi kami melalui berbagai cara yang tersedia.</p>
          </div>

          <div class="space-y-6 mb-8">
            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-xl transition">
              <div class="flex items-start">
                <div class="w-12 h-12 bg-pink-50 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-2xl">📍</span>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 mb-2">Alamat Kantor</h3>
                  <p class="text-sm text-gray-500 font-medium leading-relaxed">
                    {!! nl2br($site_config->alamat ?? 'Jakarta Selatan, Indonesia') !!}
                  </p>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-xl transition">
              <div class="flex items-start">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-2xl">📞</span>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 mb-2">Telepon</h3>
                  <p class="text-sm text-gray-500 font-medium">
                    <a href="tel:{{ $site_config->telepon ?? '' }}" class="hover:text-brand-pink transition">{{ $site_config->telepon ?? '+62 812 3456 7890' }}</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-xl transition">
              <div class="flex items-start">
                <div class="w-12 h-12 bg-yellow-50 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-2xl">✉️</span>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 mb-2">Email</h3>
                  <p class="text-sm text-gray-500 font-medium">
                    <a href="mailto:{{ $site_config->email ?? '' }}" class="hover:text-brand-pink transition">{{ $site_config->email ?? 'info@example.com' }}</a>
                  </p>
                </div>
              </div>
            </div>

            @if($waNumber)
            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-xl transition">
              <div class="flex items-start">
                <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-2xl">💬</span>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 mb-2">WhatsApp</h3>
                  <p class="text-sm text-gray-500 font-medium mb-3">
                    Chat langsung dengan kami via WhatsApp
                  </p>
                  <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="bg-green-500 text-white px-6 py-2 rounded-full font-bold text-sm hover:bg-green-600 transition inline-block">
                    Chat Sekarang
                  </a>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  @if($site_config->google_map)
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
        <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight mb-4">Lokasi Kantor Kami</h2>
        <p class="text-gray-500 font-medium text-sm">Kunjungi kantor kami untuk konsultasi langsung</p>
      </div>
      <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
        <div class="w-full h-96 bg-gray-200 relative">
          {!! $site_config->google_map !!}
        </div>
      </div>
    </div>
  </section>
  @endif

  @include('partials.footer', ['site_config' => $site_config])
</body>
</html>
