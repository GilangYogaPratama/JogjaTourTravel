@extends('adminlte.layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              <i class="nav-icon fas fa-concierge-bell"></i>&nbsp;Layanan Tambahan
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('LayananTambahan') }}">Daftar Layanan Tambahan</a></li>
              <li class="breadcrumb-item active">Edit Layanan Tambahan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="card">
          <div class="card-body">
            <form action="{{ route('updateLayananTambahan', ['id' => $layanantambahan->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                      <label for="nama_layanan">Nama Layanan</label>
                      <input type="text" name="nama_layanan" id="nama_layanan" class="form-control" required="required" value="{{ $layanantambahan->nama_layanan }}" placeholder="Masukkan nama layanan">
                  </div>

                  <div class="form-group">
                      <label for="deskripsi_layanan">Deskripsi</label>
                      <textarea name="deskripsi_layanan" id="deskripsi_layanan" rows="3" class="form-control" required placeholder="Masukkan deskripsi">{{ old('deskripsi_layanan', $layanantambahan->deskripsi_layanan) }}</textarea>
                  </div>

                  <div class="form-group">
                      <label for="harga_layanan">Harga</label>
                      <textarea name="harga_layanan" id="harga_layanan" rows="3" class="form-control" required placeholder="Masukkan Harga">{{ old('harga_layanan', $layanantambahan->harga_layanan) }}</textarea>
                  </div>

                  <div class="text-right">
                      <a href="{{ route('LayananTambahan') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
