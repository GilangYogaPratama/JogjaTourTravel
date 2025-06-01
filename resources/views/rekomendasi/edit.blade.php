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
                    <li><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg></li>
                    <li class="text-gray-500 font-medium">Hasil Rekomendasi</li>
                    <li><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg></li>
                    <li class="text-gray-500 font-semibold">Konfirmasi Destinasi</li>
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

    <!-- Konten -->
    <div class="w-full bg-blue-100 py-10">
        <div class="container mx-auto px-4">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold">Pilih destinasi sesuai dengan keinginan anda</h2>
                <p class="text-gray-700 text-sm">Harga belum termasuk transportasi dan layanan tambahan lainnya</p>
            </div>

            <div class="flex flex-col md:flex-row gap-10">
                <!-- Sidebar -->
                <div class="bg-white p-6 rounded shadow-lg w-full md:w-1/4">
                    <h3 class="text-xl font-semibold mb-4">Destinasi Anda</h3>
                    <ul class="space-y-3">
                        @forelse($gabunganDestinasi as $d)
                            <li class="flex justify-between items-center bg-gray-50 p-3 rounded">
                                <span class="text-sm font-medium">{{ $d->nama_destinasi }}</span>
                                <form method="POST" action="{{ route('rekomendasi.hapus') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $d->id }}">
                                    <button type="submit" class="text-red-500 text-xs hover:text-red-700">Hapus</button>
                                </form>
                            </li>
                        @empty
                            <li class="text-gray-500 text-sm">Belum ada destinasi dipilih.</li>
                        @endforelse
                    </ul>
                    <p class="mt-6 text-sm">Total biaya per orang: <strong class="text-blue-700">Rp{{ number_format($totalHargaPerOrang) }}</strong></p>
                </div>

                <!-- Daftar Destinasi -->
                <div class="w-full md:w-3/4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($semuaDestinasi as $destinasi)
                            @php
                                $isManual = in_array($destinasi->id, $daftarDestinasi->pluck('id')->toArray());
                                $isTerpilih = in_array($destinasi->id, $gabunganDestinasi->pluck('id')->toArray());
                            @endphp
                            <div class="bg-white rounded-xl shadow-md overflow-hidden transition duration-300 {{ $isTerpilih ? 'border-4 border-blue-600' : 'border border-gray-200' }}">
                                <img src="{{ asset('storage/' . $destinasi->gambar_wisata) }}" alt="{{ $destinasi->nama_destinasi }}" class="w-full h-40 object-cover">
                                <div class="p-4 flex flex-col justify-between h-[180px]">
                                    <div>
                                        <h3 class="text-lg font-semibold">{{ $destinasi->nama_destinasi }}</h3>
                                        <p class="text-sm text-gray-600">{{ Str::limit($destinasi->deskripsi, 100) }}</p>
                                    </div>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-blue-600 font-bold">Rp{{ number_format($destinasi->harga) }}</span>
                                        <span class="text-gray-700 text-sm">{{ $destinasi->rating }}</span>
                                    </div>
                                </div>
                                <div class="p-4 text-center">
                                    @if($isTerpilih)
                                        <form method="POST" action="{{ route('rekomendasi.hapus') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $destinasi->id }}">
                                            <button type="submit" class="px-4 py-2 rounded-lg bg-red-100 text-red-600 font-semibold hover:bg-red-200 shadow-sm">Hapus dari destinasi</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('rekomendasi.tambah') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $destinasi->id }}">
                                            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-100 text-blue-600 font-semibold hover:bg-blue-200 shadow-sm">Tambahkan ke destinasi</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigasi -->
                    <div class="mt-8 flex flex-col md:flex-row gap-4">
                        <form method="POST" action="{{ route('rekomendasi.batalkan') }}">
                            @csrf
                            <button type="submit" class="w-full md:w-auto px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Batalkan Pemesanan</button>
                        </form>
                        <form method="POST" action="{{ route('rekomendasi.simpan') }}">
                            @csrf
                            <input type="hidden" name="budget" value="{{ $totalBudget }}">
                            <input type="hidden" name="jumlah_orang" value="{{ $jumlahOrang }}">
                            <button type="submit" class="w-full md:w-auto bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow-md">Lanjutkan Pemesanan <i class="fas fa-paper-plane ml-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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