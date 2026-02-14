@extends('admin/layout/wrapper')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Hero Slider</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dasbor') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/hero-slider') }}">Hero Slider</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
          <form method="post" action="{{ url('admin/hero-slider/edit_proses') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_hero" value="{{ $slider->id_hero }}">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Edit Hero Slider</h3>
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
                    <input type="text" name="title_id" class="form-control" value="{{ $slider->title_id }}" placeholder="Judul dalam Bahasa Indonesia" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Subtitle (ID)</label>
                  <div class="col-sm-10">
                    <input type="text" name="subtitle_id" class="form-control" value="{{ $slider->subtitle_id }}" placeholder="Subtitle dalam Bahasa Indonesia">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Country (ID)</label>
                  <div class="col-sm-10">
                    <input type="text" name="country_id" class="form-control" value="{{ $slider->country_id }}" placeholder="Negara dalam Bahasa Indonesia">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Description (ID)</label>
                  <div class="col-sm-10">
                    <textarea name="description_id" class="form-control" rows="3" placeholder="Deskripsi dalam Bahasa Indonesia">{{ $slider->description_id }}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Button Text (ID)</label>
                  <div class="col-sm-10">
                    <input type="text" name="button_text_id" class="form-control" value="{{ $slider->button_text_id }}" placeholder="Teks tombol dalam Bahasa Indonesia">
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
                    <input type="text" name="title_en" class="form-control" value="{{ $slider->title_en }}" placeholder="Title in English">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Subtitle (EN)</label>
                  <div class="col-sm-10">
                    <input type="text" name="subtitle_en" class="form-control" value="{{ $slider->subtitle_en }}" placeholder="Subtitle in English">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Country (EN)</label>
                  <div class="col-sm-10">
                    <input type="text" name="country_en" class="form-control" value="{{ $slider->country_en }}" placeholder="Country in English">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Description (EN)</label>
                  <div class="col-sm-10">
                    <textarea name="description_en" class="form-control" rows="3" placeholder="Description in English">{{ $slider->description_en }}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Button Text (EN)</label>
                  <div class="col-sm-10">
                    <input type="text" name="button_text_en" class="form-control" value="{{ $slider->button_text_en }}" placeholder="Button text in English">
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
                    <input type="text" name="title_jp" class="form-control" value="{{ $slider->title_jp }}" placeholder="タイトル（日本語）">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Subtitle (JP)</label>
                  <div class="col-sm-10">
                    <input type="text" name="subtitle_jp" class="form-control" value="{{ $slider->subtitle_jp }}" placeholder="サブタイトル（日本語）">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Country (JP)</label>
                  <div class="col-sm-10">
                    <input type="text" name="country_jp" class="form-control" value="{{ $slider->country_jp }}" placeholder="国（日本語）">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Description (JP)</label>
                  <div class="col-sm-10">
                    <textarea name="description_jp" class="form-control" rows="3" placeholder="説明（日本語）">{{ $slider->description_jp }}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Button Text (JP)</label>
                  <div class="col-sm-10">
                    <input type="text" name="button_text_jp" class="form-control" value="{{ $slider->button_text_jp }}" placeholder="ボタンテキスト（日本語）">
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
                    @if($slider->background_image)
                      <div class="mt-2">
                        <img src="{{ asset($slider->background_image) }}" width="200" alt="" class="img-thumbnail">
                        <p class="text-muted mt-1">Gambar saat ini (kosongkan jika tidak ingin mengubah)</p>
                      </div>
                    @endif
                    <small class="text-muted">Gambar latar belakang untuk slider</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Person Image</label>
                  <div class="col-sm-10">
                    <input type="file" name="person_image" class="form-control" accept="image/*">
                    @if($slider->person_image)
                      <div class="mt-2">
                        <img src="{{ asset($slider->person_image) }}" width="200" alt="" class="img-thumbnail">
                        <p class="text-muted mt-1">Gambar saat ini (kosongkan jika tidak ingin mengubah)</p>
                      </div>
                    @endif
                    <small class="text-muted">Gambar orang/karakter utama</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Person Images (Multiple)</label>
                  <div class="col-sm-10">
                    <input type="file" name="person_images[]" class="form-control" accept="image/*" multiple>
                    @php
                      // Decode person_images if it's a JSON string
                      $personImages = $slider->person_images ?? null;
                      if (is_string($personImages)) {
                        $personImages = json_decode($personImages, true) ?? [];
                      }
                      if (!is_array($personImages)) {
                        $personImages = [];
                      }
                    @endphp
                    @if(!empty($personImages) && count($personImages) > 0)
                      <div class="mt-2">
                        @foreach($personImages as $img)
                          @if(!empty($img))
                            <img src="{{ asset($img) }}" width="100" alt="" class="img-thumbnail mr-2 mb-2">
                          @endif
                        @endforeach
                        <p class="text-muted mt-1">Gambar saat ini (upload baru akan mengganti semua gambar)</p>
                      </div>
                    @endif
                    <small class="text-muted">Beberapa gambar orang (bisa pilih lebih dari satu)</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Button Link</label>
                  <div class="col-sm-10">
                    <input type="text" name="button_link" class="form-control" value="{{ $slider->button_link }}" placeholder="URL untuk tombol (contoh: /berita, https://example.com)">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Video Link</label>
                  <div class="col-sm-10">
                    <input type="text" name="video_link" class="form-control" value="{{ $slider->video_link }}" placeholder="URL video (YouTube, Vimeo, dll)">
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
                    <input type="number" name="urutan" class="form-control" value="{{ $slider->urutan }}" min="0">
                    <small class="text-muted">Urutan tampil slider (angka lebih kecil tampil lebih dulu)</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                    <select name="status" class="form-control">
                      <option value="Publish" {{ $slider->status == 'Publish' ? 'selected' : '' }}>Publish</option>
                      <option value="Draft" {{ $slider->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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
