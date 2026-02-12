<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kelas - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col fixed h-screen">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-chalkboard-teacher text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-800 text-lg">ExamSystem</h1>
                        <p class="text-xs text-gray-500">Dashboard Guru</p>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                        {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-800 truncate">{{ auth()->user()->nama }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-full">
                    <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-medium text-blue-700">Guru Aktif</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="/guru/dashboard" 
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                    <i class="fas fa-home w-5 text-center text-gray-500 group-hover:text-indigo-600"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="/guru/soal" 
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                    <i class="fas fa-question-circle w-5 text-center text-gray-500 group-hover:text-indigo-600"></i>
                    <span>Kelola Soal</span>
                </a>
                
                <a href="/guru/examp" 
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                    <i class="fas fa-cog w-5 text-center text-gray-500 group-hover:text-indigo-600"></i>
                    <span>Pengaturan Soal</span>
                </a>
                
                <a href="{{ route('guru.hasil-ujian') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                    <i class="fas fa-chart-bar w-5 text-center text-gray-500 group-hover:text-indigo-600"></i>
                    <span>Lihat Hasil Ujian</span>
                </a>
                
                <a href="#" 
                   class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium shadow-sm">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span>Kelola Kelas</span>
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-200">
                <button onclick="showLogoutConfirm()" 
                        class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 group">
                    <i class="fas fa-sign-out-alt w-5 text-center group-hover:scale-110"></i>
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 overflow-y-auto bg-gray-50">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-users text-indigo-600"></i>
                            Kelola Kelas
                        </h2>
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm rounded-full font-medium">
                            Tahun Ajaran 2024/2025
                        </span>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors relative">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-search text-lg"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="px-8 py-6">
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Total Kelas</p>
                                <p class="text-3xl font-bold text-gray-800">8</p>
                                <p class="text-xs text-green-600 mt-2">+2 dari tahun lalu</p>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-school text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Total Siswa</p>
                                <p class="text-3xl font-bold text-gray-800">245</p>
                                <p class="text-xs text-green-600 mt-2">Aktif semua</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-graduate text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Rata-rata Nilai</p>
                                <p class="text-3xl font-bold text-gray-800">82.5</p>
                                <p class="text-xs text-green-600 mt-2">↑ 4.5 poin</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-star text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Ujian Aktif</p>
                                <p class="text-3xl font-bold text-gray-800">3</p>
                                <p class="text-xs text-orange-600 mt-2">Berlangsung</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-pen text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Bar -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center gap-4">
                            <h3 class="font-semibold text-gray-800 text-lg">Daftar Kelas</h3>
                            <div class="relative">
                                <select class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2 pl-4 pr-10 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option>Semua Tingkat</option>
                                    <option>Kelas 10</option>
                                    <option>Kelas 11</option>
                                    <option>Kelas 12</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 text-xs"></i>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <div class="relative flex-1 sm:flex-initial">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                                <input type="text" placeholder="Cari kelas..." 
                                       class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent w-full sm:w-64">
                            </div>
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors shadow-sm">
                                <i class="fas fa-plus-circle"></i>
                                <span>Tambah Kelas</span>
                            </button>
                            <button class="border border-gray-200 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors">
                                <i class="fas fa-download"></i>
                                <span class="hidden sm:inline">Export</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Class Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Kelas X IPA 1 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                        <span class="text-white font-bold text-lg">X</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">IPA 1</h4>
                                        <p class="text-xs text-gray-500">Wali Kelas: Dr. Sarah</p>
                                    </div>
                                </div>
                                <div class="relative">
                                    <button class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg transition-colors">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="space-y-3 mb-5">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-users text-indigo-400 w-4"></i>
                                        Jumlah Siswa
                                    </span>
                                    <span class="font-semibold text-gray-800">32</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-book-open text-green-400 w-4"></i>
                                        Mata Pelajaran
                                    </span>
                                    <span class="font-semibold text-gray-800">8</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-tasks text-purple-400 w-4"></i>
                                        Ujian Selesai
                                    </span>
                                    <span class="font-semibold text-gray-800">12</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">A</div>
                                    <div class="w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">B</div>
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">C</div>
                                    <div class="w-8 h-8 bg-gray-200 rounded-full border-2 border-white flex items-center justify-center text-gray-600 text-xs font-bold">+5</div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-medium hover:bg-indigo-100 transition-colors">
                                        Kelola
                                    </button>
                                    <button class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                                        <i class="fas fa-chart-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas X IPA 2 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                        <span class="text-white font-bold text-lg">X</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">IPA 2</h4>
                                        <p class="text-xs text-gray-500">Wali Kelas: Pak Ahmad</p>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                            
                            <div class="space-y-3 mb-5">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-users text-indigo-400 w-4"></i>
                                        Jumlah Siswa
                                    </span>
                                    <span class="font-semibold text-gray-800">30</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-book-open text-green-400 w-4"></i>
                                        Mata Pelajaran
                                    </span>
                                    <span class="font-semibold text-gray-800">8</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-tasks text-purple-400 w-4"></i>
                                        Ujian Selesai
                                    </span>
                                    <span class="font-semibold text-gray-800">10</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">D</div>
                                    <div class="w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">E</div>
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">F</div>
                                    <div class="w-8 h-8 bg-gray-200 rounded-full border-2 border-white flex items-center justify-center text-gray-600 text-xs font-bold">+3</div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-medium hover:bg-indigo-100">
                                        Kelola
                                    </button>
                                    <button class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                                        <i class="fas fa-chart-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas XI IPA 1 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                        <span class="text-white font-bold text-lg">XI</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">IPA 1</h4>
                                        <p class="text-xs text-gray-500">Wali Kelas: Ibu Dewi</p>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                            
                            <div class="space-y-3 mb-5">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-users text-indigo-400 w-4"></i>
                                        Jumlah Siswa
                                    </span>
                                    <span class="font-semibold text-gray-800">28</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-book-open text-green-400 w-4"></i>
                                        Mata Pelajaran
                                    </span>
                                    <span class="font-semibold text-gray-800">9</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-tasks text-purple-400 w-4"></i>
                                        Ujian Selesai
                                    </span>
                                    <span class="font-semibold text-gray-800">15</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">G</div>
                                    <div class="w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">H</div>
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">I</div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-medium hover:bg-indigo-100">
                                        Kelola
                                    </button>
                                    <button class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                                        <i class="fas fa-chart-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas XI IPA 2 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                        <span class="text-white font-bold text-lg">XI</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">IPA 2</h4>
                                        <p class="text-xs text-gray-500">Wali Kelas: Pak Budi</p>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                            
                            <div class="space-y-3 mb-5">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-users text-indigo-400 w-4"></i>
                                        Jumlah Siswa
                                    </span>
                                    <span class="font-semibold text-gray-800">29</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-book-open text-green-400 w-4"></i>
                                        Mata Pelajaran
                                    </span>
                                    <span class="font-semibold text-gray-800">9</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-tasks text-purple-400 w-4"></i>
                                        Ujian Selesai
                                    </span>
                                    <span class="font-semibold text-gray-800">14</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">J</div>
                                    <div class="w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">K</div>
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">L</div>
                                    <div class="w-8 h-8 bg-gray-200 rounded-full border-2 border-white flex items-center justify-center text-gray-600 text-xs font-bold">+4</div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-medium hover:bg-indigo-100">
                                        Kelola
                                    </button>
                                    <button class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                                        <i class="fas fa-chart-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas XII IPA 1 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                        <span class="text-white font-bold text-lg">XII</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">IPA 1</h4>
                                        <p class="text-xs text-gray-500">Wali Kelas: Ibu Rina</p>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                            
                            <div class="space-y-3 mb-5">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-users text-indigo-400 w-4"></i>
                                        Jumlah Siswa
                                    </span>
                                    <span class="font-semibold text-gray-800">27</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-book-open text-green-400 w-4"></i>
                                        Mata Pelajaran
                                    </span>
                                    <span class="font-semibold text-gray-800">10</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-tasks text-purple-400 w-4"></i>
                                        Ujian Selesai
                                    </span>
                                    <span class="font-semibold text-gray-800">18</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">M</div>
                                    <div class="w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">N</div>
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">O</div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-medium hover:bg-indigo-100">
                                        Kelola
                                    </button>
                                    <button class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                                        <i class="fas fa-chart-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas XII IPA 2 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                        <span class="text-white font-bold text-lg">XII</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">IPA 2</h4>
                                        <p class="text-xs text-gray-500">Wali Kelas: Pak Anton</p>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                            
                            <div class="space-y-3 mb-5">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-users text-indigo-400 w-4"></i>
                                        Jumlah Siswa
                                    </span>
                                    <span class="font-semibold text-gray-800">26</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-book-open text-green-400 w-4"></i>
                                        Mata Pelajaran
                                    </span>
                                    <span class="font-semibold text-gray-800">10</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-tasks text-purple-400 w-4"></i>
                                        Ujian Selesai
                                    </span>
                                    <span class="font-semibold text-gray-800">17</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">P</div>
                                    <div class="w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">Q</div>
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold">R</div>
                                    <div class="w-8 h-8 bg-gray-200 rounded-full border-2 border-white flex items-center justify-center text-gray-600 text-xs font-bold">+2</div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-medium hover:bg-indigo-100">
                                        Kelola
                                    </button>
                                    <button class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                                        <i class="fas fa-chart-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex items-center justify-between">
                    <p class="text-sm text-gray-600">Menampilkan 1-6 dari 8 kelas</p>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-2 border border-gray-200 rounded-lg text-sm text-gray-500 hover:bg-gray-50 transition-colors disabled:opacity-50" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors">1</button>
                        <button class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors">2</button>
                        <button class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors">3</button>
                        <button class="px-3 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl transform transition-all scale-100">
            <div class="text-center mb-5">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-sign-out-alt text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Logout</h3>
                <p class="text-gray-600">Apakah Anda yakin ingin keluar dari sistem?</p>
            </div>
            <div class="flex gap-3">
                <button onclick="hideLogoutConfirm()" 
                        class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-xl font-medium transition-colors">
                    Batal
                </button>
                <button onclick="logout()" 
                        class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-colors shadow-sm">
                    Ya, Logout
                </button>
            </div>
        </div>
    </div>

    <script>
        function showLogoutConfirm() {
            document.getElementById('logoutModal').classList.remove('hidden');
            document.getElementById('logoutModal').classList.add('flex');
        }

        function hideLogoutConfirm() {
            document.getElementById('logoutModal').classList.add('hidden');
            document.getElementById('logoutModal').classList.remove('flex');
        }

        function logout() {
            alert('Logout berhasil!');
            window.location.href = '/login';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('logoutModal');
            if (event.target === modal) {
                hideLogoutConfirm();
            }
        }
    </script>
</body>
</html>