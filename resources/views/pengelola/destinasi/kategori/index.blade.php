@extends('adminlte.layouts.app')

@section('content')

  <div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              <i class="nav-icon fas fa-tags"></i>&nbsp;Kategori Destinasi
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Kategori Destinasi</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="content">
      <div class="container-fluid">

        <div class="card">
          <div class="card-body">

            <a href="{{ route('kategori.create') }}" class="btn btn-dark mb-3">
              <i class="fas fa-plus"></i> Tambah Kategori
            </a>

            <a href="{{ route('destinasi.index') }}" class="btn btn-outline-dark mb-3">
              <i class="fa fa-arrow-left"></i> Kembali
            </a>            

            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            <table class="table table-hover">
              <thead class="text-center">
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Nama Kategori</th>
                  <th style="width: 20%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($kategori_destinasi as $index => $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td class="text-center">
                      <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      &nbsp;
                      <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-konfirmasi-hapus">
                          <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada data kategori.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const buttons = document.querySelectorAll('.btn-konfirmasi-hapus');

      buttons.forEach(button => {
        button.addEventListener('click', function (e) {
          e.preventDefault();

          const form = this.closest('form');

          Swal.fire({
            title: 'Hapus kategori?',
            text: "Data tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
            }
          });
        });
      });
    });
  </script>
@endsection
