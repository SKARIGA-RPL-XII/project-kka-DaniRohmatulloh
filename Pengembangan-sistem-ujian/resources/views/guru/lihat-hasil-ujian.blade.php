<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hasil Ujian | Dashboard Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .result-card {
            transition: all 0.2s;
        }
        
        .result-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        
        .avatar {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            color: white;
            font-weight: bold;
        }
        
        .score-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 9999px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
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
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
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
                   class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium">
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
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-sm border-b border-gray-200/50 px-6 py-4">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Hasil Ujian Siswa</h1>
                        <p class="text-gray-600 mt-1">Lihat dan kelola hasil ujian yang telah diselesaikan</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button onclick="refreshResults()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">
                            <i class="fas fa-redo mr-2"></i>Refresh
                        </button>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-auto p-4 md:p-6">
                <!-- Filter Section -->
                <div class="glass-card rounded-2xl p-5 mb-6">
                    <div class="flex flex-col md:flex-row gap-4 items-center">
                        <div class="flex-1 w-full">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                <input type="text" placeholder="Cari siswa atau ujian..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="searchInput" onkeyup="filterResults()">
                            </div>
                        </div>
                        
                        <select class="border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" id="examFilter" onchange="filterResults()">
                            <option value="">Semua Ujian</option>
                            @foreach($ujianList as $ujian)
                            <option value="{{ $ujian->id }}">{{ $ujian->nama_ujian }}</option>
                            @endforeach
                        </select>
                        
                        <select class="border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" id="typeFilter" onchange="filterResults()">
                            <option value="">Semua Tipe</option>
                            <option value="pilihan_ganda">Pilihan Ganda</option>
                            <option value="essay">Essay</option>
                        </select>
                        
                        <button onclick="clearFilters()" class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">
                            <i class="fas fa-redo mr-2"></i>Reset
                        </button>
                    </div>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Ujian -->
                    <div class="glass-card rounded-2xl p-5 result-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Ujian</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalExams }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $activeExams }} aktif</p>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-clipboard-list text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Siswa Selesai -->
                    <div class="glass-card rounded-2xl p-5 result-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Siswa Selesai</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $completedStudents }}</p>
                                <p class="text-xs text-gray-500 mt-2">dari {{ $totalStudents }} total</p>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-check text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rata-rata Nilai -->
                    <div class="glass-card rounded-2xl p-5 result-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Rata-rata Nilai</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $averageScore }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    @if($scoreTrend > 0)
                                        <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full">
                                            <i class="fas fa-arrow-up mr-1"></i>+{{ $scoreTrend }}%
                                        </span>
                                    @elseif($scoreTrend < 0)
                                        <span class="text-xs px-2 py-1 bg-red-100 text-red-700 rounded-full">
                                            <i class="fas fa-arrow-down mr-1"></i>{{ $scoreTrend }}%
                                        </span>
                                    @else
                                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-700 rounded-full">
                                            <i class="fas fa-minus mr-1"></i>0%
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-chart-line text-purple-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tingkat Kelulusan -->
                    <div class="glass-card rounded-2xl p-5 result-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Tingkat Kelulusan</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $passingRate }}%</p>
                                <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                                    <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 h-2 rounded-full" style="width: {{ $passingRate }}%;"></div>
                                </div>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-trophy text-emerald-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Table -->
                <div class="glass-card rounded-2xl overflow-hidden">
                    <div class="border-b border-gray-200/50 p-5">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Hasil Ujian Terbaru</h3>
                                <p class="text-sm text-gray-600 mt-1">Menampilkan {{ $results->count() }} dari {{ $totalResults }} hasil</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-600">Urutkan:</span>
                                <select class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="sortResults(this.value)">
                                    <option value="newest">Terbaru</option>
                                    <option value="highest">Nilai Tertinggi</option>
                                    <option value="lowest">Nilai Terendah</option>
                                    <option value="name">Nama Siswa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50/50">
                                    <th class="text-left p-4 text-sm font-medium text-gray-700">Siswa</th>

                                    <th class="text-left p-4 text-sm font-medium text-gray-700">Ujian</th>
                                    <th class="text-left p-4 text-sm font-medium text-gray-700">Tipe Ujian</th>
                                    <th class="text-left p-4 text-sm font-medium text-gray-700">Nilai</th>

                                    <th class="text-left p-4 text-sm font-medium text-gray-700">Status</th>
                                    <th class="text-left p-4 text-sm font-medium text-gray-700">Waktu</th>
                                    <th class="text-left p-4 text-sm font-medium text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($results as $result)
                                <tr class="border-t border-gray-200/50 hover:bg-gray-50/50">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="avatar bg-gradient-to-br from-blue-400 to-blue-600">
                                                {{ substr($result->student_name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $result->student_name }}</p>
                                                <p class="text-xs text-gray-500">{{ $result->student_id }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="p-4">
                                        <p class="font-medium text-gray-800">{{ $result->exam_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $result->exam_subject }}</p>
                                    </td>
                                    <td class="p-4">
                                        <span class="inline-flex px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full font-medium">
                                            {{ $result->tipe_ujian }}
                                        </span>
                                    </td>
                                    <td class="p-4">

                                        <div class="flex items-center gap-2">
                                            <span class="text-xl font-bold 
                                                @if($result->score >= 85) text-emerald-600
                                                @elseif($result->score >= 70) text-blue-600
                                                @elseif($result->score >= 60) text-amber-600
                                                @else text-red-600
                                                @endif">
                                                {{ $result->score }}
                                            </span>
                                            <span class="text-gray-500 text-sm">/100</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        @if($result->passed)
                                            <span class="score-badge bg-emerald-100 text-emerald-800">
                                                <i class="fas fa-check-circle mr-1"></i>Lulus
                                            </span>
                                        @else
                                            <span class="score-badge bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1"></i>Tidak Lulus
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <div class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($result->completed_at)->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($result->completed_at)->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            <button onclick="viewResultDetail({{ $result->id }})" 
                                                    class="px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-sm font-medium">
                                                <i class="fas fa-eye mr-1"></i>Detail
                                            </button>
                                            <button onclick="downloadResult({{ $result->id }})" 
                                                    class="px-3 py-1.5 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg text-sm">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center">
                                        <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-clipboard text-gray-400 text-2xl"></i>
                                        </div>
                                        <p class="text-gray-500 mb-2">Belum ada hasil ujian</p>
                                        <p class="text-sm text-gray-400">Hasil ujian akan muncul setelah siswa menyelesaikan ujian</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($results->hasPages())
                    <div class="border-t border-gray-200/50 p-4 flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            Menampilkan {{ $results->firstItem() }} - {{ $results->lastItem() }} dari {{ $results->total() }} hasil
                        </div>
                        <div class="flex gap-2">
                            @if($results->onFirstPage())
                                <span class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-400">
                                    <i class="fas fa-chevron-left text-sm"></i>
                                </span>
                            @else
                                <a href="{{ $results->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-chevron-left text-sm"></i>
                                </a>
                            @endif
                            
                            @foreach(range(1, min(5, $results->lastPage())) as $page)
                                @if($page == $results->currentPage())
                                    <span class="w-8 h-8 flex items-center justify-center bg-blue-500 text-white rounded-lg">{{ $page }}</span>
                                @else
                                    <a href="{{ $results->url($page) }}" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach
                            
                            @if($results->hasMorePages())
                                <a href="{{ $results->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-chevron-right text-sm"></i>
                                </a>
                            @else
                                <span class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-400">
                                    <i class="fas fa-chevron-right text-sm"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Recent Exams Summary -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                    <!-- Top Performers -->
                    <div class="glass-card rounded-2xl p-5 lg:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Performa Terbaik</h3>
                        <div class="space-y-4">
                            @foreach($topPerformers as $performer)
                            <div class="flex items-center justify-between p-3 bg-gray-50/50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $performer->student_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $performer->class }} • {{ $performer->exam_name }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-emerald-600">{{ $performer->score }}</p>
                                    <p class="text-xs text-gray-500">/100</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="glass-card rounded-2xl p-5">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Statistik Cepat</h3>
                        <div class="space-y-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-2">Distribusi Nilai</p>
                                <div class="grid grid-cols-4 gap-2">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-emerald-600">{{ $scoreDistribution['excellent'] }}</div>
                                        <div class="text-xs text-gray-500">85-100</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-blue-600">{{ $scoreDistribution['good'] }}</div>
                                        <div class="text-xs text-gray-500">70-84</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-amber-600">{{ $scoreDistribution['average'] }}</div>
                                        <div class="text-xs text-gray-500">60-69</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-red-600">{{ $scoreDistribution['poor'] }}</div>
                                        <div class="text-xs text-gray-500">0-59</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600 mb-2">Waktu Penyelesaian Rata-rata</p>
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-clock text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xl font-bold text-gray-800">{{ $averageCompletionTime }} menit</p>
                                        <p class="text-xs text-gray-500">dari {{ $averageDuration }} menit tersedia</p>
                                    </div>
                                </div>
                            </div>
                            
                            <button onclick="generateReport()" class="w-full py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:shadow-md transition-shadow font-medium">
                                <i class="fas fa-file-alt mr-2"></i>Generate Report
                            </button>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white/80 backdrop-blur-sm border-t border-gray-200/50 px-6 py-3">
                <p class="text-sm text-gray-600 text-center">
                    &copy; 2024 ExamPro • Sistem Hasil Ujian
                </p>
            </footer>
        </div>
    </div>

    <!-- Result Detail Modal -->
    <div id="resultDetailModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Detail Hasil Ujian</h3>
                    <button onclick="hideResultDetail()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                <div id="resultDetailContent">
                    <!-- Content akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Export Modal -->
    <div id="exportModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Export Hasil</h3>
                    <button onclick="hideExportModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Format File</label>
                        <select id="exportFormat" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="pdf">PDF Document</option>
                            <option value="excel">Excel Spreadsheet</option>
                            <option value="csv">CSV File</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rentang Data</label>
                        <select id="exportRange" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="all">Semua Hasil</option>
                            <option value="selected">Yang Dipilih</option>
                            <option value="date">Berdasarkan Tanggal</option>
                        </select>
                    </div>
                    
                    <div class="pt-4">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" id="includeDetails" class="rounded text-blue-600">
                            <span class="text-sm text-gray-700">Sertakan detail jawaban</span>
                        </label>
                    </div>
                </div>
                <div class="flex gap-3 pt-6 mt-6">
                    <button onclick="performExport()" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium py-3 px-6 rounded-lg hover:shadow-md">
                        <i class="fas fa-download mr-2"></i>Export
                    </button>
                    <button onclick="hideExportModal()" class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        /* eslint-disable */
        /* jshint ignore:start */
        // Sample data for demonstration
        const examResults = [
            {
                id: 1,
                student_name: "Ahmad Fauzi",
                student_id: "S001",
                exam_name: "UTS Matematika",
                exam_subject: "Matematika",
                class: "10A",
                score: 92,
                passed: true,
                completed_at: "2024-01-15 14:30:00",
                time_taken: "45:30",
                total_questions: 40,
                correct_answers: 37,
                details: {
                    algebra: { score: 95, total: 10 },
                    geometry: { score: 90, total: 10 },
                    trigonometry: { score: 88, total: 10 },
                    calculus: { score: 95, total: 10 }
                }
            },
            {
                id: 2,
                student_name: "Siti Nurhaliza",
                student_id: "S002",
                exam_name: "UTS Matematika",
                exam_subject: "Matematika",
                class: "10A",
                score: 88,
                passed: true,
                completed_at: "2024-01-15 15:15:00",
                time_taken: "50:15",
                total_questions: 40,
                correct_answers: 35,
                details: {
                    algebra: { score: 90, total: 10 },
                    geometry: { score: 85, total: 10 },
                    trigonometry: { score: 85, total: 10 },
                    calculus: { score: 92, total: 10 }
                }
            }
        ];

        function viewResultDetail(resultId) {
            const result = examResults.find(r => r.id === resultId);
            if (!result) return;
            
            const modalContent = document.getElementById('resultDetailContent');
            const detailHtml = `
                <div class="space-y-6">
                    <!-- Header -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg mb-2">${result.student_name}</h4>
                            <div class="space-y-2 text-sm">
                                <p class="text-gray-600"><span class="font-medium">ID:</span> ${result.student_id}</p>
                                <p class="text-gray-600"><span class="font-medium">Kelas:</span> ${result.class}</p>
                                <p class="text-gray-600"><span class="font-medium">Ujian:</span> ${result.exam_name}</p>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Nilai Akhir</p>
                                    <p class="text-4xl font-bold text-blue-600 mt-2">${result.score}</p>
                                    <p class="text-gray-500">/100</p>
                                </div>
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">${Math.floor(result.score/10)}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Score Summary -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600">Jawaban Benar</p>
                            <p class="text-2xl font-bold text-gray-800">${result.correct_answers}</p>
                            <p class="text-xs text-gray-500">dari ${result.total_questions} soal</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600">Waktu</p>
                            <p class="text-2xl font-bold text-gray-800">${result.time_taken}</p>
                            <p class="text-xs text-gray-500">menit</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600">Status</p>
                            <p class="text-lg font-bold ${result.passed ? 'text-emerald-600' : 'text-red-600'}">
                                ${result.passed ? 'LULUS' : 'TIDAK LULUS'}
                            </p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600">Selesai</p>
                            <p class="text-lg font-bold text-gray-800">${formatDate(result.completed_at)}</p>
                        </div>
                    </div>
                    
                    <!-- Performance by Category -->
                    <div>
                        <h5 class="font-semibold text-gray-800 mb-4">Performasi per Kategori</h5>
                        <div class="space-y-3">
                            ${Object.entries(result.details).map(([category, data]) => `
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-700 capitalize">${category}</span>
                                        <span class="font-medium">${data.score}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-400 to-blue-500 h-2 rounded-full" style="width: ${data.score}%;"></div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="pt-6 border-t border-gray-200">
                        <div class="flex gap-3">
                            <button onclick="downloadResultDetail(${result.id})" class="flex-1 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg font-medium hover:shadow-md">
                                <i class="fas fa-download mr-2"></i>Download PDF
                            </button>
                            <button onclick="sendResultToStudent(${result.id})" class="flex-1 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                                <i class="fas fa-paper-plane mr-2"></i>Kirim ke Siswa
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            modalContent.innerHTML = detailHtml;
            document.getElementById('resultDetailModal').classList.remove('hidden');
        }

        function hideResultDetail() {
            document.getElementById('resultDetailModal').classList.add('hidden');
        }

        function showExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }

        function hideExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }

        function showLogoutConfirm() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
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
        }

        function filterResults() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const exam = document.getElementById('examFilter').value;
            const type = document.getElementById('typeFilter').value;
            
            // Filter table rows
            const rows = document.querySelectorAll('tbody tr:not(:first-child)');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const studentName = row.cells[0].textContent.toLowerCase();
                const examName = row.cells[1].textContent.toLowerCase();
                const classType = row.cells[2].textContent.toLowerCase();
                
                const matchesSearch = studentName.includes(search) || examName.includes(search);
                const matchesExam = !exam || examName.includes(exam);
                const matchesType = !type || classType.includes(type);
                
                if (matchesSearch && matchesExam && matchesType) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Update counter
            document.querySelector('.text-gray-600').textContent = `Menampilkan ${visibleCount} hasil`;
        }

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('examFilter').value = '';
            document.getElementById('classFilter').value = '';
            filterResults();
        }

        function sortResults(order) {
            console.log('Sorting by:', order);
            // Implementasi sorting
        }

        function exportAllResults() {
            showExportModal();
        }

        function refreshResults() {
            location.reload();
        }

        function downloadResult(resultId) {
            console.log('Downloading result:', resultId);
            // Implementasi download
        }

        function downloadResultDetail(resultId) {
            console.log('Downloading detailed result:', resultId);
        }

        function sendResultToStudent(resultId) {
            if (confirm('Kirim hasil ini ke siswa?')) {
                console.log('Sending result to student:', resultId);
                alert('Hasil telah dikirim ke siswa');
            }
        }

        function generateReport() {
            console.log('Generating report...');
            // Implementasi generate report
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi jika diperlukan
        });
    </script>
</body>
</html>