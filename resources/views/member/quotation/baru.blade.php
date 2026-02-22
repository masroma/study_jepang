@extends('member.layout.wrapper')

@section('page-title', 'Request Quotation Baru')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Request Quotation Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Isi formulir di bawah ini untuk mengirim request quotation baru</p>
        </div>
        <a href="{{ url('member/quotation') }}" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6">
            <div class="font-semibold mb-2">Terjadi kesalahan:</div>
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="space-y-6" action="{{ url('member/quotation/kirim') }}" method="POST">
            @csrf
            
            <!-- Informasi Pribadi -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-circle mr-2 text-brand-pink"></i>
                    Informasi Pribadi
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" value="{{ $user->nama ?? '' }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-100 text-gray-600 cursor-not-allowed" readonly />
                        <p class="text-xs text-gray-500 mt-1">Data diambil dari profil Anda</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" value="{{ $user->email ?? '' }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-100 text-gray-600 cursor-not-allowed" readonly />
                        <p class="text-xs text-gray-500 mt-1">Data diambil dari profil Anda</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon / WhatsApp</label>
                        <input type="text" value="{{ $user->whatsapp ?? '-' }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-100 text-gray-600 cursor-not-allowed" readonly />
                        <p class="text-xs text-gray-500 mt-1">Data diambil dari profil Anda</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Perusahaan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="perusahaan" value="{{ old('perusahaan') }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Nama perusahaan (opsional)" />
                    </div>
                </div>
            </div>

            <!-- Informasi Produk -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-box mr-2 text-brand-pink"></i>
                    Informasi Produk
                </h3>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        Produk yang Diminati <span class="text-red-500">*</span>
                    </label>
                    @if(isset($all_produk) && count($all_produk) > 0)
                        <select name="produk" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm bg-white" required>
                            <option value="">Pilih produk</option>
                            @foreach($all_produk as $kategori => $produk_list)
                                <optgroup label="{{ $kategori }}">
                                    @foreach($produk_list as $produk_item)
                                    <option value="{{ $produk_item->nama_produk ?? $produk_item->nama }}" {{ old('produk') == ($produk_item->nama_produk ?? $produk_item->nama) ? 'selected' : '' }}>
                                        {{ $produk_item->nama_produk ?? $produk_item->nama }}
                                    </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    @else
                        <input type="text" name="produk" value="{{ old('produk') }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Masukkan nama produk yang diminati" required />
                        <p class="text-xs text-gray-500 mt-1">Masukkan nama produk atau komoditas yang ingin Anda request quotation</p>
                    @endif
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Quantity / Jumlah yang Dibutuhkan</label>
                    <input type="text" name="quantity" value="{{ old('quantity') }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm" placeholder="Contoh: 1 Container, 1000 kg, 500 pcs, dll" />
                    <p class="text-xs text-gray-500 mt-1">Masukkan jumlah atau quantity yang Anda butuhkan</p>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kebutuhan Khusus / Spesifikasi</label>
                    <textarea name="kebutuhan" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm resize-none" placeholder="Jelaskan kebutuhan khusus atau spesifikasi yang diinginkan...">{{ old('kebutuhan') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Jelaskan spesifikasi, standar kualitas, atau kebutuhan khusus lainnya</p>
                </div>
            </div>

            <!-- Pesan Tambahan -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pesan Tambahan</label>
                <textarea name="pesan" rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition text-sm resize-none" placeholder="Tulis pesan tambahan jika ada...">{{ old('pesan') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Tambahkan informasi lain yang perlu diketahui tim kami</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ url('member/quotation') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-brand-pink text-white rounded-lg hover:bg-pink-600 transition font-medium shadow-sm">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim Request Quotation
                </button>
            </div>
        </form>
    </div>

    <!-- Info Box -->
    <div class="bg-gradient-to-br from-pink-50 to-blue-50 rounded-xl p-6 border border-pink-100">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-brand-pink rounded-lg flex items-center justify-center text-white">
                    <i class="fas fa-info-circle text-xl"></i>
                </div>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Informasi Penting</h3>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                        <span>Tim kami akan merespons request quotation Anda dalam 24 jam kerja</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                        <span>Pastikan informasi yang Anda berikan lengkap dan akurat untuk proses yang lebih cepat</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                        <span>Anda dapat melacak status request quotation di halaman <a href="{{ url('member/quotation') }}" class="text-brand-pink hover:underline font-medium">Request Quotation</a></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
