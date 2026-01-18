<p class="text-right">
  <a href="{{ asset('admin/kisah-sukses/tambah') }}" class="btn btn-success btn-sm">
    <i class="fa fa-plus"></i> Tambah Alumni
  </a>
</p>
<hr>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Lokasi</th>
                <th>Program</th>
                <th>Rating</th>
                <th>Tahun</th>
                <th>Video</th>
                <th>Status</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($kisah_sukses as $kisah)
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                    @if($kisah->foto)
                        <img src="{{ asset('uploads/kisah-sukses/'.$kisah->foto) }}" class="img-thumbnail" width="60" height="60">
                    @else
                        <img src="https://via.placeholder.com/60x60" class="img-thumbnail" width="60" height="60">
                    @endif
                </td>
                <td>{{ $kisah->nama }}</td>
                <td>{{ $kisah->pekerjaan }}</td>
                <td>{{ $kisah->lokasi }}</td>
                <td>{{ $kisah->program ?? '-' }}</td>
                <td>
                    <span class="text-warning">{{ $kisah->stars }}</span>
                    <small class="text-muted">({{ $kisah->rating }}/5)</small>
                </td>
                <td>{{ $kisah->tahun ?? '-' }}</td>
                <td>
                    @if($kisah->video_url)
                        <a href="{{ $kisah->video_url }}" target="_blank" class="btn btn-sm btn-info">
                            <i class="fas fa-external-link-alt"></i> YouTube
                        </a>
                    @endif
                    @if($kisah->video_file)
                        <a href="{{ asset('uploads/kisah-sukses/videos/'.$kisah->video_file) }}" target="_blank" class="btn btn-sm btn-success ml-1">
                            <i class="fas fa-video"></i> Video
                        </a>
                    @endif
                    @if(!$kisah->video_url && !$kisah->video_file)
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    <span class="badge badge-{{ $kisah->status == 'Publish' ? 'success' : 'warning' }}">
                        {{ $kisah->status }}
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ asset('admin/kisah-sukses/edit/'.$kisah->id_kisah) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ asset('admin/kisah-sukses/delete/'.$kisah->id_kisah) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kisah sukses ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">Belum ada data kisah sukses</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
