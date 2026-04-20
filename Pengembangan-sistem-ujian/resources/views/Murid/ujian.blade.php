<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ujian {{ $mapel->nama_mapel }} - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 5px rgba(99, 102, 241, 0.3); }
            50% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.6); }
        }
        
        @keyframes pulse-green {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); background-color: #22c55e; }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        @keyframes bounce-in {
            0% { transform: scale(0); opacity: 0; }
            80% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }
        
        @keyframes slide-in {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }
        
        .glow-effect {
            animation: glow 2s ease-in-out infinite;
        }
        
        .level-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .xp-bar {
            background: linear-gradient(90deg, #f59e0b, #ef4444);
        }
        
        .question-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            animation: slide-in 0.5s ease-out;
        }
        
        .question-card:hover {
            transform: translateX(5px);
        }
        
        .answered-effect {
            animation: bounce-in 0.3s ease-out;
        }
        
        .option-correct {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            transform: scale(1.02);
        }
        
        .nav-btn {
            transition: all 0.2s ease;
        }
        
        .nav-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background: linear-gradient(135deg, #f59e0b, #ef4444, #8b5cf6, #06b6d4);
            position: absolute;
            animation: confetti-fall 3s linear forwards;
        }
        
        @keyframes confetti-fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .custom-scroll::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
        }
        
        .powerup {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            animation: pulse-green 1s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-indigo-900 min-h-screen">

    {{-- Header dengan Game Style --}}
    <header class="bg-black/30 backdrop-blur-md border-b border-white/10 sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center floating-icon shadow-lg">
                        <i class="fas fa-gamepad text-white text-lg"></i>
                    </div>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                </div>
                <div>
                    <p class="font-bold text-white text-sm flex items-center gap-2">
                        {{ $mapel->nama_mapel }} Challenge
                        <span class="text-xs bg-yellow-500/20 text-yellow-400 px-2 py-0.5 rounded-full">Level 1</span>
                    </p>
                    <p class="text-xs text-gray-400 flex items-center gap-2">
                        <i class="fas fa-dice-d6"></i> {{ count($soalList) }} soal
                        <i class="fas fa-star text-yellow-500 ml-2"></i> <span id="xpGain">0</span> XP
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                {{-- Timer dengan style game --}}
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl blur opacity-75 group-hover:opacity-100 transition"></div>
                    <div class="relative flex items-center gap-2 bg-black/50 backdrop-blur border border-orange-500/30 px-4 py-2 rounded-xl">
                        <i class="fas fa-hourglass-half text-orange-400 text-sm animate-pulse"></i>
                        <span id="timer" class="font-mono font-bold text-orange-400 text-lg tracking-wider">60:00</span>
                        <i class="fas fa-bolt text-yellow-400 text-xs"></i>
                    </div>
                </div>
                
                {{-- Score/Progress bar --}}
                <div class="bg-black/40 rounded-xl p-2 px-3">
                    <div class="flex items-center gap-2">
                        <div class="w-20 h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div id="progressBar" class="h-full bg-gradient-to-r from-green-500 to-yellow-500 rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                        <span class="text-xs text-gray-300">
                            <span id="terjawab">0</span>/{{ count($soalList) }}
                        </span>
                    </div>
                </div>
                
                {{-- Streak counter --}}
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl px-3 py-1.5 flex items-center gap-2 shadow-lg">
                    <i class="fas fa-fire text-white text-sm"></i>
                    <span id="streakCount" class="text-white font-bold text-sm">0</span>
                </div>
            </div>
        </div>
        
        {{-- XP Bar --}}
        <div class="max-w-6xl mx-auto px-4 pb-2">
            <div class="flex items-center gap-2 text-xs text-gray-400">
                <i class="fas fa-trophy text-yellow-500"></i>
                <span>Level 1</span>
                <div class="flex-1 h-1.5 bg-gray-700 rounded-full overflow-hidden">
                    <div id="xpBar" class="xp-bar h-full rounded-full" style="width: 0%"></div>
                </div>
                <span>Level 2</span>
                <i class="fas fa-chevron-right text-gray-600 text-xs"></i>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-6">
        {{-- Kolom kiri: soal --}}
        <div class="flex-1">
            <form id="ujianForm" method="POST" action="{{ route('murid.ujian.submit', $mapel_id) }}">
                @csrf
                
                {{-- Power Up Banner --}}
                <div class="mb-4 p-3 bg-gradient-to-r from-purple-500/20 to-pink-500/20 rounded-xl border border-purple-500/30 backdrop-blur flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center powerup">
                            <i class="fas fa-bolt text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-purple-300 font-semibold">POWER UP AKTIF</p>
                            <p class="text-xs text-gray-400">Jawab 3 soal berturut-turut untuk bonus XP!</p>
                        </div>
                    </div>
                    <div class="flex gap-1">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                    </div>
                </div>

                <div class="space-y-4" id="questionsContainer">
                    @foreach($soalList as $soal)
                    <div class="bg-gradient-to-br from-gray-800/90 to-gray-900/90 backdrop-blur rounded-xl border border-gray-700/50 p-6 question-card hover:border-indigo-500/50 transition-all" id="soal-{{ $soal['nomor'] }}" data-nomor="{{ $soal['nomor'] }}">
                        {{-- Nomor & pertanyaan dengan style game --}}
                        <div class="flex gap-3 mb-4">
                            <div class="relative">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <span class="text-white font-bold text-sm">{{ $soal['nomor'] }}</span>
                                </div>
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl blur opacity-50"></div>
                            </div>
                            <p class="text-gray-200 font-medium pt-1 flex-1">{{ $soal['pertanyaan'] }}</p>
                            <div class="text-right">
                                <span class="text-xs text-gray-500"><i class="fas fa-coins text-yellow-500"></i> +10 XP</span>
                            </div>
                        </div>

                        {{-- Pilihan Ganda dengan style game --}}
                        @if($soal['tipe'] === 'pilihan_ganda')
                        <div class="space-y-3 ml-12">
                            @foreach(['A','B','C','D'] as $opt)
                            @php $opsiKey = 'opsi_' . strtolower($opt); @endphp
                            @if($soal[$opsiKey])
                            <label class="flex items-center gap-3 p-3 bg-gray-800/50 border border-gray-700 rounded-xl cursor-pointer hover:bg-indigo-900/30 hover:border-indigo-500/50 transition-all group opsi-label"
                                   data-nomor="{{ $soal['nomor'] }}">
                                <input type="radio"
                                       name="jawaban[{{ $soal['nomor'] }}]"
                                       value="{{ $opt }}"
                                       class="hidden opsi-radio"
                                       data-nomor="{{ $soal['nomor'] }}"
                                       onchange="tandaiTerjawab({{ $soal['nomor'] }}, this.value)">
                                <div class="w-8 h-8 rounded-lg bg-gray-700 text-gray-400 flex items-center justify-center text-sm font-bold group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                    {{ $opt }}
                                </div>
                                <span class="text-gray-300 text-sm flex-1">{{ $soal[$opsiKey] }}</span>
                                <i class="fas fa-chevron-right text-gray-600 opacity-0 group-hover:opacity-100 transition-all"></i>
                            </label>
                            @endif
                            @endforeach
                        </div>

                        {{-- Essay --}}
                        @else
                        <div class="ml-12">
                            <textarea name="jawaban[{{ $soal['nomor'] }}]"
                                      rows="4"
                                      placeholder="Tulis jawaban kamu di sini... 💭"
                                      class="w-full bg-gray-800/50 border border-gray-700 rounded-xl px-4 py-3 text-gray-300 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none transition-all"
                                      onkeyup="tandaiTerjawab({{ $soal['nomor'] }}, this.value)"></textarea>
                        </div>
                        @endif
                        
                        {{-- Status badge --}}
                        <div class="mt-3 flex justify-end">
                            <div class="text-xs text-gray-500 opacity-0 group-hover:opacity-100 transition" id="status-{{ $soal['nomor'] }}">
                                <i class="far fa-circle"></i> Belum dijawab
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Tombol Submit dengan style game --}}
                <div class="mt-8 bg-gradient-to-r from-gray-800/90 to-gray-900/90 backdrop-blur rounded-xl border border-gray-700/50 p-5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center floating-icon">
                            <i class="fas fa-gem text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300 font-medium">Total XP yang akan didapat</p>
                            <p class="text-xs text-gray-500"><span id="totalXPDisplay">0</span> XP + bonus streak</p>
                        </div>
                    </div>
                    <button type="button" onclick="konfirmasiSubmit()"
                            class="relative px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl transition-all duration-300 flex items-center gap-2 shadow-lg hover:shadow-indigo-500/25 group">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl blur opacity-0 group-hover:opacity-50 transition"></span>
                        <i class="fas fa-flag-checkered"></i> Kumpulkan Jawaban
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition"></i>
                    </button>
                </div>
            </form>
        </div>

        {{-- Kolom kanan: navigasi dengan style game --}}
        <div class="w-64 flex-shrink-0">
            <div class="bg-gradient-to-br from-gray-800/90 to-gray-900/90 backdrop-blur rounded-xl border border-gray-700/50 p-4 sticky top-20">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-map text-indigo-400"></i>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Peta Soal</p>
                </div>
                
                {{-- Grid navigasi dengan style game --}}
                <div class="grid grid-cols-5 gap-2 mb-4" id="navGrid">
                    @foreach($soalList as $soal)
                    <button type="button"
                            onclick="scrollKeSoal({{ $soal['nomor'] }})"
                            id="nav-{{ $soal['nomor'] }}"
                            class="nav-btn w-10 h-10 rounded-xl text-xs font-bold border border-gray-700 text-gray-400 hover:border-indigo-500 hover:text-indigo-400 transition-all">
                        {{ $soal['nomor'] }}
                    </button>
                    @endforeach
                </div>
                
                {{-- Legend dengan style game --}}
                <div class="space-y-2 text-xs border-t border-gray-700/50 pt-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                            <span class="text-gray-400">Completed</span>
                        </div>
                        <span id="completedCount" class="text-indigo-400 font-bold">0</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded border border-gray-700 bg-gray-800"></div>
                            <span class="text-gray-400">Pending</span>
                        </div>
                        <span id="pendingCount" class="text-gray-500 font-bold">{{ count($soalList) }}</span>
                    </div>
                    <div class="flex items-center gap-2 pt-2 border-t border-gray-700/50 mt-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-yellow-500 to-orange-500 flex items-center justify-center">
                            <i class="fas fa-trophy text-white text-xs"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Target XP</p>
                            <p class="text-yellow-400 font-bold text-sm">{{ count($soalList) * 10 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Tips card --}}
            <div class="mt-4 bg-gradient-to-r from-purple-500/10 to-pink-500/10 rounded-xl border border-purple-500/30 p-3">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-lightbulb text-yellow-500 text-sm"></i>
                    <p class="text-xs text-gray-300 font-semibold">Pro Tip</p>
                </div>
                <p class="text-xs text-gray-400">Jawab soal dengan cepat untuk mendapatkan bonus XP! 🚀</p>
            </div>
        </div>
    </div>

    {{-- Modal konfirmasi submit dengan style game --}}
    <div id="modalSubmit" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 max-w-sm w-full mx-4 shadow-2xl border border-gray-700 animate-bounce-in">
            <div class="relative w-20 h-20 mx-auto mb-4">
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full blur-xl opacity-75 animate-pulse"></div>
                <div class="relative w-20 h-20 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-trophy text-white text-3xl"></i>
                </div>
            </div>
            <h3 class="text-xl font-bold text-white text-center mb-2">Selesaikan Challenge?</h3>
            <p class="text-sm text-gray-400 text-center mb-5">
                <span id="infoTerjawab"></span> soal terjawab dari {{ count($soalList) }} soal.
                <br>Total XP: <span id="modalTotalXP">0</span>
            </p>
            <div class="flex gap-3">
                <button onclick="tutupModal()" class="flex-1 py-3 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-xl font-medium transition-all">Batal</button>
                <button onclick="completeGame()" class="flex-1 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl font-semibold transition-all shadow-lg">
                    <i class="fas fa-check-circle mr-1"></i> Selesai
                </button>
            </div>
        </div>
    </div>
    
    {{-- Modal Completion dengan efek confetti --}}
    <div id="completionModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 max-w-md w-full mx-4 text-center border border-yellow-500/50">
            <div class="relative mb-4">
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full blur-2xl animate-ping"></div>
                <div class="relative w-24 h-24 mx-auto bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-crown text-white text-4xl"></i>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">🎉 Level Up! 🎉</h3>
            <p class="text-gray-300 mb-4">Selamat! Kamu telah menyelesaikan challenge!</p>
            <div class="bg-gray-700/50 rounded-xl p-4 mb-6">
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-400">XP yang didapat</span>
                    <span class="text-yellow-400 font-bold" id="finalXP">0</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Streak bonus</span>
                    <span class="text-orange-400 font-bold" id="bonusXP">0</span>
                </div>
            </div>
            <button onclick="document.getElementById('ujianForm').submit()" 
                    class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl transition-all shadow-lg">
                <i class="fas fa-gem mr-2"></i> Klaim Hadiah
            </button>
        </div>
    </div>

    <script>
        const totalSoal = {{ count($soalList) }};
        const terjawab = {};
        let currentStreak = 0;
        let maxStreak = 0;
        let totalXP = 0;
        
        // Timer 60 menit
        let sisa = 60 * 60;
        const timerEl = document.getElementById('timer');
        const interval = setInterval(() => {
            sisa--;
            const m = String(Math.floor(sisa / 60)).padStart(2, '0');
            const s = String(sisa % 60).padStart(2, '0');
            timerEl.textContent = m + ':' + s;
            
            // Warning effect
            if (sisa <= 300) {
                timerEl.classList.add('text-red-500', 'animate-pulse');
            }
            if (sisa <= 0) {
                clearInterval(interval);
                document.getElementById('ujianForm').submit();
            }
        }, 1000);

        function updateStreak(nomor, isAnswered) {
            const prevAnswered = terjawab[nomor];
            
            if (isAnswered && !prevAnswered) {
                currentStreak++;
                if (currentStreak > maxStreak) maxStreak = currentStreak;
                
                // Show streak notification
                if (currentStreak % 3 === 0) {
                    showStreakBonus(currentStreak);
                }
            } else if (!isAnswered && prevAnswered) {
                currentStreak = 0;
            }
            
            document.getElementById('streakCount').textContent = currentStreak;
            updateXP();
        }
        
        function showStreakBonus(streak) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-20 right-4 bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-2 rounded-xl shadow-lg z-50 animate-bounce';
            toast.innerHTML = `<i class="fas fa-fire mr-2"></i> Streak ${streak}! +${streak * 5} XP Bonus!`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
        }
        
        function updateXP() {
            const answeredCount = Object.keys(terjawab).length;
            totalXP = (answeredCount * 10) + (Math.floor(maxStreak / 3) * 15);
            document.getElementById('xpGain').textContent = totalXP;
            document.getElementById('totalXPDisplay').textContent = totalXP;
            
            // Update XP bar (target 100 XP untuk level up)
            const xpPercent = Math.min((totalXP % 100), 100);
            document.getElementById('xpBar').style.width = xpPercent + '%';
        }

        function tandaiTerjawab(nomor, val) {
            const wasAnswered = terjawab[nomor];
            const isEssay = val !== undefined;
            const isRadio = !isEssay && document.querySelector(`input[name="jawaban[${nomor}]"]:checked`) !== null;
            
            if (isEssay && val.trim() === '') {
                delete terjawab[nomor];
                updateStreak(nomor, false);
                updateStatusBadge(nomor, false);
            } else if (isEssay || isRadio) {
                if (!terjawab[nomor]) {
                    terjawab[nomor] = true;
                    updateStreak(nomor, true);
                    updateStatusBadge(nomor, true);
                    
                    // Add animation effect
                    const soalCard = document.getElementById(`soal-${nomor}`);
                    soalCard.classList.add('answered-effect');
                    setTimeout(() => soalCard.classList.remove('answered-effect'), 300);
                } else {
                    terjawab[nomor] = true;
                }
            }
            
            updateNav(nomor);
            updateProgress();
        }
        
        function updateStatusBadge(nomor, isAnswered) {
            const statusEl = document.getElementById(`status-${nomor}`);
            if (statusEl) {
                if (isAnswered) {
                    statusEl.innerHTML = '<i class="fas fa-check-circle text-green-500"></i> Sudah dijawab';
                    statusEl.classList.remove('opacity-0');
                } else {
                    statusEl.innerHTML = '<i class="far fa-circle"></i> Belum dijawab';
                }
            }
        }

        function updateProgress() {
            const answeredCount = Object.keys(terjawab).length;
            const progressPercent = (answeredCount / totalSoal) * 100;
            document.getElementById('progressBar').style.width = progressPercent + '%';
            document.getElementById('terjawab').textContent = answeredCount;
            document.getElementById('completedCount').textContent = answeredCount;
            document.getElementById('pendingCount').textContent = totalSoal - answeredCount;
        }

        function updateNav(nomor) {
            const btn = document.getElementById('nav-' + nomor);
            if (!btn) return;
            if (terjawab[nomor]) {
                btn.className = 'nav-btn w-10 h-10 rounded-xl text-xs font-bold bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg';
            } else {
                btn.className = 'nav-btn w-10 h-10 rounded-xl text-xs font-bold border border-gray-700 text-gray-400 hover:border-indigo-500 hover:text-indigo-400 transition-all';
            }
        }

        // Highlight opsi yang dipilih dengan style game
        document.querySelectorAll('.opsi-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const nomor = this.dataset.nomor;
                document.querySelectorAll(`[data-nomor="${nomor}"].opsi-label`).forEach(label => {
                    label.classList.remove('bg-indigo-900/30', 'border-indigo-500/50');
                    label.classList.add('bg-gray-800/50', 'border-gray-700');
                });
                this.closest('.opsi-label').classList.add('bg-indigo-900/30', 'border-indigo-500/50');
                this.closest('.opsi-label').classList.remove('bg-gray-800/50', 'border-gray-700');
            });
        });

        function scrollKeSoal(nomor) {
            const element = document.getElementById('soal-' + nomor);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                element.classList.add('glow-effect');
                setTimeout(() => element.classList.remove('glow-effect'), 1000);
            }
        }

        function konfirmasiSubmit() {
            const answered = Object.keys(terjawab).length;
            document.getElementById('infoTerjawab').textContent = answered;
            document.getElementById('modalTotalXP').textContent = totalXP;
            document.getElementById('modalSubmit').classList.remove('hidden');
            
            // Confetti effect for completion
            if (answered === totalSoal) {
                createConfetti();
            }
        }
        
        function createConfetti() {
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.animationDelay = Math.random() * 2 + 's';
                confetti.style.width = Math.random() * 8 + 4 + 'px';
                confetti.style.height = confetti.style.width;
                document.body.appendChild(confetti);
                setTimeout(() => confetti.remove(), 3000);
            }
        }
        
        function completeGame() {
            const answered = Object.keys(terjawab).length;
            if (answered === totalSoal) {
                document.getElementById('finalXP').textContent = totalXP;
                document.getElementById('bonusXP').textContent = Math.floor(maxStreak / 3) * 15;
                document.getElementById('completionModal').classList.remove('hidden');
                document.getElementById('modalSubmit').classList.add('hidden');
                createConfetti();
            } else {
                document.getElementById('ujianForm').submit();
            }
        }

        function tutupModal() {
            document.getElementById('modalSubmit').classList.add('hidden');
        }
        
        // Initial update
        updateProgress();
    </script>
</body>
</html>