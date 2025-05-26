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
              <i class="nav-icon fas fa-bus"></i>&nbsp;Transportasi
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('Transportasi') }}">Daftar Transportasi</a></li>
              <li class="breadcrumb-item active">Edit Transportasi</li>
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
            <form action="{{ route('updateTransportasi', ['id' => $transportasi->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                      <label for="nama_kendaraan">Nama Kendaraan</label>
                      <input type="text" name="nama_kendaraan" id="nama_kendaraan" class="form-control" required="required" value="{{ $transportasi->nama_kendaraan }}" placeholder="Masukkan nama kendaraan">
                  </div>

                  <div class="form-group">
                      <label for="jenis_kendaraan">Jenis Kendaraan</label>
                      <input type="text" name="jenis_kendaraan" id="jenis_kendaraan" class="form-control" required="required" value="{{ $transportasi->jenis_kendaraan }}" placeholder="Masukkan jenis kendaraan">
                  </div>

                  <div class="form-group">
                      <label for="sopir">Sopir</label>
                      <input type="text" name="sopir" id="sopir" class="form-control" required="required" value="{{ $transportasi->sopir }}" placeholder="Masukkan nama sopir">
                  </div>

                  <div class="form-group">
                      <label for="nomor_kendaraan">Nomor Kendaraan</label>
                      <input type="text" name="nomor_kendaraan" id="nomor_kendaraan" class="form-control" required="required" value="{{ $transportasi->nomor_kendaraan }}" placeholder="Masukkan nomor kendaraan">
                  </div>

                  <div class="form-group">
                      <label for="harga_sewa">Harga Sewa</label>
                      <input type="text" name="harga_sewa" id="harga_sewa" class="form-control" required="required" value="{{ $transportasi->harga_sewa }}" placeholder="Masukkan harga sewa">
                  </div>

                  <div class="form-group">
                      <label for="kursi">Kursi</label>
                      <input type="text" name="kursi" id="kursi" class="form-control" required="required" value="{{ $transportasi->kursi }}" placeholder="Masukkan jumlah kursi">
                  </div>

                  <div class="form-group">
                      <label for="gambar_kendaraan">Gambar</label>
                      <input type="file" name="gambar_kendaraan" id="gambar_kendaraan" class="form-control">
                      @if($transportasi->gambar_kendaraan)
                          <small>Gambar saat ini:</small><br>
                          <img src="{{ asset('storage/' . $transportasi->gambar_kendaraan) }}" alt="Gambar Transportasi" width="150">
                      @endif
                  </div>

                  <div class="text-right">
                      <a href="{{ route('Transportasi') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
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
