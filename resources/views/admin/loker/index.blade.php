<p class="text-right">
  <a href="{{ asset('admin/loker/tambah') }}" class="btn btn-success btn-sm">
    <i class="fa fa-plus"></i> Tambah Lowongan
  </a>
</p>
<hr>

@if(session('sukses'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('sukses') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
  <div class="col-md-6">
    <form action="{{ asset('admin/loker/cari') }}" method="get" accept-charset="utf-8">
    <br>
    <div class="input-group">
      <input type="text" name="keywords" class="form-control" placeholder="Ketik kata kunci pencarian...." value="<?php if(isset($_GET['keywords'])) { echo strip_tags($_GET['keywords']); } ?>" required>
      <span class="input-group-btn btn-flat">
        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
      </span>
    </div>
    </form>
  </div>
</div>

<div class="clearfix"><hr></div>

<form action="{{ asset('admin/loker/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
  <input type="hidden" name="pengalihan" value="{{ asset('admin/loker') }}">
<div class="row">
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-btn" >
        <button class="btn btn-danger btn-sm" type="submit" name="hapus" onClick="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?');" >
          <i class="fa fa-trash"></i> Hapus
        </button>
      </span>
      <span class="input-group-btn" >
        <button type="submit" class="btn btn-success btn-sm btn-flat" name="publish">Publish</button>
      </span>
      <span class="input-group-btn" >
        <button type="submit" class="btn btn-warning btn-sm btn-flat" name="draft">Draft</button>
      </span>
      <span class="input-group-btn" >
        <button type="submit" class="btn btn-secondary btn-sm btn-flat" name="tutup">Tutup</button>
      </span>
    </div>
  </div>
</div>

<div class="clearfix"><hr></div>

<div class="table-responsive">
  <table id="example1" class="display table table-bordered table-striped" cellspacing="0" width="100%">
    <thead>
      <tr class="bg-dark">
        <th width="5%">
          <div class="mailbox-controls">
            <button type="button" class="btn btn-default btn-sm checkbox-toggle">
              <i class="fa fa-square-o"></i>
            </button>
          </div>
        </th>
        <th width="10%">GAMBAR</th>
        <th width="25%">JUDUL LOWONGAN</th>
        <th width="15%">POSISI</th>
        <th width="15%">LOKASI</th>
        <th width="10%">TANGGAL</th>
        <th width="10%">STATUS</th>
        <th width="20%">ACTION</th>
      </tr>
    </thead>
    <tbody>

      <?php $no=1; foreach($loker as $loker_item) { ?>

      <tr class="odd gradeX">
        <td>
          <div class="mailbox-controls">
            <input type="checkbox" name="id_loker[]" value="{{ $loker_item->id_loker }}">
          </div>
        </td>
        <td>
          @if($loker_item->gambar)
            <img src="{{ asset('assets/upload/image/loker/'.$loker_item->gambar) }}" class="img-thumbnail" width="80" height="80">
          @else
            <img src="https://via.placeholder.com/80x80" class="img-thumbnail" width="80" height="80">
          @endif
        </td>
        <td>{{ $loker_item->judul_loker }}</td>
        <td>{{ $loker_item->posisi }}</td>
        <td>{{ $loker_item->lokasi_kerja ?? '-' }}</td>
        <td>
          {{ date('d M Y', strtotime($loker_item->tanggal_mulai)) }}
          @if($loker_item->tanggal_selesai)
            <br><small>- {{ date('d M Y', strtotime($loker_item->tanggal_selesai)) }}</small>
          @endif
        </td>
        <td>
          <?php if($loker_item->status_loker=='Publish') { ?>
          <span class="badge badge-success">Publish</span>
          <?php }elseif($loker_item->status_loker=='Draft'){ ?>
          <span class="badge badge-warning">Draft</span>
          <?php }else{ ?>
          <span class="badge badge-secondary">Tutup</span>
          <?php } ?>
        </td>
        <td>
          <div class="btn-group">
            <a href="{{ asset('admin/loker/edit/'.$loker_item->id_loker) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Edit</a>
            <a href="{{ asset('admin/loker/delete/'.$loker_item->id_loker) }}" class="btn btn-danger btn-sm" onClick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash-o"></i> Hapus</a>
          </div>
        </td>
      </tr>

      <?php $no++; } ?>

    </tbody>
  </table>
</div>
</form>
