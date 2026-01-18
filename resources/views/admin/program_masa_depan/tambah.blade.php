<p class="text-right">
  <a href="{{ asset('admin/program-masa-depan') }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
</p>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/program-masa-depan/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}

<div class="row form-group">
  <label class="col-md-3 text-right">Judul Program</label>
  <div class="col-md-6">
    <input type="text" name="judul" class="form-control form-control-lg" placeholder="Judul Program" required value="{{ old('judul') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Gambar</label>
  <div class="col-md-6">
    <input type="file" name="gambar" class="form-control" accept="image/*">
    <small class="text-success">Format: JPG, PNG, GIF (Max: 2MB)</small>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Deskripsi</label>
  <div class="col-md-9">
    <textarea name="deskripsi" class="form-control" rows="5" placeholder="Deskripsi Program">{{ old('deskripsi') }}</textarea>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Lokasi</label>
  <div class="col-md-6">
    <input type="text" name="lokasi" class="form-control" placeholder="Lokasi" value="{{ old('lokasi') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Durasi</label>
  <div class="col-md-6">
    <input type="text" name="durasi" class="form-control" placeholder="Durasi" value="{{ old('durasi') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Visa</label>
  <div class="col-md-6">
    <input type="text" name="visa" class="form-control" placeholder="Jenis Visa" value="{{ old('visa') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Gaji</label>
  <div class="col-md-6">
    <input type="text" name="gaji" class="form-control" placeholder="Estimasi Gaji" value="{{ old('gaji') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Sertifikat</label>
  <div class="col-md-6">
    <input type="text" name="sertifikat" class="form-control" placeholder="Jenis Sertifikat" value="{{ old('sertifikat') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Urutan</label>
  <div class="col-md-3">
    <input type="number" name="urutan" class="form-control" placeholder="Urutan" value="{{ old('urutan', 0) }}" min="0">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Status</label>
  <div class="col-md-6">
    <select name="status" class="form-control" required>
      <option value="Publish" {{ old('status') == 'Publish' ? 'selected' : '' }}>Publish</option>
      <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
    </select>
  </div>
</div>

<div class="row form-group">
  <div class="col-md-12 text-center">
    <button type="submit" class="btn btn-success">
      <i class="fa fa-save"></i> Simpan
    </button>
    <a href="{{ asset('admin/program-masa-depan') }}" class="btn btn-danger">
      <i class="fa fa-times"></i> Batal
    </a>
  </div>
</div>

</form>
