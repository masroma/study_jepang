@extends('admin.v2.layout.wrapper')

@section('page-title', 'Ubah Password')

@section('content')
<div class="space-y-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Ubah Password</h2>
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-lock text-yellow-600 text-2xl"></i>
                </div>
            </div>

            <form action="{{ url('admin/v2/password/update') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="password_lama" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password Lama <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="password_lama" name="password_lama" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition pr-12"
                            placeholder="Masukkan password lama">
                        <button type="button" onclick="togglePassword('password_lama', 'eye1')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="eye1" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password_lama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_baru" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="password_baru" name="password_baru" required minlength="6"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition pr-12"
                            placeholder="Masukkan password baru (min. 6 karakter)">
                        <button type="button" onclick="togglePassword('password_baru', 'eye2')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="eye2" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter</p>
                    @error('password_baru')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_baru_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="password_baru_confirmation" name="password_baru_confirmation" required minlength="6"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none transition pr-12"
                            placeholder="Ulangi password baru">
                        <button type="button" onclick="togglePassword('password_baru_confirmation', 'eye3')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="eye3" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password_baru_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">Tips Password yang Aman:</p>
                            <ul class="list-disc list-inside space-y-1 text-xs">
                                <li>Gunakan minimal 6 karakter</li>
                                <li>Kombinasikan huruf, angka, dan simbol</li>
                                <li>Jangan gunakan password yang mudah ditebak</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
                    <button type="submit" class="bg-brand-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-pink-600 transition shadow-sm flex items-center">
                        <i class="fas fa-key mr-2"></i>
                        Ubah Password
                    </button>
                    <a href="{{ url('admin/v2') }}" class="px-6 py-3 rounded-lg font-semibold border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById(eyeId);
    
    if (input.type === 'password') {
        input.type = 'text';
        eye.classList.remove('fa-eye');
        eye.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        eye.classList.remove('fa-eye-slash');
        eye.classList.add('fa-eye');
    }
}
</script>
@endsection
