<p class="text-right">
  <a href="{{ asset('admin/loker') }}" class="btn btn-success btn-sm">
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

<form action="{{ asset('admin/loker/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id_loker" value="{{ $loker->id_loker }}">

<div class="row form-group">
  <label class="col-md-3 text-right">Judul Lowongan *</label>
  <div class="col-md-9">
    <input type="text" name="judul_loker" class="form-control" value="{{ old('judul_loker', $loker->judul_loker) }}" required>
    @error('judul_loker')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Posisi *</label>
  <div class="col-md-9">
    <input type="text" name="posisi" class="form-control" value="{{ old('posisi', $loker->posisi) }}" placeholder="Contoh: Instruktur Bahasa Jepang" required>
    @error('posisi')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Deskripsi Singkat</label>
  <div class="col-md-9">
    <textarea name="deskripsi_singkat" class="form-control" rows="3">{{ old('deskripsi_singkat', $loker->deskripsi_singkat) }}</textarea>
    <small class="text-muted">Ringkasan singkat tentang lowongan (opsional)</small>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Isi Lowongan *</label>
  <div class="col-md-9">
    <textarea name="isi_loker" class="form-control" rows="10" required>{{ old('isi_loker', $loker->isi_loker) }}</textarea>
    @error('isi_loker')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Lokasi Kerja</label>
  <div class="col-md-9">
    <input type="text" name="lokasi_kerja" class="form-control" value="{{ old('lokasi_kerja', $loker->lokasi_kerja) }}" placeholder="Contoh: Jakarta, Bandung, Online">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Tipe Kerja</label>
  <div class="col-md-9">
    <select name="tipe_kerja" class="form-control">
      <option value="">Pilih Tipe Kerja</option>
      <option value="Full-time" {{ old('tipe_kerja', $loker->tipe_kerja) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
      <option value="Part-time" {{ old('tipe_kerja', $loker->tipe_kerja) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
      <option value="Contract" {{ old('tipe_kerja', $loker->tipe_kerja) == 'Contract' ? 'selected' : '' }}>Contract</option>
      <option value="Freelance" {{ old('tipe_kerja', $loker->tipe_kerja) == 'Freelance' ? 'selected' : '' }}>Freelance</option>
    </select>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Persyaratan</label>
  <div class="col-md-9">
    <textarea name="persyaratan" class="form-control" rows="5">{{ old('persyaratan', $loker->persyaratan) }}</textarea>
    <small class="text-muted">Sebutkan persyaratan yang dibutuhkan</small>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Tanggung Jawab</label>
  <div class="col-md-9">
    <textarea name="tanggung_jawab" class="form-control" rows="5">{{ old('tanggung_jawab', $loker->tanggung_jawab) }}</textarea>
    <small class="text-muted">Sebutkan tanggung jawab pekerjaan</small>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Tanggal Mulai</label>
  <div class="col-md-9">
    <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $loker->tanggal_mulai) }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Tanggal Selesai</label>
  <div class="col-md-9">
    <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $loker->tanggal_selesai) }}">
    <small class="text-muted">Kosongkan jika tidak ada batas waktu</small>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Gambar</label>
  <div class="col-md-9">
    @if($loker->gambar)
      <div class="mb-2">
        <img src="{{ asset('assets/upload/image/loker/'.$loker->gambar) }}" class="img-thumbnail" width="200">
        <br><small class="text-muted">Gambar saat ini</small>
      </div>
    @endif
    <input type="file" name="gambar" class="form-control" accept="image/*">
    <small class="text-muted">Format: JPG, PNG, GIF (Max: 2MB). Kosongkan jika tidak ingin mengubah gambar</small>
    @error('gambar')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Urutan</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $loker->urutan) }}" min="0">
    <small class="text-muted">Angka untuk urutan tampil (0 = terakhir)</small>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Status *</label>
  <div class="col-md-9">
    <select name="status_loker" class="form-control" required>
      <option value="Publish" {{ old('status_loker', $loker->status_loker) == 'Publish' ? 'selected' : '' }}>Publish</option>
      <option value="Draft" {{ old('status_loker', $loker->status_loker) == 'Draft' ? 'selected' : '' }}>Draft</option>
      <option value="Tutup" {{ old('status_loker', $loker->status_loker) == 'Tutup' ? 'selected' : '' }}>Tutup</option>
    </select>
    @error('status_loker')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <div class="col-md-12 text-center">
    <button type="submit" class="btn btn-success">
      <i class="fa fa-save"></i> Update
    </button>
    <a href="{{ asset('admin/loker') }}" class="btn btn-danger">
      <i class="fa fa-times"></i> Batal
    </a>
  </div>
</div>

</form>
