@extends('layouts.main')

@section('title', 'Kontak Kami - StudyAbroad')

@section('nav-kontak', 'text-brand-pink font-semibold')

@section('hero')
<header class="relative w-full min-h-[500px] md:min-h-[550px] hero-bg flex items-center pt-24 md:pt-20 overflow-hidden">
  <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
    <img src="{{ asset('template/img/image6.png') }}" class="w-full h-full object-cover opacity-60" alt="Kontak Kami" />
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
@endsection

@section('content')
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

        <form class="space-y-6" action="{{ url('kontak/kirim') }}" method="POST">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap *</label>
              <input type="text" name="nama" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Masukkan nama lengkap" required />
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2">Email *</label>
              <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="nama@email.com" required />
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon *</label>
              <input type="tel" name="telepon" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="+62 812 3456 7890" required />
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2">Subjek *</label>
              <select name="subjek" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm bg-white" required>
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
            <textarea name="pesan" rows="6" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm resize-none" placeholder="Tulis pesan Anda di sini..." required></textarea>
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
                  Jl. Sudirman No. 123<br />
                  Jakarta Selatan 12190<br />
                  Indonesia
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
                  <a href="tel:+6281234567890" class="hover:text-brand-pink transition">+62 812 3456 7890</a><br />
                  <a href="tel:+6281234567891" class="hover:text-brand-pink transition">+62 812 3456 7891</a>
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
                  <a href="mailto:info@studyabroad.id" class="hover:text-brand-pink transition">info@studyabroad.id</a><br />
                  <a href="mailto:cs@studyabroad.id" class="hover:text-brand-pink transition">cs@studyabroad.id</a>
                </p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-xl transition">
            <div class="flex items-start">
              <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                <span class="text-2xl">🕒</span>
              </div>
              <div>
                <h3 class="font-bold text-gray-800 mb-2">Jam Operasional</h3>
                <p class="text-sm text-gray-500 font-medium leading-relaxed">
                  Senin - Jumat: 09:00 - 18:00 WIB<br />
                  Sabtu: 09:00 - 15:00 WIB<br />
                  Minggu: Tutup
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Social Media -->
        <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-2xl p-6 shadow-soft">
          <h3 class="font-bold text-gray-800 mb-4">Ikuti Kami</h3>
          <div class="flex space-x-4">
            <a href="#" class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm hover:bg-brand-pink hover:text-white transition group">
              <svg class="w-6 h-6 text-gray-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="#" class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm hover:bg-brand-pink hover:text-white transition group">
              <svg class="w-6 h-6 text-gray-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
            </a>
            <a href="#" class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm hover:bg-brand-pink hover:text-white transition group">
              <svg class="w-6 h-6 text-gray-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
            </a>
            <a href="#" class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm hover:bg-brand-pink hover:text-white transition group">
              <svg class="w-6 h-6 text-gray-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight mb-4">Lokasi Kantor Kami</h2>
      <p class="text-gray-500 font-medium text-sm">Kunjungi kantor kami untuk konsultasi langsung</p>
    </div>

    <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
      <div class="w-full h-96 bg-gray-200 relative">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1949!2d106.8164!3d-6.2088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMzEuNyJTIDEwNsKwNDknMDkuMCJF!5e0!3m2!1sid!2sid!4v1234567890"
          width="100%"
          height="100%"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="absolute inset-0 w-full h-full">
        </iframe>
      </div>
    </div>
  </div>
</section>

<!-- Quick Contact Section -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl p-8 text-center shadow-soft hover:shadow-xl transition">
        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
          <span class="text-3xl">📞</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Telepon Langsung</h3>
        <p class="text-sm text-gray-600 font-medium mb-4">Hubungi kami sekarang</p>
        <a href="tel:+6281234567890" class="text-brand-pink font-bold text-lg hover:underline">+62 812 3456 7890</a>
      </div>

      <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 text-center shadow-soft hover:shadow-xl transition">
        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
          <span class="text-3xl">💬</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">WhatsApp</h3>
        <p class="text-sm text-gray-600 font-medium mb-4">Chat dengan kami</p>
        <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-500 text-white px-6 py-2 rounded-full font-bold text-sm hover:bg-green-600 transition inline-block">Chat Sekarang</a>
      </div>

      <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-8 text-center shadow-soft hover:shadow-xl transition">
        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
          <span class="text-3xl">✉️</span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Email</h3>
        <p class="text-sm text-gray-600 font-medium mb-4">Kirim email ke kami</p>
        <a href="mailto:info@studyabroad.id" class="text-brand-pink font-bold text-sm hover:underline">info@studyabroad.id</a>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
  <div class="max-w-4xl mx-auto px-6">
    <div class="text-center mb-12">
      <div class="w-6 h-6 bg-red-600 rounded-full mb-4 shadow-sm mx-auto"></div>
      <h2 class="text-3xl md:text-4xl font-bold text-brand-pink leading-tight mb-4">Pertanyaan Umum</h2>
      <p class="text-gray-500 font-medium text-sm">Temukan jawaban untuk pertanyaan yang sering diajukan</p>
    </div>

    <div class="space-y-4">
      <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
        <h3 class="font-bold text-gray-800 mb-2 flex items-center">
          <span class="text-brand-pink mr-3">❓</span>
          Bagaimana cara mendaftar program?
        </h3>
        <p class="text-sm text-gray-600 font-medium ml-8">Anda dapat mendaftar melalui formulir online di website, menghubungi kami via telepon atau WhatsApp, atau datang langsung ke kantor kami untuk konsultasi.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
        <h3 class="font-bold text-gray-800 mb-2 flex items-center">
          <span class="text-brand-pink mr-3">❓</span>
          Berapa lama proses pendaftaran?
        </h3>
        <p class="text-sm text-gray-600 font-medium ml-8">Proses pendaftaran biasanya memakan waktu 1-2 minggu setelah dokumen lengkap. Kami akan memandu Anda melalui setiap tahap proses.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
        <h3 class="font-bold text-gray-800 mb-2 flex items-center">
          <span class="text-brand-pink mr-3">❓</span>
          Apakah ada program beasiswa?
        </h3>
        <p class="text-sm text-gray-600 font-medium ml-8">Ya, kami menyediakan berbagai program beasiswa untuk siswa berprestasi. Hubungi kami untuk informasi lebih lanjut tentang persyaratan dan cara mendaftar.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
        <h3 class="font-bold text-gray-800 mb-2 flex items-center">
          <span class="text-brand-pink mr-3">❓</span>
          Apakah training center menyediakan kelas online?
        </h3>
        <p class="text-sm text-gray-600 font-medium ml-8">Ya, kami menyediakan kelas online dan offline. Anda dapat memilih metode pembelajaran yang paling sesuai dengan kebutuhan dan jadwal Anda.</p>
      </div>
    </div>
  </div>
</section>
@endsection