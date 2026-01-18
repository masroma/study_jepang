<p>
  <a href="{{ asset('admin/kontak') }}" class="btn btn-primary">
    <i class="fa fa-arrow-left"></i> Kembali</a>
</p>

<hr>

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Detail Pesan Kontak</h3>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <tr>
            <td width="20%">Tanggal</td>
            <td>: {{ tanggal_ind($kontak->tanggal_kontak) }}</td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>: {{ $kontak->nama }}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>: {{ $kontak->email }}</td>
          </tr>
          <tr>
            <td>Telepon</td>
            <td>: {{ $kontak->telepon }}</td>
          </tr>
          <tr>
            <td>Subjek</td>
            <td>: {{ $kontak->subjek }}</td>
          </tr>
          <tr>
            <td>Pesan</td>
            <td>: {{ $kontak->pesan }}</td>
          </tr>
          <tr>
            <td>Status</td>
            <td>:
              <?php if($kontak->status_kontak=='Baru') { ?>
              <span class="badge badge-danger">Baru</span>
              <?php }else{ ?>
              <span class="badge badge-success">Dibaca</span>
              <?php } ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>