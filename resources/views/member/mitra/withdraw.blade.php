@extends('member.layout.wrapper')

@section('page-title', 'Withdraw')

@section('content')
<div class="space-y-6">
    <!-- Saldo Card -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-green-100 font-medium mb-2">Saldo Tersedia</p>
                <p class="text-4xl font-bold mb-1">Rp {{ number_format($mitra->saldo, 0, ',', '.') }}</p>
                <p class="text-sm text-green-100">Minimum withdraw: Rp 50.000</p>
            </div>
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-wallet text-3xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Form Withdraw -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Ajukan Withdraw</h3>

            <form action="{{ url('member/mitra/withdraw/proses') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Withdraw *</label>
                        <input type="number" name="jumlah" required min="50000" step="1000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent" placeholder="Minimum Rp 50.000">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bank *</label>
                        <input type="text" name="bank" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent" placeholder="Contoh: BCA, Mandiri, BRI">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Rekening *</label>
                        <input type="text" name="rekening" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent" placeholder="Nomor rekening">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Rekening *</label>
                        <input type="text" name="nama_rekening" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-pink focus:border-transparent" placeholder="Nama pemilik rekening">
                    </div>

                    <button type="submit" class="w-full bg-brand-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-pink-600 transition">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Ajukan Withdraw
                    </button>
                </div>
            </form>
        </div>

        <!-- History Withdraw -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Riwayat Withdraw</h3>

            <div class="space-y-4">
                @forelse($withdraws as $wd)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-lg font-bold text-gray-900">Rp {{ number_format($wd->jumlah, 0, ',', '.') }}</span>
                        @if($wd->status == 'Pending')
                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Pending</span>
                        @elseif($wd->status == 'Diproses')
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Diproses</span>
                        @elseif($wd->status == 'Selesai')
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Selesai</span>
                        @elseif($wd->status == 'Ditolak')
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Ditolak</span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p><strong>Bank:</strong> {{ $wd->bank }}</p>
                        <p><strong>Rekening:</strong> {{ $wd->rekening }} - {{ $wd->nama_rekening }}</p>
                        <p><strong>Tanggal:</strong> {{ date('d M Y H:i', strtotime($wd->tanggal)) }}</p>
                        @if($wd->catatan)
                        <p class="text-red-600"><strong>Catatan:</strong> {{ $wd->catatan }}</p>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500 text-sm">Belum ada riwayat withdraw</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
