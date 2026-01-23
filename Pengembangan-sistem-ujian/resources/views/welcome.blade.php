<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Ujian Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">

    <!-- NAVBAR -->
    <nav class="border-b border-gray-100 px-6 md:px-12 py-4 flex justify-between items-center bg-white">
        <h1 class="text-2xl font-bold text-gray-900">
            UjianOnline
        </h1>
        <div class="flex gap-3">
            <a href="/login" class="text-gray-700 px-5 py-2 rounded-lg font-medium hover:bg-gray-50 transition">
                Login
            </a>
            <a href="/register" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                Register
            </a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="pt-20 pb-20 px-6 md:px-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-16">
            
            <!-- TEXT -->
            <div class="flex-1 max-w-2xl">
                <div class="inline-block bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                    ✨ Platform Ujian Modern
                </div>
                
                <h2 class="text-5xl md:text-6xl font-bold leading-tight mb-6 text-gray-900">
                    Belajar & Ujian Online
                    <span class="text-blue-600 block mt-2">
                        Lebih Mudah & Efisien
                    </span>
                </h2>

                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Sistem ujian online interaktif untuk guru dan murid.
                    Buat soal, kerjakan ujian, dan lihat hasil secara real-time.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/register"
                       class="bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition text-center">
                        Daftar Sekarang →
                    </a>

                    <a href="/login"
                       class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg font-semibold hover:border-gray-400 hover:bg-gray-50 transition text-center">
                        Login
                    </a>
                </div>

                <!-- STATS -->
                <div class="grid grid-cols-3 gap-6 mt-16 pt-12 border-t border-gray-200">
                    <div>
                        <div class="text-4xl font-bold text-blue-600">500+</div>
                        <div class="text-sm text-gray-600 mt-1">Pengguna Aktif</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-blue-600">1000+</div>
                        <div class="text-sm text-gray-600 mt-1">Soal Tersedia</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-blue-600">95%</div>
                        <div class="text-sm text-gray-600 mt-1">Kepuasan</div>
                    </div>
                </div>
            </div>

            <!-- ILLUSTRATION -->
            <div class="flex-1">
                <div class="bg-blue-50 p-12 rounded-2xl">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                         alt="Quiz Illustration"
                         class="w-full max-w-md mx-auto">
                </div>
            </div>
        </div>
    </div>

    <!-- FEATURES -->
    <div class="bg-gray-50 py-20 px-6 md:px-12">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold mb-4 text-gray-900">
                    Fitur Unggulan
                </h3>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Platform lengkap dengan berbagai fitur untuk pengalaman belajar yang lebih baik
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-3xl mb-5">
                        🎯
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">Ujian Interaktif</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Antarmuka yang mudah digunakan membuat proses ujian lebih lancar dan fokus.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center text-3xl mb-5">
                        📊
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">Hasil Otomatis</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Nilai langsung muncul setelah ujian selesai dengan analisis detail untuk setiap jawaban.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-pink-100 rounded-xl flex items-center justify-center text-3xl mb-5">
                        👩‍🏫
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">Guru & Murid</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Guru membuat soal, murid mengerjakan ujian dengan mudah dalam satu platform terintegrasi.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-3xl mb-5">
                        ⚡
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">Real-Time</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Pantau progres ujian secara langsung dan dapatkan notifikasi instant untuk setiap aktivitas.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center text-3xl mb-5">
                        🔒
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">Aman & Terpercaya</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Data terenkripsi dan sistem keamanan berlapis untuk melindungi privasi pengguna.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl border border-gray-200 hover:border-blue-200 hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center text-3xl mb-5">
                        📱
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">Multi Platform</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Akses dari mana saja, kapan saja melalui smartphone, tablet, atau komputer.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA SECTION -->
    <div class="py-20 px-6 md:px-12">
        <div class="max-w-4xl mx-auto bg-blue-600 rounded-2xl p-12 text-center text-white">
            <h3 class="text-4xl font-bold mb-4">
                Siap untuk Memulai?
            </h3>
            <p class="text-xl mb-8 text-blue-100">
                Bergabunglah dengan ribuan guru dan murid yang sudah menggunakan platform kami
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="bg-white text-blue-600 px-10 py-4 rounded-lg font-bold text-lg hover:bg-gray-50 transition">
                    Daftar Gratis →
                </a>
                <a href="/login" class="border-2 border-white text-white px-10 py-4 rounded-lg font-bold text-lg hover:bg-blue-700 transition">
                    Login
                </a>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="border-t border-gray-200 bg-white py-12 px-6 md:px-12">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="text-gray-900 text-xl font-bold mb-4">UjianOnline</h4>
                    <p class="text-sm text-gray-600">Platform ujian online terpercaya untuk pendidikan modern.</p>
                </div>
                <div>
                    <h5 class="text-gray-900 font-semibold mb-4">Produk</h5>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="#" class="hover:text-blue-600 transition">Fitur</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Harga</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Tutorial</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-gray-900 font-semibold mb-4">Perusahaan</h5>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="#" class="hover:text-blue-600 transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Karir</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-gray-900 font-semibold mb-4">Kontak</h5>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="#" class="hover:text-blue-600 transition">Dukungan</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Hubungi Kami</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-200 pt-8 text-center text-sm text-gray-600">
                © 2024 Sistem Ujian Online — Dibuat dengan ❤️ & Laravel
            </div>
        </div>
    </footer>

</body>
</html>