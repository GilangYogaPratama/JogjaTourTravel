@extends('adminlte.layouts.app')

@section('content')

  <div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              <i class="nav-icon fas fa-tags"></i>&nbsp;Edit Kategori
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori Destinasi</a></li>
              <li class="breadcrumb-item active">Edit Kategori</li>
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

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Masukkan nama kategori">
                @error('nama_kategori')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="text-right">
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary mr-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>

            </form>

          </div>
        </div>

      </div>
    </div>
  </div>

@endsection
