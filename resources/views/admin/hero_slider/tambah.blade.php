@extends('admin/layout/wrapper')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Hero Slider</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dasbor') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/hero-slider') }}">Hero Slider</a></li>
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
          <form method="post" action="{{ url('admin/hero-slider/tambah_proses') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Hero Slider</h3>
              </div>
              <div class="card-body">
                <!-- Bahasa Indonesia -->
                <div class="form-group">
                  <h4>Bahasa Indonesia</h4>
                  <hr>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Title (ID) <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="title_id" class="form-control" placeholder="Judul dalam Bahasa Indonesia" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Subtitle (ID)</label>
                  <div class="col-sm-10">
                    <input type="text" name="subtitle_id" class="form-control" placeholder="Subtitle dalam Bahasa Indonesia">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Country (ID)</label>
                  <div class="col-sm-10">
                    <input type="text" name="country_id" class="form-control" placeholder="Negara dalam Bahasa Indonesia">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Description (ID)</label>
                  <div class="col-sm-10">
                    <textarea name="description_id" class="form-control" rows="3" placeholder="Deskripsi dalam Bahasa Indonesia"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Button Text (ID)</label>
                  <div class="col-sm-10">
                    <input type="text" name="button_text_id" class="form-control" placeholder="Teks tombol dalam Bahasa Indonesia">
                  </div>
                </div>

                <!-- Bahasa Inggris -->
                <div class="form-group mt-4">
                  <h4>Bahasa Inggris</h4>
                  <hr>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Title (EN)</label>
                  <div class="col-sm-10">
                    <input type="text" name="title_en" class="form-control" placeholder="Title in English">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Subtitle (EN)</label>
                  <div class="col-sm-10">
                    <input type="text" name="subtitle_en" class="form-control" placeholder="Subtitle in English">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Country (EN)</label>
                  <div class="col-sm-10">
                    <input type="text" name="country_en" class="form-control" placeholder="Country in English">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Description (EN)</label>
                  <div class="col-sm-10">
                    <textarea name="description_en" class="form-control" rows="3" placeholder="Description in English"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Button Text (EN)</label>
                  <div class="col-sm-10">
                    <input type="text" name="button_text_en" class="form-control" placeholder="Button text in English">
                  </div>
                </div>

                <!-- Bahasa Jepang -->
                <div class="form-group mt-4">
                  <h4>Bahasa Jepang</h4>
                  <hr>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Title (JP)</label>
                  <div class="col-sm-10">
                    <input type="text" name="title_jp" class="form-control" placeholder="タイトル（日本語）">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Subtitle (JP)</label>
                  <div class="col-sm-10">
                    <input type="text" name="subtitle_jp" class="form-control" placeholder="サブタイトル（日本語）">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Country (JP)</label>
                  <div class="col-sm-10">
                    <input type="text" name="country_jp" class="form-control" placeholder="国（日本語）">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Description (JP)</label>
                  <div class="col-sm-10">
                    <textarea name="description_jp" class="form-control" rows="3" placeholder="説明（日本語）"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Button Text (JP)</label>
                  <div class="col-sm-10">
                    <input type="text" name="button_text_jp" class="form-control" placeholder="ボタンテキスト（日本語）">
                  </div>
                </div>

                <!-- Media & Links -->
                <div class="form-group mt-4">
                  <h4>Media & Links</h4>
                  <hr>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Background Image</label>
                  <div class="col-sm-10">
                    <input type="file" name="background_image" class="form-control" accept="image/*">
                    <small class="text-muted">Gambar latar belakang untuk slider</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Person Image</label>
                  <div class="col-sm-10">
                    <input type="file" name="person_image" class="form-control" accept="image/*">
                    <small class="text-muted">Gambar orang/karakter utama</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Person Images (Multiple)</label>
                  <div class="col-sm-10">
                    <input type="file" name="person_images[]" class="form-control" accept="image/*" multiple>
                    <small class="text-muted">Beberapa gambar orang (bisa pilih lebih dari satu)</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Button Link</label>
                  <div class="col-sm-10">
                    <input type="text" name="button_link" class="form-control" placeholder="URL untuk tombol (contoh: /berita, https://example.com)">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Video Link</label>
                  <div class="col-sm-10">
                    <input type="text" name="video_link" class="form-control" placeholder="URL video (YouTube, Vimeo, dll)">
                  </div>
                </div>

                <!-- Settings -->
                <div class="form-group mt-4">
                  <h4>Pengaturan</h4>
                  <hr>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Urutan</label>
                  <div class="col-sm-10">
                    <input type="number" name="urutan" class="form-control" value="0" min="0">
                    <small class="text-muted">Urutan tampil slider (angka lebih kecil tampil lebih dulu)</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                    <select name="status" class="form-control">
                      <option value="Publish">Publish</option>
                      <option value="Draft">Draft</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('admin/hero-slider') }}" class="btn btn-secondary">Kembali</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
