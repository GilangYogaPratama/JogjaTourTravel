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
<body class="bg-gray-100 font-[Poppins]">

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

    <!-- Detail Section -->
    <section class="container mx-auto px-6 py-10">
        <h2 class="text-2xl font-semibold mb-6">Konfirmasi pembayaran</h2>

        <div class="bg-white shadow-md rounded-lg p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Form Detail -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" value="{{ $pesanan->wisatawan }}" readonly class="w-full border px-3 py-2 rounded-md bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kota Asal</label>
                    <input type="text" value="{{ $pesanan->kota_asal }}" readonly class="w-full border px-3 py-2 rounded-md bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah Orang</label>
                    <input type="text" value="{{ $pesanan->jumlah_orang ?? '-' }}" readonly class="w-full border px-3 py-2 rounded-md bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Awal Perjalanan</label>
                    <input type="text" value="{{ $pesanan->tanggal_keberangkatan }}" readonly class="w-full border px-3 py-2 rounded-md bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Titik Jemput</label>
                    <input type="text" value="{{ $pesanan->titik_jemput }}" readonly class="w-full border px-3 py-2 rounded-md bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" value="{{ $pesanan->telefon }}" readonly class="w-full border px-3 py-2 rounded-md bg-gray-50">
                </div>
            </div>

            <!-- Transportasi -->
            <div class="bg-gray-50 p-4 rounded-md shadow-sm">
                <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('storage/' . $pesanan->transportasi->gambar_kendaraan) }}" class="w-full h-48 object-cover rounded-md mb-4" alt="{{ $pesanan->transportasi->wisatawan_kendaraan }}">
                </div>
                <h3 class="text-lg font-semibold">{{ $pesanan->transportasi->nama_kendaraan ?? 'Tidak Ditemukan' }}</h3>
                <div>
                    <p class="text-sm text-gray-600">Deskripsi transportasi</p>
                    <h5 class="text-lg text-primary font-semibold">{{ $pesanan->transportasi->wisatawan_kendaraan }}</h5>
                    <ul class="list-none text-sm mt-2 space-y-1">
                        <li><strong>Jenis :</strong> {{ $pesanan->transportasi->jenis_kendaraan }}</li>
                        <li><strong>Nomor :</strong> {{ $pesanan->transportasi->nomor_kendaraan }}</li>
                        <li><strong>Sopir :</strong> {{ $pesanan->transportasi->sopir }}</li>
                        <li><strong>Kapasitas :</strong> {{ $pesanan->transportasi->kursi }} kursi</li>
                        <li><strong>Harga Sewa :</strong> Rp{{ number_format($pesanan->transportasi->harga_sewa, 0, ',', '.') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Konfirmasi & Detail -->
            <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-md space-y-2">
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
            </div>
                <a href="https://wa.me/{{ $pesanan->telefon }}" class="block w-full text-center bg-green-500 text-white py-2 rounded-md font-medium">Konfirmasi melalui WhatsApp</a>
                <a href="{{ route('pesanan.download', $pesanan->id) }}" target="_blank" class="block w-full text-center border py-2 rounded-md font-medium">
                    Download detail pesanan
                </a>

                <form action="{{ route('pembayaran.uploadBukti', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Silakan upload bukti pembayaran</label>
                        <input type="file" name="bukti_pembayaran" class="w-full border rounded-md p-2" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md mt-4">Submit dokumen</button>
                </form>
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

    {{-- Tambahkan SweetAlert CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(Session::has('upload_success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Bukti pembayaran berhasil diupload.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

</body>
</html>