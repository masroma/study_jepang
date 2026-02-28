@extends('admin.v2.layout.wrapper')

@section('page-title', 'Setting Komisi Mitra')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Setting Komisi Mitra</h2>

        <form action="{{ url('admin/v2/mitra/setting-komisi/update') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Setting Komisi Kerja -->
                <div class="border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Komisi Program Kerja</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Komisi *</label>
                            <select name="kerja_tipe" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink">
                                <option value="Nominal" {{ ($settings->where('jenis', 'Kerja')->first()->tipe_komisi ?? 'Nominal') == 'Nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                                <option value="Persentase" {{ ($settings->where('jenis', 'Kerja')->first()->tipe_komisi ?? '') == 'Persentase' ? 'selected' : '' }}>Persentase (%)</option>
                            </select>
                        </div>
                        <div id="kerja_nominal_field">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nominal Komisi (Rp) *</label>
                            <input type="number" name="kerja_nominal" value="{{ $settings->where('jenis', 'Kerja')->first()->nominal_komisi ?? '' }}" min="0" step="1000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink">
                        </div>
                        <div id="kerja_persentase_field" style="display: none;">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Persentase Komisi (%) *</label>
                            <input type="number" name="kerja_persentase" value="{{ $settings->where('jenis', 'Kerja')->first()->persentase_komisi ?? '' }}" min="0" max="100" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink">
                        </div>
                    </div>
                </div>

                <!-- Setting Komisi Pendidikan -->
                <div class="border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Komisi Program Pendidikan</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Komisi *</label>
                            <select name="pendidikan_tipe" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink">
                                <option value="Nominal" {{ ($settings->where('jenis', 'Pendidikan')->first()->tipe_komisi ?? 'Nominal') == 'Nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                                <option value="Persentase" {{ ($settings->where('jenis', 'Pendidikan')->first()->tipe_komisi ?? '') == 'Persentase' ? 'selected' : '' }}>Persentase (%)</option>
                            </select>
                        </div>
                        <div id="pendidikan_nominal_field">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nominal Komisi (Rp) *</label>
                            <input type="number" name="pendidikan_nominal" value="{{ $settings->where('jenis', 'Pendidikan')->first()->nominal_komisi ?? '' }}" min="0" step="1000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink">
                        </div>
                        <div id="pendidikan_persentase_field" style="display: none;">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Persentase Komisi (%) *</label>
                            <input type="number" name="pendidikan_persentase" value="{{ $settings->where('jenis', 'Pendidikan')->first()->persentase_komisi ?? '' }}" min="0" max="100" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center space-x-4">
                <button type="submit" class="bg-brand-pink text-white px-8 py-3 rounded-lg font-semibold hover:bg-pink-600 transition">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Setting
                </button>
                <a href="{{ url('admin/v2/mitra') }}" class="text-gray-600 hover:text-gray-900 transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kerjaTipe = document.querySelector('select[name="kerja_tipe"]');
    const pendidikanTipe = document.querySelector('select[name="pendidikan_tipe"]');
    
    function toggleFields(tipeSelect, nominalField, persentaseField) {
        if(tipeSelect.value === 'Nominal') {
            nominalField.style.display = 'block';
            persentaseField.style.display = 'none';
            nominalField.querySelector('input').required = true;
            persentaseField.querySelector('input').required = false;
        } else {
            nominalField.style.display = 'none';
            persentaseField.style.display = 'block';
            nominalField.querySelector('input').required = false;
            persentaseField.querySelector('input').required = true;
        }
    }
    
    kerjaTipe.addEventListener('change', function() {
        toggleFields(this, document.getElementById('kerja_nominal_field'), document.getElementById('kerja_persentase_field'));
    });
    
    pendidikanTipe.addEventListener('change', function() {
        toggleFields(this, document.getElementById('pendidikan_nominal_field'), document.getElementById('pendidikan_persentase_field'));
    });
    
    // Initialize
    toggleFields(kerjaTipe, document.getElementById('kerja_nominal_field'), document.getElementById('kerja_persentase_field'));
    toggleFields(pendidikanTipe, document.getElementById('pendidikan_nominal_field'), document.getElementById('pendidikan_persentase_field'));
});
</script>
@endsection
