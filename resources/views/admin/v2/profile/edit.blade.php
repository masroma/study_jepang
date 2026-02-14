@extends('admin.v2.layout.wrapper')

@section('page-title', 'Edit Profile')

@section('content')
<div class="space-y-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Edit Profile</h2>
                <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center text-white font-bold text-2xl">
                    {{ strtoupper(substr($user->nama ?? session('nama') ?? 'A', 0, 1)) }}
                </div>
            </div>

            <form action="{{ url('admin/v2/profile/update') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama ?? session('nama') ?? '') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? session('username') ?? '') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    <p class="text-xs text-gray-500 mt-1">Username digunakan untuk login</p>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? session('email') ?? '') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition">
                    <p class="text-xs text-gray-500 mt-1">Email opsional, bisa dikosongkan</p>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
                    <button type="submit" class="bg-brand-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-pink-600 transition shadow-sm flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ url('admin/v2') }}" class="px-6 py-3 rounded-lg font-semibold border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
