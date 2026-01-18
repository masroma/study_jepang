@extends('admin.layout.main')

@section('title', 'Edit Program Masa Depan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Program Masa Depan</h1>
        <a href="{{ url('admin/program-masa-depan') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Program</h6>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/program-masa-depan/edit_proses/'.$program->id_program) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="judul">Judul Program</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul', $program->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $program->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                           id="lokasi" name="lokasi" value="{{ old('lokasi', $program->lokasi) }}">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durasi">Durasi</label>
                                    <input type="text" class="form-control @error('durasi') is-invalid @enderror" 
                                           id="durasi" name="durasi" value="{{ old('durasi', $program->durasi) }}">
                                    @error('durasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="visa">Visa</label>
                                    <input type="text" class="form-control @error('visa') is-invalid @enderror" 
                                           id="visa" name="visa" value="{{ old('visa', $program->visa) }}">
                                    @error('visa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gaji">Gaji</label>
                                    <input type="text" class="form-control @error('gaji') is-invalid @enderror" 
                                           id="gaji" name="gaji" value="{{ old('gaji', $program->gaji) }}">
                                    @error('gaji')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sertifikat">Sertifikat</label>
                            <input type="text" class="form-control @error('sertifikat') is-invalid @enderror" 
                                   id="sertifikat" name="sertifikat" value="{{ old('sertifikat', $program->sertifikat) }}">
                            @error('sertifikat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                   id="gambar" name="gambar" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                            
                            @if($program->gambar)
                                <div class="mt-2">
                                    <small class="text-muted">Gambar saat ini:</small><br>
                                    <img src="{{ asset('uploads/program/'.$program->gambar) }}" class="img-thumbnail" width="100" height="100">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="urutan">Urutan</label>
                            <input type="number" class="form-control @error('urutan') is-invalid @enderror" 
                                   id="urutan" name="urutan" value="{{ old('urutan', $program->urutan) }}" min="0">
                            @error('urutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="Publish" {{ old('status', $program->status) == 'Publish' ? 'selected' : '' }}>Publish</option>
                                <option value="Draft" {{ old('status', $program->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ url('admin/program-masa-depan') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
