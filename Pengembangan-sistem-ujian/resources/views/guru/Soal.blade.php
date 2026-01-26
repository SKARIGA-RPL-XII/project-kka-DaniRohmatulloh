<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Soal | Dashboard Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg">ExamSystem</h1>
                        <p class="text-xs text-gray-300">Guru Dashboard</p>
                    </div>
                </div>

                <div class="mb-8 p-4 bg-white/5 rounded-xl">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            G
                        </div>
                        <div>
                            <p class="font-medium">Guru Matematika</p>
                            <p class="text-xs text-gray-300">guru@gmail.com</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-2 px-2 py-1 bg-purple-900/30 rounded-full">
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        <span class="text-xs">Guru</span>
                    </div>
                </div>

                <nav class="space-y-1">
                    <a href="/guru/dashboard" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-home"></i><span>Dashboard</span>
                    </a>
                    <a href="/guru/soal" class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg">
                        <i class="fas fa-question-circle"></i><span>Kelola Soal</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
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
                    <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="dashboard"></i><span>Dashboard</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg">
                        <i class="kelola soal"></i><span>Kelola Soal</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-file-alt"></i><span>Buat Ujian</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-chart-bar"></i><span>Analisis Nilai</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg transition">
                        <i class="fas fa-users"></i><span>Kelola Kelas</span>
                    </a>
                    <div class="pt-4 border-t border-white/10">
                        <button class="w-full flex items-center gap-3 p-3 text-red-300 hover:bg-white/10 rounded-lg transition">
                            <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                        </button>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Kelola Soal</h1>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-database mr-1"></i>Tambah, Hapus, dan Review Soal
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <button onclick="showModal()" class="flex items-center gap-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-3 rounded-lg hover:shadow-lg transition">
                                <i class="fas fa-plus-circle"></i><span>Tambah Soal Baru</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Soal Pilihan Ganda</p>
                                <p id="totalPG" class="text-3xl font-bold text-gray-800">45</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-list-ol text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Soal Uraian</p>
                                <p id="totalUraian" class="text-3xl font-bold text-gray-800">28</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Mata Pelajaran</p>
                                <p id="totalMapel" class="text-3xl font-bold text-gray-800">6</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Bank Soal Total</p>
                                <p id="totalSoal" class="text-3xl font-bold text-gray-800">73</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-database text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Soal Terbaru</h2>
                            <p class="text-sm text-gray-600">Klik ikon untuk aksi</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Pertanyaan</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Mapel</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="questionsTable" class="divide-y divide-gray-200">
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <span id="showing">0</span> dari <span id="total">0</span> soal
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="prevPage()" class="p-2 border border-gray-300 rounded hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <span class="px-3 py-1 bg-gray-100 rounded text-sm">Halaman <span id="page">1</span></span>
                            <button onclick="nextPage()" class="p-2 border border-gray-300 rounded hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="bg-white border-t px-6 py-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-600">&copy; 2025 ExamSystem</p>
                    <div class="mt-2 md:mt-0">
                        <span class="text-sm text-green-600 font-medium">
                            <i class="fas fa-check-circle mr-1"></i>Siap Digunakan
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Tambah Soal -->
    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-xl bg-white max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Tambah Soal Baru</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="form" onsubmit="saveQuestions(event)">
                <div id="step1" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Jenis Soal</label>
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" onclick="setType('pg')" id="btnPG" class="p-4 border-2 border-blue-400 rounded-lg text-center bg-blue-50">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-list-ol text-blue-600 text-xl"></i>
                                </div>
                                <h4 class="font-medium text-gray-800">Pilihan Ganda</h4>
                                <p class="text-sm text-gray-500 mt-1">Soal A, B, C, D</p>
                            </button>
                            
                            <button type="button" onclick="setType('uraian')" id="btnUraian" class="p-4 border rounded-lg text-center hover:border-green-400">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-edit text-green-600 text-xl"></i>
                                </div>
                                <h4 class="font-medium text-gray-800">Uraian</h4>
                                <p class="text-sm text-gray-500 mt-1">Soal esai/uraian</p>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="nextStep()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <div id="step2" class="space-y-6 hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                        <div id="subjects" class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-60 overflow-y-auto p-3 border rounded-lg">
                            <!-- Data mata pelajaran -->
                        </div>
                        <button type="button" onclick="showNewSubject()" class="mt-2 text-sm text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            <i class="fas fa-plus-circle"></i>Tambah Mapel Baru
                        </button>
                        <div id="newSubject" class="mt-3 p-3 border rounded-lg hidden">
                            <input type="text" id="subjectName" placeholder="Nama mata pelajaran baru" class="w-full px-3 py-2 border rounded mb-2">
                            <div class="flex justify-end gap-2">
                                <button type="button" onclick="hideNewSubject()" class="px-3 py-1 text-gray-600 hover:text-gray-800">Batal</button>
                                <button type="button" onclick="addSubject()" class="px-3 py-1 bg-green-500 text-white rounded">Tambah</button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="questions" class="max-h-96 overflow-y-auto"></div>
                    
                    <div class="flex justify-between">
                        <button type="button" onclick="prevStep()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </button>
                        <div class="flex gap-3">
                            <button type="button" onclick="addMore()" class="px-4 py-2 border border-green-300 text-green-600 rounded-lg hover:bg-green-50">
                                + Tambah Lagi
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Simpan Semua Soal
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Review -->
    <div id="reviewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-xl bg-white">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Review Soal</h3>
                <button onclick="closeReview()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="reviewContent"></div>
            <div class="mt-6 flex justify-end gap-3">
                <button onclick="closeReview()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Tutup</button>
                <button onclick="approve()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Setujui Soal</button>
            </div>
        </div>
    </div>

    <!-- Modal Bulk Action -->
    <div id="bulkModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-xl bg-white">
            <div class="flex justify-between items-center mb-6">
                <h3 id="bulkTitle" class="text-xl font-bold text-gray-800"></h3>
                <button onclick="closeBulk()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="bulkContent"></div>
            <div class="flex justify-end gap-3 mt-6">
                <button onclick="closeBulk()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button id="confirmBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"></button>
            </div>
        </div>
    </div>

