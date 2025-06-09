@extends('adminlte.layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h1><i class="fa-solid fa-money-check-dollar"></i> Verifikasi Pembayaran</h1>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          
          <h5>Detail Pesanan</h5>
          <p><strong>Nama Wisatawan:</strong> {{ $pesanan->wisatawan }}</p>
          <p><strong>Kota Asal:</strong> {{ $pesanan->kota_asal }}</p>
          <p><strong>Jumlah Orang:</strong> {{ $pesanan->jumlah_orang }}</p>
          <p><strong>Total Biaya:</strong> Rp{{ number_format($pesanan->total_biaya, 0, ',', '.') }}</p>

          <hr>

          <h5>Detail Pembayaran</h5>

          @if ($pembayaran)
              <p><strong>Status Pembayaran:</strong>
                  @if ($pembayaran->bukti_pembayaran)
                      <span class="text-success">Lunas</span>
                  @else
                      <span class="text-warning">Belum Dibayar</span>
                  @endif
              </p>

              @if ($pembayaran->bukti_pembayaran)
                  <p><strong>Bukti Pembayaran:</strong><br>
                      <img src="{{ asset('storage/bukti_pembayaran/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" width="300">
                  </p>
              @else
                  {{-- Form upload jika pembayaran ada tapi bukti belum diupload --}}
                  <form action="{{ route('pembayaran.upload', $pembayaran->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                      @csrf
                      <div class="form-group mb-3">
                          <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                          <input type="file" name="bukti_pembayaran" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Upload</button>
                  </form>
              @endif

          @else
              <p class="text-danger">Belum ada data pembayaran.</p>

              {{-- Opsi upload manual jika pembayaran null --}}
              <form action="{{ route('pembayaran.uploadManual', $pesanan->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                  @csrf
                  <div class="form-group mb-3">
                      <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                      <input type="file" name="bukti_pembayaran" class="form-control" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Upload</button>
              </form>
          @endif

          <hr>
          {{-- Tombol kembali --}}
          <a href="{{ route('pesanan.index') }}" class="btn btn-secondary mt-3">
            <i class="fa fa-arrow-left"></i> Kembali ke Daftar Pesanan
          </a>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection