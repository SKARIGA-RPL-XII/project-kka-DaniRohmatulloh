<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Guru - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Main Layout -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-800">ExamSystem</h1>
                        <p class="text-xs text-gray-500">Dashboard Guru</p>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="p-6 border-b">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow">
                        {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-800 truncate">{{ auth()->user()->nama }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-full">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <span class="text-xs font-medium text-blue-700">Guru Aktif</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1">
                <a href="/guru/dashboard" 
                   class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="/guru/soal" 
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-question-circle w-5 text-center"></i>
                    <span>Kelola Soal</span>
                </a>
                
                <a href="/guru/examp" 
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span>Pengaturan Soal</span>
                </a>
                
                <a href="{{ route('guru.hasil-ujian') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-chart-bar w-5 text-center"></i>
                    <span>Lihat Hasil Ujian</span>
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t">
                <button onclick="showLogoutConfirm()" 
                        class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white border-b px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Dashboard Guru</h1>
                        <div class="flex items-center gap-2 mt-1 text-sm text-gray-600">
                            <i class="fas fa-calendar"></i>
                            <span>{{ now()->translatedFormat('l, d F Y') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">        
                        <!-- Quick Stats -->
                        <div class="hidden md:flex items-center gap-4 px-4">
                            <div class="text-center">
                                <div class="font-bold text-gray-800">{{ $totalSoal }}</div>
                                <div class="text-xs text-gray-500">Soal</div>
                            </div>
                            <div class="h-8 w-px bg-gray-300"></div>
                            <div class="text-center">
                                <div class="font-bold text-gray-800">{{ $totalUjian }}</div>
                                <div class="text-xs text-gray-500">Ujian</div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 p-6">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 text-white">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <div>
                                <h2 class="text-2xl font-bold mb-2">Selamat datang, {{ auth()->user()->nama }}!</h2>
                                <p class="text-blue-100">Sistem ujian online untuk pembelajaran yang lebih baik</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Soal -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Total Soal</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $totalSoal }}</p>
                            </div>
                            <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center">
                                <i class="fas fa-question-circle text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Ujian Aktif -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Ujian Aktif</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $totalUjian }}</p>
                            </div>
                            <div class="w-14 h-14 bg-green-50 rounded-xl flex items-center justify-center">
                                <i class="fas fa-file-alt text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Siswa Aktif -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Siswa Aktif</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $totalSiswa }}</p>
                            </div>
                            <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center">
                                <i class="fas fa-users text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Two Column Content -->
                <!-- Quick Actions -->
                <div class="mt-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="/guru/soal" 
                           class="bg-white border border-gray-200 rounded-xl p-4 text-center hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-plus text-blue-600 text-xl"></i>
                            </div>
                            <p class="font-medium text-gray-800">Buat Soal</p>
                            <p class="text-xs text-gray-500 mt-1">Tambah soal baru</p>
                        </a>
                        
                        <a href="/guru/examp" 
                           class="bg-white border border-gray-200 rounded-xl p-4 text-center hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-file-alt text-green-600 text-xl"></i>
                            </div>
                            <p class="font-medium text-gray-800">Buat Ujian</p>
                            <p class="text-xs text-gray-500 mt-1">Buat ujian baru</p>
                        </a>
                        
                        <a href="#" 
                           class="bg-white border border-gray-200 rounded-xl p-4 text-center hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                            </div>
                            <p class="font-medium text-gray-800">Lihat Laporan</p>
                            <p class="text-xs text-gray-500 mt-1">Analisis nilai</p>
                        </a>
                        
                        <a href="#" 
                           class="bg-white border border-gray-200 rounded-xl p-4 text-center hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-cog text-orange-600 text-xl"></i>
                            </div>
                            <p class="font-medium text-gray-800">Pengaturan</p>
                            <p class="text-xs text-gray-500 mt-1">Atur preferensi</p>
                        </a>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t px-6 py-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-600">
                        &copy; {{ date('Y') }} ExamSystem - Dashboard Guru
                    </p>
                    <div class="flex gap-6 mt-2 md:mt-0">
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-800">Bantuan</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-800">Dokumentasi</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-800">Kontak</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Logout Modal -->
    <div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-sm w-full">
            <div class="p-6">
                <div class="flex items-center justify-center w-14 h-14 mx-auto mb-4 rounded-full bg-red-100">
                    <i class="fas fa-sign-out-alt text-2xl text-red-600"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Konfirmasi Logout</h3>
                <p class="text-gray-600 text-center mb-6">Anda yakin ingin keluar dari sistem?</p>
                
                <div class="flex gap-3">
                    <button onclick="hideLogoutConfirm()" 
                            class="flex-1 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button onclick="performLogout()" 
                            class="flex-1 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700">
                        Ya, Logout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Panel -->
    <div id="notificationsPanel" class="hidden fixed top-16 right-4 w-80 bg-white rounded-xl shadow-xl border z-50">
        <div class="p-4 border-b">
            <div class="flex justify-between items-center">
                <h4 class="font-bold text-gray-800">Notifikasi</h4>
                <button onclick="hideNotifications()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="p-2 max-h-96 overflow-y-auto">
            <div class="p-3 hover:bg-gray-50 rounded-lg">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-blue-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Siswa baru mendaftar</p>
                        <p class="text-sm text-gray-500">Andi Prasetyo di Kelas X IPA 1</p>
                        <span class="text-xs text-gray-400">5 menit lalu</span>
                    </div>
                </div>
            </div>
            <div class="p-3 hover:bg-gray-50 rounded-lg">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Ujian selesai</p>
                        <p class="text-sm text-gray-500">20 siswa telah menyelesaikan ujian Matematika</p>
                        <span class="text-xs text-gray-400">1 jam lalu</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 border-t">
            <a href="#" class="block text-center text-blue-600 font-medium">Lihat semua notifikasi</a>
        </div>
    </div>

    <script>
        // Logout Modal Functions
        function showLogoutConfirm() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function hideLogoutConfirm() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        function performLogout() {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/logout';
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = token;
            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        }

        // Notifications Panel
        function showNotifications() {
            document.getElementById('notificationsPanel').classList.remove('hidden');
        }

        function hideNotifications() {
            document.getElementById('notificationsPanel').classList.add('hidden');
        }

        // Close notifications when clicking outside
        document.addEventListener('click', function(e) {
            const panel = document.getElementById('notificationsPanel');
            const button = document.querySelector('button[onclick="showNotifications()"]');
            
            if (!panel.contains(e.target) && !button.contains(e.target) && !panel.classList.contains('hidden')) {
                hideNotifications();
            }
        });

        // Active menu highlighting
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('nav a');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('bg-indigo-50', 'text-indigo-700');
                    link.classList.remove('text-gray-700', 'hover:bg-gray-100');
                }
            });

            // Add click effects to cards
            document.querySelectorAll('a[href]').forEach(link => {
                if (link.getAttribute('href') === '#') {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        showToast('Fitur ini akan segera tersedia', 'info');
                    });
                }
            });
        });

        // Toast notification
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300 translate-x-0 ${
                type === 'info' ? 'bg-blue-500' : 'bg-orange-500'
            } text-white`;
            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <i class="fas fa-${type === 'info' ? 'info-circle' : 'exclamation-triangle'}"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Escape key handlers
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideLogoutConfirm();
                hideNotifications();
            }
        });
    </script>
</body>
</html>