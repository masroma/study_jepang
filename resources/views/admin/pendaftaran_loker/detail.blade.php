<p class="text-right">
  <a href="{{ asset('admin/pendaftaran-loker') }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
</p>
<hr>

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4>Detail Pendaftaran</h4>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <tr>
            <th width="30%">Tanggal Pendaftaran</th>
            <td>{{ tanggal_ind($pendaftaran->tanggal_pendaftaran) }}</td>
          </tr>
          <tr>
            <th>Nama</th>
            <td><strong>{{ $pendaftaran->nama }}</strong></td>
          </tr>
          <tr>
            <th>Email</th>
            <td>{{ $pendaftaran->email }}</td>
          </tr>
          <tr>
            <th>Telepon</th>
            <td>{{ $pendaftaran->telepon }}</td>
          </tr>
          <tr>
            <th>WhatsApp</th>
            <td>
              @if($pendaftaran->whatsapp)
              <a href="https://wa.me/{{ str_replace(['+', '-', ' ', '(', ')'], '', $pendaftaran->whatsapp) }}" target="_blank" class="btn btn-success btn-sm">
                <i class="fa fa-whatsapp"></i> {{ $pendaftaran->whatsapp }}
              </a>
              @else
              <span class="text-muted">-</span>
              @endif
            </td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td>{{ $pendaftaran->alamat ?? '-' }}</td>
          </tr>
          <tr>
            <th>Pendidikan Terakhir</th>
            <td>{{ $pendaftaran->pendidikan_terakhir ?? '-' }}</td>
          </tr>
          <tr>
            <th>Lowongan yang Didaftar</th>
            <td>
              <strong>{{ $pendaftaran->judul_loker }}</strong><br>
              <small>Posisi: {{ $pendaftaran->posisi }}</small>
            </td>
          </tr>
          <tr>
            <th>Status</th>
            <td>
              <?php if($pendaftaran->status_pendaftaran=='Baru') { ?>
              <span class="badge badge-danger">Baru</span>
              <?php }elseif($pendaftaran->status_pendaftaran=='Dibaca'){ ?>
              <span class="badge badge-info">Dibaca</span>
              <?php }elseif($pendaftaran->status_pendaftaran=='Diproses'){ ?>
              <span class="badge badge-warning">Diproses</span>
              <?php }elseif($pendaftaran->status_pendaftaran=='Diterima'){ ?>
              <span class="badge badge-success">Diterima</span>
              <?php }else{ ?>
              <span class="badge badge-secondary">Ditolak</span>
              <?php } ?>
            </td>
          </tr>
        </table>
      </div>
    </div>

    @if($pendaftaran->pengalaman)
    <div class="card mt-3">
      <div class="card-header">
        <h4>Pengalaman</h4>
      </div>
      <div class="card-body">
        {!! nl2br(e($pendaftaran->pengalaman)) !!}
      </div>
    </div>
    @endif

    @if($pendaftaran->catatan)
    <div class="card mt-3">
      <div class="card-header">
        <h4>Catatan</h4>
      </div>
      <div class="card-body">
        {!! nl2br(e($pendaftaran->catatan)) !!}
      </div>
    </div>
    @endif
  </div>

  <div class="col-md-4">
    @if($pendaftaran->cv_file)
    <div class="card">
      <div class="card-header">
        <h4>CV / Resume</h4>
      </div>
      <div class="card-body text-center">
        <a href="{{ asset('assets/upload/file/cv/'.$pendaftaran->cv_file) }}" target="_blank" class="btn btn-primary btn-block">
          <i class="fa fa-download"></i> Download CV
        </a>
        <small class="text-muted">{{ $pendaftaran->cv_file }}</small>
      </div>
    </div>
    @endif

    <div class="card mt-3">
      <div class="card-header">
        <h4>Aksi</h4>
      </div>
      <div class="card-body">
        <a href="{{ asset('loker/detail/'.$pendaftaran->slug_loker) }}" target="_blank" class="btn btn-info btn-block mb-2">
          <i class="fa fa-eye"></i> Lihat Lowongan
        </a>
        <a href="{{ asset('admin/pendaftaran-loker/delete/'.$pendaftaran->id_pendaftaran) }}" class="btn btn-danger btn-block" onClick="return confirm('Apakah anda yakin?')">
          <i class="fa fa-trash"></i> Hapus Pendaftaran
        </a>
      </div>
    </div>
  </div>
</div>
