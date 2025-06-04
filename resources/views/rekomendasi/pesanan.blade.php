<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogja Tour & Travel</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100" style="font-family: 'Poppins', sans-serif;">

    <!-- Header -->
    <header class="bg-white shadow-md p-4 fixed top-0 w-full z-50 text-gray-800">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="{{ asset('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" class="h-12">
            </a>

            <!-- Breadcrumb -->
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li><a href="{{ url('/') }}" class="hover:text-blue-600 font-medium">Homepage</a></li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li class="text-gray-500 font-medium">Hasil Rekomendasi</li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li class="text-gray-500 font-medium">Konfirmasi Destinasi</li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li class="text-gray-500 font-semibold">Lengkapi Data Diri</li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section 
        class="h-[40vh] pt-20 flex flex-col justify-center items-center text-center text-white bg-cover bg-center" 
        style="background-image: url('{{ asset('storage/images/borobudur.jpg') }}');"
        data-aos="fade-in" 
        data-aos-duration="1000">

        <section class="py-16 px-4 text-left text-white">
            <h2 class="text-4xl font-bold mb-4">Lengkapi data diri</h2>
            <p class="max-w-3xl mx-auto mb-8">
                Temukan destinasi wisata populer, paket tur menarik, dan pengalaman liburan tak terlupakan yang disesuaikan dengan kebutuhan Anda.
                Masukkan budget dan jumlah orang, lalu biarkan sistem kami menyarankan pilihan terbaik untuk Anda.
            </p>
            <p class="text-sm italic mt-4">*budget belum termasuk biaya sewa transportasi dan layanan tambahan lainnya</p>
        </section>
    </section>

    <!-- Main Content -->
    <div class="w-full bg-blue-100 py-10">
        <div class="container">
            <p class="mb-4 border-bottom pb-2">🧾 Detail Pesanan Anda</p>

            <!-- Ringkasan -->
            <div class="card shadow mb-4" data-aos="fade-up">
                <div class="card-body">
                    <h5 class="card-title mb-3">📋 Ringkasan Pemesanan</h5>
                    <p class="mb-1"><strong>👥 Jumlah Orang:</strong> {{ $jumlahOrang }}</p>
                    <p class="mb-0"><strong>💰 Total Harga:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Daftar Destinasi -->
            <div class="card shadow mb-4" data-aos="fade-up" data-aos-delay="50">
                <div class="card-body">
                    <strong class="card-title mb-3">📍 Destinasi yang Dipilih</strong>
                    <ul class="list-group shadow-sm rounded overflow-hidden">
                        @foreach($daftarDestinasi as $destinasi)
                            <li class="list-group-item d-flex justify-between align-items-center hover:bg-blue-50 transition duration-200">
                                <span>{{ $destinasi->nama_destinasi }}</span>
                                <span class="badge bg-success text-light">Rp{{ number_format($destinasi->harga, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <form action="{{ route('konfirmasi.pesanan') }}" method="POST">
                @csrf

                <!-- Formulir Data Pemesan -->
                <div class="card shadow mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body">
                        <strong class="card-title mb-4">🧍 Informasi Pemesan</strong>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="wisatawan" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="wisatawan" name="wisatawan" placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label for="kota_asal" class="form-label">Kota Asal</label>
                                <input type="text" class="form-control" id="kota_asal" name="kota_asal" placeholder="Contoh: Jakarta" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                                <input type="number" min="1" class="form-control" id="jumlah_orang" name="jumlah_orang" placeholder="Jumlah peserta" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                                <input type="date" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" required>
                            </div>
                            <div class="col-md-6">
                                <label for="titik_jemput" class="form-label">Titik Jemput</label>
                                <input type="text" class="form-control" id="titik_jemput" name="titik_jemput" placeholder="Contoh: Stasiun Yogyakarta" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telefon" class="form-label">Nomor telefon Aktif</label>
                                <input type="tel" class="form-control" id="telefon" name="telefon" placeholder="Contoh: 0812xxxx" pattern="08[0-9]{8,11}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layanan Tambahan -->
                <div class="card shadow mb-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="card-body">
                        <strong class="card-title mb-3">➕ Layanan Tambahan</strong>
                        <div class="row">
                            @foreach ($layananTambahanList as $lt)
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                name="id_layanantambahan[]" 
                                                id="layanan_{{ $lt->id }}" 
                                                value="{{ $lt->id }}">
                                            <label class="form-check-label" for="layanan_{{ $lt->id }}">
                                                {{ $lt->nama_layanan }}
                                            </label>
                                            <p class="text-muted small mt-2">Rp{{ number_format($lt->harga_layanan, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Transportasi -->
                <div class="card shadow mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body">
                        <strong class="card-title mb-3">🚗 Pilih Transportasi</strong>
                        <div class="row">
                            @foreach ($transportasiList as $transport)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm h-100 border-0 hover:shadow-xl transition transform hover:scale-105 duration-300">
                                        @if ($transport->gambar_kendaraan)
                                            <img src="{{ asset('storage/' . $transport->gambar_kendaraan) }}" 
                                                class="card-img-top" 
                                                style="height: 220px; object-fit: cover;" 
                                                alt="{{ $transport->wisatawan_kendaraan }}">
                                        @else
                                            <img src="https://via.placeholder.com/300x200?text=Gambar+Tidak+Ada" 
                                                class="card-img-top" 
                                                style="height: 220px; object-fit: cover;" 
                                                alt="Tidak ada gambar">
                                        @endif

                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-primary">{{ $transport->wisatawan_kendaraan }}</h5>
                                            <ul class="list-unstyled small mb-3">
                                                <li><strong>Jenis :</strong> {{ $transport->jenis_kendaraan }}</li>
                                                <li><strong>Nomor :</strong> {{ $transport->nomor_kendaraan }}</li>
                                                <li><strong>Sopir :</strong> {{ $transport->sopir }}</li>
                                                <li><strong>Kapasitas :</strong> {{ $transport->kursi }} kursi</li>
                                                <li><strong>Harga Sewa :</strong> Rp{{ number_format($transport->harga_sewa, 0, ',', '.') }}</li>
                                            </ul>
                                            <div class="mt-auto">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="transportasi_id" value="{{ $transport->id }}" required id="transport_{{ $transport->id }}">
                                                    <label class="form-check-label" for="transport_{{ $transport->id }}">
                                                        Pilih Transportasi Ini
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="text-right mt-5">
                    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                        <a href="{{ url('/') }}" class="btn btn-lg btn-outline-primary">🏠 Kembali ke Beranda</a>
                        <button type="submit" class="btn btn-lg btn-primary">✅ Konfirmasi & Pesan Sekarang</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="p-8 bg-white text-black text-center">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
            <img src="{{ asset('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" class="h-12">
            <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Jogja Travel. Semua Hak Dilindungi.</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:scale-110 transition transform"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="WhatsApp" class="h-6"></a>
                <a href="#" class="hover:scale-110 transition transform"><img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Facebook" class="h-6"></a>
                <a href="#" class="hover:scale-110 transition transform"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" class="h-6"></a>
            </div>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
    </script>
</body>
</html>
