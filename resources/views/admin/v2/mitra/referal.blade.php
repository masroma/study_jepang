@extends('admin.v2.layout.wrapper')

@section('page-title', 'Data Referal Mitra')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Data Referal Mitra</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola dan update status referal dari mitra</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mitra</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Referal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($referals as $ref)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $ref->mitra->user->nama ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $ref->mitra->kode_referal ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $ref->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $ref->email }}</div>
                            <div class="text-xs text-gray-500">{{ $ref->telepon }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $ref->program == 'Kerja' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                {{ $ref->program }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('d M Y', strtotime($ref->tanggal)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($ref->status == 'Pending')
                                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Pending</span>
                            @elseif($ref->status == 'Diterima')
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Diterima</span>
                            @elseif($ref->status == 'Ditolak')
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($ref->status == 'Pending')
                            <form action="{{ url('admin/v2/mitra/referal/update-status/' . $ref->id_referal) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="Diterima">
                                <button type="submit" onclick="return confirm('Yakin ingin menerima referal ini? Komisi akan langsung masuk ke saldo mitra.')" class="text-green-600 hover:text-green-800 mr-2">
                                    <i class="fas fa-check mr-1"></i>
                                    Terima
                                </button>
                            </form>
                            <form action="{{ url('admin/v2/mitra/referal/update-status/' . $ref->id_referal) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" onclick="return confirm('Yakin ingin menolak referal ini?')" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-times mr-1"></i>
                                    Tolak
                                </button>
                            </form>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500 text-sm">Belum ada referal</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
