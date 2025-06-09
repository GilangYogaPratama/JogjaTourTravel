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

</head>
<body class="bg-blue-100" style="font-family: 'Poppins', sans-serif;">

    <!-- Header -->
    <header class="bg-white text-gray-800 p-3 w-full top-0 shadow-md z-50">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="#">
                <img src="{{ asset('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" class="h-12">
            </a>

            <!-- Navigasi -->
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="#services" class="hover:text-yellow-400 transition duration-300 transform hover:scale-105"><b>Layanan</b></a></li>
                    <li><a href="#destinations" class="hover:text-yellow-400 transition duration-300 transform hover:scale-105"><b>Destinasi</b></a></li>
                    <li><a href="#contact" class="hover:text-yellow-400 transition duration-300 transform hover:scale-105"><b>Kontak</b></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section 
        class="h-[60vh] flex flex-col justify-center items-center text-center text-white bg-cover bg-center" 
        style="background-image: url('{{ asset('storage/images/borobudur.jpg') }}');"
        data-aos="fade-in" 
        data-aos-duration="1000">

        <section class="py-16 px-4 text-center text-gray">
            <h2 class="text-4xl font-bold mb-4">Dapatkan rekomendasi</h2>
            <p class="text-gray max-w-3xl mx-auto mb-8">
                Temukan destinasi wisata populer, paket tur menarik, dan pengalaman liburan tak terlupakan yang disesuaikan dengan kebutuhan Anda.
                Masukkan budget dan jumlah orang, lalu biarkan sistem kami menyarankan pilihan terbaik untuk Anda.
            </p>

            <form action="{{ route('rekomendasi.cari') }}" method="GET" class="flex flex-col md:flex-row justify-center items-center gap-4 max-w-xl mx-auto">
                <input
                    type="number"
                    name="budget"
                    placeholder="Masukkan budget..."
                    class="w-full md:w-1/2 px-4 py-2 border border-gray-600 rounded text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                    min="1"
                >
                <input
                    type="number"
                    name="jumlah_orang"
                    placeholder="Masukkan jumlah orang..."
                    class="w-full md:w-1/2 px-4 py-2 border border-gray-600 rounded text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                    min="1"
                >
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition"
                >
                    Cari
                </button>
            </form>

            <p class="text-sm italic text-white mt-4">
                *budget belum termasuk biaya sewa transportasi dan layanan tambahan lainnya
            </p>
        </section>
    </section>

    <!-- Destinations Section -->
    <section id="destinations" class="py-10 bg-blue-100 text-center" data-aos="fade-up" data-aos-duration="1000">
        <h3 class="text-3xl font-bold mb-10" data-aos="zoom-in" data-aos-delay="200">Destinasi Populer</h3>
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($destinasi as $index => $item)
                <div 
                    class="bg-white rounded-xl shadow hover:shadow-lg transition duration-300 overflow-hidden text-left" 
                    data-aos="fade-up" 
                    data-aos-delay="{{ $index * 100 }}" 
                    data-aos-duration="800"
                >
                    <img src="{{ asset('storage/' . $item->gambar_wisata) }}" alt="{{ $item->nama_destinasi }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold mb-1">{{ $item->nama_destinasi }}</h2>
                        <p class="text-sm text-gray-700 mb-3">
                            {{ \Illuminate\Support\Str::limit($item->lokasi, 80) }}
                        </p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-blue-600 font-bold">Rp.{{ number_format($item->harga, 0, ',', '.') }}</span>
                            <span class="text-gray-700 font-semibold">{{ $item->rating ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
            
            <a href="https://wa.me/6281325001074?text=Saya%20ingin%20bertanya%20bagaimana%20cara%20melakukan%20pemesanan?" 
                target="_blank" 
                class="flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-full transition duration-300 shadow-lg transform hover:scale-105"
                data-aos="zoom-in-down">
                    <img src="https://cdn-icons-png.flaticon.com/512/3669/3669725.png" alt="Icon" class="h-6 w-6 mr-3">
                    Hubungi Kami via WhatsApp
            </a>
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
