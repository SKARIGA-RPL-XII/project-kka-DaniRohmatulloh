<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Murid | Ujian Sistem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff',
                            600: '#7c3aed',
                            700: '#6d28d9',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-5px); }
        .glass-effect { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        .progress-ring {
            transform: rotate(-90deg);
        }
        .progress-ring-circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transition: stroke-dashoffset 0.5s ease;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">

    <!-- NAVBAR ENHANCED -->
    <nav class="glass-effect shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center justify-between">
                <!-- LOGO -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-md">
                        <i class="fas fa-graduation-cap text-lg"></i>
                    </div>
                    <div>
                        <span class="font-extrabold text-xl text-gray-800">Ujian Sistem</span>
                        <span class="text-xs text-purple-600 font-semibold bg-purple-50 px-2 py-0.5 rounded-full ml-2">STUDENT</span>
                    </div>
                </div>

                <!-- MENU CENTER -->
                <ul class="hidden md:flex items-center gap-1 bg-gray-50 rounded-2xl p-1">
                    <li>
                        <a href="#" class="flex items-center gap-2 px-5 py-2 rounded-xl bg-white shadow-sm text-purple-600 font-semibold">
                            <i class="fas fa-home text-sm"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 px-5 py-2 rounded-xl text-gray-600 hover:text-purple-600 hover:bg-white transition font-medium">
                            <i class="fas fa-file-alt text-sm"></i>
                            Ujian
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 px-5 py-2 rounded-xl text-gray-600 hover:text-purple-600 hover:bg-white transition font-medium">
                            <i class="fas fa-history text-sm"></i>
                            Riwayat
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 px-5 py-2 rounded-xl text-gray-600 hover:text-purple-600 hover:bg-white transition font-medium">
                            <i class="fas fa-chart-line text-sm"></i>
                            Statistik
                        </a>
                    </li>
                </ul>

                <!-- PROFILE DROPDOWN -->
                @auth
                <div class="relative">
                    <button onclick="toggleProfile()"
                        class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-xl hover:shadow-md transition-all duration-200 border border-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-100">
                        <div class="relative">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="hidden lg:block text-left">
                            <p class="font-semibold text-gray-800 text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Murid</p>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                    </button>

                    <!-- DROPDOWN MENU -->
                    <div id="profileDropdown"
                        class="hidden absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden animate-slide-up">
                        <div class="px-5 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
                            <p class="text-xs opacity-90">Login sebagai</p>
                            <p class="font-bold text-lg">{{ Auth::user()->name }}</p>
                            <p class="text-xs opacity-75 mt-1">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <div class="py-2">
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-purple-50 transition group">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 group-hover:bg-purple-200">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Profil Saya</p>
                                    <p class="text-xs text-gray-500">Kelola profil Anda</p>
                                </div>
                            </a>
                            
                            <a href="#"
                                class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-purple-50 transition group">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 group-hover:bg-blue-200">
                                    <i class="fas fa-cog text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Pengaturan</p>
                                    <p class="text-xs text-gray-500">Penyesuaian aplikasi</p>
                                </div>
                            </a>
                            
                            <div class="border-t border-gray-100 my-2"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left flex items-center gap-3 px-5 py-3 text-red-600 hover:bg-red-50 transition group">
                                    <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center text-red-600 group-hover:bg-red-200">
                                        <i class="fas fa-sign-out-alt text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Logout</p>
                                        <p class="text-xs text-gray-500">Keluar dari sistem</p>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="flex gap-2">
                    <a href="{{ route('login') }}" class="text-gray-700 px-5 py-2 rounded-lg font-medium hover:bg-gray-100 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-5 py-2 rounded-lg font-medium hover:shadow-lg transition hover:shadow-purple-200">
                        Daftar
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- HEADER -->
        <div class="mb-10 animate-fade-in">
            @auth
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-indigo-100 flex items-center justify-center">
                            <i class="fas fa-user-graduate text-2xl text-purple-600"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                                Selamat Datang, <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">{{ Auth::user()->name }}</span>
                            </h1>
                            <p class="text-gray-600 mt-1 flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-sm"></i>
                                <span id="currentDate"></span>
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-600 mt-3 max-w-2xl">
                        Siap untuk mengasah kemampuanmu hari ini? Ada <span class="font-semibold text-purple-600">3 ujian</span> yang menantimu!
                    </p>
                </div>
            </div>
            @else
            <div class="text-center py-12">
                <div class="w-20 h-20 rounded-full bg-gradient-to-r from-purple-100 to-indigo-100 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-3">Selamat Datang di ExamSystem</h1>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">
                    Platform ujian online terpercaya untuk meningkatkan kemampuan akademismu
                </p>
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-medium hover:shadow-lg transition">
                        Masuk ke Akun
                    </a>
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white border border-gray-300 text-gray-700 rounded-xl font-medium hover:border-purple-400 transition">
                        Buat Akun Baru
                    </a>
                </div>
            </div>
            @endauth
        </div>

        @auth
        <!-- STATISTICS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Ujian Diikuti</p>
                        <p class="text-3xl font-bold text-gray-900">12</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100 flex items-center justify-center">
                        <i class="fas fa-file-alt text-xl text-purple-600"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm">
                        <span class="text-green-600 font-medium flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>
                            2 baru minggu ini
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Rata-rata Nilai</p>
                        <p class="text-3xl font-bold text-gray-900">85.5</p>
                    </div>
                    <div class="relative w-12 h-12">
                        <svg class="w-12 h-12" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="45" fill="none" stroke="#f3f4f6" stroke-width="8"/>
                            <circle cx="50" cy="50" r="45" fill="none" stroke="#10b981" stroke-width="8" stroke-linecap="round"
                                    stroke-dasharray="283" stroke-dashoffset="42" class="progress-ring-circle"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-chart-line text-xl text-green-600"></i>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm">
                        <span class="text-green-600 font-medium flex items-center">
                            <i class="fas fa-trend-up mr-1 text-xs"></i>
                            Naik 5% dari bulan lalu
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Ujian Aktif</p>
                        <p class="text-3xl font-bold text-gray-900">3</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-orange-50 to-orange-100 flex items-center justify-center">
                        <i class="fas fa-clock text-xl text-orange-600"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm">
                        <span class="text-orange-600 font-medium flex items-center">
                            <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                            Deadline mendekati
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Ranking Kelas</p>
                        <p class="text-3xl font-bold text-gray-900">#8</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                        <i class="fas fa-trophy text-xl text-blue-600"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm">
                        <span class="text-blue-600 font-medium flex items-center">
                            <i class="fas fa-crown mr-1 text-xs"></i>
                            Naik 2 peringkat
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- UJIAN TERSEDIA SECTION -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-purple-100 to-indigo-100 flex items-center justify-center">
                            <i class="fas fa-book-open text-purple-600"></i>
                        </div>
                        Ujian Tersedia
                    </h2>
                    <p class="text-gray-600 mt-2">Pilih ujian yang ingin kamu kerjakan</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-xl text-gray-700 hover:border-purple-400 transition flex items-center gap-2">
                        <i class="fas fa-filter text-sm"></i>
                        Filter
                    </button>
                    <button class="px-4 py-2 bg-gray-50 rounded-xl text-gray-700 hover:bg-gray-100 transition flex items-center gap-2">
                        <i class="fas fa-sort text-sm"></i>
                        Urutkan
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Ujian 1 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden card-hover hover:border-purple-200">
                    <div class="h-3 bg-gradient-to-r from-orange-400 to-pink-500"></div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 bg-orange-50 text-orange-700 rounded-full text-xs font-semibold">
                                    Bahasa Indonesia
                                </span>
                                <h3 class="font-bold text-gray-900 text-lg mt-2">Teks Anekdot</h3>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-orange-50 to-pink-50 flex items-center justify-center">
                                <i class="fas fa-book text-orange-600"></i>
                            </div>
                        </div>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-question-circle text-orange-500 mr-2"></i>
                                <span>20 Soal Pilihan Ganda</span>
                            </div>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-clock text-orange-500 mr-2"></i>
                                <span>Durasi: 30 Menit</span>
                            </div>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-calendar text-orange-500 mr-2"></i>
                                <span>Deadline: 2 Hari Lagi</span>
                            </div>
                        </div>
                        
                        <div class="pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 border-2 border-white"></div>
                                        <div class="w-8 h-8 rounded-full bg-green-100 border-2 border-white"></div>
                                        <div class="w-8 h-8 rounded-full bg-purple-100 border-2 border-white flex items-center justify-center text-xs text-purple-700">
                                            +8
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">Sudah mengerjakan</span>
                                </div>
                                <button class="px-5 py-2.5 bg-gradient-to-r from-orange-500 to-pink-500 text-white font-semibold rounded-xl hover:shadow-lg transition hover:shadow-orange-200">
                                    Mulai
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ujian 2 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden card-hover hover:border-blue-200">
                    <div class="h-3 bg-gradient-to-r from-blue-400 to-cyan-500"></div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-semibold">
                                    Bahasa Inggris
                                </span>
                                <h3 class="font-bold text-gray-900 text-lg mt-2">Degree of Comparison</h3>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-50 to-cyan-50 flex items-center justify-center">
                                <i class="fas fa-language text-blue-600"></i>
                            </div>
                        </div>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-question-circle text-blue-500 mr-2"></i>
                                <span>25 Soal Campuran</span>
                            </div>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-clock text-blue-500 mr-2"></i>
                                <span>Durasi: 25 Menit</span>
                            </div>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-calendar text-blue-500 mr-2"></i>
                                <span>Deadline: Besok</span>
                            </div>
                        </div>
                        
                        <div class="pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 border-2 border-white"></div>
                                        <div class="w-8 h-8 rounded-full bg-green-100 border-2 border-white"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">12 sudah mengerjakan</span>
                                </div>
                                <button class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-cyan-500 text-white font-semibold rounded-xl hover:shadow-lg transition hover:shadow-blue-200">
                                    Mulai
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ujian 3 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden card-hover hover:border-green-200">
                    <div class="h-3 bg-gradient-to-r from-green-400 to-teal-500"></div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold">
                                    Matematika
                                </span>
                                <h3 class="font-bold text-gray-900 text-lg mt-2">Aljabar Linear</h3>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-50 to-teal-50 flex items-center justify-center">
                                <i class="fas fa-calculator text-green-600"></i>
                            </div>
                        </div>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-question-circle text-green-500 mr-2"></i>
                                <span>15 Soal Esai Singkat</span>
                            </div>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-clock text-green-500 mr-2"></i>
                                <span>Durasi: 40 Menit</span>
                            </div>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-calendar text-green-500 mr-2"></i>
                                <span>Deadline: 5 Hari Lagi</span>
                            </div>
                        </div>
                        
                        <div class="pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 border-2 border-white"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">5 sudah mengerjakan</span>
                                </div>
                                <button class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-teal-500 text-white font-semibold rounded-xl hover:shadow-lg transition hover:shadow-green-200">
                                    Mulai
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endauth
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-gray-200 bg-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center gap-3 mb-4 md:mb-0">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">
                        E
                    </div>
                    <span class="font-bold text-gray-800">ExamSystem</span>
                    <span class="text-xs text-gray-500">© 2024 All rights reserved</span>
                </div>
                <div class="flex gap-6 text-sm text-gray-600">
                    <a href="#" class="hover:text-purple-600 transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-purple-600 transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-purple-600 transition">Bantuan</a>
                    <a href="#" class="hover:text-purple-600 transition">Kontak</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script>
        // Toggle Profile Dropdown
        function toggleProfile() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const btn = document.querySelector('button[onclick="toggleProfile()"]');
            const dropdown = document.getElementById('profileDropdown');
            
            if (btn && dropdown && !btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Set current date
        const currentDate = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = currentDate.toLocaleDateString('id-ID', options);

        // Progress circles animation
        document.addEventListener('DOMContentLoaded', function() {
            const circles = document.querySelectorAll('.progress-ring-circle');
            circles.forEach(circle => {
                const radius = circle.r.baseVal.value;
                const circumference = radius * 2 * Math.PI;
                circle.style.strokeDasharray = `${circumference} ${circumference}`;
                circle.style.strokeDashoffset = circumference;
                
                const offset = circumference - (85.5 / 100 * circumference);
                setTimeout(() => {
                    circle.style.strokeDashoffset = offset;
                }, 100);
            });
        });
    </script>

</body>

</html>