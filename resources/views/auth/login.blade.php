@extends('adminlte.layouts.auth')

@section('content')
<body class="hold-transition login-page" style="background: linear-gradient(to right, #3b82f6, #33a1ea);">
    <div class="login-box">
      <div class="login-logo">
        <div class="flex items-center space-x-3">
          <img src="{{ asset('storage/images/JTT.png') }}" alt="Logo" style="width: 80%;">
        </div>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p>Masukkan email dan password anda</p>
          

          <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="row align-items-center">
              <!-- Tombol Login -->
              <div class="col-6">
                <button type="submit" class="btn btn-primary btn-block d-flex align-items-center justify-content-center">
                  <i class="fas fa-paper-plane mr-2"></i> {{ __('Login') }}
                </button>
              </div>

              <!-- Tombol Kembali -->
              <div class="col-6 text-right">
                <a href="{{ url('/') }}" class="text-sm text-muted text-decoration-none hover:text-primary">
                  ← Kembali ke Beranda
                </a>
              </div>
            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
@endsection
