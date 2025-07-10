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
                    <li><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg></li>
                    <li class="text-gray-500 font-medium">Hasil Rekomendasi</li>
                    <li><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg></li>
                    <li class="text-gray-500 font-medium">Konfirmasi Destinasi</li>
                    <li><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg></li>
                    <li class="text-gray-500 font-medium">Lengkapi Data Diri</li>
                    <li><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg></li>
                    <li class="text-gray-500 font-semibold">Konfirmasi Pesanan</li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="h-[40vh] pt-20 flex flex-col justify-center items-center text-white bg-cover bg-center" style="background-image: url('{{ asset('storage/images/borobudur.jpg') }}');" data-aos="fade-in">
        <section class="py-16 px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Destinasi Wisata</h2>
            <p class="max-w-3xl mx-auto mb-4">
                Temukan destinasi wisata populer, paket tur menarik, dan pengalaman liburan tak terlupakan yang disesuaikan dengan kebutuhan Anda.
            </p>
            <p class="text-sm italic">*budget belum termasuk biaya sewa transportasi dan layanan tambahan lainnya</p>
        </section>
    </section>

    <!-- Content Section -->
    <div class="container mx-auto px-6 py-10 text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" alt="Success" class="w-20 mx-auto mb-4">
        <h1 class="text-3xl font-bold text-green-600 mb-6">Pembayaran Berhasil!</h1>
        <p class="text-lg mb-6">Terima kasih telah mengunggah bukti pembayaran.</p>
        <p class="text-md mb-4">Silakan hubungi pengelola melalui WhatsApp untuk proses lebih lanjut terkait dengan jadwal dan teknis perjalanan.</p>

        <a href="https://wa.me/6281325001074?text=Saya%20ingin%20mengkonfirmasi%20pembayaran%20saya%20dengan%20nama%3A" 
            class="inline-block bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 transition" 
            target="_blank">
            Hubungi Pengelola via WhatsApp
        </a>

        <div class="mt-10 text-left max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Detail Pesanan Anda</h2>
            <p><strong>Nama:</strong> {{ $pesanan->wisatawan }}</p>
            <p><strong>Kota Asal:</strong> {{ $pesanan->kota_asal }}</p>
            <p><strong>Jumlah Orang:</strong> {{ $jumlahOrang }}</p>
            <p><strong>Tanggal Keberangkatan:</strong> {{ $pesanan->tanggal_keberangkatan }}</p>
            <p><strong>Titik Jemput:</strong> {{ $pesanan->titik_jemput }}</p>
            <p><strong>Transportasi:</strong> {{ $pesanan->transportasi->nama_kendaraan ?? '-' }}</p>
            <p><strong>Total Biaya:</strong> Rp{{ number_format($totalAkhir, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="p-8 bg-white text-black text-center">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <img src="{{ asset('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" class="h-12">
            <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Jogja Travel. Semua Hak Dilindungi.</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:scale-110 transition-transform">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="WhatsApp" class="h-6">
                </a>
                <a href="#" class="hover:scale-110 transition-transform">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Facebook" class="h-6">
                </a>
                <a href="#" class="hover:scale-110 transition-transform">
                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" class="h-6">
                </a>
            </div>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>AOS.init({ duration: 1000, once: true });</script>

    <!-- SweetAlert -->
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
