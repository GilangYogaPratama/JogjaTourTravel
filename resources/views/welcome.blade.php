<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pangkalan Data Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />
  <style>
    /* Tambahkan animasi fade-in dan slide */
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
      animation: fadeIn 1s ease-out forwards;
    }

    @keyframes slideInLeft {
      0% { opacity: 0; transform: translateX(-50px); }
      100% { opacity: 1; transform: translateX(0); }
    }

    .animate-slide-in-left {
      animation: slideInLeft 1s ease-out forwards;
    }

    @keyframes slideInRight {
      0% { opacity: 0; transform: translateX(50px); }
      100% { opacity: 1; transform: translateX(0); }
    }

    .animate-slide-in-right {
      animation: slideInRight 1s ease-out forwards;
    }
  </style>
</head>
<body
  class="min-h-screen flex items-center justify-center bg-gradient"
  style="background: linear-gradient(to right, #3b82f6, #33a1ea);"
>
  <div
    class="bg-white shadow-2xl rounded-2xl w-4/5 p-10 transition-all duration-300 ease-in-out transform hover:scale-105 animate-fade-in"
  >
    <nav class="flex justify-between items-center mb-8 pb-4">
      <div class="flex items-center space-x-3">
        <img
          src="{{ asset('storage/images/JTT_LOGO.png') }}"
          alt="Logo"
          class="w-30 h-14 animate-pulse"
        />
      </div>
      <ul class="flex space-x-6 text-gray-700">
        <li><a href="#" class="hover:text-blue-500 transition duration-300">Home</a></li>
        <li><a href="#" class="hover:text-blue-500 transition duration-300">Tentang Kami</a></li>
        <li><a href="#" class="hover:text-blue-500 transition duration-300">Galeri</a></li>
        <li><a href="#" class="hover:text-blue-500 transition duration-300">Profil</a></li>
        <li><a href="#" class="hover:text-blue-500 transition duration-300">Hubungi</a></li>
      </ul>
    </nav>

    <div class="flex items-center justify-between gap-8">
      <div class="w-1/2 animate-slide-in-left">
        <h1 class="text-5xl font-extrabold text-gray-800 leading-tight">
          <span class="text-blue-500">Dashboard pengelolaan layanan perjalanan wisata</span>
          <p><span class="text-yellow-500">Jogja Tour & Travel</span></p>
        </h1>
        <p class="text-gray-600 mt-4 text-lg">
          Platform administrasi digital untuk destinasi, transportasi, dan jadwal wisata Jogja Tour & Travel.
        </p>
        <br />
        <div class="space-x-4">
          <a
            href="{{ route('login') }}"
            class="inline-flex items-center px-10 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-md hover:bg-blue-700 transition-all duration-300 transform hover:scale-105"
          >
            <span class="text-lg mr-2"><i class="fas fa-paper-plane mr-2"></i></span> Login
          </a>
        </div>
      </div>

      <div class="w-1/2 animate-slide-in-right">
        <img
          src="https://img.freepik.com/free-vector/flat-background-world-tourism-day-celebration_23-2149533022.jpg?t=st=1748229612~exp=1748233212~hmac=8e01af7ce8a2317f00d8d4bc9a4e49fd5c8fc663da8eda929f3e2fd019950b71&w=1380"
          alt="Ilustrasi"
          class="w-full rounded-lg"
        />
      </div>
    </div>
  </div>
</body>
</html>
