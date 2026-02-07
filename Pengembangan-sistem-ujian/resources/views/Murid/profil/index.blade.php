<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya - ExamSystem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- SIMPLE HEADER -->
    <div class="bg-white border-b">
        <div class="max-w-6xl mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-indigo-600 rounded flex items-center justify-center text-white">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <span class="font-bold text-gray-800">ExamSystem</span>
                    <span class="text-gray-400">/</span>
                    <span class="text-indigo-600">Profil</span>
                </div>
                <a href="{{ route('murid.dashboard') }}" class="text-gray-600 hover:text-indigo-600">
                    <i class="fas fa-arrow-left mr-1"></i>Dashboard
                </a>
            </div>
        </div>
    </div>

    <main class="max-w-6xl mx-auto px-4 py-8">
        <!-- PROFILE HEADER -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
            <p class="text-gray-600 mt-1">Informasi akun dan statistik pembelajaran</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- LEFT COLUMN - PROFILE -->
            <div class="md:col-span-2 space-y-6">
                <!-- PROFILE CARD -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-3xl font-bold" style="color: white;">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ Auth::user()->nama }}</h2>
                            <div class="flex space-x-2 mt-2">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">
                                    {{ Auth::user()->role }}
                                </span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                    <i class="fas fa-circle text-xs mr-1"></i>Aktif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- INFO GRID -->
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-envelope text-indigo-500 mr-2"></i>
                                <span class="text-sm text-gray-500">Email</span>
                            </div>
                            <p class="font-medium">{{ Auth::user()->email }}</p>
                            <span class="text-xs text-green-600 mt-1 block">✓ Terverifikasi</span>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-id-card text-blue-500 mr-2"></i>
                                <span class="text-sm text-gray-500">ID Pengguna</span>
                            </div>
                            <p class="font-medium">#{{ Auth::user()->id }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-plus text-green-500 mr-2"></i>
                                <span class="text-sm text-gray-500">Bergabung</span>
                            </div>
                            <p class="font-medium">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->translatedFormat('d M Y') }}</p>
                            <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</span>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-clock text-orange-500 mr-2"></i>
                                <span class="text-sm text-gray-500">Terakhir Aktif</span>
                            </div>
                            <p class="font-medium">{{ \Carbon\Carbon::parse(Auth::user()->updated_at)->translatedFormat('H:i') }}</p>
                            <span class="text-xs text-blue-600">● Online</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN - STATS & ACTIONS -->
            <div class="space-y-6">
                <!-- STATISTICS -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Statistik</h3>
                    
                    <div class="space-y-4">
                        <div class="p-4 bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg border-l-4 border-indigo-500">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">Ujian Selesai</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $totalUjianDiikuti ?? 0 }}</p>
                                </div>
                                <i class="fas fa-file-alt text-2xl text-indigo-500"></i>
                            </div>
                        </div>

                        <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border-l-4 border-blue-500">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">Rata-rata Nilai</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $rataRataNilai ?? 0 }}</p>
                                </div>
                                <i class="fas fa-chart-line text-2xl text-blue-500"></i>
                            </div>
                        </div>

                        <div class="p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border-l-4 border-green-500">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">Aktivitas Bulan Ini</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ \App\Models\HasilUjian::where('murid_id', Auth::id())->whereMonth('created_at', now()->month)->count() }}
                                    </p>
                                </div>
                                <i class="fas fa-fire text-2xl text-green-500"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QUICK ACTIONS -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Menu Cepat</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('murid.dashboard') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-gray-50 rounded-lg transition">
                            <i class="fas fa-home text-gray-400 mr-3"></i>
                            <span>Dashboard</span>
                            <i class="fas fa-chevron-right ml-auto text-gray-300"></i>
                        </a>

                        <a href="{{ route('murid.riwayat') }}" 
                           class="flex items-center p-3 text-gray-700 hover:bg-gray-50 rounded-lg transition">
                            <i class="fas fa-history text-gray-400 mr-3"></i>
                            <span>Riwayat Ujian</span>
                            <i class="fas fa-chevron-right ml-auto text-gray-300"></i>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="pt-3 border-t">
                            @csrf
                            <button type="submit" 
                                    onclick="return confirm('Yakin ingin logout?')"
                                    class="flex items-center p-3 text-red-600 hover:bg-red-50 rounded-lg transition w-full">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>Keluar</span>
                                <i class="fas fa-chevron-right ml-auto text-gray-300"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- SUPPORT CARD -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl p-5 text-white">
                    <div class="flex items-start mb-3">
                        <i class="fas fa-headset text-xl mr-3"></i>
                        <div>
                            <h4 class="font-bold">Butuh Bantuan?</h4>
                            <p class="text-sm text-indigo-100 mt-1">Tim kami siap membantu Anda</p>
                        </div>
                    </div>
                    <button class="mt-3 w-full bg-white text-indigo-600 font-medium py-2 rounded-lg hover:bg-gray-100 transition">
                        Hubungi Support
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- SIMPLE FOOTER -->
    <footer class="mt-12 py-4 text-center text-sm text-gray-500 border-t">
        <p>© {{ date('Y') }} ExamSystem. All rights reserved.</p>
    </footer>

    <!-- SIMPLE SCRIPT -->
    <script>
        // Hover effects
        document.querySelectorAll('.bg-gradient-to-r').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow-md', 'transform', '-translate-y-0.5');
            });
            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow-md', 'transform', '-translate-y-0.5');
            });
        });
    </script>
</body>
</html>