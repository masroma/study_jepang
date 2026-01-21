<style type="text/css" media="screen">
  .nav ul li p !important {
    font-size: 12px;
  }
  .infoku {
    margin-left: 20px; 
    text-transform: uppercase;
    color: yellow;
    font-size: 11px;
  }
</style>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('admin/dasbor') }}" class="brand-link">
      <img src="{{ asset('assets/upload/image/'.website('icon')) }}"
         alt="{{ website('namaweb') }}"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
      <span class="brand-text font-weight-light">{{ website('nama_singkat') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- DASHBOARD -->
          <li class="nav-item">
            <a href="{{ asset('admin/dasbor') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <!-- Website Content -->
          <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Menu Utama</span></li>
          <li class="batas"><hr></li>
          
          <!-- HOME -->
          <li class="nav-item">
            <a href="{{ asset('admin/dasbor') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>

          <!-- TRAINING CENTER -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>Training Center<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/agenda') }}" class="nav-link"><i class="fas fa-calendar nav-icon"></i><p>Data Training</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/agenda/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Training</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/kategori_agenda') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Training</p></a></li>
            </ul>
          </li>

          <!-- BLOG -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-blog"></i>
              <p>Blog<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/berita') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Blog</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/berita/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Blog</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/kategori') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Blog</p></a></li>
            </ul>
          </li>

          <!-- VIDEO -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-video"></i>
              <p>Video<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/video') }}" class="nav-link"><i class="fas fa-list nav-icon"></i><p>Data Video</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/video/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Video</p></a></li>
            </ul>
          </li>

          <!-- KONTAK KAMI -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Kontak Kami<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/konfigurasi') }}" class="nav-link"><i class="fas fa-cog nav-icon"></i><p>Info Kontak</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/kontak') }}" class="nav-link"><i class="fas fa-inbox nav-icon"></i><p>Pesan Kontak</p></a></li>
            </ul>
          </li>

          <!-- PROGRAM MASA DEPAN -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-rocket"></i>
              <p>Program Masa Depan<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/program-masa-depan') }}" class="nav-link"><i class="fas fa-list nav-icon"></i><p>Data Program</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/program-masa-depan/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Program</p></a></li>
            </ul>
          </li>

          <!-- INDUSTRI -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-industry"></i>
              <p>Industri<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/industri') }}" class="nav-link"><i class="fas fa-list nav-icon"></i><p>Data Industri</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/industri/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Industri</p></a></li>
            </ul>
          </li>

          <!-- KISAH SUKSES -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>Kisah Sukses<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/kisah-sukses') }}" class="nav-link"><i class="fas fa-list nav-icon"></i><p>Data Alumni</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/kisah-sukses/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Alumni</p></a></li>
            </ul>
          </li>

          <!-- LOKER -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>Lowongan Kerja<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/loker') }}" class="nav-link"><i class="fas fa-list nav-icon"></i><p>Data Lowongan</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/loker/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Lowongan</p></a></li>
              <li class="nav-item"><a href="{{ asset('admin/pendaftaran-loker') }}" class="nav-link"><i class="fas fa-users nav-icon"></i><p>Pendaftar</p></a></li>
            </ul>
          </li>

          <!-- Website Content -->
          <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Profil &amp; Layanan</span></li>
          <li class="batas"><hr></li>

          <li class="nav-item">
            <a href="{{ asset('admin/konfigurasi/profil') }}" class="nav-link">
              <i class="nav-icon fas fa-leaf"></i>
              <p>Update Profil</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ asset('admin/berita/jenis_berita/Layanan') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Layanan</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Board &amp; Team<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/staff') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Board &amp; Team</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/staff/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Board &amp; Team</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kategori_staff') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Board &amp; Team</p></a>
              </li>
            </ul>
          </li>

          <!-- Website Content -->
          <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Website Setting</span></li>
          <li class="batas"><hr></li>
          <li class="nav-item">
            <a href="{{ asset('admin/user') }}" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>Pengguna Web</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ asset('admin/heading') }}" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>Header Gambar</p>
            </a>
          </li>
          
          <!-- MENU -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Konfigurasi
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/konfigurasi') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Konfigurasi Umum</p></a>
              </li>
            
              <li class="nav-item"><a href="{{ asset('admin/konfigurasi/logo') }}" class="nav-link"><i class="fa fa-home nav-icon"></i><p>Ganti Logo</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/konfigurasi/icon') }}" class="nav-link"><i class="fa fa-upload nav-icon"></i><p>Ganti Icon</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/konfigurasi/email') }}" class="nav-link"><i class="fa fa-envelope nav-icon"></i><p>Email Setting</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/rekening') }}" class="nav-link"><i class="fas fa-book nav-icon"></i><p>Rekening</p></a>
              </li>
            </ul>
          </li>

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              <div class="col-md-12">
                 <h2 class="card-title"><?php echo $title ?></h2> 
              </div>
             
              
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
<div class="table-responsive konten">
