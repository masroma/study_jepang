<div class="row">

  <div class="col-md-6">
    <form action="{{ asset('admin/pendaftaran-loker/cari') }}" method="get" accept-charset="utf-8">
    <br>
    <div class="input-group">
      <input type="text" name="keywords" class="form-control" placeholder="Ketik kata kunci pencarian...." value="<?php if(isset($_GET['keywords'])) { echo strip_tags($_GET['keywords']); } ?>" required>
      <span class="input-group-btn btn-flat">
        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
      </span>
    </div>
    </form>
  </div>
  <div class="col-md-6 text-left">

  </div>
</div>

<div class="clearfix"><hr></div>

<form action="{{ asset('admin/pendaftaran-loker/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<div class="row">
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-btn" >
        <button class="btn btn-danger btn-sm" type="submit" name="hapus" onClick="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?');" >
          <i class="fa fa-trash"></i> Hapus
        </button>
      </span>
      <span class="input-group-btn" >
        <button type="submit" class="btn btn-info btn-sm btn-flat" name="update">Update Status Dibaca</button>
      </span>
    </div>
  </div>
</div>

<div class="clearfix"><hr></div>

<div class="table-responsive mailbox-messages">
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
        <th width="10%">TANGGAL</th>
        <th width="12%">NAMA</th>
        <th width="12%">EMAIL</th>
        <th width="10%">TELEPON</th>
        <th width="10%">WHATSAPP</th>
        <th width="18%">LOWONGAN</th>
        <th width="8%">STATUS</th>
        <th width="20%">ACTION</th>
      </tr>
    </thead>
    <tbody>

      <?php $no=1; foreach($pendaftaran as $pendaftaran_item) { ?>

      <tr class="odd gradeX">
        <td>
          <div class="mailbox-controls">
            <input type="checkbox" name="id_pendaftaran[]" value="{{ $pendaftaran_item->id_pendaftaran }}">
          </div>
        </td>
        <td>{{ tanggal_ind($pendaftaran_item->tanggal_pendaftaran) }}</td>
        <td>{{ $pendaftaran_item->nama }}</td>
        <td>{{ $pendaftaran_item->email }}</td>
        <td>{{ $pendaftaran_item->telepon }}</td>
        <td>
          @if($pendaftaran_item->whatsapp)
          <a href="https://wa.me/{{ str_replace(['+', '-', ' ', '(', ')'], '', $pendaftaran_item->whatsapp) }}" target="_blank" class="btn btn-success btn-xs">
            <i class="fa fa-whatsapp"></i> {{ $pendaftaran_item->whatsapp }}
          </a>
          @else
          <span class="text-muted">-</span>
          @endif
        </td>
        <td>
          <strong>{{ $pendaftaran_item->judul_loker }}</strong><br>
          <small>{{ $pendaftaran_item->posisi }}</small>
        </td>
        <td>
          <?php if($pendaftaran_item->status_pendaftaran=='Baru') { ?>
          <span class="badge badge-danger">Baru</span>
          <?php }elseif($pendaftaran_item->status_pendaftaran=='Dibaca'){ ?>
          <span class="badge badge-info">Dibaca</span>
          <?php }elseif($pendaftaran_item->status_pendaftaran=='Diproses'){ ?>
          <span class="badge badge-warning">Diproses</span>
          <?php }elseif($pendaftaran_item->status_pendaftaran=='Diterima'){ ?>
          <span class="badge badge-success">Diterima</span>
          <?php }else{ ?>
          <span class="badge badge-secondary">Ditolak</span>
          <?php } ?>
        </td>
        <td>
          <div class="btn-group">
            <a href="{{ asset('admin/pendaftaran-loker/detail/'.$pendaftaran_item->id_pendaftaran) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Lihat</a>
            <a href="{{ asset('admin/pendaftaran-loker/delete/'.$pendaftaran_item->id_pendaftaran) }}" class="btn btn-danger btn-sm" onClick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash-o"></i> Hapus</a>
          </div>
        </td>
      </tr>

      <?php $no++; } ?>

    </tbody>
  </table>
</div>
</form>
