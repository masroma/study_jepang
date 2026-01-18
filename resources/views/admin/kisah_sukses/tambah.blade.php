<p class="text-right">
  <a href="{{ asset('admin/kisah-sukses') }}" class="btn btn-success btn-sm">
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

<form action="{{ asset('admin/kisah-sukses/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}

<div class="row form-group">
  <label class="col-md-3 text-right">Nama Alumni</label>
  <div class="col-md-9">
    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
    @error('nama')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Pekerjaan</label>
  <div class="col-md-9">
    <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}" required>
    @error('pekerjaan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Lokasi</label>
  <div class="col-md-9">
    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}" required>
    @error('lokasi')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Testimoni</label>
  <div class="col-md-9">
    <textarea name="testimoni" class="form-control" rows="5" required>{{ old('testimoni') }}</textarea>
    @error('testimoni')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Program</label>
  <div class="col-md-9">
    <select name="program" class="form-control">
      <option value="">Pilih Program</option>
      <option value="JLPT N3" {{ old('program') == 'JLPT N3' ? 'selected' : '' }}>JLPT N3</option>
      <option value="JLPT N2" {{ old('program') == 'JLPT N2' ? 'selected' : '' }}>JLPT N2</option>
      <option value="JLPT N1" {{ old('program') == 'JLPT N1' ? 'selected' : '' }}>JLPT N1</option>
      <option value="Tokutei Ginou" {{ old('program') == 'Tokutei Ginou' ? 'selected' : '' }}>Tokutei Ginou</option>
      <option value="Caregiver" {{ old('program') == 'Caregiver' ? 'selected' : '' }}>Caregiver</option>
      <option value="Internship" {{ old('program') == 'Internship' ? 'selected' : '' }}>Internship</option>
      <option value="Magang" {{ old('program') == 'Magang' ? 'selected' : '' }}>Magang</option>
    </select>
    @error('program')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Tahun</label>
  <div class="col-md-9">
    <input type="number" name="tahun" class="form-control" value="{{ old('tahun') }}" min="2000" max="{{ date('Y') }}">
    @error('tahun')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Rating</label>
  <div class="col-md-9">
    <select name="rating" class="form-control">
      <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
      <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
      <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
      <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>⭐⭐ (2)</option>
      <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>⭐ (1)</option>
    </select>
    @error('rating')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Video URL (YouTube)</label>
  <div class="col-md-9">
    <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="https://youtube.com/watch?v=...">
    @error('video_url')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Upload Video File</label>
  <div class="col-md-9">
    <input type="file" name="video_file" class="form-control" accept="video/mp4,video/avi,video/mov,video/wmv">
    <small class="text-muted">Format: MP4, AVI, MOV, WMV (Max: 10MB)</small>
    @error('video_file')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

                        <div class="row form-group">
  <label class="col-md-3 text-right">Foto</label>
  <div class="col-md-9">
    <input type="file" name="foto" class="form-control" accept="image/*">
    <small class="text-muted">Format: JPG, PNG, GIF (Max: 2MB)</small>
    @error('foto')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Urutan</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
    @error('urutan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3 text-right">Status</label>
  <div class="col-md-9">
    <select name="status" class="form-control" required>
      <option value="Publish" {{ old('status') == 'Publish' ? 'selected' : '' }}>Publish</option>
      <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
    </select>
    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>

<div class="row form-group">
  <div class="col-md-12 text-center">
    <button type="submit" class="btn btn-success">
      <i class="fa fa-save"></i> Simpan
    </button>
    <a href="{{ asset('admin/kisah-sukses') }}" class="btn btn-danger">
      <i class="fa fa-times"></i> Batal
    </a>
  </div>
</div>

</form>
