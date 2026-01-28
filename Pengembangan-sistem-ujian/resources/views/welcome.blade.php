<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ExamSystem - Platform Ujian Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-white">

    <!-- NAVBAR SIMPLE -->
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- LOGO -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center text-white">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <span class="font-bold text-xl text-gray-900">ExamSystem</span>
                </div>

                <!-- CTA BUTTONS -->
                <div class="flex items-center gap-3">
                    <a href="/login" class="text-gray-700 px-5 py-2 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300">
                        Login
                    </a>
                    <a href="/register" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-5 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION SIMPLE -->
    <section class="bg-gradient-to-br from-violet-50 to-indigo-50">
        <div class="max-w-6xl mx-auto px-4 py-20">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                
                <!-- TEXT CONTENT -->
                <div class="flex-1 max-w-xl">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                        Platform Ujian Online
                        <span class="block gradient-text mt-2">Terbaik untuk Pendidikan</span>
                    </h1>

                    <p class="text-lg text-gray-600 mb-8">
                        Sistem ujian online yang mudah digunakan untuk guru dan murid. 
                        Buat, kerjakan, dan nilai ujian dengan cepat dan akurat.
                    </p>

                    <!-- CTA BUTTONS -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                        <a href="/register"
                           class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            Daftar Sekarang
                        </a>

                        <a href="/login"
                           class="bg-white border border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:border-indigo-400 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                    </div>

                    <!-- STATS -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">500+</div>
                            <div class="text-sm text-gray-600">Sekolah</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">50K+</div>
                            <div class="text-sm text-gray-600">Pengguna</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">98%</div>
                            <div class="text-sm text-gray-600">Kepuasan</div>
                        </div>
                    </div>
                </div>

                <!-- ILLUSTRATION -->
                <div class="flex-1">
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <div class="bg-gradient-to-br from-indigo-100 to-purple-100 rounded-xl p-8">
                            <div class="text-center">
                                <div class="w-24 h-24 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                    <i class="fas fa-graduation-cap text-white text-4xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Mulai Sekarang</h3>
                                <p class="text-gray-600 mb-4">Bergabung dengan komunitas pendidikan digital</p>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-check text-green-500"></i>
                                        <span>Gratis untuk mulai</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-check text-green-500"></i>
                                        <span>Mudah digunakan</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-check text-green-500"></i>
                                        <span>Support 24/7</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION SIMPLE -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk sistem ujian online yang efektif
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- FEATURE 1 -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center text-white mb-4">
                        <i class="fas fa-pencil-alt"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Pembuat Soal</h4>
                    <p class="text-gray-600">
                        Buat soal dengan berbagai tipe pilihan ganda, esai, dan lainnya dengan mudah.
                    </p>
                </div>

                <!-- FEATURE 2 -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center text-white mb-4">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Hasil Cepat</h4>
                    <p class="text-gray-600">
                        Nilai otomatis langsung muncul setelah ujian selesai dikerjakan.
                    </p>
                </div>

                <!-- FEATURE 3 -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center text-white mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Aman & Terpercaya</h4>
                    <p class="text-gray-600">
                        Sistem keamanan berlapis untuk mencegah kecurangan selama ujian.
                    </p>
                </div>

                <!-- FEATURE 4 -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center text-white mb-4">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Analisis Data</h4>
                    <p class="text-gray-600">
                        Lihat laporan detail dan statistik performa ujian secara real-time.
                    </p>
                </div>

                <!-- FEATURE 5 -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white mb-4">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Responsif</h4>
                    <p class="text-gray-600">
                        Akses dari smartphone, tablet, atau komputer dengan tampilan optimal.
                    </p>
                </div>

                <!-- FEATURE 6 -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gradient-to-r from-teal-500 to-green-500 rounded-lg flex items-center justify-center text-white mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Kolaborasi</h4>
                    <p class="text-gray-600">
                        Guru dan murid dapat berinteraksi langsung dalam satu platform.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER SIMPLE -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- COMPANY -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center text-white">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="font-bold text-xl text-white">ExamSystem</span>
                    </div>
                    <p class="text-sm text-gray-400">
                        Platform ujian online untuk pendidikan modern.
                    </p>
                </div>

                <!-- PRODUCT -->
                <div>
                    <h5 class="text-white font-semibold mb-4">Produk</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-all duration-300">Fitur</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300">Harga</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300">Tutorial</a></li>
                    </ul>
                </div>

                <!-- COMPANY -->
                <div>
                    <h5 class="text-white font-semibold mb-4">Perusahaan</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-all duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300">Kontak</a></li>
                    </ul>
                </div>

                <!-- SUPPORT -->
                <div>
                    <h5 class="text-white font-semibold mb-4">Bantuan</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-all duration-300">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300">Support</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-500">
                © 2024 ExamSystem. Hak cipta dilindungi undang-undang.
            </div>
        </div>
    </footer>

    <script>
        // Simple smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>

</body>
</html>