<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pengaturan Soal Ujian | Dashboard Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .question-card {
            transition: all 0.2s;
        }
        
        .question-card:hover {
            transform: translateY(-2px);
        }
        
        .selected-question {
            border-left: 4px solid #3b82f6;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 9999px;
        }
        
        .sidebar-icon {
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }
        
        /* Loading animation */
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .loading-spinner {
            animation: spin 1s linear infinite;
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
{{ strtoupper(substr(auth()->user()->nama ?? 'G', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-800 truncate">{{ auth()->user()->nama ?? 'Guru' }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'guru@email.com' }}</p>
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
                    <i class="fas fa-home w-5 text-center text-gray-500 hover:text-indigo-600"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="/guru/soal" 
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-question-circle w-5 text-center text-gray-500 hover:text-indigo-600"></i>
                    <span>Kelola Soal</span>
                </a>
                
                <a href="/guru/examp" 
                   class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium">
                    <i class="fas fa-cog w-5 text-center text-indigo-600"></i>
                    <span>Pengaturan Soal</span>
                </a>
                
                <a href="{{ route('guru.hasil-ujian') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-chart-bar w-5 text-center text-gray-500 hover:text-indigo-600"></i>
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
                        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Soal Ujian</h1>
                        <p class="text-gray-600 mt-1">Atur waktu, nilai, dan konfigurasi ujian</p>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="flex items-center gap-3">
                        <div class="hidden lg:flex items-center gap-4 text-sm text-gray-600">
                            <span class="flex items-center gap-1">
                                <i class="fas fa-database text-blue-500"></i>
                                <span id="totalQuestions">0</span> soal
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="fas fa-clock text-green-500"></i>
                                <span id="activeExams">0</span> aktif
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-auto p-4 md:p-6">
                <div id="messageContainer"></div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Soal Tersedia -->
                    <div class="lg:col-span-2">
                        <div class="glass-card rounded-2xl shadow-sm overflow-hidden">
                            <div class="p-5 border-b border-gray-200/50">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div>
                                        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                            <i class="fas fa-question-circle text-blue-500"></i>
                                            Soal Tersedia
                                        </h2>
                                        <p class="text-gray-600 text-sm mt-1">Pilih soal untuk ditambahkan ke ujian</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="badge bg-blue-100 text-blue-700" id="questionCount">0 soal</span>
                                        <div class="relative">
                                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                            <input type="text" placeholder="Cari soal..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm w-48" id="searchInput" onkeyup="filterQuestions()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-4">
                                <!-- Filter Chips - Dropdown Pilih Materi -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <select onchange="filterBySubject()" id="subjectFilter" class="px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                        <option value="">Pilih Materi</option>
                                        @foreach($mataPelajaran ?? [] as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <select onchange="filterQuestions()" id="typeFilter" class="px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                        <option value="">Semua Tipe</option>
                                        <option value="pilihan_ganda">Pilihan Ganda</option>
                                        <option value="essay">Essay</option>
                                    </select>
                                    
                                    <button onclick="clearFilters()" class="px-3 py-1.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">
                                        <i class="fas fa-redo mr-1"></i>Reset
                                    </button>
                                </div>
                                
                                <!-- Loading Indicator -->
                                <div id="loadingIndicator" class="hidden text-center py-8">
                                    <i class="fas fa-spinner loading-spinner text-3xl text-blue-500"></i>
                                    <p class="mt-2 text-gray-500">Memuat soal...</p>
                                </div>
                                
                                <!-- Questions List -->
                                <div class="space-y-3 max-h-[500px] overflow-y-auto pr-2" id="questionsList"></div>
                                
                                <!-- Empty State -->
                                <div id="emptyState" class="hidden text-center py-12">
                                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-500 mb-2" id="emptyStateText">Belum ada soal</p>
                                    <a href="/guru/soal" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <i class="fas fa-plus mr-1"></i>Buat soal baru
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <div class="glass-card rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-green-600" id="statsPG">0</div>
                                <div class="text-sm text-gray-600 mt-1">Pilihan Ganda</div>
                            </div>
                            <div class="glass-card rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-blue-600" id="statsEssay">0</div>
                                <div class="text-sm text-gray-600 mt-1">Essay</div>
                            </div>
                            <div class="glass-card rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-purple-600" id="statsTotal">0</div>
                                <div class="text-sm text-gray-600 mt-1">Total Soal</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Panel Kanan - Pengaturan Ujian -->
                    <div class="space-y-6">
                        <!-- Soal Terpilih -->
                        <div class="glass-card rounded-2xl shadow-sm p-5">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-list-check text-green-500"></i>
                                Soal Terpilih
                            </h3>
                            
                            <div id="selectedQuestionsSection" class="hidden">
                                <div id="selectedQuestionsList" class="space-y-2 mb-4 max-h-[200px] overflow-y-auto p-2"></div>
                                
                                <div class="flex justify-between items-center border-t border-gray-200/50 pt-4">
                                    <div>
                                        <span class="text-sm text-gray-600">Terpilih: </span>
                                        <span id="selectedCount" class="font-bold text-blue-600">0</span>
                                        <span class="text-sm text-gray-600"> soal</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick="selectAllQuestions()" class="px-3 py-1.5 text-sm bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100">
                                            <i class="fas fa-check-double mr-1"></i>Pilih Semua
                                        </button>
                                        <button onclick="clearExamConfig()" class="px-3 py-1.5 text-sm text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="noConfigSection" class="text-center py-8">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-plus text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-600 mb-2">Belum ada soal terpilih</p>
                                <p class="text-sm text-gray-500">Pilih soal dari daftar di sebelah</p>
                            </div>
                        </div>
                        
                        <!-- Pengaturan Ujian -->
                        <div id="examConfigSection" class="hidden">
                            <div class="glass-card rounded-2xl shadow-sm p-5 space-y-5">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
                                    <i class="fas fa-cogs text-purple-500"></i>
                                    Pengaturan Ujian
                                </h3>
                                
                                <!-- Basic Settings -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ujian</label>
                                        <input type="text" id="examName" placeholder="Contoh: UTS Matematika" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                                            <select id="examSubject" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" onchange="updateExamName()">
                                                <option value="">Pilih...</option>
                                                @foreach($mataPelajaran ?? [] as $mapel)
                                                <option value="{{ $mapel->id }}" data-nama="{{ $mapel->nama_mapel }}">{{ $mapel->nama_mapel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (menit)</label>
                                            <input type="number" id="examDuration" min="10" max="300" value="90" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Score Settings -->
                                <div class="pt-4 border-t border-gray-200/50">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                        <i class="fas fa-star text-yellow-500"></i>
                                        Pengaturan Nilai
                                    </h4>
                                    
                                    <div class="grid grid-cols-2 gap-4 mb-3">
                                        <div>
                                            <label class="block text-xs text-gray-600 mb-1">Nilai Total</label>
                                            <input type="number" id="examTotalScore" min="10" max="1000" value="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" oninput="calculateScorePerQuestion()">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-600 mb-1">Nilai Per Soal</label>
                                            <div class="p-3 bg-gray-50 border rounded-lg text-center">
                                                <span id="scorePerQuestion" class="font-bold text-lg text-blue-600">0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Actions -->
                                <div class="pt-4 border-t border-gray-200/50">
                                    <div class="flex gap-3">
                                        <button onclick="saveExamConfig()" class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                            <i class="fas fa-save mr-2"></i>Simpan
                                        </button>
                                        <button onclick="previewExam()" class="px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Exams -->
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-history text-indigo-500"></i>
                        Ujian Terbaru
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="recentExams"></div>
                </div>
            </main>

            <!-- Footer Minimal -->
            <footer class="bg-white/80 backdrop-blur-sm border-t border-gray-200/50 px-6 py-3">
                <p class="text-sm text-gray-600 text-center">
                    &copy; 2024 ExamPro • Sistem Pengaturan Soal Ujian
                </p>
            </footer>
        </div>
    </div>

    <!-- Modals -->
    <div id="questionDetailModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Detail Soal</h3>
                    <button onclick="hideQuestionDetail()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                <div id="questionDetailContent"></div>
                <div class="flex gap-3 pt-6 border-t mt-6">
                    <button onclick="addToExamFromDetail()" class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium py-3 px-6 rounded-lg hover:shadow-md">
                        <i class="fas fa-plus mr-2"></i>Tambah ke Ujian
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="logoutModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-sm w-full">
            <div class="p-6 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-sign-out-alt text-2xl text-red-500"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Logout</h3>
                <p class="text-gray-600 mb-6">Anda yakin ingin keluar?</p>
                <div class="flex gap-3">
                    <button onclick="hideLogoutConfirm()" class="flex-1 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button onclick="performLogout()" class="flex-1 py-3 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let allQuestions = @json($soals ?? []);
        let currentDisplayQuestions = [];
        let selectedQuestions = new Set();
        let selectedQuestionsPerSubject = {};
        let recentExams = @json($ujians ?? []);
        let mataPelajaran = @json($mataPelajaran ?? []);
        let currentQuestionId = null;
        let currentSubjectId = null;

        function initializeData() {
            currentDisplayQuestions = [];
            updateUI();
        }

        function updateUI() {
            renderQuestions();
            renderSelectedQuestions();
            renderRecentExams();
            updateStats();
        }

        function renderQuestions() {
            const container = document.getElementById('questionsList');
            const emptyState = document.getElementById('emptyState');
            
            if (currentDisplayQuestions.length === 0) {
                container.innerHTML = '';
                const emptyStateText = document.getElementById('emptyStateText');
                if (currentSubjectId) {
                    const mapelName = mataPelajaran.find(m => m.id == currentSubjectId)?.nama_mapel;
                    emptyStateText.innerHTML = `Belum ada soal untuk mata pelajaran <strong>${mapelName || ''}</strong><br>Silakan buat soal terlebih dahulu`;
                } else {
                    emptyStateText.innerHTML = 'Pilih materi terlebih dahulu untuk melihat soal';
                }
                emptyState.classList.remove('hidden');
                document.getElementById('questionCount').textContent = '0 soal';
                return;
            }
            
            emptyState.classList.add('hidden');
            let html = '';
            currentDisplayQuestions.forEach(q => {
                const isSelected = selectedQuestions.has(q.id);
                const bgColor = isSelected ? 'bg-blue-50/80 border-blue-200' : 'bg-white/50 border-gray-200/50';
                const textColor = isSelected ? 'text-blue-700' : 'text-gray-800';
                const mapelName = mataPelajaran.find(m => m.id == q.mapel_id)?.nama_mapel || q.subject || '-';
                
                html += `<div class="question-card p-4 border rounded-xl cursor-pointer ${bgColor} ${textColor} ${isSelected ? 'selected-question' : ''}" 
                         onclick="toggleQuestionSelection(${q.id})" 
                         oncontextmenu="showQuestionDetail(${q.id});return false;">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="font-medium truncate">${q.title || 'Soal ' + q.id}</span>
                                <span class="badge ${q.tipe === 'pilihan_ganda' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700'}">
                                    ${q.tipe === 'pilihan_ganda' ? 'PG' : 'Essay'}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 line-clamp-2">${((q.pertanyaan || q.question || 'Soal tanpa pertanyaan') + '').substring(0, 100)}${((q.pertanyaan || q.question || '') + '').length > 100 ? '...' : ''}</p>
                            <div class="flex items-center gap-3 mt-3 text-xs">
                                <span class="text-gray-500"><i class="fas fa-book mr-1"></i>${mapelName}</span>
                            </div>
                        </div>
                        ${isSelected ? 
                            `<div class="ml-3">
                                <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-xs"></i>
                                </div>
                            </div>` : ''
                        }
                    </div>
                </div>`;
            });
            container.innerHTML = html;
            document.getElementById('questionCount').textContent = `${currentDisplayQuestions.length} soal`;
        }

        function renderSelectedQuestions() {
            const section = document.getElementById('selectedQuestionsSection');
            const noConfig = document.getElementById('noConfigSection');
            const examConfig = document.getElementById('examConfigSection');
            const container = document.getElementById('selectedQuestionsList');
            
            if (selectedQuestions.size === 0) {
                section.classList.add('hidden');
                noConfig.classList.remove('hidden');
                examConfig.classList.add('hidden');
                return;
            }
            
            section.classList.remove('hidden');
            noConfig.classList.add('hidden');
            examConfig.classList.remove('hidden');
            
            let html = '';
            selectedQuestions.forEach(id => {
                const q = allQuestions.find(q => q.id === id);
                if (q) {
                    const mapelName = mataPelajaran.find(m => m.id == q.mapel_id)?.nama_mapel || q.subject || '-';
                    const tipeText = q.tipe === 'pilihan_ganda' ? 'PG' : 'Essay';
                    const title = `${mapelName} - ${tipeText}`;
                    html += `<div class="flex items-center justify-between p-2 bg-blue-50 rounded-lg">
                        <span class="text-sm text-gray-700 truncate flex-1">${title}</span>
                        <button onclick="toggleQuestionSelection(${q.id})" class="text-red-500 hover:text-red-700 ml-2">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>`;
                }
            });
            
            container.innerHTML = html;
            document.getElementById('selectedCount').textContent = selectedQuestions.size;
            calculateScorePerQuestion();
        }

        function renderRecentExams() {
            const container = document.getElementById('recentExams');
            if (!recentExams || recentExams.length === 0) {
                container.innerHTML = '<div class="col-span-3 text-center py-8"><p class="text-gray-500">Belum ada ujian yang dibuat</p></div>';
                return;
            }
            
            let html = '';
            recentExams.slice(0, 3).forEach(exam => {
                html += `<div class="glass-card rounded-xl p-4">
                    <h4 class="font-semibold text-gray-800 mb-2">${exam.nama_ujian || exam.name}</h4>
                    <div class="space-y-1 text-sm text-gray-600">
                        <p><i class="fas fa-book mr-2"></i>${exam.mapel?.nama_mapel || exam.subject || '-'}</p>
                        <p><i class="fas fa-clock mr-2"></i>${exam.durasi || exam.duration || 0} menit</p>
                    </div>
                    <span class="inline-block mt-3 px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">Aktif</span>
                </div>`;
            });
            container.innerHTML = html;
        }

        function updateStats() {
            const pgCount = currentDisplayQuestions.filter(q => q.tipe === 'pilihan_ganda').length;
            const essayCount = currentDisplayQuestions.filter(q => q.tipe === 'essay').length;
            
            document.getElementById('statsPG').textContent = pgCount;
            document.getElementById('statsEssay').textContent = essayCount;
            document.getElementById('statsTotal').textContent = currentDisplayQuestions.length;
            document.getElementById('totalQuestions').textContent = allQuestions.length;
            document.getElementById('activeExams').textContent = recentExams.filter(e => e.status === 'active').length;
        }

        function updateExamName() {
            const examSubjectSelect = document.getElementById('examSubject');
            const selectedOption = examSubjectSelect.options[examSubjectSelect.selectedIndex];
            const mapelName = selectedOption.getAttribute('data-nama');
            
            if (mapelName) {
                const examNameInput = document.getElementById('examName');
                examNameInput.value = `Ujian ${mapelName}`;
            }
        }

        function filterBySubject() {
            const subjectFilterVal = document.getElementById('subjectFilter').value;
            const loadingIndicator = document.getElementById('loadingIndicator');
            const questionsList = document.getElementById('questionsList');
            
            if (!subjectFilterVal) {
                currentDisplayQuestions = [];
                currentSubjectId = null;
                updateUI();
                return;
            }
            
            loadingIndicator.classList.remove('hidden');
            questionsList.classList.add('hidden');
            currentSubjectId = parseInt(subjectFilterVal);
            
            setTimeout(() => {
                currentDisplayQuestions = allQuestions.filter(q => q.mapel_id == subjectFilterVal);
                
                if (selectedQuestionsPerSubject[currentSubjectId]) {
                    selectedQuestions.clear();
                    selectedQuestionsPerSubject[currentSubjectId].forEach(id => selectedQuestions.add(id));
                } else {
                    selectedQuestions.clear();
                }
                
                updateUI();
                loadingIndicator.classList.add('hidden');
                questionsList.classList.remove('hidden');
                document.getElementById('typeFilter').value = '';
                document.getElementById('searchInput').value = '';
                
                if (currentDisplayQuestions.length === 0) {
                    const mapelName = mataPelajaran.find(m => m.id == currentSubjectId)?.nama_mapel;
                    showMessage(`Belum ada soal untuk mata pelajaran "${mapelName}". Silakan buat soal terlebih dahulu.`, 'info');
                }
            }, 300);
        }

        function filterQuestions() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const typeFilterVal = document.getElementById('typeFilter').value;
            
            if (currentDisplayQuestions.length === 0) return; // Skip jika belum pilih mapel
            
            // Filter real-time dari currentDisplayQuestions (tampilkan soal hanya saat ada search)
            let filteredQuestions = [];
            if (search) {
                filteredQuestions = currentDisplayQuestions.filter(q => {
                    const questionText = (q.pertanyaan || q.question || q.title || q.nomor || '').toLowerCase();
                    const mapelText = mataPelajaran.find(m => m.id == q.mapel_id)?.nama_mapel?.toLowerCase() || '';
                    return (questionText.includes(search) || mapelText.includes(search)) && (!typeFilterVal || q.tipe === typeFilterVal);
                });
            } else {
                // Jika kosong, kosongkan tampilan (desain awal)
                filteredQuestions = [];
            }
            
            const container = document.getElementById('questionsList');
            const emptyState = document.getElementById('emptyState');
            
            // Update count
            document.getElementById('questionCount').textContent = `${filteredQuestions.length} soal`;
            
            if (filteredQuestions.length === 0) {
                if (search) {
                    container.innerHTML = '';
                    emptyState.classList.remove('hidden');
                    document.getElementById('emptyStateText').textContent = 'Tidak ada soal yang ditemukan';
                } else {
                    container.innerHTML = '';
                    emptyState.classList.remove('hidden');
                    document.getElementById('emptyStateText').textContent = 'Cari soal dengan mengetik di atas...';
                }
                return;
            }
            
            emptyState.classList.add('hidden');
            let html = '';
            filteredQuestions.forEach(q => {
                const isSelected = selectedQuestions.has(q.id);
                const bgColor = isSelected ? 'bg-blue-50/80 border-blue-200' : 'bg-white/50 border-gray-200/50';
                const textColor = isSelected ? 'text-blue-700' : 'text-gray-800';
                const mapelName = mataPelajaran.find(m => m.id == q.mapel_id)?.nama_mapel || q.subject || '-';
                
                html += `<div class="question-card p-4 border rounded-xl cursor-pointer ${bgColor} ${textColor} ${isSelected ? 'selected-question' : ''}" 
                         onclick="toggleQuestionSelection(${q.id})" 
                         oncontextmenu="showQuestionDetail(${q.id});return false;">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="font-medium truncate">${q.title || 'Soal ' + q.id}</span>
                                <span class="badge ${q.tipe === 'pilihan_ganda' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700'}">
                                    ${q.tipe === 'pilihan_ganda' ? 'PG' : 'Essay'}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 line-clamp-2">${((q.pertanyaan || q.question || 'Soal tanpa pertanyaan') + '').substring(0, 100)}${((q.pertanyaan || q.question || '') + '').length > 100 ? '...' : ''}</p>
                            <div class="flex items-center gap-3 mt-3 text-xs">
                                <span class="text-gray-500"><i class="fas fa-book mr-1"></i>${mapelName}</span>
                            </div>
                        </div>

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('typeFilter').value = '';
            document.getElementById('subjectFilter').value = '';
            currentDisplayQuestions = [];
            currentSubjectId = null;
            selectedQuestions.clear();
            updateUI();
        }

        function selectAllQuestions() {
            currentDisplayQuestions.forEach(q => selectedQuestions.add(q.id));
            if (currentSubjectId) {
                selectedQuestionsPerSubject[currentSubjectId] = Array.from(selectedQuestions);
            }
            renderQuestions();
            renderSelectedQuestions();
        }

        function clearExamConfig() {
            selectedQuestions.clear();
            if (currentSubjectId) {
                delete selectedQuestionsPerSubject[currentSubjectId];
            }
            renderQuestions();
            renderSelectedQuestions();
        }

        function toggleQuestionSelection(id) {
            if (selectedQuestions.has(id)) {
                selectedQuestions.delete(id);
            } else {
                selectedQuestions.add(id);
            }
            if (currentSubjectId) {
                selectedQuestionsPerSubject[currentSubjectId] = Array.from(selectedQuestions);
            }
            renderQuestions();
            renderSelectedQuestions();
        }

        function calculateScorePerQuestion() {
            const total = parseInt(document.getElementById('examTotalScore').value) || 100;
            const count = selectedQuestions.size || 1;
            document.getElementById('scorePerQuestion').textContent = (total / count).toFixed(2);
        }

        function saveExamConfig() {
            const examName = document.getElementById('examName').value;
            const examSubject = document.getElementById('examSubject').value;
            const examDuration = document.getElementById('examDuration').value;

            if (!examName || !examSubject || selectedQuestions.size === 0) {
                showMessage('Mohon lengkapi semua data: Nama Ujian, Mata Pelajaran, dan pilih minimal 1 soal', 'error');
                return;
            }

            const btn = event.target;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';

            fetch('/guru/ujian/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    nama_ujian: examName,
                    mapel_id: examSubject,
                    durasi: examDuration,
                    soal_ids: Array.from(selectedQuestions)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('✓ Ujian berhasil disimpan dan sudah tersedia di Dashboard Murid!', 'success');
                    setTimeout(() => location.reload(), 2000);
                } else {
                    showMessage('Gagal menyimpan ujian: ' + (data.message || 'Terjadi kesalahan'), 'error');
                }
            })
            .catch(error => {
                showMessage('Terjadi kesalahan: ' + error.message, 'error');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan';
            });
        }

        function showMessage(message, type) {
            const container = document.getElementById('messageContainer');
            let bgColor, icon;
            
            if (type === 'success') {
                bgColor = 'bg-green-50 border-green-500 text-green-800';
                icon = 'fa-check-circle';
            } else if (type === 'error') {
                bgColor = 'bg-red-50 border-red-500 text-red-800';
                icon = 'fa-exclamation-circle';
            } else {
                bgColor = 'bg-blue-50 border-blue-500 text-blue-800';
                icon = 'fa-info-circle';
            }
            
            container.innerHTML = `
                <div class="${bgColor} border-l-4 p-4 mb-6 rounded-r-lg">
                    <div class="flex items-center gap-3">
                        <i class="fas ${icon} text-xl"></i>
                        <p class="font-medium">${message}</p>
                    </div>
                </div>
            `;
            
            setTimeout(() => {
                container.innerHTML = '';
            }, 5000);
        }

        function previewExam() {
            if (selectedQuestions.size === 0) {
                showMessage('Pilih soal terlebih dahulu untuk preview', 'error');
                return;
            }
            alert('Fitur preview ujian akan segera tersedia');
        }

        function showQuestionDetail(id) {
            currentQuestionId = id;
            const q = allQuestions.find(q => q.id === id);
            if (q) {
                const content = document.getElementById('questionDetailContent');
                content.innerHTML = `
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Judul:</label>
                            <p class="mt-1 p-3 bg-gray-50 rounded-lg">${q.title || 'Soal ' + q.id}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Pertanyaan:</label>
                            <p class="mt-1 p-3 bg-gray-50 rounded-lg">${q.pertanyaan || q.question || '-'}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Tipe:</label>
                            <p class="mt-1 p-3 bg-gray-50 rounded-lg">${q.tipe === 'pilihan_ganda' ? 'Pilihan Ganda' : 'Essay'}</p>
                        </div>
                    </div>
                `;
            }
            document.getElementById('questionDetailModal').classList.remove('hidden');
        }

        function hideQuestionDetail() {
            document.getElementById('questionDetailModal').classList.add('hidden');
        }

        function addToExamFromDetail() {
            if (currentQuestionId) {
                selectedQuestions.add(currentQuestionId);
                if (currentSubjectId) {
                    selectedQuestionsPerSubject[currentSubjectId] = Array.from(selectedQuestions);
                }
                renderQuestions();
                renderSelectedQuestions();
                hideQuestionDetail();
            }
        }

        function showLogoutConfirm() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function hideLogoutConfirm() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        function performLogout() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/logout';
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = document.querySelector('meta[name="csrf-token"]').content;
            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeData();
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    hideQuestionDetail();
                    hideLogoutConfirm();
                }
            });
        });
    </script>
</body>
</html>