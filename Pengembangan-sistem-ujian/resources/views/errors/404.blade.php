<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Ujian Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <span class="font-bold text-xl text-gray-800">UjianOnline</span>
                </div>
                <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-16">
        <div class="max-w-2xl mx-auto text-center">
            <!-- Error Illustration -->
            <div class="relative mb-8">
                <div class="w-48 h-48 bg-gradient-to-r from-red-100 to-pink-100 rounded-full mx-auto flex items-center justify-center">
                    <i class="fas fa-search text-red-400 text-6xl"></i>
                </div>
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-r from-blue-100 to-cyan-100 rounded-full opacity-50"></div>
                <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full opacity-50"></div>
            </div>

            <!-- Error Message -->
            <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Halaman Tidak Ditemukan</h2>
            
            <p class="text-gray-600 mb-8 text-lg">
                <i class="fas fa-exclamation-circle text-yellow-500 mr-2"></i>
                Halaman yang Anda cari tidak tersedia dalam sistem ujian online.
            </p>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border">
                    <i class="fas fa-user-graduate text-blue-500 text-2xl mb-3"></i>
                    <h3 class="font-semibold text-gray-800 mb-2">Untuk Siswa</h3>
                    <p class="text-sm text-gray-600 mb-3">Kembali ke dashboard siswa untuk melanjutkan ujian</p>
                    <a href="{{ route('murid.dashboard') ?? url('/murid') }}" 
                       class="inline-block bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-lg text-sm">
                        Dashboard Siswa
                    </a>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm border">
                    <i class="fas fa-chalkboard-teacher text-purple-500 text-2xl mb-3"></i>
                    <h3 class="font-semibold text-gray-800 mb-2">Untuk Guru</h3>
                    <p class="text-sm text-gray-600 mb-3">Akses panel guru untuk mengelola soal dan ujian</p>
                    <a href="{{ route('guru.dashboard') ?? url('/guru') }}" 
                       class="inline-block bg-purple-50 text-purple-600 hover:bg-purple-100 px-4 py-2 rounded-lg text-sm">
                        Dashboard Guru
                    </a>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition">
                    <i class="fas fa-home"></i>
                    Beranda Utama
                </a>
                
                <a href="{{ url()->previous() }}" 
                   class="inline-flex items-center justify-center gap-2 border border-gray-300 bg-white text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>

            <!-- Help Text -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <p class="text-sm text-gray-500">
                    <i class="fas fa-question-circle mr-2"></i>
                    Butuh bantuan? Hubungi administrator sistem ujian online.
                </p>
                <div class="mt-4 flex flex-wrap gap-4 justify-center text-sm">
                    <span class="text-gray-600"><i class="fas fa-envelope mr-1"></i>admin@ujianonline.com</span>
                    <span class="text-gray-600"><i class="fas fa-phone mr-1"></i>(021) 1234-5678</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t mt-12">
        <div class="container mx-auto px-6 py-4">
            <div class="text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Sistem Ujian Online. Semua hak dilindungi.</p>
                <p class="mt-1">Versi 1.0.0</p>
            </div>
        </div>
    </footer>
</body>
</html>