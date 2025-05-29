<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogja Tour & Travel</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS (Animate On Scroll) CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Lora:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="bg-gray-100" style="font-family: 'Poppins', sans-serif;">

    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-md p-4 fixed top-0 w-full z-50">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="{{ asset('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" class="h-12">
            </a>

            <!-- Breadcrumb (aestetik style) -->
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="{{ url('/') }}" class="hover:text-blue-600 font-medium transition-colors">Homepage</a>
                    </li>
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
                    <li class="text-gray-500 font-semibold">Konfirmasi Destinasi</li>
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

        <section class="py-16 px-4 text-left text-gray">
            <h2 class="text-4xl font-bold mb-4">Destinasi Wisata</h2>
            <p class="text-gray max-w-3xl mx-auto mb-8">
                Temukan destinasi wisata populer, paket tur menarik, dan pengalaman liburan tak terlupakan yang disesuaikan dengan kebutuhan Anda.
                Masukkan budget dan jumlah orang, lalu biarkan sistem kami menyarankan pilihan terbaik untuk Anda.
            </p>

            <p class="text-sm italic text-white mt-4">
                *budget belum termasuk biaya sewa transportasi dan layanan tambahan lainnya
            </p>
        </section>
    </section>

    <!-- Div luar dengan full-width gradient -->
    <div class="w-full bg-gradient-to-r from-blue-100 via-white to-blue-100 py-10">
        <!-- Kontainer isi tetap rapi di tengah -->
        <div class="container mx-auto px-4">
            <!-- Isi konten di sini -->
            <h2 class="text-xl font-semibold mb-2">Pilih destinasi sesuai dengan keinginan anda</h2>
            <p class="text-gray-600 mb-8 text-medium">Pilih destinasi sesuai dengan keinginan anda <br><span class="text-sm">Harga belum termasuk transportasi dan layanan tambahan lainnya</span></p>

            <div class="flex flex-col md:flex-row gap-10">
                <!-- Sidebar destinasi terpilih -->
                <div class="bg-white p-6 rounded shadow-lg w-full md:w-1/5">
                    <h3 class="text-xl font-semibold mb-4">Destinasi Anda</h3>
                    <ul class="space-y-3">
                        @forelse($gabunganDestinasi as $d)
                            <li class="flex items-center justify-between bg-gray-50 p-3 rounded shadow-sm">
                                <span class="text-sm font-medium text-gray-800">{{ $d->nama_destinasi }}</span>
                                <form method="POST" action="{{ route('rekomendasi.hapus') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $d->id }}">
                                    <button type="submit" class="text-red-500 text-xs hover:text-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </li>
                        @empty
                            <li class="text-gray-500 text-sm">Belum ada destinasi dipilih.</li>
                        @endforelse
                    </ul>
                    <p class="mt-6 text-sm">Total biaya per orang: 
                        <strong class="text-blue-700">Rp{{ number_format($totalHargaPerOrang) }}</strong>
                    </p>
                </div>

                <!-- Grid semua destinasi -->
                <div class="w-full md:w-3/4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($semuaDestinasi as $destinasi)
                            @php
                                $isManual = in_array($destinasi->id, $daftarDestinasi->pluck('id')->toArray());
                                $isTerpilih = in_array($destinasi->id, $gabunganDestinasi->pluck('id')->toArray());
                            @endphp
                            <div class="bg-white rounded-xl overflow-hidden shadow-md transition duration-300
                            w-[350px] mx-auto
                            {{ $isTerpilih ? 'border-4 border-blue-600' : 'border border-gray-200' }}">
                                    <img src="{{ asset('storage/' . $destinasi->gambar_wisata) }}" alt="{{ $destinasi->nama_destinasi }}" class="w-full h-40 object-cover">

                                <div class="p-4 text-left flex flex-col justify-between h-[180px]">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $destinasi->nama_destinasi }}</h3>
                                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($destinasi->deskripsi, 100) }}</p>
                                    </div>
                                    <div class="flex justify-between items-center mt-auto">
                                        <span class="text-blue-600 font-bold">Rp{{ number_format($destinasi->harga) }}</span>
                                        <span class="text-gray-700 text-sm">{{ $destinasi->rating }}</span>
                                    </div>
                                </div>
                                <div class="p-4 text-center">
                                    @if($isTerpilih)
                                        <form method="POST" action="{{ route('rekomendasi.hapus') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $destinasi->id }}">
                                            <button type="submit"
                                                class="px-4 py-2 rounded-lg bg-red-100 text-red-600 font-semibold hover:bg-red-200 transition duration-200 shadow-sm hover:shadow-md">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus dari destinasi
                                            </button>
                                        </form>
                                    @elseif(!$isTerpilih)
                                        <form method="POST" action="{{ route('rekomendasi.tambah') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $destinasi->id }}">
                                            <button type="submit"
                                                class="px-4 py-2 rounded-lg bg-blue-100 text-blue-600 font-semibold hover:bg-blue-200 transition duration-200 shadow-sm hover:shadow-md">
                                                <i class="fas fa-plus"></i> Tambahkan ke destinasi
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Tombol Navigasi -->
                    <div class="mt-8 flex gap-4">
                    <form action="{{ route('rekomendasi.batalkan') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Batalkan Pemesanan
                        </button>
                    </form>
                    <form method="POST" action="{{ route('rekomendasi.simpan') }}">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow-md">
                            Lanjutkan Pemesanan &nbsp;<i class="fas fa-paper-plane mr-2"></i>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="p-8 bg-white text-black text-center">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
            <!-- Logo -->
            <img src="{{ asset('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" class="h-12">

            <!-- Teks Hak Cipta -->
            <p class="text-gray-400 text-sm">&copy; <?= date('Y'); ?> Jogja Travel. Semua Hak Dilindungi.</p>

            <!-- Social Media -->
            <div class="flex space-x-4">
                <a href="#" class="hover:scale-110 transition transform">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="WhatsApp" class="h-6">
                </a>
                <a href="#" class="hover:scale-110 transition transform">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Facebook" class="h-6">
                </a>
                <a href="#" class="hover:scale-110 transition transform">
                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" class="h-6">
                </a>
            </div>
        </div>
    </footer>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Durasi animasi 1 detik
            once: true, // Animasi hanya muncul sekali
        });
    </script>

</body>
</html>
