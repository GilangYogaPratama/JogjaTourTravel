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
                    <li class="text-gray-500 font-semibold">Hasil Rekomendasi</li>
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
            <h2 class="text-4xl font-bold mb-4">Rekomendasi destinasi</h2>
            <p class="text-gray max-w-3xl mx-auto mb-8">
                Temukan destinasi wisata populer, paket tur menarik, dan pengalaman liburan tak terlupakan yang disesuaikan dengan kebutuhan Anda.
                Masukkan budget dan jumlah orang, lalu biarkan sistem kami menyarankan pilihan terbaik untuk Anda.
            </p>

            <p class="text-sm italic text-white mt-4">
                *budget belum termasuk biaya sewa transportasi dan layanan tambahan lainnya
            </p>
        </section>
    </section>

    <!-- Destinations Section -->
    <section id="destinations" class="py-10 bg-gradient-to-r from-blue-100 via-white to-blue-100 text-center">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Judul -->
            <h2 class="text-3xl font-bold mb-4">Hasil Rekomendasi</h2>

            <!-- Info Budget -->
            <div class="flex flex-wrap justify-center items-center gap-x-6 text-base mb-8">
                <p class="mb-0">Budget per orang: <strong>Rp{{ number_format($budgetPerOrang) }}</strong></p>
                <p class="mb-0">Sisa budget per orang: <strong>Rp{{ number_format($sisaBudget) }}</strong></p>
            </div>

            <!-- Grid Destinasi -->
            @if(count($destinasiTerpilih) > 0)
                <div class="grid justify-center grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($destinasiTerpilih as $destinasi)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 w-full max-w-xs mx-auto">
                        <img src="{{ asset('storage/' . $destinasi->gambar_wisata) }}" alt="{{ $destinasi->nama_destinasi }}" class="w-full h-40 object-cover">
                            <div class="p-4 text-left flex flex-col justify-between h-[250px]">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $destinasi->nama_destinasi }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">{{ $destinasi->lokasi }}</p>
                                    <p class="text-sm text-gray-600 mb-2 line-clamp-3">{{ $destinasi->deskripsi }}</p>
                                </div>
                                <div class="flex items-center justify-between mt-auto">
                                    <span class="text-blue-600 font-bold">Rp{{ number_format($destinasi->harga) }}</span>
                                    <span class="text-gray-700 text-sm">{{ $destinasi->rating }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <br>
            <form action="{{ route('rekomendasi.editRedirect') }}" method="POST">
                @csrf
                @foreach ($destinasiTerpilih as $destinasi)
                    <input type="hidden" name="destinasi_ids[]" value="{{ $destinasi->id }}">
                @endforeach
                <input type="hidden" name="jumlah_orang" value="{{ $jumlahOrang }}">
                <a href="/" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                    <i class="bi bi-caret-left"></i></i>Kembali
                </a>
                &nbsp;
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Lanjutkan pemesanan &nbsp;<i class="fas fa-paper-plane mr-2"></i>
                </button>
            </form>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-10 bg-green-100 text-center">
        <h3 class="text-3xl font-bold mb-6" data-aos="fade-down">Hubungi Kami</h3>
        <p class="text-gray-700 mb-4" data-aos="fade-up">Butuh bantuan? Kami siap membantu Anda.</p>

        <div class="max-w-2x mx-auto px-6 text-left flex flex-col items-center justify-center">
            <!-- Formulir Kontak -->
            <form action="contact.php" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md" data-aos="zoom-in" >
                <p class="text-left">Nama anda/<i>Your Name</i></p>
                <input type="text" name="name" placeholder="Nama Anda" class="w-full p-2 mb-4 border rounded">
                
                <p class="text-left">E-mail anda/<i>Your E-mail</i></p>
                <input type="email" name="email" placeholder="Email Anda" class="w-full p-2 mb-4 border rounded">
                
                <p class="text-left">Masukkan pesan anda/<i>Your message</i></p>
                <textarea name="message" placeholder="Pesan Anda" class="w-full p-2 mb-4 border rounded"></textarea>
                
                <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-lg shadow-md hover:bg-blue-600 transition transform hover:scale-105">Kirim</button>
            </form>
            
            <br>
            
            <button class="flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-full transition duration-300 shadow-lg transform hover:scale-105"
                data-aos="zoom-in-down">
                <img src="https://cdn-icons-png.flaticon.com/512/3669/3669725.png" alt="Icon" class="h-6 w-6 mr-3">
                Hubungi Kami via WhatsApp
            </button>
        </div>
    </section>

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