<script>
// Data State
const data = {
    type: 'pg',
    count: 1,
    step: 1,
    selectedSubject: null,
    questions: [],
    subjects: [
        { id: 1, name: 'Matematika' },
        { id: 2, name: 'Bahasa Indonesia' },
        { id: 3, name: 'IPA' },
        { id: 4, name: 'IPS' },
        { id: 5, name: 'Bahasa Inggris' },
        { id: 6, name: 'PKN' }
    ],
    
    selected: new Set(),
    page: 1,
    perPage: 10,
    currentReview: null
};

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateStats();
    loadQuestions();
    loadSubjects();
});

// Update Statistics
function updateStats() {
    const pg = data.soal.filter(q => q.type === 'pg').length;
    const uraian = data.soal.filter(q => q.type === 'uraian').length;
    const total = data.soal.length;
    
    document.getElementById('totalPG').textContent = pg;
    document.getElementById('totalUraian').textContent = uraian;
    document.getElementById('totalMapel').textContent = data.subjects.length;
    document.getElementById('totalSoal').textContent = total;
}

// Load Questions to Table
function loadQuestions() {
    const tbody = document.getElementById('questionsTable');
    const start = (data.page - 1) * data.perPage;
    const end = start + data.perPage;
    const items = data.soal.slice(start, end);
    
    tbody.innerHTML = '';
    
    items.forEach(q => {
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50';
        row.id = `row-${q.id}`;
        
        let statusClass = '';
        let statusText = '';
        switch(q.status) {
            case 'aktif': statusClass = 'bg-green-100 text-green-800'; statusText = 'Aktif'; break;
            case 'review': statusClass = 'bg-yellow-100 text-yellow-800'; statusText = 'Review'; break;
            default: statusClass = 'bg-gray-100 text-gray-800'; statusText = 'Pending';
        }
        
        row.innerHTML = `
            <td class="py-3 px-6">
                <div class="flex items-center gap-2">
                    <input type="checkbox" class="checkbox" data-id="${q.id}" onchange="toggleSelect(${q.id})">
                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-medium">SOAL-${q.id.toString().padStart(3, '0')}</span>
                </div>
            </td>
            <td class="py-3 px-6">
                <span class="px-2 py-1 ${q.type === 'pg' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'} rounded text-xs font-medium">
                    ${q.type === 'pg' ? '<i class="fas fa-list-ol mr-1"></i> PG' : '<i class="fas fa-edit mr-1"></i> Uraian'}
                </span>
            </td>
            <td class="py-3 px-6">
                <div class="max-w-xs truncate" title="${q.question}">${q.question}</div>
            </td>
            <td class="py-3 px-6"><span class="text-sm font-medium">${q.subject}</span></td>
            <td class="py-3 px-6"><span class="text-sm text-gray-500">${q.date}</span></td>
            <td class="py-3 px-6">
                <span class="px-2 py-1 ${statusClass} rounded text-xs font-medium">${statusText}</span>
            </td>
            <td class="py-3 px-6">
                <div class="flex items-center gap-2">
                    <button onclick="review(${q.id})" class="p-2 text-purple-600 hover:text-purple-800 hover:bg-purple-50 rounded-lg" title="Review">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="del(${q.id})" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg" title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
    
    document.getElementById('showing').textContent = items.length;
    document.getElementById('total').textContent = data.soal.length;
    document.getElementById('page').textContent = data.page;
}

// Toggle Selection
function toggleSelect(id) {
    if (data.selected.has(id)) {
        data.selected.delete(id);
    } else {
        data.selected.add(id);
    }
    const row = document.getElementById(`row-${id}`);
    if (row) row.classList.toggle('bg-blue-50', data.selected.has(id));
}

// Review Question
function review(id) {
    const q = data.soal.find(s => s.id === id);
    if (!q) return;
    
    data.currentReview = id;
    let content = '';
    
    if (q.type === 'pg') {
        content = `
            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                <h4 class="font-bold text-gray-800 mb-2">Detail Soal Pilihan Ganda</h4>
                <p class="text-gray-700 mb-4">${q.question}</p>
                <div class="space-y-2">
                    ${q.options.map((opt, i) => `
                        <div class="flex items-center gap-3 p-3 ${q.correct === String.fromCharCode(65 + i) ? 'bg-green-50 border border-green-200' : 'bg-white border'} rounded-lg">
                            <span class="font-bold ${q.correct === String.fromCharCode(65 + i) ? 'text-green-600' : 'text-gray-600'}">
                                ${String.fromCharCode(65 + i)}
                            </span>
                            <span class="flex-1">${opt}</span>
                            ${q.correct === String.fromCharCode(65 + i) ? '<span class="text-green-600"><i class="fas fa-check-circle"></i> Jawaban Benar</span>' : ''}
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    } else {
        content = `
            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                <h4 class="font-bold text-gray-800 mb-2">Detail Soal Uraian</h4>
                <p class="text-gray-700 mb-4">${q.question}</p>
            </div>
        `;
    }
    
    content += `
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div class="bg-white border rounded-lg p-3">
                <div class="text-gray-500">Mata Pelajaran</div>
                <div class="font-medium">${q.subject}</div>
            </div>
            <div class="bg-white border rounded-lg p-3">
                <div class="text-gray-500">Status</div>
                <div class="font-medium">
                    <span class="px-2 py-1 ${q.status === 'aktif' ? 'bg-green-100 text-green-800' : q.status === 'review' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'} rounded text-xs">
                        ${q.status === 'aktif' ? 'Aktif' : q.status === 'review' ? 'Review' : 'Pending'}
                    </span>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('reviewContent').innerHTML = content;
    document.getElementById('reviewModal').classList.remove('hidden');
}

function closeReview() {
    document.getElementById('reviewModal').classList.add('hidden');
    data.currentReview = null;
}

function approve() {
    if (data.currentReview) {
        const idx = data.soal.findIndex(s => s.id === data.currentReview);
        if (idx !== -1) {
            data.soal[idx].status = 'aktif';
            loadQuestions();
            updateStats();
            alert('Soal disetujui!');
            closeReview();
        }
    }
}

function edit(id) {
    alert(`Edit soal ID: ${id}`);
}

function del(id) {
    if (confirm('Hapus soal ini?')) {
        data.soal = data.soal.filter(s => s.id !== id);
        data.selected.delete(id);
        loadQuestions();
        updateStats();
        alert('Soal dihapus!');
    }
}

function toggleStatus(id) {
    const idx = data.soal.findIndex(s => s.id === id);
    if (idx !== -1) {
        data.soal[idx].status = data.soal[idx].status === 'aktif' ? 'pending' : 'aktif';
        loadQuestions();
        updateStats();
    }
}

// Pagination
function prevPage() {
    if (data.page > 1) {
        data.page--;
        loadQuestions();
    }
}

function nextPage() {
    const totalPages = Math.ceil(data.soal.length / data.perPage);
    if (data.page < totalPages) {
        data.page++;
        loadQuestions();
    }
}

// Modal Functions
function showModal(mode = 'single') {
    if (mode === 'multiple') updateCount(5);
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    resetForm();
}

function setType(type) {
    data.type = type;
    document.getElementById('btnPG').classList.toggle('border-blue-400', type === 'pg');
    document.getElementById('btnPG').classList.toggle('bg-blue-50', type === 'pg');
    document.getElementById('btnUraian').classList.toggle('border-green-400', type === 'uraian');
    document.getElementById('btnUraian').classList.toggle('bg-green-50', type === 'uraian');
}

function updateCount(value) {
    data.count = parseInt(value);
    document.getElementById('display').textContent = value;
    document.getElementById('count').value = value;
}

function nextStep() {
    if (data.count < 1) {
        alert('Minimal 1 soal');
        return;
    }
    data.step = 2;
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
    generateQuestions();
}

function prevStep() {
    data.step = 1;
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step1').classList.remove('hidden');
}

function loadSubjects() {
    const container = document.getElementById('subjects');
    container.innerHTML = '';
    data.subjects.forEach(s => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'p-3 border rounded-lg text-left hover:border-blue-300';
        btn.innerHTML = `<div class="font-medium">${s.name}</div>`;
        btn.onclick = () => {
            data.selectedSubject = s.id;
            document.querySelectorAll('#subjects button').forEach(b => b.classList.remove('bg-blue-50', 'border-blue-500'));
            btn.classList.add('bg-blue-50', 'border-blue-500');
        };
        container.appendChild(btn);
    });
}

function showNewSubject() {
    document.getElementById('newSubject').classList.remove('hidden');
}

function hideNewSubject() {
    document.getElementById('newSubject').classList.add('hidden');
    document.getElementById('subjectName').value = '';
}

function addSubject() {
    const name = document.getElementById('subjectName').value.trim();
    if (!name) {
        alert('Nama mapel harus diisi');
        return;
    }
    const newSub = { id: data.subjects.length + 1, name: name };
    data.subjects.push(newSub);
    loadSubjects();
    hideNewSubject();
}

function generateQuestions() {
    const container = document.getElementById('questions');
    container.innerHTML = '';
    for (let i = 1; i <= data.count; i++) {
        const div = document.createElement('div');
        div.className = 'border rounded-lg p-4 mb-4';
        div.innerHTML = data.type === 'pg' ? `
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Soal ${i}</label>
                <textarea placeholder="Pertanyaan..." class="w-full px-3 py-2 border rounded-lg" rows="2" required></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div><input type="text" placeholder="Opsi A" class="w-full px-3 py-2 border rounded-lg" required></div>
                <div><input type="text" placeholder="Opsi B" class="w-full px-3 py-2 border rounded-lg" required></div>
                <div><input type="text" placeholder="Opsi C" class="w-full px-3 py-2 border rounded-lg" required></div>
                <div><input type="text" placeholder="Opsi D" class="w-full px-3 py-2 border rounded-lg" required></div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jawaban Benar</label>
                <div class="grid grid-cols-4 gap-3">
                    <div class="text-center"><input type="radio" name="jawaban${i}" value="A" required><label class="text-sm ml-1">A</label></div>
                    <div class="text-center"><input type="radio" name="jawaban${i}" value="B"><label class="text-sm ml-1">B</label></div>
                    <div class="text-center"><input type="radio" name="jawaban${i}" value="C"><label class="text-sm ml-1">C</label></div>
                    <div class="text-center"><input type="radio" name="jawaban${i}" value="D"><label class="text-sm ml-1">D</label></div>
                </div>
            </div>
        ` : `
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Soal ${i} - Uraian</label>
                <textarea placeholder="Pertanyaan uraian..." class="w-full px-3 py-2 border rounded-lg" rows="3" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kunci Jawaban</label>
                <textarea placeholder="Kunci jawaban..." class="w-full px-3 py-2 border rounded-lg" rows="2"></textarea>
            </div>
        `;
        container.appendChild(div);
    }
}

function addMore() {
    data.count++;
    document.getElementById('count').value = data.count;
    document.getElementById('display').textContent = data.count;
    generateQuestions();
}

function saveQuestions(e) {
    e.preventDefault();
    if (!data.selectedSubject) {
        alert('Pilih mata pelajaran!');
        return;
    }
    const subject = data.subjects.find(s => s.id === data.selectedSubject);
    for (let i = 0; i < data.count; i++) {
        const newId = data.soal.length > 0 ? Math.max(...data.soal.map(s => s.id)) + 1 : 1;
        data.soal.unshift({
            id: newId,
            type: data.type,
            question: `Soal ${data.type === 'pg' ? 'Pilihan Ganda' : 'Uraian'} ${i+1} - ${subject.name}`,
            subject: subject.name,
            date: new Date().toISOString().split('T')[0],
            status: 'review',
            options: data.type === 'pg' ? ['Opsi A', 'Opsi B', 'Opsi C', 'Opsi D'] : undefined,
            correct: data.type === 'pg' ? 'A' : undefined
        });
    }
    updateStats();
    loadQuestions();
    alert(`Berhasil tambah ${data.count} soal!`);
    closeModal();
}

function resetForm() {
    data.type = 'pg';
    data.count = 1;
    data.step = 1;
    data.selectedSubject = null;
    document.getElementById('form').reset();
    document.getElementById('display').textContent = '1';
    document.getElementById('count').value = 1;
    document.getElementById('btnPG').classList.add('border-blue-400', 'bg-blue-50');
    document.getElementById('btnUraian').classList.remove('border-green-400', 'bg-green-50');
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step1').classList.remove('hidden');
}

// Bulk Actions
function bulkDelete() {
    if (data.selected.size === 0) {
        alert('Pilih soal dulu!');
        return;
    }
    document.getElementById('bulkTitle').textContent = 'Hapus Massal';
    document.getElementById('bulkContent').innerHTML = `
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                <div>
                    <p class="font-medium text-red-800">Hapus ${data.selected.size} soal?</p>
                    <p class="text-sm text-red-600">Tidak dapat dikembalikan</p>
                </div>
            </div>
        </div>
    `;
    document.getElementById('confirmBtn').textContent = 'Hapus Semua';
    document.getElementById('confirmBtn').onclick = confirmDelete;
    document.getElementById('confirmBtn').className = 'px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700';
    document.getElementById('bulkModal').classList.remove('hidden');
}

function bulkReview() {
    if (data.selected.size === 0) {
        alert('Pilih soal dulu!');
        return;
    }
    document.getElementById('bulkTitle').textContent = 'Review Massal';
    document.getElementById('bulkContent').innerHTML = `
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-eye text-purple-600 text-xl"></i>
                <div>
                    <p class="font-medium text-purple-800">Review ${data.selected.size} soal</p>
                    <p class="text-sm text-purple-600">Setujui semua soal terpilih</p>
                </div>
            </div>
        </div>
    `;
    document.getElementById('confirmBtn').textContent = 'Setujui Semua';
    document.getElementById('confirmBtn').onclick = confirmReview;
    document.getElementById('confirmBtn').className = 'px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700';
    document.getElementById('bulkModal').classList.remove('hidden');
}

function confirmDelete() {
    data.soal = data.soal.filter(s => !data.selected.has(s.id));
    data.selected.clear();
    loadQuestions();
    updateStats();
    closeBulk();
    alert('Soal dihapus!');
}

function confirmReview() {
    data.soal.forEach(s => {
        if (data.selected.has(s.id)) s.status = 'aktif';
    });
    data.selected.clear();
    loadQuestions();
    updateStats();
    closeBulk();
    alert('Soal disetujui!');
}

function closeBulk() {
    document.getElementById('bulkModal').classList.add('hidden');
}
</script>
</body>
</html>