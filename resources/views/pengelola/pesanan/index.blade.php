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
              <i class="nav-icon fas fa-map-marker-alt"></i>&nbsp;Pesanan
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Daftar Pesanan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Wisatawan</th>
                  <th>Kota Asal</th>
                  <th>Nomor Telefon</th>
                  <th>Tanggal Keberangkatan</th>
                  <th>Titik Jemput</th>
                  <th>Jumlah Orang</th>
                  <th>Total Biaya</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pesanan as $p)
                  <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->wisatawan }}</td>
                    <td>{{ $p->kota_asal }}</td>
                    <td>{{ $p->telefon }}</td>
                    <td>{{ $p->tanggal_keberangkatan }}</td>
                    <td>{{ $p->titik_jemput }}</td>
                    <td>{{ $p->jumlah_orang }}</td>
                    <td>Rp{{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                    <td>{{ $p->status ?? '-' }}</td>
                    <td>
                      <a href="{{ route('pesanan.download', $p->id) }}" target="_blank" class="btn btn-sm btn-primary">Cetak</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection