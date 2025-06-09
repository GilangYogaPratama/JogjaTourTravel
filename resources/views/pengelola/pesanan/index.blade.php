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
              <i class="fa-solid fa-calendar"></i>&nbsp;Pesanan
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
          <a href="{{ route('pesanan.arsip') }}" target="_blank" class="btn btn-dark mb-3">
            <i class="fas fa-print"></i> Cetak Arsip
          </a>
            <table>
              <thead>
                <tr>
                  <th style="width: 5%;">ID</th>
                  <th style="width: 8%;">Nama Wisatawan</th>
                  <th style="width: 8%;">Kota Asal</th>
                  <th style="width: 5%;">Nomor Telefon</th>
                  <th style="width: 10%;">Tanggal Keberangkatan</th>
                  <th style="width: 15%;">Titik Jemput</th>
                  <th style="width: 8%;">Jumlah Orang</th>
                  <th style="width: 8%;">Total Biaya</th>
                  <th style="width: 5%;">Status</th>
                  <th style="width: 10%;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pesanan as $p)
                  <tr>
                    <td>JT-INV-{{ $p->id }}</td>
                    <td>{{ $p->wisatawan }}</td>
                    <td>{{ $p->kota_asal }}</td>
                    <td>{{ $p->telefon }}</td>
                    <td>{{ $p->tanggal_keberangkatan }}</td>
                    <td>{{ $p->titik_jemput }}</td>
                    <td>{{ $p->jumlah_orang }}</td>
                    <td>Rp{{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                    <td>
                      @if ($p->pembayaran && $p->pembayaran->bukti_pembayaran)
                        <span class="badge bg-success">Complete</span>
                      @else
                        <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('pesanan.download', $p->id) }}" target="_blank" class="btn btn-sm btn-primary mb-1">Cetak</a>
                      <a href="{{ route('pembayaran.verifikasi', $p->id) }}" class="btn btn-sm btn-success mb-1">Verifikasi</a>
                      @if ($p->pembayaran && $p->pembayaran->bukti_pembayaran)
                        <a href="{{ route('pesanan.kuitansi', $p->id) }}" target="_blank" class="btn btn-sm btn-secondary">Kuitansi</a>
                      @endif
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