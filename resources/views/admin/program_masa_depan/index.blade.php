<p class="text-right">
  <a href="{{ asset('admin/program-masa-depan/tambah') }}" class="btn btn-success btn-sm">
    <i class="fa fa-plus"></i> Tambah Program
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
                <th>Gambar</th>
                <th>Nama Program</th>
                <th>Deskripsi</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($programs as $program)
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                    @if($program->gambar)
                        <img src="{{ asset('uploads/program/'.$program->gambar) }}" class="img-thumbnail" width="60" height="60">
                    @else
                        <img src="https://via.placeholder.com/60x60" class="img-thumbnail" width="60" height="60">
                    @endif
                </td>
                <td>{{ $program->nama_program }}</td>
                <td>{{ Str::limit($program->deskripsi, 100) }}</td>
                <td>{{ $program->urutan }}</td>
                <td>
                    <span class="badge badge-{{ $program->status == 'Publish' ? 'success' : 'warning' }}">
                        {{ $program->status }}
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ asset('admin/program-masa-depan/edit/'.$program->id_program) }}" class="btn btn-sm btn-info">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ asset('admin/program-masa-depan/delete/'.$program->id_program) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus program ini?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data program</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
