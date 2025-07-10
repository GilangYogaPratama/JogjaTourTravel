<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogja Tour & Travel</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Lora:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="bg-blue-100 font-[Poppins]">

    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-md p-4 fixed top-0 w-full z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="{{ asset('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" class="h-12">
            </a>
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
                    <li class="text-gray-500 font-medium">Lengkapi Data Diri</li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li class="text-gray-500 font-semibold">Konfirmasi Pesanan</li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="h-[40vh] pt-20 flex flex-col justify-center items-center text-white bg-cover bg-center" style="background-image: url('{{ asset('storage/images/borobudur.jpg') }}');" data-aos="fade-in">
        <section class="py-16 px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Destinasi Wisata</h2>
            <p class="text-white max-w-3xl mx-auto mb-4">
                Temukan destinasi wisata populer, paket tur menarik, dan pengalaman liburan tak terlupakan yang disesuaikan dengan kebutuhan Anda.
            </p>
            <p class="text-sm italic text-white">*budget belum termasuk biaya sewa transportasi dan layanan tambahan lainnya</p>
        </section>
    </section>

    <!--Konten-->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8">📝 Konfirmasi Perjalanan</h2>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Data Diri dan Detail -->
            <div class="md:col-span-2 space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Data Diri -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">📋 Detail Pemesanan</h3>
                        <div class="grid gap-3 text-sm">
                            <div>
                                <p class="font-semibold">Nama:</p>
                                <p>{{ $dataDiri['wisatawan'] }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Kota Asal:</p>
                                <p>{{ $dataDiri['kota_asal'] }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Jumlah Orang:</p>
                                <p>{{ $dataDiri['jumlah_orang'] }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Tanggal Keberangkatan:</p>
                                <p>{{ $dataDiri['tanggal_keberangkatan'] }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Titik Jemput:</p>
                                <p>{{ $dataDiri['titik_jemput'] }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">No. Telepon:</p>
                                <p>{{ $dataDiri['telefon'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Transportasi -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">🚗 Transportasi</h3>
                        <div class="w-full">
                            <div class="border-0">
                                @if ($transportasi->gambar_kendaraan)
                                    <img src="{{ asset('storage/' . $transportasi->gambar_kendaraan) }}" 
                                        class="w-full h-48 object-cover rounded-md mb-4" 
                                        alt="{{ $transportasi->wisatawan_kendaraan }}">
                                @else
                                    <img src="https://via.placeholder.com/300x200?text=Gambar+Tidak+Ada" 
                                        class="w-full h-48 object-cover rounded-md mb-4" 
                                        alt="Tidak ada gambar">
                                @endif
                                <div>
                                    <h5 class="text-lg text-primary font-semibold">{{ $transportasi->wisatawan_kendaraan }}</h5>
                                    <ul class="list-none text-sm mt-2 space-y-1">
                                        <li><strong>Jenis :</strong> {{ $transportasi->jenis_kendaraan }}</li>
                                        <li><strong>Nomor :</strong> {{ $transportasi->nomor_kendaraan }}</li>
                                        <li><strong>Sopir :</strong> {{ $transportasi->sopir }}</li>
                                        <li><strong>Kapasitas :</strong> {{ $transportasi->kursi }} kursi</li>
                                        <li><strong>Harga Sewa :</strong> Rp{{ number_format($transportasi->harga_sewa, 0, ',', '.') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layanan Tambahan -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">➕ Layanan Tambahan</h3>
                    @if(count($layananTambahan) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ($layananTambahan as $lt)
                                <div class="bg-white border rounded-md shadow-sm p-4 hover:shadow-md transition">
                                    <h4 class="font-medium text-sm">{{ $lt->nama_layanan }}</h4>
                                    <p class="text-muted text-xs mt-1">Rp{{ number_format($lt->harga_layanan, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm italic text-gray-500">Tidak ada layanan tambahan dipilih.</p>
                    @endif
                </div>

                <!-- Destinasi -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">📍 Destinasi</h3>
                    <div class="grid md:grid-cols-3 gap-4">
                        @foreach($daftarDestinasi as $d)
                            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 w-full max-w-xs mx-auto">
                            <img src="{{ asset('storage/' . $d->gambar_wisata) }}" alt="{{ $d->nama_destinasi }}" class="w-full h-40 object-cover">
                                <div class="p-4 text-left flex flex-col justify-between h-[250px]">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $d->nama_destinasi }}</h3>
                                        <p class="text-sm text-gray-600 mb-2">{{ $d->lokasi }}</p>
                                        <p class="text-sm text-gray-600 mb-2 line-clamp-3">{{ $d->deskripsi }}</p>
                                    </div>
                                    <div class="flex items-center justify-between mt-auto">
                                        <span class="text-blue-600 font-bold">Rp{{ number_format($d->harga) }}</span>
                                        <span class="text-gray-700 text-sm">{{ $d->rating }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan dan Tombol -->
            <div class="bg-white rounded-lg shadow-md p-6">
                @php
                    $jumlahOrang = (int) $dataDiri['jumlah_orang'];

                    // Total harga destinasi (dikalikan per orang)
                    $totalDestinasi = $daftarDestinasi->sum('harga');
                    $totalDestinasiSemuaOrang = $totalDestinasi * $jumlahOrang;

                    // Total harga layanan tambahan
                    $totalLayananTambahan = 0;
                    foreach ($layananTambahan as $lt) {
                        if (Str::contains(strtolower($lt->nama_layanan), 'catering')) {
                            // Jika nama layanan mengandung "catering", kalikan jumlah orang
                            $totalLayananTambahan += $lt->harga_layanan * $jumlahOrang;
                        } else {
                            $totalLayananTambahan += $lt->harga_layanan;
                        }
                    }

                    // Harga transportasi
                    $hargaTransportasi = $transportasi->harga_sewa ?? 0;

                    // Total keseluruhan
                    $totalAkhir = $totalDestinasiSemuaOrang + $totalLayananTambahan + $hargaTransportasi;
                @endphp
                <h3 class="text-xl font-semibold mb-4">💰 Rincian Biaya</h3>

                <!-- Destinasi -->
                <ul><strong>Destinasi x {{ $jumlahOrang }} orang</strong></ul>
                <ul class="mb-4 space-y-2 text-sm">
                    @foreach($daftarDestinasi as $d)
                        <li class="flex justify-between">
                            <span>{{ $d->nama_destinasi }}</span>
                            <span>Rp{{ number_format($d->harga, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>

                <!-- Layanan Tambahan -->
                <ul><strong>Layanan Tambahan</strong></ul>
                <ul class="mb-4 space-y-2 text-sm">
                    @foreach($layananTambahan as $lt)
                        <li class="flex justify-between">
                            <span>
                                {{ $lt->nama_layanan }}
                                @if(Str::contains(strtolower($lt->nama_layanan), 'catering'))
                                    x {{ $jumlahOrang }} orang
                                @endif
                            </span>
                            <span>
                                Rp{{ number_format(
                                    Str::contains(strtolower($lt->nama_layanan), 'catering') 
                                        ? $lt->harga_layanan * $jumlahOrang 
                                        : $lt->harga_layanan, 
                                    0, ',', '.') 
                                }}
                            </span>
                        </li>
                    @endforeach
                </ul>

                <!-- Transportasi -->
                <ul><strong>Transportasi</strong></ul>
                <ul class="mb-4 space-y-2 text-sm">
                    <li class="flex justify-between">
                        <span>{{ $transportasi->nama_kendaraan ?? '-' }}</span>
                        <span>Rp{{ number_format($hargaTransportasi, 0, ',', '.') }}</span>
                    </li>
                </ul>

                <!-- Total Akhir -->
                <hr class="my-4">
                <div class="text-sm space-y-1">
                    <div class="flex justify-between">
                        <span class="font-semibold">Total biaya destinasi {{ $jumlahOrang }} orang:</span>
                        <span>Rp{{ number_format($totalDestinasiSemuaOrang, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Total layanan tambahan:</span>
                        <span>Rp{{ number_format($totalLayananTambahan, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Transportasi:</span>
                        <span>Rp{{ number_format($hargaTransportasi, 0, ',', '.') }}</span>
                    </div>
                </div>

                <hr class="my-4">
                <p class="text-lg font-semibold"><strong>Total Biaya Keseluruhan:</strong></p>
                <p class="text-green"><strong>Rp{{ number_format($totalAkhir, 0, ',', '.') }}</strong></p>

                <div class="mt-6 space-y-2">
                    <form method="POST" action="{{ route('pesanan.store') }}">
                        @csrf
                        <input type="hidden" name="data" value="{{ json_encode($dataDiri) }}">
                        <input type="hidden" name="transportasi_id" value="{{ $transportasi->id ?? '' }}">
                        @foreach($layananTambahan as $lt)
                            <input type="hidden" name="id_layanantambahan[]" value="{{ $lt->id }}">
                        @endforeach
                        @foreach($daftarDestinasi as $d)
                            <input type="hidden" name="destinasi_id[]" value="{{ $d->id }}">
                        @endforeach
                        <input type="hidden" name="total_biaya" value="{{ $totalAkhir }}">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">✅ Konfirmasi Pemesanan</button>
                    </form>
                    <a href="{{ url()->previous() }}" class="w-full block text-center bg-gray-300 text-gray-800 py-2 px-4 rounded hover:bg-gray-400"> Kembali</a>
                    <a href="{{ url()->previous() }}" class="w-full block text-center bg-gray-300 text-gray-800 py-2 px-4 rounded hover:bg-gray-400">❌ Batalkan</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="p-8 bg-white text-black text-center">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <img src="{{ asset('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" class="h-12">
            <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Jogja Travel. Semua Hak Dilindungi.</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:scale-110 transition-transform"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="WhatsApp" class="h-6"></a>
                <a href="#" class="hover:scale-110 transition-transform"><img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Facebook" class="h-6"></a>
                <a href="#" class="hover:scale-110 transition-transform"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" class="h-6"></a>
            </div>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>AOS.init({ duration: 1000, once: true });</script>

</body>
</html>