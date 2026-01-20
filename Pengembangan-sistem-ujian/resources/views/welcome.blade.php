<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Ujian Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 min-h-screen">

    <!-- NAVBAR -->
    <nav class="w-full px-8 py-4 flex justify-between items-center text-white">
        <h1 class="text-2xl font-bold tracking-wide">UjianOnline</h1>
        <a href="/login" class="bg-white text-indigo-600 px-5 py-2 rounded-full font-semibold hover:bg-gray-100 transition">
            Login
        </a>
    </nav>

    <!-- HERO SECTION -->
    <div class="flex flex-col md:flex-row items-center justify-between px-8 md:px-20 mt-10 text-white">

        <!-- TEXT -->
        <div class="max-w-xl">
            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                Belajar & Ujian Online <br>
                <span class="text-yellow-300">Lebih Seru Seperti Game 🎮</span>
            </h2>

            <p class="text-lg text-gray-200 mb-8">
                Sistem ujian online interaktif berbasis game edukasi untuk guru dan murid.
                Buat soal, kerjakan ujian, dan lihat hasil secara real-time.
            </p>

            <div class="flex gap-4">
                <a href="/login"
                   class="bg-yellow-400 text-indigo-900 px-6 py-3 rounded-full font-bold hover:bg-yellow-300 transition">
                    Mulai Sekarang
                </a>

                <a href="/login"
                   class="border border-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-indigo-600 transition">
                    Masuk Sebagai Guru / Murid
                </a>
            </div>
        </div>

        <!-- ILLUSTRATION -->
        <div class="mt-12 md:mt-0">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                 alt="Quiz Illustration"
                 class="w-80 drop-shadow-2xl">
        </div>
    </div>

    <!-- FEATURES -->
    <div class="bg-white rounded-t-3xl mt-20 px-8 md:px-20 py-16">

        <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">
            Fitur Unggulan 🚀
        </h3>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                <h4 class="font-bold text-xl mb-3 text-indigo-600">🎯 Ujian Interaktif</h4>
                <p class="text-gray-600">
                    Soal berbasis game membuat murid lebih fokus dan tidak bosan.
                </p>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                <h4 class="font-bold text-xl mb-3 text-purple-600">📊 Hasil Otomatis</h4>
                <p class="text-gray-600">
                    Nilai langsung muncul setelah ujian selesai.
                </p>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition">
                <h4 class="font-bold text-xl mb-3 text-pink-600">👩‍🏫 Guru & Murid</h4>
                <p class="text-gray-600">
                    Guru membuat soal, murid mengerjakan ujian dengan mudah.
                </p>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center text-white py-6">
        © {{ date('Y') }} Sistem Ujian Online — Dibuat dengan ❤️ & Laravel
    </footer>

</body>
</html>
