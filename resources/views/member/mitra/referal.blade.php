@extends('member.layout.wrapper')

@section('page-title', 'List Referal')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">List Referal</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola semua referal Anda</p>
        </div>
        <a href="{{ url('member/mitra/referal/tambah') }}" class="bg-brand-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-pink-600 transition">
            <i class="fas fa-plus mr-2"></i>
            Tambah Referal
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($referals as $ref)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $ref->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $ref->email }}</div>
                            <div class="text-sm text-gray-500">{{ $ref->telepon }}</div>
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500 text-sm">Belum ada referal</p>
                            <a href="{{ url('member/mitra/referal/tambah') }}" class="text-brand-pink hover:underline text-sm mt-2 inline-block">Tambah Referal Pertama</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
