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
              <li class="breadcrumb-item active">Daftar Transportasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card-header text-right">
          <a href="{{ route('createTransportasi') }}" class="btn btn-primary" role="button">
            <i class="fas fa-plus"></i> Tambah Transportasi
          </a>
        </div>
        <div class="card">
          <div class="card-body">
            <table class="table table-hover text-center">
              <thead>
                <tr>
                  <th style="width: 5%;">No.</th>
                  <th style="width: 15%;">Nama Kendaraan</th>
                  <th style="width: 12%;">Jenis</th>
                  <th style="width: 15%;">Sopir</th>
                  <th style="width: 15%;">Nomor</th>
                  <th style="width: 12%;">Harga Sewa</th>
                  <th style="width: 10%;">Kursi</th>
                  <th style="width: 15%;">Gambar Wisata</th>
                  <th style="width: 16%;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transportasi as $transportasi)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $transportasi->nama_kendaraan }}</td>
                  <td>{{ $transportasi->jenis_kendaraan }}</td>
                  <td>{{ $transportasi->sopir }}</td>
                  <td>{{ $transportasi->nomor_kendaraan }}</td>
                  <td>Rp{{ number_format($transportasi->harga_sewa, 0, ',', '.') }}</td>
                  <td>{{ $transportasi->kursi }} Kursi</td>
                  <td>
                    <a href="{{ Storage::url($transportasi->gambar_kendaraan) }}" target="_blank">
                      <img src="{{ Storage::url($transportasi->gambar_kendaraan) }}" alt="Gambar Kendaraan" width="100">
                    </a>
                  </td>
                  <td class="d-flex justify-content-center">
                    <a href="{{ route('editTransportasi', $transportasi->id) }}"
                      class="btn btn-sm btn-info d-flex align-items-center justify-content-center"
                      style="min-width: 80px;">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    &nbsp;
                    <form action="{{ route('deleteTransportasi', $transportasi->id) }}"
                          method="POST" style="display:inline;">
                      @csrf
                      <button type="submit"
                              class="btn btn-sm btn-danger d-flex align-items-center justify-content-center btn-konfirmasi-hapus"
                              style="min-width: 80px;">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('scripts')
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const buttons = document.querySelectorAll('.btn-konfirmasi-hapus');

      buttons.forEach(button => {
        button.addEventListener('click', function (e) {
          e.preventDefault(); // Cegah submit langsung

          const form = this.closest('form'); // Ambil form terdekat

          Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data transportasi yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit(); // Kirim form kalau user konfirmasi
            }
          });
        });
      });
    });
  </script>
@endsection