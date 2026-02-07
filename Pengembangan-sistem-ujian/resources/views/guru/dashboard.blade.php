<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .active-menu {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Main Layout -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white">
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg">ExamSystem</h1>
                        <p class="text-xs text-gray-300">Guru Dashboard</p>
                    </div>
                </div>

                <!-- User Profile -->
                <div class="mb-8 p-4 bg-white/5 rounded-xl">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-300">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-2 px-2 py-1 bg-purple-900/30 rounded-full">
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        <span class="text-xs">Guru</span>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="space-y-1">
                    <a href="/guru/dashboard" 
                       class="flex items-center gap-3 p-3 active-menu rounded-lg">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="/guru/soal" 
                       class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-question-circle"></i>
                        <span>Kelola Soal</span>
                    </a>
                    
                    <a href="/guru/examp" 
                       class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-file-alt"></i>
                        <span>Buat Ujian</span>
                    </a>
                    
                    <a href="#" 
                       class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-chart-bar"></i>
                        <span>Analisis Nilai</span>
                    </a>
                    
                    <a href="#" 
                       class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-users"></i>
                        <span>Kelola Kelas</span>
                    </a>
                    
                    <div class="pt-4 border-t border-white/10">
                        <button onclick="handleLogout()" 
                                class="w-full flex items-center gap-3 p-3 text-red-300 hover:bg-white/10 rounded-lg transition">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Dashboard Guru</h1>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ now()->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-100">
                                <i class="fas fa-bell"></i>
                                <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                            </button>
                            
                            <!-- Quick Stats -->
                            <div class="hidden md:flex items-center gap-4">
                                <div class="text-center">
                                    <div class="text-lg font-bold text-gray-800">128</div>
                                    <div class="text-xs text-gray-500">Soal</div>
                                </div>
                                <div class="h-6 w-px bg-gray-300"></div>
                                <div class="text-center">
                                    <div class="text-lg font-bold text-gray-800">5</div>
                                    <div class="text-xs text-gray-500">Ujian Aktif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                <!-- Welcome Banner -->
                <div class="mb-8">
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl p-6 text-white">
                        <div class="flex flex-col md:flex-row items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold mb-2">Selamat datang, {{ auth()->user()->name }}! 👋</h2>
                                <p class="text-purple-100">Apa yang ingin Anda lakukan hari ini?</p>
                            </div>
                            <div class="mt-4 md:mt-0">
                                <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Status: Aktif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="card-hover bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Total Soal</p>
                                <p class="text-3xl font-bold text-gray-800">128</p>
                                <p class="text-xs text-green-600 mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    12 baru bulan ini
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-question-circle text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-hover bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Ujian Aktif</p>
                                <p class="text-3xl font-bold text-gray-800">5</p>
                                <p class="text-xs text-orange-600 mt-1">
                                    <i class="fas fa-clock mr-1"></i>
                                    2 deadline minggu ini
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-file-alt text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-hover bg-white rounded-xl shadow p-6 border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Siswa Aktif</p>
                                <p class="text-3xl font-bold text-gray-800">45</p>
                                <p class="text-xs text-blue-600 mt-1">
                                    <i class="fas fa-users mr-1"></i>
                                    3 kelas aktif
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-users text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
              <!-- Recent Activity & Stats -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Activity -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-history text-indigo-600"></i>
                            Aktivitas Terbaru
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-plus text-green-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Menambahkan soal baru</p>
                                    <p class="text-xs text-gray-500">Matematika - Aljabar</p>
                                </div>
                                <span class="text-xs text-gray-500">2 jam lalu</span>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-edit text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Memperbarui bank soal</p>
                                    <p class="text-xs text-gray-500">Bahasa Indonesia</p>
                                </div>
                                <span class="text-xs text-gray-500">1 hari lalu</span>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-file-export text-purple-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Export laporan nilai</p>
                                    <p class="text-xs text-gray-500">Kelas X IPA 1</p>
                                </div>
                                <span class="text-xs text-gray-500">3 hari lalu</span>
                            </div>
                        </div>
                        
                        <a href="#" class="mt-4 text-sm text-indigo-600 font-medium hover:text-indigo-800 inline-flex items-center gap-1">
                            Lihat semua aktivitas
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                    
                    <!-- Upcoming Deadlines -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-calendar-check text-orange-600"></i>
                            Deadline Mendatang
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-3 p-3 bg-orange-50 rounded-lg border-l-4 border-orange-500">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Ujian Matematika</p>
                                    <p class="text-xs text-gray-600">Kelas X IPA 1</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-orange-600">Besok</p>
                                    <p class="text-xs text-gray-500">10:00 WIB</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Ujian Bahasa Inggris</p>
                                    <p class="text-xs text-gray-600">Kelas X IPA 2</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-700">3 hari</p>
                                    <p class="text-xs text-gray-500">13:00 WIB</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Kumpulkan soal</p>
                                    <p class="text-xs text-gray-600">Fisika - Semester 2</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-700">1 minggu</p>
                                    <p class="text-xs text-gray-500">23:59 WIB</p>
                                </div>
                            </div>
                        </div>
                        
                        <a href="#" class="mt-4 text-sm text-orange-600 font-medium hover:text-orange-800 inline-flex items-center gap-1">
                            Lihat kalender lengkap
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t px-6 py-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-600">
                        &copy; {{ date('Y') }} ExamSystem. Dashboard Guru v1.0
                    </p>
                    <div class="flex gap-4 mt-2 md:mt-0">
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900">Bantuan</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900">FAQ</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900">Status</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Handle logout
        function handleLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                fetch('{{ route("logout") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(() => {
                    window.location.href = '/';
                })
                .catch(() => {
                    window.location.href = '/';
                });
            }
        }
        
        // Toggle mobile sidebar (jika nanti dibuat responsive)
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('md:block');
        }
        
        // Active menu highlight
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('nav a');
            
            menuItems.forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active-menu');
                } else {
                    item.classList.remove('active-menu');
                }
            });
            
            // Add click animation to cards
            document.querySelectorAll('.card-hover').forEach(card => {
                card.addEventListener('click', function(e) {
                    if (this.getAttribute('href') === '#') {
                        e.preventDefault();
                        // Show coming soon notification
                        showNotification('Fitur ini akan segera hadir!', 'info');
                    }
                });
            });
        });
        
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300 ${
                type === 'info' ? 'bg-blue-500 text-white' : 
                type === 'success' ? 'bg-green-500 text-white' : 
                'bg-orange-500 text-white'
            }`;
            notification.innerHTML = `
                <div class="flex items-center gap-3">
                    <i class="fas fa-${type === 'info' ? 'info-circle' : type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
                    <span>${message}</span>
                </div>
            `;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>