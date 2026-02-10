<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Soal | ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- SIDEBAR (tidak diubah) -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
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

            <div class="p-6 border-b">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-800 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-full">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <span class="text-xs font-medium text-blue-700">Guru Aktif</span>
                </div>
            </div>

            <nav class="flex-1 p-4 space-y-1">
                <a href="/guru/dashboard" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-home w-5 text-center"></i><span>Dashboard</span>
                </a>
                <a href="/guru/soal" class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium">
                    <i class="fas fa-question-circle w-5 text-center"></i><span>Kelola Soal</span>
                </a>
                <a href="/guru/examp" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-cog w-5 text-center"></i><span>Pengaturan Soal</span>
                </a>
                <a href="{{ route('guru.hasil-ujian') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chart-bar w-5 text-center"></i><span>Lihat Hasil Ujian</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-users w-5 text-center"></i><span>Kelola Kelas</span>
                </a>
            </nav>

            <div class="p-4 border-t">
                <button onclick="showLogoutConfirm()" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i><span>Logout</span>
                </button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">
            <!-- HEADER -->
            <header class="bg-white border-b px-6 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow">
                            <i class="fas fa-question-circle text-white text-lg"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Kelola Soal</h1>
                            <p class="text-sm text-gray-600 mt-1 flex items-center gap-2">
                                <i class="fas fa-pen-fancy text-indigo-500"></i>
                                <span>Buat dan kelola soal dengan fitur lengkap</span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="hidden md:flex items-center gap-2 px-3 py-1.5 bg-green-50 border border-green-200 rounded-lg">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-xs font-medium text-green-700">Soal: {{ $totalSoal ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN -->
            <main class="flex-1 p-6 overflow-y-auto">
                <!-- ALERTS -->
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-green-800">Berhasil!</p>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-green-400 hover:text-green-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-red-800">Terjadi Kesalahan</p>
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- FORM SOAL -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- FORM CARD -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-edit text-white"></i>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-white">Form Buat Soal</h2>
                                            <p class="text-xs text-blue-100">Buat soal baru dengan mudah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button onclick="showDeleteMapelModal()" class="px-3 py-1.5 bg-white/20 text-white text-sm rounded-lg hover:bg-white/30">
                                            <i class="fas fa-trash text-xs mr-1"></i>Hapus Mapel
                                        </button>
                                        <button onclick="showAddMapelModal()" class="px-3 py-1.5 bg-white text-indigo-600 text-sm rounded-lg hover:bg-gray-100 shadow">
                                            <i class="fas fa-plus text-xs mr-1"></i>Tambah Mapel
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <form method="POST" action="{{ route('guru.soal.store') }}" id="soalForm">
                                    @csrf

                                    <!-- MAPEL -->
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center gap-2">
                                            <i class="fas fa-book text-blue-600"></i>
                                            <span>Mata Pelajaran</span>
                                        </label>
                                        <select name="mapel_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                            <option value="">Pilih Mata Pelajaran</option>
                                            @foreach($mataPelajaran as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- SOAL CONTAINER -->
                                    <div id="soalContainer">
                                        <div class="soal-item bg-gray-50 border border-gray-200 rounded-lg p-5 mb-4">
                                            <!-- HEADER -->
                                            <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                                        <span class="text-white font-bold text-sm">1</span>
                                                    </div>
                                                    <h3 class="font-medium text-gray-800">Soal 1</h3>
                                                </div>
                                                <button type="button" onclick="hapusSoal(this)" class="text-red-400 hover:text-red-600">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <input type="hidden" name="nomor[]" value="1" class="nomorSoal">

                                            <!-- PERTANYAAN -->
                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                                    <i class="fas fa-question text-blue-600"></i>
                                                    <span>Pertanyaan</span>
                                                </label>
                                                <textarea name="pertanyaan[]" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Tulis pertanyaan di sini..."></textarea>
                                            </div>

                                            <!-- OPSI -->
                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center gap-2">
                                                    <i class="fas fa-list-ul text-green-600"></i>
                                                    <span>Opsi Jawaban</span>
                                                </label>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                    @foreach(['A' => 'opsi_a', 'B' => 'opsi_b', 'C' => 'opsi_c', 'D' => 'opsi_d'] as $label => $name)
                                                    <div class="relative">
                                                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                            {{ $label }}
                                                        </div>
                                                        <input type="text" name="{{ $name }}[]" required class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Opsi {{ $label }}">
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- JAWABAN BENAR -->
                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center gap-2">
                                                    <i class="fas fa-check-circle text-green-600"></i>
                                                    <span>Jawaban Benar</span>
                                                </label>
                                                <div class="grid grid-cols-4 gap-3">
                                                    @foreach(['A', 'B', 'C', 'D'] as $option)
                                                    <label class="relative cursor-pointer">
                                                        <input type="radio" name="jawaban_benar[]" value="{{ $option }}" class="hidden peer" {{ $option == 'A' ? 'checked' : '' }}>
                                                        <div class="w-full py-3.5 text-center border border-gray-300 rounded-lg peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50">
                                                            <span class="font-medium text-gray-700 peer-checked:text-blue-600">{{ $option }}</span>
                                                        </div>
                                                        <div class="absolute -top-1 -right-1 w-5 h-5 bg-blue-500 rounded-full hidden peer-checked:flex items-center justify-center">
                                                            <i class="fas fa-check text-white text-xs"></i>
                                                        </div>
                                                    </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TOMBOL -->
                                    <div class="flex items-center gap-3 pt-6 border-t border-gray-200">
                                        <button type="submit" name="action" value="save" class="flex-1 bg-blue-600 text-white font-medium py-3.5 px-6 rounded-lg hover:bg-blue-700">
                                            <div class="flex items-center justify-center gap-2">
                                                <i class="fas fa-save"></i>
                                                <span>Simpan Soal</span>
                                            </div>
                                        </button>

                                        <button type="button" onclick="resetForm()" class="px-6 py-3.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-redo"></i>
                                                <span>Reset</span>
                                            </div>
                                        </button>

                                        <button type="button" onclick="addNextQuestion()" class="px-6 py-3.5 bg-green-500 text-white font-medium rounded-lg hover:bg-green-600">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-plus"></i>
                                                <span>Tambah Soal</span>
                                            </div>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- DAFTAR SOAL -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gray-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-list text-white"></i>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-gray-800">Daftar Soal Terbaru</h2>
                                            <p class="text-xs text-gray-600">{{ $recentSoal->count() }} soal terakhir</p>
                                        </div>
                                    </div>
                                    <button onclick="loadSoalList()" class="px-4 py-2 bg-gray-700 text-white text-sm rounded-lg hover:bg-gray-800 shadow">
                                        <i class="fas fa-redo-alt mr-1"></i>Refresh
                                    </button>
                                </div>
                            </div>

                            <div class="p-1">
                                <div class="overflow-x-auto">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="bg-gray-50">
                                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase border-b border-gray-200">No</th>
                                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase border-b border-gray-200">Pertanyaan</th>
                                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase border-b border-gray-200">Mapel</th>
                                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase border-b border-gray-200">Jawaban</th>
                                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase border-b border-gray-200">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @forelse($recentSoal as $soal)
                                            <tr class="hover:bg-blue-50/30">
                                                <td class="px-4 py-3 text-sm">
                                                    <div class="w-8 h-8 bg-blue-100 rounded-md flex items-center justify-center">
                                                        <span class="font-bold text-blue-700">{{ $loop->iteration }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-900 max-w-xs">
                                                    <div class="font-medium text-gray-800 truncate">{{ $soal->pertanyaan }}</div>
                                                    <div class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                                        <i class="fas fa-calendar text-gray-400"></i>
                                                        {{ $soal->created_at->format('d M Y') }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                                        {{ $soal->mataPelajaran->nama_mapel ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-green-50 rounded-full">
                                                        <span class="font-bold text-green-700">{{ $soal->jawaban_benar }}</span>
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <div class="flex items-center gap-1">
                                                        <button onclick="editSoal('{{ $soal->id }}')" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button onclick="deleteSoal('{{ $soal->id }}')" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="px-4 py-12 text-center">
                                                    <div class="flex flex-col items-center">
                                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                            <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                                                        </div>
                                                        <p class="text-gray-500 font-medium">Belum ada soal</p>
                                                        <p class="text-gray-400 text-sm mt-1">Silakan buat soal baru</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SIDEBAR KANAN -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- STATISTIK -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow">
                            <div class="bg-blue-500 px-6 py-4">
                                <h2 class="text-lg font-bold text-white flex items-center gap-3">
                                    <i class="fas fa-chart-bar"></i>
                                    <span>Statistik Soal</span>
                                </h2>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl border border-blue-200">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center shadow">
                                                <i class="fas fa-question text-white"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-blue-700">Total Soal</p>
                                                <p class="text-2xl font-bold text-gray-800">{{ $totalSoal ?? 0 }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm text-blue-700">Mapel</div>
                                            <div class="text-xl font-bold text-gray-800">{{ count($mataPelajaran) }}</div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="p-4 bg-green-50 rounded-xl border border-green-200">
                                            <div class="flex items-center gap-3 mb-2">
                                                <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                                    <i class="fas fa-list-ul text-white text-xs"></i>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-green-700">Pilihan Ganda</p>
                                                    <p class="text-lg font-bold text-gray-800">{{ $soalPG ?? 0 }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                                            <div class="flex items-center gap-3 mb-2">
                                                <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                                    <i class="fas fa-file-alt text-white text-xs"></i>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-yellow-700">Essay</p>
                                                    <p class="text-lg font-bold text-gray-800">{{ $soalEssay ?? 0 }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TIPS -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow">
                            <div class="bg-yellow-500 px-6 py-4">
                                <h2 class="text-lg font-bold text-white flex items-center gap-3">
                                    <i class="fas fa-lightbulb"></i>
                                    <span>Tips & Panduan</span>
                                </h2>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-start gap-3 p-3 hover:bg-gray-50 rounded-lg">
                                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                        <div>
                                            <p class="font-medium text-sm text-gray-800">Topik Spesifik</p>
                                            <p class="text-xs text-gray-600">Sebutkan topik spesifik untuk hasil yang lebih baik</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 hover:bg-gray-50 rounded-lg">
                                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                        <div>
                                            <p class="font-medium text-sm text-gray-800">Jumlah Optimal</p>
                                            <p class="text-xs text-gray-600">10-20 soal ideal untuk ujian 60-90 menit</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 hover:bg-gray-50 rounded-lg">
                                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                        <div>
                                            <p class="font-medium text-sm text-gray-800">Review Hasil</p>
                                            <p class="text-xs text-gray-600">Selalu review soal sebelum digunakan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- AKSI CEPAT -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow">
                            <div class="bg-purple-500 px-6 py-4">
                                <h2 class="text-lg font-bold text-white flex items-center gap-3">
                                    <i class="fas fa-bolt"></i>
                                    <span>Aksi Cepat</span>
                                </h2>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3">
                                    <a href="/guru/soal" class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50">
                                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-list text-white"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-sm text-gray-800">Lihat Semua Soal</p>
                                            <p class="text-xs text-gray-600">Kelola database soal</p>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </a>
                                    <a href="/guru/ujian/create" class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:border-green-300 hover:bg-green-50">
                                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-plus text-white"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-sm text-gray-800">Buat Ujian Baru</p>
                                            <p class="text-xs text-gray-600">Gunakan soal yang ada</p>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </a>
                                    <button onclick="importFromFile()" class="w-full text-left flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:border-purple-300 hover:bg-purple-50">
                                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-file-import text-white"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-sm text-gray-800">Import Soal</p>
                                            <p class="text-xs text-gray-600">Dari file Excel/Word</p>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- FOOTER -->
            <footer class="bg-white border-t px-6 py-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">ExamSystem - Kelola Soal</p>
                            <p class="text-xs text-gray-500">&copy; {{ date('Y') }} All rights reserved</p>
                        </div>
                    </div>
                    <div class="flex gap-6 mt-3 md:mt-0">
                        <a href="#" class="text-sm text-gray-600 hover:text-indigo-600">Bantuan</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-indigo-600">Dokumentasi</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-indigo-600">Kontak</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- MODALS -->
    <div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-sm w-full">
            <div class="p-6">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-sign-out-alt text-2xl text-red-600"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Konfirmasi Logout</h3>
                <p class="text-gray-600 text-center mb-6">Anda yakin ingin keluar dari sistem?</p>
                <div class="flex gap-3">
                    <button onclick="hideLogoutConfirm()" class="flex-1 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">Batal</button>
                    <button onclick="performLogout()" class="flex-1 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700">Ya, Logout</button>
                </div>
            </div>
        </div>
    </div>

    <div id="addMapelModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full">
            <form id="addMapelForm">
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="font-bold text-gray-800"><i class="fas fa-plus-circle mr-2 text-green-600"></i>Tambah Mata Pelajaran</h3>
                    <button type="button" onclick="hideAddMapelModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Nama Mata Pelajaran</label>
                        <input type="text" name="nama_mapel" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500" placeholder="Contoh: Matematika, Fisika, Kimia, dll.">
                    </div>
                </div>
                <div class="p-6 border-t flex justify-end gap-3">
                    <button type="button" onclick="hideAddMapelModal()" class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700"><i class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteMapelModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="font-bold text-gray-800"><i class="fas fa-trash mr-2 text-red-600"></i>Hapus Mata Pelajaran</h3>
                <button type="button" onclick="hideDeleteMapelModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Mata Pelajaran yang akan dihapus</label>
                    <select id="deleteMapelSelect" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500">
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($mataPelajaran as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm text-red-700"><i class="fas fa-exclamation-triangle mr-1"></i>Peringatan: Menghapus mata pelajaran akan menghapus semua soal yang terkait!</p>
                </div>
            </div>
            <div class="p-6 border-t flex justify-end gap-3">
                <button type="button" onclick="hideDeleteMapelModal()" class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">Batal</button>
                <button type="button" onclick="deleteMapel()" class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700"><i class="fas fa-trash mr-2"></i>Hapus</button>
            </div>
        </div>
    </div>

    <script>
        // ===== BASIC FUNCTIONS =====
        function showLogoutConfirm() { document.getElementById('logoutModal').classList.remove('hidden'); }
        function hideLogoutConfirm() { document.getElementById('logoutModal').classList.add('hidden'); }
        function performLogout() {
            document.getElementById('logoutModal').classList.add('hidden');
            const btn = document.querySelector('#logoutModal button:last-child');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            btn.disabled = true;
            setTimeout(() => window.location.href = '/logout', 1000);
        }

        function showNotifications() { /* Implementation */ }
        function hideNotifications() { /* Implementation */ }
        function showAddMapelModal() { document.getElementById('addMapelModal').classList.remove('hidden'); }
        function hideAddMapelModal() { document.getElementById('addMapelModal').classList.add('hidden'); document.getElementById('addMapelForm').reset(); }
        function showDeleteMapelModal() { document.getElementById('deleteMapelModal').classList.remove('hidden'); }
        function hideDeleteMapelModal() { document.getElementById('deleteMapelModal').classList.add('hidden'); }

        // ===== SOAL MANAGEMENT =====
        let soalCount = 1;
        
        function addNextQuestion() {
            soalCount++;
            const container = document.getElementById('soalContainer');
            const lastSoal = container.querySelector('.soal-item:last-child');
            const newSoal = lastSoal.cloneNode(true);
            
            // Update nomor
            newSoal.querySelector('.w-8.h-8 span').textContent = soalCount;
            newSoal.querySelector('.nomorSoal').value = soalCount;
            newSoal.querySelector('h3').textContent = `Soal ${soalCount}`;
            
            // Reset inputs
            newSoal.querySelectorAll('input, textarea').forEach(el => el.value = '');
            newSoal.querySelectorAll('input[type="radio"]').forEach((radio, i) => radio.checked = i === 0);
            
            container.appendChild(newSoal);
            showToast(`Soal ${soalCount} ditambahkan`, 'success');
        }

        function hapusSoal(button) {
            const soalItems = document.querySelectorAll('.soal-item');
            if (soalItems.length > 1) {
                button.closest('.soal-item').remove();
                renumberSoalItems();
                soalCount--;
            } else {
                showToast('Setidaknya harus ada satu soal', 'warning');
            }
        }

        function renumberSoalItems() {
            document.querySelectorAll('.soal-item').forEach((item, index) => {
                const nomor = index + 1;
                item.querySelector('.w-8.h-8 span').textContent = nomor;
                item.querySelector('.nomorSoal').value = nomor;
                item.querySelector('h3').textContent = `Soal ${nomor}`;
            });
        }

        function resetForm() {
            if (confirm('Reset semua input? Data yang belum disimpan akan hilang.')) {
                document.getElementById('soalForm').reset();
                const container = document.getElementById('soalContainer');
                const firstSoal = container.querySelector('.soal-item');
                container.innerHTML = '';
                container.appendChild(firstSoal);
                renumberSoalItems();
                soalCount = 1;
                showToast('Form berhasil direset', 'info');
            }
        }

        // ===== HELPER FUNCTIONS =====
        function loadSoalList() {
            const btn = document.querySelector('button[onclick="loadSoalList()"]');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memuat...';
            btn.disabled = true;
            setTimeout(() => location.reload(), 1000);
        }

        function editSoal(id) { showToast('Membuka editor soal...', 'info'); }
        function deleteSoal(id) { if (confirm('Yakin ingin menghapus soal ini?')) { showToast('Soal dihapus', 'success'); setTimeout(() => location.reload(), 1000); } }
        function importFromFile() { showToast('Fitur import sedang dalam pengembangan', 'info'); }

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500' :
                type === 'error' ? 'bg-red-500' :
                type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500'
            } text-white`;
            toast.innerHTML = `<div class="flex items-center gap-3"><i class="fas fa-${
                type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'
            }"></i><span>${message}</span></div>`;
            document.body.appendChild(toast);
            setTimeout(() => { toast.remove(); }, 3000);
        }

        // ===== EVENT LISTENERS =====
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                hideLogoutConfirm();
                hideAddMapelModal();
                hideDeleteMapelModal();
            }
        });
    </script>
</body>
</html>