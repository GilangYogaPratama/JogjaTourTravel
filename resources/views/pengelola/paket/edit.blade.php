@extends('adminlte.layouts.app')

@section('content')
<style>
.card-destinasi-wrapper {
    cursor: pointer;
}
.checkbox-hidden {
    display: none;
}
.card-destinasi {
    border: 2px solid transparent;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.checkbox-hidden:checked + .card-destinasi {
    border-color: #007bff;
}
.checkmark-overlay {
    position: absolute;
    top: 8px;
    right: 8px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    padding: 5px 7px;
    font-size: 14px;
    display: none;
}
.checkbox-hidden:checked + .card-destinasi .checkmark-overlay {
    display: block;
}
</style>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
            <i class="nav-icon fas fa-box"></i>&nbsp;Paket
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('Paket') }}">Daftar Paket</a></li>
            <li class="breadcrumb-item active">Edit Paket</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('updatePaket', $paket->id) }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
          </div>

          <div class="form-group">
            <label for="jumlah_orang">Jumlah Orang</label>
            <input type="number" name="jumlah_orang" class="form-control" value="{{ $paket->jumlah_orang }}" required>
          </div>

          <div class="form-group">
            <label for="waktu">Waktu Perjalanan</label>
            <input type="text" name="waktu" class="form-control" value="{{ $paket->waktu }}" required>
          </div>

          <div class="form-group">
            <label for="id_transportasi">Transportasi</label>
            <select name="id_transportasi" class="form-control">
              <option value="">-- Pilih Transportasi --</option>
              @foreach($transportasi as $item)
                <option value="{{ $item->id }}" {{ $paket->id_transportasi == $item->id ? 'selected' : '' }}>
                  {{ $item->nama_kendaraan }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="id_layanantambahan">Layanan Tambahan</label>
            <div class="row">
              @foreach($layanantambahan as $lt)
                <div class="col-md-6 mb-2">
                  <label class="font-weight-normal">
                    <input type="checkbox" name="id_layanantambahan[]" value="{{ $lt->id }}"
                      {{ in_array($lt->id, $paket->layanantambahan->pluck('id')->toArray()) ? 'checked' : '' }}>
                    {{ $lt->nama_layanan }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <div class="form-group">
            <label for="id_destinasi">Pilih Destinasi Wisata</label>
            <div class="row">
              @foreach($destinasi as $item)
                <div class="col-md-3 mb-3">
                  <label class="card-destinasi-wrapper">
                    <input type="checkbox" name="id_destinasi[]" value="{{ $item->id }}"
                      class="checkbox-hidden"
                      {{ in_array($item->id, $paket->destinasi->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <div class="card-destinasi">
                      <img src="{{ asset('storage/' . $item->gambar_wisata) }}" alt="{{ $item->nama_destinasi }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                      <div class="card-body">
                        <h2 class="card-title">{{ $item->nama_destinasi }}</h2>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($item->lokasi, 70) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <span class="text-primary font-weight-bold">Rp.{{ number_format($item->harga, 0, ',', '.') }}</span>
                          <b>{{ $item->rating ?? '-' }}</b>
                        </div>
                      </div>
                    </div>
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <div class="text-right">
            <a href="{{ route('Paket') }}" class="btn btn-outline-secondary mr-2">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection