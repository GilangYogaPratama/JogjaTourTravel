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
              <i class="nav-icon fas fa-box"></i>&nbsp;Paket
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Daftar Paket</li>
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
            <a href="{{ route('createPaket') }}" class="btn btn-dark mb-3" role="button">
              <i class="fas fa-plus"></i> Tambah Paket
            </a>
          <table class="table table-hover">
            <thead class="text-center">
              <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 8%;">Nama Paket</th>
                <th style="width: 8%;">Jumlah orang</th>
                <th style="width: 35%;">Destinasi</th>
                <th style="width: 10%;">Transportasi</th>
                <th style="width: 12%;">Layanan Tambahan</th>
                <th style="width: 10%;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($paket as $paket)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $paket->nama_paket }}</td>
                <td class="text-center">{{ $paket->jumlah_orang }} Orang</td>

                {{-- Destinasi --}}
                <td>
                  <ul>
                    @foreach ($paket->destinasi as $destinasi)
                      <li>
                        <strong>{{ $destinasi->nama_destinasi }}</strong><br>
                        {{ $destinasi->lokasi }}<br>
                        Rp.{{ $destinasi->harga }}
                      </li>
                    @endforeach
                  </ul>
                </td>

                {{-- Transportasi --}}
                <td>
                  @if($paket->transportasi)
                    <strong>{{ $paket->transportasi->nama_kendaraan }}</strong><br>
                    Jenis: {{ $paket->transportasi->jenis_kendaraan }}<br>
                    Sopir: {{ $paket->transportasi->sopir }}<br>
                    No: {{ $paket->transportasi->nomor_kendaraan }}<br>
                    Harga: Rp{{ number_format($paket->transportasi->harga_sewa, 0, ',', '.') }}
                  @else
                    <em>Tidak ada</em>
                  @endif
                </td>

                {{-- Layanan Tambahan --}}
                <td>
                  <ul>
                    @foreach ($paket->layanantambahan as $layanan)
                      <li>
                        <strong>{{ $layanan->nama_layanan }}</strong><br>
                        {{ $layanan->deskripsi_layanan }}<br>
                        Rp{{ number_format($layanan->harga_layanan, 0, ',', '.') }}
                      </li>
                    @endforeach
                  </ul>
                </td>

                <td class="d-flex justify-content-center">
                    <a href="{{ route('editPaket', $paket->id) }}"
                      class="btn btn-sm btn-info d-flex align-items-center justify-content-center"
                      style="min-width: 80px;">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    &nbsp;
                    <form action="{{ route('deletePaket', $paket->id) }}"
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
            text: "Daftar paket yang dihapus tidak dapat dikembalikan!",
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

