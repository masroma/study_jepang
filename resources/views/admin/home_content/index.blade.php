@extends('admin/layout/wrapper')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kelola Konten Halaman Utama</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dasbor') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Konten Halaman Utama</li>
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
              <h3 class="card-title">Daftar Konten</h3>
              <div class="card-tools">
                <a href="{{ url('admin/home_content/tambah') }}" class="btn btn-primary btn-sm">
                  <i class="fa fa-plus"></i> Tambah Konten
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="15%">Section</th>
                    <th width="30%">Content</th>
                    <th width="10%">Image</th>
                    <th width="10%">Video</th>
                    <th width="10%">Active</th>
                    <th width="10%">Urutan</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach($contents as $content)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $content->section }}</td>
                    <td>{{ Str::limit($content->content, 50) }}</td>
                    <td>
                      @if($content->image)
                        <img src="{{ asset('upload/' . $content->image) }}" width="50" alt="">
                      @else
                        -
                      @endif
                    </td>
                    <td>
                      @if($content->video)
                        <i class="fa fa-video"></i>
                      @else
                        -
                      @endif
                    </td>
                    <td>
                      @if($content->active)
                        <span class="badge badge-success">Active</span>
                      @else
                        <span class="badge badge-danger">Inactive</span>
                      @endif
                    </td>
                    <td>{{ $content->urutan }}</td>
                    <td>
                      <a href="{{ url('admin/home_content/edit/' . $content->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="{{ url('admin/home_content/delete/' . $content->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
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