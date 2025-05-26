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
              <i class="nav-icon fas fa-map-marker-alt"></i>&nbsp;Destinasi
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('Destinasi') }}">Daftar Destinasi</a></li>
              <li class="breadcrumb-item active">Edit Destinasi</li>
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
            <form action="{{ route('updateDestinasi', ['id' => $destinasi->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                      <label for="nama_destinasi">Nama Destinasi</label>
                      <input type="text" name="nama_destinasi" id="nama_destinasi" class="form-control" required="required" value="{{ $destinasi->nama_destinasi }}" placeholder="Masukkan nama destinasi">
                  </div>

                  <div class="form-group">
                      <label for="lokasi">Lokasi</label>
                      <textarea name="lokasi" id="lokasi" rows="3" class="form-control" required placeholder="Masukkan lokasi">{{ old('lokasi', $destinasi->lokasi) }}</textarea>
                  </div>

                  <div class="form-group">
                      <label for="deskripsi">Deskripsi</label>
                      <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required placeholder="Masukkan Deskripsi">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                  </div>

                  <div class="form-group">
                      <label for="harga">Harga Tiket</label>
                      <input type="text" name="harga" id="harga" class="form-control" required="required" value="{{ $destinasi->harga }}" placeholder="Masukkan harga tiket">
                  </div>

                  <div class="form-group">
                      <label for="rating">Rating wisata</label>
                      <input type="text" name="rating" id="rating" class="form-control" required="required" value="{{ $destinasi->rating }}" placeholder="Masukkan rating wisata">
                  </div>

                  <div class="form-group">
                      <label for="gambar_wisata">Gambar</label>
                      <input type="file" name="gambar_wisata" id="gambar_wisata" class="form-control">
                      @if($destinasi->gambar_wisata)
                          <small>Gambar saat ini:</small><br>
                          <img src="{{ asset('storage/' . $destinasi->gambar_wisata) }}" alt="Gambar Destinasi" width="150">
                      @endif
                  </div>

                  <div class="text-right">
                      <a href="{{ route('Destinasi') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
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
