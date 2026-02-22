@extends('member.layout.wrapper')

@section('page-title', 'Ubah Password')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <!-- Header -->
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900">Ubah Password</h2>
            <p class="text-sm text-gray-500 mt-1">Ganti password akun Anda untuk keamanan yang lebih baik</p>
        </div>

        <!-- Form -->
        <form action="{{ url('member/password/update') }}" method="POST" class="p-6">
            @csrf
            
            <div class="space-y-6">
                <!-- Password Lama -->
                <div>
                    <label for="password_lama" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Lama <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password_lama" 
                               id="password_lama" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent transition pr-12">
                        <button type="button" 
                                onclick="togglePassword('password_lama')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="toggle_password_lama"></i>
                        </button>
                    </div>
                    @error('password_lama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Baru -->
                <div>
                    <label for="password_baru" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password_baru" 
                               id="password_baru" 
                               required
                               minlength="6"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent transition pr-12">
                        <button type="button" 
                                onclick="togglePassword('password_baru')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="toggle_password_baru"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Minimal 6 karakter</p>
                    @error('password_baru')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password Baru -->
                <div>
                    <label for="password_baru_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password_baru_confirmation" 
                               id="password_baru_confirmation" 
                               required
                               minlength="6"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent transition pr-12">
                        <button type="button" 
                                onclick="togglePassword('password_baru_confirmation')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="toggle_password_baru_confirmation"></i>
                        </button>
                    </div>
                    @error('password_baru_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                        <div class="flex-1">
                            <p class="text-sm text-blue-800 font-medium mb-1">Tips Password yang Aman</p>
                            <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
                                <li>Gunakan minimal 6 karakter</li>
                                <li>Kombinasikan huruf, angka, dan karakter khusus</li>
                                <li>Jangan gunakan password yang mudah ditebak</li>
                                <li>Jangan bagikan password Anda kepada siapapun</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                    <a href="{{ url('member/profile') }}" 
                       class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-brand-pink text-white rounded-lg hover:bg-pink-600 transition font-medium">
                        <i class="fas fa-key mr-2"></i>
                        Ubah Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const toggle = document.getElementById('toggle_' + fieldId);
    
    if (field.type === 'password') {
        field.type = 'text';
        toggle.classList.remove('fa-eye');
        toggle.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        toggle.classList.remove('fa-eye-slash');
        toggle.classList.add('fa-eye');
    }
}
</script>
@endsection
