@extends('member.layout.wrapper')

@section('page-title', 'Dashboard Mitra')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-brand-pink to-pink-600 rounded-xl p-6 text-white">
        <h2 class="text-2xl font-bold mb-2">Dashboard Mitra - {{ session('nama') }}</h2>
        <p class="text-pink-100">Kelola referal dan komisi Anda untuk mendapatkan passive income</p>
    </div>

    <!-- Saldo Card -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-green-100 font-medium mb-2">Saldo Tersedia</p>
                <p class="text-4xl font-bold mb-1">Rp {{ number_format($mitra->saldo, 0, ',', '.') }}</p>
                <p class="text-sm text-green-100">Siap untuk withdraw</p>
            </div>
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-wallet text-3xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-white/20">
            <div class="flex items-center justify-between text-sm">
                <span class="text-green-100">Total Komisi:</span>
                <span class="font-bold">Rp {{ number_format($stats['total_komisi'] ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between text-sm mt-2">
                <span class="text-green-100">Total Withdraw:</span>
                <span class="font-bold">Rp {{ number_format($stats['total_withdraw'] ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Referal -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Referal</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_referal'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Semua referal</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Referal Pending -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Pending</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['referal_pending'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Menunggu konfirmasi</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Referal Diterima -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Diterima</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['referal_diterima'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Referal berhasil</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Komisi Paid -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Komisi Paid</p>
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($stats['komisi_paid'] ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-1">Komisi diterima</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Kode Referal -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Kode Referal Anda</h3>
        <div class="flex items-center space-x-4">
            <div class="flex-1 bg-gray-50 rounded-lg p-4 border-2 border-dashed border-gray-300">
                <p class="text-sm text-gray-500 mb-1">Bagikan kode ini untuk mendapatkan komisi</p>
                <div class="flex items-center space-x-3">
                    <code class="text-2xl font-bold text-brand-pink">{{ $mitra->kode_referal }}</code>
                    <button onclick="copyReferalCode('{{ $mitra->kode_referal }}')" class="text-brand-pink hover:text-brand-pink/80 transition">
                        <i class="fas fa-copy text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <a href="{{ url('member/mitra/referal/tambah') }}" class="bg-brand-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-pink-600 transition text-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Referal
                </a>
                <a href="{{ url('member/mitra/withdraw') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition text-center">
                    <i class="fas fa-money-bill-wave mr-2"></i>
                    Withdraw
                </a>
            </div>
        </div>
    </div>

    <!-- Referal Terbaru -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Referal Terbaru</h3>
                <a href="{{ url('member/mitra/referal') }}" class="text-sm text-brand-pink hover:underline">Lihat Semua</a>
            </div>
        </div>
        <div class="p-6">
            @if($referal_terbaru && $referal_terbaru->count() > 0)
                <div class="space-y-4">
                    @foreach($referal_terbaru as $ref)
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-brand-pink rounded-lg flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900">{{ $ref->nama }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $ref->email }} | {{ $ref->telepon }}</p>
                            <p class="text-xs text-gray-400 mt-1">Program: {{ $ref->program }} | {{ date('d M Y', strtotime($ref->tanggal)) }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            @if($ref->status == 'Pending')
                                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Pending</span>
                            @elseif($ref->status == 'Diterima')
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Diterima</span>
                            @elseif($ref->status == 'Ditolak')
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Ditolak</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500 text-sm">Belum ada referal</p>
                    <a href="{{ url('member/mitra/referal/tambah') }}" class="text-brand-pink hover:underline text-sm mt-2 inline-block">Tambah Referal Pertama</a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function copyReferalCode(code) {
    navigator.clipboard.writeText(code).then(function() {
        alert('Kode referal berhasil disalin: ' + code);
    }, function() {
        // Fallback untuk browser yang tidak support clipboard API
        const textarea = document.createElement('textarea');
        textarea.value = code;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        alert('Kode referal berhasil disalin: ' + code);
    });
}
</script>
@endsection
