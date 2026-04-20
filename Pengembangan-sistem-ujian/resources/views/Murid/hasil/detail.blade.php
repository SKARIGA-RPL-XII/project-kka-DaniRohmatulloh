<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Hasil Ujian - ExamSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-3px); }
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 5px rgba(79, 70, 229, 0.2); }
            50% { box-shadow: 0 0 15px rgba(79, 70, 229, 0.4); }
        }
        
        @keyframes bgMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .fade-up { animation: fadeInUp 0.5s ease-out forwards; }
        .scale-in { animation: scaleIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards; }
        .float-icon { animation: float 3s ease-in-out infinite; }
        .glow-effect { animation: glow 2s ease-in-out infinite; }
        
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 12px 24px -12px rgba(0, 0, 0, 0.15); }
        
        .progress-ring { transition: stroke-dashoffset 0.5s ease; }
        .badge-glow { transition: all 0.3s ease; }
        .badge-glow:hover { filter: drop-shadow(0 0 6px rgba(79, 70, 229, 0.4)); }
        
        .score-card {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
        }
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
        }
        
        .animated-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 400% 400%;
            animation: bgMove 15s ease infinite;
        }
    </style>
</head>
<body class="animated-bg min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-8">
        {{-- Header dengan efek game subtle --}}
        <div class="fade-up">
            <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden border border-white/20">
                <div class="relative bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 p-8 text-center overflow-hidden">
                    {{-- Decorative elements --}}
                    <div class="absolute top-0 right-0 opacity-10">
                        <i class="fas fa-crown text-8xl float-icon"></i>
                    </div>
                    <div class="absolute bottom-0 left-0 opacity-10">
                        <i class="fas fa-trophy text-7xl float-icon" style="animation-delay: 1s;"></i>
                    </div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-5">
                        <i class="fas fa-star text-9xl"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 rounded-full text-sm mb-4 backdrop-blur-sm">
                            <i class="fas fa-flag-checkered text-xs"></i>
                            <span>Mission Complete</span>
                        </div>
                        <i class="fas fa-chart-line text-4xl mb-3 opacity-80 float-icon"></i>
                        <h1 class="text-3xl font-bold mb-2">Detail Hasil Ujian</h1>
                        <p class="opacity-90">Analisis performa pertempuran akademik Anda</p>
                    </div>
                </div>

                <div class="p-8">
                    {{-- Statistik Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="fade-up" style="animation-delay: 0.1s">
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-5 stat-card shadow-sm border border-gray-100">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-scroll text-indigo-600 text-sm"></i>
                                    </div>
                                    <h3 class="font-bold text-gray-800">Informasi Ujian</h3>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-500 text-sm">Nama Ujian</span>
                                        <span class="font-semibold text-gray-800">{{ $hasil->ujian->nama_ujian ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-500 text-sm">Mata Pelajaran</span>
                                        <span class="font-semibold text-gray-800">{{ $hasil->ujian->mataPelajaran->nama_mapel ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-500 text-sm">Tanggal Ujian</span>
                                        <span class="font-semibold text-gray-800">{{ $hasil->created_at->translatedFormat('d F Y H:i') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-500 text-sm">Durasi</span>
                                        <span class="font-semibold text-gray-800">{{ $hasil->ujian->durasi ?? 0 }} menit</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="fade-up" style="animation-delay: 0.2s">
                            <div class="score-card rounded-xl p-5 stat-card shadow-sm border border-green-100">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-star text-yellow-600 text-sm"></i>
                                    </div>
                                    <h3 class="font-bold text-gray-800">Hasil Pertempuran</h3>
                                </div>
                                
                                {{-- Nilai dengan progress ring --}}
                                <div class="flex flex-col items-center">
                                    <div class="relative mb-3">
                                        <svg class="w-32 h-32 transform -rotate-90">
                                            <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="6" fill="none"/>
                                            <circle cx="64" cy="64" r="56" stroke="url(#gradient)" stroke-width="6" fill="none"
                                                    stroke-dasharray="352" stroke-dashoffset="{{ 352 - (352 * ($hasil->nilai ?? 0) / 100) }}"
                                                    class="progress-ring" stroke-linecap="round"/>
                                            <defs>
                                                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:#6366f1"/>
                                                    <stop offset="100%" style="stop-color:#8b5cf6"/>
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div>
                                                <span class="text-4xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                                    {{ $hasil->nilai ?? 0 }}
                                                </span>
                                                <span class="text-xs text-gray-400">/100</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Badge status --}}
                                    @php
                                        $nilai = $hasil->nilai ?? 0;
                                        $status = $nilai >= 75 ? 'Victory!' : ($nilai >= 60 ? 'Good Try!' : 'Keep Fighting!');
                                        $statusIcon = $nilai >= 75 ? 'fa-crown' : ($nilai >= 60 ? 'fa-medal' : 'fa-fist-raised');
                                        $statusColor = $nilai >= 75 ? 'text-green-600' : ($nilai >= 60 ? 'text-yellow-600' : 'text-orange-600');
                                    @endphp
                                    
                                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white rounded-full shadow-sm mt-2 badge-glow border border-gray-100">
                                        <i class="fas {{ $statusIcon }} {{ $statusColor }} text-sm"></i>
                                        <span class="text-sm font-semibold {{ $statusColor }}">{{ $status }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Ringkasan Jawaban (Jika ada detail jawaban) --}}
                    @if(isset($detailJawaban) && count($detailJawaban) > 0)
                    <div class="mb-8 fade-up" style="animation-delay: 0.3s">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-clipboard-list text-purple-600 text-sm"></i>
                            </div>
                            <h3 class="font-bold text-gray-800">Ringkasan Jawaban</h3>
                            <span class="text-xs text-gray-400 ml-2">({{ count($detailJawaban) }} soal)</span>
                        </div>
                        
                        <div class="grid gap-3">
                            @foreach($detailJawaban as $index => $jawaban)
                            <div class="bg-gradient-to-r from-white to-gray-50 rounded-xl p-4 border-l-4 {{ $jawaban['benar'] ? 'border-green-500' : 'border-red-500' }} card-hover shadow-sm">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-3 flex-1">
                                        <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold
                                            {{ $jawaban['benar'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-700">{{ $jawaban['pertanyaan'] ?? 'Soal' }}</p>
                                            <div class="flex items-center gap-3 mt-1">
                                                <span class="text-xs text-gray-500">
                                                    <i class="fas fa-check-circle mr-1 text-gray-400"></i>Jawaban: {{ $jawaban['jawaban_user'] ?? '-' }}
                                                </span>
                                                @if(!$jawaban['benar'] && isset($jawaban['jawaban_benar']))
                                                <span class="text-xs text-green-600">
                                                    <i class="fas fa-key mr-1"></i>Kunci: {{ $jawaban['jawaban_benar'] }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        @if($jawaban['benar'])
                                        <span class="text-xs text-green-600"><i class="fas fa-check-circle"></i> Benar</span>
                                        @else
                                        <span class="text-xs text-red-500"><i class="fas fa-times-circle"></i> Salah</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Tombol Aksi --}}
                    <div class="flex gap-3 fade-up" style="animation-delay: 0.4s">
                        <a href="{{ route('murid.riwayat') }}" 
                           class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-white border border-gray-200 text-gray-700 font-medium rounded-xl hover:border-indigo-300 hover:text-indigo-600 transition-all duration-300 group shadow-sm">
                            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i>
                            Riwayat Ujian
                        </a>
                        <a href="{{ route('murid.dashboard') }}" 
                           class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-md hover:shadow-lg group">
                            <i class="fas fa-home group-hover:scale-110 transition"></i>
                            Dashboard
                        </a>
                    </div>
                    
                    {{-- Achievement hint untuk nilai bagus --}}
                    @if(($hasil->nilai ?? 0) >= 80)
                    <div class="mt-6 text-center fade-up" style="animation-delay: 0.5s">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-full text-yellow-700 text-xs border border-yellow-200 shadow-sm">
                            <i class="fas fa-unlock-alt"></i>
                            <span>Achievement Unlocked: Scholar Warrior</span>
                            <i class="fas fa-trophy text-yellow-500 ml-1"></i>
                        </div>
                    </div>
                    @elseif(($hasil->nilai ?? 0) >= 60)
                    <div class="mt-6 text-center fade-up" style="animation-delay: 0.5s">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-full text-blue-700 text-xs border border-blue-200 shadow-sm">
                            <i class="fas fa-chart-line"></i>
                            <span>Terus tingkatkan skill Anda!</span>
                            <i class="fas fa-arrow-up text-blue-500 ml-1"></i>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>