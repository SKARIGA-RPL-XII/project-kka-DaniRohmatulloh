<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Murid</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-50">

    <!-- NAVBAR -->
    <!-- NAVBAR -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <!-- LOGO -->
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold">
                    Q
                </div>
                <span class="font-extrabold text-xl text-gray-800">
                    QuizApp
                </span>
            </div>

            <!-- MENU -->
            <ul class="hidden md:flex items-center gap-8 font-semibold text-gray-600">
                <li class="hover:text-purple-600 transition">
                    <a href="#">Dashboard</a>
                </li>
                <li class="hover:text-purple-600 transition">
                    <a href="#">Quiz</a>
                </li>
                <li class="hover:text-purple-600 transition">
                    <a href="#">Riwayat</a>
                </li>
            </ul>

            <!-- PROFILE DROPDOWN (POLLOSAN) -->
            <div class="relative">
                <button onclick="toggleProfile()"
                    class="flex items-center gap-3 bg-gray-50 px-4 py-2 rounded-xl hover:bg-gray-100 transition focus:outline-none">

                    <!-- ICON PROFILE -->
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold text-lg">
                        D
                    </div>

                    <span class="font-semibold text-gray-700 hidden sm:block">
                        Dani
                    </span>

                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- DROPDOWN -->
                <div id="profileDropdown"
                    class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border overflow-hidden animate-fade-in">

                    <div class="px-5 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
                        <p class="text-sm opacity-90">Login sebagai</p>
                        <p class="font-bold">Dani</p>
                    </div>

                    <a href="/profile"
                        class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-purple-50 transition">
                        👤 Profile
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-purple-50 transition">
                        ⚙️ Pengaturan
                    </a>

                    <div class="border-t"></div>

                    <div class="border-t"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-6 py-10">

        <!-- WELCOME -->
        <section class="mb-12">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">
                👋 Selamat Datang, Dani
            </h1>
            <p class="text-gray-600">
                Siap untuk mengerjakan quiz hari ini?
            </p>
        </section>

        <!-- STATISTIK -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-14">
            <div class="bg-white rounded-3xl shadow-lg p-6 text-center hover:scale-105 transition">
                <p class="text-4xl font-extrabold text-purple-600">12</p>
                <p class="text-gray-600 mt-1">Quiz Diikuti</p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 text-center hover:scale-105 transition">
                <p class="text-4xl font-extrabold text-indigo-600">85%</p>
                <p class="text-gray-600 mt-1">Rata-rata Nilai</p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 text-center hover:scale-105 transition">
                <p class="text-4xl font-extrabold text-pink-600">3</p>
                <p class="text-gray-600 mt-1">Quiz Aktif</p>
            </div>
        </section>

        <!-- QUIZ TERSEDIA -->
        <section>
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                🎮 Quiz Tersedia
            </h2>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">

                <div class="bg-white rounded-3xl shadow hover:shadow-xl transition overflow-hidden">
                    <div class="h-32 bg-gradient-to-r from-orange-400 to-pink-500 flex items-center justify-center text-white font-bold text-lg">
                        Bahasa Indonesia
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-1">
                            Teks Anekdot
                        </h3>
                        <p class="text-sm text-gray-500 mb-4">
                            20 Soal • 30 Menit
                        </p>
                        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-xl transition">
                            Mulai Quiz
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow hover:shadow-xl transition overflow-hidden">
                    <div class="h-32 bg-gradient-to-r from-blue-400 to-cyan-500 flex items-center justify-center text-white font-bold text-lg">
                        Bahasa Inggris
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-1">
                            Degree of Comparison
                        </h3>
                        <p class="text-sm text-gray-500 mb-4">
                            20 Soal • 25 Menit
                        </p>
                        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-xl transition">
                            Mulai Quiz
                        </button>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- DROPDOWN SCRIPT -->
    <script>
        function toggleProfile() {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const btn = document.querySelector('button[onclick="toggleProfile()"]');
            const dropdown = document.getElementById('profileDropdown');

            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

    <!-- ANIMATION -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.2s ease-out;
        }
    </style>

</body>

</html>