<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Ujian Real-time | Dashboard Guru</title>
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
                    <a href="/guru/dashboard" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-home"></i><span>Dashboard</span>
                    </a>
                    <a href="/guru/soal" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-question-circle"></i><span>Kelola Soal</span>
                    </a>
                    <a href="/examp" class="flex items-center gap-3 p-3 active-menu rounded-lg">
                        <i class="fas fa-file-alt"></i><span>Buat Ujian</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-chart-bar"></i><span>Analisis Nilai</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-users"></i><span>Kelola Kelas</span>
                    </a>
                    <div class="pt-4 border-t border-white/10">
                        <form method="POST" action="/logout">
                            <button type="submit" class="w-full flex items-center gap-3 p-3 text-red-300 hover:bg-white/10 rounded-lg transition">
                                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                            </button>
                        </form>
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
                            <h1 class="text-2xl font-bold text-gray-800">Monitoring Ujian Real-time</h1>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Senin, 27 Januari 2025
                            </p>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-100">
                                <i class="fas fa-bell"></i>
                                <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6 border">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                <div>
                    <h1 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-chalkboard-teacher text-blue-500 mr-2"></i>
                        Monitoring Ujian
                    </h1>
                    <p class="text-sm text-gray-600">Matematika Kelas 10 - 30 menit</p>
                </div>
                
                <div class="flex items-center gap-2">
                    <div class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded">
                        <i class="fas fa-users mr-1"></i>
                        <span id="totalStudents">8</span> Peserta
                    </div>
                    <button onclick="refreshData()" class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600">
                        <i class="fas fa-sync-alt mr-1"></i>Refresh
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <!-- Stats Cards -->
            <div class="lg:col-span-1 space-y-4">
                <!-- Stats Summary -->
                <div class="bg-white rounded-lg shadow-sm p-4 border">
                    <h2 class="font-medium text-gray-700 mb-3">Statistik</h2>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-600">Sedang Ujian</span>
                            </div>
                            <span class="font-semibold" id="activeStudents">6</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-600">Selesai</span>
                            </div>
                            <span class="font-semibold" id="submittedStudents">2</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-gray-400 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-600">Belum Mulai</span>
                            </div>
                            <span class="font-semibold" id="absentStudents">0</span>
                        </div>
                    </div>
                </div>

                <!-- Timer -->
                <div class="bg-white rounded-lg shadow-sm p-4 border">
                    <h2 class="font-medium text-gray-700 mb-2">Waktu Ujian</h2>
                    <div class="text-center mb-2">
                        <div class="text-2xl font-bold text-gray-800" id="examTimer">29:45</div>
                        <div class="text-xs text-gray-500">Sisa waktu</div>
                    </div>
                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div id="examProgress" class="h-full bg-blue-500 rounded-full w-45%"></div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm p-4 border">
                    <h2 class="font-medium text-gray-700 mb-3">Kontrol</h2>
                    <div class="space-y-2">
                        <button onclick="pauseAllExams()" class="w-full text-left px-3 py-2 bg-yellow-50 text-yellow-700 rounded border border-yellow-200 hover:bg-yellow-100 text-sm">
                            <i class="fas fa-pause mr-2"></i>Jeda Semua
                        </button>
                        <button onclick="endExam()" class="w-full text-left px-3 py-2 bg-red-50 text-red-700 rounded border border-red-200 hover:bg-red-100 text-sm">
                            <i class="fas fa-stop mr-2"></i>Akhiri Ujian
                        </button>
                        <button onclick="downloadReport()" class="w-full text-left px-3 py-2 bg-blue-50 text-blue-700 rounded border border-blue-200 hover:bg-blue-100 text-sm">
                            <i class="fas fa-download mr-2"></i>Unduh Laporan
                        </button>
                    </div>
                </div>

                <!-- Top 3 -->
                <div class="bg-white rounded-lg shadow-sm p-4 border">
                    <h2 class="font-medium text-gray-700 mb-3">Top 3</h2>
                    <div id="topPerformers" class="space-y-2">
                        <!-- Data akan diisi JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Students List -->
            <div class="lg:col-span-3">
                <!-- Search & Filter -->
                <div class="bg-white rounded-lg shadow-sm p-4 mb-4 border">
                    <div class="flex flex-col md:flex-row gap-3">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchStudent" placeholder="Cari siswa..." 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <select id="filterStatus" class="border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="all">Semua Status</option>
                            <option value="active">Sedang Ujian</option>
                            <option value="submitted">Selesai</option>
                            <option value="not_started">Belum Mulai</option>
                        </select>
                    </div>
                </div>

                <!-- Students Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="studentsGrid">
                    <!-- Data akan diisi JavaScript -->
                </div>
            </div>
        </div>

        <!-- Detail Modal -->
        <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-lg w-full max-w-2xl">
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="font-semibold text-gray-800" id="detailTitle">Detail Peserta</h3>
                        <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="p-4 max-h-96 overflow-y-auto" id="detailContent">
                        <!-- Detail akan diisi JavaScript -->
                    </div>
                    
                    <div class="p-4 border-t flex justify-end gap-2">
                        <button onclick="closeDetailModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                            Tutup
                        </button>
                        <button onclick="viewAnswers(0)" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            <i class="fas fa-eye mr-1"></i>Lihat Jawaban
                        </button>
                    </div>
                </div>
            </div>
        </div>
            </main>
        </div>
    </div>

    <script>
        // Data (tetap sama dengan sebelumnya)
        const examData = {
            exam: {
                id: 1,
                name: "Matematika Kelas 10",
                duration: 1800,
                start_time: "2025-01-26 08:00:00",
                end_time: "2025-01-26 08:30:00",
                total_questions: 20
            },
            students: [
                {
                    id: 2,
                    nama: "Budi",
                    email: "budi@gmail.com",
                    status: "active",
                    progress: 65,
                    time_left: 845,
                    score: 75,
                    questions_answered: 13,
                    last_activity: "2 menit lalu",
                    ip_address: "192.168.1.101"
                },
                {
                    id: 3,
                    nama: "Dani",
                    email: "dani@gmail.com",
                    status: "active",
                    progress: 45,
                    time_left: 920,
                    score: 60,
                    questions_answered: 9,
                    last_activity: "1 menit lalu",
                    ip_address: "192.168.1.102"
                },
                {
                    id: 4,
                    nama: "Siti",
                    email: "siti@gmail.com",
                    status: "submitted",
                    progress: 100,
                    time_left: 0,
                    score: 85,
                    questions_answered: 20,
                    last_activity: "5 menit lalu",
                    submitted_at: "2025-01-26 08:25:00"
                },
                {
                    id: 5,
                    nama: "Ahmad",
                    email: "ahmad@gmail.com",
                    status: "active",
                    progress: 30,
                    time_left: 1250,
                    score: 45,
                    questions_answered: 6,
                    last_activity: "Sekarang",
                    ip_address: "192.168.1.103"
                },
                {
                    id: 6,
                    nama: "Rina",
                    email: "rina@gmail.com",
                    status: "not_started",
                    progress: 0,
                    time_left: 1800,
                    score: 0,
                    questions_answered: 0,
                    last_activity: "Belum mulai"
                },
                {
                    id: 7,
                    nama: "Joko",
                    email: "joko@gmail.com",
                    status: "active",
                    progress: 80,
                    time_left: 360,
                    score: 90,
                    questions_answered: 16,
                    last_activity: "30 detik lalu",
                    ip_address: "192.168.1.104"
                },
                {
                    id: 8,
                    nama: "Maya",
                    email: "maya@gmail.com",
                    status: "submitted",
                    progress: 100,
                    time_left: 0,
                    score: 95,
                    questions_answered: 20,
                    last_activity: "10 menit lalu",
                    submitted_at: "2025-01-26 08:20:00"
                },
                {
                    id: 9,
                    nama: "Rudi",
                    email: "rudi@gmail.com",
                    status: "active",
                    progress: 50,
                    time_left: 900,
                    score: 65,
                    questions_answered: 10,
                    last_activity: "3 menit lalu",
                    ip_address: "192.168.1.105"
                }
            ]
        };

        // State
        let state = {
            filteredStudents: [...examData.students],
            searchTerm: '',
            filterStatus: 'all',
            examTimer: examData.exam.duration,
            examTimerInterval: null
        };

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderAll();
            startExamTimer();
        });

        // Render all components
        function renderAll() {
            updateStats();
            renderStudents();
            renderTopPerformers();
        }

        // Update statistics
        function updateStats() {
            const total = examData.students.length;
            const active = examData.students.filter(s => s.status === 'active').length;
            const submitted = examData.students.filter(s => s.status === 'submitted').length;
            const absent = examData.students.filter(s => s.status === 'not_started').length;
            
            document.getElementById('totalStudents').textContent = total;
            document.getElementById('activeStudents').textContent = active;
            document.getElementById('submittedStudents').textContent = submitted;
            document.getElementById('absentStudents').textContent = absent;
            
            const avgProgress = examData.students.reduce((sum, s) => sum + s.progress, 0) / total;
            document.getElementById('examProgress').style.width = avgProgress + '%';
        }

        // Render students list
        function renderStudents() {
            const container = document.getElementById('studentsGrid');
            container.innerHTML = '';
            
            state.filteredStudents.forEach(student => {
                const card = document.createElement('div');
                card.className = 'bg-white rounded-lg border hover:border-blue-300 cursor-pointer';
                card.onclick = () => showStudentDetail(student.id);
                
                // Status color
                let statusColor = '';
                switch(student.status) {
                    case 'active': statusColor = 'bg-green-100 text-green-800'; break;
                    case 'submitted': statusColor = 'bg-blue-100 text-blue-800'; break;
                    case 'not_started': statusColor = 'bg-gray-100 text-gray-800'; break;
                }
                
                card.innerHTML = `
                    <div class="p-3">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <div class="font-medium text-gray-800">${student.nama}</div>
                                <div class="text-xs text-gray-500 truncate">${student.email}</div>
                            </div>
                            <span class="px-2 py-1 ${statusColor} rounded text-xs">
                                ${student.status === 'active' ? 'Ujian' : student.status === 'submitted' ? 'Selesai' : 'Belum'}
                            </span>
                        </div>
                        
                        <div class="mb-2">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>${student.progress}%</span>
                            </div>
                            <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full" style="width: ${student.progress}%"></div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-1 text-xs">
                            <div class="text-center p-1 bg-gray-50 rounded">
                                <div class="font-semibold">${student.score}</div>
                                <div class="text-gray-500">Skor</div>
                            </div>
                            <div class="text-center p-1 bg-gray-50 rounded">
                                <div class="font-semibold">${student.questions_answered}</div>
                                <div class="text-gray-500">Soal</div>
                            </div>
                            <div class="text-center p-1 bg-gray-50 rounded">
                                <div class="font-semibold">${formatTime(student.time_left)}</div>
                                <div class="text-gray-500">Sisa</div>
                            </div>
                        </div>
                    </div>
                `;
                
                container.appendChild(card);
            });
        }

        // Render top performers
        function renderTopPerformers() {
            const container = document.getElementById('topPerformers');
            const topStudents = [...examData.students]
                .filter(s => s.status === 'submitted')
                .sort((a, b) => b.score - a.score)
                .slice(0, 3);
            
            container.innerHTML = '';
            
            topStudents.forEach((student, index) => {
                const item = document.createElement('div');
                item.className = 'flex items-center justify-between p-2 hover:bg-gray-50 rounded';
                item.innerHTML = `
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 flex items-center justify-center bg-blue-100 text-blue-700 rounded-full text-xs">
                            ${index + 1}
                        </span>
                        <div>
                            <div class="font-medium text-sm">${student.nama}</div>
                            <div class="text-xs text-gray-500">${student.score} poin</div>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500">
                        ${student.questions_answered} soal
                    </div>
                `;
                container.appendChild(item);
            });
        }

        // Format time
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }

        // Start exam timer
        function startExamTimer() {
            clearInterval(state.examTimerInterval);
            state.examTimerInterval = setInterval(() => {
                if (state.examTimer > 0) {
                    state.examTimer--;
                    document.getElementById('examTimer').textContent = formatTime(state.examTimer);
                }
            }, 1000);
        }

        // Show student detail
        function showStudentDetail(studentId) {
            const student = examData.students.find(s => s.id === studentId);
            if (!student) return;
            
            document.getElementById('detailTitle').textContent = `Detail: ${student.nama}`;
            
            let detailHTML = `
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="text-sm text-gray-500">Nama</div>
                            <div class="font-medium">${student.nama}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Email</div>
                            <div class="font-medium">${student.email}</div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-3 bg-gray-50 rounded">
                            <div class="text-2xl font-bold ${student.score >= 70 ? 'text-green-600' : student.score >= 50 ? 'text-yellow-600' : 'text-red-600'}">
                                ${student.score}
                            </div>
                            <div class="text-sm text-gray-600">Skor</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded">
                            <div class="text-2xl font-bold text-blue-600">${student.progress}%</div>
                            <div class="text-sm text-gray-600">Progress</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded">
                            <div class="text-2xl font-bold text-purple-600">${student.questions_answered}</div>
                            <div class="text-sm text-gray-600">Soal</div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="text-sm text-gray-500 mb-1">Status</div>
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm ${
                            student.status === 'active' ? 'bg-green-100 text-green-800' :
                            student.status === 'submitted' ? 'bg-blue-100 text-blue-800' :
                            'bg-gray-100 text-gray-800'
                        }">
                            <i class="fas fa-circle text-xs mr-2 ${
                                student.status === 'active' ? 'text-green-500' :
                                student.status === 'submitted' ? 'text-blue-500' :
                                'text-gray-400'
                            }"></i>
                            ${student.status === 'active' ? 'Sedang Ujian' : 
                              student.status === 'submitted' ? 'Selesai' : 'Belum Mulai'}
                        </div>
                    </div>
                    
                    ${student.status === 'active' ? `
                        <div class="p-3 ${student.time_left <= 300 ? 'bg-red-50 border border-red-200' : 'bg-blue-50 border border-blue-200'} rounded">
                            <div class="text-sm text-gray-500">Sisa Waktu</div>
                            <div class="text-xl font-bold ${student.time_left <= 300 ? 'text-red-600' : 'text-blue-700'}">
                                ${formatTime(student.time_left)}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-desktop mr-1"></i>${student.ip_address}
                            </div>
                        </div>
                    ` : ''}
                    
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-clock mr-1"></i>Aktifitas terakhir: ${student.last_activity}
                    </div>
                </div>
            `;
            
            document.getElementById('detailContent').innerHTML = detailHTML;
            document.getElementById('detailModal').classList.remove('hidden');
        }

        // Close detail modal
        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Search and filter
        document.getElementById('searchStudent').addEventListener('input', function(e) {
            state.searchTerm = e.target.value.toLowerCase();
            filterStudents();
        });

        document.getElementById('filterStatus').addEventListener('change', function(e) {
            state.filterStatus = e.target.value;
            filterStudents();
        });

        function filterStudents() {
            let filtered = [...examData.students];
            
            if (state.searchTerm) {
                filtered = filtered.filter(student => 
                    student.nama.toLowerCase().includes(state.searchTerm) ||
                    student.email.toLowerCase().includes(state.searchTerm)
                );
            }
            
            if (state.filterStatus !== 'all') {
                filtered = filtered.filter(student => student.status === state.filterStatus);
            }
            
            state.filteredStudents = filtered;
            renderStudents();
        }

        // Control functions
        function refreshData() {
            // In real app, fetch from API
            renderAll();
        }

        function pauseAllExams() {
            if (confirm('Jeda ujian untuk semua siswa?')) {
                alert('Ujian dijeda');
                // API call here
            }
        }

        function endExam() {
            if (confirm('Akhiri ujian untuk semua siswa?')) {
                alert('Ujian diakhiri');
                // API call here
            }
        }

        function downloadReport() {
            alert('Laporan sedang diunduh...');
            // API call here
        }

        function viewAnswers(studentId) {
            alert('Melihat jawaban siswa');
            closeDetailModal();
        }

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailModal();
            }
        });
    </script>
</body>
</html>