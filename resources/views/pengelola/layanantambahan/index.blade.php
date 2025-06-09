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
              <li class="breadcrumb-item active">Daftar Layanan Tambahan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <a href="{{ route('createLayananTambahan') }}" class="btn btn-dark mb-3" role="button">
              <i class="fas fa-plus"></i> Tambah Layanan
            </a>
          <table class="table table-hover">
            <thead class="text-center">
              <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 5%;">Nama Layanan</th>
                <th style="width: 25%;">Deskripsi</th>
                <th style="width: 5%;">Harga Layanan</th>
                <th style="width: 5%;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($layanantambahan as $layanantambahan)
              <tr>
                <td class="text-center"> {{ $loop->index + 1}}</td>
                <td class="text-center"> {{ $layanantambahan->nama_layanan }}</td>
                <td> {{ $layanantambahan->deskripsi_layanan }}</td>
                <td class="text-center"> {{ $layanantambahan->harga_layanan }}</td>
                <td class="d-flex justify-content-center">
                <a href="{{ route('editLayananTambahan', $layanantambahan->id) }}" class="btn btn-sm btn-info mr-2 d-flex align-items-center">
                  <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <form action="{{ route('deleteLayananTambahan', $layanantambahan->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm btn-konfirmasi-hapus">
                        <i class="fas fa-trash-alt"></i> Hapus
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
            text: "Data layanan yang dihapus tidak dapat dikembalikan!",
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