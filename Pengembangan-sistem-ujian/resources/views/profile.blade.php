<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya - ExamSystem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .glass-effect { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        .profile-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-card:hover { transform: translateY(-3px); transition: all 0.3s ease; }
        .edit-btn { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .edit-btn:hover { transform: scale(1.05); }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 min-h-screen">

    <!-- NAVBAR -->
    <nav class="glass-effect shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center justify-between">
                <!-- LOGO -->
                <div class="flex items-center gap-3">
                    <a href="/dashboard" class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow">
                            <i class="fas fa-graduation-cap text-lg"></i>
                        </div>
                        <span class="font-extrabold text-xl text-gray-800">ExamSystem</span>
                    </a>
                </div>

                <!-- NAVIGATION -->
                <div class="flex items-center gap-6">
                    <a href="/dashboard" class="text-gray-600 hover:text-purple-600 font-medium flex items-center gap-2">
                        <i class="fas fa-arrow-left text-sm"></i>
                        Kembali
                    </a>
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- HEADER SECTION -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-100 to-indigo-100 flex items-center justify-center">
                    <i class="fas fa-user text-2xl text-purple-600"></i>
                </div>
                Profil Saya
            </h1>
            <p class="text-gray-600 mt-2">Kelola informasi profil dan akun Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- LEFT COLUMN - PROFILE INFO -->
            <div class="lg:col-span-2 space-y-8">
                <!-- PROFILE CARD -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="profile-gradient h-32 relative">
                        <!-- COVER IMAGE AREA -->
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="flex items-end gap-4">
                                <!-- AVATAR -->
                                <div class="relative">
                                    <div class="w-28 h-28 rounded-2xl bg-gradient-to-br from-purple-600 to-indigo-600 
                                                flex items-center justify-center text-white text-5xl font-bold border-4 border-white shadow-lg">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <button class="absolute bottom-2 right-2 w-8 h-8 bg-white rounded-full shadow flex items-center justify-center text-purple-600 hover:bg-purple-50 transition">
                                        <i class="fas fa-camera text-sm"></i>
                                    </button>
                                </div>
                                
                                <!-- NAME & ROLE -->
                                <div class="mb-2">
                                    <h2 class="text-2xl font-bold text-white">{{ Auth::user()->name }}</h2>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-medium capitalize">
                                            <i class="fas fa-user-tag mr-1"></i>
                                            {{ Auth::user()->role }}
                                        </span>
                                        <span class="px-3 py-1 bg-green-500/20 backdrop-blur-sm text-green-100 rounded-full text-sm font-medium">
                                            <i class="fas fa-circle text-xs mr-1"></i>
                                            Aktif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PROFILE INFO -->
                    <div class="pt-20 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Profil</h3>
                            <button class="edit-btn px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:shadow-lg hover:shadow-purple-200 flex items-center gap-2">
                                <i class="fas fa-edit text-sm"></i>
                                Edit Profil
                            </button>
                        </div>

                        <div class="space-y-5">
                            <!-- EMAIL -->
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 mr-4">
                                    <i class="fas fa-envelope text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Alamat Email</p>
                                    <p class="font-medium text-gray-900">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-medium">
                                        Terverifikasi
                                    </span>
                                </div>
                            </div>

                            <!-- ROLE -->
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 mr-4">
                                    <i class="fas fa-user-tag text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Role Akun</p>
                                    <p class="font-medium text-gray-900 capitalize">{{ Auth::user()->role }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm text-gray-500">ID: {{ Auth::user()->id }}</span>
                                </div>
                            </div>

                            <!-- ACCOUNT CREATED -->
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center text-green-600 mr-4">
                                    <i class="fas fa-calendar-alt text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Akun Dibuat</p>
                                    <p class="font-medium text-gray-900">15 Januari 2024</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm text-gray-500">4 bulan lalu</span>
                                </div>
                            </div>

                            <!-- LAST ACTIVE -->
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600 mr-4">
                                    <i class="fas fa-clock text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Terakhir Aktif</p>
                                    <p class="font-medium text-gray-900">2 jam yang lalu</p>
                                </div>
                                <div class="text-right">
                                    <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">
                                        Online
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECURITY SETTINGS -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-red-600"></i>
                        </div>
                        Keamanan Akun
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-key text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Kata Sandi</p>
                                    <p class="text-sm text-gray-500">Terakhir diubah 1 bulan lalu</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-xl hover:border-purple-400 hover:text-purple-600 transition">
                                Ubah
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-mobile-alt text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Two-Factor Authentication</p>
                                    <p class="text-sm text-gray-500">Tambah lapisan keamanan ekstra</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 border border-purple-200 text-purple-600 font-medium rounded-xl hover:bg-purple-50 transition">
                                Aktifkan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN - STATS & ACTIONS -->
            <div class="space-y-8">
                <!-- QUICK STATS -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Statistik Akun</h3>
                    
                    <div class="space-y-4">
                        <div class="stat-card p-4 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl border border-purple-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Ujian Diselesaikan</p>
                                    <p class="text-2xl font-bold text-gray-900">24</p>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-purple-100">
                                <p class="text-xs text-purple-600">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    3 ujian minggu ini
                                </p>
                            </div>
                        </div>

                        <div class="stat-card p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border border-blue-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Rata-rata Nilai</p>
                                    <p class="text-2xl font-bold text-gray-900">86.5</p>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 flex items-center justify-center text-white">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-blue-100">
                                <p class="text-xs text-blue-600">
                                    <i class="fas fa-trend-up mr-1"></i>
                                    Naik 2.3% bulan ini
                                </p>
                            </div>
                        </div>

                        <div class="stat-card p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Aktivitas Bulan Ini</p>
                                    <p class="text-2xl font-bold text-gray-900">48</p>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-green-600 to-emerald-600 flex items-center justify-center text-white">
                                    <i class="fas fa-fire"></i>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-green-100">
                                <p class="text-xs text-green-600">
                                    <i class="fas fa-bolt mr-1"></i>
                                    Sangat aktif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QUICK ACTIONS -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Aksi Cepat</h3>
                    
                    <div class="space-y-3">
                        <a href="/dashboard" 
                           class="flex items-center gap-3 p-3 text-gray-700 hover:bg-purple-50 rounded-xl transition group">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 group-hover:bg-purple-200">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">Dashboard</p>
                                <p class="text-xs text-gray-500">Kembali ke beranda</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </a>

                        <a href="/ujian" 
                           class="flex items-center gap-3 p-3 text-gray-700 hover:bg-blue-50 rounded-xl transition group">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 group-hover:bg-blue-200">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">Ujian Saya</p>
                                <p class="text-xs text-gray-500">Lihat ujian aktif</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </a>

                        <a href="/riwayat" 
                           class="flex items-center gap-3 p-3 text-gray-700 hover:bg-green-50 rounded-xl transition group">
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center text-green-600 group-hover:bg-green-200">
                                <i class="fas fa-history"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">Riwayat Ujian</p>
                                <p class="text-xs text-gray-500">Lihat hasil sebelumnya</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </a>

                        <button class="w-full flex items-center gap-3 p-3 text-red-600 hover:bg-red-50 rounded-xl transition group mt-4 border-t pt-4">
                            <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center text-red-600 group-hover:bg-red-200">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>
                            <div class="flex-1 text-left">
                                <p class="font-medium">Keluar</p>
                                <p class="text-xs text-gray-500">Logout dari akun</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </button>
                    </div>
                </div>

                <!-- SUPPORT CARD -->
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-6 text-white">
                    <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center mb-4">
                        <i class="fas fa-headset text-xl"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Butuh Bantuan?</h4>
                    <p class="text-sm text-purple-100 mb-4">Tim support kami siap membantu Anda 24/7</p>
                    <button class="w-full bg-white text-purple-600 font-medium py-2.5 rounded-xl hover:bg-purple-50 transition flex items-center justify-center gap-2">
                        <i class="fas fa-comment-dots"></i>
                        Hubungi Support
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-gray-200 bg-white mt-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center text-sm text-gray-600">
                <p>© 2024 ExamSystem. Hak cipta dilindungi undang-undang.</p>
                <p class="mt-1">Terakhir diperbarui: {{ now()->format('d M Y H:i') }}</p>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script>
        // Simple animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to cards
            const cards = document.querySelectorAll('.stat-card, .bg-white');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(10px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
            
            // Logout confirmation
            const logoutBtn = document.querySelector('button.text-red-600');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin keluar?')) {
                        window.location.href = '/logout';
                    }
                });
            }
        });
    </script>

</body>
</html>