<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ujian Game Edukasi - Monitoring Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .progress-bar {
            transition: width 0.5s ease-in-out;
        }
        .student-card {
            transition: all 0.3s ease;
        }
        .student-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .status-online {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .timer-critical {
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%, 100% { background-color: #fef2f2; }
            50% { background-color: #fee2e2; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen p-4 md:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        <i class="fas fa-chalkboard-teacher text-blue-600 mr-3"></i>
                        Monitoring Ujian - Dashboard Guru
                    </h1>
                    <p class="text-gray-600">Pantau peserta ujian secara real-time</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-3">
                        <span class="text-sm text-gray-600">Ujian Aktif:</span>
                        <span class="ml-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            <i class="fas fa-play-circle mr-1"></i> Matematika Kelas 10
                        </span>
                    </div>
                    <button onclick="refreshData()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Stats & Controls -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Exam Overview Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-bar text-blue-600"></i>
                        Ringkasan Ujian
                    </h2>

                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="text-center p-3 bg-blue-50 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600" id="totalStudents">8</div>
                                <div class="text-sm text-gray-600">Total Peserta</div>
                            </div>
                            
                            <div class="text-center p-3 bg-green-50 rounded-lg">
                                <div class="text-2xl font-bold text-green-600" id="activeStudents">6</div>
                                <div class="text-sm text-gray-600">Sedang Ujian</div>
                            </div>
                            
                            <div class="text-center p-3 bg-purple-50 rounded-lg">
                                <div class="text-2xl font-bold text-purple-600" id="submittedStudents">2</div>
                                <div class="text-sm text-gray-600">Selesai</div>
                            </div>
                            
                            <div class="text-center p-3 bg-red-50 rounded-lg">
                                <div class="text-2xl font-bold text-red-600" id="absentStudents">0</div>
                                <div class="text-sm text-gray-600">Tidak Hadir</div>
                            </div>
                        </div>

                        <!-- Exam Timer -->
                        <div class="pt-4 border-t">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-medium text-gray-700">Waktu Ujian</span>
                                <span class="text-sm text-gray-500" id="examTimer">29:45</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div id="examProgress" class="h-full bg-gradient-to-r from-blue-500 to-purple-500 rounded-full w-45%"></div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="pt-4 border-t">
                            <h3 class="font-semibold text-gray-700 mb-3">Kontrol Ujian</h3>
                            <div class="grid grid-cols-2 gap-2">
                                <button onclick="pauseAllExams()" class="p-2 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 border border-yellow-300 rounded-lg">
                                    <i class="fas fa-pause mr-1"></i>Jeda Semua
                                </button>
                                <button onclick="extendTime()" class="p-2 bg-green-100 text-green-700 hover:bg-green-200 border border-green-300 rounded-lg">
                                    <i class="fas fa-clock mr-1"></i>Tambah Waktu
                                </button>
                                <button onclick="endExam()" class="p-2 bg-red-100 text-red-700 hover:bg-red-200 border border-red-300 rounded-lg">
                                    <i class="fas fa-stop mr-1"></i>Akhiri Ujian
                                </button>
                                <button onclick="downloadReport()" class="p-2 bg-blue-100 text-blue-700 hover:bg-blue-200 border border-blue-300 rounded-lg">
                                    <i class="fas fa-eye mr-1"></i>Lihat Hasil Jawaban
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Performers -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-trophy text-yellow-600"></i>
                        Top Performers
                    </h2>
                    
                    <div id="topPerformers" class="space-y-3">
                        <!-- Data akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Middle Column: Student List -->
            <div class="lg:col-span-2">
                <!-- Filters & Search -->
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Daftar Peserta Ujian</h2>
                            <p class="text-sm text-gray-600">Monitoring real-time semua siswa</p>
                        </div>
                        
                        <div class="flex flex-wrap gap-3">
                            <div class="relative">
                                <input type="text" id="searchStudent" placeholder="Cari siswa..." 
                                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            
                            <select id="filterStatus" class="border border-gray-300 rounded-lg px-3 py-2">
                                <option value="all">Semua Status</option>
                                <option value="active">Sedang Ujian</option>
                                <option value="submitted">Selesai</option>
                                <option value="not_started">Belum Mulai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Students Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="studentsGrid">
                    <!-- Data siswa akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>

        <!-- Detailed View Modal -->
        <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto hidden z-50">
            <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-xl bg-white">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800" id="detailTitle">Detail Peserta</h3>
                    <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div id="detailContent">
                    <!-- Detail konten akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mock data from database structure
        const examData = {
            exam: {
                id: 1,
                name: "Matematika Kelas 10",
                duration: 1800, // 30 minutes
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
            ],
            questions: [
                { id: 1, question: "2 + 2 = ?", correct_answer: "B" },
                { id: 2, question: "Ibukota Indonesia?", correct_answer: "A" }
            ],
            submissions: [
                { student_id: 4, question_id: 1, answer: "B", is_correct: true },
                { student_id: 4, question_id: 2, answer: "A", is_correct: true }
            ]
        };

        // Application State
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
            
            // Calculate average progress
            const avgProgress = examData.students.reduce((sum, s) => sum + s.progress, 0) / total;
            document.getElementById('examProgress').style.width = avgProgress + '%';
        }

        // Render students list
        function renderStudents() {
            const container = document.getElementById('studentsGrid');
            container.innerHTML = '';
            
            state.filteredStudents.forEach(student => {
                const card = document.createElement('div');
                card.className = 'student-card bg-white rounded-xl shadow p-4 cursor-pointer hover:shadow-lg';
                card.onclick = () => showStudentDetail(student.id);
                
                // Status styling
                let statusBadge = '';
                let statusColor = '';
                switch(student.status) {
                    case 'active':
                        statusBadge = 'Sedang Ujian';
                        statusColor = 'bg-green-100 text-green-800';
                        break;
                    case 'submitted':
                        statusBadge = 'Selesai';
                        statusColor = 'bg-blue-100 text-blue-800';
                        break;
                    case 'not_started':
                        statusBadge = 'Belum Mulai';
                        statusColor = 'bg-gray-100 text-gray-800';
                        break;
                }
                
                // Time warning
                const timeClass = student.time_left <= 300 ? 'timer-critical' : '';
                
                card.innerHTML = `
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <div class="font-bold text-gray-800">${student.nama}</div>
                            <div class="text-sm text-gray-500">${student.email}</div>
                        </div>
                        <span class="px-2 py-1 ${statusColor} rounded-full text-xs font-medium">
                            ${statusBadge}
                        </span>
                    </div>
                    
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>${student.progress}%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 rounded-full" 
                                     style="width: ${student.progress}%"></div>
                            </div>
                        </div>
                        
                        ${student.status === 'active' ? `
                            <div class="${timeClass} p-2 rounded-lg">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Sisa Waktu:</span>
                                    <span class="font-medium ${student.time_left <= 300 ? 'text-red-600' : 'text-gray-800'}">
                                        ${formatTime(student.time_left)}
                                    </span>
                                </div>
                            </div>
                        ` : ''}
                        
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="text-center p-2 bg-gray-50 rounded">
                                <div class="font-bold text-gray-800">${student.score}</div>
                                <div class="text-gray-600">Skor</div>
                            </div>
                            <div class="text-center p-2 bg-gray-50 rounded">
                                <div class="font-bold text-gray-800">${student.questions_answered}/${examData.exam.total_questions}</div>
                                <div class="text-gray-600">Soal</div>
                            </div>
                        </div>
                        
                        <div class="text-xs text-gray-500 pt-2 border-t">
                            <i class="fas fa-clock mr-1"></i>Aktifitas: ${student.last_activity}
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
                .slice(0, 5);
            
            container.innerHTML = '';
            
            topStudents.forEach((student, index) => {
                const medal = index === 0 ? '🥇' : index === 1 ? '🥈' : index === 2 ? '🥉' : '🏅';
                
                const item = document.createElement('div');
                item.className = 'flex items-center justify-between p-3 bg-gray-50 hover:bg-gray-100 rounded-lg';
                item.innerHTML = `
                    <div class="flex items-center gap-3">
                        <span class="text-xl">${medal}</span>
                        <div>
                            <div class="font-medium text-gray-800">${student.nama}</div>
                            <div class="text-xs text-gray-500">${student.email}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-green-600">${student.score}</div>
                        <div class="text-xs text-gray-500">poin</div>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        // Format time (seconds to MM:SS)
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }

        // Start exam timer
        function startExamTimer() {
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-bold text-gray-800 mb-3">Informasi Siswa</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nama:</span>
                                    <span class="font-medium">${student.nama}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email:</span>
                                    <span class="font-medium">${student.email}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="px-2 py-1 ${student.status === 'active' ? 'bg-green-100 text-green-800' : student.status === 'submitted' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'} rounded text-sm">
                                        ${student.status === 'active' ? 'Sedang Ujian' : student.status === 'submitted' ? 'Selesai' : 'Belum Mulai'}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-bold text-gray-800 mb-3">Statistik Ujian</h4>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="text-center p-3 bg-white rounded-lg">
                                    <div class="text-2xl font-bold ${student.score >= 70 ? 'text-green-600' : student.score >= 50 ? 'text-yellow-600' : 'text-red-600'}">
                                        ${student.score}
                                    </div>
                                    <div class="text-sm text-gray-600">Skor</div>
                                </div>
                                <div class="text-center p-3 bg-white rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600">${student.progress}%</div>
                                    <div class="text-sm text-gray-600">Progress</div>
                                </div>
                                <div class="text-center p-3 bg-white rounded-lg">
                                    <div class="text-2xl font-bold text-purple-600">${student.questions_answered}</div>
                                    <div class="text-sm text-gray-600">Soal Dijawab</div>
                                </div>
                                <div class="text-center p-3 bg-white rounded-lg">
                                    <div class="text-2xl font-bold text-gray-600">${examData.exam.total_questions - student.questions_answered}</div>
                                    <div class="text-sm text-gray-600">Belum Dijawab</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-bold text-gray-800 mb-3">Progress Detail</h4>
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Progress Pengerjaan</span>
                                    <span>${student.progress}%</span>
                                </div>
                                <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 rounded-full" 
                                         style="width: ${student.progress}%"></div>
                                </div>
                            </div>
            `;
            
            if (student.status === 'active') {
                detailHTML += `
                            <div class="p-3 ${student.time_left <= 300 ? 'bg-red-50 border border-red-200' : 'bg-blue-50 border border-blue-200'} rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="text-sm text-gray-600">Sisa Waktu</div>
                                        <div class="text-xl font-bold ${student.time_left <= 300 ? 'text-red-600' : 'text-blue-700'}">
                                            ${formatTime(student.time_left)}
                                        </div>
                                    </div>
                                    <div class="text-sm">
                                        <div class="text-gray-600">IP Address</div>
                                        <div class="font-medium">${student.ip_address || 'Tidak tersedia'}</div>
                                    </div>
                                </div>
                            </div>
                `;
            }
            
            if (student.status === 'submitted') {
                detailHTML += `
                            <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="text-sm text-gray-600">Waktu Selesai</div>
                                        <div class="font-medium">${student.submitted_at || 'Tidak tersedia'}</div>
                                    </div>
                                    <div class="text-3xl ${student.score >= 70 ? 'text-green-600' : student.score >= 50 ? 'text-yellow-600' : 'text-red-600'}">
                                        ${student.score}
                                    </div>
                                </div>
                            </div>
                `;
            }
            
            detailHTML += `
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-bold text-gray-800 mb-3">Aksi Guru</h4>
                            <div class="grid grid-cols-2 gap-2">
                                ${student.status === 'active' ? `
                                    <button onclick="sendMessage(${student.id})" class="p-2 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-lg">
                                        <i class="fas fa-comment mr-1"></i>Pesan
                                    </button>
                                    <button onclick="extendStudentTime(${student.id})" class="p-2 bg-green-100 text-green-700 hover:bg-green-200 rounded-lg">
                                        <i class="fas fa-clock mr-1"></i>Tambah Waktu
                                    </button>
                                ` : ''}
                                <button onclick="viewAnswers(${student.id})" class="p-2 bg-purple-100 text-purple-700 hover:bg-purple-200 rounded-lg">
                                    <i class="fas fa-eye mr-1"></i>Lihat Jawaban
                                </button>
                                <button onclick="downloadStudentReport(${student.id})" class="p-2 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 rounded-lg">
                                    <i class="fas fa-download mr-1"></i>Undah Laporan
                                </button>
                            </div>
                        </div>
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
            
            // Apply search filter
            if (state.searchTerm) {
                filtered = filtered.filter(student => 
                    student.nama.toLowerCase().includes(state.searchTerm) ||
                    student.email.toLowerCase().includes(state.searchTerm)
                );
            }
            
            // Apply status filter
            if (state.filterStatus !== 'all') {
                filtered = filtered.filter(student => student.status === state.filterStatus);
            }
            
            state.filteredStudents = filtered;
            renderStudents();
        }

        // Control functions
        function refreshData() {
            // Simulate API call
            alert('Data diperbarui!');
            renderAll();
        }

        function pauseAllExams() {
            if (confirm('Jeda ujian untuk semua siswa?')) {
                alert('Ujian dijeda untuk semua siswa');
                // In real app, send API request to pause all exams
            }
        }

        function extendTime() {
            const minutes = prompt('Tambah waktu (menit):', '5');
            if (minutes && !isNaN(minutes)) {
                alert(`Waktu ditambah ${minutes} menit untuk semua siswa`);
                // In real app, update exam duration
            }
        }

        function endExam() {
            if (confirm('Akhiri ujian untuk semua siswa?')) {
                alert('Ujian diakhiri. Semua jawaban akan dikumpulkan.');
                // In real app, end exam for all students
            }
        }

        function downloadReport() {
            alert('Laporan sedang diunduh...');
            // In real app, generate and download report
        }

        function sendMessage(studentId) {
            const message = prompt('Pesan untuk siswa:');
            if (message) {
                alert(`Pesan terkirim ke siswa ID: ${studentId}`);
            }
        }

        function extendStudentTime(studentId) {
            const minutes = prompt('Tambah waktu untuk siswa ini (menit):', '5');
            if (minutes && !isNaN(minutes)) {
                alert(`Waktu ditambah ${minutes} menit untuk siswa ID: ${studentId}`);
            }
        }

        function viewAnswers(studentId) {
            alert(`Melihat jawaban siswa ID: ${studentId}\n\nDalam aplikasi nyata, ini akan menampilkan semua jawaban siswa.`);
            closeDetailModal();
        }

        function downloadStudentReport(studentId) {
            alert(`Mengunduh laporan untuk siswa ID: ${studentId}`);
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