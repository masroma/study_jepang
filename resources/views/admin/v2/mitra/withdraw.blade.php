@extends('admin.v2.layout.wrapper')

@section('page-title', 'List Withdraw Mitra')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">List Withdraw Mitra</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola permintaan withdraw dari mitra</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mitra</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank & Rekening</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($withdraws as $wd)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $wd->mitra->user->nama ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $wd->mitra->kode_referal ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">Rp {{ number_format($wd->jumlah, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $wd->bank }}</div>
                            <div class="text-xs text-gray-500">{{ $wd->rekening }} - {{ $wd->nama_rekening }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('d M Y H:i', strtotime($wd->tanggal)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($wd->status == 'Pending')
                                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Pending</span>
                            @elseif($wd->status == 'Diproses')
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Diproses</span>
                            @elseif($wd->status == 'Selesai')
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Selesai</span>
                            @elseif($wd->status == 'Ditolak')
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($wd->status == 'Pending' || $wd->status == 'Diproses')
                            <form action="{{ url('admin/v2/mitra/withdraw/update-status/' . $wd->id_withdraw) }}" method="POST" class="inline-block">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="text-xs border border-gray-300 rounded px-2 py-1">
                                    <option value="Pending" {{ $wd->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Diproses" {{ $wd->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Selesai" {{ $wd->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Ditolak" {{ $wd->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <textarea name="catatan" placeholder="Catatan (opsional)" class="mt-2 w-full text-xs border border-gray-300 rounded px-2 py-1" rows="2">{{ $wd->catatan ?? '' }}</textarea>
                            </form>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500 text-sm">Belum ada withdraw</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
