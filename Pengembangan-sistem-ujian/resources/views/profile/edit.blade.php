<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-50 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-6 py-4">
            <h2 class="font-bold text-2xl text-purple-700">
                👤 Profil Pengguna
            </h2>
        </div>
    </header>

    <!-- Content -->
    <main class="py-10">
        <div class="max-w-4xl mx-auto px-6">

            <!-- Profile Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <!-- Header Profile -->
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-8 flex items-center gap-6">
                    <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center shadow-lg">
                        <span class="text-4xl">🎓</span>
                    </div>

                    <div class="text-white">
                        <h3 class="text-2xl font-bold">
                            Nama Pengguna
                        </h3>
                        <p class="opacity-90">
                            email@email.com
                        </p>

                        <span class="inline-block mt-2 px-4 py-1 text-sm rounded-full bg-white/20">
                            Murid
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 grid md:grid-cols-2 gap-6">

                    <!-- Info Akun -->
                    <div class="bg-purple-50 rounded-2xl p-6 border border-purple-100">
                        <h4 class="font-semibold text-purple-700 mb-4 flex items-center gap-2">
                            📋 Informasi Akun
                        </h4>

                        <ul class="space-y-3 text-gray-700">
                            <li class="flex justify-between">
                                <span>Nama</span>
                                <span class="font-medium">Nama Pengguna</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Email</span>
                                <span class="font-medium">email@email.com</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Role</span>
                                <span class="font-medium capitalize">murid</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Aktivitas Quiz -->
                    <div class="bg-indigo-50 rounded-2xl p-6 border border-indigo-100">
                        <h4 class="font-semibold text-indigo-700 mb-4 flex items-center gap-2">
                            🧠 Aktivitas Quiz
                        </h4>

                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-white rounded-xl p-4 shadow">
                                <p class="text-2xl font-bold text-purple-600">12</p>
                                <p class="text-sm text-gray-600">Quiz Diikuti</p>
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow">
                                <p class="text-2xl font-bold text-indigo-600">85%</p>
                                <p class="text-sm text-gray-600">Rata-rata Nilai</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-8 pb-8 flex justify-end gap-4">
                    <a href="murid/dashboard"
                       class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 transition font-medium">
                        ⬅ Kembali
                    </a>

                    <a href="#"
                       class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold hover:scale-105 transition shadow-lg">
                        ✏️ Edit Profil
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
