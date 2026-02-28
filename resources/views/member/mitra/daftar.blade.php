@extends('member.layout.wrapper')

@section('page-title', 'Daftar Jadi Mitra')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-gradient-to-r from-brand-pink to-pink-600 rounded-xl p-8 text-white mb-6">
        <h2 class="text-3xl font-bold mb-2">Jadi Mitra & Dapatkan Komisi</h2>
        <p class="text-pink-100">Ajak orang lain untuk bekerja atau kuliah di luar negeri dan dapatkan komisi setiap kali referal Anda berhasil!</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Keuntungan Jadi Mitra</h3>
        <div class="space-y-4">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-8 h-8 bg-brand-pink rounded-full flex items-center justify-center text-white">
                    <i class="fas fa-check text-sm"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Komisi Menarik</p>
                    <p class="text-sm text-gray-600">Dapatkan komisi setiap referal yang berhasil bekerja atau kuliah di luar negeri</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-8 h-8 bg-brand-pink rounded-full flex items-center justify-center text-white">
                    <i class="fas fa-check text-sm"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Passive Income</p>
                    <p class="text-sm text-gray-600">Dapatkan penghasilan tambahan tanpa harus bekerja full-time</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-8 h-8 bg-brand-pink rounded-full flex items-center justify-center text-white">
                    <i class="fas fa-check text-sm"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Mudah & Cepat</p>
                    <p class="text-sm text-gray-600">Proses pendaftaran mudah, withdraw cepat, dan transparan</p>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ url('member/mitra/daftar/proses') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        @csrf
        <div class="mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Form Pendaftaran Mitra</h3>
            <p class="text-sm text-gray-600 mb-4">Dengan mendaftar sebagai mitra, Anda akan mendapatkan kode referal unik yang bisa Anda bagikan kepada teman, keluarga, atau kenalan yang ingin bekerja atau melanjutkan pendidikan ke luar negeri.</p>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start space-x-3">
                <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                <div>
                    <p class="text-sm font-semibold text-blue-900 mb-1">Informasi Penting</p>
                    <p class="text-sm text-blue-800">Setelah mendaftar, Anda akan mendapatkan kode referal unik. Setiap kali ada orang yang mendaftar menggunakan kode referal Anda dan berhasil diterima, Anda akan mendapatkan komisi yang langsung masuk ke saldo Anda.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="bg-brand-pink text-white px-8 py-3 rounded-lg font-bold hover:bg-pink-600 transition flex items-center">
                <i class="fas fa-handshake mr-2"></i>
                Daftar Sekarang
            </button>
            <a href="{{ url('member/dashboard') }}" class="text-gray-600 hover:text-gray-900 transition">
                Kembali ke Dashboard
            </a>
        </div>
    </form>
</div>
@endsection
