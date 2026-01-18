<div class="row">

  <div class="col-md-6">
    <form action="{{ asset('admin/kontak/cari') }}" method="get" accept-charset="utf-8">
    <br>
    <div class="input-group">
      <input type="text" name="keywords" class="form-control" placeholder="Ketik kata kunci pencarian pesan...." value="<?php if(isset($_GET['keywords'])) { echo strip_tags($_GET['keywords']); } ?>" required>
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

<form action="{{ asset('admin/kontak/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<div class="row">
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-btn" >
        <button class="btn btn-danger btn-sm" type="submit" name="hapus" onClick="check();" >
          <i class="fa fa-trash"></i>
        </button>
      </span>
      <span class="input-group-btn" >
        <button type="submit" class="btn btn-info btn-sm btn-flat" name="update">Update Status Dibaca</button>
      </span>
    </div>
  </div>

  <div class="col-md-8">
    <div class="btn-group">
      {{ $kontak->links() }}
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
        <th width="15%">NAMA</th>
        <th width="15%">EMAIL</th>
        <th width="20%">SUBJEK</th>
        <th width="10%">STATUS</th>
        <th width="25%">ACTION</th>
      </tr>
    </thead>
    <tbody>

      <?php $no=1; foreach($kontak as $kontak_item) { ?>

      <tr class="odd gradeX">
        <td>
          <div class="mailbox-controls">
            <input type="checkbox" name="id_kontak[]" value="{{ $kontak_item->id_kontak }}">
          </div>
        </td>
        <td>{{ tanggal_ind($kontak_item->tanggal_kontak) }}</td>
        <td>{{ $kontak_item->nama }}</td>
        <td>{{ $kontak_item->email }}</td>
        <td>{{ $kontak_item->subjek }}</td>
        <td>
          <?php if($kontak_item->status_kontak=='Baru') { ?>
          <span class="badge badge-danger">Baru</span>
          <?php }else{ ?>
          <span class="badge badge-success">Dibaca</span>
          <?php } ?>
        </td>
        <td>
          <div class="btn-group">
            <a href="{{ asset('admin/kontak/detail/'.$kontak_item->id_kontak) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Lihat</a>
            <a href="{{ asset('admin/kontak/delete/'.$kontak_item->id_kontak) }}" class="btn btn-danger btn-sm" onClick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash-o"></i> Hapus</a>
          </div>
        </td>
      </tr>

      <?php $no++; } ?>

    </tbody>
  </table>
</div>
</form>