@extends('admin.layout.main')

@section('title', 'Edit Industri')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Industri</h1>
        <a href="{{ url('admin/industri') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Industri</h6>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/industri/edit_proses/'.$industry->id_industri) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nama">Nama Industri</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama', $industry->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sub_nama">Sub Nama</label>
                            <input type="text" class="form-control @error('sub_nama') is-invalid @enderror" 
                                   id="sub_nama" name="sub_nama" value="{{ old('sub_nama', $industry->sub_nama) }}">
                            @error('sub_nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $industry->deskripsi) }}</textarea>
                            @error('deskripsi')
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
                            
                            @if($industry->gambar)
                                <div class="mt-2">
                                    <small class="text-muted">Gambar saat ini:</small><br>
                                    <img src="{{ asset('uploads/industri/'.$industry->gambar) }}" class="img-thumbnail" width="100" height="100">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="urutan">Urutan</label>
                            <input type="number" class="form-control @error('urutan') is-invalid @enderror" 
                                   id="urutan" name="urutan" value="{{ old('urutan', $industry->urutan) }}" min="0">
                            @error('urutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="Publish" {{ old('status', $industry->status) == 'Publish' ? 'selected' : '' }}>Publish</option>
                                <option value="Draft" {{ old('status', $industry->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
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
                    <a href="{{ url('admin/industri') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
