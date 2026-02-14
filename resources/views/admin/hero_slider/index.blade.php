@extends('admin/layout/wrapper')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kelola Hero Slider</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dasbor') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Hero Slider</li>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Hero Slider</h3>
              <div class="card-tools">
                <a href="{{ url('admin/hero-slider/tambah') }}" class="btn btn-primary btn-sm">
                  <i class="fa fa-plus"></i> Tambah Hero Slider
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="20%">Title (ID)</th>
                    <th width="15%">Background Image</th>
                    <th width="15%">Person Image</th>
                    <th width="10%">Urutan</th>
                    <th width="10%">Status</th>
                    <th width="25%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach($sliders as $slider)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $slider->title_id ?? '-' }}</td>
                    <td>
                      @if($slider->background_image)
                        <img src="{{ asset($slider->background_image) }}" width="80" alt="" style="object-fit: cover; height: 50px;">
                      @else
                        -
                      @endif
                    </td>
                    <td>
                      @if($slider->person_image)
                        <img src="{{ asset($slider->person_image) }}" width="80" alt="" style="object-fit: cover; height: 50px;">
                      @else
                        -
                      @endif
                    </td>
                    <td>{{ $slider->urutan }}</td>
                    <td>
                      @if($slider->status == 'Publish')
                        <span class="badge badge-success">Publish</span>
                      @else
                        <span class="badge badge-secondary">Draft</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ url('admin/hero-slider/edit/' . $slider->id_hero) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i> Edit
                      </a>
                      <a href="{{ url('admin/hero-slider/delete/' . $slider->id_hero) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">
                        <i class="fa fa-trash"></i> Hapus
                      </a>
                    </td>
                  </tr>
                  @endforeach
                  @if($sliders->count() == 0)
                  <tr>
                    <td colspan="7" class="text-center">Belum ada data hero slider</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
