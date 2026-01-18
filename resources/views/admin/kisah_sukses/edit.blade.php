@extends('admin.layout.head')

@section('title', 'Edit Kisah Sukses - ' . ($site_config->namaweb ?? 'Admin'))

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Kisah Sukses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dasbor') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/kisah-sukses') }}">Kisah Sukses</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Kisah Sukses</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/kisah-sukses/edit_proses/'.$kisah->id_kisah) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nama">Nama Alumni</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama', $kisah->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                                   id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $kisah->pekerjaan) }}" required>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi (Kota, Jepang)</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                   id="lokasi" name="lokasi" value="{{ old('lokasi', $kisah->lokasi) }}" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="testimoni">Testimoni</label>
                            <textarea class="form-control @error('testimoni') is-invalid @enderror" 
                                      id="testimoni" name="testimoni" rows="6" required>{{ old('testimoni', $kisah->testimoni) }}</textarea>
                            @error('testimoni')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="program">Program</label>
                                    <select class="form-control @error('program') is-invalid @enderror" 
                                            id="program" name="program">
                                        <option value="">Pilih Program</option>
                                        <option value="JLPT N3" {{ old('program', $kisah->program) == 'JLPT N3' ? 'selected' : '' }}>JLPT N3</option>
                                        <option value="JLPT N2" {{ old('program', $kisah->program) == 'JLPT N2' ? 'selected' : '' }}>JLPT N2</option>
                                        <option value="JLPT N1" {{ old('program', $kisah->program) == 'JLPT N1' ? 'selected' : '' }}>JLPT N1</option>
                                        <option value="Tokutei Ginou" {{ old('program', $kisah->program) == 'Tokutei Ginou' ? 'selected' : '' }}>Tokutei Ginou</option>
                                        <option value="Caregiver" {{ old('program', $kisah->program) == 'Caregiver' ? 'selected' : '' }}>Caregiver</option>
                                        <option value="Internship" {{ old('program', $kisah->program) == 'Internship' ? 'selected' : '' }}>Internship</option>
                                        <option value="Magang" {{ old('program', $kisah->program) == 'Magang' ? 'selected' : '' }}>Magang</option>
                                    </select>
                                    @error('program')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun">Tahun Berangkat</label>
                                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                                           id="tahun" name="tahun" value="{{ old('tahun', $kisah->tahun) }}" min="2000" max="{{ date('Y') }}">
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="video_url">Video Testimoni URL (YouTube)</label>
                            <input type="url" class="form-control @error('video_url') is-invalid @enderror" 
                                   id="video_url" name="video_url" value="{{ old('video_url', $kisah->video_url) }}" placeholder="https://youtube.com/watch?v=...">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Link video YouTube testimoni (opsional)</small>
                        </div>

                        <div class="form-group">
                            <label for="video_file">Upload Video File</label>
                            <input type="file" class="form-control @error('video_file') is-invalid @enderror" 
                                   id="video_file" name="video_file" accept="video/*">
                            @error('video_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Upload video langsung (MP4, AVI, MOV, WMV). Max: 10MB (opsional)</small>
                            
                            @if($kisah->video_file)
                                <div class="mt-2">
                                    <small class="text-muted">Video saat ini:</small><br>
                                    <video width="200" height="150" controls>
                                        <source src="{{ asset('uploads/kisah-sukses/videos/'.$kisah->video_file) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="foto">Foto Alumni</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                            
                            @if($kisah->foto)
                                <div class="mt-2">
                                    <small class="text-muted">Foto saat ini:</small><br>
                                    <img src="{{ asset('uploads/kisah-sukses/'.$kisah->foto) }}" class="img-thumbnail" width="100" height="100">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select class="form-control @error('rating') is-invalid @enderror" 
                                    id="rating" name="rating" required>
                                <option value="5" {{ old('rating', $kisah->rating) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
                                <option value="4" {{ old('rating', $kisah->rating) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
                                <option value="3" {{ old('rating', $kisah->rating) == 3 ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
                                <option value="2" {{ old('rating', $kisah->rating) == 2 ? 'selected' : '' }}>⭐⭐ (2)</option>
                                <option value="1" {{ old('rating', $kisah->rating) == 1 ? 'selected' : '' }}>⭐ (1)</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="urutan">Urutan</label>
                            <input type="number" class="form-control @error('urutan') is-invalid @enderror" 
                                   id="urutan" name="urutan" value="{{ old('urutan', $kisah->urutan) }}" min="0">
                            @error('urutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="Publish" {{ old('status', $kisah->status) == 'Publish' ? 'selected' : '' }}>Publish</option>
                                <option value="Draft" {{ old('status', $kisah->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ url('admin/kisah-sukses') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
</div>
@endsection

@include('admin.layout.footer')
