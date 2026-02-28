@extends('admin.v2.layout.wrapper')

@section('page-title', 'Komisi Mitra')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Komisi Mitra</h2>
            <p class="text-sm text-gray-600 mt-1">Detail komisi untuk {{ $mitra->user->nama ?? 'Mitra' }}</p>
        </div>
        <a href="{{ url('admin/v2/mitra') }}" class="text-gray-600 hover:text-gray-900 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <!-- Info Mitra -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-500 mb-1">Nama Mitra</p>
                <p class="text-lg font-semibold text-gray-900">{{ $mitra->user->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Kode Referal</p>
                <p class="text-lg font-semibold text-gray-900"><code class="bg-gray-100 px-2 py-1 rounded">{{ $mitra->kode_referal }}</code></p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Saldo Tersedia</p>
                <p class="text-lg font-semibold text-green-600">Rp {{ number_format($mitra->saldo, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- List Komisi -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Riwayat Komisi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Referal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Komisi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($komisis as $kom)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $kom->referal->nama ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $kom->referal->email ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ ($kom->referal->program ?? 'Kerja') == 'Kerja' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                {{ $kom->referal->program ?? 'Kerja' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-green-600">Rp {{ number_format($kom->jumlah_komisi, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($kom->status == 'Paid')
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Paid</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('d M Y H:i', strtotime($kom->tanggal)) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $kom->keterangan ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500 text-sm">Belum ada komisi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Summary -->
    @if($komisis->count() > 0)
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-green-100 mb-1">Total Komisi</p>
                <p class="text-2xl font-bold">Rp {{ number_format($komisis->sum('jumlah_komisi'), 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-green-100 mb-1">Komisi Paid</p>
                <p class="text-2xl font-bold">Rp {{ number_format($komisis->where('status', 'Paid')->sum('jumlah_komisi'), 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-green-100 mb-1">Total Transaksi</p>
                <p class="text-2xl font-bold">{{ $komisis->count() }}</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
