@extends('member.layout.wrapper')

@section('page-title', 'Tambah Referal')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tambah Referal Baru</h2>

        <form action="{{ url('member/mitra/referal/tambah/proses') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" name="nama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Telepon *</label>
                    <input type="text" name="telepon" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program *</label>
                    <select name="program" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent">
                        <option value="Kerja">Kerja di Luar Negeri</option>
                        <option value="Pendidikan">Pendidikan di Luar Negeri</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent"></textarea>
                </div>

                <div class="flex items-center space-x-4">
                    <button type="submit" class="bg-brand-pink text-white px-8 py-3 rounded-lg font-semibold hover:bg-pink-600 transition">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Referal
                    </button>
                    <a href="{{ url('member/mitra/referal') }}" class="text-gray-600 hover:text-gray-900 transition">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
