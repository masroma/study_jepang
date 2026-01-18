@extends('admin/layout/wrapper')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Konten Halaman Utama</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dasbor') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/home_content') }}">Konten Halaman Utama</a></li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <form method="post" action="{{ url('admin/home_content/tambah_proses') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Section</label>
                  <div class="col-sm-10">
                    <input type="text" name="section" class="form-control" placeholder="e.g., hero_title, button_text" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Content</label>
                  <div class="col-sm-10">
                    <textarea name="content" class="form-control" rows="5" placeholder="Teks atau HTML" required></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                    <input type="file" name="image" class="form-control" accept="image/*">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Video</label>
                  <div class="col-sm-10">
                    <input type="file" name="video" class="form-control" accept="video/*">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Link</label>
                  <div class="col-sm-10">
                    <input type="text" name="link" class="form-control" placeholder="URL untuk button">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Active</label>
                  <div class="col-sm-10">
                    <input type="checkbox" name="active" value="1" checked>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Urutan</label>
                  <div class="col-sm-10">
                    <input type="number" name="urutan" class="form-control" value="0">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('admin/home_content') }}" class="btn btn-secondary">Kembali</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection