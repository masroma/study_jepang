<p class="text-right">
  <a href="{{ asset('admin/industri/tambah') }}" class="btn btn-success btn-sm">
    <i class="fa fa-plus"></i> Tambah Industri
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
                <th>Logo</th>
                <th>Nama Industri</th>
                <th>Deskripsi</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($industries as $industri)
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                    @if($industri->logo)
                        <img src="{{ asset('uploads/industri/'.$industri->logo) }}" class="img-thumbnail" width="60" height="60">
                    @else
                        <img src="https://via.placeholder.com/60x60" class="img-thumbnail" width="60" height="60">
                    @endif
                </td>
                <td>{{ $industri->nama_industri }}</td>
                <td>{{ Str::limit($industri->deskripsi, 100) }}</td>
                <td>{{ $industri->urutan }}</td>
                <td>
                    <span class="badge badge-{{ $industri->status == 'Publish' ? 'success' : 'warning' }}">
                        {{ $industri->status }}
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ asset('admin/industri/edit/'.$industri->id_industri) }}" class="btn btn-sm btn-info">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ asset('admin/industri/delete/'.$industri->id_industri) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus industri ini?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada data industri</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
