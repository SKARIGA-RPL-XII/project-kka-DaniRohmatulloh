<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Soal Manual | Dashboard Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }

        .active-menu {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        /* Animasi untuk notifikasi */
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
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
                        class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="/guru/examp" 
                        class="flex items-center gap-3 p-3 active-menu rounded-lg">
                        <i class="fas fa-file-alt"></i>
                        <span>Buat Ujian</span>
                    </a>
                    
                    <a href="/guru/soal" 
                       class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-question-circle"></i>
                        <span>Kelola Soal</span>
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
                            <h1 class="text-2xl font-bold text-gray-800">Buat Soal Manual</h1>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-edit mr-1"></i>
                                Buat soal secara manual dengan detail lengkap
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-100" onclick="showNotification()">
                                <i class="fas fa-bell"></i>
                                <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">2</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                <!-- Success/Error Messages -->
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg animate-slideIn">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-green-800">Berhasil!</p>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-green-400 hover:text-green-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg animate-slideIn">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-red-800">Terjadi Kesalahan</p>
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-red-400 hover:text-red-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Form Generate Soal -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-edit text-blue-500"></i>
                                Form Buat Soal Manual
                            </h2>

                            <form method="POST" action="{{ route('guru.soal.store') }}" id="soalForm">
                                @csrf

                                <!-- Mata Pelajaran dengan Tombol Tambah -->
                                <div class="mb-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            <i class="fas fa-book mr-2 text-blue-500"></i>
                                            Mata Pelajaran
                                        </label>
                                        <div class="flex gap-2">
                                            <!-- From Uiverse.io by EcheverriaJesus -->
                                            <button type="button" onclick="showDeleteMapelModal()"
                                                class="flex justify-center items-center gap-2 w-28 h-12 cursor-pointer rounded-md shadow-2xl text-white font-semibold bg-gradient-to-r from-[#fb7185] via-[#e11d48] to-[#be123c] hover:shadow-xl hover:shadow-red-500 hover:scale-105 duration-300 hover:from-[#be123c] hover:to-[#fb7185]">
                                                <svg viewBox="0 0 24 24" class="w-5 fill-white">
                                                    <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round" fill="none" />
                                                </svg>
                                                Hapus
                                            </button>
                                            <!-- From Uiverse.io by BachWorks -->
                                            <button type="button" onclick="showAddMapelModal()"
                                                class="flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-500 text-white font-medium text-sm rounded-full shadow-lg hover:from-blue-600 hover:via-blue-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-70 active:bg-blue-800 active:shadow-inner transform hover:scale-105 transition duration-300 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" class="w-4 h-4 mr-2 text-white">
                                                    <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                                                </svg>
                                                Tambah Mapel
                                            </button>
                                        </div>
                                    </div>
                                    <select name="mapel_id" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                        id="mapelSelect">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach($mataPelajaran as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Pertanyaan -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-question mr-2 text-blue-500"></i>
                                        Pertanyaan
                                    </label>
                                    <textarea name="pertanyaan" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                        rows="4"
                                        placeholder="Tulis pertanyaan di sini..."></textarea>
                                </div>

                                <!-- Opsi Jawaban -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-list-ul mr-2 text-blue-500"></i>
                                        Opsi Jawaban
                                    </label>
                                    <div class="space-y-3">
                                        <!-- Opsi A -->
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center font-semibold">
                                                A
                                            </div>
                                            <input type="text" name="opsi_a" required
                                                class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                                placeholder="Teks opsi A">
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="jawaban_benar" value="A" class="h-5 w-5 text-blue-600" required>
                                                <span class="text-sm text-gray-700">Benar</span>
                                            </label>
                                        </div>

                                        <!-- Opsi B -->
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center font-semibold">
                                                B
                                            </div>
                                            <input type="text" name="opsi_b" required
                                                class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                                placeholder="Teks opsi B">
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="jawaban_benar" value="B" class="h-5 w-5 text-blue-600">
                                                <span class="text-sm text-gray-700">Benar</span>
                                            </label>
                                        </div>

                                        <!-- Opsi C -->
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center font-semibold">
                                                C
                                            </div>
                                            <input type="text" name="opsi_c" required
                                                class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                                placeholder="Teks opsi C">
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="jawaban_benar" value="C" class="h-5 w-5 text-blue-600">
                                                <span class="text-sm text-gray-700">Benar</span>
                                            </label>
                                        </div>

                                        <!-- Opsi D -->
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center font-semibold">
                                                D
                                            </div>
                                            <input type="text" name="opsi_d" required
                                                class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                                placeholder="Teks opsi D">
                                            <label class="flex items-center gap-2">
                                                <input type="radio" name="jawaban_benar" value="D" class="h-5 w-5 text-blue-600">
                                                <span class="text-sm text-gray-700">Benar</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="text-xs text-gray-500 mt-2">
                                        Pilih satu opsi sebagai jawaban yang benar
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="flex items-center gap-3 pt-4 border-t border-gray-200">

    <!-- SIMPAN -->
    <button type="submit"
        name="action"
        value="save"
        class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg relative overflow-hidden group">
        <span class="flex items-center justify-center relative z-10">
            <i class="fas fa-save mr-2"></i>
            Simpan Soal
        </span>
    </button>

    <!-- RESET (tetap JS) -->
    <button type="button" onclick="resetForm()"
        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
        Reset
    </button>

    <!-- SIMPAN & TAMBAH -->
    <button type="submit onclick="tambahNomorSoal()"
        name="action"
        value="save_add"
        class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Lagi
    </button>

</div>

                            </form>
                        </div>

                        <!-- Hasil Preview -->
                        <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-eye text-green-500"></i>
                                Preview Soal
                            </h2>

                            <div id="previewContainer" class="space-y-4">
                                <div class="text-center py-8 text-gray-400">
                                    <i class="fas fa-question-circle text-4xl mb-3 opacity-50"></i>
                                    <p>Preview soal akan muncul di sini</p>
                                </div>
                            </div>
                        </div>

                        <!-- Daftar Soal CRUD -->
                        <div class="bg-white rounded-xl shadow-sm border p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-list text-blue-500"></i>
                                    Daftar Soal
                                </h2>
                                <button onclick="loadSoalList()" class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                    <i class="fas fa-refresh mr-1"></i>Refresh
                                </button>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full table-auto">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pertanyaan</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata Pelajaran</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jawaban</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="soalTableBody" class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                                <i class="fas fa-inbox text-3xl mb-2 opacity-50"></i>
                                                <p>Belum ada soal. Silakan buat soal baru.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Kanan -->
                    <div class="lg:col-span-1">
                        <!-- Statistik -->
                        <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-chart-bar text-purple-500"></i>
                                Statistik Soal
                            </h2>

                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-question text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Total Soal</p>
                                            <p class="font-semibold text-lg">{{ $totalSoal ?? 0 }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-600">Mapel</div>
                                        <div class="font-semibold">{{ count($mataPelajaran) }}</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div class="p-3 bg-green-50 rounded-lg">
                                        <div class="text-sm text-gray-600 mb-1">Pilihan Ganda</div>
                                        <div class="font-semibold text-lg">{{ $soalPG ?? 0 }}</div>
                                    </div>
                                    <div class="p-3 bg-yellow-50 rounded-lg">
                                        <div class="text-sm text-gray-600 mb-1">Essay</div>
                                        <div class="font-semibold text-lg">{{ $soalEssay ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Panduan Cepat -->
                        <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-lightbulb text-yellow-500"></i>
                                Tips & Panduan
                            </h2>

                            <div class="space-y-3">
                                <div class="flex items-start gap-2 p-2 hover:bg-gray-50 rounded">
                                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                    <div>
                                        <p class="font-medium text-sm">Topik Spesifik</p>
                                        <p class="text-xs text-gray-600">Sebutkan topik spesifik untuk hasil yang lebih baik</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2 p-2 hover:bg-gray-50 rounded">
                                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                    <div>
                                        <p class="font-medium text-sm">Jumlah Optimal</p>
                                        <p class="text-xs text-gray-600">10-20 soal ideal untuk ujian 60-90 menit</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2 p-2 hover:bg-gray-50 rounded">
                                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                    <div>
                                        <p class="font-medium text-sm">Review Hasil</p>
                                        <p class="text-xs text-gray-600">Selalu review soal sebelum digunakan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Aksi Cepat -->
                        <div class="bg-white rounded-xl shadow-sm border p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-bolt text-red-500"></i>
                                Aksi Cepat
                            </h2>

                            <div class="space-y-2">
                                <a href="/guru/soal" class="block w-full text-left px-4 py-3 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-list text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">Lihat Semua Soal</p>
                                            <p class="text-xs text-gray-500">Kelola database soal</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="/guru/ujian/create" class="block w-full text-left px-4 py-3 border border-gray-200 rounded-lg hover:border-green-300 hover:bg-green-50 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-plus text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">Buat Ujian Baru</p>
                                            <p class="text-xs text-gray-500">Gunakan soal yang ada</p>
                                        </div>
                                    </div>
                                </a>

                                <button onclick="importFromFile()" class="w-full text-left px-4 py-3 border border-gray-200 rounded-lg hover:border-purple-300 hover:bg-purple-50 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-file-import text-purple-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">Import Soal</p>
                                            <p class="text-xs text-gray-500">Dari file Excel/Word</p>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Notification Toast -->
    <div id="notificationToast" class="fixed top-4 right-4 w-80 bg-white rounded-lg shadow-lg border hidden z-50">
        <div class="p-4">
            <div class="flex items-start justify-between mb-2">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-bell text-blue-600"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                </div>
                <button onclick="hideNotification()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="text-sm text-gray-600">
                <p class="mb-1">• 2 soal baru telah ditambahkan</p>
                <p class="mb-1">• Ujian Matematika akan berakhir dalam 30 menit</p>
                <p>• 5 siswa sedang mengerjakan ujian</p>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Mata Pelajaran -->
    <div id="addMapelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg w-full max-w-md">
                <form id="addMapelForm">
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="font-semibold text-gray-800">
                            <i class="fas fa-plus-circle mr-2 text-green-500"></i>
                            Tambah Mata Pelajaran
                        </h3>
                        <button type="button" onclick="hideAddMapelModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="p-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Mata Pelajaran
                            </label>
                            <input type="text" name="nama_mapel" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                placeholder="Contoh: Matematika, Fisika, Kimia, dll.">
                        </div>
                    </div>

                    <div class="p-4 border-t flex justify-end gap-2">
                        <button type="button" onclick="hideAddMapelModal()"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            <i class="fas fa-save mr-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Mata Pelajaran -->
    <div id="deleteMapelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg w-full max-w-md">
                <div class="flex justify-between items-center p-4 border-b">
                    <h3 class="font-semibold text-gray-800">
                        <i class="fas fa-trash mr-2 text-red-500"></i>
                        Hapus Mata Pelajaran
                    </h3>
                    <button type="button" onclick="hideDeleteMapelModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="p-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Mata Pelajaran yang akan dihapus
                        </label>
                        <select id="deleteMapelSelect" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach($mataPelajaran as $mapel)
                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-700">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Peringatan: Menghapus mata pelajaran akan menghapus semua soal yang terkait!
                        </p>
                    </div>
                </div>

                <div class="p-4 border-t flex justify-end gap-2">
                    <button type="button" onclick="hideDeleteMapelModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="button" onclick="deleteMapel()"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form submission handling - Updated version
        const soalForm = document.getElementById('soalForm');
        const submitBtn = document.getElementById('submitBtn');

        if (soalForm) {
            soalForm.addEventListener('submit', function(e) {
                e.preventDefault();
                simpanSoal(false); // TANPA confirm
            });

        }

    const form = document.getElementById('formSoal');

    if (tambahLagi) {
        // tambahkan flag agar setelah simpan redirect ke form kosong
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'tambah_lagi';
        input.value = '1';
        form.appendChild(input);
    }

    form.submit();

        // Fungsi helper
        function resetForm() {
            if (confirm('Reset semua input?')) {
                soalForm.reset();
                updatePreview();
            }
        }

        function showAddMapelModal() {
            document.getElementById('addMapelModal').classList.remove('hidden');
        }
let nomor = 1;

function tambahNomorSoal() {
    nomor++;
    document.getElementById('nomorSoal').value = nomor;
}

        function hideAddMapelModal() {
            document.getElementById('addMapelModal').classList.add('hidden');
        }

        function showDeleteMapelModal() {
            document.getElementById('deleteMapelModal').classList.remove('hidden');
        }

        function hideDeleteMapelModal() {
            document.getElementById('deleteMapelModal').classList.add('hidden');
        }

        // Handle submit form tambah mata pelajaran
        const addMapelForm = document.getElementById('addMapelForm');
        if (addMapelForm) {
            addMapelForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...';
                submitBtn.disabled = true;

                try {
                    const formData = new FormData(this);
                    const response = await fetch('/api/subjects', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            nama_mapel: formData.get('nama_mapel')
                        })
                    });

                    console.log('Response status:', response.status);
                    const result = await response.json();
                    console.log('Response data:', result);

                    if (response.ok && result.success) {
                        // Tambahkan opsi baru ke select
                        const mapelSelect = document.getElementById('mapelSelect');
                        const newOption = document.createElement('option');
                        newOption.value = result.data.id;
                        newOption.textContent = result.data.nama_mapel;
                        mapelSelect.appendChild(newOption);
                        mapelSelect.value = result.data.id;

                        // Tampilkan notifikasi sukses
                        showSuccessNotification(`Mata pelajaran "${result.data.nama_mapel}" berhasil ditambahkan!`);

                        // Tutup modal
                        hideAddMapelModal();
                        this.reset();

                        // Update statistik mata pelajaran
                        updateMapelCount();
                    } else {
                        console.error('API Error:', result);
                        alert(result.message || 'Gagal menambahkan mata pelajaran');
                    }

                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menambahkan mata pelajaran');
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }

        function showNotification() {
            const toast = document.getElementById('notificationToast');
            toast.style.animation = 'slideIn 0.3s ease-out';
            toast.classList.remove('hidden');
            setTimeout(hideNotification, 5000);
        }

        function hideNotification() {
            const toast = document.getElementById('notificationToast');
            toast.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => toast.classList.add('hidden'), 300);
        }

        function showSuccessNotification(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 w-80 bg-green-50 border border-green-200 rounded-lg shadow-lg z-50 animate-slideIn';
            toast.innerHTML = `
                <div class="p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-green-800">Berhasil!</p>
                            <p class="text-sm text-green-700 mt-1">${message}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-green-400 hover:text-green-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }

        function updateMapelCount() {
            // Update jumlah mata pelajaran di statistik
            const mapelSelect = document.getElementById('mapelSelect');
            const mapelCount = mapelSelect.options.length - 1; // -1 untuk option "Pilih Mata Pelajaran"
            const mapelCountElement = document.querySelector('.text-right .font-semibold');
            if (mapelCountElement) {
                mapelCountElement.textContent = mapelCount;
            }
        }

        // Fungsi placeholder untuk fungsi yang belum didefinisikan
        function updatePreview() {
            // Implementasi preview jika diperlukan
        }

        function loadSoalList() {
            // Implementasi load list soal jika diperlukan
            location.reload();
        }

        function importFromFile() {
            alert('Fitur import sedang dalam pengembangan');
        }

        function handleLogout() {
            if (confirm('Yakin ingin keluar?')) {
                // Implementasi logout
                window.location.href = '/logout';
            }
        }

        function deleteMapel() {
            const mapelId = document.getElementById('deleteMapelSelect').value;
            if (!mapelId) {
                alert('Pilih mata pelajaran yang akan dihapus');
                return;
            }

            if (confirm('Yakin ingin menghapus mata pelajaran ini? Semua soal terkait akan ikut terhapus!')) {
                // Implementasi delete
                alert('Fitur hapus mata pelajaran sedang dalam pengembangan');
            }
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            
            .animate-slideIn {
                animation: slideIn 0.3s ease-out;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>